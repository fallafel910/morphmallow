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
class Aitoc_Aitmanufacturers_Block_Adminhtml_Attribute_Select extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareLayout()
    {
        $this->setChild('continue_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('catalog')->__('Continue'),
                    'onclick'   => "setSettings('".$this->getContinueUrl()."','attributecode')",
                    'class'     => 'save'
                    ))
                );
        return parent::_prepareLayout();
    }

    protected function _prepareForm()
    {
        $attributes = Mage::getResourceModel('aitmanufacturers/config')->getAttributeList();
        
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('attribute', array('legend'=>Mage::helper('catalog')->__('Choose Attribute')));

        if (empty($attributes))
        {
            $fieldset->addElement(new Varien_Data_Form_Element_Note(array('text' => Mage::helper('aitmanufacturers')->__('There are no active attributes.'))));
        }
        else
        {
            $fieldset->addField('attributecode', 'select', array(
                'label' => Mage::helper('catalog')->__('Shop By Attribute'),
                'title' => Mage::helper('catalog')->__('Shop By Attribute'),
                'name'  => 'attributecode',
                'values'=> $attributes,
            ));

            $fieldset->addField('continue_button', 'note', array(
                'text' => $this->getChildHtml('continue_button'),
            ));
        }

        $this->setForm($form);
    }

    public function getContinueUrl()
    {
        return $this->getUrl('*/*/index', array(
            '_current'  => true,
            'attributecode'       => '{{attributecode}}',
        ));
    }
}