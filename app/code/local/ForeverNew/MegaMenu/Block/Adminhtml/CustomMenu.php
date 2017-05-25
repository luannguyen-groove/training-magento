<?php
class ForeverNew_MegaMenu_Block_Adminhtml_CustomMenu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'forevernew_megamenu';
        $this->_controller = 'adminhtml_custommenu';
        $this->_headerText = $this->__('CustomMenu');
         
        parent::__construct();
    }
}