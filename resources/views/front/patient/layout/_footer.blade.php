<style>
.modal-overlay
{
    z-index: 9998  !important;
}
</style>
<div id="footer">
   <div class="bag-footer full hide-on-med-and-down">
      <div>
         <div class="emailerBlock">
            <div class="container">
               <div class="footer-section">
                  <label class="subs">Subscribe Newsletter</label>
                  <div class="emailer-info">
                     <input type="text" class="emiler-footer" placeholder="Email" /><span><button type="button" class="news-letter"><i class="fa fa-arrow-circle-o-right"></i></button></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="">
            <div class="footer-block row">
               <div class="col s12 m5 l6">
                  <div class="footer-section">
                     <div class="ftr-col">
                        <div class="footer-heading">
                           Learn More
                        </div>
                        <div class="footer-links">
                           <ul>
                              <li><a href="{{url('/')}}/health/about-us">Our Mission</a></li>
                              <li><a href="{{url('/')}}/blogs">Blog</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="ftr-col-snd">
                        <div class="footer-heading">
                           Partners
                        </div>
                        <div class="footer-links">
                           <ul>
                              <li><a href="{{url('/')}}/health/companies-and-organisations">Companies &amp; Organisations</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col s12 m4 l4">
                  <div class="footer-section">
                     <div class="footer-heading">
                        Get in Touch
                     </div>
                     <div class="footer-links">
                        <div class="get-touch-bx">
                           <div class="genral-heading">General Enquiries </div>
                            <?php
                              $arr_admin_details = get_admin_details();
                            ?>
                            <p><?php if(count($arr_admin_details)>0){echo $arr_admin_details['contact_no'];} ?></p>
                           <p> <a href="mailto:wecare@doctoroo.com.au">wecare@doctoroo.com.au</a></p>
                        </div>
                        <!--<div class="get-touch-bx">
                           <div class="genral-heading">Investors </div>
                           <p> <a href="mailto:investor@doctoroo.com.au">investor@doctoroo.com.au</a></p>
                        </div>-->
                        <div class="get-touch-bx">
                           <div class="genral-heading">Media &amp; Press </div>
                           <p> <a href="mailto:media@doctoroo.com.au">media@doctoroo.com.au</a></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col s12 m3 l2">
                  <div class="footer-section">
                     <div class="footer-heading">
                        Get Started
                     </div>
                     <div class="footer-links">
                        <div class="footer-app-imgs">
                           <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/appstor.png" alt="img" class="responsive-img" /></a>
                           <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/google-play.png" alt="img" class="responsive-img" /></a>
                           <a href="javascript:void(0);"> <img src="{{ url('/') }}/public/new/images/andr-app.png" alt="img" class="responsive-img" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="services-block">
               <h4>Our Services <span class="services-arrow"><i class="fa fa-angle-down"></i></span></h4>
               <div class="services-data" style="display:none;">
                  <div class="row">
                     <div class="col s4 m4 l4">
                        <ul>
                          <li><a href="{{url('/after-hours-home-doctor')}}">After hours home Doctor </a></li>
                          <li><a href="{{url('/online-doctor-consultations')}}"> Online Doctor Consultations </a></li>
                          <li><a href="{{url('/online-doctors')}}"> Online Doctors  </a></li>
                          <li><a href="{{url('/online-doctor-prescriptions')}}"> Online Doctor Prescriptions   </a></li>
                          <li><a href="{{url('/see-a-doctor-at-home')}}"> See a Doctor at Home </a></li>
                          <li><a href="{{url('/talk-to-a-doctor-online')}}"> Talk to a Doctor Online  </a></li>
                        </ul>
                     </div>
                     <div class="col s4 m4 l4">
                        <ul>
                          <li><a href="{{url('/chat-with-a-doctor')}}">Chat With a Doctor </a></li>
                          <li><a href="{{url('/online-doctors-australia')}}"> OnLine Doctors Australia  </a></li>
                          <li><a href="{{url('/dial-a-doctor-on-demand')}}"> Dial a Doctor on Demand  </a></li>
                          <li><a href="{{url('/book-a-doctor-online-in-australia')}}"> Book a Doctor Online in Australia </a></li>
                          <li><a href="{{url('/see-a-gp-online')}}"> See a GP Online  </a></li>
                          <li><a href="{{url('/home-doctor-service-online')}}"> Home Doctor Service Online </a></li>
                        </ul>
                     </div>
                     <div class="col s4 m4 l4">
                        <ul>
                          <li><a href="{{url('/get-a-sick-note-and-doctor-certificate')}}">Get a Sick Note & Doctor's Certificate </a></li>
                          <li><a href="{{url('/telemedicine')}}"> Australian Telehealth & Telemedicine platform </a></li>
                          <li><a href="{{url('/see-a-doctor-at-home-without-travelling-anywhere')}}"> See a Doctor at Home,without Travelling Anywhere</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="copyright">
         <div class="container">
            <div class="row">
               <div class="col s12 m8 l8">
                  <?php $admin_details = get_admin_details(); ?>
                  <div class="stament-copyright">&copy; {{ date('Y') }} {{ $admin_details['name'] }} | ACN {{ $admin_details['acn'] }}  |  <a href="{{url('/')}}/health/terms-and-condition" class="terms-ftr-link"> Patient Terms </a> |  <a href="{{url('/')}}/health/healthcare-provider-marketplace-terms-condition" class="terms-ftr-link"> Provider Terms </a> | <a href="{{url('/')}}/health/privacy-policy" class="terms-ftr-link"> Privacy Policy</a> | <a href="{{url('/')}}/health/terms-of-use" class="terms-ftr-link"> Terms of Use</a></div>
               </div>
               <?php $social_links = get_social_links(); ?>
               <div class="col s12 m4 l3 right">
                  <div class="social-link">
                      <ul>
                          @if(!empty($social_links['facebook_link']))
                             <li><a href="{{ isset($social_links['facebook_link'])?$social_links['facebook_link']:'' }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                          @endif
                          
                          @if(!empty($social_links['twitter_link']))
                            <li><a href="{{ isset($social_links['twitter_link'])?$social_links['twitter_link']:'' }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                          @endif

                          @if(!empty($social_links['linkedin_link']))
                            <li><a href="{{ isset($social_links['linkedin_link'])?$social_links['linkedin_link']:'' }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                          @endif

                          @if(!empty($social_links['google_link']))
                            <li><a href="{{ isset($social_links['google_link'])?$social_links['google_link']:'' }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                          @endif

                          @if(!empty($social_links['pinterest_link']))
                            <li><a href="{{ isset($social_links['pinterest_link'])?$social_links['pinterest_link']:'' }}" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
                          @endif

                          @if(!empty($social_links['instagram_link']))
                            <li><a href="{{ isset($social_links['instagram_link'])?$social_links['instagram_link']:'' }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                          @endif
                      </ul>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div style="position: fixed;top: 0;right: 0;text-indent: 0px;width:0;">Website Design and Developed By <a target="blank" href="http://www.webwingtechnologies.com"> Webwing Technologies </a></div>


<a class="confirm_logout_open_popup" href="#show_confirm_logout" style="display: none;"></a>
<div id="show_confirm_logout" class="modal requestbooking" style="display: none;">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <div class="center-align">For security purposes, please click continue below to continue your session. If this is not clicked within 1 minute, you will b automatically logged out.</div>
            <br/>
            <div class="center-align" id="getting-started"></div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align two-btn-block">
      <a href="{{ url('/') }}/logout" class="modal-action waves-effect waves-green btn-cancel-cons">Logout</a>
      <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons" id="confirm_continue">Continue</a>
   </div>
</div>

<input type="hidden" id="login_time" value="{{ convert_utc_to_userdatetime($arr_user_data['user_id'],'patient', $arr_user_data['login_time']) }}">
<input type="hidden" id="logout_time" value="{{ convert_utc_to_userdatetime($arr_user_data['user_id'],'patient', $arr_user_data['logout_time']) }}">


<div id="logout" class="modal requestbooking">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <p class="center-align">Are you sure you want to Logout?</p>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align two-btn-block">
      <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
      <a href="{{ url('/') }}/logout" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
   </div>
</div>

<a class="open_popup" href="#show_flash_msg" style="display: none;"></a>
<div id="show_flash_msg" class="modal requestbooking" style="display: none;">
   <div class="modal-data">
      <a class="modal-close closeicon"><i class="material-icons">close</i></a>
      <div class="row">
         <div class="col s12 l12">
            <div class="flash_msg_text center-align"></div>
         </div>
      </div>
   </div>
   <div class="modal-footer center-align ">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons full-width-btn">OK</a>
   </div>
</div>

<!-- get today's date -->
<input type="hidden" id="txt_7day" name="txt_7day" value="{{ date('Y,m,d', strtotime('+6 day')) }}">

<script>
   $('#show_flash_msg .modal-close').click(function() {
     location.reload();
   });
</script>
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--Import materialize.css-->
<!-- <link rel="stylesheet" href="{{ url('/') }}/public/date-time-picker/css/materialize.min.css"  media="screen,projection"/>-->
<link rel="stylesheet" href="{{ url('/') }}/public/date-time-picker/css/clock-picker.css"  media="screen,projection"/>
<script src="{{ url('/') }}/public/date-time-picker/js/materialize.min.js"></script>
<script>
   var sevenday = $('#txt_7day').val();
   $('.datepicker').pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 15, // Creates a dropdown of 15 years to control year,
     today: 'Today',
     clear: 'Clear',
     close: 'Ok',
     closeOnSelect: true, // Close upon selecting a date,
     format: 'dd/mm/yyyy',
     formatSubmit: 'yyyy-mm-dd',
     //selectYears: 100, // `true` defaults to 10.
     min: new Date(),
     max: new Date(sevenday),
     // Accessibility labels
     /*labelMonthNext: 'Next month',
     labelMonthPrev: 'Previous month',
     labelMonthSelect: 'Select a month',
     labelYearSelect: 'Select a year',*/
     onOpen: function() {
           console.log( 'Opened')
       },
       onClose: function() {
           console.log( 'Closed ' + this.$node.val() )
           
           selected_date = this.$node.val();
           var token = $('input[name="_token"]').val();
           $.ajax({
                url   : "{{ url('/') }}/patient/booking/get_doctor_available_time",
                type  : "POST",
                //dataType:'json',
                data: {_token:token,selected_date:selected_date},
                success : function(res){
                   
                     if($.trim(res)=='error')
                     {
                        $('.choosetime').empty(); 
                     }
                     else
                     {
                         $('#getting_time').empty(); 
                         $('#getting_time').append(res);
                     }
                 }
           });
       },
       onSelect: function() {
           console.log( 'Selected: ' + this.$node.val() )
       },
       onStart: function() {
           console.log( 'Hello there :)' )
       }
   });
   
   $('.dob_datepicker').pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 15, // Creates a dropdown of 15 years to control year,
     today: 'Today',
     clear: 'Clear',
     close: 'Ok',
     closeOnSelect: true, // Close upon selecting a date,
     format: 'dd/mm/yyyy',
     formatSubmit: 'yyyy-mm-dd',
     selectYears: 100, // `true` defaults to 10.
     //min: new Date(2015,3,20),
     max:new Date(),
     // Accessibility labels
     /*labelMonthNext: 'Next month',
     labelMonthPrev: 'Previous month',
     labelMonthSelect: 'Select a month',
     labelYearSelect: 'Select a year',*/
     onOpen: function() {
           console.log( 'Opened')
       },
       onClose: function() {
           console.log( 'Closed ' + this.$node.val() )
           
           selected_date = this.$node.val();
       },
       onSelect: function() {
           console.log( 'Selected: ' + this.$node.val() )
       },
       onStart: function() {
           console.log( 'Hello there :)' )
       }
   });
   
   $('.timepicker').pickatime({
     default: 'now', // Set default time: 'now', '1:30AM', '16:30'
     fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
     twelvehour: true, // Use AM/PM or 24-hour format
     donetext: 'OK', // text for done-button
     cleartext: 'Clear', // text for clear-button
     canceltext: 'Cancel', // Text for cancel-button
     autoclose: true, // automatic close timepicker
     ampmclickable: true, // make AM PM clickable
     aftershow: function(){} //Function for after opening timepicker
   });
</script>

<script src="{{ url('/') }}/public/new/js/materialize.js"></script>
<script src="{{ url('/') }}/public/new/js/init.js"></script>
<!--upcoming modal start-->
<!-- For logout after tab and browser close -->
<script src="{{ url('/') }}/public/js/logout.js"></script>
<!-- For Feedback star rating  -->
<script src="{{ url('/') }}/public/new/js/jquery.rateyo.min.js"></script>
<script>
   $(document).ready(function(){
       //var sidebar = $('#slide-out').attr('class');
       if($('#my_sidebar').hasClass('check_sidebar'))
       {
           $('#footer').removeClass('full-width-footer');
       }
       else
       {
           $('#footer').addClass('full-width-footer');
       }
       $('.services-block h4').click(function(){
          $('.services-data').slideToggle('slow'); 
       });
       
   });
</script>

  <script>
    function check_doctor_active_video_call()
    {
      var token = "<?php echo csrf_token(); ?>";
      $('.close-toastr').closest('.toast').remove();
      $.ajax({
        url   : "{{ url('/') }}/patient/upcoming_consultation/check_doctor_active_video_call",
        type : "POST",
        dataType:'json',
        data:{_token:token },
        success : function(res){
          if(res)
          {
            toastr.success(res.msg, {timeOut: 1000})
          }
        }
      });
    }
    var interval = setInterval(function () { check_doctor_active_video_call(); }, 6000);

     $(document).on('click','.open_video_call',function(){
        var doctor_id  = $(this).attr("data-doctor_id");
        var booking_id  = $(this).attr("data-booking_id");
       
        var url         = "{{ url('/') }}/patient/video/"+booking_id;
        var title       = 'Video Chat';
        var w           = 400;
        var h           = 650;
        var left        = (screen.width/2)-(w/2);
        var top         = (screen.height/2)-(h/2);
        window.open(url, title, 'toolbar=no, location=yes, directories=yes, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    });

    function reject_call(booking_id){
          var _token = "<?php echo csrf_token(); ?>";
          var booking_id = booking_id;
          $.ajax({
              url: '{{ url("/") }}/patient/video/update_video_call_reject_status',
              type: 'POST',
              //dataType: 'json',
              data: {
                  _token: _token,
                  booking_id: booking_id
              },
              success: function (res) {
              }
          });
        } 
  </script>
<!-- Jquery - notification popup box using toastr JS ends -->

<?php if(Request::segment(1) == 'patient' && Request::segment(2) == 'dashboard' ){ ?>
@include('google_api.google')
<?php } ?>


<?php if(Request::segment(1) == 'patient' && Request::segment(2) != 'my_health' && Request::segment(2) != 'setting' && Request::segment(2) == 'dashboard' ){ ?>
  <!-- get current location starts -->

    <!-- <script src="{{ url('/') }}/public/get_current_location/jquery-1.11.3.min.js"></script> -->
    <script src="{{ url('/') }}/public/get_current_location/jquery-ui.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places" async defer></script> -->
    <script>
    
    testMap();

    var componentForm = {
        street_number:               'long_name',
        route:                       'long_name',
        locality:                    'long_name',
        administrative_area_level_1: 'long_name',
        country:                     'long_name',
        postal_code:                 'short_name'
    };
    
        function testMap() {
          
            var current_url = window.location.href;
            var https_chk = current_url.substring(0, 8);

            if(https_chk != 'https://'){
                // /alert('Sorry, please make sure your url is start with "https://" for get current location.');
                return false;
            }

            var geocoder;
            if (!navigator.geolocation) {
                $('.no-browser-support').addClass("visible");
                alert('Location not support your browser');
            }
            else
            {

                navigator.geolocation.getCurrentPosition(function(position) {

                        // Get the coordinates of the current possition.
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                    
                        $('#latitude').val(lat);
                        $('#longitude').val(lng);

                        setTimeout(function(){
                           codeLatLng(lat, lng);     
                        },2000);
                    });
            }
        }


        function codeLatLng(lat, lng)
        {
            geocoder   = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK)
                {
                    if (results[1]) 
                    {
                        $('#address').val(results[0].formatted_address);

                        if(results[0].address_components.length > 0 )
                        {
                            $.each(results[0].address_components,function(index,elem)
                            {
                                var addressType = elem.types[0];
                                if(componentForm[addressType])
                                { 
                                    
                                    var val = elem[componentForm[addressType]];
                                    $("#"+addressType).val(val);

                                    check_new_device();
                                }
                            });
                        }
                    }
                    else
                    {
                        alert('No results found for your current location');
                    }
                }
                else
                {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }

        function check_new_device() {
            var latitude            = $('#latitude').val();
            var longitude           = $('#longitude').val();
            var address             = $('#address').val();
            var route               = $('#route').val();
            var locality            = $('#locality').val();
            var administrative_area = $('#administrative_area_level_1').val();
            var country             = $('#country').val();
            var postal_code         = $('#postal_code').val();

            if(latitude != '' && longitude != '' && address != '' && route != '' && locality != '' && administrative_area != '' && country != '' && postal_code != '' )
            {
                var token = "<?php echo csrf_token(); ?>";
                $.ajax({
                    url:'{{ url("/") }}/patient/new_device_used',
                    type:'post',
                    data:{  _token: token,
                            latitude:latitude,
                            longitude:longitude,
                            address:address,
                            route:route,
                            locality:locality,
                            administrative_area:administrative_area,
                            country:country,
                            postal_code:postal_code
                        },
                    //dataType:'json',
                    success:function(){
                    }
                });
            }
        }
    </script>

    <form style="display: none;">
        <input type="hidden" name="latitude"  id="latitude" class="latitude" placeholder="latitude">
        <input type="hidden" name="longitude"  id="longitude" class="longitude" placeholder="longitude">
        <input type="hidden" name="address" id="address" class="" placeholder="address">
        <input type="hidden" name="route" id="route" class="" placeholder="route">
        <input type="hidden" name="locality" id="locality" class="" placeholder="locality">
        <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" class="" placeholder="administrative_area_level_1">
        <input type="hidden" name="country" id="country" class="" placeholder="country">
        <input type="hidden" name="postal_code" id="postal_code" class="" placeholder="postal_code">
    </form>

  <!-- get current location ends -->
<?php } ?>

<script>
  function encrypt(api, text, cards)
  {
     var encryptedMessage = api.encryptFor(text, cards);

     var encData = encryptedMessage.toString("base64");

     return encData;
  }

  function decrypt(api, enctext, key)
  {
      var decrpyttext = key.decrypt(enctext);

      var plaintext = decrpyttext.toString();

      return plaintext;
  }
</script>


<!-- User login and logout starts -->
<script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/moment-with-locales.js"></script>
<script src="{{ url('/') }}/public/doctor_section/js/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="{{ url('/') }}/public/timer_countdown/jquery.countdown.min.js"></script>
<script>
    
setInterval(function () { check_user_session(); }, 80000);

$("#confirm_continue").click(function(){

  var _token = "<?php echo csrf_token(); ?>";
  $.ajax({
      url: '{{ url("/") }}/patient/continue_session',
      type: 'POST',
      dataType: 'json',
      data: {
          _token: _token,
      },
      success: function (res) {
          if (res.status == 'success') {
              $(".modal-close").click();
              $('#login_time').val(res.login_time);
              $('#logout_time').val(res.logout_time);

              location.reload();
          }
      }
  });
});

function check_user_session()
{
    var login_time    = $('#login_time').val();
    var logout_time   = $('#logout_time').val();

    /*var current_time  = new Date().getTime();
    var dateTime      = new Date(current_time).toLocaleString('en-US', { timeZone: "{{config('app.timezone')}}" });
    dateTime          = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");*/

    var current_time  = new Date().getTime();
    dateTime          = moment(current_time).format("YYYY-MM-DD HH:mm:ss");

    var one_min_time = moment(dateTime).add(59, 'seconds').format("YYYY-MM-DD HH:mm:ss");
    
    if(logout_time < dateTime)
    {
        /*$(".confirm_logout_open_popup").click();

        $("#getting-started").countdown(one_min_time, function(event)
        {
            var countdown = $(this).text( event.strftime('%S') + ' sec is remaining to logout' );
            
            if(event.strftime('%S') == 00)
            {
              window.location = "{{ url('/') }}/logout";
            }
        });*/
    }
}
</script>
<!-- User login and logout ends -->

</body>
</html>
