<?php
class Mirasvit_Sync_Model_Config
{
  public function getGeneralApiKey($store = null)
  {
    return Mage::getStoreConfig('sync/general/api_key', $store);
  }
}