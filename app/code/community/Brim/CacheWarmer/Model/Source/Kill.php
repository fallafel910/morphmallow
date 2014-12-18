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
 * generates lots of random args on product urls many times helps testing cache backends.
 *
 * Class Brim_CacheWarmer_Model_Source_Kill
 */
class Brim_CacheWarmer_Model_Source_Kill extends Brim_CacheWarmer_Model_Source_Abstract {

    const MAX_PARAMS = 100;

    protected $_source = null;

    protected $_paramCount = 0;

    function __construct($params = array()) {

        parent::__construct($params);

        $args   = array('crawler' => $this->getCrawler());

        $this->_source = Mage::getModel('brim_cachewarmer/source_catalog_product', $args);

    }

    public function next() {

        if ($this->_paramCount >= self::MAX_PARAMS) {
            return false;
        }

        if (!($url = $this->_source->next())) {
            ++$this->_paramCount;

            $args   = array('crawler' => $this->getCrawler());

            $this->_source = Mage::getModel('brim_cachewarmer/source_catalog_product', $args);
            $url = $this->_source->next();
        }

        $url .= '?' . uniqid('NAME')  . '=' . uniqid('VALUE');

        return $url;
    }
}