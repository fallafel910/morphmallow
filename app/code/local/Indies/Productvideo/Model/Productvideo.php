<?php
class Indies_Productvideo_Model_Productvideo extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('productvideo/productvideo');
    }
}