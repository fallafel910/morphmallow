<?php
/**
 * Brim LLC Commercial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Brim LLC Commercial Extension License
 * that is bundled with this package in the file Brim_CacheWarmer-license.pdf.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.brimllc.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@brimllc.com so we can send you a copy immediately.
 *
 * @category   Brim
 * @package    Brim_CacheWarmer
 * @copyright  Copyright (c) 2011-2014 Brim LLC
 * @license    http://ecommerce.brimllc.com/license
 */
class Brim_CacheWarmer_Model_Crawler {

    /**
     * Locks directory path
     */
    const LOCK_DIR      = '/locks';

    /**
     * File to store last run data (timestamp)
     */
    const LAST_RUN_FILE = '/brim_cachewarmer.lastrun';

    /**
     * File to indication crawler is locked/running
     */
    const LOCK_FILE     = '/brim_cachewarmer.lock';

    /**
     * @var array|null
     */
    protected $_storeBaseUrls   = null;

    /**
     * @var bool
     */
    protected $_killmode        = false;

    /**
     * @var bool
     */
    protected $_echoDebug       = false;

    /**
     *
     */
    public function __construct() {
        // ensure a locks directory existing
        if (!file_exists($this->getLockDir())) {
            if (!mkdir($this->getLockDir(), 0777, true)) {
                Mage::throwException('Unable to create var/locks directory!');
            }
        }

        // check for curl
        if (!extension_loaded('curl')) {
            Mage::throwException('Curl PHP extension is required!');
        }

        // Populate store base urls
        $this->_storeBaseUrls   = array();
        $storeCollection        = Mage::getResourceModel('core/store_collection');
        foreach ($storeCollection as $store) {
            $this->_storeBaseUrls[$store->getId()] = $store->getBaseUrl();
        }
        // only need to keep unique urls
        $this->_storeBaseUrls = array_unique($this->_storeBaseUrls);

        //  Need to keep the default base url
        if(!isset($this->_storeBaseUrls[0])) {
            $this->_storeBaseUrls[0] = Mage::app()->getDefaultStoreView()->getBaseUrl();
        }
    }

    /**
     *
     */
    public function __deconstruct() {
        // unlock if still valid
        if($this->isLockValid()) {
            $this->unlock();
        }
    }

    /**
     * Performs an entire site crawl.
     *
     * @return Brim_CacheWarmer_Model_Crawler
     */
    public function crawl() {

        $sources = Mage::getSingleton('brim_cachewarmer/config')->getActiveSources();

        if ($this->_killmode) {

            $killSource = Mage::getModel('brim_cachewarmer/source_kill', array('crawler' => $this));

            $this->_crawl($killSource);

            return $this;
        }

        $website = Mage::getStoreConfig('brim_cachewarmer/general/website');

        if (is_string($website)) {
            $website = explode(',', $website);
            if (in_array(0, $website)) {
                // if all websites is selected use null to bypass filter.
                $website = null;
            }
        }

        foreach ($sources as $source) {
            $model  = $source['model'];
            $args   = array('crawler' => $this);

            if (isset($source['args'])) {
                $args = array_merge($args, $source['args']);
            }


            if ($website) {
                $args['websites'] = $website;
            }

            try {
                $sourceModel = Mage::getModel($model, $args);
                $this->_crawl($sourceModel);
            } catch (Exception $e) {
                $this->_debug($e->getMessage());
                Mage::logException($e);
            }
        }

        return $this;
    }

    /**
     * Crawls requests path from the core_url_rewrite table/collection
     *
     * @param Zend_Db_Statement $stmt
     * @return Brim_CacheWarmer_Model_Crawler
     */
    protected function _crawl(Brim_CacheWarmer_Model_Source_Abstract $urlSource) {
        /**
         * @var $rewrite    Mage_Core_Model_Url_Rewrite
         */

        $maxConcurrency = Mage::getStoreConfig('brim_cachewarmer/general/concurrency');
        $running        = null;

        $mh             = curl_multi_init();

        // Prime the inital requests
        $handles = array();
        for ($i = 0; $i < $maxConcurrency; $i++) {
            if (($url = $urlSource->next()) != null) {
                $this->_debug('Crawling : ' . $url);
                $handles[] = $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_multi_add_handle($mh, $ch);
            }
        }

        // Start executing requests, replace them as they complete.
        do {
            $status = curl_multi_exec($mh,$running);
            $ready  = curl_multi_select($mh);
            //$ready =1 ;

            if ($ready > 0) {
                while($info=curl_multi_info_read($mh)){
                    if ($info) {
                        // Completed
                        foreach ($handles as $i => $handle) {
                            if ($handle == $info['handle']) {
                                unset($handles[$i]);
                            }
                        }
                        $cInfo = curl_getinfo($info['handle']);
                        curl_multi_remove_handle($mh, $info['handle']);
                        curl_close($info['handle']);

                        // Add another
                        if (($url = $urlSource->next()) != null) {
                            $this->_debug('Crawling : ' . $url);
                            $handles[] = $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_multi_add_handle($mh, $ch);

                            if (++$i % 10 == 0) {
                                $this->_debug('Checking lock');
                                if ($this->isLockValid() == false) {
                                    throw new Brim_CacheWarmer_Exception("Duplicate crawler", Brim_CacheWarmer_Exception::DUPLICATE_CRAWLER);
                                }
                            }
                        }
                    }
                }
            }
        } while($status === CURLM_CALL_MULTI_PERFORM || $running);

        // Check for existing handles
        foreach ($handles as $i => $handle) {
            if (($errorMsg = curl_error($handle)) != '') {
                $this->_debug($errorMsg);
            }
        }

        // cleans up remaining requests
        while ($info=curl_multi_info_read($mh)) {
            curl_multi_remove_handle($mh, $info['handle']);
            curl_close($info['handle']);
        }

        curl_multi_close($mh);

        return $this;
    }

    public function debug($msg) {
        return $this->_debug($msg);
    }

    /**
     * Logs debug messages.
     *
     * @param $msg
     * @return mixed
     */
    protected function _debug($msg) {

        if ($this->_echoDebug) {
            print_r($msg); echo "\n";
        } else if (Mage::getStoreConfig('brim_cachewarmer/general/debug')) {
            return Mage::log($msg, null, 'brim-cache-warmer.log', true);
        }
    }

    /**
     * @return array
     */
    public function getUniqueStoreIds() {
        return array_keys($this->_storeBaseUrls);
    }

    /**
     * Completes a partial url with a stores base url.
     *
     * @param $urlPath
     * @param int $storeId
     * @return string
     */
    public function constructUrl($urlPath, $storeId = 0) {
        return $this->_storeBaseUrls[$storeId] . $urlPath;
    }

    /**
     * Returns the path the locks directory.
     *
     * @return string
     */
    public function getLockDir() {
        return Mage::getBaseDir('var') . self::LOCK_DIR;
    }

    /**
     * Lock the crawler to prevent multiple crawls.
     *
     * @return int
     */
    public function lock() {
        return file_put_contents($this->getLockDir() . self::LOCK_FILE, getmypid());
    }

    /**
     * Unlock the crawler.
     *
     * @return bool
     */
    public function unlock() {
        return $this->isLocked() ? unlink($this->getLockDir() . self::LOCK_FILE) : true;
    }

    /**
     * Checks if the crawler is locked.  ie. currently running
     *
     * @return bool
     */
    public function isLocked() {
        return file_exists($this->getLockDir() . self::LOCK_FILE);
    }

    /**
     * Checks pid in the lock file and compares it against current pid. Returns true if they match otherwise false.
     *
     * @return bool
     */
    public function isLockValid() {
        if ($this->isLocked()) {
            if (file_get_contents($this->getLockDir() . self::LOCK_FILE) == getmypid()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Writes the last time of completion. Returns the result of file_put_contents.
     *
     * @param null $value unix timestamp
     * @return int
     */
    public function setLastrun($value=null) {
        if ($value ==null) {
            $value = time();
        }
        return file_put_contents($this->getLockDir() . self::LAST_RUN_FILE, $value);
    }

    /**
     * Returns unix time stamp of last completion
     *
     * @return null|int
     */
    public function getLastrun() {
        if (file_exists($this->getLockDir() . self::LAST_RUN_FILE)) {
            $time = file_get_contents($this->getLockDir() . self::LAST_RUN_FILE);
        } else {
            $time = null;
        }
        return $time;
    }

    /**
     * Loads a special source to generate lots of traffic.
     *
     * @param $mode
     * @return $this
     */
    public function setKillMode($mode) {
        $this->_killmode = $mode;
        return $this;
    }

    /**
     * Flag to echo instead of writing to the file.
     * @param $mode
     * @return $this
     */
    public function setEchoDebug($mode) {
        $this->_echoDebug = $mode;
        return $this;
    }
}
