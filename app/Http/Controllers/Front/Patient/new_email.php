<?php
public function store_signup_voucher(Request $request)
    { 
        $return_arr                  =   array();
        $arr_rules['vemail']         =   "required|email";
        $arr_rules['vfirst_name']    =   "required";
        $arr_rules['vlast_name']     =   "required";
        $arr_rules['vpass_word']     =   "required";
        $arr_rules['vstate']         =   "required";
        $arr_rules['vmob_code']      =   "required";
        $arr_rules['vmobile']        =   "required";
        $arr_rules['vdob']           =   "required";

        $form_data  =   $request->all();
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Flash::error('Please check your browser javascript setting to allow our website form access. Currently it is denied.');
            return redirect(url('/')."/patient/error");
        }

        $num = $this->UserModel->where('email',$form_data['vemail'])->withTrashed()->count();
        if($num > 0)
        {
            $return_arr['response'] = 'exist';
            $return_arr['message']  = 'An account with this email already exists. Please try again with other email.';
            return Response::json($return_arr);
        }

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $arr_data['first_name']     =   $form_data['vfirst_name'];
        $arr_data['last_name']      =   $form_data['vlast_name'];
        $arr_data['email']          =   $form_data['vemail'];
        $arr_data['password']       =   $form_data['vpass_word'];
        $arr_data['user_status']    =   'Active';
        $arr_data['is_invited']     =   $randomString;

        // get user id who have refer user
        $referred_by['user_id'] = '';
        $friends_code   = $form_data['friends_code'];
        if( isset($friends_code) && !empty($friends_code) )
        {
            $friend_id = $this->PatientModel->where('my_referral_code', $friends_code )->select('user_id')->first();
            if( isset($friend_id) && count($friend_id) > 0)
            {
                $referred_by = $friend_id->toArray();
            } // end if
            $update_data['referred_point'] = '10';
            $this->PatientModel->where('user_id', $referred_by['user_id'])->update($update_data);
        } // end if

        $user                       =   Sentinel::register($arr_data);
        if($user)
        {
            $selected_date = date("Y-d-m",strtotime($form_data['vdob']));

            $patient_data['user_id']                = $user->id;
            //$patient_data['country']                = "Australia";
            $patient_data['state']                  = $form_data['vstate'];
            $patient_data['mobile_code']            = $form_data['vmob_code']
            $patient_data['mobile_no']              = $form_data['vmobile'];
            $patient_data['referred_by']            = $referred_by['user_id'];
            $patient_data['my_referral_code']       = $randomString;
            $patient_data['friend_referral_code']   = $form_data['friends_code'];
            $patient_data['date_of_birth']          = $selected_date;
            $patient_data['type']                   = 'doctoroo';

            $user  =  Sentinel::findById($user->id);
            $role  =  Sentinel::findRoleBySlug('patient');
            $user->roles()->attach($role);

            // create user for twilio chat
            $create_user = $this->create_user($user->first_name.''.$user->last_name.''.$user->id);

            $activation =   Activation::create($user);
            $activation_code    =   $activation->code;

            $res_patient = $this->PatientModel->create($patient_data);
            if($res_patient)
            {
                /*$activation_link    ='<a class="btn_emailer_cls" href="'.url('/patient/verify/'.base64_encode($user->id).'/'.base64_encode($activation_code)).'"> Verify Now </a>';
                $arr_built_content = [ 
                                    'FIRST_NAME'=>$arr_data['first_name'] , 
                                    'APP_NAME'  =>config('app.project.name'),
                                    'ACTIVATION_LINK'=>$activation_link,
                                     ];*/

                /*$arr_mail_data                      = [];
                $arr_mail_data['email_template_id'] = '38';
                $arr_mail_data['arr_built_content'] = $arr_built_content;
                $arr_mail_data['user']              = $arr_data;
                $email_status = $this->EmailService->send_mail($arr_mail_data);*/

                /* -- send mail to client -- */
                /* content variables in view */
                $content['first_name']          = $res_patient->first_name;
                $content['last_name']           = $res_patient->last_name;
                $content['email']               = $res_patient->email;
                //$content['activation_code']     = $activation_code;
                $content['user_id']             = $res_patient->id;
                /* end content variables in view */


                /* built content variables in view */
                $content             =  view('front.email.coming_soon',compact('content'))->render();
                $content             =  html_entity_decode($content);
                /* end built content variables in view */
               
                $to_email_id         = $res_patient->email;
                $project_name        = config('app.project.name');
                $mail_subject        = 'Welcome to '.config('app.project.name');


                /* get admin email */
                    /*$get_admin_role_id = \DB::table('roles')->where('status','0')->where('is_active','0')->where('slug','=','admin')->orderBy('id','DESC')->get();*/
                    $get_admin       = $this->AdminProfileModel->first();
                    $get_admin       = $get_admin->toArray();
                    $mail_form       = $get_admin['contact_email'];
                /* end get admin email */    

                if(!empty($mail_form))
                {
                    $mail_form           = $mail_form;
                }
                else{
                    $mail_form           = config('app.project.admin_email');
                }
                $mail_form               = $mail_form;

                $send_mail = Mail::send(array(), array(), function ($message) use ($to_email_id, $mail_form, $project_name, $mail_subject, $content) {
                      $message->from($mail_form, $project_name);
                      $message->to($to_email_id)
                      ->subject($mail_subject)
                      ->setBody($content, 'text/html');
                });
                /* -- end  mail to client-- */

                //$login_status = Sentinel::login($user);
                $return_arr['response']         = 'success';
                $return_arr['message']          = 'Registration has been done successfully.';
                $return_arr['randomString']     = $randomString;
                $return_arr['referral_url']     = url('/').'/ICareForYou/'.$randomString;
                $return_arr['moblie']           = $form_data['vmobile'];
            }
            else
            {
                $return_arr['response'] = 'error';
                $return_arr['message'] = 'Error! Error while creating your account. Please try again later';
            }
        }
        else
        {
            $return_arr['response'] = 'error';
            $return_arr['message'] = 'Error! Some error occured. Please try again later';
        }
        echo json_encode($return_arr);
    }

?>