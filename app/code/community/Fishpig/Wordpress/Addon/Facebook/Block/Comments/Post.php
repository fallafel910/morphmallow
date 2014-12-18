<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	if (Mage::helper('wp_addon_facebook')->isEnabled()) {
		class Fishpig_Wordpress_Addon_Facebook_Block_Comments_Post extends Fishpig_Wordpress_Addon_Facebook_Block_Comments_Abstract {}
	}
	else {
		class Fishpig_Wordpress_Addon_Facebook_Block_Comments_Post extends Fishpig_Wordpress_Block_Post_View_Comment_Wrapper {}
	}
	