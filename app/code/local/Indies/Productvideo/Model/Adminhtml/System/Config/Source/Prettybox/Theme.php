<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Prettybox_Theme
{
	protected $_options;
    
    public function toOptionArray()
    {
        if (!$this->_options)
		{
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('PrettyPhoto Default'),
				'value' => 'pp_default'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Light Rounded'),
				'value' => 'light_rounded'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Dark Rounded'),
				'value' => 'dark_rounded'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Light Square'),
				'value' => 'light_square'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Dark Square'),
				'value' => 'dark_square'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Facebook'),
				'value' => 'facebook'
			);
        }
		
        return $this->_options;
    }
}