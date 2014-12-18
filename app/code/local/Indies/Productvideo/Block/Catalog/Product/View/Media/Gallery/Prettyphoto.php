<?php
class Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery_Prettyphoto extends Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery
{
	protected $_type = 'prettyphoto';
	protected $_jsList = array(
		'productvideo/prettyphoto/js/jquery.prettyPhoto.js',
	);
	protected $_cssList = array(
		'productvideo/prettyphoto/css/prettyPhoto.css'
	);
	
	protected function getParams()
	{
		$return = parent::getParams();
		$return['social_tools'] = '';
		
		return $return;
	}
}
