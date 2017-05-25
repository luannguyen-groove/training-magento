<?php
class ForeverNew_Custom_Model_Mysql4_Megamenu extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {  
        $this->_init('forevernew_custom/megamenu', 'id');
    }  
}