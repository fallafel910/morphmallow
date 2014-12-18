<?php
/*
Plugin Name: MWI Shortcodes & Widgets
Plugin URI: http://www.jckemp.com
Description:
Author: James Kemp
Version: 1.0.1
Author URI: http://www.jckemp.com/
*/

class jck_mwi_shortcodes 
{
	
	/* 	=============================
	   	Shortcodes
	   	============================= */
		
		function product($atts) 
		{
			extract(shortcode_atts(array(
				'sku' => '', // product SKU from Magento
				'title' => "true", // true/false
				'title_tag' => 'h2', // anything
				'desc' => "true", // true/false
				'img' => "true", // true/false
				'price' => "true", // true/false
				'img_width' => 200, // width of image
				'type' => 'add', // add/view
				'btn_link' => 'button', //Should it be a button or an anchor,
				'btn_color' => 'blue', // Color of the button blue/orange/black/gray/white/red/rosy/green/pink/none
				'cols' => 3 // Number of columns for when there is more than one product on show
			), $atts));
			
			include("inc/shortcode-products.php");
				
			return $shortcode;		 			 
		}
		
	/* 	=============================
	   	Construct Class 
	   	============================= */
	
		function __construct() 
		{ 
			add_shortcode('mwi_product', array(&$this, 'product') );
		}  
	
}

class jck_prod_widget 
{
	
	/* 	=============================
		Widgets 
		============================= */
		
		function register_widgets() 
		{
			global $jck_mwi;
			register_widget( 'cat_prods' );
		}
	
	/* 	=============================
		Construct Class 
		============================= */
		
		function __construct()
		{ 
			global $jck_mwi;
			add_action( 'widgets_init', array(&$this, 'register_widgets') );
		}  
	
}

/** Start an instance of the plugin classes **/
$jck_mwi_shortcodes = new jck_mwi_shortcodes;
$jck_prod_widget = new jck_prod_widget;

/** Includes **/
include_once('inc/widget-cat-prods.php');
require_once('update-notifier.php');