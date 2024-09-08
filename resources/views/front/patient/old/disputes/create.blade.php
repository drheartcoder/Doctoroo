@extends('front.patient.layout._after_patient_login_master')                
@section('main_content')
<style>
  span.star{ color:red; }
</style>
<!--calender section start-->    
<div class="container">
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="middle-section">
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="doc-dash-right-bx pad-both">
                     <div class="cer-text">
                        Unfortunately your had some issues when payment.<br/>
                        It may just be a simple mistake, in which case a refund will be immediacy proceed.
                        whatever the case, please provide as much detail about your dispute, and we'll be in contract to resolve it as soon as possible. 
                     </div>
                     <br/>
                     <form method="post" id="frm_dispute" action="{{url('/')}}/patient/store_dispute">
                     {{csrf_field()}}
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="pop-lable">Payment Reason <span class="star">*</span></div>
                              <div class="select-style select-width">
                                 <select class="frm-select" name="payment_reason" id="payment_reason">
                                    <option value="">- Select Payment Reason -</option>
                                    <option value="Doctor consultation fee">Doctor consultation fee</option>
                                    <option value="Pharmacy orders">Pharmacy orders</option>
                                 </select>
                               </div>
                              <div class="err" id="err_payment_reason"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="hidden-xs hidden-sm pop-lable">&nbsp;</div>
                              <div class="cer-text" style="margin-top: 12px;">
                                 Doctor Consultation Fee, Pharmacy Order
                              </div>
                             </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="pop-lable">Select Payment <span class="star">*</span></div>
                              <div class="select-style select-width">
                                 <select class="frm-select" name="select_payment" id="select_payment">
                                    <option value="">- Select Payment -</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Credit Card">Credit Card</option>
                                 </select>
                              </div>
                              <div class="err" id="err_select_payment"></div>
                           </div>
                        </div>
                        <div class="hidden-xs hidden-sm col-sm-12 col-md-6 col-lg-6">
                           <div class="user_box">
                              <div class="pop-lable">&nbsp;</div>
                              <div class="cer-text">
                                 &nbsp;
                              </div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                           <div class="user_box">
                              <div class="pop-lable">What is the issue? (Provide as much detail as possible) <span class="star">*</span></div>
                              <textarea cols="" rows="" name="what_is_issue" id="what_is_issue" class="form-inputs" style="padding-top:10px;height:119px;"></textarea>
                               <div class="err" id="err_what_is_issue"></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                           <div class="user_box">
                              <div class="pop-lable">What solution would you like? <span class="star">*</span></div>
                              <textarea cols="" rows="" name="what_solution_you_like" id="what_solution_you_like" class="form-inputs" style="padding-top:10px;height:119px;"></textarea>
                              <div class="err" id="err_what_solution_you_like"></div>
                           </div>
                        </div>
                        <div class="hidden-sm col-sm-12 col-md-6 col-lg-9">
                           &nbsp;
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                           <button class="btn-grn pull-right" type="button" name="btn_dispute" id="btn_dispute" onclick="disputeValidation()">Submit Dispute</button>
                        </div>
                     </div>
                    </form> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--calender section end-->
@stop