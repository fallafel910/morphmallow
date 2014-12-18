<?php
/**
 * Brim LLC Commercial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Brim LLC Commercial Extension License
 * that is bundled with this package in the file Brim_CacheWarmer-license.pdf.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.brimllc.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@brimllc.com so we can send you a copy immediately.
 *
 * @category   Brim
 * @package    Brim_CacheWarmer
 * @copyright  Copyright (c) 2011-2014 Brim LLC
 * @license    http://ecommerce.brimllc.com/license
 */
class Brim_CacheWarmer_Model_System_Config_Source_Pagetypes {

    public function toOptionArray()
    {
        return array(
            array('value' => 'catalog/category', 'label' => 'Categories'),
            array('value' => 'catalog/product', 'label' => 'Products'),
            array('value' => 'cms/page', 'label' => 'CMS Pages'),
        );
    }

}
