<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Status
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
				'label' => Mage::helper('justsold')->__('Enabled'),
				'value' => '1'
			);
			$this->_options[] = array(
				'label' => Mage::helper('justsold')->__('Disabled'),
				'value' => '0'
			);
			
        }
		
        return $this->_options;
    }
}