<?php

class ForeverNew_MegaMenu_Adminhtml_CustomMenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {  
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }  
     
    public function newAction()
    {  
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }  
     
    public function editAction()
    {  
        $this->_initAction();
     
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('forevernew_megamenu/custommenu');
     
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This menu no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            }  
        }  
     
        $this->_title($model->getId() ? $model->getName() : $this->__('New Menu'));
     
        $data = Mage::getSingleton('adminhtml/session')->getCustomMenuData(true);
        if (!empty($data)) {
            $model->setData($data);
        }  
     
        Mage::register('forevernew_megamenu', $model);
     
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Menu') : $this->__('New Menu'), $id ? $this->__('Edit Menu') : $this->__('New Menu'))
            ->_addContent($this->getLayout()->createBlock('forevernew_megamenu/adminhtml_custommenu_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }
     
    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('forevernew_megamenu/custommenu');
            $model->setData($postData);
 
            try {
                $model->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The menu has been saved.'));
                $this->_redirect('*/*/');
 
                return;
            }  
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this menu.'));
            }
 
            Mage::getSingleton('adminhtml/session')->setCustomMenuData($postData);
            $this->_redirectReferer();
        }
    }
     
    public function messageAction()
    {
        $data = Mage::getModel('forevernew_megamenu/custommenu')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
     
    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('forevernew_megamenu')
            ->_title($this->__('ForeverNew'))->_title($this->__('CustomMenu'))
            ->_addBreadcrumb($this->__('ForeverNew'), $this->__('ForeverNew'))
            ->_addBreadcrumb($this->__('CustomMenu'), $this->__('CustomMenu'));
         
        return $this;
    }
     
    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('forevernew_megamenu');
    }

}