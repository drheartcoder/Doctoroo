<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Registration Successful</title>
      <link href="css/event-connect-usa.css" rel="stylesheet" />
      <style>
       .listed-btn a {
    border: 1px solid #fc575c;
    color: #fc575c;
    display: block;
    font-size: 15px;
    letter-spacing: 0.4px;
    margin: 0 auto;
    max-width: 204px;
    padding: 9px 4px; height: initial;
    text-align: center;
    text-transform: uppercase;
    width: 100%;
}
       </style>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:'ubunturegular', sans-serif; line-height:21px; color:#666; text-align:justify;">
      <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
               <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr >
                     <td style="background-image: url('{{url('/')}}/public/images/emailer-bg.jpg');background-size: cover;background-position: center top;background-repeat: no-repeat;    color: #333;    font-size: 15px;    padding: 70px 25px;    text-align: center;">
                        <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="text-align:center;"></td>
                              
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td height="20"></td>
                  </tr>
                  <tr><td style="color: rgb(51, 51, 51); text-align: center; font-family: ubuntumedium; font-size: 19px; line-height: 35px; padding-top: 3px;">Unlink Your Account </td></tr>
                  <!--tr><td style="color: #333333;font-size: 15px;padding-top: 3px;text-align: center; font-family: robotomedium;">Registerd successfully</td></tr-->
                  
                  <tr>
                     <td height="40"></td>
                  </tr>
                  <tr>
                     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                   Hello <span style="color: #fc575c;font-family: 'ubuntumedium',sans-serif;">
                   @if(isset($member_arr))
                       @if(!empty($member_arr['first_name']) || !empty($member_arr['last_name']))
                          {{$member_arr['first_name'].' '.$member_arr['last_name']}}
                       @else
                          Sir/Mam
                       @endif
                   @else
                       @if($user)
                          {{$user}} 
                       @else   
                          Sir/Mam
                        @endif  
                   @endif
                   , </span>@if(isset($user_arr))
                        <p style="margin:10px;margin-left:4em;">{{$user_arr['first_name'].' '.$user_arr['last_name']}} has <strong>unlink</strong> you. Please Click <a href="{{$module_url_path.'/member_unlink_confirmation/'.base64_encode($member_arr['id']).'/'.base64_encode($member_mail)}}">here</a> to unlink your account.</p>
                          @else
                              <p style="margin:10px;margin-left:4em;">Your Account has been setup successfully. Click <a href="{{$module_url_path.'/member_set_password/'.base64_encode($user_id)}}">here</a> to set password</p>
                        @endif
                     </td>
                  </tr>
              
               
               <tr>
                     <td height="20"></td>
                  </tr>
                 
                  <tr>
                     <td height="40"></td>
                  </tr>
               <tr>
                     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                     

                     </td>
                  </tr>
                  
             
                  <tr>
                     <td>&nbsp;</td>
                  </tr>                                    
               <tr>
                  <td>
                     <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td style="font-family: 'robotomedium',sans-serif; font-size:13px;background: rgb(17, 18, 24) none repeat scroll 0% 0%; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
                            
                           </td>
                           
                        </tr>
                     </table>
                  </td>                 
               </tr>
            </table>
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
      </table>
        </div>      
      </div>       
   </body>
</html>



