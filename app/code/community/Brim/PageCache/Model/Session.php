<?php
/**
 * Brim LLC Commercial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Brim LLC Commercial Extension License
 * that is bundled with this package in the file Brim-LLC-Magento-License.pdf.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.brimllc.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@brimllc.com so we can send you a copy immediately.
 *
 * @category   Brim
 * @package    Brim_PageCache
 * @copyright  Copyright (c) 2011-2014 Brim LLC
 * @license    http://ecommerce.brimllc.com/license
 */


class Brim_PageCache_Model_Session extends Mage_Core_Model_Session_Abstract {

    public function __construct()
    {
        $namespace = 'brim_pagecache';
        $this->init($namespace);
    }
}