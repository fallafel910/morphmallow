<?php
class Indies_Productvideo_Model_Observer
{
    /**
     * Flag to stop observer executing more than once
     *
     * @var static bool
     */
    static protected $_singletonFlag = false;

    /**
     * This method will run when the product is saved from the Magento Admin
     * Use this function to update the product model, process the
     * data or anything you like
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveProductTabData(Varien_Event_Observer $observer)
    {
     
	 	
	   $product = $observer->getProduct();
	   $files = array();
       if(is_array($product->getVideos())) 
	   {
       		$baseVideoIndex = 0;	
	    	$getParamOfBaseVideo = Mage::app()->getRequest()->getParam('basevideo');
			foreach($product->getVideos() as $video)
        	{
        		$model = Mage::getModel('productvideo/productvideo');
        		 
				try
        		{
        			if(isset($video['delete']) && $video['delete'])
        			{
					
        				
						$model->setId($video['id']);
        				$model->delete();
        				
					}
        			else
        			{
        			
        		  		if(isset($video['id']) && $video['id'])	$model->setId($video['id']);   
						
						
						if($video['id']=="")
						{
							
							if($getParamOfBaseVideo!== null && $baseVideoIndex == $getParamOfBaseVideo)
							{
									
								$model = Mage::getModel('productvideo/productvideo')
												->setProductId($product->getId())
												->setLabelId(1)
												->setLabel($video['title'])
												->setYoutubeId(trim($video['code']))
												->setBaseImage(1)
												->setVideoHost($video['host'])
												->save();	
												
						
							} else {
								$model = Mage::getModel('productvideo/productvideo')
												->setProductId($product->getId())
												->setLabelId(1)
												->setLabel($video['title'])
												->setYoutubeId(trim($video['code']))
												->setBaseImage(0)
												->setVideoHost($video['host'])
												->save();
												
							}
						
						} else {
		
					 	if($getParamOfBaseVideo == $baseVideoIndex && $getParamOfBaseVideo!== null)
						{
							$model = Mage::getModel('productvideo/productvideo')->load($video['id']); 
									$model->setProductId($product->getId())
												->setLabelId(1)
												->setLabel($video['title'])
												->setYoutubeId(trim($video['code']))
												->setBaseImage(1)
												->setVideoHost($video['host'])
												->save();											
						
							} else {
							$model = Mage::getModel('productvideo/productvideo')->load($video['id']); 
									$model->setProductId($product->getId())
												->setLabelId(1)
												->setLabel($video['title'])
												->setYoutubeId(trim($video['code']))
												->setBaseImage(0)
												->setVideoHost($video['host'])
												->save();		
							}
												
							
						}
					
						
        			}
        		} catch (Mage_Core_Exception $e) {
        			Mage::getSingleton('adminhtml/session')->addError($e->setMessage());
        		} catch (Exception $e)	{
        			Mage::getSingleton('adminhtml/session')->addError(
        			Mage::helper('productvideo')->__('An error occurred while saving the video data. Please review the log and try again.'));
        			Mage::logException($e);
        		}
        		$baseVideoIndex++;
			}
        }
    }
      
    /**
     * Retrieve the product model
     *
     * @return Mage_Catalog_Model_Product $product
     */
    public function getProduct()
    {
        return Mage::registry('product');
    }
     
    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
}