<?php
class Mirasvit_Sync_Exception extends Mage_Core_Exception {}

class Mirasvit_Sync_IndexController extends Mage_Core_Controller_Front_Action
{
    const CATEGORY_SEPARATOR = ' > ';

    public function preDispatch()
    {
        parent::preDispatch();
        $this->_auth();
    }

    protected function _auth()
    {
    	$api_key = $this->getRequest()->getParam('api_key');
    	if ($api_key !== Mage::getSingleton('sync/config')->getGeneralApiKey()) {
	        $result = array(
	            'status'     => 'error',
	            'error_code' => 'wrong_key',
	        );
	        echo json_encode($result);
	        die;
    	}
    }

 	public function indexAction()
    {
        try {
            $data = array();
            switch ($this->getRequest()->getParam('action')) {
                case 'size':
                    $data = $this->_size();
                    break;

                case 'receive':
                    $data = $this->_receive();
                    break;

                case 'update_prices':
                    $data = $this->_update_prices();
                    break;
            }

            $result = array(
                'status'     => 'success',
                'error_code' => '0',
                'data'       => $data,
            );
        } catch (Mirasvit_Sync_Exception $e) {
            $result = array(
                'status'     => 'error',
                'error_code' => $e->getMessage()
            );
        }
        echo json_encode($result);
    }

    protected function _size()
    {
        return $this->_getCollection()->getSize();
    }

 	protected function _receive()
    {
        set_time_limit (1800);
        $pageNum = (int)$this->getRequest()->getParam('page');
        $count   = (int)$this->getRequest()->getParam('per_page');

        $collection = $this->_getCollection()->setPage($pageNum + 1, $count);
            // ->addFieldToFilter('entity_id', 418);

        $output = array();

        foreach ($collection as $productModel) {
            $product      = array();
            $productModel = Mage::getModel('catalog/product')->load($productModel->getId());
            
            $product = $this->getBaseProductData($productModel);

            switch ($productModel->getTypeId()) {
                case 'simple':
                    break;
                case 'bundle':
                    break;
                case 'configurable':
                    break;
                case 'grouped':
                    break;
            }

            $output[] = $product;
        }

        return $output;
    }

    public function getBaseProductData($productModel)
    {
        $data = array(
            'external_id' => $productModel->getId(),
            'sku'         => $productModel->getData('sku'),
            'name'        => $productModel->getData('name'),
            'price'       => $productModel->getData('price'),
            'product_url' => Mage::helper('catalog/product')->getProductUrl($productModel->getId()),
            'image_url'   => Mage::helper('catalog/image')->init($productModel, 'image')->__toString(),
        );

        // Category Breadcrumb
        $categoryIds = $productModel->getCategoryIds();

        if (!empty($categoryIds)) {
            $categoryBreadcrumb = array();
            foreach($categoryIds as $categoryId) {
                $category = Mage::getModel('catalog/category')->load($categoryId);
                $categoryBreadcrumb[] = $category->getName();

                while ($category && $category->getParentId()) {
                    $category = Mage::getModel('catalog/category')->load($category->getParentId());
                    if ($category->getIsActive()) {
                        $categoryBreadcrumb[] = trim(str_replace('>',  ' ', $category->getName()));
                    }
                }

                break;
            }

            $categoryBreadcrumb = array_reverse($categoryBreadcrumb);

            $data['category'] = implode(self::CATEGORY_SEPARATOR, $categoryBreadcrumb);
        }

        // Attribute Set Name
        $attributeSet = Mage::getModel('eav/entity_attribute_set')->load($productModel->getAttributeSetId());
        if ($attributeSet) {
            $attributeSetName = $attributeSet->getAttributeSetName();
            $data['properties']['Attribute Set Name'] = array('value' => $attributeSetName, 'type' => 'options');
        }

        // Standart Attributes
        $attributes = $productModel->getAttributes();
        foreach ($attributes as $attribute) {
            try {
                $value = $attribute->getFrontend()->getValue($productModel);

                if (!$productModel->hasData($attribute->getAttributeCode())) {
                    $value = null;
                } elseif ((string) $value == '') {
                    $value = null;
                }

                if (is_string($value) && strlen(trim($value)) > 0 && $attribute->getStoreLabel() && $attribute->getIsVisible()) {
                    if (!isset($data[$attribute->getAttributeCode()])) {
                        if ($attribute->getFrontendInput() == 'media_image') {
                            continue;
                        }
                        if ($attribute->usesSource()) {
                            $data['properties'][$attribute->getStoreLabel()]['type'] = 'options';
                        } elseif ($attribute->getFrontendInput() == 'price') {
                            $data['properties'][$attribute->getStoreLabel()]['type'] = 'number';
                        } else {
                            $data['properties'][$attribute->getStoreLabel()]['type'] = 'text';
                        }
                        $data['properties'][$attribute->getStoreLabel()]['value'] = $value;
                    }
                }
            } catch (Exception $e) {}
        }

        // Is in stock & qty
        $inventoryStatus = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productModel);
        if ($inventoryStatus) {
            $data['properties']['Stock Quantity'] = array('value' => intval($inventoryStatus->getQty()), 'type' => 'number');

            $data['stock_status'] = $inventoryStatus->getIsInStock();
        }

        $data['properties']['Product Type'] = array('value' => $productModel->getTypeId(), 'type' => 'options');


        $imageIndx = 1;
        foreach ($productModel->getMediaGalleryImages() as $image) {
            $data['properties']['Gallery Image '.$imageIndx] = array('value' => $image->getUrl(), 'type' => 'text');
            $imageIndx++;
        }

        return $data;
    }

    protected function _getCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addFieldToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED);

        return $collection;
    }
}