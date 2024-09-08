<?php
/*echo "<pre>";
    print_r($notification_arr);
echo "</pre>";
die();*/
?>
@extends('front.patient.layout._dashboard_master')
@section('main_content')
    <link href="{{url('/')}}/public/css/doctoroo-doctor.css" rel="stylesheet" media="screen,projection" />


<div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">Notifications</h1>

    </div>
    <div id="slide-out" class="side-nav fixed menu-main">
        <div id="side-nav"></div>
    </div>

<!-- SideBar Section -->
@include('front.patient.layout._sidebar')

<div class="mar300  has-header minhtnor">
        <div class="container-600px pdmintb">
            <div class="round-box z-depth-3 ">
                <div class="round-box-content blue-border">
                    <ul class="collection brdrtopsd">
                    @if(isset($notification_arr))
                    @foreach($notification_arr as $notification)
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating red center-align large">IL</span>
                                <a href="#" class="">
                                    <p class="bluedoc-text"><strong>{{isset($notification['user_details']['first_name']) ? $notification['user_details']['first_name'] : ''}} {{isset($notification['user_details']['last_name']) ? $notification['user_details']['last_name'] : ''}}</strong>  has confirmed your consultation</p>
                                    <small class="bluedoc-text"><strong>Consultation ID: {{isset($notification['booking_id']) ? $notification['booking_id'] : '' }}</strong></small>
                                    <small class="bluedoc-text">
                                    <strong>
                                      <?php 
                                        $datetime = explode(" ",$notification['created_at']);
                                        $date = $datetime[0];
                                        $time = $datetime[1];
                                        echo $date;
                                        $current_date = date('Y-m-d');
                                        $current_month = date('m');

                                        $daysdiffernce = date_diff(date_create($date),date_create($current_date));
                                        //echo $daysdiffernce->format("%R%a days Ago"); 
                                      ?>
                                    </strong>
                                    </small>
                                </a>

                            </div>
                        </li>
                        
                      @endforeach
                      @endif
                      @if(sizeof($notification_arr)=='0')
                          <h5 class="center-align">No Notification found</h5>
                      @endif    
                    </ul>
                </div>
            </div>

        </div>
    </div>
  
    

<script>
var url="<?php echo $module_url_path; ?>";
$(document).ready(function(){

    $('#btn_save_medication').click(function(){
        var medication_name=$('#medication_name').val();
        $('.error').html("");
        if($('#medication_name').val()=='' || $('#medication_name').val()==null)
        {
            $('.error').html("Please enter Medication name").css('color','red');
            return false;
        }

          $.ajax({
              url:url+'/medication_store',
              type:'get',
              data:{
                  medication_name:medication_name
              },
              success:function(data){
                  $(".open_popup").click();
                  $('.flash_msg_text').html(data.msg);
                  $('#medication_name').val('')
              }
           });

    });
});
</script>

    <!--Container End-->
@endsection