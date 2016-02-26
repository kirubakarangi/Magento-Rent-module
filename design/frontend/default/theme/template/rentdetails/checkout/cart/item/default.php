<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    design
 * @package     rwd_default
 * @copyright   Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
?>
<?php
$_item = $this->getItem();
$isVisibleProduct = $_item->getProduct()->isVisibleInSiteVisibility();
$canApplyMsrp = Mage::helper('catalog')->canApplyMsrp($_item->getProduct(), Mage_Catalog_Model_Product_Attribute_Source_Msrp_Type::TYPE_BEFORE_ORDER_CONFIRM);
?>
<tr>
    <td class="product-cart-image">
        <?php if ($this->hasProductUrl()):?>
            <a href="<?php echo $this->getProductUrl() ?>" title="<?php echo $this->escapeHtml($this->getProductName()) ?>" class="product-image">
            <?php endif;?>
            <img src="<?php echo $this->getProductThumbnail()->resize(180); ?>" alt="<?php echo $this->escapeHtml($this->getProductName()) ?>" />
            <?php if ($this->hasProductUrl()):?>
            </a>
        <?php endif;?>

        <ul class="cart-links">
            <?php if ($isVisibleProduct): ?>
<!--                 <li>
                    <a href="<?php echo $this->getConfigureUrl() ?>" title="<?php //echo $this->__('Edit item parameters') ?>"><?php //echo $this->__('Edit') ?></a>
                </li> -->
            <?php endif ?>

            <?php if ($this->helper('wishlist')->isAllowInCart() && $isVisibleProduct) : ?>
                <li>
                    <a href="<?php echo $this->helper('wishlist')->getMoveFromCartUrl($_item->getId()); ?>" class="link-wishlist use-ajax"><?php echo $this->__('Move to wishlist'); ?></a>
                </li>
            <?php endif ?>
        </ul>
    </td>

    <td class="product-cart-info">

        <!-- <a href="<?php echo $this->getDeleteUrl() ?>" title="<?php echo $this->__('Remove Item') ?>" class="btn-remove btn-remove2"><?php echo $this->__('Remove Item') ?></a> -->

        <h2 class="product-name">
            <?php if ($this->hasProductUrl()):?>
                <a href="<?php echo $this->getProductUrl() ?>"><?php echo $this->escapeHtml($this->getProductName()) ?></a>
            <?php else: ?>
                <?php echo $this->escapeHtml($this->getProductName()) ?>
            <?php endif; ?>
        </h2>

<!--         <div class="product-cart-sku">
            <span class="label"><?php //echo $this->__('SKU'); ?>:</span> <?php echo $this->escapeHtml($_item->getSku()); ?>
        </div> -->
        <!---- Rental Options code begins---->

        <?php if ($_options = $this->getOptionList()):?>

            <?php $product=Mage::getModel('catalog/product')->load($_item->getProduct()->getId()); ?>

            <?php foreach ($_options as $_option) : ?>
                <?php $_formatedOptionValue = $this->getFormatedOptionValue($_option) ?>
                <?php foreach ($product->getProductOptionsCollection() as $option) { ?>

                <?php if($option->getTitle()==$_option['label']):?>             
                    <strong><?php echo $this->htmlEscape($_option['label']) ?></strong><br>
                    
                     <b><?php print_r($_formatedOptionValue['value']); ?></b>
                      
                    <br>
                    <!-- -->
                    <?php
                    switch ($option->getGroupByType()) {
                      case Mage_Catalog_Model_Product_Option::OPTION_GROUP_SELECT:
				//echo '<h2><span class="label">'.$option->getTitle().':</span></h2>';
                      foreach ($option->getValuesCollection() as $value) {
                        if($value->getTitle()==$_formatedOptionValue['value']){
                         
                      //echo '|value_id =>'. $value->getId();
                       //echo $value->getTitle()."&emsp;";
                            ?>
                            &emsp;<a href="<?php echo $this->getConfigureUrl() ?>" title="<?php echo $this->__('Edit item parameters') ?>"><?php echo $this->__('Edit') ?></a>
                            
                            <?php
                            // echo "</br>";
                            $number=$value->getPrice();
                            if($number != 0)
                            {
                                echo $numberformatted = "<b>".number_format($number, 0, '.', '').'% Cash Back</b><br>';
                            }
                       // echo '|price_type=>'. $value->getPriceType();
                       //echo '|sku=>'. $value->getSku();
                            $sku = $value->getSortOrder();
                       //echo '|sort_order =>'. $value->getSortOrder();
                            $_product = $this->getProduct(); 
                            $qty = $this->getQty();
                            $refundAmount = "";
                            $attVal = $product->getOptions();
                            if(sizeof($attVal)) {
                              foreach($attVal as $optionVal) {
        //$refundAmount .= $optionVal->getTitle().": ";
        //$refundAmount .= "<select name='options[".$optionVal->getId()."]'>";
                                foreach($optionVal->getValues() as $valuesKey => $valuesVal) {
          //$refundAmount .= "<option price='".$valuesVal->getPrice(true)."' value='".$valuesVal->getId()."'>".$valuesVal->getTitle() .'+'. $valuesVal->getPrice(true) ."</option>";
                                   $refundAmount[] = "<br><h2>Refund Amount:</h2><br>".$valuesVal->getPrice(true) * $qty;

                               }
       //$refundAmount .= "</select>";
                           }
                       }
                       if($sku == 1)
                       {
	//echo $refundAmount[2];
                       }
                       elseif($sku == 2)
                       {
	//echo $refundAmount[3];
                       }
                       elseif($sku == 3)
                       {
	//echo $refundAmount[4];
                       }
                       
                       
                       
                       if($value->getPriceType()=='fixed' && !is_null($value->getPrice())):
                       //echo $value->getPrice()*$this->getQty();
                         endif;

                     if($value->getPriceType()=='percent' && !is_null($value->getPrice())):
                       //echo $value->getPrice()*$this->getQty()*$Yourutemprice;
                         endif;



                 }
             }
             break;
             default:

             if($option->getPriceType()=='fixed' && !is_null($option->getPrice())):
                       //echo $option->getPrice()*$this->getQty();
                 endif;

             if($option->getPriceType()=='percent' && !is_null($option->getPrice())):
                       //echo $option->getPrice()*$this->getQty()*$Yourutemprice;
                 endif;



         }
         ?>      
         <!-- -->
     <?php endif; ?>        
     <?php } ?> 


 <?php endforeach; ?>
<?php endif;?>
<!--end-->

<?php if ($messages = $this->getMessages()): ?>
    <?php foreach ($messages as $message): ?>
        <p class="item-msg <?php echo $message['type'] ?>">
            * <?php echo $this->escapeHtml($message['text']) ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>

<?php $addInfoBlock = $this->getProductAdditionalInformationBlock(); ?>
<?php if ($addInfoBlock): ?>
    <?php echo $addInfoBlock->setItem($_item)->toHtml() ?>
<?php endif;?>

</td>

<?php if ($canApplyMsrp): ?>
    <td class="a-center product-cart-price"<?php if ($this->helper('tax')->displayCartBothPrices()): ?> colspan="2"<?php endif; ?>>
        <span class="cart-price">
            <span class="cart-msrp-unit"><?php echo $this->__('See price before order confirmation.'); ?></span>
            <?php $helpLinkId = 'cart-msrp-help-' . $_item->getId(); ?>
            <a id="<?php echo $helpLinkId ?>" href="#" class="map-help-link"><?php echo $this->__("What's this?"); ?></a>

            <script type="text/javascript">
                Catalog.Map.addHelpLink($('<?php echo $helpLinkId ?>'), "<?php echo $this->__("What&#39;s this?") ?>");
            </script>

        </span>
    </td>
<?php else: ?>

    <?php if ($this->helper('tax')->displayCartPriceExclTax() || $this->helper('tax')->displayCartBothPrices()): ?>
        <td class="product-cart-price" data-rwd-label="<?php echo $this->__('Price'); ?>" data-rwd-tax-label="<?php echo $this->__('Excl. Tax'); ?>">

            <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                <span class="cart-tax-total" onclick="taxToggle('eunit-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                <?php else: ?>
                    <span class="cart-price">
                    <?php endif; ?>
                    <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(0, 1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                        <?php echo $this->helper('checkout')->formatPrice($_item->getCalculationPrice()+$_item->getWeeeTaxAppliedAmount()+$_item->getWeeeTaxDisposition()); ?>
                    <?php else: ?>
                        <?php echo $this->helper('checkout')->formatPrice($_item->getCalculationPrice()) ?>
                    <?php endif; ?>

                </span>

                <?php if (Mage::helper('weee')->getApplied($_item)): ?>

                    <div class="cart-tax-info" id="eunit-item-tax-details<?php echo $_item->getId(); ?>" style="display:none;">
                        <?php if (Mage::helper('weee')->typeOfDisplay($_item, 1, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount'],true,true); ?></span>
                            <?php endforeach; ?>
                        <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount'],true,true); ?></span>
                            <?php endforeach; ?>
                        <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 4, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount'],true,true); ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                        <div class="cart-tax-total" onclick="taxToggle('eunit-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                            <span class="weee"><?php echo Mage::helper('weee')->__('Total'); ?>: <?php echo $this->helper('checkout')->formatPrice($_item->getCalculationPrice()+$_item->getWeeeTaxAppliedAmount()+$_item->getWeeeTaxDisposition()); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        <?php endif; ?><!-- inclusive price starts here -->
        <?php if ($this->helper('tax')->displayCartPriceInclTax() || $this->helper('tax')->displayCartBothPrices()): ?>
            <td class="product-cart-price" data-rwd-label="<?php echo $this->__('Price'); ?>" data-rwd-tax-label="<?php echo $this->__('Incl. Tax'); ?>">
                <?php $_incl = $this->helper('checkout')->getPriceInclTax($_item); ?>
                <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                    <span class="cart-tax-total" onclick="taxToggle('unit-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                    <?php else: ?>
                        <span class="cart-price">
                        <?php endif; ?>

                        <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(0, 1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <?php echo $this->helper('checkout')->formatPrice($_incl + Mage::helper('weee')->getWeeeTaxInclTax($_item)); ?>
                        <?php else: ?>
                            <?php echo $this->helper('checkout')->formatPrice($_incl-$_item->getWeeeTaxDisposition()) ?>
                        <?php endif; ?>

                    </span>
                    <?php if (Mage::helper('weee')->getApplied($_item)): ?>

                        <div class="cart-tax-info" id="unit-item-tax-details<?php echo $_item->getId(); ?>" style="display:none;">
                            <?php if (Mage::helper('weee')->typeOfDisplay($_item, 1, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount_incl_tax'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount_incl_tax'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 4, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['amount_incl_tax'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <?php if (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <div class="cart-tax-total" onclick="taxToggle('unit-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                                <span class="weee"><?php echo Mage::helper('weee')->__('Total incl. tax'); ?>: <?php echo $this->helper('checkout')->formatPrice($_incl + Mage::helper('weee')->getWeeeTaxInclTax($_item)); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
        <?php endif; ?>
        <td class="product-cart-actions" data-rwd-label="<?php echo $this->__('Qty'); ?>">
            <input type="text" pattern="\d*" name="cart[<?php echo $_item->getId() ?>][qty]" value="<?php echo $this->getQty() ?>" size="4" title="<?php echo $this->__('Qty') ?>" class="input-text qty" maxlength="12" />

            <button type="submit" name="update_cart_action" value="update_qty" title="<?php echo $this->__('Update'); ?>" class="button btn-update"><span><span><?php echo $this->__('Update'); ?></span></span>
            </button>

            <ul class="cart-links">
                <?php if ($isVisibleProduct): ?>
                    <li>
                        <a href="<?php echo $this->getConfigureUrl() ?>" title="<?php echo $this->__('Edit item parameters') ?>"><?php echo $this->__('Edit') ?></a>
                    </li>
                <?php endif ?>

                <?php if ($this->helper('wishlist')->isAllowInCart()) : ?>
                    <li>
                        <?php if ($isVisibleProduct): ?>
                            <a href="<?php echo $this->helper('wishlist')->getMoveFromCartUrl($_item->getId()); ?>" class="link-wishlist use-ajax"><?php echo $this->__('Move to wishlist'); ?></a>
                        <?php endif ?>
                    </li>
                <?php endif ?>
            </ul>

        </td>

        <!--Sub total starts here -->
        <?php if (($this->helper('tax')->displayCartPriceExclTax() || $this->helper('tax')->displayCartBothPrices()) && !$_item->getNoSubtotal()): ?>
            <td class="product-cart-total" data-rwd-label="<?php echo $this->__('Subtotal'); ?>">
                <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                    <span class="cart-tax-total" onclick="taxToggle('esubtotal-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                    <?php else: ?>
                        <span class="cart-price">
                        <?php endif; ?>

                        <?php if ($canApplyMsrp): ?>
                            <span class="cart-msrp-subtotal">--</span>
                        <?php else: ?>
                            <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(0, 1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php echo $this->helper('checkout')->formatPrice($_item->getRowTotal()+$_item->getWeeeTaxAppliedRowAmount()+$_item->getWeeeTaxRowDisposition()); ?>
                            <?php else: ?>
                                <?php echo $this->helper('checkout')->formatPrice($_item->getRowTotal()) ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    </span>
                    <?php if (Mage::helper('weee')->getApplied($_item)): ?>

                        <div class="cart-tax-info" id="esubtotal-item-tax-details<?php echo $_item->getId(); ?>" style="display:none;">
                            <?php if (Mage::helper('weee')->typeOfDisplay($_item, 1, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 4, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                    <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount'],true,true); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <?php if (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                            <div class="cart-tax-total" onclick="taxToggle('esubtotal-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                                <span class="weee"><?php echo Mage::helper('weee')->__('Total'); ?>: <?php echo $this->helper('checkout')->formatPrice($_item->getRowTotal()+$_item->getWeeeTaxAppliedRowAmount()+$_item->getWeeeTaxRowDisposition()); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if (($this->helper('tax')->displayCartPriceInclTax() || $this->helper('tax')->displayCartBothPrices()) && !$_item->getNoSubtotal()): ?>
                <td class="product-cart-total" data-rwd-label="<?php echo $this->__('Subtotal'); ?>">
                    <?php $_incl = $this->helper('checkout')->getSubtotalInclTax($_item); ?>
                    <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                        <span class="cart-tax-total" onclick="taxToggle('subtotal-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                        <?php else: ?>
                            <span class="cart-price">
                            <?php endif; ?>

                            <?php if ($canApplyMsrp): ?>
                                <span class="cart-msrp-subtotal">--</span>
                            <?php else: ?>
                                <?php if (Mage::helper('weee')->typeOfDisplay($_item, array(0, 1, 4), 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                    <?php echo $this->helper('checkout')->formatPrice($_incl + Mage::helper('weee')->getRowWeeeTaxInclTax($_item)); ?>
                                <?php else: ?>
                                    <?php echo $this->helper('checkout')->formatPrice($_incl-$_item->getWeeeTaxRowDisposition()) ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        </span>


                        <?php if (Mage::helper('weee')->getApplied($_item)): ?>

                            <div class="cart-tax-info" id="subtotal-item-tax-details<?php echo $_item->getId(); ?>" style="display:none;">
                                <?php if (Mage::helper('weee')->typeOfDisplay($_item, 1, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                    <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                        <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount_incl_tax'],true,true); ?></span>
                                    <?php endforeach; ?>
                                <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                    <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                        <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount_incl_tax'],true,true); ?></span>
                                    <?php endforeach; ?>
                                <?php elseif (Mage::helper('weee')->typeOfDisplay($_item, 4, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                    <?php foreach (Mage::helper('weee')->getApplied($_item) as $tax): ?>
                                        <span class="weee"><?php echo $tax['title']; ?>: <?php echo Mage::helper('checkout')->formatPrice($tax['row_amount_incl_tax'],true,true); ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <?php if (Mage::helper('weee')->typeOfDisplay($_item, 2, 'sales') && $_item->getWeeeTaxAppliedAmount()): ?>
                                <div class="cart-tax-total" onclick="taxToggle('subtotal-item-tax-details<?php echo $_item->getId(); ?>', this, 'cart-tax-total-expanded');">
                                    <span class="weee"><?php echo Mage::helper('weee')->__('Total incl. tax'); ?>: <?php echo $this->helper('checkout')->formatPrice($_incl + Mage::helper('weee')->getRowWeeeTaxInclTax($_item)); ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
                <td class="a-center product-cart-remove">
                    <a href="<?php echo $this->getDeleteUrl() ?>" title="<?php echo $this->__('Remove Item') ?>" class="btn-remove btn-remove2"><?php echo $this->__('Remove Item') ?></a>
                </td>
            </tr>


