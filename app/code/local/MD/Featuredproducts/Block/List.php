<?php

class MD_FeaturedProducts_Block_List extends Mage_Catalog_Block_Product_List
{
	protected $_productCollection;
	protected $_sort_by;

    const XML_PATH_QUICK     = 'featuredproducts/viewsetting/enableview';
	const XML_PATH_LIBRARY     = 'featuredproducts/viewsetting/library';
    const XML_PATH_DIALOG_WIDTH     = 'featuredproducts/viewsetting/dialog_width';
    const XML_PATH_DIALOG_HEIGHT    = 'featuredproducts/viewsetting/dialog_height';
    const XML_PATH_IS_MODAL         = 'featuredproducts/viewsetting/is_modal';

    /**
     * Get dialog width
     * @return int
     */
    public function getDialogWidth()
    {
        return Mage::getStoreConfig(self::XML_PATH_DIALOG_WIDTH);
    }    
	

    /**
     * Get dialog height
     *
     * @return int
     */

    public function getDialogHeight()
    {
        return Mage::getStoreConfig(self::XML_PATH_DIALOG_HEIGHT);
    }
	
	/**
     * Get library
     *
     * @return int
     */

    public function getLibrary()
    {
        return Mage::getStoreConfig(self::XML_PATH_LIBRARY);
    }

	
	
    public function getQuickview()
    {
        return Mage::getStoreConfig(self::XML_PATH_QUICK);
    }
    /**
     * Get is modal
     *
     * @return string
     */
    public function getIsModal()
    {
        return (Mage::getStoreConfig(self::XML_PATH_IS_MODAL) == '1' ? 'true' : 'false');
    }
    
        protected function _prepareLayout()
        {
            // if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                // $breadcrumbsBlock->addCrumb('home', array(
                    // 'label'=>Mage::helper('catalog')->__('Home'),
                    // 'title'=>Mage::helper('catalog')->__('Go to Home Page'),
                    // 'link'=>Mage::getBaseUrl()
                // ));
            // }    
                            
            parent::_prepareLayout();
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