<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

abstract class Fishpig_Wordpress_Block_Sidebar_Widget_Abstract extends Mage_Core_Block_Template
{
	/**
	 * Retrieve the default title for the block
	 *
	 * @return string
	 */
	abstract public function getDefaultTitle();
	
	/**
	 * Flag used to determine whether to fix option keys
	 *
	 * @var bool
	 */
	protected $_fixOptionKeys = false;
	
	/**
	 * Set the block's cache options
	 *
	 */
	protected function _construct()
	{
        $this->addData(array(
            'cache_lifetime'    => 120,
            'cache_tags'        => array('wordpress_sidebar_widget', Mage_Core_Model_Store::CACHE_TAG),
        ));
        
        return parent::_construct();
	}
    
	/**
	 * Retrieve the default title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_getData('title') ? $this->_getData('title') : $this->getDefaultTitle();
	}
	
	/**
	 * Attempt to load the widget information from the WordPress options table
	 *
	 * @return Fishpig_Wordpress_Block_Sidebar_Widget_Abstract
	 */
	protected function _beforeToHtml()
	{
		if ($this->getWidgetType()) {
			$data = $this->helper('wordpress')->getWpOption('widget_' . $this->getWidgetType());

			if ($data) {
				$data = unserialize($data);
				
				if (isset($data[$this->getWidgetIndex()])) {
					foreach($data[$this->getWidgetIndex()] as $field => $value) {
					
						if ($this->_fixOptionKeys) {
							$field = preg_replace('/([A-Z]{1})([A-Z]{1,})/e', "'$1' . strtolower('$2');", $field);
							$field = preg_replace('/([A-Z]{1})/e', "'_' . strtolower('$1');", $field);
						}
						
						$this->setData($field, $value);
					}
				}
			}
		}

		$this->setCacheKey($this->getNameInLayout());

		return parent::_beforeToHtml();
	}
	
	/**
	 * Override cache loading mechanism
	 * Allows us to not load block if WP database details are not valid
	 *
	 * @retrun string|false
	 */
	protected function _loadCache()
	{
		if (Mage::helper('wordpress/database')->isQueryable()) {
			return parent::_loadCache();
		}
		
		return '';
	}
	
	/**
	 * Override the cache saving method
	 * If bad WP db details, _loadCache() returns an empty string (instead of false)
	 * Use this to not save value
	 *
	 * @param string $data|false
	 * @return $this
	 */
	protected function _saveCache($data)
	{
		if (Mage::helper('wordpress/database')->isQueryable()) {
			return parent::_saveCache($data);
		}
		
		return $this;
	}
	
	/**
	 * Set some default values
	 *
	 * @param array $defaults
	 * @return $this
	 */
	protected function _setDataDefaults(array $defaults)
	{
		foreach($defaults as $key => $value) {
			if (!$this->hasData($key)) {
				$this->setData($key, $value);
			}
		}
		
		return $this;
	}
	
	/**
	 * Convert data values to something else
	 *
	 * @param array $values
	 * @return $this
	 */
	protected function _convertDataValues(array $values)
	{
		foreach($this->getData() as $key => $value) {
			foreach($values as $find => $replace) {
				if ($value === $find) {
					$this->setData($key, $replace);
					continue;
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * Retrieve the current page URL
	 *
	 * @return string
	 */
	public function _getPageUrl()
	{
		if (!$this->hasData('_page_url')) {
			$url = $this->helper('core/url')->getCurrentUrl();
			
			if (strpos($url, '?') !== false) {
				$url = substr($url, 0, strpos($url, '?'));
			}
			
			$this->setData('_page_url', $url);
		}

		return $this->_getData('_page_url');
	}
	
	
	/**
	 * Retrieve the current page title
	 *
	 * @return string
	 */
	protected function _getPageTitle()
	{
		if (($headBlock = $this->getLayout()->getBlock('head')) !== false) {
			return $headBlock->getTitle();
		}
	
		return $this->_getWpOption('name');
	}

	/**	
	 * Retrieve the meta description for the page
	 *
	 * @return string
	 */
	protected function _getPageDescription()
	{
		if (($headBlock = $this->getLayout()->getBlock('head')) !== false) {
			return $headBlock->getDescription();
		}
	}
	
	/**
	 * Retrieve an ID to be used for the list
	 *
	 * @return string
	 */
	public function getListId()
	{
		if (!$this->hasListId()) {
			$hash = 'wp-' . md5(rand(1111, 9999) . $this->getTitle() . $this->getWidgetType());
			
			$this->setListId(substr($hash, 0, 6));
		}
		
		return $this->_getData('list_id');
	}
	
	/**
	 * Save custom data to the cache
	 *
	 * @param string $data
	 * @param string $cacheKey
	 * @return $this
	 */
	protected function _saveCustomDataToCache($data, $cacheKey)
	{
		$cacheKey .= $this->getCacheKey();

        Mage::app()->saveCache($data, $cacheKey, $this->getCacheTags(), $this->getCacheLifetime());
        
        return $this;
    }
    
    /**
     * Retrieve the custom data from the cache
     *
     * @param string $cacheKey
     * @return string
     */
    protected function _loadCustomDataFromCache($cacheKey)
    {
    	$cacheData = Mage::app()->loadCache($cacheKey . $this->getCacheKey());
    	
    	if (trim($cacheData) !== '') {
    		return $cacheData;
    	}
    	
    	return false;
    }
	
	/**
	 * Convert a SimpleXMLElement object to an array
	 *
	 * @param SimpleXMLElement $xml
	 * @param array $out
	 * @return array]
	 */
	protected function _convertXmlToArray($xml, $out = array())
	{
		foreach((array)$xml as $index => $node) {
			if (is_object($node)) {
				$out[$index] = $this->_convertXmlToArray($node);
			}
			else if (is_array($node)) {
				$out[$index] = $this->_convertXmlToArray($node);
			}
			else {
				$out[$index] = $node;
			}
		}
		
		return $out;
	}	
}
