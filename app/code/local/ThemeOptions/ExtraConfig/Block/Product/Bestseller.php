<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-M1.txt
 *
 * @category   Peer
 * @package    Peer_Ajaxcartpro
 * @copyright  Copyright (c) 2003-2009 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-M1.txt
 */ 

class ThemeOptions_ExtraConfig_Block_Product_Bestseller extends Mage_Catalog_Block_Product_Abstract
{
   protected function _beforeToHtml() {
    
    $productCount = 20;
    
    $storeId        = Mage::app()->getStore()->getId();
    $_productCollection = Mage::getResourceModel('reports/product_collection')
                              
                              ->addOrderedQty()
                              ->addAttributeToSelect('*')
                              ->addViewsCount()
                              ->setStoreId($storeId)
                              ->addStoreFilter($storeId)
                              ->setOrder('views_count', 'desc')
                              ->setPageSize($productCount);
        #echo $_productCollection->getSelect()->__toString();                            
        
        if ($_productCollection->isEnabledFlat())
        {
            $_productCollection->getSelect()
                        ->joinLeft(
                            array('cpl' => $_productCollection->getResource()->getFlatTableName()),
                                "e.entity_id = cpl.entity_id"
                        )
                        ->where("cpl.visibility IN (?)", 
                            array(
                                Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG, 
                                Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH
                            )
                        );      
        }
        else
        {
          $visibility     = array(
                          Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
                          Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
                      );
            $_productCollection->addAttributeToFilter('visibility', $visibility);
        }
     
    
 
    $this->setProductCollection($_productCollection);
    return parent::_beforeToHtml();
}
}