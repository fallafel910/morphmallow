<?php
/**
 * Brim LLC Commercial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Brim LLC Commercial Extension License
 * that is bundled with this package in the file Brim-LLC-Magento-License.pdf.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.brimllc.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@brimllc.com so we can send you a copy immediately.
 *
 * @category   Brim
 * @package    Brim_PageCache
 * @copyright  Copyright (c) 2011-2014 Brim LLC
 * @license    http://ecommerce.brimllc.com/license
 */


class Brim_PageCache_Model_Container_Recentlyviewed
    extends Brim_PageCache_Model_Container_Abstract
{
    const COOKIE = 'BRIM_FPC_RECENTLY_VIEWED';

    const COOKIE_SEPARATOR = '_';

    protected $_productIds  = null;

    /**
     * Init's the enclosed block.
     *
     * @return void
     */
    protected function _construct($args) {
        $this->_productIds  = Mage::helper('brim_pagecache')->getRecentlyViewedProductsIds();
    }

    protected function _generateCacheKey() {
        return join('_', $this->_productIds);
    }

    protected function _createBlock() {

        if (($currentProduct = Mage::registry('current_product'))!= null) {
            // prevents a condition on the index table that's not required as we have a list of product ids to get.
            Mage::unregister('current_product');
        }

        parent::_createBlock();

        /*
         * Sets product ids for a lighter DB Query. We remove and add products back to simulate the order in which they
         * were first viewed.  Due to the small size of the cookie products may cycle through the recently viewed products
         * list more often than normal.
         */
        $_collection = $this->_block->getItemsCollection();

        if (is_object($_collection) && !method_exists($this->_block, 'useProductIdsOrder')) {
            foreach ($this->_productIds as $_productId) {
                $_item = $_collection->getItemById($_productId);
                $_collection->removeItemByKey($_productId);
                if ($_item) {
                    $_collection->addItem($_item);
                }
            }
        }

        if ($currentProduct != null) {
            Mage::register('current_product', $currentProduct, true);
        }

        return $this->_block;
    }

    /**
     * Adds products to the recently viewed list.
     *
     * @static
     * @param Varien_Object $args
     * @return
     */
    public static function addProductViewed(Varien_Object $args) {

        if (($newId = $args->getId()) != null) {
            $cookie = Mage::app()->getCookie();
            $ids = explode(self::COOKIE_SEPARATOR, $cookie->get(self::COOKIE));

            // most recently viewed product should be on the top of the list.
            $ids = array_diff($ids, array($newId)); // remove
            array_unshift($ids, $newId); // push on top

            $ids    = array_slice(
                array_unique($ids),
                0,
                //stores double the viewable products
                Mage::getStoreConfig(Mage_Reports_Block_Product_Viewed::XML_PATH_RECENTLY_VIEWED_COUNT)*2
            );

            $cookie->set(self::COOKIE, trim(join(self::COOKIE_SEPARATOR, $ids), ' ,' . self::COOKIE_SEPARATOR));
        }

        return true;
    }

    public static function getContainerArgs($block, $options = array()) {

        $options['remove_l1'] = true;

        return Brim_PageCache_Model_Container_Abstract::getContainerArgs($block, $options);
    }
}
