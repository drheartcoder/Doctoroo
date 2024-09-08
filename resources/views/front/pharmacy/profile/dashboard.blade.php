@extends('front.pharmacy.layout.master')                
@section('main_content')
	
	 <div class="banner-home inner-page-box">
         <div class="bg-shaad doc-bg-head">
         </div>
      </div>
	 <div class="container-fluid fix-left-bar">
         <div class="row">
      		@include('front.pharmacy.layout.profile_layout._profile_sidebar')
            <div class="col-sm-12 col-md-9 col-lg-10">
               <div class="das-middle-content">
                  <div class="row">

                     <div class="col-sm-12">
                        <div class="inner-head">Pharmacy Dashboard</div>
                        <div class="head-bor"></div>
                        <div class="doc-name">Welcome {{ $arr_pharmacy['pharmacy_name'] or '' }}</div>
                     </div>
                     <div class="col-sm-12">
                      @include('front.layout._operation_status')
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Notifications
                              </div>
                              <div class="content-d" style="height:216px;">
                                 <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                    <tr>
                                       <td style="white-space:normal;">
                                          Odit, iusto, dolorem, aut ipsum 
                                          rem atque enim
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          At, veniam, officia pariatur voluptas 
                                          molestias nobis
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          Laborum, ducimus, perferendis 
                                          nulla magni sequi
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          Odit, iusto, dolorem, aut ipsum 
                                          rem atque enim
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          At, veniam, officia pariatur voluptas 
                                          molestias nobis
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;">
                                          Laborum, ducimus, perferendis 
                                          nulla magni sequi
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                 </table>
                              </div>
                              
                              </div>
                              <a class="links" href="#" style="text-align:center;"> View All Patient</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Messages
                              </div>
                              <div class="content-d" style="height:216px;">
                              <div class="table-responsive basic-table">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Medical Certificate</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">3 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Nicolas Payne</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Caroline Fowler</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Nicolas Payne</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">1 hours ago </td>
                                    </tr>
                                    <tr>
                                       <td style="white-space:normal;color:#999999">
                                          <span style="font-family:'robotolight',sans-serif;font-size:16px;color:#3a3a3a">Caroline Fowler</span><br/>
                                          Transport few items from Hills...
                                       </td>
                                       <td style="color: #b2b2b2;font-size:14px;">30 min ago </td>
                                    </tr>
                                 </table>
                              </div>
                               </div>
                                <a class="links" href="#" style="text-align:center;"> View All Messages</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 New Orders
                              </div>
                              <div class="content-d" style="height:216px;">
                                 <div class="table-responsive table basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td style="width: 28%;">
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td> <a style="color:#6b5883;font-family:'robotolight'" href="">Details</a></td>
                                          <td>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/check-icon.png" alt="icon"/>
                                             <img class="icons-dash" src="{{ url('/') }}/public/images/cross-icon.png" alt="icon"/>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <a class="links" href="#" style="text-align:center;"> View All Bookings</a>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Add New Patient
                              </div>
                              <div class="content-d" style="height:216px;">
                                 <div class="table-responsive basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                       <tr>
                                          <td>
                                             <div class="doc-pro">
                                                <img src="{{ url('/') }}/public/images/doc-pro1.png" alt="profile img"/>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="see-doc-btn"><button>Add New Patient</button></div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <div class="doc-pro">
                                                <img src="{{ url('/') }}/public/images/doc-pro3.png" alt="profile img"/>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="see-doc-btn"><button>Add New Patient</button></div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <div class="doc-pro">
                                                <img src="{{ url('/') }}/public/images/doc-pro3.png" alt="profile img"/>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="see-doc-btn"><button>Add New Patient</button></div>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <a class="links" href="#" style="text-align:center;"> View All Patient</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 My Prescriptions
                              </div>
                              <div class="content-d" style="height:216px;">
                                 <div class="table-responsive table basic-table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                       <tr>
                                          <td style="color: #868686;">8:40 am, 12 JUN </td>
                                          <td>John Smith   </td>
                                          <td><a href="#"> Details</a></td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <a class="links" href="#" style="text-align:center;"> View All Patient</a>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="doc-dash-right-bx">
                           <div class="tble-frmt">
                              <div class="tble-title">
                                 Doctor &amp; Pharmacy Search
                              </div>
                              <div class="content-d" style="height:216px;">
                                 <div class="table-responsive basic-table">
                                    <div class="table-responsive basic-table">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                                          <tr>
                                             <td style="text-align:center;" colspan="2">
                                                <a href="#" class="see-green">Search Doctor  </a><a style="text-decoration:none;color:#50AB50;"> &nbsp; | &nbsp;</a> <a href="#" class="see-green">Search Pharmacy</a>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <div class="doc-pro">
                                                   <img src="{{ url('/') }}/public/images/doc-pro.png" alt="profile img"/>
                                                </div>
                                                <div class="doc-nm">
                                                   Dr. Matt Noble
                                                   <span class="doc-status">
                                                   Available Now
                                                   </span>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="see-doc-btn"><button>see Doctor</button></div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <div class="doc-pro">
                                                   <img src="{{ url('/') }}/public/images/video-small.png" alt="profile img"/>
                                                </div>
                                                <div class="doc-nm">
                                                   Dr. Betty Rhea
                                                   <span class="doc-status">
                                                   Available Now
                                                   </span>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="see-doc-btn"><button>see Doctor</button></div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <div class="doc-pro">
                                                   <img src="{{ url('/') }}/public/images/doc-pro.png" alt="profile img"/>
                                                </div>
                                                <div class="doc-nm">
                                                   Dr. Matt Noble
                                                   <span class="doc-status">
                                                   Available Now
                                                   </span>
                                                </div>
                                             </td>
                                             <td>
                                                <div class="see-doc-btn"><button>see Doctor</button></div>
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <a class="links" href="#" style="text-align:center;">View All Doctor &amp; Pharmacy</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <link href="{{ url('/') }}/public/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
      <script src="{{ url('/') }}/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script>
         (function($){
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
                 $(".content-d").mCustomScrollbar({theme:"dark"});
         
         });
         })(jQuery);
      </script>
@endsection