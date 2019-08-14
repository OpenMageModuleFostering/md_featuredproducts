<?php

/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer = $this;

$installer->startSetup();
$installer->removeAttribute('catalog_product', 'md_featured_product');
$installer->endSetup();