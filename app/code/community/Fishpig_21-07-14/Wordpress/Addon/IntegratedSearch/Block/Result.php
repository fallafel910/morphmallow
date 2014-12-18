<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_IntegratedSearch_Block_Result extends Fishpig_Wordpress_Block_Search_Result
{
	/**
	 * Retrieve the tab data
	 *
	 * @return array
	 */
	public function getTabData()
	{
		if (!$this->hasTabData()) {
			$tabs = array(
					array(
					'alias' => 'product',
					'html' => trim($this->getChildHtml('search_result_list')),
					'title' => $this->__('Products'),
				),
				array(
					'alias' => 'blog',
					'html' => trim($this->getPostListHtml()),
					'title' => $this->__('Posts'),
				),
			);
			
			$isFirst = false;
			
			foreach($tabs as $key => $tab) {
				$html = trim(preg_replace('/<p class="note-msg">.*<\/p>/Ui', '', $tab['html']));
				
				if ($html === '') {
					unset($tabs[$key]);
					continue;
				}
				
				$tabs[$key] = new Varien_Object($tab);
			}
			
			if (count($tabs) > 0) {
				$tabs = array_values($tabs);
				
				// Set first tab
				$tabs[0]->setIsFirst(true);
				
				$this->setTabData($tabs);
			}
			else {
				$this->setTabData(false);
			}
		}
		
		return $this->_getData('tab_data');
	}
}
