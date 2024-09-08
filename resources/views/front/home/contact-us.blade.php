@extends('front.layout.master-coming-soon')                
@section('main_content')
      <div class="banner-home inner-page-box" style="background: transparent url('images/header-top.jpg'); background-repeat:no-repeat; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
         <div class="bg-shaad inner-page-shaad">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="banner-home-box">
                        <h1>Contact Us</h1>
                        <div class="bor-light">&nbsp;</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--contact us section start here-->       
      <div class="middle-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="col-sm-12 col-md-4 col-lg-6 whit-box">
                     <h3>Send Us a Message</h3>
                     <form action="#">
                        <div class="user_box">
                            <label class="label-bold">Name<span style="color:red">*</span></label>
                           <input class="input_bor-white" placeholder="Name" type="text"/>
                        </div>
                        <div class="user_box">
                            <label class="label-bold">Email<span style="color:red">*</span></label>
                           <input class="input_bor-white" placeholder="Email" type="text"/>
                        </div>
                        <div class="user_box">
                            <label class="label-bold">Phone<span style="color:red">*</span></label>
                           <input class="input_bor-white" placeholder="Phone" type="text"/>
                        </div>
                        <div class="user_box">
                            <label class="label-bold">Message<span style="color:red">*</span></label>
                           <textarea rows="" cols="" class="input_bor-white" placeholder="Message"></textarea>
                        </div>
                        <div class="user_box text-right">
                           <button type="submit" class="btn btn-search-login max-w-0">Send Message</button>
                        </div>
                     </form>
                  </div>
                  <div class="col-sm-12 col-md-8 col-lg-6 con-box bor-none">
                     <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 con-box">
                           <div class="con-box1">
                              <div class="titl-cont-bx">Address</div>
                              <div class="box-add">
                                 <span><img src="images/address.png" alt="Address"/></span>
                                 <div class="info-con">900 Biscayne Boulevard, 
                                    Miami, FL 33132, USA
                                 </div>
                              </div>
                           </div>
                           <hr/>
                           <div class="con-box1">
                              <div class="titl-cont-bx">Email</div>
                              <div class="box-add">
                                 <span><img src="images/message.png" alt="Message"/></span>
                                 <div class="info-con">info@doctroo.com</div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 con-box bor-none">
                           <div class="con-box1">
                              <div class="titl-cont-bx">Phone</div>
                              <div class="box-add">
                                 <span><img src="images/phone.png" alt="Phone"/></span>
                                 <div class="info-con">01-222-333-4444</div>
                              </div>
                           </div>
                           <hr/>
                           <div class="con-box1">
                              <div class="titl-cont-bx">Fax</div>
                              <div class="box-add">
                                 <span><img src="images/fax.png" alt="Fax"/></span>
                                 <div class="info-con">1-234-456-1234</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="map-frame">
                        <div  width="100%" height="310" id="map" style="border:0"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--contact us section end here--> 
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
 
    <?php $address = '';
    if(isset($contact_info['address']))
    { 
       $address = $contact_info['address'];
       $address11=preg_replace("/<br\W*?\/>/", "",  $address);
    }  
    ?> 
  <script>
  
    var geocoder  = new google.maps.Geocoder();
    var address   = "<?php echo $address11;?>";
    var latitude;
    var longitude;

    
      geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
          latitude = results[0].geometry.location.lat();
          longitude = results[0].geometry.location.lng();

          } 
          else
          {
             latitude  = 19.9899040;
             longitude = 73.8041430;
          }


      var locations = [ [address, latitude, longitude, 4] ];
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(latitude, longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var infowindow = new google.maps.InfoWindow();

      var marker, i;
      for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
        }); 
      

  </script>
   

<!--contact us section end here-->           

@stop