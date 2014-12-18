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
class Brim_CacheWarmer_Model_System_Config_Backend_Cron extends Mage_Core_Model_Config_Data
{
    const CRON_PATH  = 'crontab/jobs/brim_cachewarmer_crawl/schedule/cron_expr';

    protected function _afterSave()
    {
        if ($this->getData('groups/general/fields/enable/value')) {
            $cronScheduleExpr = $this->getValue();
        } else {
            $cronScheduleExpr = '';
        }

        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_PATH, 'path')
                ->setValue($cronScheduleExpr)
                ->setPath(self::CRON_PATH)
                ->save();
        } catch (Exception $e) {
            Mage::throwException(Mage::helper('brim_cachewarmer')->__('Unable to save the cron schedule.'));
        }
    }
}
