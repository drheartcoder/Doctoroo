@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')

   <div class="middle-section">
         <div class="container">
            <div data-responsive-tabs class="garag-profile-nav ans-tabs">
               <nav>
                  <ul>
                     <li><a href="#one">Doctor Request</a> </li>
                     <li><a href="#two">Pharmacy Request</a></li>
                  </ul>
               </nav>

              <div class="content res-full-tab" style="background:none;">
                    <div id="one">
                        <div class="tab-section">
                               <div class="med-his-txt">
                                 Following are the doctors which invited to you, You can accept or decline a request. 
                               </div>
                            <div class="doc-dash-right-bx">
                          
                              <div class="request-details-bx">

                               <div class="col-sm-12 col-md-6 col-lg-8">

                                 @include('front.layout._operation_status')

                                 <div class="doc-dash-right-bx">
                                     <div class="tble-frmt">
                                        <div class="tble-title">
                                           Doctor Request
                                        </div>
                                         <div class="content-d">
                                            <div class="table-responsive basic-table">
                                               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                                @if(isset($arr_invited_doctor) && sizeof($arr_invited_doctor)>0)

                                                    @foreach($arr_invited_doctor as $invite)

                                                    <tr>
                                                       <td>
                                                          Dr. {{ isset($invite['userinfo']['first_name'])?$invite['userinfo']['first_name']:'NA' }}
                                                           {{ isset($invite['userinfo']['last_name'])?$invite['userinfo']['last_name']:'' }}
                                                       </td>
                                                       <td>
                                                          {{ isset($invite['doctor_info']['speciality'])?$invite['doctor_info']['speciality']:'NA' }}
                                                       </td>
                                                       <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                                       <td>

                                                         <div class="certi-btn" style="margin:0;">
                                                            <button onclick="changeStatus('{{ base64_encode($invite['id']) }}','accept')" class="details-btn select-btn">Accept</button>
                                                            <button onclick="changeStatus('{{ base64_encode($invite['id']) }}','decline')" class="details-btn">Decline</button>
                                                         </div>

                                                       </td>
                                                    </tr>
                                                    
                                                @endforeach
                                                @else
                                                <tr>
                                                  <td>
                                                      <div class="search-grey-bx">
                                                        <div class="row">
                                                              {{ 'No any requests are present.' }}
                                                        </div>
                                                     </div> 
                                                  </td>
                                                </tr>          
                                                @endif
                                               </table>
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

            </div>
         </div>
      </div>

      <script  src="{{ url('/') }}/public/js/responsivetabs.js"></script>
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
            function changeStatus(id,status)
            {
                window.location.href = '{{ $module_url_path }}/change_status/'+id+'/'+status;
            }
    </script>       
@endsection