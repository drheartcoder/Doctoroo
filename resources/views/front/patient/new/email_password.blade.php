 @extends('front.patient.new.layout._no_sidebar_master')
@section('main_content')

<div class="header ordermedHead z-depth-2 ">
        <div class="backarrow "><a href="{{url('/patient')}}/settings" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">Email &amp; Password</h1>
        <div class="savebtntop"><a class=" btn-flat">Save</a></div>
    </div>
    <div class="container posrel has-header minhtnor has-footer">
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="email" id="reason" class="validate" value="xyz@gmail.com" readonly>
                <label for="reason" class="grey-text truncate">Enter Email</label>
            </div>
        </div>
        <div class="row pdrl">
            <div class="input-field col s12 m12 l12  setlabel" style="margin-top: 40px;">
                <input type="password" id="reason" class="validate " value="sadasds" readonly>
                <label for="reason" class="grey-text truncate">Enter Password</label>
            </div>
        </div>
        <div class="fixed-action-btn hidetext">
            <a href="{{ url('/patient') }}/password_reset"><span class="grey-text">Reset Password</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">edit</i></div> 
            </a>

        </div>

    </div>

@endsection