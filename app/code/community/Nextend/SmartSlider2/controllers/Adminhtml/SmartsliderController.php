<?php

class Nextend_SmartSlider2_Adminhtml_SmartsliderController extends Mage_Adminhtml_Controller_Action{

    public function initNextend(){
        require_once(dirname(__FILE__).'/../../../Library/library.php' );
        defined('NEXTEND_SMART_SLIDER2_ASSETS') || define('NEXTEND_SMART_SLIDER2_ASSETS', NEXTENDLIBRARYASSETS . 'smartslider' . DIRECTORY_SEPARATOR );
        nextendimportsmartslider2('nextend.smartslider.admin.controller');
        require_once(dirname(__FILE__).'/../../plugins/loadplugin.php' );
    }
    
    
    public function indexAction(){
        $this->initNextend();
        
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function ajaxAction() {
        $this->initNextend();
        new NextendSmartsliderAdminController(null);
        nextendimport('nextend.ajax.ajax');
    }
}