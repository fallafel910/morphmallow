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
$installer = $this;

$installer->startSetup();

$setup = Mage::getModel('eav/entity_setup', 'core_setup');
$setup->updateAttribute('catalog_product', 'aitmanufacturers_sort', 'used_for_sort_by', 1);

$installer->endSetup();