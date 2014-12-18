<?php

class Nextend_Nextend_Model_Observer {

    public function buildCSSJS($observer){
        $NextendCss = class_exists('NextendCss', false);
        $NextendJavascript = class_exists('NextendJavascript', false);
        if($NextendCss || $NextendJavascript){
            ob_start();
            Mage::dispatchEvent('nextend_css_js');
            if($NextendCss){
                $css = NextendCss::getInstance();
                $css->generateCSS();
            }
            if($NextendJavascript){
                $js = NextendJavascript::getInstance();
                $js->generateJs();
            }
            $head = ob_get_clean();
            $response = $observer->getResponse();
            $response->setBody(preg_replace('/<\/head>/' , $head.'</head>' , $response->getBody(), 1));
        }
    }

}