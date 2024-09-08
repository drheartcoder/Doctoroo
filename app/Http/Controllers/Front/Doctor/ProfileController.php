<?php
namespace App\Http\Controllers\Front\Doctor;
use App\Models\UserModel;
use App\Models\LanguageModel;
use App\Models\DoctorModel;
use App\Models\TimezonesModel;
use App\Models\TimezoneModel;
use App\Models\PrefixModel;
use App\Models\MobileCountryCodeModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;
Use Session;

class ProfileController extends Controller
{
    public function __construct(UserModel               $user_model,
                                LanguageModel           $language_model,
                                DoctorModel             $doctor_model,
                                TimezonesModel          $timeszone,
                                TimezoneModel           $timezone,
                                PrefixModel             $prefix_model,
                                MobileCountryCodeModel  $mob_country_code)
    {

        $this->arr_view_data           = [];

        $this->UserModel               = $user_model;
        $this->LanguageModel           = $language_model;
        $this->DoctorModel             = $doctor_model;
        $this->TimezonesModel          = $timeszone;
        $this->TimezoneModel           = $timezone;
        $this->PrefixModel             = $prefix_model;
        $this->MobileCountryCodeModel  = $mob_country_code;

        $this->module_title            = "My Profile";
      	$this->module_view_folder      = 'front.doctor.my_profile';
        $this->module_url_path         = url('/').'/doctor/my_profile';

        $this->doc_profile_public      =   public_path().config('app.project.img_path.doctor_image');
        $this->doc_profile_pic         =   url('/public').config('app.project.img_path.doctor_image');
        $this->doc_video_public        =   public_path().config('app.project.img_path.doctor_video');
        $this->doc_video               =   url('/public').config('app.project.img_path.doctor_video');
        $this->doc_id_proof_public     =   public_path().config('app.project.img_path.doctor_id_proof');
        $this->doc_id_proof            =   url('/public').config('app.project.img_path.doctor_id_proof');
        $this->doc_med_reg_public      =   public_path().config('app.project.img_path.medical_registration');
        $this->doc_med_reg             =   url('/public').config('app.project.img_path.medical_registration');
        $this->doc_ins_pol_public      =   public_path().config('app.project.img_path.insurance_policy');
        $this->doc_ins_pol             =   url('/public').config('app.project.img_path.insurance_policy');
        $this->doc_cyb_liabl_public    =   public_path().config('app.project.img_path.cyber_liability');
        $this->doc_cyb_liabl           =   url('/public').config('app.project.img_path.cyber_liability');

        $user = Sentinel::check();
        if($user)
        {
          $this->user_id = $user->id;
        }
        else
        {
          $this->user_id = null;
        }
    }
    /*
    | Function  : Get all the doctor data
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Display personal details
    */

    public function about_yourself(Request $request)
    {
          $get_user = $this->DoctorModel->where('user_id', $this->user_id)
                                        ->with('userinfo')
                                        ->first();
          
          if($get_user)
          {
            $this->arr_view_data['doctor_data'] = $get_user->toArray();
          }


          $get_pre = $this->PrefixModel->orderBy('name', 'ASC')->get();
          if($get_pre)
          {
            $this->arr_view_data['prefix_data'] = $get_pre->toArray();
          }
          

          //For International timezone 
          /*$get_timezone = $this->TimezonesModel->get();
          if($get_timezone)
          {
              $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
          }*/

          //For australia timezone
          $get_timezone = $this->TimezoneModel->get();
          if($get_timezone)
          {
              $this->arr_view_data['timezone_data'] = $get_timezone->toArray();
          }
          //dd($this->arr_view_data['timezone_data']);


          $get_mob_code = $this->MobileCountryCodeModel->get();
          if($get_mob_code)
          {
              $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
          }


          $this->arr_view_data['page_title']                = str_singular($this->module_title);
          $this->arr_view_data['module_url_path']           = $this->module_url_path;

          return view($this->module_view_folder.'.about_yourself',$this->arr_view_data);

    } // end about_yourself



    /*
    | Function  : get all the updated data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Success or Error
    */

    public function update_about_yourself(Request $request)
    {
      
      $arr_rules['first_name']    =   "required";
      $arr_rules['last_name']     =   "required";
      $arr_rules['title']         =   "required";
      $arr_rules['gender']        =   "required";
      $arr_rules['datebirth']     =   "required";
      $arr_rules['citizenship']   =   "required";
      //$arr_rules['contact_no']  =   "required";
      $arr_rules['mobile_code']   =   "required";
      $arr_rules['mobile_no']     =   "required";
      $arr_rules['address']       =   "required";
      $arr_rules['timezone']      =   "required";
      $arr_rules['abn']           =   "required";
      
      /* Encrypted filed Validation */
/*      $arr_rules['enc_first_name']  =   "required";
      $arr_rules['enc_last_name']   =   "required";*/
      // /$arr_rules['enc_mobile_no']   =   "required";
      $arr_rules['enc_address']     =   "required";

      $validator  =   Validator::make($request->all(),$arr_rules);
      if($validator->fails())
      {
          Session::flash('redirect_msg','Error! All the fields are mandatory.');
          return back()->withInput($request->all())->withErrors($validator);
      }

      $user_data['first_name']     = ucwords(strtolower($request->input('first_name')));
      $user_data['last_name']      = ucwords(strtolower($request->input('last_name')));
      $user_data['title']          = $request->input('title');

      $user = Sentinel::findById($this->user_id);
      if($user)
      {
        $user = Sentinel::update($user, $user_data);
      }

      $doctor_data['gender']      = $request->input('gender');
      $doctor_data['dob']         = $request->input('datebirth_submit');
      $doctor_data['citizenship'] = $request->input('citizenship');
      $doctor_data['contact_no']  = $request->input('enc_contact_no');
      $doctor_data['mobile_code'] = $request->input('mobile_code');
      $doctor_data['mobile_no']   = encrypt_value($request->input('mobile_no'));
      $doctor_data['address']     = $request->input('enc_address');
      $doctor_data['timezone']    = $request->input('timezone');
      $doctor_data['abn']         = $request->input('abn');


      $res_doctor = $this->DoctorModel->where('user_id',$this->user_id)->update($doctor_data);
      if($res_doctor)
      {
        Session::flash('redirect_msg','Success! Profile updated successfully.');
        return redirect()->back();
      }
      else
      {
        Session::flash('redirect_msg','Error! Something went wrong.');
        return redirect()->back();
      }

    } // end update_about_yourself



    /*
    | Function  : Get all the doctor data
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Display all the medical practice data
    */

    public function your_medical_practice(Request $request)
    {
        $get_user = $this->DoctorModel->where('user_id', $this->user_id)
                                        ->with('userinfo')
                                        ->first();
          
        if($get_user)
        {
          $this->arr_view_data['doctor_data'] = $get_user->toArray();
        }


        $get_language = $this->LanguageModel->where('language_status', '1')->where('user_id', '0')->orWhere('user_id',$this->user_id)->orderBy('language', 'ASC')->get();
        if($get_language)
        {
            $this->arr_view_data['language_data'] = $get_language->toArray();
        }

        $get_mob_code = $this->MobileCountryCodeModel->get();
          if($get_mob_code)
          {
              $this->arr_view_data['mobcode_data'] = $get_mob_code->toArray();
          }
        

        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

        return view($this->module_view_folder.'.your_medical_practice',$this->arr_view_data);
    } // end your_medical_practice



    /*
    | Function  : get all the updated data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Success or Error
    */

    public function update_your_medical_practice(Request $request)
    {
      //dd($request->all());
      $arr_rules['clinic_name']       =   "required";
      $arr_rules['clinic_address']    =   "required";
      $arr_rules['clinic_email']      =   "required";
      $arr_rules['experience']        =   "required";
      $arr_rules['doc_lang']          =   "required";
      
      /* Encryption Fields */
      $arr_rules['enc_clinic_address']    =   "required";
      $arr_rules['enc_clinic_email']      =   "required";
      $arr_rules['enc_clinic_contact_no'] =   "required";
      $arr_rules['enc_clinic_mobile_no']  =   "required";

      $other_languages                =   '';

      $validator  =   Validator::make($request->all(),$arr_rules);
      if($validator->fails())
      {
          Session::flash('redirect_msg','Error! All the fields (Except mobile and contact number) are mandatory.');
          return back()->withInput($request->all())->withErrors($validator);
      }

      $doctor_data['clinic_name']           = $request->input('clinic_name');
      $doctor_data['clinic_address']        = $request->input('enc_clinic_address');
      $doctor_data['clinic_email']          = $request->input('enc_clinic_email');
      $doctor_data['clinic_contact_no']     = $request->input('enc_clinic_contact_no');
      $doctor_data['clinic_mobile_no_code'] = $request->input('clinic_mobile_no_code');
      $doctor_data['clinic_mobile_no']      = $request->input('enc_clinic_mobile_no');
      $doctor_data['experience']            = $request->input('experience');
      $doctor_data['language']              = implode(',',$request->input('doc_lang'));

     
      if(!empty($request->input('other_languages')))
      {
          $other_languages  = explode(',', $request->input('other_languages'));
      }


      $res_doctor = $this->DoctorModel->where('user_id',$this->user_id)->update($doctor_data);
      if($res_doctor)
      {
        if($other_languages){
            $data=[];
            $other_language_id = [];
            $lang_string = [];
            foreach($other_languages as $other_lan){

                 $getExist = \DB::table('dod_language')->where('user_id',$this->user_id)->where('language',ucfirst($other_lan))->first();
                 if(count($getExist) > 0){
                    $other_language_id[] = $getExist->id;
                 }
                 else{
                    if($other_lan != ""){
                       $data['user_id']         = $this->user_id;
                       $data['language']        = ucfirst($other_lan);
                       $data['language_status'] = '1';
                       $other_language_id[] = \DB::table('dod_language')->insertGetId($data);
                   }
                 }
            }
            $lang_string = implode(",", array_merge($request->input('doc_lang'), $other_language_id)); 
            $update_lang['language'] = str_replace("Other,","",$lang_string);


            \DB::table('dod_doctor')->where('user_id',$this->user_id)->update($update_lang);
        }

        Session::flash('redirect_msg','Success! Profile updated successfully.');
        return redirect()->back();
      }
      else
      {
        Session::flash('redirect_msg','Error! Something went wrong.');
        return redirect()->back();
      }

    } // end update_your_medical_practice



    /*
    | Function  : Get all the doctor data
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Display all the medical qualifications data
    */

    public function your_medical_qualifications()
    {

        $get_user = $this->DoctorModel->where('user_id', $this->user_id)
                                        ->with('userinfo')
                                        ->first();
          
        if($get_user)
        {
          $this->arr_view_data['doctor_data'] = $get_user->toArray();
        }
        

        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

        return view($this->module_view_folder.'.your_medical_qualifications',$this->arr_view_data);

    } // end your_medical_qualifications



    /*
    | Function  : get all the updated data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Success or Error
    */

    public function update_your_medical_qualifications(Request $request)
    {
          $arr_rules['medical_qualification'] =   "required";
          $arr_rules['medical_school']        =   "required";
          $arr_rules['year_obtained']         =   "required";
          $arr_rules['country_obtained']      =   "required";
          $arr_rules['bank_account_name']     =   "required";
          $arr_rules['bsb']                   =   "required";
          $arr_rules['account_number']        =   "required";

          /* Encryption Fields */
          $arr_rules['enc_clinic_address']    =   "required";
          $arr_rules['enc_clinic_email']      =   "required";
          $arr_rules['enc_clinic_contact_no'] =   "required";
          $arr_rules['enc_clinic_mobile_no']  =   "required";

          $validator  =   Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
              Session::flash('redirect_msg','Error! All the fields are mandatory.');
              return back()->withInput($request->all())->withErrors($validator);
          }

          $doctor_data['medical_qualification'] = $request->input('enc_medical_qualification');
          $doctor_data['medical_school']        = $request->input('medical_school');
          $doctor_data['year_obtained']         = $request->input('year_obtained');
          $doctor_data['country_obtained']      = $request->input('country_obtained');
          $doctor_data['other_qualifications']  = $request->input('other_qualifications');
          $doctor_data['bank_account_name']     = $request->input('enc_bank_account_name');
          $doctor_data['bsb']                   = $request->input('enc_bsb');
          $doctor_data['account_number']        = $request->input('enc_account_number');

          $res_doctor = $this->DoctorModel->where('user_id',$this->user_id)->update($doctor_data);
          if($res_doctor)
          {
            Session::flash('redirect_msg','Success! Profile updated successfully.');
            return redirect()->back();
          }
          else
          {
            Session::flash('redirect_msg','Error! Something went wrong.');
            return redirect()->back();
          }

    } // end update_your_medical_qualifications



    /*
    | Function  : Get all the doctor data
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Display all the Official Documents & Verification data
    */

    public function official_documents_verification()
    {

        $get_user = $this->DoctorModel->where('user_id', $this->user_id)
                                        ->with('userinfo')
                                        ->first();
          
        if($get_user)
        {
          $this->arr_view_data['doctor_data'] = $get_user->toArray();
        }
        //dd($this->arr_view_data['doctor_data']);


        $this->arr_view_data['doc_id_proof']              = $this->doc_id_proof;
        $this->arr_view_data['doc_id_proof_public']       = $this->doc_id_proof_public;

        $this->arr_view_data['doc_med_reg']               = $this->doc_med_reg;
        $this->arr_view_data['doc_med_reg_public']        = $this->doc_med_reg_public;

        $this->arr_view_data['doc_ins_pol']               = $this->doc_ins_pol;
        $this->arr_view_data['doc_ins_pol_public']        = $this->doc_ins_pol_public;

        $this->arr_view_data['doc_cyb_liabl']             = $this->doc_cyb_liabl;
        $this->arr_view_data['doc_cyb_liabl_public']      = $this->doc_cyb_liabl_public;

        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

        return view($this->module_view_folder.'.official_documents_verification',$this->arr_view_data);

    } // end official_documents_verification


    public function update_official_documents_verification(Request $request)
    {
          $arr_rules['enc_prescriber_no']                    = "required";
          $arr_rules['enc_ahpra_registration_no']            = "required";
          $arr_rules['enc_medical_registration_no']          = "required";

          if($request->input('old_id_proof_file') == null)
          {
            $arr_rules['id_proof_file'] = "required";
          }
          if($request->input('old_medical_registration_certificate') == null)
          {
            $arr_rules['medical_registration_certificate'] = "required";
          }
          if($request->input('old_pi_insurance_policy') == null)
          {
            $arr_rules['pi_insurance_policy'] = "required";
          }
          if($request->input('old_cyber_liability_insurance_policy') == null)
          {
            $arr_rules['cyber_liability_insurance_policy'] = "required";
          }


          $validator  =   Validator::make($request->all(),$arr_rules);
          if($validator->fails())
          {
              Session::flash('redirect_msg','Error! All the fields are mandatory.');
              return back()->withInput($request->all())->withErrors($validator);
          }

          $id_proof_file_name                 = "";
          $medical_registration_file_name     = "";
          $pi_insurance_policy_file_name      = "";
          $cyber_liability_file_name          = "";

          // upload id proof
          if($request->hasFile('id_proof_file'))
          {
              $id_proof_file   =   $request->file('id_proof_file');

              if(isset($id_proof_file) && sizeof($id_proof_file)>0)
              {
                  $extention  =   strtolower($id_proof_file->getClientOriginalExtension());
                  $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                  if(!in_array($extention, $valid_ext))
                  {
                      Session::flash('id_proof_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                      return redirect()->back()->withInput($request->all());
                  }
                  else if($id_proof_file->getClientSize() > 5000000)
                  {
                      Session::flash('id_proof_error','Please upload image/document with small size. Max size allowed is 5mb');
                      return redirect()->back()->withInput($request->all());
                  }
                  else
                  {
                      @unlink($this->doc_id_proof.$request->input('old_id_proof_file'));
                      $id_proof_file_name      = $request->file('id_proof_file');
                      $id_proof_file_extension = strtolower($request->file('id_proof_file')->getClientOriginalExtension()); 
                      $id_proof_file_name      = sha1(uniqid().$id_proof_file_name.uniqid()).'.'.$id_proof_file_extension;
                      $id_proof_upload_result  = $request->file('id_proof_file')->move($this->doc_id_proof_public, $id_proof_file_name);
                  }
              }
              else
              {
                  Session::flash('id_proof_error','Please upload valid image/document.');
                  return redirect()->back()->withInput($request->all());
              }
          }

          // upload medical registration certificate
          if($request->hasFile('medical_registration_certificate_file'))
          {
              $medical_registration_certificate_file   =   $request->file('medical_registration_certificate_file');

              if(isset($medical_registration_certificate_file) && sizeof($medical_registration_certificate_file)>0)
              {
                  $extention  =   strtolower($medical_registration_certificate_file->getClientOriginalExtension());
                  $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                  if(!in_array($extention, $valid_ext))
                  {
                      Session::flash('medical_registration_certificate_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                      return redirect()->back()->withInput($request->all());
                  }
                  else if($medical_registration_certificate_file->getClientSize() > 5000000)
                  {
                      Session::flash('medical_registration_certificate_error','Please upload image/document with small size. Max size allowed is 5mb');
                      return redirect()->back()->withInput($request->all());
                  }
                  else
                  {
                      @unlink($this->doc_med_reg.$request->input('old_medical_registration_certificate_file'));
                      $medical_registration_file_name     = $request->file('medical_registration_certificate_file');
                      $med_reg_file_extension             = strtolower($request->file('medical_registration_certificate_file')->getClientOriginalExtension()); 
                      $medical_registration_file_name     = sha1(uniqid().$medical_registration_file_name.uniqid()).'.'.$med_reg_file_extension;
                      $med_reg_upload_result              = $request->file('medical_registration_certificate_file')->move($this->doc_med_reg_public, $medical_registration_file_name);
                  }
              }
              else
              {
                  Session::flash('medical_registration_certificate_error','Please upload valid image/document.');
                  return redirect()->back()->withInput($request->all());
              }
          }

          // upload insurance policy
          if($request->hasFile('pi_insurance_policy_file'))
          {
              $pi_insurance_policy_file   =   $request->file('pi_insurance_policy_file');

              if(isset($pi_insurance_policy_file) && sizeof($pi_insurance_policy_file)>0)
              {
                  $extention  =   strtolower($pi_insurance_policy_file->getClientOriginalExtension());
                  $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                  if(!in_array($extention, $valid_ext))
                  {
                      Session::flash('pi_insurance_policy_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                      return redirect()->back()->withInput($request->all());
                  }
                  else if($pi_insurance_policy_file->getClientSize() > 5000000)
                  {
                      Session::flash('pi_insurance_policy_error','Please upload image/document with small size. Max size allowed is 5mb');
                      return redirect()->back()->withInput($request->all());
                  }
                  else
                  {
                      @unlink($this->doc_ins_pol.$request->input('old_pi_insurance_policy_file'));
                      $pi_insurance_policy_file_name      = $request->file('pi_insurance_policy_file');
                      $insurance_policy_file_extension    = strtolower($request->file('pi_insurance_policy_file')->getClientOriginalExtension()); 
                      $pi_insurance_policy_file_name      = sha1(uniqid().$pi_insurance_policy_file_name.uniqid()).'.'.$insurance_policy_file_extension;
                      $insurance_policy_upload_result     = $request->file('pi_insurance_policy_file')->move($this->doc_ins_pol_public, $pi_insurance_policy_file_name);
                  }
              }
              else
              {
                  Session::flash('pi_insurance_policy_error','Please upload valid image/document.');
                  return redirect()->back()->withInput($request->all());
              }
          }

          // upload cyber liability
          if($request->hasFile('cyber_liability_file'))
          {
              $cyber_liability_file   =   $request->file('cyber_liability_file');

              if(isset($cyber_liability_file) && sizeof($cyber_liability_file)>0)
              {
                  $extention  =   strtolower($cyber_liability_file->getClientOriginalExtension());
                  $valid_ext  =   ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

                  if(!in_array($extention, $valid_ext))
                  {
                      Session::flash('cyber_liability_error','Please upload valid image/document with valid extension i.e jpg, png, jpeg, bmp,txt,pdf,csv,doc,docx,xlsx');
                      return redirect()->back()->withInput($request->all());
                  }
                  else if($cyber_liability_file->getClientSize() > 5000000)
                  {
                      Session::flash('cyber_liability_error','Please upload image/document with small size. Max size allowed is 5mb');
                      return redirect()->back()->withInput($request->all());
                  }
                  else
                  {
                      @unlink($this->doc_cyb_liabl.$request->input('old_cyber_liability_file'));
                      $cyber_liability_file_name      = $request->file('cyber_liability_file');
                      $cyber_liability_file_extension = strtolower($request->file('cyber_liability_file')->getClientOriginalExtension()); 
                      $cyber_liability_file_name      = sha1(uniqid().$cyber_liability_file_name.uniqid()).'.'.$cyber_liability_file_extension;
                      $cyber_liability_upload_result  = $request->file('cyber_liability_file')->move($this->doc_cyb_liabl_public, $cyber_liability_file_name);
                  }
              }
              else
              {
                  Session::flash('cyber_liability_error','Please upload valid image/document.');
                  return redirect()->back()->withInput($request->all());
              }
          }

          $doctor_data['medical_registration_no']              = $request->input('enc_medical_registration_no');
          $doctor_data['medicare_provider_no']                 = $request->input('enc_medicare_provider_no');
          $doctor_data['prescriber_no']                        = $request->input('enc_prescriber_no');
          $doctor_data['ahpra_registration_no']                = $request->input('enc_ahpra_registration_no');

          if($request->hasFile('id_proof_file'))
          {
              $doctor_data['id_proof_file']                    = $id_proof_file_name;
          }
          if($request->hasFile('medical_registration_certificate_file'))
          {
              $doctor_data['medical_registration_certificate'] = $medical_registration_file_name;
          }
          if($request->hasFile('pi_insurance_policy_file'))
          {
              $doctor_data['pi_insurance_policy']              = $pi_insurance_policy_file_name;
          }
          if($request->hasFile('cyber_liability_file'))
          {
              $doctor_data['cyber_liability_insurance_policy'] = $cyber_liability_file_name;
          }

          $res_doctor = $this->DoctorModel->where('user_id',$this->user_id)->update($doctor_data);
          if($res_doctor)
          {
            Session::flash('redirect_msg','Success! Profile updated successfully.');
            return redirect()->back();
          }
          else
          {
            Session::flash('redirect_msg','Error! Something went wrong.');
            return redirect()->back();
          }


    } // end update_official_documents_verification

    /*
    | Function  : Get all the doctor data
    | Author    : Deepak Arvind Salunke
    | Date      : 16/09/2017
    | Output    : Display all the data personalise profile data
    */

    public function personalise_your_profile_for_patients()
    {

        $get_user = $this->DoctorModel->where('user_id', $this->user_id)
                                      ->with('userinfo')
                                      ->first();
          
        if($get_user)
        {
          $this->arr_view_data['doctor_data'] = $get_user->toArray();
        }
        //dd($this->arr_view_data['doctor_data']);
        $this->arr_view_data['doc_profile_public']        = $this->doc_profile_public;
        $this->arr_view_data['doctor_profile_pic']        = $this->doc_profile_pic;
        $this->arr_view_data['doctor_profile_video']      = $this->doc_video;
        $this->arr_view_data['page_title']                = str_singular($this->module_title);
        $this->arr_view_data['module_url_path']           = $this->module_url_path;

        return view($this->module_view_folder.'.personalise_your_profile_for_patients',$this->arr_view_data);

    } // end personalise_your_profile_for_patients


    /*
    | Function  : get all the updated data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 18/09/2017
    | Output    : Success or Error
    */

    public function update_personalise_your_profile_for_patients(Request $request)
    {
        $arr_rules['about_me'] = "required";
        /* Encrypted Fields */
        $arr_rules['enc_about_me'] = "required";

        if($request->input('old_profile_image') == null)
        {
            $arr_rules['profile_pic_file'] = "required";
        }

        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            Session::flash('redirect_msg','Error! All the fields are mandatory.');
            return back()->withInput($request->all())->withErrors($validator);
        }


        $profile_file_name  = "";
        $video_file_name    = "";

        if($request->hasFile('profile_pic_file'))
        {
            $profile_pic_file   =   $request->file('profile_pic_file');

            if(isset($profile_pic_file) && sizeof($profile_pic_file)>0)
            {
                $extention  =   strtolower($profile_pic_file->getClientOriginalExtension());
                $valid_ext  =   ['jpg','jpeg','png','gif','bmp'];

                $arr_profile_pic = getimagesize($profile_pic_file);

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('image_type_error','Please upload valid image with valid extension i.e jpg, png, jpeg, bmp.');
                    return redirect()->back()->withInput($request->all());
                }
                else if($profile_pic_file->getClientSize() > 5000000)
                {
                    Session::flash('image_type_error','Please upload image with small size. Max size allowed is 5mb');
                    return redirect()->back()->withInput($request->all());
                }
                else if($arr_profile_pic[0] < 200 || $arr_profile_pic[1] < 190)
                {
                    Session::flash('image_type_error','Please upload image of size greater than 200 X 190 for better resolution.');
                    return redirect()->back()->withInput($request->all());
                }
                else
                {

                    @unlink($this->doc_profile_pic.$request->input('old_profile_pic_file'));
                    $profile_file_name      = $request->file('profile_pic_file');
                    $file_extension         = strtolower($request->file('profile_pic_file')->getClientOriginalExtension()); 
                    $profile_file_name      = sha1(uniqid().$profile_file_name.uniqid()).'.'.$file_extension;
                    $upload_result          = $request->file('profile_pic_file')->move($this->doc_profile_public, $profile_file_name);

                }
            }
            else
            {
                Session::flash('image_type_error','Please upload valid image.');
                return redirect()->back()->withInput($request->all());
            }
        }

         if($request->hasFile('intro_video_file'))
        {
            $intro_video_file   =   $request->file('intro_video_file');

            if(isset($intro_video_file) && sizeof($intro_video_file)>0)
            {
                $extention  =   strtolower($intro_video_file->getClientOriginalExtension());
                $valid_ext  =   ['mp4','ogg','webm'];

                if(!in_array($extention, $valid_ext))
                {
                    Session::flash('video_type_error','Please upload valid video with valid extension i.e mp4, ogg, webm');
                    return redirect()->back()->withInput($request->all());
                }
                else if($intro_video_file->getClientSize() > 5000000)
                {
                    Session::flash('video_type_error','Please upload video with small size. Max size allowed is 5mb');
                    return redirect()->back()->withInput($request->all());
                }
                else
                {
                    @unlink($this->doc_video.$request->input('old_intro_video_file'));
                    $video_file_name      = $request->file('intro_video_file');
                    $file_extension       = strtolower($request->file('intro_video_file')->getClientOriginalExtension()); 
                    $video_file_name      = sha1(uniqid().$video_file_name.uniqid()).'.'.$file_extension;
                    $upload_result        = $request->file('intro_video_file')->move($this->doc_video_public, $video_file_name);
                }
            }
            else
            {
                Session::flash('video_type_error','Please upload valid video.');
                return redirect()->back()->withInput($request->all());
            }
        }


        if($request->hasFile('profile_pic_file'))
        {
            $user_data['profile_image'] = $profile_file_name;

            $user = Sentinel::findById($this->user_id);
            if($user)
            {
              $user = Sentinel::update($user, $user_data);
            }
        }

        $doctor_data['about_me']      = $request->input('enc_about_me');

        if($request->hasFile('intro_video_file'))
        {
            $doctor_data['profile_video'] = $video_file_name;
        }

        $res_doctor = $this->DoctorModel->where('user_id', $this->user_id)->update($doctor_data);
        if($res_doctor)
        {
          Session::flash('redirect_msg','Success! Profile updated successfully.');
          return redirect()->back();
        }
        else
        {
          Session::flash('redirect_msg','Error! Something went wrong.');
          return redirect()->back();
        }

    } // end update_personalise_your_profile_for_patients

}
?>