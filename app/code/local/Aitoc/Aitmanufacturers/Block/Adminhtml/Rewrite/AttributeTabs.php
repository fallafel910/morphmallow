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
class Aitoc_Aitmanufacturers_Block_Adminhtml_Rewrite_AttributeTabs extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Edit_Tabs
{
    protected function _beforeToHtml()
    {
        $attributeId = $this->getRequest()->get('attribute_id');
        if (!$attributeId || 'select' == Mage::getModel('eav/entity_attribute')->load($attributeId)->getData('frontend_input'))
        {
            $this->addTab('shopby', array(
                'label'     => Mage::helper('catalog')->__('Shop By'),
                'title'     => Mage::helper('catalog')->__('Shop By'),
                'content'   => $this->getLayout()->createBlock('aitmanufacturers/adminhtml_attribute_edit')->toHtml(),
                'active'    => false,
                'after'     => 'labels'
            ));
        }

        return parent::_beforeToHtml();
    }
}