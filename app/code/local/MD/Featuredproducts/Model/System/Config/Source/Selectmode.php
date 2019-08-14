<?php
class MD_FeaturedProducts_Model_System_Config_Source_Selectmode
{
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Thickbox')),
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Modalbox')),
        );
    }
}
