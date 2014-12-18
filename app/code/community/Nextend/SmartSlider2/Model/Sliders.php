<?php

class Nextend_SmartSlider2_Model_Sliders {
    public function toOptionArray(){
        require_once(dirname(__FILE__).'/../../Library/library.php' );
        defined('NEXTEND_SMART_SLIDER2_ASSETS') || define('NEXTEND_SMART_SLIDER2_ASSETS', NEXTENDLIBRARYASSETS . 'smartslider' . DIRECTORY_SEPARATOR );
        nextendimportsmartslider2('nextend.smartslider.admin.models.sliders');
        $model = new NextendSmartsliderAdminModelSliders();
        $sliders = $model->getSliders();
        
        $return = array();
        foreach($sliders AS $slider){
            $return[] = array('value' => $slider['id'], 'label' => $slider['title']);
        }
        
        return $return;
    }
}