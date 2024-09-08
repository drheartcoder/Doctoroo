<!-- Pricing Details Modal -->
<div id="pricing_details" class="modal requestbooking fade big-modal" tabindex="-1" data-replace="true" data-toggle="modal" data-dismiss="modal" style="display: none; max-width: 1000px; top: 20%;">
    <div class="model-wraper2">
        <div class="modal-content">
            <h4 class="center-align">Pricing Details</h4>
            <a class="modal-close closeicon">
                <i class="material-icons">close</i>
            </a>
        </div>
        <div class="modal-data scroll-div">
            <div class="pricescetion">
                <h3 class="ques">How much does it cost to see a doctor?</h3>
                <div class="row">
                    <div id="test1" class="col s12 padno">
                        <table class="bordered striped">
                            <thead>
                                <tr style="background: #22b14c;">
                                    <th class="center-align">Call Length</th>
                                    <th class="center-align">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($doctor_pricing_fees) && !empty($doctor_pricing_fees))
                            @foreach($doctor_pricing_fees as $fees)
                                <tr>
                                    <td class="center-align">Up to 4 mins</td>
                                    <td class="center-align">${{ $fees['total_patient_fee_for_four_min'] }}</td>
                                </tr>
                                <tr>
                                    <td class="center-align">Additional minutes</td>
                                    <td class="center-align">${{ $fees['total_patient_fee_of_additional_afer_four_min'] }}</td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <h3 class="ques">Please Note:</h3>
                <ul class="pointsQues">
                    <li>There are no time limits</li>
                    <li>You can see length</li>
                    <li>You can end the call anytime</li>
                    <li>Your documents will be ready for download after the call</li>
                </ul>
                <div class="data-content martpq">
                    <ul class="collapsible" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header waves-effect waves-light">Reschedule or cancel
                                <i class="material-icons right">expand_more</i>
                            </div>
                            <div class="collapsible-body">
                                <p>you can cancel anytime before the doctor confirms your booking(you won't be charged until the doctor confirms)</p>
                                <p>Exception - if doctor has confirmed, and theres more than 1 hour left until consultation, you can cancel &amp; get refund</p>
                                <p>if there's less than 1 hour. you won't get a refund as the doctor may have missed on an oportunity to treat another patient in that timeslot which they had assigned to you.</p>

                                <p class="view-policy"><a href="#cancellation_refunds" data-toggle="modal" > View refund policy</a></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer center-align">
            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-cancel-cons full-width-btn">Ok</a>
        </div>
    </div>
</div>

@include('front.patient.booking.cancellation_refunds')
