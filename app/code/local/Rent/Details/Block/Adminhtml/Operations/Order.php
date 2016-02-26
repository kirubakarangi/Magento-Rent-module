<?php
 
/**
 * Adminhtml operations orders block
 *
 * @category   Inchoo
 * @package    Inchoo_DateOrder
 */
class Rent_Details_Block_Adminhtml_Operations_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
 
    public function __construct()
    {
        $this->_controller = 'operations_order';
        $this->_blockGroup = 'operations_adminhtml';
        $this->_headerText = Mage::helper('operations')->__('Rent Customers');
        $this->_addButtonLabel = Mage::helper('sales')->__('Create New Order');
        parent::__construct();
        if (!Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/create')) {
            $this->_removeButton('add');
        }
    }
 
}
