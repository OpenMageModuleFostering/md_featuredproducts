<?php

class MD_FeaturedProducts_Block_Product_List extends Mage_Catalog_Block_Product_List
{
	protected $_productCollection;
	protected $_sort_by;
   
	protected function _prepareLayout()
	{
		if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
			$breadcrumbsBlock->addCrumb('home', array(
				'label'=>Mage::helper('catalog')->__('Home'),
				'title'=>Mage::helper('catalog')->__('Go to Home Page'),
				'link'=>Mage::getBaseUrl()
			));
		}    
						
		parent::_prepareLayout();
	}
     public function stripTags($data, $allowableTags = null, $allowHtmlEntities = false)
    {
        return $this->_stripTags($data, $allowableTags, $allowHtmlEntities);
    }
    public function _stripTags($data, $allowableTags = null, $escape = false)
    {
        $result = strip_tags($data, $allowableTags);
        return $escape ? $this->escapeHtml($result, $allowableTags) : $result;
    }	
	/*
	 * Remove "Position" option from Sort By dropdown
	 * */
	protected function _beforeToHtml()
	{
		parent::_beforeToHtml();
		$toolbar = $this->getToolbarBlock();
		$toolbar->removeOrderFromAvailableOrders('position');
		return $this;
	}


	/*
	 * Load featured products collection
	 * */
	protected function _getProductCollection()
	{
		if (is_null($this->_productCollection)) {
                    $collection = Mage::getModel('catalog/product')->getCollection();

			$attributes = Mage::getSingleton('catalog/config')
				->getProductAttributes();

			$collection->addAttributeToSelect($attributes)
				->addMinimalPrice()
				->addFinalPrice()
				->addTaxPercents()
				->addAttributeToFilter('md_featured_product', 1, 'left')
				->addStoreFilter();

			Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
			Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
			$this->_productCollection = $collection;
		}
		return $this->_productCollection;
}

    /**
     * Retrieve loaded featured products collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function getFeaturedProductCollection()
    {
        return $this->_getProductCollection();
    }

	 public function getColumgrid()
    {
        return Mage::getStoreConfig("featuredproducts/general/number_of_itemsgrid");
    }


   /**
     * Get HTML if there's anything to show
     */
	protected function _toHtml()
	{
		if ($this->_getProductCollection()->count()){
			return parent::_toHtml();
		}
		return '';
	}

}