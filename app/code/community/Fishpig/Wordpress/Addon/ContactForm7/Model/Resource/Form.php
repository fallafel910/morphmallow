<?php

class Fishpig_Wordpress_Addon_ContactForm7_Model_Resource_Form extends Fishpig_Wordpress_Model_Resource_Post_Abstract
{
	public function _construct()
	{	
		$this->_init('wp_addon_cf7/form', 'ID');
	}
}
