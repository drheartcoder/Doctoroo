@extends('admin.layout.master')
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.css">
<!-- BEGIN Page Title -->
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
      <i class="fa fa-list"></i>
      </span>
      <li class=""> <a href="{{ url($admin_panel_slug.'/pharmacy/verifiedpharmacies') }}">Verified Pharmacies</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-list"></i>
      </span>
      <li class="active">{{isset($module_title)?$module_title:'Verified Pharmacy Details'}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box">
      <div class="box-title">
         <h3>
            <i class="fa fa-text-width"></i>
            {{isset($module_title)?$module_title:'Verified Pharmacy Details'}}
         </h3>
         <div class="box-tool">
            @if(count($arr_pharmacy)>0)
            <a href="{{ $module_url_path.'/edit/'.base64_encode($arr_pharmacy['userinfo']['id']) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
            @endif
         </div>
      </div>
      <div class="box-content">
         @if(isset($arr_pharmacy) && count($arr_pharmacy)>0)
         <div class="row">
            <div class="col-md-4">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Contact Information</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">First Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['userinfo']['first_name'])?$arr_pharmacy['userinfo']['first_name']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Last Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['userinfo']['last_name'])?$arr_pharmacy['userinfo']['last_name']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Contact Role</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php
                              if(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==1)
                              {
                                  echo"Owner";
                              }
                              elseif(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==2) 
                              {
                              
                                  echo"Manager";
                              }
                              elseif(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==3) 
                              {
                              
                                  echo"Assistant Pharmacist";
                              }
                              elseif(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==4) 
                              {
                              
                                echo"Pharmacist";
                              }  
                              elseif(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==5) 
                              {  
                              
                                 echo"Retail Assistant"; 
                              }
                              elseif(isset($arr_pharmacy['contact_role']) && $arr_pharmacy['contact_role']==6) 
                              {
                              
                                  echo"other";
                              }   
                              else{ echo"NA"; } 
                              ?> 
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Profile Image</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($arr_pharmacy['logo']) && file_exists($pharmacy_base_img_path.'/'.$arr_pharmacy['logo']) && $arr_pharmacy['logo']!='')
                           <img src={{ $pharmacy_public_img_path.'/'.$arr_pharmacy['logo']}} height="100px" width="100px" alt="" />
                           @else
                           <img src={{ $pharmacy_public_img_path }}/default-image.jpeg height="150px" width="250px" alt="" />   
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Date & Time</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php $admin_datetime = convert_utc_to_userdatetime(1, "admin", $arr_pharmacy['created_at']); ?>
                           {{isset($admin_datetime)?date('d-M-Y h:i:sa',strtotime($admin_datetime)):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Pharmacy Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Pharmacy Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['pharmacy_name'])?$arr_pharmacy['pharmacy_name']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Email ID</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['userinfo']['email'])?$arr_pharmacy['userinfo']['email']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Contact Number</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['phone'])?$arr_pharmacy['phone']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Fax</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['fax'])?$arr_pharmacy['fax']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Address 1</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['address1'])?$arr_pharmacy['address1']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Address 2</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['address2'])?$arr_pharmacy['address2']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Script Per Day</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==1) 
                           {{ '1-50' }}          
                           @elseif(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==2)
                           {{ '50-100' }}
                           @elseif(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==3)
                           {{ '100-150' }}
                           @elseif(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==4)
                           {{ 'upto 500' }}
                           @elseif(isset($arr_pharmacy['aprox_script_per_day']) && $arr_pharmacy['aprox_script_per_day']==5)
                           {{ '500+' }}
                           @endif 
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Computer System Used</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==1) 
                           {{ 'FRED Dispense' }}          
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==2)
                           {{ 'Minfos Dispense' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==3)
                           {{ 'Corum LOTS' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==4)
                           {{ 'Surefire Dispense (Amfac)' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==5)
                           {{ 'Simple Aquarius' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==6)
                           {{ 'Healthsoft Pharmacy Pro' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==7)
                           {{ 'Mountaintop Dispense' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==8)
                           {{ 'Z Dispense' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==9)
                           {{ 'CDS' }}
                           @elseif(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==10)
                           {{ 'Other' }}
                           @endif 
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     @if(isset($arr_pharmacy['computer_system_used']) && $arr_pharmacy['computer_system_used']==10)
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Other Computer System</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['other_computer_system'])?$arr_pharmacy['other_computer_system']:'NA'}}
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Pharmacy Details </h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Is the Pharmacy port of a banner group?</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['part_of_banner_group'])?$arr_pharmacy['part_of_banner_group']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     @if(isset($arr_pharmacy['part_of_banner_group']) && $arr_pharmacy['part_of_banner_group']!="No")
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Other Group</label>
                         <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($arr_pharmacy['other_banner_group']['name'])?$arr_pharmacy['other_banner_group']['name']:'NA'}}
                        </div>
                     </div>
                     @endif
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Website URL</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($arr_pharmacy['website']) && $arr_pharmacy['website']!="")
                           {{$arr_pharmacy['website']}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Pharmacy ABN</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($arr_pharmacy['ABN_number']) && $arr_pharmacy['ABN_number']!="")
                           {{$arr_pharmacy['ABN_number']}}
                           @else
                           <?php echo"NA";?>
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Services</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           <?php  $service_str =''; ?>
                           @if(isset($arr_pharmacy['services']) && in_array("1", $arr_pharmacy['services']))
                           <?php  $service_str = 'Offer Click & Collect'; ?>
                           @endif
                           @if(isset($arr_pharmacy['services']) && in_array("2", $arr_pharmacy['services']))
                           <?php  $service_str = $service_str.",".'Offer Delivery to Patients'; ?>
                           @endif
                           @if(isset($arr_pharmacy['services']) && in_array("3", $arr_pharmacy['services']))
                           <?php  $service_str = $service_str.",".'Passport Photos'; ?>
                           @endif
                           @if(isset($arr_pharmacy['services']) && in_array("4", $arr_pharmacy['services']))
                           <?php  $service_str = $service_str.",".'Specialised Compounding'; ?>
                           @endif
                           @if(isset($arr_pharmacy['services']) && in_array("5", $arr_pharmacy['services']))
                           <?php  $service_str = $service_str.",".'Flu Vaccination Clinics'; ?>
                           @endif
                           @if(isset($arr_pharmacy['services']) && in_array("6", $arr_pharmacy['services']))
                           <?php  $service_str = $service_str.",".'Other'; ?>
                           @endif
                           {{ $service_str or '' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     @if(isset($arr_pharmacy['services']) && in_array("6", $arr_pharmacy['services']))  
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Other Services</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ $arr_pharmacy['other_service'] or '' }}
                        </div>
                     </div>
                     @endif
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label">Opening Hour Note</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{ $arr_pharmacy['time_schedule']['opening_hour_notes'] or 'NA' }}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="box">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i>Pharmacy Time Scheduler</h3>
                  </div>
                  <div class="box-content">
                    <div class="box box-gray">
                              <div class="box-title">
                                 <h3><i class="fa fa-puzzle-piece"></i></h3>
                              </div>
                              <br>
                     <table class="table table-striped table-hover fill-head">
                        <thead>
                           <tr>
                              <th>Day</th>
                              <th>On/Off</th>
                              <th>Start Time</th>
                              <th>End Time</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if(isset($arr_days) && sizeof($arr_days)>0)
                           @foreach($arr_days as $day_key  => $day)
                           <?php 
                              $small_case_day_slug  = strtolower($day_key); 
                              $small_case_day       = strtolower($day); 
                              $time                 = date("g:i a", strtotime("13:30"));
                              
                              $open_time            = $close_time = '';
                              ?>
                           @if(isset($arr_pharmacy_schedule) && sizeof($arr_pharmacy_schedule)>0)
                           <?php 
                              $open_time  = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_open']));
                              $close_time = date("h:i A",strtotime($arr_pharmacy_schedule[$small_case_day_slug.'_close']));
                              
                              $off_day = $arr_pharmacy_schedule[$small_case_day_slug.'_off'];
                              ?>
                           @endif
                           <tr>
                              <td>
                                 {{ $day or '' }}
                              </td>
                              <td> 
                                 <input type="checkbox" id="{{$small_case_day_slug}}_off" name="{{$small_case_day_slug}}_off" @if(isset($off_day) && $off_day=='1') checked="checked"  @endif  value="1" >
                              </td>
                              <td>
                                 @if(isset($arr_pharmacy['time_schedule']) && sizeof($arr_pharmacy['time_schedule'])>0)
                                 <?php 
                                    $open_time = date("h:i A",strtotime($arr_pharmacy['time_schedule'][$small_case_day_slug.'_open']));
                                    $close_time = date("h:i A",strtotime($arr_pharmacy['time_schedule'][$small_case_day_slug.'_close']));
                                    ?>
                                 @endif
                                 <div id="start_time_div_{{ $small_case_day_slug }}" class="clock-i input-group">
                                    {{ $open_time }}
                                 </div>
                              </td>
                              <td>
                                 <div id="end_time_div_{{ $small_case_day_slug }}" class="clock-i input-group">
                                    {{ $close_time }}
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                           @endif
                        </tbody>
                     </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @else
         <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sorry!</strong> Currently,no records found.
         </div>
         @endif 
      </div>
   </div>
</div>
<input type="hidden" id="arr_days" value="{{ (isset($arr_days))? json_encode($arr_days): json_encode(array()) }}">
<script src="{{ url('/') }}/public/assets/data-tables/latest/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/public/assets/data-tables/latest/dataTables.bootstrap.min.js"></script>
<script>
   function checkOffStatus(day)
   {
     var is_off_day = $('#'+day+'_off').val();
     if($('#'+day+'_off').is(":checked"))
     {
         $('#start_time_div_'+day).hide();
         $('#end_time_div_'+day).hide();
          $('#{{$small_case_day_slug}}_off').attr('disabled','disabled');
     }
     else
     {
         $('#start_time_div_'+day).show();
         $('#end_time_div_'+day).show();
     }
    
   }
   
   $(document).ready(function()
   {
       /*check off days & hide a time*/
       var arr_days      = $("#arr_days").val();
       arr_days           = JSON.parse(arr_days);
       
       jQuery.each(arr_days, function(index, item) {
             var day = index.toLowerCase();
                 if($('#'+day+'_off').is(":checked"))
                 {
                     $('#start_time_div_'+day).hide();
                     $('#end_time_div_'+day).hide();
                 }
         });
   
     $('#frm_pharmacy_edit_id').validate({
       errorClass:'error',
       errorElement:'span',
     });
     
   });
</script>
<!-- END Main Content -->
@stop

