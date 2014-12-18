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


class Ikantam_EstimatedDeliveryDate_Model_System_Config_Source_Date_Format
{
    protected $_allowedFormats = array(
        'Full'   => Mage_Core_Model_Locale::FORMAT_TYPE_FULL,
        'Long'   => Mage_Core_Model_Locale::FORMAT_TYPE_LONG,
        'Medium' => Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM,
        'Short'  => Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
    );
    
    public function toOptionArray()
    {
        $arr = array();
        
        foreach ($this->_allowedFormats as $title => $format) {
            $arr[] = array(
                'label' => sprintf('%s (e.g. %s)', $title, $this->_formatDate($format)),
                'value' => $format
            );
        }
        
        return $arr;
    }
    
    protected function _formatDate($format)
    {
        return Mage::helper('core')->formatDate(null, $format, false);
    }
}
