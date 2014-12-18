<?php

class Nextend_SmartSlider2_Block_Slider extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface {
    
    var $products = array();
    var $categories = array();
    
    protected function _toHtml() {
        $slider = $this->getData('slider');
        require_once(dirname(__FILE__).'/../../Library/library.php' );
        defined('NEXTEND_SMART_SLIDER2_ASSETS') || define('NEXTEND_SMART_SLIDER2_ASSETS', NEXTENDLIBRARYASSETS . 'smartslider' . DIRECTORY_SEPARATOR );
        require_once(dirname(__FILE__).'/../plugins/loadplugin.php' );
        
        nextendimportsmartslider2('nextend.smartslider.slidercache');
        nextendimportsmartslider2('nextend.smartslider.magento.slider');
        
        $params = new NextendData();
        
        ob_start();
        new NextendSliderCache(new NextendSliderMagento(intval($slider), $params, dirname(__FILE__)));
        
        return preg_replace_callback('/\[([a-z_]+) ([0-9]+)\]/', array($this, 'makeUrl'), ob_get_clean());
    }
    
    public function makeUrl($out){
        $id = intval($out[2]);
        if($id){
            switch($out[1]){
                case 'url':
                    return $this->getProduct($id)->getProductUrl();
                    break;
                case 'addtocart':
                    return Mage::helper('checkout/cart')->getAddUrl($this->getProduct($id));
                    break;
                case 'wishlist_url':
                    return Mage::helper('wishlist')->getAddUrl($this->getProduct($id));
                    break;
                case 'category_url':
                    return $this->getCategory($id)->getUrl();
                    break;
            }
        }
        return '#';
    }
    
    private function getProduct($id){
        if(!isset($this->products[$id])){
            $this->products[$id] = Mage::getModel('catalog/product')->load($id);
        }
        return $this->products[$id];
    }
    
    private function getCategory($id){
        if(!isset($this->categories[$id])){
            $this->categories[$id] = Mage::getModel('catalog/category')->load($id);
        }
        return $this->categories[$id];
    }
    
     public function getCacheLifetime() {
        return null;
    } 

}
