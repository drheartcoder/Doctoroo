@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
  
     <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
      <div class="container-fluid fix-left-bar">
         <div class="row">
         
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="inner-head">Delete Account</div>
                        <div class="head-bor"></div>
                     </div>
                 
                     <form method="post" action="{{ url('/') }}/close_account" id="frm_delete_account" name="frm_delete_account">
                     {{ csrf_field() }}
                        <div class="col-sm-12 col-md-12 col-lg-12">

                              @include('front.layout._operation_status')

                           <div class="doc-dash-right-bx pad-both">
                             
                              <div class="row">
                               
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12 col-md-12 col-lg-5">
                                       <div class="user_box">
                                           <input placeholder="Enter Password" name="password" data-rule-required="true" class="form-inputs" type="password"/>

                                       </div>
                                    </div>
                                   
                         
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                    
                                      <button class="btn-grn pull-right" type="button" onclick="validateCloseForm()"  >Delete Account</button> 
                                     
                                    </div>
                              </div>


                           </div>
                        </div>

                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script>

           function validateCloseForm()
           {
                 var validator = $("#frm_delete_account").validate({
                 errorElement: 'span', 
                  errorPlacement: function (error, element) 
                  {
                    
                      error.insertAfter(element).fadeOut(4000);
                   
                  },
                 messages: {
                            password: "Pleae enter a password.",
                                
                        }
                
               }); 
               if($("#frm_delete_account").valid() == true)
               {

                   deleteDoctorAccount();
               }
               else
               {
                 return false;
               }

          }
                 
         function deleteDoctorAccount()
         {
                 swal({
                title: "Are you sure?",
                text: "Do you want to close your account?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
               
                
             },
             function(isConfirm)
             {
                   if(isConfirm)
                   {
                        $('#frm_delete_account').submit();
                   }
            });

              

         }

      </script>
@endsection