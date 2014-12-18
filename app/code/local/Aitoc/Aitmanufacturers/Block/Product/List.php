<?php
/**
 * Shop By Brands
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitmanufacturers
 * @version      3.3.1
 * @license:     sQl9Zt8K5bexz8avttVeuLMWc01LOvMh5Mmse4lAn8
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
/**
* @copyright  Copyright (c) 2009 AITOC, Inc. 
*/
class Aitoc_Aitmanufacturers_Block_Product_List extends Mage_Catalog_Block_Product_List //Mage_Catalog_Block_Product_Abstract
{
    /**
     * Product Collection
     *
     * @var Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected $_productCollection;
    protected $_manufacturer;
    protected $_attributeId;
    
    public function __construct(){
        $manufacturers = Mage::registry('aitmanufacturers_manufacturers');
        if (isset($manufacturers[$this->getRequest()->getParam('id')])){
            $this->_manufacturer = $manufacturers[$this->getRequest()->getParam('id')];
        }
        else {
            $this->_manufacturer = Mage::getModel('aitmanufacturers/aitmanufacturers')->load($this->getRequest()->getParam('id'))
                ->getManufacturerId();
            $manufacturers[$this->getRequest()->getParam('id')] = $this->_manufacturer;
            
            if (!Mage::registry('aitmanufacturers_manufacturers'))
            {
                Mage::register('aitmanufacturers_manufacturers', $manufacturers);
            }
        }
        if(Mage::helper('aitmanufacturers')->isModuleEnabled('Aitoc_Aitproductslists'))
        {
              $this->setTemplate('aitcommonfiles/design--frontend--base--default--template--catalog--product--list.phtml');
        }
        else
        {
              $this->setTemplate('catalog/product/list.phtml');
        }
     
        if (Mage::getStoreConfig('catalog/aitmanufacturers/enable_product_list_cache')) {
            $params = Mage::app()->getRequest()->getParams();
            $values = array_values($params);
            $keys   = array_keys($params);
            $this->addData(array('cache_lifetime' => 640,
                           'cache_key' => 'AITMANUFACTURERS_PRODUCT_LIST' . Mage::app()->getStore()->getId() . join('-',$keys) . ' ' . join('-',$values)));
        }
    }
    
    public function getToolbarBlock()
    {
    	$block = parent::getToolbarBlock();
    	
    	$sortAttribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product','aitmanufacturers_sort');
        
	    $block->removeOrderFromAvailableOrders('position');
            
        $newOrders = $block->getAvailableOrders();
        $newOrders = array_reverse($newOrders, true);
        $newOrders['aitmanufacturers_sort'] = Mage::helper('catalog')->__($sortAttribute->getFrontend()->getLabel());
        $newOrders = array_reverse($newOrders, true);
        
       $block->setAvailableOrders($newOrders);

		if($block->getDefaultOrder()=='position') {
			$block->setDefaultOrder('aitmanufacturers_sort');
		}
    	
    	return $block;
    }

    public function getAttributeId()
    {
        
        if (!$this->_attributeId)
        {
            $this->_attributeId = Mage::getModel('aitmanufacturers/config')->getAttributeIdByOption($this->_manufacturer);
        }
        
        return $this->_attributeId;
    }

    protected function _getProductCollection()
    {
        /* !AITOC_MARK:manufacturer_collection */
        if (is_null($this->_productCollection))
        {            
            $helper = Mage::helper('aitmanufacturers');
            
            if ($helper->canUseLayeredNavigation($this->getAttributeId()) && !$helper->isLNPEnabled())
            {
                $collection = parent::_getProductCollection();
                $collection
                    ->addAttributeToSelect('sort')
                    ->joinAttribute('sort', 'catalog_product/aitmanufacturers_sort', 'entity_id', null, 'left');                 
		        
                $productIds = Mage::getModel('aitmanufacturers/aitmanufacturers')->getProductsByManufacturer($this->_manufacturer, Mage::app()->getStore()->getId(), $this->getAttributeId());
                $collection->addIdFilter($productIds);
                Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
                Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		         
                $this->_productCollection = $collection;
                
            }
            else
            {            
                $collection = Mage::getResourceModel('catalog/product_collection');
                $attributes = Mage::getSingleton('catalog/config')
                    ->getProductAttributes();
                $collection->addAttributeToSelect($attributes)
                    ->addAttributeToSelect('sort')
                    ->addMinimalPrice()
                    ->addFinalPrice()
                    ->addTaxPercents()
                    ->addStoreFilter()
                    ->joinAttribute('sort', 'catalog_product/aitmanufacturers_sort', 'entity_id', null, 'left');

                $productIds = Mage::getModel('aitmanufacturers/aitmanufacturers')->getProductsByManufacturer($this->_manufacturer, Mage::app()->getStore()->getId(), $this->getAttributeId());
                //$collection->addAttributeToFilter(Mage::helper('aitmanufacturers')->getAttributeCode(), array('eq' => $this->_manufacturer), 'left');
                $collection->addIdFilter($productIds);
                Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
                Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
                $this->_productCollection = $collection;
            }
            if (!is_null($this->_productCollection)){
                $visibleIds = Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds();
                $this->_productCollection->addAttributeToFilter('visibility',$visibleIds);
            }
        }
        
        return $this->_productCollection;
    }
    
    protected function _toHtml()
    {
        $html = '';
       
        if ($this->_getProductCollection()->count()) {
            $html = parent::_toHtml();
        }
        
        $helper = Mage::helper('aitmanufacturers');
        if ($helper->canUseLayeredNavigation($this->getAttributeId()) && $helper->isLNPEnabled()) {            
            $html = Mage::helper('adjnav')->wrapProducts($html);
        }
        
        return $html;
    }    
    
}