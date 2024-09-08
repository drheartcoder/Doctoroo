@extends('front.pharmacy.layout.master')                 
@section('main_content')
  
      <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
    <div id="after-login-header"></div>
    <div class="banner-home inner-page-box">
        <div class="bg-shaad doc-bg-head">
        </div>
    </div>
    <!--calender section start-->
    <div class="container-fluid fix-left-bar">
        <div class="row">
                @include('front.pharmacy.layout.profile_layout._profile_sidebar') 
            <div class="col-sm-12 col-md-9 col-lg-10">
                <div class="das-middle-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="inner-head">{{ $page_title or '' }}</div>
                            <div class="head-bor"></div>
                            <div class="patent-name">
                             Hi, {{ $arr_invitation['first_name'] or '' }} 
                              {{ $arr_invitation['last_name'] or '' }}
                            </div>
                        </div>
                    </div>
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-2">
                      
                  </div> 
                   <div class="col-sm-12 col-md-12 col-lg-9">
                      <div data-responsive-tabs class="garag-profile-nav ans-tabs">
                        <nav>
                            <ul>
                                <li><a href="#one">Doctor Invitation</a> </li>
                                <li><a href="#two">Pharmacy Invitation</a></li>
                                <li><a href="#three">Patient Invitation</a></li>
                            </ul>
                        </nav>
                     <div class="content res-full-tab" style="background:none;">
                      <div id="one">
                          <div class="tab-section"> 



                            <form action="{{ $module_url_path }}/invitation/create_doctor_invitation" method="post" name="frm_invite_doctor" id="frm_invite_doctor">
                            {{ csrf_field() }}
                              <div class="col-sm-12 col-md-6 col-lg-6">


                                   @include('front.layout._operation_status')
                    
                                   <div class="pharma-step-bx">       
                                      <div class="pharma-step-content">

                                          <div class="user_box">
                                              <input type="text" name="first_name" value=""  data-rule-required="true" class="input_acct-logn" placeholder="Doctor First name"/>
                                               <span class='error'>{{ $errors->first('first_name') }}</span>
                                           </div>
                                           <div class="user_box">

                                                <input type="text" class="input_acct-logn" value="" data-rule-required="true" name="last_name" placeholder="Doctor Last name">
                                                <span class='error'>{{ $errors->first('last_name') }}</span>
                                            
                                           </div>
                                           <div class="user_box">

                                             <input type="text" class="input_acct-logn" value="" data-rule-required="true" data-rule-maxlength="10" data-rule-minlength="10" name="phone" placeholder="Doctor Phone number">
                                             <span class='error'>{{ $errors->first('phone') }}</span>

                                           </div>
                                           <div class="user_box">

                                              <input type="text" class="input_acct-logn" value="" data-rule-required="true" data-rule-email="true" name="email_id" placeholder="Doctor Email">
                                               <span class='error'>{{ $errors->first('email_id') }}</span>

                                           </div>
                                           <div class="user_box">

                                               <input type="text" class="input_acct-logn" value="" data-rule-required="true" name="medical_practice_name" placeholder="Medical practice name">
                                               <span class='error'>{{ $errors->first('medical_practice_name') }}</span>

                                           </div>
                                           <div class="user_box">
                                              
                                              <input type="text" class="input_acct-logn" value="" data-rule-required="true" name="address" placeholder="Address/suburb">
                                              <span class='error'>{{ $errors->first('address') }}</span>    


                                           </div>
                                    </div>
                                 </div>   

                                  <div class="chat-wth-btn">
                                      <input type="submit" name="btn_invite_doctor" value="Invite Doctor" class="btn-grn" >
                                  </div>

                             </div>
                            </form>

                            </div>
                        </div>


                      {{--  second section --}}
                      <div id="two">
                          <div class="tab-section"> 

                             <form action="{{ $module_url_path }}/invitation/create_pharmacy_invitation" method="post" name="frm_invite_pharmacy" id="frm_invite_pharmacy">
                              {{ csrf_field() }}

                              <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="pharma-step-bx">       
                                      <div class="pharma-step-content">
                                       

                                            <div class="user_box">
                                              <input type="text" name="pharmacy_name" value=""  data-rule-required="true" class="input_acct-logn" placeholder="Pharmacy name"/>
                                              <span class='error'>{{ $errors->first('pharmacy_name') }}</span>
                                           </div>



                                           <div class="user_box">

                                               <input type="text" class="input_acct-logn" value="{{ $arr_invitation['reg_doctor_phone'] or '' }}" data-rule-required="true"  data-rule-number ="true" data-rule-minlength = "10" data-rule-maxlength = "10" name="phone" placeholder="Pharmacy Phone number">
                                              <span class='error'>{{ $errors->first('phone') }}</span>
                                        
                                            
                                            </div>
                                          
                                           <div class="user_box">

                                              <input type="text" class="input_acct-logn" value="{{ $arr_invitation['reg_doctor_email'] or '' }}" data-rule-required="true" data-rule-email="true" name="email_id" placeholder="Pharmacy Email">
                                               <span class='error'>{{ $errors->first('email_id') }}</span>

                                           </div>
                                           <div class="user_box">

                                               <input type="text" class="input_acct-logn" value="{{ $arr_invitation['reg_doctor_address'] or '' }}" data-rule-required="true" name="address" placeholder="Address/suburb">
                                               <span class='error'>{{ $errors->first('address') }}</span>

                                           </div>
                                          
                                    </div>
                                 </div>   

                                  <div class="chat-wth-btn">
                                      <input type="submit" name="btn_invite_pharmacy" value="Invite Pharmacy" class="btn-grn" >
                                  </div>

                                  
                             </div>
                             </form>
                        </div>
                      </div>


                     {{--  third section --}}
                      <div id="three">
                         
                          <div class="tab-section">
                           
                          <form action="{{ $module_url_path }}/invitation/create_patient_invitation" method="post" name="frm_invite_patient" id="frm_invite_patient">
                            {{ csrf_field() }}

                             <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="pharma-step-bx" >       
                                   <div class="pharma-step-content" style="margin-top:15px !important;">
                                    
                                      <div class="user_box">
                                          <input type="text" name="first_name" value=""  data-rule-required="true" class="input_acct-logn" placeholder="Patient First name"/>
                                           <span class='error'>{{ $errors->first('first_name') }}</span>
                                       </div>
                                       <div class="user_box">

                                            <input type="text" class="input_acct-logn" value="" data-rule-required="true" name="last_name" placeholder="Patient Last name">
                                            <span class='error'>{{ $errors->first('last_name') }}</span>
                                        
                                       </div>
                                       <div class="user_box">

                                           <div class="radio-btns">

                                                <div class="radio-btn">
                                                   <input type="radio"  value="Male"  id="Radio13" name="gender"/>
                                                   <label for="Radio13">Male</label>
                                                   <div class="check"></div>
                                                </div>
                                               
                                                <div class="radio-btn">
                                                   <input type="radio" value="Female"   id="Radio14" name="gender"/>
                                                   <label for="Radio14">Female</label>
                                                   <div class="check">
                                                      <div class="inside"></div>
                                                   </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="user_box">
                                            
                                         
                                            <div class="select-style pharma-step-drp" style="min-width:30px;">
                                              <select class="frm-select" name="birth_day" id="birth_day" >
                                                  <option value="">- Date -</option>
                                                     @for($i=1;$i<=31;$i++)
                                                    
                                                        <option  value="{{$i}}">{{$i}}</option>
                                                    
                                                     @endfor
                                               </select>
                                            </div>

                                          <div class="select-style pharma-step-drp">
                                              <select class="frm-select" name="birth_month" id="birth_month" >
                                                  <option value="">- Month -</option>
                                                  
                                                    @if(isset($arr_month) && sizeof($arr_month))
                                                      
                                                      @foreach($arr_month as $key=>$month)
                                                        <option  value="{{ $key }}">{{ $month or '' }}</option>
                                                      @endforeach
                                                    
                                                    @endif
                                               </select>
                                          </div>

                                           <div class="select-style pharma-step-drp">
                                              <select class="frm-select" name="birth_year" id="birth_year" >
                                                  <option value="">- Year -</option>
                                                  <?php $current_year = 2017; ?>
                                                    @for($i=1900;$i<=$current_year;$i++)
                                                    
                                                        <option  value="{{$i}}">{{$i}}</option>
                                                    
                                                     @endfor
                                               </select>
                                          </div>

                                        </div>

                                       <div class="user_box">
                                         <input type="text" class="input_acct-logn" value="" data-rule-required="true"  data-rule-number ="true" data-rule-minlength = "10" data-rule-maxlength = "10" name="phone" placeholder="Patient Phone number">
                                          <span class='error'>{{ $errors->first('phone') }}</span>
                                       </div>
                                    
                                     <div class="user_box">
                                        <input type="text" class="input_acct-logn" value=""  data-rule-email="true" name="email_id" placeholder="Patient Email">
                                         <span class='error'>{{ $errors->first('email_id') }}</span>
                                     </div>

                                     <div class="user_box">
                                         <input type="text" class="input_acct-logn" value="{{ $arr_invitation['reg_doctor_address'] or '' }}" data-rule-required="true" name="address" placeholder="Address/suburb">
                                         <span class='error'>{{ $errors->first('address') }}</span>

                                    </div>
                                    
                                     <div class="user_box request-details-bx">
                                      <div class="check-box pharmacy-signup2">
                                        <input type="checkbox" class="css-checkbox" name="is_pharmacy_invited" value=1 id="checkbox7" tabindex="3"/>
                                          <label class="css-label lite-red-check remember_me" for="checkbox7">make my pharmacy
                                          </label>
                                       </div>
                                    </div>

                                  </div>
                                </div>
                                  <div class="chat-wth-btn">
                                      <input type="submit" name="btn_invite_patient" value="Invite Patient" class="btn-grn" >
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
</div>
</div>
</div>

 

    <script>

   
        $(document).on('responsive-tabs.initialised', function(event, el) {
          
        });

        $(document).on('responsive-tabs.change', function(event, el, newPanel) {
      
        });

        $('[data-responsive-tabs]').responsivetabs({
            initialised: function() {
           
            },

            change: function(newPanel) {
        
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