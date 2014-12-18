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

class Brim_CacheWarmer_Model_Source_Catalog_Category extends Brim_CacheWarmer_Model_Source_Catalog_Abstract {

    /**
    * @var Zend_Db_Statement
    */
    protected $_stmt = null;

    function __construct($params = array()) {

        parent::__construct($params);

        /*
        * rewrite collection covers category and product urls
        */
        $collection = Mage::getResourceModel('core/url_rewrite_collection');
        $select     = $collection->getSelect();

        $select->where("category_id IS NOT NULL AND product_id IS NULL");

        $this->addStoreFilter($collection);

        $collection->addFieldToFilter('is_system', 1);

        $this->_stmt = $collection->getSelect()->query();
    }
}