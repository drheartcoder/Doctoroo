@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->
<style>
   .star,.err{ color:red; }
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
      <li><a href="{{ url($admin_panel_slug.'/patient') }}">Manage Patient</a></li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      </span> 
      <li class="active">  {{ isset($page_title)?$page_title:"" }}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box box-blue">
      <div class="box-title">
         <h3><i class="fa fa-file"></i>Family Members</h3>
         <div class="box-tool">
         </div>
      </div>
      <br/>
      <div id="success_message" class="alert alert-success alert-dismissible"  style="display: none">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span></button>
                                 Family Details Submitted Successfully
                              </div>
      <div class="box-content">
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN Left Side -->
               <div class="box box-gray">
                  <div class="box-title">
                     <h3><i class="fa fa-puzzle-piece"></i> Patient Details</h3>
                  </div>
                  <div class="box-content">
                     <br/>
                     <div class="form-group">
                        <label for="textfield1" class="col-xs-3 col-lg-5 control-label">Name</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_patient['userinfo']['title']) && $data_patient['userinfo']['title']!=''?$data_patient['userinfo']['title'].'&nbsp;&nbsp;':''}} {{isset($data_patient['userinfo']['first_name'])?$data_patient['userinfo']['first_name']:''}}&nbsp;&nbsp;{{isset($data_patient['userinfo']['last_name'])?$data_patient['userinfo']['last_name']:''}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Gender</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if($data_patient['gender']=="M")
                           Male
                           @elseif($data_patient['gender']=="F")
                           Female
                           @else
                           NA
                           @endif
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Email</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_patient['userinfo']['email'])?$data_patient['userinfo']['email']:'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Date of Birth</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           {{isset($data_patient['date_of_birth'])? date('d-M-Y',strtotime($data_patient['date_of_birth'])):'NA'}}
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                     <div class="form-group">
                        <label for="password1" class="col-xs-3 col-lg-5 control-label">Mobile No</label>
                        <div class="col-sm-3 col-lg-2">:</div>
                        <div class="col-sm-9 col-lg-5 controls">
                           @if(isset($data_patient['mobile_no']) && $data_patient['mobile_no']!="")
                           {{isset($mobcode_data['phonecode']) ? '+'.$mobcode_data['phonecode'] : ''}}<span id="patient_mobile_no"></span>
                           @else
                           <?php echo"NA";?>
                           @endif  
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <br/>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <br/>
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
                              
                              <th>Sr.No</th>
                              <th>Relationship</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Date Of Birth</th>
                              <th>Mobile Number</th>
                              <th>Action</th>
                              <!-- <th>Medical History</th> -->
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i = 0; ?>
                           @foreach($data_family as $key => $data)
                           <tr>
                              <?php $i++; ?>
                              <!-- <td><input type="hidden" name="id[]" value="{{isset($data['id'])?$data['id']:''}}" class="form-control"></td> -->
                              <td>{{$i}}</td>
                              <td><input type="text" name="relationship" id="relationship{{$data['id']}}" value="{{isset($data['relationship'])?$data['relationship']:''}}" class="form-control relationship"><span class="error_msg" style="color:#ff0000;"></span></td>
                              <td><input type="text" name="first_name" id="first_name{{$data['id']}}" value="{{isset($data['first_name'])?$data['first_name']:''}}" class="form-control first_name"><span class="error_fname" style="color:#ff0000;"></span></td>
                              <td><input type="text" name="last_name" id="last_name{{$data['id']}}" value="{{isset($data['last_name'])?$data['last_name']:''}}" class="form-control last_name"><span class="error_lname" style="color:#ff0000;"></span></td>
                              <td><select name="gender" class="form-control" id="gender{{$data['id']}}">
                                 <option value="Male" @if($data['gender'] && $data['gender'] == 'Male')
                                 selected="selected"
                                 @endif >Male</option>
                                 <option value="Female"  @if($data['gender'] && $data['gender'] == 'Female')
                                 selected="selected"
                                 @endif>Female</option>
                                 </select>
                                 <span class="error_msg" style="color:#ff0000;"></span>
                              </td>
                              <td><input type="text" name="date_of_birth" id="date_of_birth{{$data['id']}}" value="" class="form-control datepicker date_of_birth"><span class="error_dob" style="color:#ff0000;"></span></td>
                              <td><input type="text" name="mobile_number"  id="mobile_number{{$data['id']}}" value="" class="form-control mobile_no"><span class="error_msg" style="color:#ff0000;"></span></td>
                              <td style="display: none"><input type="hidden" id="dump_id{{$data['id']}}" value="{{isset($data['userinfo']['dump_id']) ?$data['userinfo']['dump_id'] :''}}"></td>
                              <td><button  name="btn_save" onclick="familydata('<?php echo $data['id'] ?>')" class="btn btn-success valid" >Save</button>
                              </td>
                              <!-- <td>
                            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" href="{{ $module_url_path.'/medicalhistory/'.base64_encode($data['id'])}}" title="Display Family Medical History">
                           <i class="fa fa-eye" ></i>
                           </a>
                              </td> -->

                           </tr>
                           <script type="text/javascript">
                            var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
                            var api           = virgil.API(virgilToken);
                            
                            var member_dumpSessionId = '{{isset($data["userinfo"]["dump_session"])?$data["userinfo"]["dump_session"]:""}}';
                            var inner_key            = '{{ $data["id"] }}';
                            var member_dob           = "{{isset($data['date_of_birth'])?$data['date_of_birth']:''}}";
                            var member_mobile_no     = "{{isset($data['mobile_number'])?$data['mobile_number']:''}}";
                            
                            if(member_dumpSessionId!='')
                            {
                              var key         = api.keys.import(member_dumpSessionId);
                              
                              if(member_dob!='')
                              {
                                 var dec_member_dob     = decrypt(api, member_dob, key);

                                $('#date_of_birth'+inner_key).val(dec_member_dob);
                              }
                              
                              if(member_mobile_no!='')
                              {
                                var member_dec_mobile_no  = decrypt(api, member_mobile_no, key);
                                $('#mobile_number'+inner_key).val(member_dec_mobile_no);
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
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                           </button>
                           <strong>Sorry!</strong> Currently,no records found.
                        </div>
                        @endif
                     </table>
                     <div class="clearfix"></div>
                     <br/> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Decrypt Values -->
 <script type="text/javascript">
    var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
    var api           = virgil.API(virgilToken);
    
    var dumpSessionId = '{{isset($data_patient["userinfo"]["dump_session"])?$data_patient["userinfo"]["dump_session"]:""}}';
    var dumpId        = '{{isset($data_patient["userinfo"]["dump_id"])?$data_patient["userinfo"]["dump_id"]:""}}';
    var mobile_no     = "{{ isset($data_patient['mobile_no']) && !empty($data_patient['mobile_no']) ? $data_patient['mobile_no'] : ''  }}";
    
    if(dumpSessionId!='')
    {
      var key         = api.keys.import(dumpSessionId);
      
      if(mobile_no!='')
      {
        var dec_mobile_no  = decrypt(api, mobile_no, key);
        $('#patient_mobile_no').html(dec_mobile_no);
      }
    }

    function decrypt(api, enctext, key)
    {
        var decrpyttext = key.decrypt(enctext);
        var plaintext = decrpyttext.toString();
        return plaintext;
    }

   function encrypt(api, text, cards)
   {
     // encrypt the text using User's cards
     var encryptedMessage = api.encryptFor(text, cards);

     var encData = encryptedMessage.toString("base64");

     return encData;
   }

 </script>

<script>
function familydata(id)
{  
      
      var flag=1;
      var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
           /* var arr_past_frequency = $('.mobile_no');
            $.each(arr_past_frequency, function (index,svalue)
            {
            
            var value = $(this).val();
            
            if($.trim(value)=="")
            {
            
            $('.error_msg').eq(index).fadeIn('fast');
            $('.error_msg').eq(index).html('Please enter value.');
            $('.error_msg').eq(index).fadeOut(4000);
      
             flag=0;
          
            }
      
            }); */
   /*-------------relationship----------------*/
      setTimeout(function()
      {
         $('span.error_msg').html('');
      },2000);
      $('.relationship').each(function() 
      {
         if ($.trim($(this).val()) == '') 
         {
            isValid = 0;
                
         $(this).next().html("Please Enter Fields");
                     
             flag=0;
         }
              
      });
   /*----------------firstname----------------------*/
      setTimeout(function()
      {
         $('span.error_fname').html('');
      },2000);
      $('.first_name').each(function() 
      {
         if ($.trim($(this).val()) == '') 
         {
            isValid = 0;
                
         $(this).next().html("Please Enter Fields");
                     
            flag=0;
         }
              
      });
      /*--------------lastname------------------*/
      setTimeout(function()
      {
         $('span.error_lname').html('');
      },2000);
      $('.last_name').each(function() 
      {
         if ($.trim($(this).val()) == '') 
         {
               isValid = 0;
             
             $(this).next().html("Please Enter Fields");
                  
             flag=0;
         }
              
      });
      /*-----------------dob---------------------------*/
      setTimeout(function()
      {
         $('span.error_dob').html('');
      },2000);
      $('.date_of_birth').each(function() 
      {
          if ($.trim($(this).val()) == '') 
          {
               isValid = 0;
             
             $(this).next().html("Please Enter Fields");
                  
             flag=0;
          }
              
      });
      /*-------------------mobile_Number-----------------------*/
      setTimeout(function()
      {
          $('span.error_mob').html('');

      },2000);
      $('.mobile_no').each(function() 
      {
         if ($.trim($(this).val()) == '') 
         {
             isValid = 0;
             
             $(this).next().html("Please Enter Fields");
                  
             flag=0;
         }
         if ($.trim($(this).val()).length < 10) 
         {
             isValid = 0;
             
             $(this).next().html("Please Enter 10 Digit Mobile Number");
                  
             flag=0;
         }
             
         if (!$.trim($(this).val()).match(onlydigit)) 
         {
             isValid = 0;
             
             $(this).next().html("Please Enter Number");
                  
             flag=0;
         }
         if ($.trim($(this).val()).length > 10) 
         {
             isValid = 0;
             
             $(this).next().html("Please Enter 10 Digit Mobile Number");
                  
             flag=0;
         }

      });
         /*------------------------Ajax-----------------------*/
      if(flag==1)
      { 
            if(id!="") 
            {
               var relationship  = $('#relationship'+id).val(); 
               var first_name    = $('#first_name'+id).val();
               var last_name     = $('#last_name'+id).val();
               var gender        = $('#gender'+id).val();
               var date_of_birth = $('#date_of_birth'+id).val();
               var mobile_number = $('#mobile_number'+id).val();
               var _dumpId       = $('#dump_id'+id).val();
                 
                 var api         = virgil.API(virgilToken);
                 var findkey     = api.cards.get(dumpId).then(function (cards) {

                 var txtmobile     = encrypt(api, mobile_number, cards);
                 var txtdob        = encrypt(api, date_of_birth, cards);

                 if(txtmobile != '' && txtdob != '')
                 {
                     var formData = new FormData();
                     var _token = '{{csrf_token()}}';

                     formData.append('relationship',relationship);
                     formData.append('first_name',first_name);
                     formData.append('last_name',last_name);
                     formData.append('gender',gender);
                     formData.append('date_of_birth',txtdob);
                     formData.append('mobile_number',txtmobile);
                     formData.append('_token',_token);

                     $.ajax({
                           url         : "{{$module_url_path}}/family_update/"+btoa(id),
                           type        : "post",
                           data        : formData,
                           processData : false,
                           contentType : false,
                           cache       : false,
                           success : function(res)
                           { 
                               $('#success_message').fadeIn().html();
                               setTimeout(function() 
                               {
                                 $('#success_message').fadeOut("slow");
                               }, 2000 );
                              // /return true;
                           }
                     });
                 }
                 }).then(null, function () {
                        console.log('Something went wrong.');
                 });

                   findkey.catch(function(error) {
                   console.log(error);
                 });
               }
         }
         else
         {
            return false;
         }
         
}
   
</script>
<script>
   $(function()
   {
      $('.datepicker').datepicker({format: "dd/mm/yyyy" });
   });
</script>
@stop