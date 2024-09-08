<table width="100%" border="0" cellspacing="10" cellpadding="0" height="100%" style="border:0px solid #777777;font-family:Arial, Helvetica, sans-serif;margin:0;padding:0px;">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#555;font-size:11pt;">
                <tr>
                    <td width="60%"><b>To:</b></td>
                    <td width="40%"><b>FROM:</b></td>
                </tr>
                <?php if(isset($consult_invoice['familiy_member_info'])){ $val = $consult_invoice['familiy_member_info']; }if(isset($consult_invoice['patient_user_details'])){ $val = $consult_invoice['patient_user_details']; }?>
                <tr>
                    <td width="60%">{{isset($val['title']) ? $val['title'] : ''}} {{isset($val['first_name']) ? $val['first_name'] : ''}} {{isset($val['last_name']) ? $val['last_name'] : ''}}</td>
                    <td width="40%">Doctoroo Australia Pvt. Ltd.</td>
                </tr>
                <tr>
                    <td width="60%">{{ isset($consult_invoice['patient_info']['dec_suburb']) ? $consult_invoice['patient_info']['dec_suburb'] : ''}}</td>
                    <td width="40%">900 Biscayne Boulevard, Miami, FL 33132, USA</td>
                </tr>
                <tr>
                    <td width="60%">&nbsp;</td>
                    <td width="40%"><b>ABN:</b> 15 616 602 629</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="height:20px;">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td width="20%" style="color:#7f7f7f;font-size:10pt;">@php 
                                    $consultation_charge = "";
                                    if(isset($consult_invoice['consultation_charge']))
                                    {
                                         $consultation_charge = $consult_invoice['consultation_charge'];
                                         $grand_total = add_gst($consultation_charge);
                                    }
                                @endphp{{'$'.number_format($grand_total, 2, '.', '')}}</td>
                        <td width="60%" style="color:#7f7f7f;font-size:10pt;">@php
                                if(isset($consult_invoice['card_number'])) 
                                {
                                     $temp_no = $consult_invoice['card_number'];
                                    $card_no = substr_replace($temp_no, str_repeat("X", 12), 0, 12);
                                }   
                            @endphp{{isset($card_no) ? $card_no : ''}}</td>
                        <td width="20%" style="color:#7f7f7f;font-size:10pt;">Paid</td>
                    </tr>

                    <tr>
                        <td>Total</td>
                        <td>Payment method</td>
                        <td>Payment Status</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="height:20px;">&nbsp;</td>
    </tr>
    <hr>
    <tr>
        <td style="height:10px;">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" style="color:#50ab50; font-weight: bold;font-size: 13pt;height:20px;">Consultation</td>
                </tr>
                <tr>
                    <td width="80%" style="color:#184059; font-weight: bold;font-size: 11pt;">Time</td>
                    <td width="20%" style="color:#184059; font-weight: bold;font-size: 11pt;">Date</td>
                </tr>
                <?php $consult_datetime = convert_utc_to_userdatetime($patient_id, "patient", $consult_invoice["consultation_datetime"]); ?>
                <tr>
                    <td width="80%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{ isset($consult_datetime)?date("h:i a",strtotime($consult_datetime)):'' }}</td>
                    <td width="20%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{ isset($consult_datetime)?date("d F, Y",strtotime($consult_datetime)):'' }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <hr>
    <tr>
        <td style="height:20px;">&nbsp;</td>
    </tr>
    <tr>
        <td width="80%" style="color:#50ab50; font-weight: bold; font-size:14pt;">&nbsp;&nbsp;Item</td>
        <td width="20%" style="color:#50ab50; font-weight: bold; font-size:14pt;">Amount</td>
    </tr>
    <tr>        
        <td width="80%" style="color: #184059; font-size:13pt; height:20px;"><b>&nbsp;&nbsp;Consultation ID:</b> {{isset($consult_invoice['consultation_id']) ? $consult_invoice['consultation_id'] : ''}}</td>
        <td width="20%" style="color:#50ab50;">&nbsp;</td>
    </tr>
    <tr>
        <td width="70%" style="color:#555; font-size:11pt;">&nbsp;&nbsp;Consultation with {{isset($consult_invoice['doctor_user_details']['title']) ? $consult_invoice['doctor_user_details']['title'] : ''}} {{isset($consult_invoice['doctor_user_details']['first_name']) ? $consult_invoice['doctor_user_details']['first_name'] : ''}} {{isset($consult_invoice['doctor_user_details']['last_name']) ? $consult_invoice['doctor_user_details']['last_name'] : ''}}</td>
        <td width="20%" style="color:#555; height:20px; text-align: right; padding-right: 100px;">{{isset($consult_invoice['consultation_charge']) ? '$'.$consult_invoice['consultation_charge'] : ''}}</td>
    </tr>                
    <tr>        
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;SUBTOTAL</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right; padding-right: 100px;"><b>{{isset($consult_invoice['consultation_charge']) ? '$'.$consult_invoice['consultation_charge'] : ''}}</b></td>
    </tr>
    <tr>
        <td width="70%" style="color:#555; font-size:11pt; height:25px;">&nbsp;&nbsp;GST</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right; padding-right: 100px;"><b>10%</b></td>
    </tr>
    <tr>
        <td width="70%" style="color:#50ab50; font-size:13pt; height:25px;">&nbsp;&nbsp;TOTAL</td>
        <td width="20%" style="color:#50ab50; font-size:13pt; text-align: right; padding-right: 100px;"><b>{{ '$'.number_format($grand_total, 2, '.', '') }}</b></td>
    </tr>            
</table>
