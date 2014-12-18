<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Colorbox_Theme
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Theme 1'),
				'value' => 'theme1'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Theme 2'),
				'value' => 'theme2'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Theme 3'),
				'value' => 'theme3'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Theme 4'),
				'value' => 'theme4'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Theme 5'),
				'value' => 'theme5'
			);
        }
		
        return $this->_options;
    }
}