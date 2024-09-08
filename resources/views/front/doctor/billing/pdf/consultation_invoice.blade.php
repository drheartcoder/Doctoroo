@foreach($invoice_data as $invoice)
    @php
        $consultation_id= isset($invoice['consultation_details']['consultation_id']) ? $invoice['consultation_details']['consultation_id'] : '';
        $pat_title      = isset($invoice['user_data']['title']) ? $invoice['user_data']['title'] : '';
        $pat_first      = isset($invoice['user_data']['first_name']) ? $invoice['user_data']['first_name'] : '';
        $pat_last       = isset($invoice['user_data']['last_name']) ? $invoice['user_data']['last_name'] : '';
        $pat_address    = isset($invoice['patient_data']['dec_suburb']) ? $invoice['patient_data']['dec_suburb'] : '';

        $amount[]       = isset($invoice['payment_amount']) ? $invoice['payment_amount'] : '';
        $status         = isset($invoice['payment_status']) ? $invoice['payment_status'] : '';

        $consult_datetime = convert_utc_to_userdatetime($doctor_id, "doctor", $invoice['consultation_details']['consultation_datetime']);
        $booking_time   = isset($consult_datetime) ? date("h:i a",strtotime($consult_datetime)) : '';
        $booking_date   = isset($consult_datetime) ? date("d F, Y",strtotime($consult_datetime)) : '';

        $call_time[]    = isset($invoice['call_time']) ? $invoice['call_time'] : '';

        $doc_title      = isset($invoice['doctor_user_data']['title']) ? $invoice['doctor_user_data']['title'] : '';
        $doc_first      = isset($invoice['doctor_user_data']['first_name']) ? $invoice['doctor_user_data']['first_name'] : '';
        $doc_last       = isset($invoice['doctor_user_data']['last_name']) ? $invoice['doctor_user_data']['last_name'] : '';
    @endphp
@endforeach
<table width="100%" border="0" cellspacing="10" cellpadding="0" height="100%" style="border:0px solid #777777;font-family:Arial, Helvetica, sans-serif;margin:0;padding:0px;">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#555;font-size:11pt;">
                <tr>
                    <td width="60%"><b>TO:</b></td>
                    <td width="40%"><b>FROM:</b></td>
                </tr>
                <tr>
                    <td width="60%">{{ $pat_title.' '.$pat_first.' '.$pat_last }}</td>
                    <td width="40%">{{ isset($admin_data['name']) ? $admin_data['name'] : '' }}</td>
                </tr>
                <tr>
                    <td width="60%">{{ $pat_address }}</td>
                    <td width="40%">{{ isset($admin_data['address']) ? $admin_data['address'] : '' }}</td>
                </tr>
                <tr>
                    <td width="60%">&nbsp;</td>
                    <td width="40%"><b>ABN:</b> {{ isset($admin_data['abn']) ? $admin_data['abn'] : '' }}</td>
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
                        <td width="50%" style="color:#7f7f7f;font-size:10pt;">
                            @php
                                $amount1 = isset($amount[0]) ? $amount[0] : '';
                                $amount2 = isset($amount[1]) ? $amount[1] : '';
                                $total_amount = (int) $amount1 + (int) $amount2;
                                $grand_total = add_gst($total_amount);
                            @endphp
                            {{'$'.number_format($grand_total, 2, '.', '')}}
                        </td>
                        <td width="50%" style="color:#7f7f7f;font-size:10pt;">@if($status == 'completed') Paid @else Un-Paid @endif</td>
                    </tr>
                    <tr>
                        <td>Total</td>
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
                    <td width="40%" style="color:#184059; font-weight: bold;font-size: 11pt;">Time</td>
                    <td width="40%" style="color:#184059; font-weight: bold;font-size: 11pt;">Date</td>
                    <td width="40%" style="color:#184059; font-weight: bold;font-size: 11pt;">Length</td>
                </tr>
                <tr>
                    <td width="40%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{ $booking_time }}</td>
                    <td width="40%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{ $booking_date }}</td>
                    <td width="40%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">
                        @php
                            $h1 = $h2 = $m1 = $m2 = '';

                            $call_time1 = isset($call_time[0]) ? $call_time[0] : '';
                            $call_time2 = isset($call_time[1]) ? $call_time[1] : '';
                            
                            if($call_time1 != '')
                            {
                                $explode1 = explode(':', $call_time1);
                                $h1 = $explode1[0];
                                $m1 = $explode1[1];
                            }
                            if($call_time2 != '')
                            {
                                $explode2 = explode(':', $call_time2);
                                $h2 = $explode2[0];
                                $m2 = $explode2[1];
                            }
                            $h = $h1 + $h2;
                            $m = $m1 + $m2;
                        @endphp
                        {{ str_pad($h, 2, '0', STR_PAD_LEFT).':'.str_pad($m, 2, '0', STR_PAD_LEFT).':00' }}
                    </td>
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
        <td width="70%" style="color: #184059; font-size:13pt; height:20px;"><b>&nbsp;&nbsp;Consultation ID:</b> {{ $consultation_id }}</td>
        <td width="20%" style="color:#50ab50;">&nbsp;</td>
    </tr>
    <tr>
        <td width="70%" style="color:#555; font-size:11pt;">&nbsp;&nbsp;Consultation with {{ $doc_title.' '.$doc_first.' '.$doc_last }}</td>
        <td width="20%" style="color:#555; height:20px; text-align: right;"></td>
    </tr>                
    <tr>
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;Cost of first 4 mins</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{ '$'.number_format($amount1, 2, '.', '') }}</b></td>
    </tr>
    @if($amount2 != '')
        <tr>
            <td width="70%" style="color:#555; font-size:11pt; height:25px;">&nbsp;&nbsp;Cost after first 4 mins</td>
            <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{ '$'.number_format($amount2, 2, '.', '') }}</b></td>
        </tr>
    @endif
    <tr>
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;Sub Total</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{ '$'.number_format($total_amount, 2, '.', '') }}</b></td>
    </tr>
    <tr>
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;GST</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>10%</b></td>
    </tr>
    <tr>
        <td width="70%" style="color:#50ab50; font-size:13pt; height:25px;">&nbsp;&nbsp;TOTAL</td>
        <td width="20%" style="color:#50ab50; font-size:13pt; text-align: right;"><b>{{'$'.number_format($grand_total, 2, '.', '')}}</b></td>
    </tr>            
</table>
