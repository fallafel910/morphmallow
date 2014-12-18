<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_ContactForm7_Helper_Shortcode_Form extends Fishpig_Wordpress_Helper_Shortcode_Abstract
{
	/**
	 * Inject the form html 
	 *
	 * @param Varien_Event_Observer $observer
	 * @return void
	 */
	public function injectFormObserver(Varien_Event_Observer $observer)
	{
		if (!Mage::helper('wp_addon_cf7')->isEnabled()) {
			return $this;
		}

		$post = $observer->getEvent()->getObject();
		$html = $observer->getEvent()->getContent();
		$content = $html->getContent();
		
		$this->apply($content, $observer->getEvent()->getObject(), $observer->getEvent()->getContext());
		
		$html->setContent($content);
	}
	
	/**
	 * Retrieve the shortcode tag
	 *
	 * @return string
	 */
	public function getTag()
	{
		return 'contact-form-7';
	}
	
	/**
	 * Apply the Vimeo short code
	 *
	 * @param string &$content
	 * @param Fishpig_Wordpress_Model_Post_Abstract $object
	 * @return void
	 */	
	protected function _apply(&$content, Fishpig_Wordpress_Model_Post_Abstract $object)
	{
		if (($shortcodes = $this->_getShortcodes($content)) !== false) {
			foreach($shortcodes as $shortcode) {
				$params = $shortcode->getParams();
				
				$form = Mage::getModel('wp_addon_cf7/form')->load($shortcode->getParams()->getId());
			
				if ($form->getId()) {
					$form->setPost($object);

					$content = str_replace($shortcode->getHtml(), $form->getHtml(), $content);
				}
				else {
					$content = str_replace($shortcode->getHtml(), '', $content);
				}
			}
		}
	}
}
