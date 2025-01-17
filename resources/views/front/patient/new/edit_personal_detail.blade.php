 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

  <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="settings.html" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Personal Details</h1>

    </div>
    <div class="container posrel has-header has-footer">
        <div class="fieldspres ">
            <h3 class="sethead">About you</h3>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar">

                    <input type="text" id="reason" class="validate" value="Jonathan">
                    <label for="reason" class="grey-text truncate">First Name</label>
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar">

                    <input type="text" id="reason" class="validate" value="Simonthanian">
                    <label for="reason" class="grey-text truncate">Last Name</label>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6 selct">
                    <select>
                        <option value="" disabled >Gender</option>
                        <option value="m" selected>Male</option>
                        <option value="f">Female</option>
                    </select>
                </div>
                <div class="input-field col s6 m6 l6 text-bx lessmar" >
                    <input id="datebirth" type="date" class="datepicker ht45 validate" value="">
                    <label class="active grey-text truncate" for="datebirth">Date of birth</label>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s6 m6 l6  text-bx lessmar">
                    <input type="text" id="reason" class="validate" value="9876543210">
                    <label for="reason" class="grey-text truncate">Contact No.</label>
                </div>
                <div class="input-field col s6 m6 l6  text-bx lessmar">
                    <input type="text" id="reason" class="validate" value="9876543210">
                    <label for="reason" class="grey-text truncate">Mobile No.</label>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s12 m12 l12  text-bx lessmar">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1" class="grey-text truncate">Address</label>
                </div>
            </div>


            <!-- <div class="divider mrmintb"></div>-->

            <div class="otherdetails">
                <h3 class="sethead">Entitlement</h3>
                <div class="row" style="margin-top: 20px;">
                    <div class="input-field col s6 m6 l6 selct">
                        <select>
                            <option value="" disabled selected>Select Entitlement</option>
                            <option value="option1">option1</option>
                            <option value="option2">option2</option>
                        </select>
                    </div>
                    <div class="input-field col s6 m6 l6  text-bx lessmar">
                        <input type="text" id="reason" class="validate " value="2947 3247 3893">
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
            
             <span class="right qusame rescahnge"><a href="personal-details.html" class="btn cart bluedoc-bg lnht round-corner">SAVE</a></span>
        
        <span class="left qusame rescahnge"><a class="border-btn round-corner  center-align" href="{{url('/patient')}}/personal_details">CANCEL</a></span>
            <div class="clr"></div>
        </div>
       
    </div>
    <!--Container End-->
    @endsection