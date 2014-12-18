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
/**
 * @copyright  Copyright (c) 2010 AITOC, Inc. 
 */

$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */

$installer->startSetup();

if(!$this->getAttribute('catalog_product', 'aitmanufacturers_sort'))
{
    $this->addAttribute('catalog_product', 'aitmanufacturers_sort', array(
    	'type'						=> 'int',
    	'label'						=> 'Position',
    	'required'					=> 0,
    	'visible'					=> 0,
    	'default'					=> 9999,
    	'global'					=> 0,
    	'is_configurable'			=> 0,
    	'used_for_price_rules'		=> 0,
    ));
}

$installer->endSetup();