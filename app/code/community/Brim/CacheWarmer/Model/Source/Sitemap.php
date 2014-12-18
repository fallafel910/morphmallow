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

class Brim_CacheWarmer_Model_Source_Sitemap extends Brim_CacheWarmer_Model_Source_Abstract {

    protected $_index       = 0;

    protected $_sitemaps    = array();

    protected $_sitemapCount= 0;

    protected $_urls        = array();

    function __construct($params=array()) {

        parent::__construct($params);

        $sitemapCollection = Mage::getResourceModel('sitemap/sitemap_collection');

        $this->addStoreFilter($sitemapCollection);

        foreach ($sitemapCollection as $sitemap) {
            $this->_sitemaps[] = $this->constructUrl(
                $sitemap->getSitemapPath() . $sitemap->getSitemapFilename(),
                $sitemap->getStoreId()
            );
        }
        $this->_sitemapCount = count($this->_sitemaps);
    }

    public function next() {

        if (($url = array_pop($this->_urls)) === null) {
            if ($this->_index < $this->_sitemapCount) {
                $sitemapUrl = $this->_sitemaps[$this->_index++];

                $sxml = simplexml_load_file($sitemapUrl);

                foreach ($sxml->url as $sUrl) {
                    array_push($this->_urls, (string)$sUrl->loc);
                }

                $url = array_pop($this->_urls);
            }
        }

        return $url;
    }

    function __destruct() {
    }
}