<?php

class MD_FeaturedProducts_Helper_Data extends Mage_Core_Helper_Abstract
{
	const PATH_PAGE_HEADING = 'featuredproducts/general/heading';
	const PATH_CMS_HEADING = 'featuredproducts/general/heading_block';
	const DEFAULT_LABEL = 'Featured Products';

	public function getCmsBlockLabel()
	{
		$configValue = Mage::getStoreConfig(self::PATH_CMS_HEADING);
		return strlen($configValue) > 0 ? $configValue : self::DEFAULT_LABEL;
	}

	public function getPageLabel()
	{
		$configValue = Mage::getStoreConfig(self::PATH_PAGE_HEADING);
		return strlen($configValue) > 0 ? $configValue : self::DEFAULT_LABEL;
	}
}