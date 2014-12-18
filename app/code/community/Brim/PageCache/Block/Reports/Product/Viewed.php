<?php

class Brim_PageCache_Block_Reports_Product_Viewed extends Mage_Reports_Block_Product_Viewed {

    public function getItemsCollection()
    {
        if (is_null($this->_collection)) {

            if (Mage::getSingleton('brim_pagecache/engine')->isEnabled()) {

                $productIds = Mage::helper('brim_pagecache')->getRecentlyViewedProductsIds();
                if (($currentProduct = Mage::registry('current_product'))!= null) {
                    // prevents a condition on the index table that's not required as we have a list of product ids to get.
                    Mage::unregister('current_product');
                }

                if (empty($productIds)) {
                    $productIds = array(0);
                }

                // If the FPC is enable generate the collection from the cookie bypassing the index.
                $this->setProductIds($productIds);
                if (method_exists($this, 'useProductIdsOrder')) {
                    $this->useProductIdsOrder(true);
                }

                $this->_collection = parent::getItemsCollection();

                if ($currentProduct != null) {
                    Mage::register('current_product', $currentProduct, true);
                }

            } else {
                $this->_collection = parent::getItemsCollection();
            }

        }

        return $this->_collection;
    }
}
