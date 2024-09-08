@extends('front.doctor.layout.new_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse  menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">Pharmacies</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header posrel">
        <div class="consultation-content posrel pdtbrl minhtnor has-footer">
            <div class="consultation-guide">
                <div class="head-medical-pres">
                    <div class="search-box-location">
                        <form method="GET" id="form_search_pharmacy" action="{{ url('/') }}/doctor/pharmacies/search">
                            <div class="input-field targeticon">
                                <input type="text" class="validate" id="suburb" name="suburb" placeholder="Search Suburb or Postcode" onFocus="geolocate()" >
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
                    <span class="posleft qusame rescahnge hide-on-med-and-down"><a href="{{ url('/') }}/doctor/profile/dashboard" class="border-btn btn round-corner center-align "> &lt; Back</a></span>
                </div>
                <div class="">

                </div>
                <div class="clr"></div>
                <div class="width-340 left">

                    <div class="round-box z-depth-3">
                        <div class="blue-border-block-top"></div>
                        <div class="green-border round-box-content pharmacy-list">
                            <ul class="collection nobrdr brdrtopsd" id="update_pharmacy_list">
                                @if(count($pharmacy_data['data']) > 0 && !empty($pharmacy_data['data']) )
                                    @foreach($pharmacy_data['data'] as $ph_data)
                                        <li class="collection-item avatar valign-wrapper">
                                            <div class="doc-detail-location big left show_pointer pharmacy_list" data-name="{{ $ph_data['company_name'] }}" data-lat="{{ $ph_data['latitude'] }}" data-lng="{{ $ph_data['longitude'] }}">
                                                <span class="icon-location text-center left"> <i class="material-icons">add_location</i> </span>
                                                <span class="title truncate">{{ $ph_data['company_name'] }}</span>
                                                <small>{{ $ph_data['street'].', '.$ph_data['suburb'].', '.$ph_data['state'].' '.$ph_data['code'] }}</small>
                                            </div>
                                            <div class="right posrel"> </div>
                                            <div class="clearfix"></div>
                                        </li>
                                    @endforeach
                                @else
                                    <h5 class="title truncate no-data">No pharmacy available</h5>
                                @endif
                            </ul>
                            <div class="paginaton-block-main" id="update_pagination"> {{ $paginate }} </div>
                            <div class="clr"></div>
                        </div>
                        <div class="blue-border-block-bottom"></div>
                    </div>
                </div>
                <div class="width-760 right" >
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

    <?php if(Request::segment(1)=='doctor' && Request::segment(2)=='pharmacies'){ ?>
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

@endsection
