@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow hide-on-large-only"><a href="add-new-patients.html"  class="menu-icon center-align"><i class="material-icons">keyboard_arrow_left</i></a></div>
        <h1 class="main-title center-align">Add Pharmacy</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header posrel">
        <div class="consultation-content posrel pdtbrl minhtnor has-footer">
            <div class="consultation-guide">
                <div class="head-medical-pres">
                    <div class="search-box-location">
                        <form method="GET" id="form_search_pharmacy" action="{{ url('/') }}/doctor/patients/add_pharmacy/{{$enc_patient_id}}/search">
                            <div class="input-field targeticon">
                                <input type="text" class="validate" id="suburb" name="suburb" placeholder="Search Suburb or Postcode" onFocus="geolocate()" value="{{ $search_keyword }}">
                            </div>

                            <table id="address" style="display: none;">
                              <tr>
                                <td class="label">Street address</td>
                                <td class="slimField"><input class="field" id="street_number" disabled="true"></input></td>
                                <td class="wideField" colspan="2"><input class="field" id="route" name="route" disabled="true"></input></td>
                              </tr>
                              <tr>
                                <td class="label">City</td>
                                <td class="wideField" colspan="3"><input class="field" id="locality" name="locality" disabled="true"></input></td>
                              </tr>
                              <tr>
                                <td class="label">State</td>
                                <td class="slimField"><input class="field" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true"></input></td>
                                
                                <td class="label">Zip code</td>
                                <td class="wideField"><input class="field" id="postal_code" name="postal_code" disabled="true"></input></td>
                              </tr>
                              <tr>
                                <td class="label">Country</td>
                                <td class="wideField" colspan="3"><input class="field" id="country" name="country" disabled="true"></input></td>
                              </tr>
                            </table>

                            <button class="border-btn btn round-corner" id="btn_search_pharmacy">Search</button>
                        </form>
                    </div>
                    <span class="posleft qusame rescahnge hide-on-med-and-down">
                        <a href="{{$module_url_path}}/patients/details/{{$enc_patient_id}}" class="border-btn btn round-corner center-align "> &lt; Back</a>
                    </span>
                </div>
                <div class="">

                </div>
                <div class="clr"></div>
                <div class="width-340 left">

                    <div class="round-box z-depth-3">
                        <div class="blue-border-block-top"></div>
                        <div class="green-border round-box-content pharmacy-list">
                            <ul class="collection nobrdr brdrtopsd all_pharamicies" id="all_pharamicies">
                                @if(isset($pharmacy_data['data']) && !empty($pharmacy_data['data']))
                                    @foreach($pharmacy_data['data'] as $ph_data)
                                        
                                        <?php /*<li class="collection-item avatar valign-wrapper">
                                            <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                                            <div class="doc-detail-location big left"><a class="add_pharmacy_btn" title="Add Pharmacy" href="{{$ph_data['user_id']}}"> <span class="title truncate"> {{ $ph_data['userinfo']['title'].' '.$ph_data['userinfo']['first_name'].' '.$ph_data['userinfo']['last_name'] }}</span></a>
                                                <small>{{ $ph_data['address1'].' '.$ph_data['address2'] }}</small>
                                            </div>
                                            <div class="right posrel"> </div>

                                            <div class="clearfix"></div>
                                        </li>*/ ?> 

                                        <!-- <a href="{{$ph_data['id']}}" class="add_pharmacy_btn"> -->
                                        <li class="collection-item avatar valign-wrapper" style="cursor: pointer;">
                                            <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                                            <div class="doc-detail-location big left pharmacy_list" data-name="{{ $ph_data['company_name'] }}" data-lat="{{ $ph_data['latitude'] }}" data-lng="{{ $ph_data['longitude'] }}"><span class="title truncate">{{ $ph_data['company_name'] }}</span>
                                                <small>{{ $ph_data['street'].', '.$ph_data['suburb'].', '.$ph_data['state'].' '.$ph_data['code'] }}</small>
                                            </div>
                                            <div class="right posrel"> </div>
                                            <div class="clearfix"></div>
                                            <a href="{{$ph_data['id']}}" class="add_pharmacy_btn"><span class="grey-text"></span><div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div></a>
                                        </li>
                                        <!-- </a> -->

                                    @endforeach
                                @else
                                    <h5 class="title truncate no-data">No Pharmacy Available</h5>
                                @endif
                            </ul>
                            <div class="paginaton-block-main" id="update_pagination"> {{ $paginate }} </div>
                            <ul class="collection nobrdr brdrtopsd" id="search_result" style="display: none;margin-top:-20px;">

                            <div class="clr"></div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
                <div class="width-760 right">
                    <div class="blue-border-block-top"></div>
                    <div class="round-box z-depth-3">
                        <div class="green-border">
                            <div class="wid100" id="map" style="width: 702px; height: 472px;"><img class="responsive-img" src="{{ url('/') }}/public/doctor_section/images/map-pharmacy.png" /></div>
                            <div class="clr"></div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>


    </div>

    <a class="popup_open" href="#pharmacy_confirmation" style="display: none;"></a>

    <div id="pharmacy_confirmation" class="modal  date-modal addperson">
        <div class="modal-content">
           <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
           <div class="flash_msg_text center-align">Do you really want to add this pharmacy?</div>
           <input type="hidden" id="pharmacy_id">
        </div>
        <div class="modal-footer  center-align">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons" id="btn_add_pharmacy">Yes</a>
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-cancel-cons">No</a>
        </div>  
    </div>

    <script>
        $(document).ready(function(){
            $('#btn_search_pharmacy').click(function(){
                var suburb = $('#suburb').val();
                if(suburb != '')
                {
                    //$('#form_search_pharmacy').submit();
                }
            });
        });
    </script>

    <?php if(Request::segment(1)=='doctor' && Request::segment(3)=='add_pharmacy'){ ?>
    @include('google_api.googleapi')
    <script src="{{ url('/') }}/public/js/geolocator/jquery.geocomplete.min.js"></script>
    <script>
      /*$(document).ready(function(){
        var location = "Australia";
        $("#suburb").geocomplete({
            details: ".geo-details",
            detailsAttribute: "data-geo",
        });
      });*/

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('suburb')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
            console.log(val);
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <?php } ?>

    <script>

    var url="<?php echo $module_url_path; ?>" ;

    $(document).ready(function() {
        $('.search_address').keyup(function(){
            var search_txt = $('.search_address').val();
                  if($('.search_address').val()=='')
                        {
                            $('.all_pharamicies').show();
                            $('#search_result').hide();
                            return false;
                        }  
            $.ajax({
                url:url+"/patients/search_pharmacy",
                type:'get',
                data:{search_txt:search_txt},
                success:function(data){
                   $('.search_result').html('');
                  
                    if(data.response.status=='success')
                    {
                       $('.all_pharamicies').hide();
                       $('#search_result').show();
                       $.each(data.response,function(i,obj)
                        {
                            if(typeof obj.first_name === "undefined")
                            {

                            }
                            else
                            {
                            $('#search_result').append('<li class="collection-item avatar valign-wrapper search_result"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div><div class="doc-detail-location big left"><a class="add_pharmacy_btn" title="Add Pharmacy" href="'+obj.user_id+'"><span class="title truncate">'+obj.first_name+' '+obj.last_name+' </span></a><small>'+obj.address1+' '+obj.address2+'</small></div><div class="right posrel"> </div><div class="clearfix"></div></li>');
                            }
                        });   
                    }
                    else
                    {
                        $('.all_pharamicies').hide();
                        $('#search_result').show();
                           $('#search_result').html('<li class="collection-item avatar valign-wrapper search_result"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div><div class="doc-detail-location big left"><span class="title truncate">No result Found</span><small></small></div><div class="right posrel"> </div><div class="clearfix"></div></li>');
                    }    
                }
            });
        });

        $('#btn_add_pharmacy').click(function(){
            
            var pharmacy_id=$('#pharmacy_id').val();
            var enc_patient_id="<?php echo $enc_patient_id; ?>";
            $.ajax({
                 url:url+'/patients/add_pharmacy_data',
                 type:'get',
                 data:{enc_patient_id:enc_patient_id,pharmacy_id:pharmacy_id},
                 success:function(data){
                    $(".open_popup").click();
                    $('.flash_msg_text').html(data.msg);
                 }
            });
        });
    });

    $(document).on('click','.add_pharmacy_btn',function(e){
        e.preventDefault();
        $(".popup_open").click();
           $('#pharmacy_id').val($(this).attr('href'));         
        
    });
</script>

@endsection