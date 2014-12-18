<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_Facebook_Block_Like extends Fishpig_Wordpress_Addon_Facebook_Block_Abstract
{
	/**
	 * Retrieve the block's long ID
	 *
	 * @return string
	 */
	protected function _getLongId()
	{
		return 'like_button';
	}

	/**
	 * Generate the HTML for the follow button
	 *
	 * @return string
	 */
	protected function _generateHtml()
	{
		return $this->_buildHtmlElement('div', '', array(
			'class' => "fb-social-plugin fb-like",
			'data-font' => $this->getFont(),
			'data-colorscheme' => $this->getColorScheme(),
			'data-ref' => $this->getRef(), 
			'data-href' => $this->getHref(), 
			'data-layout' => $this->getLayout(),
			'data-share' => $this->getShare(),
			'data-width' => $this->getWidth(),
			'data-action' => $this->getAction(),
		));
	}

	/**
	 * Retrieve the layout option
	 *
	 * @return string
	 */
	public function getLayout()
	{
		return $this->_getOption('layout');	
	}

	/**
	 * Retrieve the share option
	 *
	 * @return string
	 */	
	public function getShare()
	{
		return $this->_getOption('share') === 1 ? 'true' : 'false';
	}

	/**
	 * Retrieve the action option
	 *
	 * @return string
	 */
	public function getAction()
	{
		return $this->_getOption('like_button/action');		
	}	
}
