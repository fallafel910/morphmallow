<?php
/**
 * @category		Fishpig
 * @package		Fishpig_Wordpress
 * @license		http://fishpig.co.uk/license.txt
 * @author		Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_ContactForm7_Helper_Data extends Fishpig_Wordpress_Helper_Abstract
{
	/**
	 * Determine whether the extension and plugin are enabled
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		return Mage::getStoreConfigFlag('wordpress/extend/cf7')
			&& Mage::helper('wordpress')->isPluginEnabled('Contact Form 7');
	}
}
