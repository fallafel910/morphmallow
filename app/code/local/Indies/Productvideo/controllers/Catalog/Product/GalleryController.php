<?php

include_once("Mage/Adminhtml/controllers/Catalog/Product/GalleryController.php");
class Indies_Productvideo_Catalog_Product_GalleryController extends Mage_Adminhtml_Catalog_Product_GalleryController
{
    public function uploadAction()
    {
      	
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
    	try {
		
		
        $fileName = $_FILES['file']['name'];
        $uploader = new Varien_File_Uploader('file');
        $uploader->setAllowedExtensions(array('flv','png')); //allowed extensions
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $path = Mage::getBaseDir('media') . DS . 'productvideo';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
       	$uploader->save($path,$fileName);
	    $result['file'] =$fileName;
        } 
		catch (Exception $e) 
		{
       	   $result = array(
                'error' => $e->getMessage(),
                'errorcode' => $e->getCode());
     	}
		 $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result)); 
	  }
	  else 
	  {
	  	parent::uploadAction();
	  }
	  
	  
	  
	
        
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/products');
    }

	
} 
