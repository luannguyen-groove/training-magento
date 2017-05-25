<?php
class ForeverNew_MegaMenu_Model_Mysql4_CustomMenu extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {  
        $this->_init('forevernew_megamenu/custommenu', 'id');
    }  
}