<?php

class Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery_Fancybox extends Indies_Productvideo_Block_Catalog_Product_View_Media_Gallery
{
	protected $_type = 'fancybox';
	protected $_jsList = array(
		'productvideo/fancybox/jquery.fancybox-1.3.4.pack.js',
		'productvideo/fancybox/jquery.mousewheel-3.0.4.pack.js',
		'productvideo/fancybox/jquery.easing-1.3.pack.js',
		'productvideo/fancybox/no-conflict.js',
		
	);
	protected $_cssList = array(
		'productvideo/fancybox/jquery.fancybox-1.3.4.css'
	);
}
