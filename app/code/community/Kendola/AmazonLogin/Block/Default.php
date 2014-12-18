<?php
/**
 * Kendola Login With Amazon for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Kendola
 * @package    Kendola_AmazonLogin
 * @author     Oliver Treck, kendola - easy eCommerce <o.treck@kendola.de>
 * @copyright  Copyright (c) 2013 kendola - easy eCommerce (http://www.kendola.de/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Kendola_AmazonLogin_Block_Default extends Mage_Core_Block_Template {
    private $_helper;

    private function _getHelper() {
        if(null===$this->_helper) {
            $this->_helper = Mage::helper('amazonlogin');
        }
        return $this->_helper;
    }

    public function isEnabled() {
        return $this->_getHelper()->isEnabled();
    }

    public function getClientId()
    {
        return $this->_getHelper()->getClientId();
    }

    public function getClientSecret()
    {
        return $this->_getHelper()->getClientSecret();
    }
}
