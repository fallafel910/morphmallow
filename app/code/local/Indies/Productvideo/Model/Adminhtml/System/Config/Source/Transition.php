<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Transition
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('None'),
				'value' => 'none'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Fade'),
				'value' => 'fade'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Elastic'),
				'value' => 'elastic'
			);
        }
		
        return $this->_options;
    }
}