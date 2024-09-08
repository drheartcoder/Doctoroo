<table width="100%" border="0" cellspacing="10" cellpadding="0" height="100%" style="border:0px solid #777777;font-family:Arial, Helvetica, sans-serif;margin:0;padding:0px;">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#555;font-size:11pt;">
                <tr>
                    <td width="60%"><b>T0:</b></td>
                    <td width="40%"><b>FROM:</b></td>
                </tr>
                <tr>
                    <td width="60%">{{isset($membership_arr['userinfo']['title']) ? $membership_arr['userinfo']['title'] : ''}} {{isset($membership_arr['userinfo']['first_name']) ? $membership_arr['userinfo']['first_name'] : ''}} {{isset($membership_arr['userinfo']['last_name']) ? $membership_arr['userinfo']['last_name'] : ''}}</td>
                    <td width="40%">{{isset($admin_arr['name']) &&  !empty($admin_arr) ? $admin_arr['name'] : ''}}</td>
                </tr>
                <tr>
                    <td width="60%">{{isset($membership_arr['doctorinfo']['dec_address']) ? $membership_arr['doctorinfo']['dec_address'] : 'NA'}}</td>
                    <td width="40%">{{isset($admin_arr['dec_address']) &&  !empty($admin_arr) ? $admin_arr['dec_address'] : ''}}</td>
                </tr>
                <tr>
                    <td width="60%">&nbsp;</td>
                    <td width="40%"><b>ABN:</b> {{isset($admin_arr['abn']) &&  !empty($admin_arr) ? $admin_arr['abn'] : ''}}</td>
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
                        <td width="40%" style="color:#7f7f7f;font-size:10pt;">
                        {{ isset($membership_arr['total_amount']) &&  !empty($membership_arr['total_amount']) ? '$'.$membership_arr['total_amount'] : ''}}
                        </td>
                        <td width="40%" style="color:#7f7f7f;font-size:10pt;">{{isset($membership_arr['status']) && $membership_arr['status'] == 'paid' ? 'Paid' : '' }}{{isset($membership_arr['status']) && $membership_arr['status'] == 'unpaid' ? 'Unpaid' : '' }}
                        </td>
                        <td width="40%" style="color:#7f7f7f;font-size:10pt;">{{isset($membership_arr['created_at']) ? date('d M, Y', strtotime($membership_arr['created_at'])) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Payment Status</td>
                        <td>Billing Date</td>
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
                    <td colspan="2" style="color:#50ab50; font-weight: bold;font-size: 13pt;height:20px;">Membership</td>
                </tr>
                <tr>
                    <td width="70%" style="color:#184059; font-weight: bold;font-size: 11pt;">Billing Date</td>
                    <td width="30%" style="color:#184059; font-weight: bold;font-size: 11pt;">Billing Period</td>
                </tr>
                <tr>
                    <td width="70%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{isset($membership_arr['created_at']) ? date('d M,Y', strtotime($membership_arr['created_at'])) : '' }}</td>
                    <td width="30%" style="color:#7f7f7f; font-weight: 100;font-size: 11pt;">{{isset($membership_arr['start_date']) ? date('M d, Y', strtotime($membership_arr['start_date'])) : '' }} - {{isset($membership_arr['end_date']) ? date('M d, Y', strtotime($membership_arr['end_date'])) : '' }}</td>
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
        <td width="70%" style="color: #184059; font-size:13pt; height:20px;"><b>&nbsp;&nbsp;Invoice No:</b> {{isset($membership_arr['invoice_no']) ? $membership_arr['invoice_no'] : ''}}</td>
        <td width="20%" style="color:#50ab50;">&nbsp;</td>
    </tr>
    <tr>        
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;Membership ( {{isset($membership_arr['package']) && $membership_arr['package'] == 'monthly' ? 'Monthly' : '' }}{{isset($membership_arr['package']) && $membership_arr['package'] == 'annually' ? 'Bi - Annually' : '' }} )</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{isset($membership_arr['amount']) && !empty($membership_arr['amount']) ? '$'.$membership_arr['amount'] : 'NA'}}</b></td>
    </tr>
    @if(isset($membership_arr['discount_data']) && $membership_arr['discount_data'] != null)
    <tr>        
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;Discount Code ( {{ isset($membership_arr['discount_data']['code']) ? $membership_arr['discount_data']['code'] : '' }} )</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{ isset($membership_arr['discount_data']['percentage']) ? $membership_arr['discount_data']['percentage'].'%' : '' }}</b></td>
    </tr>
    @endif
    <!-- <tr>        
        <td width="70%" style="color: #555; font-size:11pt;height:25px;">&nbsp;&nbsp;SUBTOTAL</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{isset($membership_arr['amount']) && !empty($membership_arr['amount']) ? '$'.$membership_arr['amount'] : 'NA'}}</b></td>
    </tr> -->
    <tr>
        <td width="70%" style="color:#555; font-size:11pt; height:25px;">&nbsp;&nbsp;GST</td>
        <td width="20%" style="color:#555; font-size:11pt; text-align: right;"><b>{{isset($membership_arr['gst']) && !empty($membership_arr['gst']) ? '$'.$membership_arr['gst'] : ''   }}</b></td>
    </tr>
    <tr>
        <td width="70%" style="color:#50ab50; font-size:13pt; height:25px;">&nbsp;&nbsp;TOTAL</td>
        <td width="20%" style="color:#50ab50; font-size:13pt; text-align: right;"><b>{{ isset($membership_arr['total_amount']) &&  !empty($membership_arr['total_amount']) ? '$'.$membership_arr['total_amount'] : ''}}</b></td>
    </tr>            
</table>
