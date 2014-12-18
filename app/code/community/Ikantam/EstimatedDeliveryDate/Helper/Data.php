<?php
/**
 * iKantam LLC
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the iKantam EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://magento.ikantam.com/store/license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * EstimatedDeliveryDate module to newer versions in the future.
 *
 * @category   Ikantam
 * @package    Ikantam_EstimatedDeliveryDate
 * @author     iKantam Team <support@ikantam.com>
 * @copyright  Copyright (c) 2013 iKantam LLC (http://www.ikantam.com)
 * @license    http://magento.ikantam.com/store/license-agreement  iKantam EULA
 */
 
class Ikantam_EstimatedDeliveryDate_Helper_Data extends Mage_Core_Helper_Abstract
{
	const XML_PATH_MODULE_ENABLED  = 'ikantam_estimateddeliverydate/module_options/enabled';
	const XML_PATH_CUSTOM_TEXT     = 'ikantam_estimateddeliverydate/module_options/custom_text';
	const XML_PATH_EXCLUDED_DAYS   = 'ikantam_estimateddeliverydate/module_options/excluded_days';
	const XML_PATH_DATE_FORMAT     = 'ikantam_estimateddeliverydate/module_options/date_format';
	const XML_PATH_VISIBLE_IN_CART = 'ikantam_estimateddeliverydate/module_options/cart';
    const ATTRIBUTE_CODE           = 'estimated_delivery_date';
    
    public function getEstimatedDeliveryDate($item)
    {
        $product = Mage::getModel('catalog/product')->load($item->getId());
        return $this->getDeliveryDate($product->getEstimatedDeliveryDate());
    }
    
    public function isVisibleInCart()
    {
        return $this->_getIsEnabled() && $this->_getIsVisibleInCart();
    }
    
    public function isEnabled()
    {
        return $this->_getIsEnabled();
    }
    
    /**
     * Get store config
     */
    protected function _getIsVisibleInCart()
    {
        return (bool) Mage::getStoreConfig(self::XML_PATH_VISIBLE_IN_CART);
    }

    /**
     * Get store config
     */
	protected function _getIsEnabled()
    {
        return (bool) Mage::getStoreConfig(self::XML_PATH_MODULE_ENABLED);
    }
    
    /**
     * Get store config
     */
    protected function _getExcludedDays()
	{
	    $weekdays = Mage::getStoreConfig(self::XML_PATH_EXCLUDED_DAYS);
	    if (!$weekdays) {
	        return array();
	    }
	    return explode(',', $weekdays);
	}
	
	/**
     * Get store config
     */
	protected function _getDateFormat()
	{
	    return Mage::getStoreConfig(self::XML_PATH_DATE_FORMAT);
	}
	
    /**
     * Get store config
     */
	protected function _getCustomText()
	{
		return Mage::getStoreConfig(self::XML_PATH_CUSTOM_TEXT);
	}
	
	public function getText($date)
	{
	    $dateString = str_replace('%date%', $date, $this->_getCustomText());
	    if (empty($dateString)) {
	        $dateString = $date;
	    }
	    return $dateString;
	}
	
	
	/**
	 * Hadler for catalog/output helper
	 */
	public function productAttribute($outputHelper, $attributeHtml, $params)
    {
        if (!isset($params['attribute']) || $params['attribute'] != self::ATTRIBUTE_CODE) {
            return $attributeHtml;
        }
        
        return $this->getDeliveryDate($attributeHtml);
    }
    
    protected function _countDays($daysCount)
    {
        $daysCount      = (int) $daysCount;
	    $days           = 0;
	    $currentWeekDay = (int) date('w');
	    $exclDates      = $this->_getExcludedDays();
	    $daysToAdd      = 0;
	        
	    if (count($exclDates) == 7) {
	        throw new Exception($this->__('No delivery date available.'));
	    }

	    while ($days < $daysCount) {
	        $currentWeekDay = ($currentWeekDay + 1) % 7;

	        if (!in_array($currentWeekDay, $exclDates)) {
	            $days++;
	        }
	        $daysToAdd++;
	    }
	    return $daysToAdd;
    }
    
	public function getDeliveryDate($daysCount)
	{
	    $patterns = array('single' => '/^[\d]{1,}$/', 'range' => '/^[\d]{1,}-[\d]{1,}$/');

        if (preg_match($patterns['single'], $daysCount)) {
            $eD = $this->_formatDate(date('Y-m-d H:i:s', time() + $this->_countDays($daysCount) * 24 * 3600));
	        return $this->getText($eD);
	    }

	    if (preg_match($patterns['range'], $daysCount)) {
	        $daysCounts = explode('-', $daysCount);
	        $str = array();
	        foreach ($daysCounts as $daysCount) {
	            $str[] = $this->_formatDate(date('Y-m-d H:i:s', time() + $this->_countDays($daysCount) * 24 * 3600));
	        }
	        return $this->getText(implode(' &ndash; ', $str));
	    }
	    
	    return $daysCount;
	}
	
	protected function _formatDate($date)
	{
	    return Mage::helper('core')->formatDate($date, $this->_getDateFormat(), false);
	}

public function getTimeLeft($daysCount, $params) {

	$date = array_shift(explode(',', $this->_formatDate(date('Y-m-d H:i:s', time() + $this->_countDays($daysCount) * 24 * 3600))));

	return 'Want it by '. $date .'? Order within ' . date('H', date('+1 day') - time()) . ' hrs ' . date('i', date('+1 day') - time()) . ' mins';
    }
}
