<?php
/**
 * @category    AntoineK
 * @package     AntoineK_MediaChooserField
 * @copyright   Copyright (c) 2013 Antoine Kociuba (http://www.antoinekociuba.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Antoine Kociuba
 */
require_once 'Mage/Adminhtml/controllers/Cms/Wysiwyg/ImagesController.php';

class Nextend_Nextend_Adminhtml_Cms_Wysiwyg_Images_ChooserController extends Mage_Adminhtml_Cms_Wysiwyg_ImagesController
{

    /**
     * Fire when select image.
     *
     * @return void
     */
    public function onInsertAction()
    {
        $helper = Mage::helper('cms/wysiwyg_images');
        $storeId = $this->getRequest()->getParam('store');

        $filenameParam = $this->getRequest()->getParam('filename');
        $filename = $helper->idDecode($filenameParam);

        Mage::helper('catalog')->setStoreId($storeId);
        $helper->setStoreId($storeId);

        $fileUrl = $helper->getCurrentUrl() . $filename;

        $this->getResponse()->setBody($fileUrl);
    }

}