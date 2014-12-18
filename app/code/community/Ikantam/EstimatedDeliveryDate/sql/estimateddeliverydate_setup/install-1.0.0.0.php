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

$installer = $this;
/** @var $installer Mage_Catalog_Model_Resource_Setup */

$installer->startSetup();

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'estimated_delivery_date', array(
    'group'             => 'General',
    'type'              => 'varchar',
    'backend'           => '',
    'frontend'          => '',
    'label'             => 'Estimated Delivery Date',
    'input'             => 'text',
    'class'             => '',
    'source'            => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => true,
    'unique'            => false,
    'apply_to'          => 'simple,configurable,bundle,grouped',
    'is_configurable'   => false,
));
$installer->endSetup();
