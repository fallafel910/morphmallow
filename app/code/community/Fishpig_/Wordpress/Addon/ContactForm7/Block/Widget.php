<?php
/**
 * @category		Fishpig
 * @package		Fishpig_Wordpress
 * @license		http://fishpig.co.uk/license.txt
 * @author		Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_ContactForm7_Block_Widget extends Mage_Core_Block_Text
{
	/**
	 * Generate the Form HTML
	 *
	 * @return $this
	 */
	protected function _beforeToHtml()
	{
		if (!Mage::helper('wp_addon_cf7')->isEnabled()) {
			return $this;
		}

		if (!$this->getForm() && $this->getFormId()) {
			$form = Mage::getModel('wp_addon_cf7/form')->load($this->getFormId());
			
			if ($form->getId()) {
				$this->setForm($form);
			}
		}
	
		if ($this->getForm()) {
			$this->setText($this->getForm()->getHtml());
		}

		return parent::_beforeToHtml();
	}
}
