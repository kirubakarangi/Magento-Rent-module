<?php
 
/**
 * Adminhtml operations orders grid renderer
 *
 * @category   Inchoo
 * @package    Inchoo_DateOrder
 */
class Rent_Details_Block_Adminhtml_Operations_Order_Renderer_returndate
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        //load first item of the order
        $orderItem = Mage::getResourceModel('sales/order_item_collection')
                        ->addFieldToFilter('order_id', $row->getId())
                        ->getFirstItem()
                        ;
 
        $orderItemOptions = $orderItem->getProductOptions();
 
        //if product doesn't have options stop with rendering
        if (!array_key_exists('options', $orderItemOptions)) {
            return;
        }
 
        $orderItemOptions = $orderItemOptions['options'];
 
        //if product options isn't array stop with rendering
        if (!is_array($orderItemOptions)) {
            return;
        }
 
        foreach ( $orderItemOptions as $orderItemOption) {
 
            if ($orderItemOption['label'] === 'Weeks Selected') {
                if (array_key_exists('value', $orderItemOption)) {
                    preg_match_all('!\d+!', $orderItemOption['value'], $matches);
                    $var = implode(' ', $matches[0]);
                    $total_days = $var*7;
                    print_r(date('M d,Y', strtotime("+".$total_days." days")));
                    // return $orderItemOption['value'];
                }
            }
 
        }
		
 
        //if product options doesn't have Delivery Date custom option return void
        return;
    }
}
