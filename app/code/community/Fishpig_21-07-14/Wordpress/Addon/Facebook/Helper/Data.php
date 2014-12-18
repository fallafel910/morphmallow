<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_Facebook_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Cache for Facebook plugin options
	 *
	 * @var array
	 */
	protected $_options = null;
	
	/**
	 * Flag that determines whether a FB item has ben included
	 *
	 * @var bool
	 */
	protected static $_isSdkRequired = false;
	
	/**
	 * Determine whether the FB plugin is installed in WP
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		return Mage::helper('wordpress')->isPluginEnabled('facebook');
	}
	/**
	 * Load the FB options
	 *
	 * @return void
	 */
	public function __construct()
	{
		$items = Mage::getResourceModel('wordpress/option_collection')
			->addFieldToFilter('option_name', array('like' => 'facebook_%'))
			->load();
			
		if (count($items) === 0) {
			return array();
		}
		
		$options = array();

		foreach($items as $option) {
			$name = substr($option->getOptionName(), 9);
			$value = $option->getOptionValue();
			
			if (substr($value, 0, 2) === 'a:') {
				$value = @unserialize($value);
			}
			else if ($value === '0' || $value === '1') {
				$value = (bool)$value;
			}
			
			$options[$name] = $value;
		}

		$this->_options = $options;
	}

	/**
	 * Shortcut to get the Application ID
	 *
	 * @return string
	 */
	public function getAppId()
	{
		return $this->getOption('application/app_id');
	}

	/**
	 * Get the JS SDK includes
	 *
	 * @return string
	 */
	public function getJsSdk()
	{
		$isSsl = Mage::app()->getStore()->isCurrentlySecure();
		$sdkFile = ( $isSsl ? 'https' : 'http' ) . '://connect.facebook.net/en_US/all.js';

		$args = array(
			'channelUrl' => Mage::helper('wordpress')->getBaseUrl('wp-content/plugins/facebook/channel.php'),
			'xfbml' => true,
			'appId' => $this->getAppId(),
		);

		$script = '<script type="text/javascript">//<![CDATA[' . "\n" . 'var FB_WP=FB_WP||{};FB_WP.queue={_methods:[],flushed:false,add:function(fn){FB_WP.queue.flushed?fn():FB_WP.queue._methods.push(fn)},flush:function(){for(var fn;fn=FB_WP.queue._methods.shift();){fn()}FB_WP.queue.flushed=true}};window.fbAsyncInit=function(){FB.init(' . json_encode( $args ) . ');if(FB_WP && FB_WP.queue && FB_WP.queue.flush){FB_WP.queue.flush()}' . '' . '}//]]></script>';
		
		$script .= '<div id="fb-root"></div><script type="text/javascript">(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src=' . json_encode($sdkFile) . ';fjs.parentNode.insertBefore(js,fjs)}(document,"script","facebook-jssdk"));</script>' . "\n";
		
		return $script;
	}
	 
	/**
	 * Retrieve all of the FB options
	 *
	 * @return array
	 */
	public function getOptions()
	{
		return $this->_options;
	}
	
	/**
	 * Retrieve a single option
	 *
	 * @param string $key
	 * @param mixed $default = null
	 * @return mixed
	 */
	public function getOption($key, $default = null)
	{
		if (strpos($key, '/') === false) {
			return isset($this->_options[$key])
				? $this->_options[$key]
				: $default;
		}
		
		$value = $this->_options;
		$keys = explode('/', $key);

		while(($xkey = array_shift($keys)) !== null) {
			if (!is_array($value) || !isset($value[$xkey])) {
				return $default;
			}
			
			$value = $value[$xkey];
		}

		return $value;
	}
	
	/**
	 * Inject the JS SDK content into the page
	 *
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 */
	public function addJsSdkObserver(Varien_Event_Observer $observer)
	{
		if (!$this->isEnabled() || !$this->isSdkRequired()) {
			return $this;
		}

		$response = $observer->getEvent()
			->getFront()
				->getResponse();

		if (preg_match('/(<body.*>)/iUs', $response->getBody(), $match)) {
			$jsSdk = Mage::helper('wp_addon_facebook')->getJsSdk();

			$response->setBody(
				str_replace($match[1], $match[1] . "\n" . $jsSdk, $response->getBody())
			);
		}
		
		return $this;
	}
	
	/**
	 * Determine whether to add the SDK to the head
	 *
	 * @param bool $flag = null
	 * @return bool
	 */
	public function isSdkRequired($flag = null)
	{
		if (!is_null($flag)) {
			self::$_isSdkRequired= $flag;
		}
		
		return self::$_isSdkRequired;
	}
}
