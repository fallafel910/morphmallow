<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_Facebook_Block_Send extends Fishpig_Wordpress_Addon_Facebook_Block_Abstract
{
	/**
	 * Get the block's long ID string
	 *
	 * @return string
	 */
	protected function _getLongId()
	{
		return 'send_button';
	}

	/**
	 * Generate the HTML for the Send button
	 *
	 * @return string
	 */
	protected function _generateHtml()
	{
		return $this->_buildHtmlElement('div', '', array(
			'class' => 'fb-social-plugin fb-send',
			'data-font' => $this->getFont(),
			'data-colorscheme' => $this->getColorScheme(),
			'data-ref' => $this->getRef(), 
			'data-href' => $this->getHref(), 
		));	
	}
}
