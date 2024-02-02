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
		$(".loader").hide();
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
				$(".loader").hide();
				// alert(resp['status']);
				$(".totalCartItems").html(resp['totalCartItems']);
				$("#appendCartItems").html(resp.view);
				$("#appendMiniCartItems").html(resp.minicartview);
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
				$(".loader").hide();
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
				// alert(resp);
				$(".totalCartItems").html(resp.totalCartItems);
				if(resp.status==false){
					alert(resp.message);
				}
				$("#appendCartItems").html(resp.view);
				$("#appendMiniCartItems").html(resp.minicartview);
			},error:function(){
				alert("Error");
			}
		});
	});

	// Delete Cart Item
	$(document).on('click', '.deleteCartItem',function(){
		var cartid = $(this).data('cartid');
		var result = confirm("Are You Sure you want to Delete this Cart Items?");

		if(result){
			$.ajax({
				headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
				},
				data:{cartid:cartid},
				url:'/delete-cart-item',
				type:'post',
				success:function(resp){
					$(".totalCartItems").html(resp.totalCartItems);
					$("#appendCartItems").html(resp.view);
					$("#appendMiniCartItems").html(resp.minicartview);
				},
				error:function(){
					alert("Error");
				}
			});
		} 
	});

	// Empty Cart Item
	$(document).on('click', '.emptyCart',function(){
		var result = confirm("Are You Sure you want to empty your Cart?");

		if(result){
			$.ajax({
				headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
				},
				url:'/empty-cart',
				type:'post',
				success:function(resp){
					$(".totalCartItems").html(resp.totalCartItems);
					$("#appendCartItems").html(resp.view);
					$("#appendMiniCartItems").html(resp.minicartview);
				},
				error:function(){
					alert("Error");
				}
			});
		} 
	});

	// Regitser Form Validation
	$("#registerForm").submit(function(){
		$(".loader").show();
		var formData = $("#registerForm").serialize();
		// alert(formData); return false;
		$.ajax({
			headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:'/user/register',
			type:'post',
			data:formData,
			success:function(data){
				if(data.type=="validation"){
					$(".loader").hide();
					$.each(data.errors, function(i,error){
						$('#register-'+i).attr('style', 'color:red');
						$('#register-'+i).html(error);
						setTimeout(function(){
							$('#register-'+i).css({
								'display':'none'
							})
						}, 4000);
					});
				}else if(data.type=="success"){
					$(".loader").hide();
					$("#register-success").attr('style', 'color:green');
					$("#register-success").html(data.message);
				}
				// alert(resp);
			},error:function(){
				alert("Error");
			}
		});
	});

	// Login form validation
	$("#loginForm").submit(function(){
		$(".loader").show();
		var formData = $(this).serialize();
		$.ajax({
			headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:"/user/login",
			type:'post',
			data:formData,
			success:function(resp){
				// alert(resp);
				if(resp.type=="error"){
					$.each(resp.errors, function(i,error){
						$('.login-'+i).attr('style', 'color:red');
						$('.login-'+i).html(error);
						setTimeout(function(){
							$('.login-'+i).css({
								'display':'none'
							})
						}, 4000);
					});	
				}else if(resp.type=="inactive"){
					// alert(resp.message);
					$("#login-error").attr('style', 'color:red');
					$("#login-error").html(resp.message);
				}else if(resp.type=="incorrect"){
					// alert(resp.message);
					$("#login-error").attr('style', 'color:red');
					$("#login-error").html(resp.message);
				}else if(resp.type=="success"){
					window.location.href=resp.redirectUrl;
				}
			},error:function(){
				alert("Error");
			}
		})
	});

	// Forgot form validation
	$("#forgotForm").submit(function(){
		$(".loader").show();
		var formData = $(this).serialize();
		$.ajax({
			headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:"/user/forgot-password",
			type:'post',
			data:formData,
			success:function(resp){
				// alert(resp);
				$(".loader").hide();
				if(resp.type=="error"){
					$.each(resp.errors, function(i,error){
						$('.forgot-'+i).attr('style', 'color:red');
						$('.forgot-'+i).html(error);
						setTimeout(function(){
							$('.forgot-'+i).css({
								'display':'none'
							})
						}, 4000);
					});	
				}else if(resp.type=="success"){
					$(".forgot-success").attr('style', 'color:green');
					$(".forgot-success").html(resp.message);
				}
			},error:function(){
				$(".loader").hide();
				alert("Error");
			}
		})
	});

	// Reset form validation
	$("#resetPwdForm").submit(function(){
		$(".loader").show();
		var formData = $(this).serialize();
		$.ajax({
			headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:"/user/reset-password",
			type:'post',
			data:formData,
			success:function(resp){
				// alert(resp);
				$(".loader").hide();
				if(resp.type=="error"){
					$.each(resp.errors, function(i,error){
						$('.reset-'+i).attr('style', 'color:red');
						$('.reset-'+i).html(error);
						setTimeout(function(){
							$('.reset-'+i).css({
								'display':'none'
							})
						}, 4000);
					});	
				}else if(resp.type=="success"){
					$(".reset-success").attr('style', 'color:green');
					$(".reset-success").html(resp.message);
				}
			},error:function(){
				$(".loader").hide();
				alert("Error");
			}
		})
	});

	// Account Form Validation
	$("#accountForm").submit(function(){
		$(".loader").show();
		var formData = $(this).serialize();
		// alert(formData); return false;
		$.ajax({
			headers: { 
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
			},
			url:'/user/account',
			type:'post',
			data:formData,
			success:function(data){
				if(data.type=="validation"){
					$(".loader").hide();
					$.each(data.errors, function(i,error){
						$('#account-'+i).attr('style', 'color:red');
						$('#account-'+i).html(error);
						setTimeout(function(){
							$('#account-'+i).css({
								'display':'none'
							})
						}, 4000);
					});
				}else if(data.type=="success"){
					$(".loader").hide();
					$("#account-success").attr('style', 'color:green');
					$("#account-success").html(data.message);
				}
				alert(resp);
			},error:function(){
				alert("Error");
			}
		});
	});

});		