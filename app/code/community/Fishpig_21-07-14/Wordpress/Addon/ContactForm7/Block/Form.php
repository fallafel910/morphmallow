<?php
/**
 * @category		Fishpig
 * @package		Fishpig_Wordpress
 * @license		http://fishpig.co.uk/license.txt
 * @author		Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_ContactForm7_Block_Form extends Mage_Core_Block_Text
{
	/**
	 * Ensure that the JS has been added
	 *
	 * @return $this
	 */
	protected function _prepareLayout()
	{
		if (($block = $this->getLayout()->getBlock('before_body_end')) !== false) {	
			if (is_null($block->getChld('wp.cf7.jss'))) {
				$block->append(
					$this->getLayout()
						->createBlock('core/text')
						->setText($this->_getJsInclude(), 'wp.cf7.js')
				);
			}
		}

		return parent::_prepareLayout();
	}
	
	/**
	 * Generate the Form HTML
	 *
	 * @return $this
	 */
	protected function _beforeToHtml()
	{
		if (!Mage::helper('wp_addon_cf7')->isEnabled() || !$this->getForm()) {
			return $this;
		}

		if (!$this->getTemplate()) {
			$form = $this->getForm();
			
			$this->setText(sprintf('<form method="post" id="%s" action="%s"%s>%s%s</form>',
				$form->getHtmlFormId(),
				$form->getFormActionUrl(),
				$form->hasUploadFields() ? ' enctype="multipart/form-data"' : '',
				$form->getHiddenElements(),
				$this->getFormHtml()
			));
			
			$additional = '';
			
			if (($js = $form->getAdditionalSetting('on_sent_ok')) !== false) {
				$additional = sprintf('cf7%s.onSentOkay = function(transport) {%s};', $form->getId(), $js);
			}
			
			$this->addText(sprintf('<script type="text/javascript">document.observe(\'dom:loaded\', function(event) { var cf7%s = new CF7(\'%s\'); %s });</script>', 
				$form->getId(), $form->getHtmlFormId(), $additional
			));
		}
		
		return parent::_beforeToHtml();
	}
	
	/**
	 * Retrieve the JS include HTML
	 *
	 * @return string
	 */
	protected function _getJsInclude()
	{
		return sprintf('<script type="text/javascript" src="%s%s"></script>', 
			Mage::getBaseUrl('js'),
			'fishpig/wordpress/contact-form-7.js'
		);
	}
}
