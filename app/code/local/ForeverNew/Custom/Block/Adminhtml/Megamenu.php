<?php
class ForeverNew_Custom_Block_Adminhtml_Megamenu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'forevernew_custom';
        $this->_controller = 'adminhtml_megamenu';
        $this->_headerText = $this->__('Mega Menu');

        parent::__construct();
    }
}