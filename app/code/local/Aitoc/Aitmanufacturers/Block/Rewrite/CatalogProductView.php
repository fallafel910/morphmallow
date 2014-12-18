<?php
/**
 * Shop By Brands
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitmanufacturers
 * @version      3.3.1
 * @license:     sQl9Zt8K5bexz8avttVeuLMWc01LOvMh5Mmse4lAn8
 * @copyright:   Copyright (c) 2014 AITOC, Inc. (http://www.aitoc.com)
 */
class Aitoc_Aitmanufacturers_Block_Rewrite_CatalogProductView extends Mage_Catalog_Block_Product_View
{
    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $reg = '/<div class=\"product-name\">(.*?)<\/div>/ism';

        if (preg_match($reg, $html))
        {
            $manufacturerLink = Mage::helper('aitmanufacturers')->getManufacturerLink($this->getProduct());
    
            if ($manufacturerLink)
            {
                $reg = '/<div class=\"product-name\">(.*?)<\/div>/ism';
                $replace = '<div class="product-name">${1}</div><h4>'.$manufacturerLink.'</h4>';
                $html = preg_replace($reg, $replace, $html);
            }
        }

        return $html;
    }
}