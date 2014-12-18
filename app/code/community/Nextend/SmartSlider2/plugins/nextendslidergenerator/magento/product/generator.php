<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorMagento_Product extends NextendGeneratorAbstract {

    function NextendGeneratorMagento_Product($data) {
        parent::__construct($data);
        $this->_variables = array(
            'sku' => NextendText::_('Product SKU'),
            'title' => NextendText::_('Product name'),
            'image' => NextendText::_('Product image'),
            'thumbnail' => NextendText::_('Product image'),
            'description' => NextendText::_('Product description'),
            'short_description' => NextendText::_('Product short description'),
            'price' => NextendText::_('Product price'),
            'final_price' => NextendText::_('Product final price'),
            'url' => NextendText::_('Product url'),
            'addtocart' => NextendText::_('Product - Add to cart url'),
            'wishlist_url' => NextendText::_('Product - Add to wishlist url'),
            'tax_class_id' => NextendText::_('Product tax class'),
            'status' => NextendText::_('Product status'),
            'category_name' => NextendText::_('Product\'s category name'),
            'category_url' => NextendText::_('Product\'s category url')
        );
        
        $attributes = Mage::getResourceModel('catalog/product_attribute_collection');
        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisibleOnFront() || $attribute->getIsFilterable() || $attribute->getIsSearchable() || $attribute->getIsComparable()) {
                $code = $attribute->getAttributeCode();
                if(!isset($this->_variables[$code]) )$this->_variables[$code] = $attribute->getFrontendLabel();
            }
        }
    }

    function getData($number) {
        $data = array();
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status', array('eq' =>1));
            
        $categories = array_map('intval', explode('||', $this->_data->get('magentocategory', '0')));
        if(is_array($categories) && !in_array(0, $categories)){
            $finset = array();
            foreach($categories AS $cat){
                $finset[] = array('finset' => $cat);
            }
            $collection->joinField('category_id', 'catalog/category_product', 'category_id', 'product_id = entity_id', null, 'left');
            $collection->addAttributeToFilter('category_id', array('in' => $finset) );
        }
        
        $producttype = explode('||', $this->_data->get('magentoproducttype', '0'));
        if(is_array($producttype) && !in_array('0', $producttype)){
            $collection->addAttributeToFilter('type_id', array('in' => $producttype));
        }
        
        $attributeset = array_map('intval', explode('||', $this->_data->get('magentoattributeset', '0')));
        if(is_array($attributeset) && !in_array(0, $attributeset)){
            $collection->addAttributeToFilter('attribute_set_id', array('in' => $attributeset) );
        }
        
        if($this->_data->get('magentoonsale', '0')){
            $dateToday = date('m/d/y');
            $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('y'));
            $dateTomorrow = date('m/d/y', $tomorrow);
            
            $collection->addAttributeToFilter('special_price', array('gt' => 0))
                ->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $dateToday))
                ->addAttributeToFilter('special_to_date', array('or'=> 
                array(
                    0 => array('date' => true, 'from' => $dateTomorrow),
                    1 => array('is' => new Zend_Db_Expr('null'))
                )), 'left');
        }
        
        $order = NextendParse::parse($this->_data->get('magentoorder', 'price|*|desc'));
        if ($order[0]) {
            if($order[0] == 'rand') $order[0] = 'rand()';
            $collection->addAttributeToSort($order[0], $order[1]);
            $order = NextendParse::parse($this->_data->get('magentoorder2', 'name|*|asc'));
            if ($order[0]) {
                if($order[0] == 'rand') $order[0] = 'rand()';
                $collection->addAttributeToSort($order[0], $order[1]);
            }
        }
        
        $collection->setPageSize($number);
        
        $imagesize = array_map('intval', NextendParse::parse($this->_data->get('magentoimagesize', '0|*|0')));
        $i = 0;
        foreach ($collection as $product) {
            $categoryIds = $product->getCategoryIds();
            if(count($categoryIds)){
                $category = Mage::getModel('catalog/category')->load($categoryIds[0]);
            }else{
                $category = Mage::getModel('catalog/category')->load(0);
            }
            $image = '';
            if($product->getImage() != 'no_selection'){
                if($imagesize[0] > 0 && $imagesize[1] > 0){
                    $image = Mage::helper('catalog/image')->init($product, 'image')->resize($imagesize[0], $imagesize[1]);
                }else{
                    $image = $product->getImageUrl();
                }
            }
            
            $data[$i] = array_map('strval', array(
                'title' => $product->getName(),
                'description' => $product->getDescription(),
                'short_description' => $product->getShortDescription(),
                'final_price' => Mage::helper('core')->currency($product->getFinalPrice()),
                'url' => '[url '.$product->getId().']',
                'addtocart' => '[addtocart '.$product->getId().']',
                'wishlist_url' => '[wishlist_url '.$product->getId().']',
                'image' => $image,
                'thumbnail' => $image,
                'category_name' => $category->getName(),
                'category_url' => '[category_url '.$category->getId().']',
                'addtocart_label' => 'Add to cart'
            ));
            
            $attributes = $product->getAttributes();
            foreach ($attributes as $attribute) {
                if ($attribute->getIsVisibleOnFront() || $attribute->getIsFilterable() || $attribute->getIsSearchable() || $attribute->getIsComparable()) {
                    $data[$i][$attribute->getAttributeCode()] = $attribute->getFrontend()->getValue($product);
                }
            }
            
            $data[$i]['price'] = Mage::helper('core')->currency($product->getPrice());
            
            $i++;
        }
        
        return $data;
    }
}