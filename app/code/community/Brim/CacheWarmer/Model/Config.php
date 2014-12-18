<?php
/**
 * Brim LLC Commercial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Brim LLC Commercial Extension License
 * that is bundled with this package in the file Brim_CacheWarmer-license.pdf.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.brimllc.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@brimllc.com so we can send you a copy immediately.
 *
 * @category   Brim
 * @package    Brim_CacheWarmer
 * @copyright  Copyright (c) 2011-2014 Brim LLC
 * @license    http://ecommerce.brimllc.com/license
 */
class Brim_CacheWarmer_Model_Config {

    public function getActiveSources() {
        $allSources = $this->getCachewarmerSources();

        $activeCodes = Mage::getStoreConfig('brim_cachewarmer/general/sources');

        $activeCodes = explode(',', $activeCodes);

        $activeSources = array();
        foreach ($activeCodes as $code) {
            if (isset($allSources[$code])) {
                $activeSources[] = $allSources[$code];
            }
        }

        return $activeSources;
    }

    public function getCachewarmerSources() {
        $config = Mage::getConfig();

        $config->loadModules();

        $obj = $config->loadModulesConfiguration('cachewarmer.xml');
        $obj = $config->loadModulesConfiguration('cachewarmer.local.xml', $obj);

        $configArray = $obj->getNode()->asArray();
        $sources = $configArray['cachewarmer']['sources'];

        return $sources;
    }

}