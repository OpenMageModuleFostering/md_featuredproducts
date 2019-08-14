<?php

class MD_FeaturedProducts_Block_Page_Html extends Mage_Page_Block_Html
{
   
    public function getTemplate()
    {
        if (empty($this->_template)) {
            $this->_template = $this->_getData('template');
        }
        if ($this->_template == 'md/featuredProducts/page/empty.phtml') {
            return 'md/featuredProducts/page/empty.phtml';
        }
        return $this->_template;
    }
}