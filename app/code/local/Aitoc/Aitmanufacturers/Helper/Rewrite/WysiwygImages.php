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
 * @copyright  Copyright (c) 2011 AITOC, Inc.
 *
 * @author lyskovets
 */
class Aitoc_Aitmanufacturers_Helper_Rewrite_WysiwygImages extends Mage_Cms_Helper_Wysiwyg_Images 
{
    public function getStorageRoot()
    {
        $currVersion = Mage::getVersion();
        if (version_compare($currVersion, '1.4.2.0', 'gt'))
        {
            return Mage::getConfig()->getOptions()->getMediaDir() . DS . $this->_getImageFolderPath()
            . DS;
        }
        else
        {
            return Mage::getConfig()->getOptions()->getMediaDir(). DS;
        }    
    }
    
    private function _getImageFolderPath()
    {
        //$folderPath = Mage_Cms_Model_Wysiwyg_Config::IMAGE_DIRECTORY;
        $folderPath ='.';
        return $folderPath;
    }
}