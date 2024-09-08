@extends('front.layout.master-coming-soon')                
@section('main_content')
<link rel="stylesheet" href="{{ url('/') }}/public/css/w3table.css">
<style>
.main-list
{
  padding-left: 20px;
}
.first-list
{
  list-style-type: disc;
}
.child-list
{
  list-style-type: circle;
}
</style>

<div class="banner-home inner-page-box" style="background: transparent url('{{ url('/') }}/public/images/header-top.jpg'); background-repeat:no-repeat;
   -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;background-attachment: fixed; background-position: center center;">
   <div class="bg-shaad inner-page-shaad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="banner-home-box">
                  <h1> {{ $page_title or ''}}</h1>
                  <div class="bor-light">&nbsp;</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--contact us section start here-->       
<div class="about-us-section">
   <div class="">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
               <div class="app-information-section wow fadeInRight" data-wow-delay="0.8s" style="max-width:none; margin-bottom:65px; visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                  <div class="our-mission">
                     <p class="fi-p">
                     <div class="what-doc-section online-medicl-certi" style="padding:0px;">
                        <div class="container">
                           <h4 class="daynamic-heading"></h4>
                           <div class="panel-group wow fadeInDown" id="accordion">

                              <div class="panel-default" style="margin-top: -50px;">
                                 <div id="collapseOne0" class="panel-collapse collapse in">
                                    <div class="panel-body" style="color: #082c46; font-family: 'robotolight',sans-serif; font-size: 17px; line-height: 30px;">
                                    <h3>Welcome to the future of healthcare</h3>
                                    Getting started is simple:
                                      <ul>
                                        <li>1. Complete your registration</li>
                                        <li>2. Upload the required documentation (see below)</li>
                                        <li>3. Begin accepting patients once you’ve been approved by the doctoroo team</p></li>
                                      </ul>
                                    </p></div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">What is the purpose of doctoroo?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne1" class="panel-collapse collapse in">
                                    <div class="panel-body">Our official motto is simple - Taking care of you, whether it be patients, doctors or pharmacies. How we do that has been our main focus since the beginning of 2016. Unlike other restricted telemedicine platforms that only allow a few GP’s to see patients from across the country - this would eventually destabilise doctor-patient relationships and seriously damage the health industry as we know it today. To combat this, doctoroo empowers every doctor across Australia to be able to see their own patients online and provide them with the care they would normally receive in person. In doing so, our platform works complementary to and in unison with existing, traditional patient care.</div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">What information is required to complete my registration?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      In order to comply with regulations of telehealth in Australia, we’re required to verify your identity, medical registration and insurance documentation. We’ll require the following:
                                      <ul class="main-list">
                                        <li class="first-list">Information about you (name, gender, DOB, citizenship, email, phone, address, photo & 30 second video)</li>
                                        <li class="first-list">Medical practice details (clinic name, address, contact details)</li>
                                        <li class="first-list">Qualifications (medical qualification, country obtained, years’ experience, consulting languages etc)</li>
                                        <li class="first-list">Bank account details</li>
                                        <li class="first-list">Documentation
                                          <ul class="main-list">
                                            <li class="child-list">Photo/scan of Drivers licence or Australian passport</li>
                                            <li class="child-list">Photo/scan of Medical registration certificate & number</li>
                                            <li class="child-list">Prescriber number</li>
                                            <li class="child-list">AHPRA registration number</li>
                                            <li class="child-list">ABN</li>
                                            <li class="child-list">Photo/scan of Insurance policy cover - Professional Indemnity (+ Telehealth) & Cyber Liability Insurance</li>
                                          </ul>
                                        </li>
                                      </ul>
                                      <br/>
                                      All the above documents that you upload will need to be certified by a referee as a true copy of the original prior to uploading. For more details about certifying documents, <a href="https://www.ahpra.gov.au/Registration/Registration-Process/Certifying-Documents.aspx" target="_blank">please visit here.</a>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne3">Are there any special requirements for becoming a member?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Looking after the health of Australian patients, and proactively managing health issues is paramount. In order to do so, whilst complying with regulations of telehealth in Australia, we have a stringent assessment and selection process and we require our doctor applicants to demonstrate the following:
                                      <ul class="main-list">
                                        <li class="first-list">Fluency in other languages are a bonus</li>
                                        <li class="first-list">Commitment to best practice, ethical behaviour and currently practicing medicine in Australia</li>
                                        <li class="first-list">A minimum of two years of GP experience (preferred)</li>
                                        <li class="first-list">Excellent computer literacy and reliable availability of a computer or tablet and secure internet connection</li>
                                        <li class="first-list">Excellent verbal and written communication skills in English</li>
                                        <li class="first-list">Keen interest in telemedicine</li>
                                      </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne4">How can I access doctoroo?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      You can access doctoroo using almost any device (phones, tablets or computers) by simply visiting our website <a href="https://doctoroo.com.au/doctor" target="_blank">( https://doctoroo.com.au/doctor )</a> and logging in as a doctor. We’re also working on delivering mobile apps for our users in the near future
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne5">What is my legal relationship with doctoroo?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Being a technology platform which facilitates your consultations with your patients, our legal relationship meets the Australian Taxation Office's definition of a contractor, whereby:
                                      <ul class="main-list">
                                        <li class="first-list">You’ll use your own tools and equipment to practice medicine online and access our platform</li>
                                        <li class="first-list">You’ll have a high level of control in how you provide your services</li>
                                        <li class="first-list">You’ll decide what hours and where to work</li>
                                        <li class="first-list">With your own Liability Insurance, you’re responsible and liable for all the services that you provide</li>
                                        <li class="first-list">You’ll have an ABN and be responsible for your superannuation, Tax and GST</li>
                                      </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne6">What are my responsibilities on the platform?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne6" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <ul class="main-list">
                                        <li class="first-list">Setting availability times in your calendar as required</li>
                                        <li class="first-list">Respond to patient consultation requests in a timely manner</li>
                                        <li class="first-list">Conduct online consultation with patients</li>
                                        <li class="first-list">Conduct these consultations in a private and quiet room and ensure no one can listen to or see the consultation</li>
                                        <li class="first-list">Have a secure and reliable internet, computer or tablet, camera and microphone (usually built into device), although we recommend a headset for audio</li>
                                        <li class="first-list">If you see fit, provide a medical certificate, referral, prescription or other required documents or services to the patient</li>
                                        <li class="first-list">Ensure timeframes and schedules are adhered to</li>
                                        <li class="first-list">Comply with privacy and confidentiality principles to all work practices including doctoroo policies and procedures</li>
                                        <li class="first-list">Comply with all AMA regulations and relevant laws</li>
                                      </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne7">Can I see my own patients?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne7" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Absolutely - it is one of the main original features of the website - being able to provide continuity of care for your patients, in order to provide them convenience and to also avoid them seeing unrelated doctors online. You may also utilise our marketing efforts to gain external patients from across the country. You also have the option of selecting whichever patients you would like to see.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne8">How long do consultations last?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne8" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      The maximum duration for a consultation is currently 15 minutes. You or the patient can end the call at anytime.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne9">Are the consultations covered by Medicare?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne9" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Currently, all telemedicine consultations on our platform are privately billed to the patient. These may become bulk-billed in the future with updates from the government, which we are actively participated in lobbying.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne10">What are my earnings per consultation?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne10" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      We highly value our doctors, their impact on society and their valuable time. We offer doctors a guaranteed earning for every minute spent during a consultation, reflecting our value on every moment of your time.<br/>
                                      <br/>
                                      Your earnings depend on the membership option you select:
                                      <ul class="main-list">
                                        <li class="first-list">Standard – your minutely earnings are as set out below</li>
                                        <li class="first-list">Premium – you may set your own rate per consultation</li>
                                      </ul>
                                      <br/>
                                      <span style="text-decoration: underline; font-weight: 900;">Standard membership earnings</span>
                                      <style>
                                        /*th{ text-align: center; padding: 5px 10px; }*/
                                      </style>
                                      <table class="w3-table-all" >
                                        <tbody>
                                          <tr>
                                            <th>Time <br/>(min)</th>
                                            <th>Day <br/>(8am-8pm)</th>
                                            <th>Day Hourly rate <br/>(pro-rata)</th>
                                            <th>Night <br/>(8pm-8am)</th>
                                            <th>Night Hourly rate <br/>(pro-rata)</th>
                                          </tr>
                                          @if(isset($doc_consult) && !empty($doc_consult))
                                            @foreach($doc_consult as $cons_data)
                                            <tr>
                                              <td>{{ $cons_data['time'] }}</td>
                                              <td>{{ $cons_data['day'] }}</td>
                                              <td>{{ $cons_data['day_hourly_rate'] }}</td>
                                              <td>{{ $cons_data['night'] }}</td>
                                              <td>{{ $cons_data['night_hourly_rate'] }}</td>
                                            </tr>
                                            @endforeach
                                          @endif
                                        </tbody>
                                      </table>
                                      <br/>
                                      <span style="text-decoration: underline; font-weight: 900;">Comparison to traditional in-person consultations</span> <br/>
                                      Data from Bettering the Evaluation and Care of Health (BEACH 2008–2009) show average consultation times in Australian general practice are 14.6 minutes. This equates to seeing an average of approximately 4-5 patients per hour Average telemedicine consultations are approximately 7 minutes, and with the above earnings table, this equates to an hourly rate of $197 - $266 (pro-rata) depending on time of consultation. <br/>
                                      <br/>
                                      <span style="text-decoration: underline; font-weight: 900;">Premium membership earnings </span><br/>
                                      You may set your own rate per consultation.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne11">How do I receive my earnings?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne11" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Your consultations on doctoroo are privately billed to your patients. Our highly efficient payment process means you’ll have instant settlements of your earnings directly into your bank account. These are managed through our secure payment gateway which we’ll help you set up an account with in minutes. You’ll also be able to view all your invoices regarding your consultations within your account, and set how often you’d like to receive bank transfers.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne12">What are the membership fees?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne12" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    Our standard membership provides you with our entire platform, absolutely free for you to use. You’ll enjoy the following features:
                                    <ul class="main-list">
                                      <li class="first-list">Select your own availability</li>
                                      <li class="first-list">Work anywhere in australia</li>
                                      <li class="first-list">See your existing patients online</li>
                                      <li class="first-list">See new patients Australia-wide</li>
                                      <li class="first-list">Use the entire platform with no limits</li>
                                      <li class="first-list">Unlimited consultations</li>
                                      <li class="first-list">100% free - no monthly fee</li>
                                      <li class="first-list">Your earnings will be as per the standard pricing table above</li>
                                    </ul>
                                    <br/>
                                    If you wish to set your own custom consultation day & night rates, our flexible premium membership allows you to do so, at a nominal membership fee of $59/month.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne13">Are there long term commitments?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne13" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Part of our approach to telemedicine is giving our doctors freedom in how they practice. We understand circumstances change and you may decide to cancel your membership. There are no cancellation fees for monthly memberships - you’re free to cancel your account anytime as long as there are no pending consultations. For longer term memberships, there are no cancellation fees either, but our no refund policy applies.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne14">How much does it cost a patient to see a doctor?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne14" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      The cost to the patient depends on the doctor's rates. According to the 2 pricing memberships available for doctors, patients
                                      <br/>
                                      <span style="text-decoration: underline; font-weight: 900;">Standard Pricing</span> <br/>
                                      In order to keep doctoroo an affordable option for Australian patients, allowing more patients to use the platform, we’ve offered a standard pricing model as below:
                                      <table class="w3-table-all" >
                                        <tbody>
                                          <tr>
                                            <th>Consultation Time <br/>(minutes) </th>
                                            <th>Day Cost </th>
                                            <th>Night Cost</th>
                                          </tr>
                                          @if(isset($patient_consult) && !empty($patient_consult))
                                            @foreach($patient_consult as $patient_data)

                                              <?php
                                                $start  = substr($patient_data['consultation_time_from'], 0, strpos($patient_data['consultation_time_from'], ':'));
                                                $end    = substr($patient_data['consultation_time_to'], 0, strpos($patient_data['consultation_time_to'], ':'));

                                                if($start == 00)
                                                {
                                                  $start = 0;
                                                }
                                              ?>

                                              <tr>
                                                <td>{{ $start.' - '.$end }}</td>
                                                <td>${{ $patient_data['patient_day_cost'] }}</td>
                                                <td>${{ $patient_data['patient_night_cost'] }}</td>
                                              </tr>
                                            @endforeach
                                          @endif
                                        </tbody>
                                      </table>
                                      <br/>
                                      This is priced in such a way as to be an affordable option for patients to get in touch with a doctor. The 4-minute session model was architectured to ensure that patients only pay for the time the doctor has given them i.e. avoiding paying $49 for a full 15-minute consultation that may only last 4-7 minutes is highly unfair and part of the reason why Medicare is continually being seen as unsustainable and the previously long-held Medicare rebate freeze for doctors and the future potential of a Medicare co-payment for patients.<br/>
                                      <br/>
                                      <span style="text-decoration: underline; font-weight: 900;">Premium Pricing</span> <br/>
                                      Whatever doctor charges
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne15">How does doctoroo attract patients?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne15" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      We’re passionate about bringing our platform to every Australian so they have access to healthcare at their fingertips. We do this via:
                                      <ul class="main-list">
                                        <li class="first-list">Online marketing</li>
                                        <li class="first-list">Social media advertising</li>
                                        <li class="first-list">Print and traditional marketing</li>
                                        <li class="first-list">Paid advertising</li>
                                        <li class="first-list">Pharmacy & industry partners</li>
                                        <li class="first-list">Corporate referrals</li>
                                        <li class="first-list">Public Relations</li>
                                        <li class="first-list">Referral incentives</li>
                                      </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne16">Where can I practice?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne16" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      You are able to access the platform, accept patients and conduct consultations anywhere in australia along with the requirements mentioned earlier.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne17">Are there minimal time commitments?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne17" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Not at all - you have the freedom of seeing patients anytime, 24/7, with absolute flexibility to the number of hours you work, and the day and time that you work.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne18">How do i accept patients?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne18" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      By simply logging in and selecting “available now” – you will instantly be shown to patients who are currently searching for a doctor across Australia.<br/>
                                      If you know future days you’ll be available to accept patients, you can simply add your availability day/s and time blocks (e.g. Monday 2pm - 7pm) in your calendar and you’ll be shown to patients when they search for a doctor during those times.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne19">Can I, or the patient, record a consultation?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne19" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      We have a strict no-recording policy of consultations. However, in some rare cases that a consultation may need to be recorded and both parties agree to this, both parties (doctor and patient) will need to send a written confirmation to each other in order to seek permission to record the consultation.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne20">Does doctoroo integrate with my medical software?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne20" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      That’s one of the main features we’re currently working on implementing – soon enough, you’ll be able to sync your patient’s data from your medical software directly to the doctoroo platform. Currently, the patient can enter/update all their medical records, and you’ll be able to securely upload a scanned prescription, medical certificate or any other document for the patient to access. We also have a very handy medical certificate generator that allows you to create and send a medical certificate in less than 10 seconds to the patient.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne21">How does doctoroo uphold Australian Medical regulations?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne21" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Our mission is about providing a long-term solution for practitioners and their patients and we understand that to do this, we must meet all regulations and also be a voice for the wider telehealth community when actively participating in discussions around the topic of best telemedicine adoption practices.<br/>
                                      <br/>
                                      As distinguishable from some other telemedicine providers, we do not support the questionable service of providing prescriptions to patients by simply completing questionnaire, all without the patient actually seeing the doctor at all. This is a highly controversial practice we are heavily opposed to and that has come into question from the AMA. Our platform addresses this effectively by allowing the patient to see their own GP online as they otherwise would in person, and if their GP has not yet registered, they are able to invite them, whilst seeing an available GP until then.<br/>
                                      <br/>
                                      Our platform meets all regulations as set out by AHPRA and the AMA and general privacy laws in Australia.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne22">What is the efficacy of telehealth?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne22" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      The expansion of telehealth approaches over the past decade has resulted in greater accessibility to health services and improved health outcomes, especially for people living in rural and remote locations. This has been the focus of numerous studies which have highlighted the benefits of telehealth approaches for the broader health system, some of which are accessible via: <br/><a href="https://www.doctoroo.com.au/blogs/efficacy-of-telehealth-in-australia" target="_blank">https://www.doctoroo.com.au/blogs/efficacy-of-telehealth-in-australia</a>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne23">How secure is the platform?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne23" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Although no one can guarantee the security of the internet, we’ve designed our entire platform with security as one of our top priorities. In order to achieve a secure platform, we’ve taken serious approaches in terms of not only meeting industry standards, but exceeding these standards in many instances. Ways in which we ensure security of your, and patients information include:
                                      <ul class="main-list">
                                        <li class="first-list">All data is hosted on a very secure Australian-based server which is subject to Australian privacy laws</li>
                                        <li class="first-list">256 Bit encrypted EV SSL certificate (offers encryption of data transferred via the platform)</li>
                                        <li class="first-list">End-to-end encryption of video consultations from your device directly to patient’s device – no one can listen in or see your consultation beside you and the patient at the other end</li>
                                        <li class="first-list">We have a strict no-recording policy for all consultations (this policy applies to doctors and patients)</li>
                                        <li class="first-list">Our internal governance is very strict with confidentiality agreements with all doctoroo employees, directors and partners. Only selected people with clearance are able to access the platform's backend.</li>
                                      </ul>
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne24">Does doctoroo provide training to use the platform?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne24" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Our very user-friendly and simple to use page layouts mean that learning to use the platform is very straightforward. We also have a very flexible training program that covers any questions you may have about the usability of the platform that is conducted on the phone at your convenience. We’ll even have a few sample demonstrations together before you go live on the platform.
                                    </div>
                                 </div>
                              </div>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne25">When can I start using the platform?</a>
                                    </h4>
                                 </div>
                                 <div id="collapseOne25" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      Development of the platform is almost complete and launch will be within the coming months. We will be conducting a trial of the platform between a select number of GP’s and our pool of private patients. If you are interested in joining our beta-testing program, please express your interest via email to <a href="mailto:wecare@doctoroo.com.au" target="_top">wecare@doctoroo.com.au</a>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--contact us section end here-->           
<!--footer-->
@stop