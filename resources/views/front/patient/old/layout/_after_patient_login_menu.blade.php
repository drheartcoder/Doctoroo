      <!--dashboard menu-->  
      <style>
           a:hover {
         cursor:pointer;
        }
      </style>    

      <?php
        $user = Sentinel::check();
      ?>
      <?php $currentUrl  = Route::getCurrentRoute()->getPath(); ?>
      <div class="dashboard-menu header">
        <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="nav">
                    <button class="dash-btnn hidden-lg">See a Doctor</button>
                    <div class="open-menu-txt hidden-lg"> Open Menu</div>
                     <ul class="nav-list">

                        <li class="nav-item"><a href="{{ url('/') }}/search/doctor/who-is-patient"  @if(Request::segment(3)=='who-is-patient') class="act" @endif  >See a Doctor</a></li>
                        <?php     
                        $flag = '';
                        $flag = get_patient_data();
                        ?>
                        @if($flag==false)
                          <li class="nav-item">
                             <a data-toggle="modal" href="#medical-histroy-modal">Medical History</a>
                          </li>
                        @else
                          <li class="nav-item" ><a href="{{url('/')}}/patient/medicalhistory/step-1"  @if(Request::segment(3)=='step-1' || Request::segment(3)=='step-2' || Request::segment(3)=='step-3') class="act" @endif  >Medical History</a>
                          </li>
                        @endif

                        <li class="nav-item"><a href="{{ url('/') }}/patient/medicalhistory/health" @if(Request::segment(3)=='health') class="act" @endif >My Health</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">My Pharmacy &amp; Orders</a></li>
                           {{--   <li class="nav-item"><a href="#" class="menu_class">Messages</a></li>
                        <li class="nav-item"><a href="#" class="menu_class">Documents</a></li> --}}
                        <li class="nav-item">

                          <a href="{{ url('/') }}/patient/question/answered" @if(Request::segment(3)=='answered' || Request::segment(3)=='unanswered') class="act" @endif >Ask Question</a>
                          
                        </li>
                        
                        <li class="nav-item">

                          <a href="{{ url('/') }}/patient/chat" @if(Request::segment(2)=='chat') class="act" @endif >Chat</a>
                          
                        </li>
                        

                        {{--show familiy memebers dropdown--}}
                       
                        <?php
                          $arr_familily_member = [];
                          $arr_familily_member = get_familiy_member();
                        ?>
                      
                        <li class="nav-item"><a href="#" class="menu_class">Family Members</a>
                             <ul class="nav-submenu">
                                  <li>
                                   <a onclick="setData('{{ base64_encode(0) }}')">
                                    {{ $user->first_name or '' }} {{ $user->last_name or '' }}</a> 
                                  </li>
                                  @if(isset($arr_familily_member) && sizeof($arr_familily_member)>0)
                                     @foreach($arr_familily_member as $familiy_member)
                                        <li class="nav-submenu-item">
                                
                                      <a onclick="setData('{{ base64_encode($familiy_member['id']) }}')">{{ $familiy_member['first_name'] or '' }} {{ $familiy_member['last_name'] or '' }}</a> 
                                     </li>
                                     @endforeach
                                  @endif
                              </ul>
                         </li>
                        

                        <li class="nav-item lst-bor-0"><a href="javascript:void(0);">My Account</a>
                          <ul class="nav-submenu">

                            <li><a @if($currentUrl=='patient/profile') class="act menu_class" @else class="menu_class" @endif href="{{url('/')}}/patient/profile">My Account</a></li>
                            <li><a href="{{url('/')}}/patient/dispute">My Disputes</a></li>

                            <li><a href="{{ url('/') }}/patient/preference" @if(Request::segment(2)=='preference') class="act" @endif >Preference</a></li>

                            <li><a href="{{ url('/') }}/patient/invitation" @if(Request::segment(2)=='preference') class="act" @endif >Referral</a></li>

                            <li><a href="{{ url('/') }}/patient/booking/upcoming" @if(Request::segment(2)=='booking') class="act" @endif >Booking</a></li>

                            <li><a href="{{ url('/') }}/patient/delete"  @if(Request::segment(2)=='delete') class="act" @endif >Delete Account</a></li>

                            <li><a href="{{ url('/') }}/patient/request"  @if(Request::segment(2)=='request') class="act" @endif >Request</a></li>

                           
                          </ul>
                        </li>
                      </ul>
                     <div class="clr"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     <!--dashboard menu-->
    <script>
        function setData(ref)
        {
              var token  = $("input[name='_token']").val();  
              var data   = new FormData();
              data.append('family_member_id',ref);  
              data.append('_token', token);  

             var url = "{{url('/')}}/patient/medicalhistory/set_familiy_member";
             $.ajax({
             url  : url,
             type : 'POST',
             data:data,           
             contentType: false,     
             cache: false,          
             processData:false,  
              success: function(res)   
              {
                  console.log('success');
                  location.reload();
              } 
             });  
        }
    </script>