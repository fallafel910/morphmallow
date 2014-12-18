<?php
class Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery_Lightbox extends Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery
{
	protected $_type = 'lightbox';
	protected $_jsList = array(
		'productvideo/lightbox/js/jquery.lightbox-0.5.pack.js',
	);
	protected $_cssList = array(
		'productvideo/lightbox/css/jquery.lightbox-0.5.css'
	);
	
	protected function getParams()
	{
		$return = parent::getParams();
		$return['imageLoading'] = $this->getSkinUrl('productvideo/lightbox/images/lightbox-ico-loading.gif');
		$return['imageBtnClose'] = $this->getSkinUrl('productvideo/lightbox/images/lightbox-btn-close.gif');
		$return['imageBtnPrev'] = $this->getSkinUrl('productvideo/lightbox/images/lightbox-btn-prev.gif');
		$return['imageBtnNext'] = $this->getSkinUrl('productvideo/lightbox/images/lightbox-btn-next.gif');
		$return['imageBlank'] = $this->getSkinUrl('productvideo/lightbox/images/lightbox-blank.gif');
		
		return $return;
	}
}