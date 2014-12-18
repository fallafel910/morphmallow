<?php

class Nextend_SmartSlider2_Model_Resource_Setup extends Mage_Core_Model_Resource_Setup {
    protected $_callAfterApplyAllUpdates = true;
    
    public function afterApplyAllUpdates(){
        $query = str_replace('#__', Mage::getConfig()->getTablePrefix(), "UPDATE `#__nextend_smartslider_storage` SET value = 1 WHERE `key` LIKE 'sliderchanged%'");
        $this->run($query);
        return $this;
    }
} 