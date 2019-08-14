<?php

$installer = $this;
/* @var $installer Mage_Eav_Model_Entity_Setup */

$installer->startSetup();
$installer->updateAttribute('catalog_product', 'md_featured_product', 'is_global', Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE);

$installer->endSetup();