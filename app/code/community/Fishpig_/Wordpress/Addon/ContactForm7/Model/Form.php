<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_ContactForm7_Model_Form extends Fishpig_Wordpress_Model_Post_Abstract
{
	/**
	 * Cache variable for CF7 version
	 *
	 * @var static string
	 */
	static protected $_version = null;
	
	/**
	 * Initialise the model
	 *
	 */
	public function _construct()
	{	
		$this->_init('wp_addon_cf7/form');
		
		$this->setPostType('wpcf7_contact_form');
	}
	
	/**
	 * Retrieve the HTML for this form
	 *
	 * @return false|string
	 */
	public function getHtml()
	{
		if (!$this->getHasHtml()) {
			if (($html = $this->_getRawHtml()) === '') {
				return false;
			}

			if (($fields = $this->_extractFields($html)) !== false) {
				$this->setFields($fields);
				
				foreach($fields as $field) {
					$html = str_replace($field->getShortcode(), $field->getElementHtml(), $html);
				}
				
				$block = Mage::getSingleton('core/layout')
					->createBlock('wp_addon_cf7/form')
					->setForm($this)
					->setFormHtml($this->_cleanHtml($html));
				
				$this->setHtml($block->toHtml());
			}
		}
		
		return $this->_getData('html');
	}
	
	/**
	 * Retrieve the form action URL
	 *
	 * @return string
	 */
	public function getFormActionUrl()
	{
		$helper = Mage::helper('wordpress');
		
		return str_replace($helper->getUrl(), $helper->getBaseUrl(), $this->getPost()->getPermalink()) . '#' . $this->getHtmlFormId();
	}

	/**
	 * Retrieve the form ID
	 *
	 * @return string
	 */	
	public function getHtmlFormId()
	{
		return sprintf('wpcf7-f%d-p%d-o1', $this->getId(), $this->getPost()->getId());
	}
	
	/**
	 * Retrieve the form hidden elements
	 *
	 * @return string
	 */
	public function getHiddenElements()
	{
		$values = array(
			'_wpcf7' => $this->getId(),
			'_wpcf7_version' => $this->_getWpcf7Version(),
			'_wpcf7_unit_tag' => $this->getHtmlFormId(),
			'_wpcf7_is_ajax_call' => 1,
		);
		
		$html = '';
		
		foreach($values as $name => $value) {
			if (($renderer = $this->_getRenderer('hidden', '')) !== false) {
				$html .= $renderer->setName($name)
					->setId('hidden-' . str_replace('_', '-', $name))
					->setValue($value)
					->getElementHtml();
			}
		}
		
		if (($html = trim($html)) !== '') {
			return '<div class="no-display">' . $html . '</div>';		
		}
		
		return '';
	}
	
	/**
	 * Retrieve the CF7 plugin version
	 *
	 * @return string
	 */
	protected function _getWpcf7Version()
	{
		if (is_null(self::$_version)) {
			$data = unserialize(Mage::helper('wordpress')->getWpOption('wpcf7'));
			
			self::$_version = isset($data['version']) ? $data['version'] : false;
		}
		
		return self::$_version;
	}
	
	/**
	 * Extract the field shortcodes from the raw HTML
	 * Return an array of field models
	 *
	 * @param string $html
	 * @return false|array
	 */
	protected function _extractFields($html)
	{
		if (preg_match_all('/\[([a-z]{1,}[\*]{0,1}) (.*)\]/iU', $html, $matches)) {
			$fields = array();
			
			foreach($matches[0] as $it => $match) {
				$isRequired = substr($matches[1][$it], -1) === '*';
				$type = rtrim($matches[1][$it], '*');
				$params = $matches[2][$it] . ' ';

				if (($field = $this->_getRenderer($type, $params)) !== false) {
					$field->setShortcode($match)
						->setRendererType($type)
						->setIsRequired($isRequired)
						->setShortcodeParams($params);

					$this->_prepareFormField($field);

					$fields[] = $field;
				}
			}

			if (count($fields) > 0) {
				return $fields;
			}
		}
		
		return false;
	}

	/**
	 * Prepare a form field for use
	 * This includes parsing the field shortcode and setting the params
	 * and values
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _prepareFormField(Varien_Object $field)
	{
		if (($params = $field->getShortcodeParams()) !== null) {
			$callback = '_beforePrepare' . str_replace('_', '', uc_words($field->getRendererType())) . 'Field';

			if (method_exists($this, $callback)) {
				$this->$callback($field);
			}
			
			if ($field->getIsRequired()) {
				$field->addClass('required-entry');
			}

			$field->setName($this->_match('/^([a-z0-9_-]{1,})/i', $params));
			$field->setHtmlId('cf7-' . substr(md5($this->_match('/id:([a-z0-9_-]{1,}) /iU', $params)), 0, 6) . '-' . rand(111, 999));
			$field->addClass(trim($this->_match('/class:([a-z0-9_-]{1,}) /iU', $params)));
			$field->setValue($this->_match('/"([^"]{1,})"/iU', $params));

			/*
			if (strpos($field->getShortcodeParams(), ' placeholder') !== false) {
				$field->setPlaceholder($field->getValue());
			}
			*/

			if (($values = $this->_matchAll('/"([^"]{1,})"/iU', $params)) !== false) {
				$final = array();
				
				foreach($values as $value) {
					$final[addslashes(strip_tags($value))] = $value;
				}

				$field->setValues($final);
			}
			
			$sm = explode('/', $this->_match('/ ([0-9]{0,}\/[0-9]{0,}) /U', $params));
			
			if (count($sm) === 2) {
				$field->setSize((int)$sm[0]);
				$field->setMaxlength((int)$sm[1]);
			}
			
			$callback = '_afterPrepare' . str_replace('_', '', uc_words($field->getRendererType())) . 'Field';

			if (method_exists($this, $callback)) {
				$this->$callback($field);
			}
		}
		
		return $this;
	}
	
	/**
	 * Retrieve the rendering class for the field
	 *
	 * @param string $type
	 * @param string $params
	 * @return Varien_Object|false
	 */
	protected function _getRenderer($type, $params = '')
	{
		$classType = str_replace('_', '', uc_words($type));
		
		$callback = '_getRendererFor' . $classType;
		
		if (method_exists($this, $callback)) {
			$class = $this->$callback($params);
		}
		else {
			$class = uc_words($type);
		}
		
		if ($class !== false) {
			if (strpos($class, '_') === false) {
				$class = 'Varien_Data_Form_Element_' . $class;
			}
			
			try {
				if (class_exists($class)) {
					$object = new $class;
		
					return $object->setForm(new Varien_Object());
				}
			}
			catch (Exception $e) {}
		}
				
		return false;
	}
	
	protected function _getRendererForRecaptcha($params = array())
	{
		if (Mage::helper('wordpress')->isAddonInstalled('ReCaptcha')) {
			return 'Fishpig_Wordpress_Addon_ReCaptcha_Model_Form_Element_Captcha';
		}
		
		return false;
	}
	
	/**
	 * Retrieve the raw HTML of the form
	 * This needs to be processed before being displayed
	 *
	 * @return string|false
	 */
	protected function _getRawHtml()
	{
		return trim($this->getMetaValue('_form'));
	}

	/**
	  * Match a pattern against the given value ($v)
	  *
	  * @param string $p
	  * @param string $v
	  * @param int $r = 1
	  * @return string|false
	  */
	protected function _match($p, $v, $r = 1)
	{
		if (preg_match($p, $v, $m)) {
			return isset($m[$r]) ? $m[$r] : $m;
		}

		return false;
	}
	
	/**
	  * Match multiple pattern against the given value ($v)
	  *
	  * @param string $p
	  * @param string $v
	  * @param int $r = 1
	  * @return string|false
	  */
	protected function _matchAll($p, $v, $r = 1)
	{
		if (preg_match_all($p, $v, $m)) {
			return isset($m[$r]) ? $m[$r] : $m;
		}

		return false;
	}

	/**
	 * Retrieve the rendering class for the Email field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForEmail($params)
	{
		return 'Text';
	}
	
	/**
	 * Retrieve the rendering class for the URL field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForUrl($params)
	{
		return 'Text';
	}
	
	/**
	 * Retrieve the rendering class for the Telephone field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForTel($params)
	{
		return 'Text';
	}
	
	/**
	 * Retrieve the rendering class for the Select field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForSelect($params)
	{
		if (strpos($params, ' multiple ') !== false) {
			return 'Multiselect';
		}
		
		return 'Select';
	}
	
	/**
	 * Retrieve the rendering class for the Checkbox field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForCheckbox($params)
	{
		return 'Checkboxes';
	}
	
	/**
	 * Retrieve the rendering class for the Radio field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForRadio($params)
	{
		return 'Radios';
	}
	
	/**
	 * Retrieve the rendering class for the Radio field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForAcceptance($params)
	{
		return 'Checkbox';
	}
	
	/**
	 * Retrieve the rendering class for the Radio field
	 *
	 * @param string $param
	 * @return string
	 */
	protected function _getRendererForQuiz($params)
	{
		return false;
	}

	/**
	 * Convert the values for the Radio field to an option array
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareRadioField(Varien_Object $field)
	{
		$values = $this->_arrayToOptionArray($field->getValues());
		
		$field->setValues($values);
		$field->setValue(false);
		
		return $this;
	}
	
	/**
	 * Ensure that no checkbox is selected by default
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareCheckboxField(Varien_Object $field)
	{
		$field->setValue(false);
		
		return $this;
	}
	
	/**
	 * Convert the values for the Radio field to an option array
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareEmailField(Varien_Object $field)
	{
		$field->addClass('validate-email');
	
		return $this->_afterPrepareTextField($field);
	}
	
	/**
	 * Convert the values for the Radio field to an option array
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareTextField(Varien_Object $field)
	{
		$field->addClass('input-text');
		
		return $this;
	}
		
	/**
	 * Convert the values for the Radio field to an option array
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	public function _afterPrepareSelectField(Varien_Object $field)
	{
		if (strpos($field->getShortcodeParams(), ' include_blank ') !== false) {
			$old = array_merge(array('' => ''), $field->getValues());
			$values = $this->_arrayToOptionArray($old);
			
			$field->setValues($values);
			$field->setValue(false);
		}

		return $this;
	}
	
	/**
	 * Add the cols and rows parameters to the textarea object
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	public function _afterPrepareTextareaField(Varien_Object $field)
	{
		if (($sizes = $this->_match('/([0-9]{1,}x[0-9]{1,})/', $field->getShortcodeParams())) !== false) {
			$sizes = explode('x', $sizes);
			
			$field->setCols($sizes[0])->setRows($sizes[1]);
		}

		return $this;
	}

	/**
	 * Convert the values for the Radio field to an option array
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	public function _afterPrepareAcceptanceField(Varien_Object $field)
	{
		$field->setValue(1);

		if (strpos($field->getShortcodeParams(), 'default:on') !== false) {
			$field->setChecked(true);
		}

		return $this;
	}

	/**
	 * Add required classes to field
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareUrlField(Varien_Object $field)
	{
		$field->addClass('validate-url');
		
		return $this;
	}
	
	/**
	 * Add required classes to field
	 *
	 * @param Varien_Object $field
	 * @return $this
	 */
	protected function _afterPrepareDateField(Varien_Object $field)
	{
		$field->addClass('validate-date')
//			->setValue(date('d/m/Y'))
			->setFormat('dd/MM/yyyy');

		return $this;
	}
	
	/**
	 * Convert a standard key=>value array to an option array
	 *
	 * @param array $arr
	 * @return array
	 */
	protected function _arrayToOptionArray(array $arr)
	{
		$options = array();
		
		foreach($arr as $value => $label) {
			$value = str_replace(' ', '_', $value);

			$options[] = array(
				'value' => $value,
				'label' => $label,
			);
		}
		
		return $options;
	}
	
	/**
	 * Clean a HTML string
	 *
	 * @param string $html
	 * @return string
	 */
	protected function _cleanHtml($html)
	{
//		$html = preg_replace('/(type|name|class|value="[^"]{1,}")/iU', ' $1', $html);
		$html = preg_replace("/([\r\n\t]{1})/", '', $html);
		
		while(strpos($html, '  ') !== false) {
			$html = str_replace('  ', ' ', $html);
		}

		return trim($html);
	}
	
	/**
	 * Determine whether the form has any file inputs
	 *
	 * @return bool
	 */
	public function hasUploadFields()
	{
		foreach((array)$this->getFields() as $field) {
			if ($field['type'] === 'file') {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Retrieve an additional setting
	 *
	 * @param string $key
	 * @return string|false
	 */
	public function getAdditionalSetting($key)
	{
		if (($settings = $this->getAdditionalSettings()) !== false) {
			return isset($settings[$key]) ? $settings[$key] : false;
		}
		
		return false;
	}
	
	/**
	 * Load the and return the additional settings for the form
	 *
	 * @return false|array
	 */
	public function getAdditionalSettings()
	{
		if (!$this->hasAdditionalSettings()) {
			$this->setAdditionalSettings(false);

			if (($settings = trim($this->getMetaValue('_additional_settings'))) !== '') {
				if (preg_match_all("/^(.*): \"(.*)\"$/", $settings, $matches)) {
					$this->setAdditionalSettings(array_combine($matches[1], $matches[2]));
				}
			}
		}
		
		return $this->_getData('additional_settings');
	}
	
	/**
	 * Retrieve the post model
	 * If a post model is not, set generci object
	 *
	 * @return Varien_Object
	 */
	public function getPost()
	{
		if (!$this->hasPost()) {
			$this->setPost(
				new Varien_Object(array(
					'id' => 1,
					'permalink' => Mage::helper('wordpress')->getUrl(),
				
				))
			);
		}
		
		return $this->_getData('post');
	}
}
