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
class Brim_CacheWarmer_Model_Source_Homepage extends Brim_CacheWarmer_Model_Source_Abstract {

    protected $_index       = 0;

    protected $_urls        = array();

    function __construct($params=array()) {

        parent::__construct($params);

        $collection = Mage::getResourceModel('core/store_collection');

        $this->addStoreFilter($collection);

        /** @var $store Mage_Core_Model_Store */
        foreach ($collection as $store) {
            $url = $store->getBaseUrl();
            $this->_urls[$url] = $url;
        }

    }

    public function next() {
        return array_pop($this->_urls);
    }
}