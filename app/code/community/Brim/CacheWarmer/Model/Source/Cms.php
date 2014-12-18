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
class Brim_CacheWarmer_Model_Source_Cms extends Brim_CacheWarmer_Model_Source_Abstract {

    /**
     * @var Zend_Db_Statement
     */
    protected $_stmt        = null;

    protected $_storeQueue  = false;

    protected $_savedRewrite= false;

    function __construct($params = array()) {

        parent::__construct($params);

        /*
         * Generate a SQL statement to rewrite collection for CMS pages
         */
        $collection = Mage::getResourceModel('cms/page_collection');
        $collection->addFieldToFilter('is_active', 1);
        $select = $collection->getSelect()
            ->reset(Zend_Db_Select::COLUMNS)
            ->joinLeft(
                array('store_table' => $collection->getTable('cms/page_store')),
                'main_table.page_id = store_table.page_id',
                array('store_id' => new Zend_Db_Expr('IFNULL(store_id, 0)'))
            )
            ->columns(array('request_path' => 'identifier'))
        ;

        $this->addStoreFilter($collection);

        $this->_stmt = $collection->getSelect()->query();
    }

    /**
     * Override to include all store view pages in the mix.
     *
     * @param Mage_Core_Model_Resource_Db_Collection_Abstract $collection
     * @param string $fieldName
     */
    public function addStoreFilter(Mage_Core_Model_Resource_Db_Collection_Abstract $collection, $fieldName='store_id') {
        if (($storeIds = $this->_getStoreIds())) {
            $collection->addFieldToFilter($fieldName, array(array('in' => $this->_getStoreIds()), 0));
        }
    }

    /**
     * @return null|string
     */
    public function next() {
        $url    = null;

        if ($this->_storeQueue == null) {
            $this->_savedRewrite = $rewrite = $this->_stmt->fetch();
            if ($rewrite != null) {
                if ($rewrite['store_id'] == 0) {
                    $this->_storeQueue = $this->_getStoreIds();

                    $url = $this->constructUrl($rewrite['request_path'], array_shift($this->_storeQueue));
                } else {
                    $url = $this->constructUrl($rewrite['request_path'], $rewrite['store_id']);
                }
            }
        } else {
            // use existing record to process the store queue.
            $url = $this->constructUrl($this->_savedRewrite['request_path'], array_shift($this->_storeQueue));
            if (count($this->_storeQueue) == 0) {
                $this->_storeQueue = null;
            }
        }

        return $url;
    }

    /**
     * close open connections when the object is cleaned up.
     */
    function __destruct() {
        if ($this->_stmt) {
            $this->_stmt->getAdapter()->closeConnection();
            $this->_stmt->closeCursor();
        }
    }
}