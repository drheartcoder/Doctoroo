<?php 

namespace App\Common\Services;



class MailChimpService
{
	private $obj_mailchimp;
    private $list_id;
    private $api_key;

    public function __construct()
    {  
       

        /* Fallback Credentials */
        $this->api_key = "b25badb0656a9df24a30e5dcc6a5d0e1-us13";   
        $this->list_id = "0fce2acf02";

    }

    public function subscribe($email)
    {

    	$arr_merges = [];
    	$email_type = true;
    	$double_optin=true;
        $update_existing=false;
        $replace_interests=true;
        $send_welcome=true;

        $responce = [];
        
        $data = array(
                'email_address'=>$email,
                'apikey'=>$this->api_key,
                'merge_vars' => $arr_merges,
                'id' => $this->list_id,
                'double_optin' => $double_optin,
                'update_existing' => $update_existing,
                'replace_interests' => $replace_interests,
                'send_welcome' => $send_welcome,
                'email_type' => $email_type
            );

       
        $payload = json_encode($data);
         
        //replace us2 with your actual datacenter
        $submit_url = "http://us13.api.mailchimp.com/1.3/?method=listSubscribe";
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $submit_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
         
        $result = curl_exec($ch);
        curl_close ($ch);
        $data = json_decode($result);
        if (isset($data->error))
        {
            if (isset($data->code)) 
            {
                $responce['error_code']=$data->code;
            }

            $responce['status']=FALSE;
            
        } 
        else 
        {
            $responce['status']=TRUE;
            
        }	

        return $responce;
    }
}