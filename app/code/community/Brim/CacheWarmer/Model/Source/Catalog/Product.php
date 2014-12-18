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
class Brim_CacheWarmer_Model_Source_Catalog_Product extends Brim_CacheWarmer_Model_Source_Catalog_Abstract {

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

        $collection->addFieldToFilter('product_id', array('notnull' => 1));

        $this->addStoreFilter($collection);

        $this->_addProductVisibilityFilter($collection);

        $this->_addProductStatusFilter($collection);

        $collection->addFieldToFilter('is_system', 1);

        $this->_stmt = $collection->getSelect()->query();
    }

    /**
    * Limits the products to the visible products
    *
    * @param $collection Mage_Core_Model_Resource_Url_Rewrite_Collection
    * @return Brim_CacheWarmer_Model_Crawler
    */
    protected function _addProductStatusFilter(Mage_Core_Model_Resource_Url_Rewrite_Collection $collection) {
        /**
        * @var $visibilityAttribute Mage_Catalog_Model_Resource_Eav_Attribute
        */
        $visibilityAttribute = Mage::getResourceModel('catalog/eav_attribute');
        $visibilityAttribute->loadByCode('catalog_product', 'status');

        $attributeId    = $visibilityAttribute->getId();
        $attributeCode  = $visibilityAttribute->getAttributeCode();
        $attributeTable = $visibilityAttribute->getBackend()->getTable();

        $valueTable1 = $attributeCode . '_t1';
        $valueTable2 = $attributeCode . '_t2';
        $collection->getSelect()
           ->joinLeft(
               array($valueTable1 => $attributeTable),
               "main_table.product_id={$valueTable1}.entity_id"
                   . " AND {$valueTable1}.attribute_id='{$attributeId}'"
                   . " AND {$valueTable1}.store_id='0'",
               array())
           ->joinLeft(
               array($valueTable2 => $attributeTable),
               "main_table.product_id={$valueTable2}.entity_id"
                   . " AND {$valueTable2}.attribute_id='{$attributeId}'"
                   . " AND main_table.store_id = {$valueTable2}.store_id",
               array()
           );

        $valueExpr = $collection->getConnection()->getCheckSql(
           $valueTable2 . '.value_id > 0',
           $valueTable2 . '.value',
           $valueTable1 . '.value'
        );

        $collection->getSelect()->where(
            "(main_table.product_id IS NULL) OR ($valueExpr = ?)",
           Mage_Catalog_Model_Product_Status::STATUS_ENABLED
        );

        return $this;
    }
}