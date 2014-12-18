<?php

class Nextend_Nextend_Adminhtml_NextendlibraryController extends Mage_Adminhtml_Controller_Action {

    public function ajaxAction() {
        require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Library'.DIRECTORY_SEPARATOR.'library.php' );
        nextendimport('nextend.ajax.ajax');
    }

}