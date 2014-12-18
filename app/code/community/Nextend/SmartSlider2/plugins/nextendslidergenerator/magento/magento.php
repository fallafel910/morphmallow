<?php

nextendimportsmartslider2('nextend.smartslider.settings');
nextendimportsmartslider2('nextend.smartslider.check');

class plgNextendSliderGeneratorMagento extends NextendPluginBase {

    public static $_group = 'magento';

    function onNextendSliderGeneratorList(&$group, &$list, $showall = false) {
        if ($showall || smartsliderIsFull()) {
            $group[self::$_group] = 'Magento';

            if (!isset($list[self::$_group]))
                $list[self::$_group] = array();
            $list[self::$_group][self::$_group . '_product'] = array('Product', $this->getPath() . 'product' . DIRECTORY_SEPARATOR, true, true, true, 'product');
        }
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }

}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorMagento');
