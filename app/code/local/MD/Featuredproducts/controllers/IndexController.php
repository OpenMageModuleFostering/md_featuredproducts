<?php

class MD_FeaturedProducts_IndexController extends Mage_Core_Controller_Front_Action
{
	/*
	 * Check settings set in System->Configuration and apply them for featured-products page
	 * */
	public function indexAction()
	{
		$this->loadLayout();
		$this->getLayout()->getBlock('head')->setTitle($this->__(Mage::getStoreConfig("featuredproducts/general/meta_title")));
		$this->getLayout()->getBlock('head')->setDescription($this->__(Mage::getStoreConfig("featuredproducts/general/meta_description")));
		$this->getLayout()->getBlock('head')->setKeywords($this->__(Mage::getStoreConfig("featuredproducts/general/meta_keywords")));
		
                $breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs');
                $breadcrumbsBlock->addCrumb('featured_products', array(
                    'label'=>Mage::helper('featuredproducts')->__(Mage::helper('featuredproducts')->getPageLabel()),
                    'title'=>Mage::helper('featuredproducts')->__(Mage::helper('featuredproducts')->getPageLabel()),
                ));
                
		$this->renderLayout();
	}
}