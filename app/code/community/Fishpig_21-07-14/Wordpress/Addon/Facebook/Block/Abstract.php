<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

abstract class Fishpig_Wordpress_Addon_Facebook_Block_Abstract extends Mage_Core_Block_Text
{
	/**
	 * Retrieve the long ID used by the block
	 *
	 * @return string
	 */
	abstract protected function _getLongId();
	
	/**
	 * Map of routes to page types
	 *
	 * @var array
	 */
	protected $_routeMap = array(
		'wordpress/archive/view' => 'archive',
		'wordpress/index/index' => 'home',
		'wordpress/page/view' => 'page',
		'wordpress/post_category/view' => 'archive',
	);

	/**
	 * Determine whether to display and generate HTML
	 *
	 * @return $this
	 */
	protected function _beforeToHtml()
	{
		if ($this->canDisplay()) {
			Mage::helper('wp_addon_facebook')->isSdkRequired(true);
			
			$this->setText($this->_generateHtml());
		}
		
		return parent::_beforeToHtml();
	}
	
	/**
	 * Build an HTML element
	 *
	 * @param string $type
	 * @param mixed $content
	 * @param array $params = array()
	 * @return string
	 */
	protected function _buildHtmlElement($type, $content, array $params = array())
	{
		$html = '';

		foreach($params as $key => $value) {
			if (!empty($value)) {
				$html .= ' ' . $key . '="' . addslashes($value) . '"';
			}
		}

		return '<' . $type . $html . '>' . $content . '</' . $type . '>';
	}
	
	/*
	 * Determine whether the block is above or below the post
	 *
	 * @return bool|null
	 */
	public function isAbovePost()
	{
		if (!$this->getPosition()) {
			return null;
		}

		return strpos($this->getNameInLayout(), 'above') !== false;
	}
	
	/**
	 * Retrieve an option value for the block
	 *
	 * @param string $key
	 * @return string
	 */
	protected function _getOption($key)
	{
		return Mage::helper('wp_addon_facebook')->getOption($this->_getLongId() . '/' . $key);
	}
	
	/**
	 * Retrieve the font option
	 *
	 * @return string
	 */
	public function getFont()
	{
		return $this->_getOption('font');
	}

	/**
	 * Retrieve the colourscheme option
	 *
	 * @return string
	 */	
	public function getColorScheme()
	{
		return $this->_getOption('colorscheme');		
	}
	
	/**
	 * Retrieve the position option
	 *
	 * @return string
	 */
	public function getPosition()
	{
		return $this->_getOption('position');		
	}
	
	/**
	 * Retrieve the ref option, which determines the location of the block
	 *
	 * @return string
	 */
	public function getRef()
	{
		return $this->isAbovePost() ? 'above-post' : 'below-post';
	}
	
	/**
	 * Retrieve the current URL
	 *
	 * @return string
	 */
	public function getHref()
	{
		return Mage::getUrl('', array('_current' => true, '_use_rewrite' => true));
	}

	/**
	 * Retrieve the width option
	 *
	 * @return int
	 */
	public function getWidth()
	{
		return $this->_getOption('width');
	}

	/**
	 * Retrieve the type of page currently being viewed
	 *
	 * @return string
	 */
	protected function _getPageType()
	{
		$request = Mage::app()->getRequest();
		$route = $request->getModuleName()
			. '/' . $request->getControllerName()
			. '/' . $request->getActionName();
		
		if (isset($this->_routeMap[$route])) {
			return $this->_routeMap[$route];
		}

		if ($route === 'wordpress/post/view') {
			if ($post = Mage::registry('wordpress_post')) {
				return $post->getPostType();
			}
			
			return 'post';
		}
		
		return false;
	}
	
	/**
	 * Determine whether to display the block
	 *
	 * @return bool
	 */
	public function canDisplay()
	{
		$position = $this->getPosition();

		$canDisplay = !$position
			|| $position === 'both'
			|| ($this->isAbovePost() && $position === 'top')
			|| (!$this->isAbovePost() && $position === 'bottom');

		if (!$canDisplay) {
			return false;
		}
		
		$features = (array)Mage::helper('wp_addon_facebook')->getOption($this->_getPageType() . '_features');
		$type = str_replace('_button', '', $this->_getLongId());

		return isset($features[$type]) && (int)$features[$type] === 1;
	}	
}
