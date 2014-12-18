<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Theme
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			//$this->_options[] = array(
//				'label' => Mage::helper('productvideo')->__('Traditional LightBox'),
//				'value' => 'lightbox'
//			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Dark'),
				'value' => 'dark'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Light'),
				'value' => 'light'
			);
			
        }
		
        return $this->_options;
    }
}