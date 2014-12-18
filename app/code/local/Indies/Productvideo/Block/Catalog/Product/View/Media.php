<?php

class Indies_Productvideo_Block_Catalog_Product_View_Media extends Moo_Catalog_Block_Product_View_Media
{
	const XML_PATH_LIGHTBOX2_GENERAL_TYPE = 'productvideo/general/type';
	
	/**
	 * Get lightbox type to be used
	 *
	 * @return string
	 */
	 
	

	protected function _getLightboxType()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIGHTBOX2_GENERAL_TYPE);
	}
	
	/**
	 * Return gallery block name
	 *
	 * @return string
	 */
	public function getGalleryBlockName()
	{
		
		
		return 'gallery-'.$this->_getLightboxType();
		
	}
	public function loadDefault()
	{
		 return	$this->getLayout()->createBlock('catalog/product_view_media')->setTemplate('catalog/product/view/media.phtml')->toHtml();
	}
}
