<?php
/**
 * Mageix_StoreLocator extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mageix
 * @package    Mageix_ExtensionManager
 * @copyright  Copyright (c) 2011 Mageix LLC
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @category   Mageix
 * @package    Mageix_ExtensionManager
 * @author     Mageix<support@mageix.com>
 */
class Mageix_ExtensionManager_Block_Adminhtml_Module_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('modulesGrid');
        $this->setDefaultSort('module_name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('module_filter');
    }

    protected function _prepareLayout()
    {
        $this->setChild('check_updates_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('mextensionmanager')->__('Check For Updates'),
                    'onclick'   => "location.href = '{$this->getUrl('mextensionmanageradmin/adminhtml_module/checkUpdates')}'",
                    'class'     => 'save',
                ))
        );
        return parent::_prepareLayout();
    }

    public function getMainButtonsHtml() {
        return parent::getMainButtonsHtml().$this->getChildHtml('check_updates_button');
    }

    protected function _prepareCollection()
    {
        //Mage::helper('mextensionmanager')->refreshMeta();
        $this->setCollection(Mage::getModel('mextensionmanager/module')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('module_name', array(
            'header'    => Mage::helper('mextensionmanager')->__('Module'),
            'index'     => 'module_name',
        ));


        $this->addColumn('last_downloaded', array(
            'header'    => Mage::helper('mextensionmanager')->__('Last Downloaded'),
            'index'     => 'last_downloaded',
            'type'      => 'datetime',
            'width'     => '160px',
        ));

        $this->addColumn('current_version', array(
            'header'    => Mage::helper('mextensionmanager')->__('Installed'),
            'index'     => 'current_version',
            'width'     => '50px',
            'renderer'  => 'mextensionmanager/adminhtml_module_version',
        ));

        $this->addColumn('last_checked', array(
            'header'    => Mage::helper('mextensionmanager')->__('Last Checked'),
            'index'     => 'last_checked',
            'type'      => 'datetime',
            'width'     => '160px',
        ));

/*
        $this->addColumn('last_stability', array(
            'header'    => Mage::helper('mextensionmanager')->__('Last Stability'),
            'index'     => 'module_name',
            'width'     => '80px',
        ));
*/

        $this->addColumn('remote_version', array(
            'header'    => Mage::helper('mextensionmanager')->__('Available'),
            'index'     => 'remote_version',
            'width'     => '50px',
        ));

        $this->addColumn('module_actions', array(
            'header'    => Mage::helper('cms')->__('Action'),
            'width'     => 70,
            'sortable'  => false,
            'filter'    => false,
            'renderer'  => 'mextensionmanager/adminhtml_module_action',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('module_id');
        $this->getMassactionBlock()->setFormFieldName('modules');
        $this->getMassactionBlock()->addItem('upgrade', array(
             'label'=> Mage::helper('mextensionmanager')->__('Upgrade / Reinstall'),
             'url'  => $this->getUrl('*/*/massUpgrade', array('_current'=>true)),
        ));
        
        $this->getMassactionBlock()->addItem('uninstall', array(
             'label'=> Mage::helper('mextensionmanager')->__('Uninstall'),
             'url'  => $this->getUrl('*/*/massUninstall', array('_current'=>true)),
             'confirm' => Mage::helper('mextensionmanager')->__('Uninstalling selected module(s). Are you sure?')
        ));


        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}
