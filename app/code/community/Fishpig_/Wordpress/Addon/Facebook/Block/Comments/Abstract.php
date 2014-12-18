<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

abstract class Fishpig_Wordpress_Addon_Facebook_Block_Comments_Abstract extends Fishpig_Wordpress_Addon_Facebook_Block_Abstract
{
	/**
	 * Retrieve the block's long ID
	 *
	 * @return string
	 */
	protected function _getLongId()
	{
		return 'comments';
	}
	
	/**
	 * Generate the comments HTML
	 *
	 * @return string
	 */
	protected function _generateHtml()
	{
		return $this->_buildHtmlElement('div', '', array(
			'id' => 'commentform',
			'class' => 'fb-social-plugin comment-form fb-comments',
			'data-href' => $this->getHref(),
			'data-colorscheme' => $this->getColorScheme(),
			'data-width' => $this->getWidth(),
			'data-order-by' => $this->getOrderBy(),
			'data-num-posts' => $this->getNumPosts(),
		));
	}

	/**
	 * Retrieve the order by option
	 *
	 * @return string
	 */
	public function getOrderBy()
	{
		return $this->_getOption('order_by');
	}
	
	/**
	 * Retrieve the number of posts option
	 *
	 * @return string
	 */
	public function getNumPosts()
	{
		return $this->_getOption('num_posts');
	}
}
