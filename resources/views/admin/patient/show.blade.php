@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }    
    .image-avtar.left{display: inline-block; margin-right: 5px;}                            
</style>
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li><a href="{{ url($admin_panel_slug.'/patient') }}">Manage Patient </a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($module_title)?$module_title:"Patient Details"}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i> {{ isset($module_title)?$module_title:"Patient Details" }} </h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <div class="box-content">
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Personal Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{($data_info['userinfo']['title'])?$data_info['userinfo']['title']:''}} &nbsp;&nbsp;{{($data_info['userinfo']['first_name'])?$data_info['userinfo']['first_name']:'NA'}}&nbsp;&nbsp;{{($data_info['userinfo']['last_name'])?$data_info['userinfo']['last_name']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                      
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Gender</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if($data_info['gender']=="M")
                           Male
                           @elseif($data_info['gender']=="F")
                           Female
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Date of Birth</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{($data_info['date_of_birth'])? date('d-M-Y',strtotime($data_info['date_of_birth'])):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{($data_info['userinfo']['email'])?$data_info['userinfo']['email']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Contact No.</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="patient_phone_no"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>

                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_info['mobile_no']) && $data_info['mobile_no']!="")
                           {{isset($mobcode_data['phonecode']) ? '+'.$mobcode_data['phonecode'] : ''}}<span id="patient_mobile_no">{{isset($data_info['mobile_no'])? decrypt_value($data_info['mobile_no']) :''}}</span>
                           @else
                           <?php echo"NA";?>
                           @endif  
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Address</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls" id="patient_suburb"></div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Patient Profile</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          
                           <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <div style="width: 200px; height: 150px;" class="fileupload-new img-thumbnail">
                                       @if(isset($data_info['userinfo']['profile_image']) && $data_info['userinfo']['profile_image']!="" && file_exists($patient_profile_img_base_path.$data_info['userinfo']['profile_image']))
                                       <img src="{{$patient_profile_img_public_path.$data_info['userinfo']['profile_image']}}" width="188px" height="175px" alt=""/>
                                       @else
                                       <img src="{{url('/')}}/public/images/no-image.png" alt="" width="188px" height="175px" />
                                       @endif 
                                    </div>
                                 </div>
                        </div>
                     </div>
                      <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">My Referral Code</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{($data_info['my_referral_code'])?$data_info['my_referral_code']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Referred By</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{($referred_user['title'])?$referred_user['title']:''}} &nbsp;&nbsp;{{($referred_user['first_name'])?$referred_user['first_name']:'-'}}&nbsp;&nbsp;{{($referred_user['last_name'])?$referred_user['last_name']:''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Registration Time & Date</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                          <?php $admin_datetime = convert_utc_to_userdatetime(1, "admin", $data_info['userinfo']['created_at']); ?>
                          {{($admin_datetime)? date('d-M-Y h:i:sa',strtotime($admin_datetime)):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <!-- <div class="col-md-6">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Entitlement Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Entitlement</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($entitlement_arr) && !empty($entitlement_arr))
                                 @foreach($entitlement_arr as $val)
                                    @php
                                         $entitlement_title = '' ;
                                         if($data_info['entitlement_id']==$val['id'])
                                         {
                                             $entitlement_title=$val['entitlement'];
                                         }
                                         else
                                         {
                                             $entitlement_title = "";
                                         }

                                    @endphp
                                 @endforeach
                                 {{ $entitlement_title }}
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Card Number</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ isset($data_info['card_no']) && !empty($data_info['card_no']) ? $data_info['card_no'] : '' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="textfield2" class="col-xs-3 col-lg-5 control-label">Photo of entitlement card</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                            @if(isset($affected_area_img_arr) && !empty($affected_area_img_arr))
                               @foreach($affected_area_img_arr as $val)
                                   @if($val['affected_area_photo'] !='' && File::exists($patient_uploads_url.$val['affected_area_photo']))

                                       <div class="image-avtar left"> 
                                           <img src="{{$patient_uploads_base_url}}/{{$val['affected_area_photo']}}" class="disp_img circle" style="height: 60px; width: 60px;">
                                       </div>                                          
                                           
                                       
                                   @endif
                               @endforeach
                           @else
                               <span class="green-text">No Image uploaded</span>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div> -->
         </div>
         
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Family Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <table class="table table-bordered table table-advance" id="table_module">
                        @if(count($data_family)>0)
                        <thead>
                           <tr>
                              <th>Relationship</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Date Of Birth</th>
                              <th>Mobile Number</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($data_family as $key => $data_family)
                           <tr>
                              <td>{{($data_family['relationship'])?$data_family['relationship']:'NA'}}</td>
                              <td>{{($data_family['first_name'])?$data_family['first_name']:'NA'}}</td>
                              <td>{{($data_family['last_name'])?$data_family['last_name']:'NA'}}</td>
                              <td>{{($data_family['gender'])?$data_family['gender']:'NA'}}</td>
                              <td id="member_dob_{{$key}}"></td>
                              <td id="member_mobile_no_{{$key}}"></td>
                           </tr>
                                              <!-- Decrypt Values -->
                            <script type="text/javascript">
                               var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                               var api           = virgil.API(virgilToken);
                               
                               var member_dumpSessionId = '{{isset($data_family["userinfo"]["dump_session"])?$data_family["userinfo"]["dump_session"]:""}}';
                               var inner_key     = '{{ $key }}';
                               
                               /*var fname         = "{{isset($patient['userinfo']['first_name'])?ucfirst($patient['userinfo']['first_name']):''}}";
                               var lname         = "{{isset($patient['userinfo']['last_name'])?ucfirst($patient['userinfo']['last_name']):''}}";*/
                               var dob           = "{{isset($data_family['date_of_birth'])?$data_family['date_of_birth']:''}}";
                               var mobile_no     = "{{isset($data_family['mobile_number'])?$data_family['mobile_number']:''}}";
                               
                               if(member_dumpSessionId!='')
                               {
                                 var key         = api.keys.import(member_dumpSessionId);
                                 /*if(fname!='' && lname!='')
                                 {
                                   var dec_fname      = decrypt(api, fname, key);
                                   var dec_lname      = decrypt(api, lname, key);
                                   $('#patient_name_'+inner_key).html(dec_fname+' '+dec_lname);
                                 }*/
                                 
                                 if(dob!='')
                                 {
                                   var dec_dob     = decrypt(api, dob, key);
                                   $('#member_dob_'+inner_key).html(dec_dob);
                                 }
                                 
                                 if(mobile_no!='')
                                 {
                                   var dec_mobile_no  = decrypt(api, mobile_no, key);
                                   $('#member_mobile_no_'+inner_key).html(dec_mobile_no);
                                 }
                               }

                               function decrypt(api, enctext, key)
                               {
                                   var decrpyttext = key.decrypt(enctext);
                                   var plaintext = decrpyttext.toString();
                                   return plaintext;
                               }
                            </script>
                           @endforeach
                        </tbody>
                        @else
                        <div class="alert alert-info alert-dismissible" role="alert" align="center">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <strong>Sorry!</strong> Currently,no records found.
                        </div>
                        @endif
                     </table>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            
            <div class="col-md-12">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Family Doctor details</h3>
                  </div>
                  <div class="box-content">
                     <br/>

                     <table class="table table-bordered table table-advance" id="table_module">
                       {{--  @if(count($data_family)>0) --}}
                       @if(isset($family_doctor_arr) && !empty($family_doctor_arr))
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Mobile No.</th>
                                 <th>Email</th>
                                 <th>Practice Name</th>
                              </tr>
                           </thead>
                        
                           <tbody>
                              @foreach($family_doctor_arr as $key => $dr)
                              <tr>
                                 <td> {{ isset($dr['first_name']) && !empty($dr['first_name']) ? $dr['first_name'] : '' }} {{ isset($dr['last_name']) && !empty($dr['last_name']) ? $dr['last_name'] : '' }} </td>
                                 <td id="doctor_mobile_no_{{$key}}"> {{ isset($dr['mobile_no']) && !empty($dr['mobile_no']) ? $dr['mobile_no'] : '' }} </td>
                                 <td> {{ isset($dr['email']) && !empty($dr['email']) ? $dr['email'] : '' }} </td>
                                 <td> {{ isset($dr['practice_name']) && !empty($dr['practice_name']) ? $dr['practice_name'] : '' }} </td>
                              </tr>

                              <script type="text/javascript">
                               var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                               var api           = virgil.API(virgilToken);
                               
                               var doctor_dumpSessionId = '{{isset($dr["userinfo"]["dump_session"])?$dr["userinfo"]["dump_session"]:""}}';
                               var inner_key     = '{{ $key }}';
                               
                               /*var fname         = "{{isset($patient['userinfo']['first_name'])?ucfirst($patient['userinfo']['first_name']):''}}";
                               var lname         = "{{isset($patient['userinfo']['last_name'])?ucfirst($patient['userinfo']['last_name']):''}}";*/
                               var mobile_no     = "{{isset($dr['mobile_no'])?$dr['mobile_no']:''}}";
                               
                               if(doctor_dumpSessionId!='')
                               {
                                 var key         = api.keys.import(doctor_dumpSessionId);
                                 
                                 if(mobile_no!='')
                                 {
                                   var dec_mobile_no  = decrypt(api, mobile_no, key);
                                   $('#doctor_mobile_no_'+inner_key).html(dec_mobile_no);
                                 }
                               }

                               function decrypt(api, enctext, key)
                               {
                                   var decrpyttext = key.decrypt(enctext);
                                   var plaintext = decrpyttext.toString();
                                   return plaintext;
                               }
                            </script>
                              @endforeach
                           </tbody>
                        @else
                           <div class="alert alert-info alert-dismissible" role="alert" align="center">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>Sorry!</strong> Currently,no records found.
                           </div>
                        @endif
                     </table>

                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Referral Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <table class="table table-bordered table table-advance" id="table_module">
                        @if(count($arr_friend_users_details)>0)
                        <thead>
                           <tr>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Date Of Birth</th>
                              <th>Mobile Number</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($arr_friend_users_details as $key => $arr_friend_details)
                           <tr>
                              <td>{{($arr_friend_details['userinfo']['first_name'])?$arr_friend_details['userinfo']['first_name']:'NA'}}</td>
                              <td>{{($arr_friend_details['userinfo']['last_name'])?$arr_friend_details['userinfo']['last_name']:'NA'}}</td>
                              <td>{{($arr_friend_details['gender'])?$arr_friend_details['gender']:'NA'}}</td>
                              <td>{{($arr_friend_details['date_of_birth'])?$arr_friend_details['date_of_birth']:'NA'}}</td>
                              <td id="refer_mobile_no_{{$key}}">{{($arr_friend_details['mobile_no'])? decrypt_value($arr_friend_details['mobile_no']):'NA'}}</td>
                           </tr>
                           <script type="text/javascript">
                            var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                            var api           = virgil.API(virgilToken);
                            
                            var refer_dumpSessionId = '{{isset($arr_friend_details["userinfo"]["dump_session"])?$arr_friend_details["userinfo"]["dump_session"]:""}}';
                            var inner_key     = '{{ $key }}';
                            
                            /*var fname         = "{{isset($patient['userinfo']['first_name'])?ucfirst($patient['userinfo']['first_name']):''}}";
                            var lname         = "{{isset($patient['userinfo']['last_name'])?ucfirst($patient['userinfo']['last_name']):''}}";*/
                            var mobile_no     = "{{isset($arr_friend_details['mobile_no'])? $arr_friend_details['mobile_no']:''}}";
                            
                            if(refer_dumpSessionId!='')
                            {
                              var key         = api.keys.import(refer_dumpSessionId);
                              if(mobile_no!='')
                              {
                                var dec_mobile_no  = decrypt(api, mobile_no, key);
                                $('#refer_mobile_no_'+inner_key).html(dec_mobile_no);
                              }
                            }

                            function decrypt(api, enctext, key)
                            {
                                var decrpyttext = key.decrypt(enctext);
                                var plaintext = decrpyttext.toString();
                                return plaintext;
                            }
                         </script>
                           @endforeach
                        </tbody>
                        @else
                        <div class="alert alert-info alert-dismissible" role="alert" align="center">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <strong>Sorry!</strong> Currently,no records found.
                        </div>
                        @endif
                     </table>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->

 <!-- Decrypt Values -->
 <script type="text/javascript">
    var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
    var api           = virgil.API(virgilToken);
    
    var dumpSessionId = '{{isset($data_info["userinfo"]["dump_session"])?$data_info["userinfo"]["dump_session"]:""}}';
    var dumpId        = '{{isset($data_info["userinfo"]["dump_id"])?$data_info["userinfo"]["dump_id"]:""}}';
    
    var suburb        = "{{ isset($data_info['suburb']) && !empty($data_info['suburb']) ? $data_info['suburb'] : ''  }}";
    var mobile_no     = "{{ isset($data_info['mobile_no']) && !empty($data_info['mobile_no']) ? $data_info['mobile_no'] : ''  }}";
    var phone_no      = "{{ isset($data_info['phone_no']) && !empty($data_info['phone_no']) ? $data_info['phone_no'] : ''  }}";
    
    if(dumpSessionId!='')
    {
      var key         = api.keys.import(dumpSessionId);
      
      if(suburb!='')
      {
        var dec_suburb     = decrypt(api, suburb, key);
        $('#patient_suburb').html(dec_suburb);
      }
      
      if(mobile_no!='')
      {
        var dec_mobile_no  = decrypt(api, mobile_no, key);
        $('#patient_mobile_no').html(dec_mobile_no);
      }

      if(phone_no!='')
      {
        var dec_phone_no  = decrypt(api, phone_no, key);
        $('#patient_phone_no').html(dec_phone_no);
      }

    }

    function decrypt(api, enctext, key)
    {
        var decrpyttext = key.decrypt(enctext);
        var plaintext = decrpyttext.toString();
        return plaintext;
    }
 </script>

@endsection