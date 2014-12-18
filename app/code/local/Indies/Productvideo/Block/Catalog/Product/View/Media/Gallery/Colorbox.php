<?php
class Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery_Colorbox extends Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery
{
	protected $_type = 'colorbox';
	protected $_jsList = array(
		'productvideo/colorbox/colorbox/jquery.colorbox-min.js',
	);
	protected $_cssList = array();
	
	protected function getParams()
	{
		$return = parent::getParams();
		unset($return['theme']);
		
		$return['rel'] = 'indies_productvideo';
		if (!$return['left']) unset($return['left']);
		if (!$return['right']) unset($return['right']);
		if (!$return['bottom']) unset($return['bottom']);
		if (!$return['top']) unset($return['top']);
		
		return $return;
	}
	
	protected function _prepareLayout()
	{
		$this->_cssList[] = 'productvideo/colorbox/'.$this->getParam('theme').'/colorbox.css';
		
		return parent::_prepareLayout();
	}
}
