 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

  <div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Family Doctor</h1>

    </div>
    <div class="medi">
        <div class="container posrel has-header" style="padding-bottom: 80px;!important">
            <ul class="collection brdrtopsd ">
                <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title"> Dr. Jonathan Smithonian</span></div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Details</a></li>
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Unlike Family Member</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title"> Dr. Jonathan Smithonian</span></div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown1' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown1' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Details</a></li>
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Unlike Family Member</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>

                <li class="collection-item avatar valign-wrapper">
                    <div class="image-avtar left"> <img src="{{url('/')}}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                    <div class="doc-detail wid90 left"><span class="title"> Dr. Jonathan Smithonian</span></div>
                    <div class="right posrel"> <a href="#" data-activates='dropdown2' class="dropdown-button"><i class="material-icons">&#xE5D4;</i></a></div>
                    <ul id='dropdown2' class='dropdown-content doc-rop rightless'>
                        <li><a href="#">View Details</a></li>
                        <li><a href="#">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Unlike Family Member</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
            </ul>
            <div class="clr"></div>
            <div class="fixed-action-btn hidetext">
            <a href="{{ url('/patient') }}/add_doctor"><span class="grey-text">Add a Doctor</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
            </a>

        </div>
        </div>
        <!--Container End-->
    </div>
    @endsection