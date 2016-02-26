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
<?php $_product = $this->getProduct(); ?>
<?php $buttonTitle = $this->__('Add to Cart'); ?>
<?php if($_product->isSaleable()): ?>
	<div class="add-to-cart">
		<?php if(!$_product->isGrouped()): ?>
			<div class="qty-wrapper">

				<label for="qty"><?php echo $this->__('Qty:') ?></label>
				<input type="text" pattern="\d*" name="qty" id="qty" maxlength="12" value="<?php echo max($this->getProductDefaultQty() * 1, 1) ?>" title="<?php echo $this->__('Qty') ?>" class="input-text qty" />
			</div>
		<?php endif; ?>
		<div class="add-to-cart-buttons">
			<button type="button" title="<?php echo $buttonTitle ?>" class="button btn-cart" onclick="productAddToCartForm.submit(this)" ><span><span><?php echo $buttonTitle ?></span></span></button>
			<!--attribute value option-->               
			<?php     
			$attribute = $_product->getResource()->getAttribute('rent');
			$attribute_value = $attribute ->getFrontend()->getValue($_product);
			if($attribute_value == "Yes"){
				?>
				<button class="button btn-cart" id="defaultRent"onclick="document.getElementById('lightbox').style.display='inline';return false;">Rent Available</button>
				<?php
			}
			else{
				?>
				<button type="button" class="button btn-cart"><span>No Rent Availabe</span></button>
				<?php
			}
						// endif;
			?>
			<!-- LIGHTBOX CODE BEGIN -->
			<div id="lightbox" class="lightbox" style="display:none" >
				<table class="lightbox_table">
					<tr>
						<td class="lightbox_table_cell" align="center">
							<p class='close_button' style="cursor:pointer;" onclick="document.getElementById('lightbox').style.display='none';" ></p>
							<div id="lightbox_content" class="popup_div" onclick="document.getElementById('lightbox').style.display='block';">
								<div>
								<label><h2>Terms & Conditions:</h2></label>
								<?php echo $this->getLayout()->createBlock('cms/block')->setBlockId('terms_and_conditions_for_rent')->toHtml() ?>
								<!--label>Select a weeks to see Refund:</label-->
								<?php $price = $_product->getPrice();?>
								<div class="product_price">
								<label><h2>Actual Product Price </h2></label><span class="price_alter" ><?php echo '₹ '.floatval($price); ?></span>
								</div>
								<div class="initial_payment">
								<label><h2>Initial Payment </h2></label><span class="initial_value" ></span>
								</div>
								<div class="product_quantity">
								<label><h2>Qty </h2></label><span class="qty_alter"><input type="text" pattern="\d*" name="qty" id="qty" maxlength="12" value="<?php echo max($this->getProductDefaultQty() * 1, 1) ?>" title="<?php echo $this->__('Qty') ?>" class="input-text qty" /></span>
								</div>
								<div class="pay_price">
								<label><h2>Your rental value </h2></label><span ><input id="pay_price" type="text" value=""></span>
								</div>
								<?php $_options = Mage::helper('core')->decorateArray($this->getOptions()) ?>
								<dl>
									<?php foreach($_options as $_option): ?>
										<?php echo $this->getOptionHtml($_option) ?>
									<?php endforeach; ?>
								</dl>
								<div class="rent_text">
								<span style = "color:black">Keep Calm and game on just  <b></b></span>
								</div>
							</div>
							<div class="rent_cancel">
								<button type="button" class="popup_button" id="rentButotn" ><span>ok</span></button>
								<button type="button" class="popup_button" id="cancel"><span>cancel</span></button>
							</div>
						</td>

					</tr>

				</table>

			</div>
			<!-- LIGHTBOX CODE END --><!--end-->
			<?php echo $this->getChildHtml('', true, true) ?>
		</div>
	</div>
<?php endif; ?>
