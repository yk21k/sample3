$(document).ready(function(){
	//Check admin password is correct or not
	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		// alert(current_pwd);
		$.ajax({
        	headers: {
        	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
			type:'post',
			url:'/admin/check-current-password',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp=="false"){
					$("#verifyCurrentPwd").html("Current Password is Incorrect !!");
				}else if(resp=="true"){
					$("#verifyCurrentPwd").html("Current Password is Correct !!");
				}
			},error:function(){
				alert("Error");
			}
		})
	});
	// Update CMS Page Status
	$(document).on("click", ".updateCmsPageStatus", function(){
	// $("#updateCmsPageStatus").on("click", function){
		var status = $(this).children("i").attr("status");
		var page_id = $(this).attr("page_id");
		// alert(page_id);
		$.ajax({
			headers: {
        	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	type:'post',
        	url:'/admin/update-cms-page-status',
        	data:{status:status, page_id:page_id},
        	success:function(resp){
        		if(resp['status']==0){
        			$("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
        		}else if(resp['status']==1){
        			$("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color: #078aed;' status='Active'></i>");
        		}
        	},error:function(){
        		alert("Error");
        	}     	
		})
	});
	
	// Update Sub Admin Status
	$(document).on("click", ".updateSubadminStatus", function(){
	// $("#updateSubadminStatus").on("click", function){
		var status = $(this).children("i").attr("status");
		var subadmin_id = $(this).attr("subadmin_id");
		// alert(subadmin);
		$.ajax({
			headers: {
        	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
        	type:'post',
        	url:'/admin/update-subadmin-status',
        	data:{status:status, subadmin_id:subadmin_id},
        	success:function(resp){
        		if(resp['status']==0){
        			$("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
        		}else if(resp['status']==1){
        			$("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-on' style='color: #078aed;' status='Active'></i>");
        		}
        	},error:function(){
        		alert("Error");
        	}     	
		})
	});
    // Confirm the delection of CMS Page
	$(document).on("click", ".confirmDelete", function(){
		var name = $(this).attr('name');
		if(confirm('Are you sure to delete this '+name+'?')){
			return true ;
		}
		return false;
	});


});