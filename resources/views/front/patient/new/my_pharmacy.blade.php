 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')
<div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">My Pharmacies</h1>

    </div>
    <div class="medi marmain">
        <div class="container posrel has-header" style="padding-bottom: 80px;!important">
            <div class="green-text padtopbtm">My Click &amp; Collect Pharmacies</div>
            <ul class="collection brdrtopsd ">
                <li class="collection-item avatar valign-wrapper">
                    <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                    <div class="doc-detail-location left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        <small>345 Smith Road, Greystanes, NSW 2145</small>
                    </div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Message</a></li>
                        <li><a href="#">Change</a></li>
                        <li><a href="#">Delete</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="collection-item avatar valign-wrapper">
                    <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                    <div class="doc-detail-location left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        <small>345 Smith Road, Greystanes, NSW 2145</small>
                    </div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown1' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown1' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Message</a></li>
                        <li><a href="#">Change</a></li>
                        <li><a href="#">Delete</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="collection-item avatar valign-wrapper">
                    <div class="icon-location text-center left"> <i class="material-icons">add_location</i> </div>
                    <div class="doc-detail-location left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        <small>345 Smith Road, Greystanes, NSW 2145</small>
                    </div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown2' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown2' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Message</a></li>
                        <li><a href="#">Change</a></li>
                        <li><a href="#">Delete</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
            </ul>
           
            <div class="right martp hidetext">
                <a  href="{{ url('/patient') }}/add_pharmacy"><span class="grey-text">Add a new pharmacy</span>
                    <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                </a>
                
            </div>
            <div class="clr"></div>
            <div class="green-text padtopbtm">Preferences</div>
            <div class="bluedoc-text">Preferred Medication Brand</div>
            <p class="grey-text">Do you prefer Original or Generic medications?
                <a href="#">What is the differece?</a>
            </p>
            <div class="row" >
                    <div class="input-field col s6 m6 l6 selct">
                        <select>
                            <option value="" disabled selected>Original Brand</option>
                            <option value="option1">option1</option>
                            <option value="option2">option2</option>
                        </select>
                    </div>
                    <div class="input-field col s6 m6 l6 selct">
                        <select>
                            <option value="" disabled selected>Generic Brand</option>
                            <option value="option1">option1</option>
                            <option value="option2">option2</option>
                        </select>
                    </div>

                </div>
            <!--<span class="left qusame rescahnge"><a href="{{ url('/patient') }}/my_health" class="border-btn round-corner  center-align">Original Brand</a></span>

            <span class="right qusame rescahnge"><a class="border-btn round-corner center-align" href="#">Generic Brand</a></span>-->
            <div class="clr"></div>
            <div class="divider martp"></div>
            <div >
                <div class="bluedoc-text martp">Entitlement</div>
                <div class="row" style="">
                    <div class="input-field col s6 m6 l6 selct">
                        <select>
                            <option value="" disabled selected>Select Entitlement</option>
                            <option value="option1">option1</option>
                            <option value="option2">option2</option>
                        </select>
                    </div>
                    <div class="input-field col s6 m6 l6  text-bx lessmar">
                        <input type="text" id="reason" class="validate " value="2947 3247 3893" readonly>
                        <label for="reason" class="grey-text truncate">Enter Card Number</label>
                    </div>

                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col s12 m12 l12 ">
                        <div class="input-field uploadImgnew">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span><i class="material-icons">camera_alt</i></span>
                                    <input type="file" multiple>
                                </div><span class="textside">Optional - Upload photo of affected area.</span>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>
            <!--<div class="bluedoc-text martp">My Entitlement</div>
            <div class="row marbtm">
                <div class="col l10 m9 s8">
                    <div class="input-field nomar">
                        <select>
                            <option value="" disabled selected> Select Entitlement</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>

                    </div>
                </div>
                <div class="col l2 m3 s4 mrt">
                    <a href="#" class="grey-text ">What's this?</a>
                </div>
            </div>-->

            

        </div>
        <!--Container End-->
    </div>
@endsection