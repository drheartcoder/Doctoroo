@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')

   <div class="middle-section">
         <div class="container">
            <div data-responsive-tabs class="garag-profile-nav ans-tabs">
               <nav>
                  <ul>
                     <li><a href="#one">Doctor Invitation</a> </li>
                     <li><a href="#two">Pharmacy Invitation</a></li>
                     <li><a href="#three">Patient Invitation</a></li>
                  </ul>
               </nav>


               <div class="content res-full-tab">
                  <div id="one">
                     <div class="tab-section">
                        <div class="middle-section">
                           @include('front.layout._operation_status')
                         <div class="container">

                           <form action="{{ $module_url_path }}/invitation/create_doctor_invitation" method="post" name="frm_invite_doctor" id="frm_invite_doctor">
                           {{ csrf_field() }}
                            <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                               <div class="clearfix"></div>
                               <div class="add-new-head">
                                  Doctor Details
                               </div>
                               <div class="row">
                                  <div class="col-sm-12 col-md-12 col-lg-6">
                                    
                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">First Name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="First Name" data-rule-required="true" name="first_name" class="form-inputs" type="text"/>
                                              <span class='error'>{{ $errors->first('first_name') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>


                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Last Name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                             <input placeholder="Last Name" name="last_name" data-rule-required="true" class="form-inputs" type="text"/>
                                              <span class='error'>{{ $errors->first('last_name') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                      

                                      <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Phone Number</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Phone Number" data-rule-required="true" data-rule-maxlength="10" data-rule-minlength="10" name="phone" class="form-inputs" type="text" />
                                              <span class='error'>{{ $errors->first('phone') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Email</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Email Address" data-rule-required="true" data-rule-email="true" name="email_id" class="form-inputs" type="text"/>
                                              <span class='error'>{{ $errors->first('email_id') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                  
                                      <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Medical practice name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Medical practice name" data-rule-required="true" name="medical_practice_name" class="form-inputs" type="text"/>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                  
                                      <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Address/suburb</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Address/suburb" data-rule-required="true" name="address" class="form-inputs" type="text"/>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                  </div> 
                                  <div class="clearfix"></div>
                               </div>

                               <div class="pull-right">
                                <input type="submit" class="search-btn" name="btn_invite_doctor" id="btn_invite_doctor" value="Invite Doctor">
                               </div>
                               <div class="clearfix"></div>
                               <br/>
                            </div>

                            </form>

                         </div>
                      </div>
                     </div>
                 </div>
                  <div id="two">
                     <div class="tab-section">
                        <div class="middle-section">
                         <div class="container">

                            <form action="{{ $module_url_path }}/invitation/create_pharmacy_invitation" method="post" name="frm_invite_pharmacy" id="frm_invite_pharmacy">
                              {{ csrf_field() }}

                            <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                               <div class="clearfix"></div>
                               <div class="add-new-head">
                                  Pharmacy Details
                               </div>
                               <div class="row">
                                  <div class="col-sm-12 col-md-12 col-lg-6">
                                    
                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Pharmacy Name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                               <input placeholder="Pharmacy name" name="pharmacy_name" data-rule-required="true" class="form-inputs" type="text"/>
                                               <span class='error'>{{ $errors->first('pharmacy_name') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Address</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input data-rule-required="true" name="address" placeholder="Address/suburb" class="form-inputs" type="text"/>
                                               <span class='error'>{{ $errors->first('address') }}</span>

                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                      

                                      <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Phone Number</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input data-rule-required="true"  data-rule-number ="true" data-rule-minlength = "10" data-rule-maxlength = "10" name="phone" placeholder="Phone number" class="form-inputs" type="text" />
                                              <span class='error'>{{ $errors->first('phone') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Email</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input data-rule-required="true" data-rule-email="true" name="email_id" placeholder="Email" class="form-inputs" type="text"/>
                                                <span class='error'>{{ $errors->first('email_id') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
     
                                  </div>
                                  
                                  <div class="clearfix"></div>
                               </div>

                             

                               <div class="pull-right">
                                    <input type="submit" class="search-btn" name="btn_invite_pharmacy" id="btn_invite_pharmacy" value="Invite Pharmacy">
                               </div>
                               <div class="clearfix"></div>
                               <br/>
                            </div>
                         </div>
                         </form>
                      </div>

                     
                  </div>
                </div>
                  <div id="three">
                     <div class="tab-section">
                      <div class="middle-section">
                         <div class="container">

                        <form action="{{ $module_url_path }}/invitation/create_patient_invitation" method="post" name="frm_invite_patient" id="frm_invite_patient">
                            {{ csrf_field() }}

                            <div class="back-whhit-bx patient-white-bx" style="background:#fff">
                               <div class="clearfix"></div>
                               <div class="add-new-head">
                                  Patient Details
                               </div>
                               <div class="row">
                                  <div class="col-sm-12 col-md-12 col-lg-6">
                                   
                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">First Name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="First Name" name="first_name" value=""  data-rule-required="true" class="form-inputs" type="text"/>
                                             <span class='error'>{{ $errors->first('first_name') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>


                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Last Name</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Last Name" data-rule-required="true" name="last_name"  class="form-inputs" type="text"/>
                                             <span class='error'>{{ $errors->first('last_name') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Gender</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <div class="radio-btns user_box pre-rad">
                                                 <div class="radio-btn aftr-cl">
                                                    <input checked="checked" id="Radio4" value="Male" name="gender" type="radio"/>
                                                    <label for="Radio4">Male</label>
                                                    <div class="check"></div>
                                                 </div>
                                                 <div class="radio-btn aftr-cl">
                                                    <input  id="Radio5" name="gender" value="Female" type="radio"/>
                                                    <label for="Radio5" >Female</label>
                                                    <div class="check"></div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Email</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Email Address" data-rule-email="true" name="email_id" class="form-inputs" type="text"/>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Date of Birth</div>
                                           </div>
                                           <div class="col-sm-4 col-md-3 col-lg-2">
                                              <div class="select-style my-pati">
                                                 <select class="frm-select" name="birth_day">
                                                    <option>- Date -</option>
                                                     @for($i=1;$i<=31;$i++)
                                                    
                                                        <option  value="{{$i}}">{{$i}}</option>
                                                    
                                                     @endfor
                                                 </select>
                                              </div>
                                           </div>
                                           <div class="col-sm-4 col-md-3 col-lg-2 margn">
                                              <div class="select-style my-pati">
                                                 <select class="frm-select" name="birth_month">
                                                    <option>- Month -</option>
                                                      @if(isset($arr_month) && sizeof($arr_month))
                                                      
                                                      @foreach($arr_month as $key=>$month)
                                                        <option  value="{{ $key }}">{{ $month or '' }}</option>
                                                      @endforeach
                                                    
                                                    @endif
                                                 </select>
                                              </div>
                                           </div>
                                           <div class="col-sm-4 col-md-3 col-lg-3">
                                              <div class="select-style my-pati">
                                                 <select class="frm-select" name="birth_year">
                                                    <option>- Year -</option>
                                                  <?php $current_year = 2017; ?>
                                                    @for($i=1900;$i<=$current_year;$i++)
                                                    
                                                        <option  value="{{$i}}">{{$i}}</option>
                                                    
                                                     @endfor
                                                 </select>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                     <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Phone No.</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input placeholder="Phone Number"  name="phone" data-rule-required="true"  data-rule-number ="true" data-rule-minlength = "10" data-rule-maxlength = "10" class="form-inputs" type="text"/>
                                              <span class='error'>{{ $errors->first('phone') }}</span>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                      <div class="user-box">
                                        <div class="row">
                                           <div class="col-sm-12 col-md-3 col-lg-5">
                                              <div class="form-lable">Address</div>
                                           </div>
                                           <div class="col-sm-12 col-md-9 col-lg-7">
                                              <input data-rule-required="true" name="address" placeholder="Address/suburb" class="form-inputs" type="text"/>
                                               <span class='error'>{{ $errors->first('address') }}</span>

                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>

                                  </div>


                                  <div class="clearfix"></div>
                               </div>
                               <div class="pull-right">
                                  <input type="submit" class="search-btn" name="btn_invite_patient" id="btn_invite_patient" value="Invite Patient">
                               </div>

                               <div class="clearfix"></div>
                               <br/>
                            </div>
                         </div>

                         </form>

                      </div>
                     </div>
                  </div>
               </div>



            </div>
         </div>
      </div>
      <!--dashboard section-->
      <!--responsive tab script start-->
     <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
      <script>
         $(document).on('responsive-tabs.initialised', function(event, el) {
                    //console.log(el);
                });
         
            $(document).on('responsive-tabs.change', function(event, el, newPanel) {
                //console.log(el);
                //console.log(newPanel);
            });
         
            $('[data-responsive-tabs]').responsivetabs({
                initialised: function() {
                    //console.log(this);
                },
         
                change: function(newPanel) {
                    //console.log(newPanel);
                }
            });


           $('#frm_invite_doctor').validate({
            errorElement:'span',
                errorPlacement: function (error, element) 
                {
                  
                    error.insertAfter(element).fadeOut(4000);
                 
                },
               messages: {
                            first_name    : "Pleae enter a first name.",
                            last_name     : "Pleae enter a last name.",
                            address       :'Please enter address or suburb.',
                            medical_practice_name :'Please enter medical practice name.',
                            email_id: 
                            {
                                required : "Please enter email id.",
                                email    : "Please enter a valid email id."
                            },

                            phone: 
                            {
                                required  : "Please enter phone number.",
                                minlength : "Please enter 10 digit phone number.",
                                maxlength : "Please enter 10 digit phone number.",
                                number    : "Only numbers are allowd.",
                            },
                       
                           
                        }

            
       });

       $('#frm_invite_doctor').submit(function()
       {
              var form   = $(this);
              var isValid = form.valid();
              if(isValid)
              {
                showProcessingOverlay();
              }


       });


       $('#frm_invite_pharmacy').validate({
                errorElement:'span',
                errorPlacement: function (error, element) 
                {
                  
                    error.insertAfter(element).fadeOut(4000);
                 
                },
               messages: {
                            pharmacy_name    : "Please enter a pharmacy name.",
                            address          :'Please enter address or suburb.',
                            email_id: 
                            {
                                required    : "Please enter email id.",
                                email       : "Please enter a valid email id."
                            },

                            phone: 
                            {
                                required  : "Please enter phone number.",
                                minlength : "Please enter 10 digit phone number.",
                                maxlength : "Please enter 10 digit phone number.",
                                number    : "Only numbers are allowd.",
                            },
                       
                           
                        }


       });

      $('#frm_invite_pharmacy').submit(function()
       {
              var form   = $(this);
              var isValid = form.valid();
              if(isValid)
              {
                showProcessingOverlay();
              }


       });



       $('#frm_invite_patient').validate({
                errorElement:'span',
                errorPlacement: function (error, element) 
                {
                  
                    error.insertAfter(element).fadeOut(4000);
                 
                },
                messages: {
                            first_name       : "Please enter a first name.",
                            last_name        : "Pleae enter a last name.",
                            address          : 'Please enter address or suburb.',
                            email_id: 
                            {
                                required    : "Please enter email id.",
                                email       : "Please enter a valid email id."
                            },

                            phone: 
                            {
                                required  : "Please enter phone number.",
                                minlength : "Please enter 10 digit phone number.",
                                maxlength : "Please enter 10 digit phone number.",
                                number    : "Only numbers are allowd.",
                            },
                       
                           
                        }


       });
    
       $('#frm_invite_patient').submit(function()
       {
              var form   = $(this);
              var isValid = form.valid();
              if(isValid)
              {
                showProcessingOverlay();
              }


       });


      </script>

@endsection