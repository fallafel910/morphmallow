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
/**
 * Reads a url list file.  One url per line.
 *
 * Class Brim_CacheWarmer_Model_Source_Urllist
 */
class Brim_CacheWarmer_Model_Source_Urllist extends Brim_CacheWarmer_Model_Source_Abstract {

    protected $_fp          = null;

    protected $_basepath    = null;

    protected $_file        = null;

    function __construct($params=array()) {

        parent::__construct($params);

        if (!empty($params['basepath'])) {
            $this->_basepath = $params['basepath'];
        } else {
            $this->_basepath = Mage::getBaseDir('var') . DS . 'cachewarmer';
        }

        if (!empty($params['file'])) {
            $this->_file = $params['file'];
        } else {
            $this->_file = 'cachewarmer-url.list';
        }

        if (!($this->_fp = fopen($this->_basepath . DS . $this->_file, 'r'))) {
            $className  = get_class($this);
            $path       = $this->_basepath . DS . $this->_file;
            $msg        = "Unable to read url list. Model: {$className}, Path: {$path}";
            throw new Brim_CacheWarmer_Exception($msg);
        }
    }

    public function next() {
        return fgets($this->_fp);
    }

    function __destruct() {
        if ($this->_fp) {
            fclose($this->_fp);
        }
    }
}