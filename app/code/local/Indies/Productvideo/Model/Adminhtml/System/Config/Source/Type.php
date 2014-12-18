<?php
class Indies_Productvideo_Model_Adminhtml_System_Config_Source_Type
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
				'label' => Mage::helper('productvideo')->__('FancyBox'),
				'value' => 'fancybox'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('Pretty Photo'),
				'value' => 'prettyphoto'
			);
			$this->_options[] = array(
				'label' => Mage::helper('productvideo')->__('ColorBox'),
				'value' => 'colorbox'
			);
        }
		
        return $this->_options;
    }
}