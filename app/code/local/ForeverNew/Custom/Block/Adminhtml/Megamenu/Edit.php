<?php
class ForeverNew_Custom_Block_Adminhtml_Megamenu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_blockGroup = 'forevernew_custom';
        $this->_controller = 'adminhtml_megamenu';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Megamenu'));
        $this->_updateButton('delete', 'label', $this->__('Delete Megamenu'));
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('forevernew_custom')->getId()) {
            return $this->__('Edit Megamenu');
        }
        else {
            return $this->__('New Megamenu');
        }
    }
}