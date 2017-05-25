<?php
class ForeverNew_Custom_Adminhtml_MegamenuController extends Mage_Adminhtml_Controller_Action
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
        $model = Mage::getModel('forevernew_custom/megamenu');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This megamenu no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Megamenu'));

        $data = Mage::getSingleton('adminhtml/session')->getMegamenuData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('forevernew_custom', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Megamenu') : $this->__('New Megamenu'), $id ? $this->__('Edit Megamenu') : $this->__('New Megamenu'))
            ->_addContent($this->getLayout()->createBlock('forevernew_custom/adminhtml_megamenu_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('forevernew_custom/megamenu');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The megamenu has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this megamenu.'));
            }

            Mage::getSingleton('adminhtml/session')->setBazData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction()
    {
        $data = Mage::getModel('forevernew_custom/megamenu')->load($this->getRequest()->getParam('id'));
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
            ->_setActiveMenu('forevernew_custom')
            ->_title($this->__('Custom'))->_title($this->__('Megamenu'))
            ->_addBreadcrumb($this->__('Custom'), $this->__('Custom'))
            ->_addBreadcrumb($this->__('Megamenu'), $this->__('Megamenu'));

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('forevernew_custom');
    }
}