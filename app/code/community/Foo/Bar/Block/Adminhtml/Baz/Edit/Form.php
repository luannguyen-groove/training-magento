<?php
class Foo_Bar_Block_Adminhtml_Baz_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('foo_bar_baz_form');
        $this->setTitle($this->__('Baz Information'));
        $this->setTemplate('baz/bazedit.phtml');
    }

    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('foo_bar');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('Baz Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('checkout')->__('Name'),
            'title'     => Mage::helper('checkout')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('order', 'text', array(
            'name'      => 'order',
            'label'     => Mage::helper('checkout')->__('Order'),
            'title'     => Mage::helper('checkout')->__('Order'),
            'required'  => true,
        ));

        $fieldset->addField('categories', 'select', array(
            'label' => $this->__('Categories'),
            'name' => 'categories',
            'values' => $this->getCategoriesArray(),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getCategoriesArray() {

        $categoriesArray = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSort('path', 'asc')
            ->load()
            ->toArray();

        $categories = array();
        foreach ($categoriesArray as $categoryId => $category) {
            if (isset($category['name']) && isset($category['level'])) {
                $categories[] = array(
                    'name' => $category['name'],
                    'level'  =>$category['level'],
                    'parent_id' => $category['parent_id'],
                    'value' => $categoryId
                );
            }
        }

        return $categories;
    }
}