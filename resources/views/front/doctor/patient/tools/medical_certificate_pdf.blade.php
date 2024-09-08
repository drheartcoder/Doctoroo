<!-- <h1 class="center_align">Medical Certificate</h1> -->
@php
  $doc_title        = isset($doctor_data['userinfo']['title'])?$doctor_data['userinfo']['title']:'';
  $doc_first        = isset($doctor_data['userinfo']['first_name'])?$doctor_data['userinfo']['first_name']:'';
  $doc_last         = isset($doctor_data['userinfo']['last_name'])?$doctor_data['userinfo']['last_name']:'';
  $doc_address      = isset($doctor_data['dec_address'])?$doctor_data['dec_address']:'';
  $doc_contact_no   = isset($doctor_data['dec_contact_no'])?$doctor_data['dec_contact_no']:'';
  $doc_provider_no  = isset($doctor_data['dec_medicare_provider_no'])?$doctor_data['dec_medicare_provider_no']:'';

  $current_date     = isset($current_date)?$current_date:'';
@endphp

@if(isset($patient_data) && !empty($patient_data))
  @php
    $pat_title      = isset($patient_data['userinfo']['title'])?$patient_data['userinfo']['title']:'';
    $pat_first      = isset($patient_data['userinfo']['first_name'])?$patient_data['userinfo']['first_name']:'';
    $pat_last       = isset($patient_data['userinfo']['last_name'])?$patient_data['userinfo']['last_name']:'';
  @endphp
@elseif(isset($family_data) && !empty($family_data))
  @php
    $pat_title      = '';
    $pat_first      = isset($family_data['first_name'])?$family_data['first_name']:'';
    $pat_last       = isset($family_data['last_name'])?$family_data['last_name']:'';
  @endphp
@endif

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 630px; font-size:11pt; font-family:Arial, Helvetica, sans-serif; line-height:16pt; color:#333; text-align:justify;">
    <tr>
      <td>
         <h1 style="margin:0; padding: 0; text-align: center; font-size: 33px; font-weight: bolder; font-family: 'Arial';">Medical Certificate</h1>
      </td>
   </tr>
   <tr>
      <td>
      </td>
   </tr>
   <tr>
      <td>
         <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
               <td style="text-align: left; padding:0 10px;">{{ $doc_title.' '.$doc_first.' '.$doc_last }}</td>
            </tr>
            <tr>
               <td height="15px" style="padding:0 10px;"></td>
            </tr>
            <tr>
               <td align="left" style="text-align: left; padding:0 10px;"> {{ $doc_address }}
                  <br> Phone : {{ $doc_contact_no }}
                  <br> Provider Number : {{ $doc_provider_no }} 
               </td>
            </tr>
            <tr>
               <td height="15px" style="padding:0 10px;"></td>
            </tr>
            <tr>
               <td align="right" style="text-align: right;">Date: {{ $current_date }}</td>
            </tr>
            <tr>
               <td height="15px" style="padding:0 10px;"></td>
            </tr>
            <tr>
               <td style="text-align: left; padding:0 10px;">
                  I, {{ $doc_title.' '.$doc_first.' '.$doc_last }}, after careful examination on {{ $current_date }}, hereby certify that {{ $pat_title.' '.$pat_first.' '.$pat_last }} is suffering from {{ $reason_for_absent }}.
               </td>
            </tr>
            <tr>
               <td height="15px" style="padding:0 10px;"></td>
            </tr>
            <tr>
               <td style="text-align: left; padding:0 10px;">
                  I consider that a period of absence from {{ isset($activity)?$activity:'' }} during {{ isset($from_date) ? $from_date : '' }} to {{ isset($to_date) ? $to_date : '' }} is absolutely necessary for the restoration of their health.
               </td>
            </tr>
            <tr>
               <td height="15px" style="padding:0 10px;"></td>
            </tr>
            <tr>
               <td style="text-align: left; padding:0 10px;">
                  Yours Sincerly
               </td>
            </tr>
            <tr>
               <td style="text-align: left; padding:0 10px;">
                  {{ $doc_title.' '.$doc_first.' '.$doc_last }}
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>