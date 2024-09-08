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
                <li class="tab"><a class="active" href="#medication"><span><img src="{{url('/')}}/public/new/images/medication-icon.svg" alt="icon" class="tab-icon"/> </span> Medication </a></li>
                <li class="tab">
                    <a href="#history"> <span><img src="{{url('/')}}/public/new/images/medical-history.svg" alt="icon" class="tab-icon"/> </span> Medical History</a>
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
                    <a href="#test5" >PRESCRIPTION MEDICATION </a>
                </li>
                <li class="tab truncate">
                    <a href="#test6"  class="active">REGULAR MEDICATION</a>
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
                        <a href="{{url('/patient')}}/add_medication"><span class="grey-text">Add Medication</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>

                </div>

            </div>
        </div>

        <div class="container">

            <div id="history" class="tab-content medicationmain">

                <div class="form">
                    <div class="beforecomplete">
                        <p class="green-text">Your medical history is important for doctors to diagnose and treat you.</p>
                        <p class="bluedoc-text mr50">You can complete it: </p>
                        <ul>
                            <li class="bluedoc-text"> Before your first consultation (takes 2-3 minutes) </li>
                            <li class="bluedoc-text">During your first consultation (may be longer &amp; cost more)</li>
                        </ul>
                    </div>
                     <!--<div class="afercomplete center-align">
                        <img src="images/checkicon.svg" />
                        <p class="green-text center-align">History Completed!</p>
                    </div>-->
                    <div>
                        <p class="green-text nospc">There are 4 steps. select "Conditions" to begin.</p>
                        <a class="waves-effect waves-light btn cart notopspc bluedoc-bg round-corner" href="{{url('/patient')}}/my_health_conditions"><span class="left valign-wrapper truncate wid80"><img src="{{url('/')}}/public/new/images/heartbeat.svg" alt="icon" class="tab-icon" />  CONDITIONS</span> <i class="material-icons right">chevron_right</i></a>
                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner" href="{{url('/patient')}}/my_health_conditions"><span class="left valign-wrapper truncate wid80"><img src="{{url('/')}}/public/new/images/general.svg" alt="icon" class="tab-icon" />  GENERAL</span><i class="material-icons right">chevron_right</i></a>
                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner" href="{{url('/patient')}}/my_health_conditions"><span class="left valign-wrapper truncate wid80"><img src="{{url('/')}}/public/new/images/medication-icon-his.svg" alt="icon" class="tab-icon" />  MEDICATION</span><i class="material-icons right">chevron_right</i></a>
                        <a class="waves-effect waves-light btn cart  bluedoc-bg round-corner" href="{{url('/patient')}}/my_health_conditions"><span class="left valign-wrapper truncate wid80"><img src="{{url('/')}}/public/new/images/lifestyle-icon.svg" alt="icon" class="tab-icon" />  LIFESTYLE</span><i class="material-icons right">chevron_right</i></a>
                    </div>

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
                    <!--<a class="waves-effect waves-light futbtn bluedoc-bg round-corner" href="#">continue to cart  (2)</a>-->
                </div>
            <div id="askdoctor" class="tab-content  has-footer ">
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
                            <a href="{{ url('/patient') }}/my_question" >
                                <p class="bluedoc-text"><strong>Question:</strong> I have a really sore throat and sure what it is..</p>
                                <small class="bluedoc-text">Asked on: 25.03.2017</small>
                                <small class="bluedoc-text"><strong>Status: Unanswered</strong></small>
                            </a>

                        </div>
                    </li>
                </ul>
                 <div class="fixed-action-btn spc hidetext">
                        <a  href="{{url('/patient')}}/question_for_free"><span class="grey-text">Ask a Question</span>
                            <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
                        </a>

                    </div>
                
                <div class="clr"></div>
                <div class="questiononline center-align bluedoc-text">Question not answered or unsatisfied? <a class="bluedoc-text" href="{{url('/patient')}}/search_available_doctors">Talk to a Doctor online instead</a></div>
            </div>
            <!--Container End-->
        </div>
    </div>
    @endsection