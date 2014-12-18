<?php

class Indies_Productvideo_Block_Adminhtml_Catalog_Product_Tab extends Mage_Adminhtml_Block_Template
implements Mage_Adminhtml_Block_Widget_Tab_Interface{
 	
	
	public function _construct()
    {
       parent::_construct();
	   $this->setTemplate('productvideo/catalog/product/tab.phtml');
	    $this->getConfig()->setUrl(Mage::getModel('adminhtml/url')->addSessionParam()->getUrl('*/catalog_product_gallery/upload'));
       
		$this->getConfig()->setParams(array('form_key' => $this->getFormKey()));
        $this->getConfig()->setFileField('file');
        $this->getConfig()->setFilters(array(
            
            'images' => array(
                'label' => Mage::helper('adminhtml')->__('Images (.png)'),
                'files' => array('*.png')
            ),
            'media' => array(
                'label' => Mage::helper('adminhtml')->__('Media (.flv)'),
                'files' => array('*.avi', '*.flv', '*.swf')
            )
           
	     ));
		
		
    }
     
    /**
     * Retrieve the label used for the tab relating to this block
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Product Video');
    }
     
    /**
     * Retrieve the title used by this tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Click here to view your custom tab content');
    }
     
    /**
     * Determines whether to display the tab
     * Add logic here to decide whether you want the tab to display
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }
     
    /**
     * Stops the tab being hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
    protected function _prepareLayout()
    {
        $this->setChild(
            'browse_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                    'id'      => $this->_getButtonId('browse'),
                    'label'   => Mage::helper('adminhtml')->__('Browse Files...'),
                    'type'    => 'button',
                    'onclick' => $this->getJsObjectName() . '.browse()'
                ))
        );

        $this->setChild(
            'upload_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                    'id'      => $this->_getButtonId('upload'),
                    'label'   => Mage::helper('adminhtml')->__('Upload Files'),
                    'type'    => 'button',
                    'onclick' => $this->getJsObjectName() . '.upload()'
                ))
        );

        $this->setChild(
            'delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->addData(array(
                    'id'      => '{{id}}-delete',
                    'class'   => 'delete',
                    'type'    => 'button',
                    'label'   => Mage::helper('adminhtml')->__('Remove'),
                    'onclick' => $this->getJsObjectName() . '.removeFile(\'{{fileId}}\')'
                ))
        );
		  $this->setChild('uploader',
            $this->getLayout()->createBlock('adminhtml/media_uploader')
        );

       
          
    }
	public function getFlexFileInfo()
	{
		 return $this->getJsObjectName(). '.getFilesInfo()';
		
	}

	 public function getId()
    {
        if ($this->getData('id')===null) {
            $this->setData('id', Mage::helper('core')->uniqHash('id_'));
        }
        return $this->getData('id');
    }

    public function getHtmlId()
    {
        return $this->getId();
    }
    protected function _getButtonId($buttonName)
    {
        return 'productvideo' . '-' . $buttonName;
    }

    public function getBrowseButtonHtml()
    {
        return $this->getChildHtml('browse_button');
    }


    public function getUploadButtonHtml()
    {
        return $this->getChildHtml('upload_button');
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    /**
     * Retrive uploader js object name
     *
     * @return string
     */
    public function getJsObjectName()
    {
        return 'productvideo'. 'JsObject';
    }

    /**
     * Retrive config json
     *
     * @return string
     */
    public function getConfigJson()
    {
        return Mage::helper('core')->jsonEncode($this->getConfig()->getData());
    }

    /**
     * Retrive config object
     *
     * @return Varien_Config
     */
    public function getConfig()
    {
        if(is_null($this->_config)) {
            $this->_config = new Varien_Object();
        }

        return $this->_config;
    }

    public function getPostMaxSize()
    {
        return ini_get('post_max_size');
    }

    public function getUploadMaxSize()
    {
		return ini_get('upload_max_filesize');
		
    }

    public function getDataMaxSize()
    {
        return min('100M','100M');
    }

    public function getDataMaxSizeInBytes()
    {
        $iniSize = $this->getDataMaxSize();
        $size = substr($iniSize, 0, strlen($iniSize)-1);
        $parsedSize = 0;
        switch (strtolower(substr($iniSize, strlen($iniSize)-1))) {
            case 't':
                $parsedSize = $size*(1024*1024*1024*1024);
                break;
            case 'g':
                $parsedSize = $size*(1024*1024*1024);
                break;
            case 'm':
                $parsedSize = $size*(1024*1024);
                break;
            case 'k':
                $parsedSize = $size*1024;
                break;
            case 'b':
            default:
                $parsedSize = $size;
                break;
        }
        return $parsedSize;
    }

    /**
     * Retrieve full uploader SWF's file URL
     * Implemented to solve problem with cross domain SWFs
     * Now uploader can be only in the same URL where backend located
     *
     * @param string $url url to uploader in current theme
     *
     * @return string full URL
     */
    public function getUploaderUrl($url)
    {
        if (!is_string($url)) {
            $url = '';
        }
        $design = Mage::getDesign();
        $theme = $design->getTheme('skin');
        if (empty($url) || !$design->validateFile($url, array('_type' => 'skin', '_theme' => $theme)))        {
              $theme = $design->getDefaultTheme();
        }
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB) . 'skin/' .
            $design->getArea() . '/' . $design->getPackageName() . '/' . $theme . '/' . $url;
    }
}