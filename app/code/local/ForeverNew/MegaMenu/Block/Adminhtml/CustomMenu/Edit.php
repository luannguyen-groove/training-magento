<?php 
class ForeverNew_MegaMenu_Block_Adminhtml_CustomMenu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'forevernew_megamenu';
        $this->_controller = 'adminhtml_custommenu';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Menu'));
        $this->_updateButton('delete', 'label', $this->__('Delete Menu'));
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('forevernew_custommenu')->getId()) {
            return $this->__('Edit Menu');
        }  
        else {
            return $this->__('New Menu');
        }  
    }  
}