@extends('front.patient.new.layout._dashboard_master')
@section('main_content')


 <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>

        <h1 class="main-title center-align">My Health</h1>

    </div>
    <div id="slide-out" class="side-nav fixed menu-main">
        @include('front.patient.new.layout._sidebar')
    </div>
    <div class="mar300 has-header posrel has-footer">
        <div class="consultation-tabs ">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#medication"><span><img src="{{url('/')}}/public/new/images/medication-icon.svg" alt="icon" class="tab-icon"/> </span> Medication </a></li>
                <li class="tab">
                    <a href="#history" class="active"> <span><img src="{{url('/')}}/public/new/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
                </li>
                <li class="tab">
                    <a href="#document"> <span><img src="{{url('/')}}/public/new/images/medical-document.svg" alt="icon" class="tab-icon"/> </span>Documents</a>
                </li>
                <li class="tab">
                    <a href="#askdoctor"> <span><img src="{{url('/')}}/public/new/images/doctor.svg" alt="icon" class="tab-icon" /> </span>Ask a Doctor</a>
                </li>
            </ul>
        </div>
        <div id="medication" class="tab-content medi">
            <ul class="tabs tabli nomr z-depth-2 tabs-fixed-width">
                <li class="tab truncate">
                    <a href="#test5">PRESCRIPTION MEDICATION </a>
                </li>
                <li class="tab truncate">
                    <a href="#test6" class="active">REGULAR MEDICATION</a>
                </li>
            </ul>
            <div class="clear"></div>
            <div class="container">
                <div id="test5" class="tab-content">
                    <ul class="collection brdrtopsd has-addbtn">
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <small>Active ingredient Aspri</small>
                                <span class="stat red-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                            </div>
                            <ul id='dropdown' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">5 pills left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown1' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown1' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown2' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown2' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown3' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown3' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="fixed-action-btn hidetext">
                        <a href="{{ url('/patient') }}/add_medication"><span class="grey-text">Add Medication</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>

                </div>
                <div id="test6" class="tab-content">
                    <ul class="collection brdrtopsd has-addbtn">
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <small>Active ingredient Aspri</small>
                                <span class="stat red-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown4' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a>

                            </div>
                            <ul id='dropdown4' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">5 pills left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown5' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown5' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown6' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown6' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                        <li class="collection-item valign-wrapper">
                            <div class="left"><span class="title">Crestor (anticlover) 20 mg</span>
                                <span class="stat green-text">0 repeats left</span>
                            </div>
                            <div class="right posrel">
                                <a href="#" data-activates='dropdown7' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                            <ul id='dropdown7' class='dropdown-content doc-rop'>
                                <li><a href="{{ url('/patient') }}/medication_details">View Details</a></li>
                                <li><a href="{{ url('/patient') }}/order_medication">Order New</a></li>
                                <li><a href="{{ url('/patient') }}/book_a_doctor">Get new prescription / repeat</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="fixed-action-btn hidetext">
                        <a href="{{ url('/patient') }}/add_medication"><span class="grey-text">Add Medication</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>

                </div>

            </div>
        </div>
        <div class="container">
            <div id="history" class="tab-content has-tab">
                <div id="general" class="tab-content ">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            <strong>General</strong> - Select / enter details of the below general history
                        </div>
                    </div>
                    <ul class="collection brdrtopsd">
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check1" />
                                <label for="check1" class="bluedoc-text">Allergies</label>
                            </div>
                            <!-- <div class="left wid100"><span class="title truncate">Allergies</span>

                            </div>
                            <div class="right new">
                                <div class="input-field chkbx new">
                                    <input type="checkbox" class="filled-in" id="chk" />
                                    <label for="chk"></label>
                                    <div class="clr"></div>
                                </div>
                            </div>-->
                            <div class="clear"></div>
                        </li>
                        <li class="collection-item posrel">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check2" checked="checked" />
                                <label for="check2" class="bluedoc-text">Surgeries / Procedures</label>
                            </div>
                            <a class="border-btn round-corner center-align save" href="#">Save</a>
                            <div class="hisdetails">
                                <div class="input-field ">
                                    <input type="text" id="reason" class="validate " placeholder="Enter details if required">

                                </div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check3" />
                                <label for="check3" class="bluedoc-text smalltext">Pregnancies
                                    <br>
                                    <small class="grey-text">Past pregnancies? Complications?</small></label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check4" />
                                <label for="check4" class="bluedoc-text">Family history</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check5" />
                                <label for="check5" class="bluedoc-text">Other</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                    </ul>
                    <span class="right qusame marbtm mrgtht"><a href="#" class="btn cart bluedoc-bg lnht round-corner">Save</a></span>
                    <div class="clr"></div>
                </div>
                <div id="condition" class="tab-content ">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            <strong>Conditions</strong> - Select / enter all conditions that you've had
                        </div>
                    </div>
                    <ul class="collection brdrtopsd">
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check6" />
                                <label for="check6" class="bluedoc-text">Diabetes</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item posrel">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check7" checked="checked" />
                                <label for="check7" class="bluedoc-text">Heart Disease (CHF, MI)</label>
                            </div>
                            <a class="border-btn round-corner center-align save" href="#">Save</a>
                            <div class="hisdetails">
                                <div class="input-field ">
                                    <input type="text" id="reason" class="validate " placeholder="Enter details if required">

                                </div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check8" />
                                <label for="check8" class="bluedoc-text smalltext">Pregnancies
                                    <br>
                                    <small class="grey-text">Past pregnancies? Complications?</small></label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check9" />
                                <label for="check9" class="bluedoc-text">Stroke</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check10" />
                                <label for="check10" class="bluedoc-text">High Blood Pressure</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check11" />
                                <label for="check11" class="bluedoc-text">High Cholesterol</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check12" />
                                <label for="check12" class="bluedoc-text">Asthma / COPD</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check13" />
                                <label for="check13" class="bluedoc-text">Depression</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                        <li class="collection-item  ">
                            <div class="chkbx new">
                                <input type="checkbox" class="filled-in " id="check14" />
                                <label for="check14" class="bluedoc-text">Arthrits</label>
                            </div>

                            <div class="clear"></div>
                        </li>
                    </ul>
                    <span class="right qusame marbtm mrgtht"><a href="#" class="btn cart bluedoc-bg lnht round-corner">Save</a></span>
                    <div class="clr"></div>
                </div>
                <div id="medication-condition" class="tab-content marbt">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            <strong>Medication</strong> - Select / enter all medication that you ve had
                        </div>
                    </div>
                    <ul class="collapsible no-shadow " data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header "><i class="material-icons right iconpatch">chevron_right</i>Crestor 20mg Panadeine Extra</div>
                            <div class="collapsible-body">
                                <div class="form">
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter medication name or active ingredient</label>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter use or why you take</label>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">How long have you been taking it?</label>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="otherdetails">
                                        <span class="left qusame"><a class="border-btn round-corner  center-align" href="#">SAVE</a></span>
                                    </div>

                                    <div class="clear"></div>


                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header active"><i class="material-icons right iconpatch">chevron_right</i>Crestor 20mg Panadeine Extra</div>
                            <div class="collapsible-body">
                                <div class="form">
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter medication name or active ingredient</label>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">Enter use or why you take</label>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="input-field col s12 text-bx">
                                        <input type="text" id="reason" class="validate">
                                        <label for="reason" data-error="wrong" data-success="right" class="truncate">How long have you been taking it?</label>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="otherdetails">
                                        <span class="left qusame "><a class="border-btn round-corner  center-align" href="#">SAVE</a></span>
                                    </div>

                                    <div class="clear"></div>


                                </div>
                        </li>

                    </ul>
                    <!-- <ul class="collection brdrtopsd">
                        <li class="collection-item  valign-wrapper">
                            <div class="left wid100"><span class="title truncate">Diabetes</span>

                            </div>
                            <div class="right new">
                                <div class="input-field chkbx new">
                                    <input type="checkbox" class="filled-in" id="chk" />
                                    <label for="chk"></label>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </li>
                    </ul>-->
                    <div class="fixed-action-btn hidetext spc">
                        <a href="{{ url('/patient') }}/add_medication"><span class="grey-text">Add Medication</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>
                    </div>
                    <div id="lifestyle" class="tab-content">
                        <div class="gray-strip">
                            <div class="bluedoc-text">
                                <strong>Lifestyle</strong> - Please Complete the below questions
                            </div>
                        </div>
                        <div class="row  pdrl" style="margin-top: 20px;">
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Physical Activities</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Food Habbits</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pdrl" style="margin-top: 20px;">
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Smoking</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Alcohol</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pdrl" style="margin-top: 20px;">
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Stress Levels</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <div class="input-field col s6 m6 l6 selct">
                                <select>
                                    <option value="" disabled selected>Average Sleep</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pdrl" style="margin-top: 20px;">
                            <div class="input-field col s12 m12 l12   setlabel">

                                <input type="text" id="reason" class="validate ">
                                <label for="reason" class="grey-text">Other</label>
                            </div>

                        </div>
                        <span class="right qusame marbtm mrgtht"><a href="{{ url('/patient') }}/history_completed#history" class="btn cart bluedoc-bg lnht round-corner">Save</a></span>
                        <div class="clr"></div>
                    </div>
                    <div class="tabs footer ">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab"><a href="#general" class="active"><span class="gen"><img src="{{url('/')}}/public/new/images/general.svg" alt="icon" class="tab-icon"/> </span> General </a></li>
                            <li class="tab">
                                <a href="#condition"> <span class=" condtn"><img src="{{url('/')}}/public/new/images/heartbeat.svg" alt="icon" class="tab-icon"/> </span> Conditions</a>
                            </li>
                            <li class="tab">
                                <a href="#medication-condition"> <span class="medica-i"><img src="{{url('/')}}/public/new/images/medication-icon-his.svg" alt="icon" class="tab-icon"/> </span>Medication</a>
                            </li>
                            <li class="tab">
                                <a href="#lifestyle"> <span class="lifes-i"><img src="{{url('/')}}/public/new/images/lifestyle-icon.svg" alt="icon" class="tab-icon" /> </span>Lifestyle</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <div id="document" class="tab-content">
                    <div class="gray-strip">
                        <div class="bluedoc-text">
                            April, 2017
                        </div>
                    </div>
                    <div class="pdrl">
                        <ul class="collection brdrtopsd marbt">
                            <li class="collection-item martb">
                                <div class="row">
                                    <div class="col l9 m9 s8">
                                        <div class="valign-wrapper pres">
                                            <img src="{{url('/')}}/public/new/images/rx-certi.png" />
                                            <a href="#">
                                                <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>
                                                <small>From Dr. Jonathan Smithonian</small>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col l3 m3 s4 right actionnew">
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item martb">
                                <div class="row">
                                    <div class="col l9 m9 s8">
                                        <div class="valign-wrapper pres">
                                            <img src="{{url('/')}}/public/new/images/rx-doc.png" />
                                            <a href="#">
                                                <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col l3 m3 s4 right actionnew">
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="collection-item martb">
                                <div class="row">
                                    <div class="col l9 m9 s8">
                                        <div class="valign-wrapper pres">
                                            <img src="{{url('/')}}/public/new/images/cer-doc.png" />
                                            <a href="#">
                                                <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col l3 m3 s4 right actionnew">
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                        <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <!--<ul class="collection brdrtopsd marbt">
                        <li class="collection-item">
                            <div class="row">
                                <div class="col l9 m9 s6">
                                    <div class="valign-wrapper pres">
                                        <img src="/new/images/rx-certi.png" />
                                        <a href="#" class="truncate">
                                            <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>
                                            <small>From Dr. Jonathan Smithonian</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s6 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="row">
                                <div class="col l9 m9 s6">
                                    <div class="valign-wrapper pres">
                                        <img src="/new/images/rx-doc.png" />
                                        <a href="#" class="truncate">
                                            <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>

                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s6 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="row">
                                <div class="col l9 m9 s6">
                                    <div class="valign-wrapper pres">
                                        <img src="/new/images/cer-doc.png" />
                                        <a href="#" class="truncate">
                                            <p class="bluedoc-text">Prescription 0033 - 12 Mar 2017</p>

                                        </a>
                                    </div>
                                </div>
                                <div class="col l3 m3 s6 right actionnew">
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">&#xE2C4;</i></a>
                                    <a href="#" class="circle btn-floating bluedoc-bg z-depth-1 right"><i class="material-icons">remove_red_eye</i></a>
                                </div>
                            </div>
                        </li>

                    </ul>-->
                    <!--<a class="waves-effect waves-light futbtn bluedoc-bg round-corner" href="#">continue to cart  (2)</a>-->
                </div>
                <div id="askdoctor" class="tab-content">
                    <ul class="collection brdrtopsd marbt">
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating green center-align large">&#63;</span>
                                <a href="{{ url('/patient') }}/my_question">
                                    <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                    <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                    <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                                </a>

                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating green center-align large">&#63;</span>
                                <a href="{{ url('/patient') }}/my_question">
                                    <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                    <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                    <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                                </a>

                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating green center-align large">&#63;</span>
                                <a href="{{ url('/patient') }}/my_question">
                                    <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                    <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                    <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                                </a>

                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating green center-align large">&#63;</span>
                                <a href="{{ url('/patient') }}/my_question">
                                    <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                    <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                    <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                                </a>

                            </div>
                        </li>
                        <li class="collection-item">
                            <div class="valign-wrapper quest">
                                <span class="circle btn-floating green center-align large">&#63;</span>
                                <a href="{{ url('/patient') }}/my_question">
                                    <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                    <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                    <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                                </a>

                            </div>
                        </li>
                    </ul>
                    <div class="fixed-action-btn spc hidetext">
                        <a href="{{ url('/patient') }}/question_for_free"><span class="grey-text">Ask a Question</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>
                    <div class="questiononline center-align bluedoc-text">Question not answered or unsatisfied? <a class="bluedoc-text" href="{{ url('/patient') }}/search_available_doctors">Talk to a Doctor online instead</a></div>
                </div>
                <!--Container End-->
            </div>
        </div>
        @endsection