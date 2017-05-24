<?php

class ForeverNew_MegaMenu_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('forevernew_megamenu')
            ->_title($this->__('ForeverNew Mega Menu'));

        $this->renderLayout();
    }
}