jQuery.noConflict();
jQuery(document).ready( function ()
	{
		var product_price = jQuery(".price_alter").text();
		jQuery('.rent_text b').html(product_price);
		var initial_payment = product_price.replace('₹ ', '');
		var qty = jQuery('.qty_alter input').val();
		var initial_payment = initial_payment*qty;
		jQuery('.initial_value').text('₹ '+initial_payment);
		jQuery("#refund_amount").text('0');
		jQuery('.qty_alter input').val('1');
		jQuery('#pay_price').val(product_price).attr('readonly',true);
		jQuery('.input-text.product-custom-option').val('Select week`s to see return Date').attr('readonly',true);
		jQuery('.input-text.product-custom-option').click(function(){
			jQuery('.input-text.product-custom-option').attr('readonly',true);
		});
		jQuery('select').attr('id','select_weeks');
		jQuery('textarea').attr('id','refund_amount');
		jQuery(':checkbox').attr('id','order_type');
		jQuery('#refund_amount').css({'height': '29px','width': '324px','resize':'none'});
		jQuery('#refund_amount').attr('readonly',true);
		//var default_option = jQuery(this).find('option:selected').attr('price');
		//jQuery('#refund_amount').text(default_option);
		jQuery('.qty_alter input').change(function(){
			// alert('select weeks');
			var option = jQuery('#select_weeks').find('option:selected').attr('price');
			var qty = jQuery('.qty_alter input').val();
			var finalval = option*qty;
			var payamount = jQuery('.price_alter').text();
			var payamount = payamount.replace('₹ ', '');
			var one = payamount*qty;
			// if(option == ""){
			// 	alert('select weeks');
			// }
			var payableAmount = one-finalval;
			var days = jQuery(this).find('option:selected').text().match(/\d+/);
			var total_days = days*7;
			var date = new Date();
			date.setDate(date.getDate() + total_days);
			var monthStr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			var month = monthStr[date.getMonth()];
			var day = date.getDate();
			var output = (day<10 ? '0' : '') + day +" "+ month + " " + date.getFullYear();
			// var dateFormat = jQuery.datepicker.formatDate('MM dd, yy', new Date(output));
			var empty_value = jQuery(this).find('option:selected').val();
			if(empty_value == ""){
				jQuery('#refund_amount').text('');
				jQuery('.input-text.product-custom-option').val('');
			}
			else{jQuery('#refund_amount').text('₹ '+finalval);
			jQuery('.input-text.product-custom-option').val(output);
			jQuery('.rent_text b').html('₹ '+payableAmount);
			jQuery('#pay_price').val('(-) ₹ '+payableAmount);
				var initial_payment = jQuery('.price_alter').text();
		var initial_payment = initial_payment.replace('₹ ', '');
		var qty = jQuery('.qty_alter input').val();
		var initial_payment = initial_payment*qty;
		jQuery('.initial_value').text('₹ '+initial_payment);}
			
		})
		jQuery('#select_weeks').change(function()
		{
			var option = jQuery(this).find('option:selected').attr('price');
			var qty = jQuery('.qty_alter input').val();
			var finalval = option*qty;
			var payamount = jQuery('.price_alter').text();
			var payamount = payamount.replace('₹ ', '');
			var one = payamount*qty;
			var payableAmount = one-finalval;
			var days = jQuery(this).find('option:selected').text().match(/\d+/);
			var total_days = days*7;
			var date = new Date();
			date.setDate(date.getDate() + total_days);
			var monthStr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			var month = monthStr[date.getMonth()];
			var day = date.getDate();
			var output = (day<10 ? '0' : '') + day +" "+ month + " " + date.getFullYear();
			// var dateFormat = jQuery.datepicker.formatDate('MM dd, yy', new Date(output));
			var empty_value = jQuery(this).find('option:selected').val();
			if(empty_value == ""){
				jQuery('#refund_amount').text('');
				jQuery('.input-text.product-custom-option').val('');
			}
			else{jQuery('#refund_amount').text('₹ '+finalval);
			jQuery('.input-text.product-custom-option').val(output);
			jQuery('.rent_text b').html('₹ '+payableAmount);
			jQuery('#pay_price').val('(-) ₹ '+payableAmount);
				var initial_payment = jQuery('.price_alter').text();
				var initial_payment = initial_payment.replace('₹ ', '');
				var qty = jQuery('.qty_alter input').val();
				var initial_payment = initial_payment*qty;
				jQuery('.initial_value').text('₹ '+initial_payment);}
			
		});
	});
jQuery(function() {
        jQuery('#defaultRent').click(function() {

            jQuery("#order_type").prop('checked', true);
            return false;
        });

    });
	jQuery(document).ready(function(){
		jQuery("#rentButotn").click(function(){
			var year = jQuery('#select_weeks option:selected').val();
				if(year == "")
				{
				alert('Please select the week');
				return false;
				}
				else{productAddToCartForm.submit(this);}
		});
	});
	jQuery(function() {
			jQuery('#cancel').click(function(){
			jQuery("#order_type").prop('checked', false);
			jQuery("#select_weeks").val('');
			jQuery("#refund_amount").text('0');
			jQuery('.qty_alter input').val('1');
			jQuery('#pay_price').val('    0');
				var initial_payment = jQuery('.price_alter').text();
				var initial_payment = initial_payment.replace('₹ ', '');
				var qty = jQuery('.qty_alter input').val();
				var initial_payment = initial_payment*qty;			
			jQuery('.initial_value').text('₹ '+initial_payment);
			jQuery('.rent_text b').html('₹ '+initial_payment);
			jQuery('.input-text.product-custom-option').val('Select week`s to see return Date');
			document.getElementById('lightbox').style.display='none';
			return false;
		});
		});
	jQuery('#select_weeks').change(function(){
		alert('ok');
	});
