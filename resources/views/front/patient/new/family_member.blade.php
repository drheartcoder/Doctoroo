@extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')
 <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Family Members</h1>

    </div>
    <div class="medi">
    <div class="container posrel has-header" style="padding-bottom: 80px;!important">
        <ul class="collection brdrtopsd ">
             <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        
                    </div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                <ul id='dropdown' class='dropdown-content doc-rop rightless'>
                    <li><a href="#">View Details</a></li>
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="{{ url('/patient') }}/family_member_unlink">Unlike Family Member</a></li>
                </ul>
                    <div class="clearfix"></div>
                </li>
            <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        
                    </div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown1' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                <ul id='dropdown1' class='dropdown-content doc-rop rightless'>
                    <li><a href="#">View Details</a></li>
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="{{ url('/patient') }}/family_member_unlink">Unlike Family Member</a></li>
                </ul>
                    <div class="clearfix"></div>
                </li>
            <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        
                    </div>
                    <div class=" right posrel"> <a href="#" data-activates='dropdown2' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                <ul id='dropdown2' class='dropdown-content doc-rop rightless'>
                    <li><a href="#">View Details</a></li>
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="{{ url('/patient') }}/family_member_unlink">Unlike Family Member</a></li>
                </ul>
                    <div class="clearfix"></div>
                </li>
            <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title truncate"> Dr. Jonathan Smithonian</span>
                        
                    </div>
                    <div class=" right posrel"> <a href="#" data-activates='dropdown3' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                <ul id='dropdown3' class='dropdown-content doc-rop rightless'>
                    <li><a href="#">View Details</a></li>
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="{{ url('/patient') }}/family_member_unlink">Unlike Family Member</a></li>
                </ul>
                    <div class="clearfix"></div>
                </li>

        </ul>
        <div class="clr"></div>
        <div class="fixed-action-btn hidetext">
            <a href="#addperson"><span class="grey-text">Add a person to your account</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
            </a>

        </div>
        <!--<div class="fixed-action-btn">
            <a class="btn-floating btn-large medblue" href="#addperson">
                <i class="large material-icons">add</i>
            </a>

        </div>-->
        <div id="addperson" class="modal modal-fixed-footer addperson">
        <div class="modal-content">
            <h4 class="center-align">Add someone to your account</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="firstname" type="text" class="validate">
                        <label for="firstname">First Name</label>
                    </div>
                </div>
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="lastname" type="text" class="validate">
                        <label for="lastname">Last Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6 l6">
                    <div class="input-field text-bx">
                        <input id="gender" type="text" class="validate">
                        <label for="gender">Gender</label>
                    </div>
                </div>
                <div class="col s6 l6">
                    <div class="input-field text-bx ">
                        <input id="datebirth" type="date" class="datepicker validate">
                        <label class="active" for="datebirth">Date of birth</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field ">
                        <input id="password" type="text" class="validate">
                        <label for="password">Your relationship to them e.g. Mother</label>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="modal-footer ">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left back">Cancel</a>
            <a href="#minor" class="modal-action waves-effect waves-green btn-cancel-cons right modal-close">Add Person</a>
        </div>
    </div>
        <div id="major" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Create a seperate account?</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12 m12"><strong>This person is above 18 years old and can legally see a doctor using their own independent account.</strong>
            <p class="green-text">What's the difference?</p>
            <p>Their own account enables them to use all features without your permission and you won't be notified of any of ther consultations or order and cannot access their account without their consent.</p>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left truncate">Seperate Account</a>
            <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons right truncate">Add to this account</a>
        </div>
    </div>
        <div id="minor" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">To Continue a parent or guardian is needed</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12 m12"><p>Good News - you can still see a doctor &amp; use all the features like all other users!</p>
            
            <p>Simply ask a parent or guardian to create account in their name (you can help them if needed), and they can add you as a family member - its's tha simple!</p>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons left truncate">Close</a>
            <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons right truncate">Sign up as Parent</a>
        </div>
    </div>
        <div id="unlink" class="modal requestbooking">
        <div class="modal-content">
            <h4 class="center-align">Successfully Sent!</h4>
            <a class="modal-close closeicon"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-data">
            <div class="row">
                <div class="col s12 l12 m12">
            <p>An email will be sent to the email address you entered</p>
                    <p>Once confirmed by the recipient, their details will moved to their new, independent account and you will no longer be able to access their details.</p>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            
           <div class="modal-footer center-align ">
                <a href="{{ url('/patient') }}/family_member" class="modal-action waves-effect waves-green btn-cancel-cons">OK</a>
            </div>
        </div>
    </div>
    </div>
    <!--Container End-->
</div>
@endsection