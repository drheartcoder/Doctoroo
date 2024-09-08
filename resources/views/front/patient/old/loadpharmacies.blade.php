<div id="div_load_pharmacy">
   <div class="row">
      <div class="col-sm-12">
         <div class="signup-txt">
            To join our platform, search for your pharmacy below, select it and continue the registration processs
         </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="search-bx">
            <input type="text" class="search-in" name="search_pharmacy"  id="search_pharmacy" placeholder="Search By Suburb or Postcode" value="{{isset($search_term)?$search_term:''}}" />
            <span> <button class="pharna-search-btn" type="button" id="pharmacy_search"> Search</button></span>
         </div>
         <div class="left-map-section" id="content-d1">
           <div class="chatting-section">
            @if(count($arr_pharmacies)>0)
               <?php $i=0;?>
               @foreach($arr_pharmacies as $pharmacy)
               <div class="pharma-row <?php if($i==(count($arr_pharmacies)-1)){ echo"last"; } ?>">
                  <div class="row">
                     <div class="col-sm-7 col-md-6 col-lg-7">
                       <div class="home-icon @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) act @endif"> <i class="fa fa-home"></i></div>
                        <div class="pharmcy-detail-bx">
                           <a href="javascript:void(0);" onclick="myClick('<?php echo $i;?>');" @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) class="act" @endif>  {{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}}</a>
                           <div class="pharna-add">
                              {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                              <br/>
                              {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-5 col-md-6 col-lg-5">
                        <div class="pharma-btns">
                           <button class="details-btn" type="button" onclick="getDetails('<?php echo $pharmacy['id'];?>');">Details</button>
                           {{-- <button class="details-btn select-btn">Select</button> --}}
                           <div class="step-radios1 rdio-select-btn">
                            <div class="radio-btn">
                              <input type="radio" @if(isset($patient_arr['my_local_pharmacy']) && $patient_arr['my_local_pharmacy']==$pharmacy['id']) checked="checked" @endif name="local_pharmacy" id="local_pharmacy<?php echo $pharmacy['id'];?>" value="{{ $pharmacy['id'] }}">
                              <label for="local_pharmacy<?php echo $pharmacy['id'];?>">
                              <span class="interior-icon">
                               Select
                              </span>
                              </label>
                              <div class="check"></div>
                           </div>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php $i++;?>
               <div id="pharmacydetail{{$pharmacy['id']}}" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
                 <div class="modal-dialog loign-insw">
                    <!-- Modal content-->
                    <div class="modal-content logincont">
                       <div class="modal-header head-loibg">
                          <button type="button" class="login_close close" data-dismiss="modal">&times;</button>
                       </div>
                       <div class="modal-body bdy-pading">
                           <div class="login_box">
                            <div class="title_login">Pharmacy Details</div>
                             <div class="forget-txt bb-head">{{isset($pharmacy['pharmacy_name'])?$pharmacy['pharmacy_name']:''}}</div>
                             <div class="forget-txt">
                               <div class="popup-icns">
                                <img src="{{url('/')}}/public/images/marker.jpg" width="20px" />
                                </div>
                                <div class="popup-details-content">
                                  <div class="forget-txt">  
                                  {{ isset($pharmacy['location'])?$pharmacy['location']:' ' }}
                                  <br/>
                                  {{ isset($pharmacy['suburb'])?$pharmacy['suburb']:' ' }}
                                </div>  
                               </div>
                               <div class="clearfix"></div>
                                  <div class="popup-icns">
                                  <i class="fa fa-phone" aria-hidden="true"></i>
                                  </div>
                                  <div class="popup-details-content">
                                    {{ isset($pharmacy['phone_no'])?$pharmacy['phone_no']:' ' }}
                                  </div>
                             </div>  
                             <div class="clearfix"></div>
                            <br/>
                         </div>
                      </div>
                    </div>
                 </div>
              </div>
               @endforeach 
               @else
               <div class="alert alert-info alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <strong>Sorry,</strong> Currently no any pharmacy avaliable.
               </div>
               @endif
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6">
         <div class="pharma-map" id="map" style="width:100%;height:465px;"></div>
      </div>
   </div>
 </div>

<!--Pharmacy Deatil end here-->
<script  src="{{ url('/') }}/public/js/jquery-ui.js"></script> 
<script>
$(document).ready(function(){
      /*get listing of all suburb & postcode*/
      $("input[name='search_pharmacy']").autocomplete(
      {
         
          minLength:3,
          extraParams: {
             country: 'Australia'
          },       
          source:"{{url('/')}}/patient/location_listing",
          search: function () {
               showProcessingOverlay();
           },
           response: function () {
             hideProcessingOverlay();
          },
          select:function(event,ui)
          {
             
          }
       });

      /*=================Ajax ==================*/
      
       $('#pharmacy_search').on('click',function(){


      var search_pharmacy = $('#search_pharmacy').val();

      if($.trim(search_pharmacy)=="")
      {

         $('#search_pharmacy').val('');
         $('#err_search_pharmacy').html('Please enter suburb or postcode.');
         $('#err_search_pharmacy').fadeOut(4000);
         $('#search_pharmacy').focus();
         return false;

      }
      else
      {     


         $.ajax({
            url   : "{{ url('/') }}/patient/search_pharmacy",
            type : "GET",
            data: 'search_pharmacy='+search_pharmacy,
            beforeSend: function() {
               showProcessingOverlay();
            },
            success : function(res){
               
               if($.trim(res)!='error')
               {
                   
                   $('#div_load_pharmacy').html(res); 
                   initialize();
                   $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
                   $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
                   $("#content-d1").mCustomScrollbar({theme:"dark"});
              
                   return true; 
               }
            },
            complete: function() {
               hideProcessingOverlay();
            }
         });
      }   
   });     
   
});  
   /*================Map================*/
    var markers = [];
    var local_pharmacy = "<?php echo $patient_arr['my_local_pharmacy'];?>";
   function initialize() 
   {
   
   var site_url           = "{{ $site_url }}";
   var locations =[];  
   <?php if(count($arr_pharmacies)>0){  $i=0;?>
   
   locations = [
   
   <?php foreach ($arr_pharmacies as $pharmacy) { 
      $pharmacy_name = preg_replace("/(\'|&#0*39;)/", "", $pharmacy['pharmacy_name']);
      ?>
   
   [<?php echo"'".$pharmacy_name."'";?>, <?php echo $pharmacy["latitude"];?>, <?php echo $pharmacy["longitude"];?>,<?php echo $pharmacy['id'];?>]
   <?php if($i<count($arr_pharmacies)-1){
      echo',';
      }
      $i++;
      }
      ?>   
   ];
   <?php }?>
   
   var map = new google.maps.Map(document.getElementById('map'), {
   zoom: 3,
   center: new google.maps.LatLng(-33.865143, 151.209900),
   mapTypeId: google.maps.MapTypeId.ROADMAP
   });
   
   var infowindow = new google.maps.InfoWindow();
   var latlngbounds = new google.maps.LatLngBounds();
   
   
   var marker, i;
   
   for (i = 0; i < locations.length; i++) {  
   
     if(local_pharmacy==locations[i][3])  
      {

           var icon = {
                          url: site_url+'/images/map-green-icon.png', 
                      };
      }
      else
      {

          var icon = {
                          url: site_url+'/images/map-green-icon.png', 
                      };
      }

   marker = new google.maps.Marker({
   position: new google.maps.LatLng(locations[i][1], locations[i][2]),
   map: map,
   icon:icon

   });
   
   latlngbounds.extend(marker.position);

   var content = '<div class="pharmcy-detail-bx" style="font-size: 13px;line-height: 18px;font-weight: 400; margin-right: 1px;max-height: 80px;overflow-y: auto;overflow-x: hidden;font-family:robotolight",sans-serif">'+locations[i][0]+'</div>';
     
   google.maps.event.addListener(marker, 'click', (function(marker, i) {
   return function() {
         <?php if(count($arr_pharmacies)>0){
          foreach ($arr_pharmacies as $pharmacy) 
          {
              $pharmacy_id = '#pharmacydetail'.$pharmacy['id'];  
              $pharmacy_name = preg_replace("/(\'|&#0*39;)/", "", $pharmacy['pharmacy_name']);

           ?>
           var pharmacy_name = "<?php echo $pharmacy_name;?>";
           if(pharmacy_name==locations[i][0])
           {

           $('<?php echo $pharmacy_id;?>').modal('show');
         }
         <?php } } ?>

       infowindow.setContent(content);
       infowindow.open(map, marker);
       setHighlightPharmacy(i);
   }
   })(marker, i));
  
    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
       return function() {

        
        var infowindow = new google.maps.InfoWindow({
            content: content,
            borderRadius: 4,
            borderWidth: 10,
            borderColor: '#FF0000',
            maxWidth: 300
          });
     
      infowindow.open(map, marker);
      setHighlightPharmacy(i);

       }

     
     })(marker, i));

   markers.push(marker);

   map.setCenter(latlngbounds.getCenter());
   map.fitBounds(latlngbounds);
   
   }
   }
    function myClick(id){

      google.maps.event.trigger(markers[id], 'click');
  }
   function setHighlightPharmacy(elem)
   {
   $('.pharmacy_div').removeClass('highlight-pharma-row');
   $('.pharmacy_'+elem).removeClass('pharma-row');
   $('.pharmacy_'+elem).addClass('highlight-pharma-row');
   
   setTimeout(function(){
   $('.pharmacy_'+elem).focus();
   
   },200);
   
   
   }
</script>
