$(document).ready(function(){
	// Get Product Price base on Size
	$(".getPrice").change(function(){
		var size = $(this).val();
		var product_id = $(this).attr("product-id");
		// alert(product_id);
		$.ajax({ 
			headers: { 
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			}, 
			url:'/get-attribute-price',
			data:{size:size, product_id:product_id},
			type:'post',
			success:function(resp){
					// alert(resp);
					if(resp['discount']>0){
						$(".getAttributePrice").html("<span class='pd-detail__price'>₹"+resp['final_price']+"</span><span class='pd-detail__discount'>("+resp['discount_percent']+"% OFF)</span><del class='pd-detail__del'>₹"+resp['product_price']+"</del>");
					}else{
					    $(".getAttributePrice").html("<span class='pd-detail__price'>₹" +resp['final_price']+ "</span>");
					}
			},error:function(){
				alert("Error");
			}		
		});
	});

	// Add to Cart
	$("#addToCart").submit(function(){
		var formData = $(this).serialize();
		// alert(formData);
		$.ajax({
			headers: { 
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:'/add-to-cart',
			type:'post',
			data:formData,
			success:function(resp){
				// alert(resp['status']);
				if(resp['status']==true){
					$('.print-success-msg').show();
					$('.print-success-msg').delay(9000).fadeOut('slow');
					$('.print-success-msg').html("<div class='success'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>"+resp['message']+"</div>");
				}else{
					// alert(resp['message']);
					$('.print-error-msg').show();
					$('.print-error-msg').delay(9000).fadeOut('slow');
					$('.print-error-msg').html("<div class='alert'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>"+resp['message']+"</div>");
				}
				
			},error:function(){
				alert("Error");
			}
		})
	});

	// Update Cart Items Quantity
	$(document).on('click', '.updateCartItem', function(){
		// alert('test');
		if($(this).hasClass('fa-plus')){
			// Get Qty
			var quantity = $(this).data('qty');
			// Increase  the Qty by 1
			new_qty = parseInt(quantity)+1;
			// alert(new_qty);
		}
		if($(this).hasClass('fa-minus')){
			// Get Qty
			var quantity = $(this).data('qty');
			// Check Qty is atleast 1
			if(quantity<=1){
				alert("Item Quantity must be 1 or greater!");
				return false;
			}
			// Increase  the Qty by 1
			new_qty = parseInt(quantity)-1;
		}
		var cartid = $(this).data('cartid');
		$.ajax({
			headers: { 
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			data:{cartid:cartid, qty:new_qty},
			url:'/update-cart-item-qty',
			type:'post',
			success:function(resp){
				alert(resp);
				if(resp.status==false){
					alert(resp.message);
				}
				$("#appendCartItems").html(resp.view);
			},error:function(){
				alert("Error");
			}
		});
	});

});		