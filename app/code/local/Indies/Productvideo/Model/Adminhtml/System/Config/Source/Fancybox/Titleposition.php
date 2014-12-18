<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Fancybox_Titleposition
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Floating'),
				'value' => 'float'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Outside'),
				'value' => 'outside'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Inside'),
				'value' => 'inner'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Over'),
				'value' => 'over'
			);
        }
		
        return $this->_options;
    }
}