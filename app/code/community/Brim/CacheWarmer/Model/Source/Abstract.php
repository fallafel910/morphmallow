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
abstract class Brim_CacheWarmer_Model_Source_Abstract {

    /**
     * @var null|Brim_CacheWarmer_Model_Crawler
     */
    protected $_crawler = null;

    /**
     * @var null
     */
    protected $_websites = null;

    /**
     * @var null
     */
    static protected $_storeIds = null;

    /**
     * Returns the next url to warm
     *
     * @return string|null
     */
    abstract public function next();

    /**
     * @param array $params
     */
    public function __construct($params=array()) {
        if (isset($params['crawler'])) {
            $this->setCrawler($params['crawler']);
        }
        if (isset($params['websites'])) {
            $this->setWebsites($params['websites']);
        }
    }

    /**
     * Completes a partial url with a stores base url.
     *
     * @param $urlPath
     * @param int $storeId
     * @return string
     */
    public function constructUrl ($urlPath, $storeId = 0) {
        return $this->getCrawler()->constructUrl($urlPath, $storeId);
    }

    /**
     * @param Brim_CacheWarmer_Model_Crawler $crawler
     * @return $this
     */
    public function setCrawler(Brim_CacheWarmer_Model_Crawler $crawler) {
        $this->_crawler = $crawler;
        return $this;
    }

    /**
     * @return Brim_CacheWarmer_Model_Crawler|null
     */
    public function getCrawler() {
        return $this->_crawler;
    }

    public function setWebsites($websites) {
        $this->_websites = $websites;
    }

    public function getWebsites() {
        return $this->_websites;
    }

    /**
     * @return array|null
     */
    protected function _getStoreIds() {

        if (is_null(self::$_storeIds)) {
            if (!($websites = $this->getWebsites())) {
                $websites = array_keys(Mage::app()->getWebsites());
            }

            $stores = array();
            foreach ($websites as $websiteId) {
                $website    = Mage::app()->getWebsite($websiteId);
                $stores     = array_merge($stores, $website->getStoreIds());
            }

            self::$_storeIds = array_intersect($stores, $this->getCrawler()->getUniqueStoreIds());
        }

        return self::$_storeIds;
    }

    public function addStoreFilter(Mage_Core_Model_Resource_Db_Collection_Abstract $collection, $fieldName='store_id') {
        // Need to filter by store ids for cases where stores have been filtered out.
        //if (($websiteIds = $this->getWebsites())) {
            if (($storeIds = $this->_getStoreIds())) {
                $collection->addFieldToFilter('main_table.'.$fieldName, array('in' => $this->_getStoreIds()));
            }
        //}
    }

    public function addWebsiteFilter(Mage_Core_Model_Resource_Db_Collection_Abstract $collection, $fieldName='website_id') {
        if (($websiteIds = $this->getWebsites())) {
            $collection->addFieldToFilter($fieldName, array('in' => $websiteIds));
        }
    }
}