<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Control
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
				'label' => Mage::helper('productvideo')->__('Red'),
				'value' => 'red'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('White'),
				'value' => 'white'
			);
			
        }
		
        return $this->_options;
    }
}