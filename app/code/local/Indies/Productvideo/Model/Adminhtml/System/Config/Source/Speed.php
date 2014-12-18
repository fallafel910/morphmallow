<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Speed
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Slow'),
				'value' => 'slow'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Normal'),
				'value' => 'normal'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Fast'),
				'value' => 'fast'
			);
        }
		
        return $this->_options;
    }
}