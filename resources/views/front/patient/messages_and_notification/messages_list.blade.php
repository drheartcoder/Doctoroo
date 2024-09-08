@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <div class="header bookhead ">
        <div class="menuBtn hide-on-large-only"><a href="#" data-activates="slide-out" class="button-collapse menu-icon center-align"><i class="material-icons">menu</i> </a></div>
        <h1 class="main-title center-align">Messages</h1>
        <div class="fix-add-btn">
            <a href="javascript:void(0)"><span class="grey-text">New Message</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
            </a>
        </div>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 posrel has-header has-footer">

        <div class="container posrel futspace">
            <ul class="collection brdrtopsd messageslist">
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="my-messages.html">
                        <div class="image-avtar left"><img src="{{ url('/') }}/public/new/images/avtar_messages.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{ url('/') }}/public/new/images/doctor-icon-small.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right"> <span class="badge circle">1</span></div>

                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="my-messages.html">
                        <div class="image-avtar left"><img src="{{ url('/') }}/public/new/images/avtar_messages1.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{ url('/') }}/public/new/images/telemarketer.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right "> <span class="badge circle right">5</span></div>

                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="collection-item avatar">
                    <a class="valign-wrapper" href="my-messages.html">
                        <div class="image-avtar left"><img src="{{ url('/') }}/public/new/images/avtar_messages2.png" alt="" class="circle" /></div>
                        <div class="doc-detail  left"><span class="title "><img src="{{ url('/') }}/public/new/images/online-store.svg" class="docicon" /> Dr. Jonathan Smithonian</span>
                            <p class="text-greyblue"> Abore et dolore magna aliqua</p>
                        </div>
                        <div class="doc-action right right-align"> 28 Apr, <span>10.20pm</div>

                        <div class="clearfix"></div>
                    </a>
                </li>

            </ul>

        </div>
        <!-- <div class="fixed-action-btn hidetext">
            <a href="javascript:void(0)"><span class="grey-text">New Message</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div>
            </a>
        </div> -->
    </div>

    <!-- Modal Reschedule -->
    <div id="resechdule" class="modal resechdule">
        <div class="modal-content">
            <h4>Reschedule Consultation</h4>
        </div>
        <p>Are you sure you want to resechdule this consultation?</p>
        <p>You will need to repay a new booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Reschedule End -->
    
    <!-- Modal Cancel Consultation -->
    <div id="cancel-consult" class="modal cancel-consult">
        <div class="modal-content">
            <h4>Cancel Consultation</h4>
        </div>
        <p>Are you sure you want to cancel this consultation?</p>
        <p>You will/won't be refunded the booking fee.</p>
        <p class="view-policy"><a href="cancellation-refunds.html"> View refund policy</a></p>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-cancel-cons">Cancel</a>
            <a href="#!" class="modal-action waves-effect waves-green btn-cancel-cons">Yes</a>
        </div>
    </div>
    <!-- Modal Structure End -->

@endsection