<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_Facebook_Block_Follow extends Fishpig_Wordpress_Addon_Facebook_Block_Abstract
{
	/**
	 * Retrieve the block's long ID
	 *
	 * @return string
	 */
	protected function _getLongId()
	{
		return 'follow_button';
	}

	/**
	 * Generate the HTML for the follow button
	 *
	 * @return string
	 */
	protected function _generateHtml()
	{
		return false;
	}
}
