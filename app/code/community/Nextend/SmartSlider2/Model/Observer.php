<?php

class Nextend_SmartSlider2_Model_Observer {

    static $sliders = array();

    function buildCSS(){
        if(count(self::$sliders)){
            foreach(self::$sliders AS $callable){
                if(is_callable($callable)){
                    call_user_func($callable);
                }else{
                    $css = NextendCss::getInstance();
                    foreach(self::$sliders AS $id){
                        $css->generateCSS($id);
                    }
                }
            } 
        }
    }
}