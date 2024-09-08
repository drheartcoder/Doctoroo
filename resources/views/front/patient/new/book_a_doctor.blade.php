@extends('front.patient.new.layout._dashboard_master')
@section('main_content')


    <div class="header bookhead z-depth-2 ">
        <div class="menuBtn"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <div class="backarrow"><a href="{{ url('/patient') }}/my_consulations_1" class="center-align"><i class="material-icons">&#xE5CB;</i></a></div>
        <h1 class="main-title center-align">BOOK A DOCTOR</h1>
    </div>

    <!-- SideBar Section -->
	@include('front.patient.new.layout._sidebar')


    <div class="mar300  has-header has-footer">
        <div class="container paddingtpbtm">
            <form>
                <div class="doctorForm">

                    <div class="input-field col s12 selct">
                        <select>
                            <option value="" disabled selected>Who is Seeing the doctor?</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                    <div class="input-field col s12 radio">
                        <p class="headelement">Why do you want to see the doctor?
                            <ul class="collection bookdoc brdrtopsd">
                                <li class="collection-item  ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in " id="check2" checked="checked" />
                                        <label for="check2" class="bluedoc-text">Advice &amp; Treatment</label>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                                <li class="collection-item ">
                                    <div class="chkbx new ">
                                        <input type="checkbox" class="filled-in " id="check3" checked="checked" />
                                        <label for="check3" class="bluedoc-text">Prescriptions &amp; Repeats</label>                                       
                                    </div>
                                    <div class="clear"></div>
                                </li>
                                <li class="collection-item ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in " id="check4" checked="checked" />
                                        <label for="check4" class="bluedoc-text">Medical Cetificate</label>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                                <li class="collection-item ">
                                    <div class="chkbx new">
                                        <input type="checkbox" class="filled-in " id="check5" checked="checked" />
                                        <label for="check5" class="bluedoc-text">Other</label>
                                    </div>

                                    <div class="clear"></div>
                                </li>
                            </ul>
                    </div>

                    <div class="input-field col s12 text-bx">

                        <input type="text" id="reason" class="validate">
                        <label for="reason" data-error="wrong" data-success="right">Enter your symptoms or reason for call</label>
                    </div>

                </div>
                <div class="divider"></div>
                <div class="input-field col s12 uploadImg">
                    <div class="file-field input-field">
                        
                        <div class="btn">
                            <span><i class="material-icons">camera_alt</i></span>
                            <input type="file" multiple>

                        </div><span class="textside">Optional - Upload photo of affected area.</span>

                    </div>
                    <div class="clr"></div>
                </div>
                <div class="divider"></div>
                <div class="input-field col s12 chkbx">
                    <input type="checkbox" class="filled-in" id="chk" checked/>
                    <label for="chk"></label><span>This is an emergency or <a href="{{ url('/patient') }}/emergencies_warning" > any of these</a></span>
                    <div class="clr"></div>
                </div>
            </form>
            
        </div>
        <a class="waves-effect waves-light futbtn" href="{{ url('/patient') }}/search_available_doctors">Next</a>
    </div>

@endsection