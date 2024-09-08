@extends('front.doctor.layout.master')
@section('main_content')

	 <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
     </div>	
     <div class="container-fluid fix-left-bar">
         <div class="row">
          @include('front.doctor.layout._sidebar')
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="inner-head">{{ isset($page_title)?$page_title:'' }}</div>
                       <div class="head-bor"></div>
                    </div>
                    
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Past Consultations
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                   
                                 @if(isset($arr_past_consultation) && sizeof($arr_past_consultation)>0) 

                                       @foreach($arr_past_consultation as $consultations)

                                          @if(isset($consultations['consultation_date']) && $consultations['consultation_date']!='')
                                             <?php 
                                                $date = '';
                                                $date = date('d M Y',strtotime($consultations['consultation_date']))
                                             ?>
                                          @endif

                                           @if(isset($consultations['consultation_time']) && $consultations['consultation_time']!='')
                                             <?php 
                                                $time = '';
                                                $time = date('h:i a',strtotime($consultations['consultation_time']))
                                             ?>
                                          @endif

                                          <tr>
                                             <td style="color: #868686;">{{ $date or '' }}  {{ $time or '' }}</td>
                                             <td>
                                             @if(isset($consultations['familiy_member_info']) && sizeof($consultations['familiy_member_info'])>0)

                                                 {{ $consultations['familiy_member_info']['first_name'] or '' }}
                                                 {{ $consultations['familiy_member_info']['last_name'] or '' }}

                                             @else

                                                {{ $consultations['patient_user_details']['first_name'] or '' }}
                                                {{ $consultations['patient_user_details']['last_name'] or '' }}

                                             @endif
                                             </td>
                                             <td>

                                                <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultations['id']) }}/{{ base64_encode($consultations['family_member_id']) }}/{{ base64_encode(1) }}">
                                                   Details
                                               </a>
                                             

                                             </td>
                                          </tr>
                                       @endforeach
                                  @else
                                       <div class="search-grey-bx">
                                          <div class="row">
                                             {{ 'No past consultations are present.' }}
                                          </div>
                                      </div>

                                 @endif
                                 </table>
                              </div>
                               </div>
                           </div>
                        </div>
                     </div>


                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Past Prescriptions
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                    @if(isset($arr_past_prescription) && sizeof($arr_past_prescription)>0) 

                                       @foreach($arr_past_prescription as $consultations)

                                           @if(isset($consultations['consultation_date']) && $consultations['consultation_date']!='')
                                             <?php 
                                                $date = '';
                                                $date = date('d M Y',strtotime($consultations['consultation_date']))
                                             ?>
                                          @endif

                                           @if(isset($consultations['consultation_time']) && $consultations['consultation_time']!='')
                                             <?php 
                                                $time = '';
                                                $time = date('h:i a',strtotime($consultations['consultation_time']))
                                             ?>
                                          @endif


                                           <tr>
                                                <td style="color: #868686;">{{ $date or '' }}  {{ $time or '' }}</td>
                                                <td>
                                                 @if(isset($consultations['familiy_member_info']) && sizeof($consultations['familiy_member_info'])>0)

                                                    {{ $consultations['familiy_member_info']['first_name'] or '' }}
                                                    {{ $consultations['familiy_member_info']['last_name'] or '' }}

                                                @else
                                                
                                                   {{ $consultations['patient_user_details']['first_name'] or '' }}
                                                   {{ $consultations['patient_user_details']['last_name'] or '' }}

                                                @endif
                                                </td>
                                                <td>
                                                
                                                  <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultations['id']) }}/{{ base64_encode($consultations['family_member_id']) }}/{{ base64_encode(1) }}">
                                                         Details
                                                        </a>
                                                  
                                                </td>
                                          </tr>
                                    
                                       @endforeach
                                    @else

                                       <div class="search-grey-bx">
                                          <div class="row">
                                             {{ 'No past prescriptions are present.' }}
                                          </div>
                                      </div>

                                    @endif
                  
                                 </table>
                              </div>
                               </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Past Medical Certificates
                              </div>
                              <div class="content-d">
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">

                                   @if(isset($arr_medical_certificate) && sizeof($arr_medical_certificate)>0) 

                                       @foreach($arr_medical_certificate as $consultations)
                                         
                                          @if(isset($consultations['consultation_date']) && $consultations['consultation_date']!='')
                                             <?php 
                                                $date = '';
                                                $date = date('d M Y',strtotime($consultations['consultation_date']))
                                             ?>
                                          @endif

                                           @if(isset($consultations['consultation_time']) && $consultations['consultation_time']!='')
                                             <?php 
                                                $time = '';
                                                $time = date('h:i a',strtotime($consultations['consultation_time']))
                                             ?>
                                          @endif

                                            <tr>
                                                <td style="color: #868686;">{{ $date or '' }}  {{ $time or '' }}</td>
                                                <td>
                                                 @if(isset($consultations['familiy_member_info']) && sizeof($consultations['familiy_member_info'])>0)

                                                    {{ $consultations['familiy_member_info']['first_name'] or '' }}
                                                    {{ $consultations['familiy_member_info']['last_name'] or '' }}

                                                @else
                                                
                                                   {{ $consultations['patient_user_details']['first_name'] or '' }}
                                                   {{ $consultations['patient_user_details']['last_name'] or '' }}

                                                @endif
                                                </td>
                                                <td>
                                                    
                                                  <a href="{{ $module_consult_path }}/details/{{ base64_encode($consultations['id']) }}/{{ base64_encode($consultations['family_member_id']) }}/{{ base64_encode(1) }}">
                                                         Details
                                                 </a>
                                            
                                                </td>
                                          </tr>

                                        @endforeach
                                    @else
                                       <div class="search-grey-bx">
                                          <div class="row">
                                             {{ 'No past medical certificate are present.' }}
                                          </div>
                                       </div>
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

      <link href="{{ url('/') }}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <script src="{{ url('/') }}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script>
         (function($){
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
                 $(".content-d").mCustomScrollbar({theme:"dark"});
         
         });
         })(jQuery);
      </script>
@endsection