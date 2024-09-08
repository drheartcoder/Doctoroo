$(document).ready(function(){

//sweetAlert('hello');


/* delete by sweetalerts  confirmations*/
    
    /* delete client in client edit page */  
    $('.client-delete').click(function(){
        var client_id = $(this).attr("data-clientid");
    	swal({   title: "Are you sure?",   
    		     text: "You want to delete this client ?",  
    		     type: "warning",   
    		     showCancelButton: true,   
    		     confirmButtonColor: "#8cc63e",  
    		     confirmButtonText: "Yes",  
    		     cancelButtonText: "No",   
    		     closeOnConfirm: false,   
    		     closeOnCancel: false }, function(isConfirm){   
    		     	if (isConfirm) 
    		     	{ 
    		     	       swal("Deleted!", "Your client has been deleted.", "success"); 
                         
					       $.ajax({
					       url:site_url+"client/delete_client"+"/"+client_id,
					       type:"POST",
					       data:{client_id:client_id},
						       beforeSend: function() {
						       //ajaxindicatorstart('Please wait..');
						       },
						       success:function(response) {

						        window.location.href = site_url+"client";
						       },
						       complete:function() {

						       //ajaxindicatorstop();
						       }
					       });
    		     	} 
    		     	else
    		     	{ 
    		     	       swal("Cancelled", "Your data is safe :)", "error");          
    		        } 
    		    });
    });
    /* end delete client in client edit page */  


    /* delete staff in staff manage page */  
    $('.delete_selected_staff').click(function(){
        var staff_id = jQuery(this).data("staff");
    	swal({   title: "Are you sure?",   
    		     text: "You want to delete this staff ?",  
    		     type: "warning",   
    		     showCancelButton: true,   
    		     confirmButtonColor: "#8cc63e",  
    		     confirmButtonText: "Yes",  
    		     cancelButtonText: "No",   
    		     closeOnConfirm: false,   
    		     closeOnCancel: false }, function(isConfirm){   
    		     	if (isConfirm) 
    		     	{ 
    		     	       swal("Deleted!", "Your staff has been deleted.", "success"); 
                           location.href=site_url+"people_and_availability/delete_staff/"+btoa(staff_id);
					      
    		     	} 
    		     	else
    		     	{ 
    		     	       swal("Cancelled", "Your data is safe :)", "error");          
    		        } 
    		    });
    }); 
    /* end delete staff in staff manage page */  


    /* delete review in rew manage page */  
    $('.delete_selected_rew').click(function(){
        var rew_id = jQuery(this).data("rew");
        swal({   title: "Are you sure?",   
                 text: "You want to delete this review ?",  
                 type : "warning",   
                 showCancelButton   : true,   
                 confirmButtonColor : "#8cc63e",  
                 confirmButtonText  : "Yes",  
                 cancelButtonText   : "No",   
                 closeOnConfirm     : false,   
                 closeOnCancel      : false }, function(isConfirm){   
                    if (isConfirm) { 

                           swal("Deleted!", "Your review has been deleted.", "success"); 
                           location.href=site_url+"reviews/delete_rew/"+btoa(rew_id);
                    } 
                    else { 
                           swal("Cancelled", "Your review  is safe :)", "error");          
                    } 
                 });
    });
    /* end delete review in rew manage page */  


}); // end ready 