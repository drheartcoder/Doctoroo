@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/my_pharmacy" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Add Pharmacy</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer minhtnor"> -->
    
        <div class="medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#list" class="active">LIST</a>
                </li>
                <li class="tab truncate">
                    <a href="#google_map">MAP</a>
                </li>
            </ul>
            <div class="clear"></div>

            <div id="list" class="tab-content">
                <div class="marmain">
                    <form method="GET" id="form_search_pharmacy" action="{{ url('/') }}/patient/setting/search_pharmacy">
                      <div class="input-field targeticon">
                          <input id="search" name="txt_search" type="text" class="validate search_address" placeholder="Search Suburb or Postcode" value="{{ $search_keyword }}">
                          <button class="border-btn btn round-corner" id="btn_search_pharmacy">Search</button>
                          <a href="{{ url('/') }}/patient/setting/add_pharmacy" class="border-btn btn round-corner" >Clear</a>
                      </div>
                    </form>
                    <div class="clr"></div>
                    <ul class="collection nobrdr brdrtopsd pdmintb all_pharamicies" id="all_pharamicies">
                        @if(isset($pharmacy_data['data']) && !empty($pharmacy_data['data']))
                            @foreach($pharmacy_data['data'] as $ph_data)
                                
                                <li class="collection-item avatar valign-wrapper">
                                    <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                                    <div class="doc-detail-location big left pharmacy_list" data-name="{{ $ph_data['company_name'] }}" data-lat="{{ $ph_data['latitude'] }}" data-lng="{{ $ph_data['longitude'] }}"><span class="title truncate">{{ $ph_data['company_name'] }}</span>
                                        <small>{{ $ph_data['street'].', '.$ph_data['suburb'].', '.$ph_data['state'].' '.$ph_data['code'] }}</small>
                                    </div>
                                    <div class="right posrel"> </div>
                                    <div class="clearfix"></div>
                                    <a href="{{$ph_data['id']}}" class="add_pharmacy_btn"><span class="grey-text"></span><div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div></a>
                                </li>
                            @endforeach
                        @endif
                    </ul>

                    <ul class="collection nobrdr brdrtopsd pdmintb" id="search_result" style="display: none;">
                    </ul>

                    <div class="divider"></div>
                    <div class="paginaton-block-main paging">
                        {{ $paginate }}
                    </div>
                    <div class="pdtb smalltext">
                        Can't find your pharmacy? <a href="{{ url('/') }}/patient/setting/invite_pharmacy" class="grey-text">click here</a>

                    </div>
                </div>
            </div>
            <div id="google_map" class="tab-content">
                <div class="blue-border-block-top"></div>
                    <div class="map" id="map" style="width: 100%; height: 500px;"></div>
                <div class="blue-border-block-bottom"></div>
                <div class="pdtb smalltext">
                    Can't find your pharmacy? <a href="{{ url('/') }}/patient/setting/invite_pharmacy" class="grey-text">click here</a>
                </div>
            </div>
        </div>

        </div>

        <!--<a class="waves-effect waves-light futbtn" href="review-booking.html">Save</a>-->
    </div>

<script>
    var url = "<?php echo $module_url_path; ?>";

    $(document).ready(function() {
        
        $('#btn_search_pharmacy').click(function(){
            var suburb = $('#suburb').val();
            if(suburb != '')
            {
                $('#form_search_pharmacy').submit();
            }
        });

        /*$('.search_address').keyup(function(){
            var search_txt = $('.search_address').val();

            if($('.search_address').val() == '')
            {
                $('.all_pharamicies').show();
                $('#search_result').hide();
                return false;
            }
                       
            $.ajax({
                url:"{{ url('/') }}/patient/setting/search_pharmacy",
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
                   
                    if(typeof obj.company_name === "undefined")
                    {

                    }
                    else
                    {

                        alert(obj);
                        $('#search_result').append('<li class="collection-item avatar valign-wrapper search_result"><div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div><div class="doc-detail-location big left"><span class="title truncate">'+obj.first_name+'</span><small>'+obj.street+', '+obj.suburb+', '+obj.state+' '+obj.code+'</small></div><div class="right posrel"> </div><div class="clearfix"></div><a class="add_pharmacy_btn" href="'+obj.id+'"><span class="grey-text"></span><div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div></a></li>');

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
        });*/

    });

    $(document).on('click','.add_pharmacy_btn',function(e){
        e.preventDefault();
            var pharmacy_id = $(this).attr('href');
            $.ajax({
                 url:url+'/add_pharmacy_data',
                 type:'get',
                 data:{pharmacy_id:pharmacy_id},
                 success:function(data){
                    $(".open_popup").click();
                    $('.flash_msg_text').html(data.msg);
                 }
            });

    });
</script>

@include('google_api.google')
<script>
    $(document).ready(function(){
      VanillaRunOnDomReady();
    })
    
    var VanillaRunOnDomReady = function() {
       (function(Mapping, $, undefined) {
         var self = this;

         function Initialize() {
          var myOptions = {
            zoom: 4,
            center: new google.maps.LatLng(-24.574038, 134.042053),
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          self.map = new google.maps.Map(document.getElementById("map"),myOptions);
          self.markers = [];
          self.infoWindow = new google.maps.InfoWindow();

          $('.pharmacy_list').each(function() {
           var $this = $(this);
           var pos = new google.maps.LatLng($this.data('lat'), $this.data('lng'));
           var marker = new google.maps.Marker({
            position: pos,
            map: self.map
          });
           self.markers.push(marker);

           $this.click(function() {
             self.map.panTo(pos);
             self.infoWindow.setContent($this.data('name'));
             self.infoWindow.open(self.map, marker);
             $this.siblings().removeClass('active');
             $this.addClass('active');
           });
         });
        }

        Initialize();
      })(window.Mapping = window.Mapping || {}, jQuery);
    }

    /*var alreadyrunflag = 0;*/

    if (document.addEventListener)
      document.addEventListener("DOMContentLoaded", function(){
        //alreadyrunflag = 1;
        VanillaRunOnDomReady();
      });
    else if (document.all && !window.opera) {
      //document.write('<script id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
      var contentloadtag = document.getElementById("contentloadtag");
      contentloadtag.onreadystatechange=function(){
        if (this.readyState=="complete"){
          /*alreadyrunflag=1;*/
          VanillaRunOnDomReady();
        }
      }
    }

    window.onload = function(){
      //setTimeout("if (!alreadyrunflag){VanillaRunOnDomReady}", 0);
      
    }//]]>
</script>

@endsection