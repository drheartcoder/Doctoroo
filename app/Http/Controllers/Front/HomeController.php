<?php //Seema
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\StaticPagesModel;
use App\Models\AdminProfileModel;
use App\Models\ContactEnquiryModel;

use App\Models\SiteSettingsModel;
use App\Models\SpecialityModel;
use App\Models\SocialLinksModel;

use App\Models\HowItWorksModel;
use App\Models\FaqsModel;
use App\Models\DynamicPagesModel;
use App\Models\DescriptionModel;
use App\Models\PricingTableModel;
use App\Models\PricingNoteModel;
use App\Models\PricingPlanModel;
use App\Models\DynamicAboutDoctorModel;
use App\Models\DynamicFaqModel;
use App\Models\AustraliaStatesModel;
use App\Models\PatientModel;
use App\Models\DoctorConsultationPriceModel;
use App\Models\ConsultationPriceModel;
use App\Models\MobileCountryCodeModel;

use Validator;
use Mail;
use Flash;
use URL;
use Sentinel;
use DateTime;
use DateTimeZone;
use DateInterval;

class HomeController extends Controller
{
    
    public function __construct(UserModel $users_model,StaticPagesModel $static,AdminProfileModel $profile,ContactEnquiryModel $contact,SiteSettingsModel $SiteSettings,SocialLinksModel $SocialLinksModel ,HowItWorksModel $howitwork,SpecialityModel $SpecialityModel, FaqsModel $faqsmodel,DynamicPagesModel $pages,DescriptionModel $desc,PricingTableModel $pricing,PricingNoteModel $note,PricingPlanModel $plan,DynamicAboutDoctorModel $aboutdoctor,DynamicFaqModel $dynamicfaq, AustraliaStatesModel $australiastates, PatientModel $PatientModel, DoctorConsultationPriceModel $doctorconsultationprice, ConsultationPriceModel $consultationprice, MobileCountryCodeModel $mob_country_code)
	{


        $this->arr_view_data = [];

        $this->UserModel                    = $users_model;
        $this->SiteSettingsModel            = $SiteSettings;
        $this->StaticPagesModel             = $static;
        $this->AdminProfileModel            = $profile;
        $this->ContactEnquiryModel          = $contact;
        $this->SpecialityModel              = $SpecialityModel;
        $this->SocialLinksModel             = $SocialLinksModel;
        $this->HowitWorksModel              = $howitwork;
        $this->FaqsModel                    = $faqsmodel;
        $this->DynamicPagesModel            = $pages;
        $this->DescriptionModel             = $desc;
        $this->PricingTableModel            = $pricing;
        $this->PricingNoteModel             = $note;
        $this->PricingPlanModel             = $plan;
        $this->DynamicAboutDoctorModel      = $aboutdoctor;
        $this->DynamicFaqModel              = $dynamicfaq;
        $this->AustraliaStatesModel         = $australiastates;
        $this->PatientModel                 = $PatientModel;
        $this->DoctorConsultationPriceModel = $doctorconsultationprice;
        $this->ConsultationPriceModel       = $consultationprice;
        $this->MobileCountryCodeModel       = $mob_country_code;

        $this->module_title                 = "Home";
        $this->module_view_folder           = "front.home";

    }

    public function coming_soon($ICareForYou=FALSE)
    {

        //dd($_SERVER['HTTP_USER_AGENT']);

        $this->arr_view_data['friend_referral_code'] = $this->arr_view_data['arr_user_details'] = $get_user_details = $user_details = '';

        if($ICareForYou != '')
        {
            // get user firend name whose this referral code belongs to
            $get_user_details = $this->PatientModel->with('userinfo')->where('my_referral_code', $ICareForYou)->first();
            $user_details = $get_user_details->toArray();
            if(count($user_details)>0)
            {
                $this->arr_view_data['arr_user_details'] = $user_details['userinfo']['first_name'];
            }   
            $this->arr_view_data['friend_referral_code'] = $ICareForYou;
        }

        $get_states = $this->AustraliaStatesModel->where('status', '1')->orderBy('id', 'DESC')->get();
        if(isset($get_states) && (count($get_states)>0) )
        {
            $this->arr_view_data['get_states'] = $get_states->toArray();
        }

        /*$get_mobcode = $this->MobileCountryCodeModel->orderBy('nicename', 'ASC')->where('phonecode','!=',0)->get();
        if(isset($get_mobcode) && (count($get_mobcode)>0) )
        {
            $this->arr_view_data['mobcode_data'] = $get_mobcode->toArray();
        }*/

        // for seo 
        $this->arr_view_data['title']               = "Online Doctor 24/7 | Doctor Consultation | Dr Online | Droo";
        $this->arr_view_data['keyword']             = "Doctors Online, Online Doctor, Online Dr, Dr Online, Doctoroo, quick consultation, Online Doctor 24/7";
        $this->arr_view_data['description']         = "Find doctors online in Australia to book Dr online for quick consultation, prescription order, referral request in the convenient way. See doctor 24/7 hour.";

        $this->arr_view_data['user_type']  = 'patient';
        $this->arr_view_data['page_title'] = "Coming Soon";
        return view($this->module_view_folder.".coming_soon",$this->arr_view_data);
    }

    public function icareforyou($ICareForYou=FALSE)
    {

        $this->arr_view_data['friend_referral_code'] = $this->arr_view_data['arr_user_details'] = $get_user_details = $user_details = '';

        if($ICareForYou != '')
        {
            // get user firend name whose this referral code belongs to
            $get_user_details = $this->PatientModel->with('userinfo')->where('my_referral_code', $ICareForYou)->first();
            $user_details = $get_user_details->toArray();
            if(count($user_details)>0)
            {
                $this->arr_view_data['arr_user_details'] = $user_details['userinfo']['first_name'];
            }   
            $this->arr_view_data['friend_referral_code'] = $ICareForYou;
        }

        $get_states = $this->AustraliaStatesModel->where('status', '1')->orderBy('id', 'DESC')->get();
        if(isset($get_states) && (count($get_states)>0) )
        {
            $this->arr_view_data['get_states'] = $get_states->toArray();
        }

        /*$get_mobcode = $this->MobileCountryCodeModel->orderBy('nicename', 'ASC')->where('phonecode','!=',0)->get();
        if(isset($get_mobcode) && (count($get_mobcode)>0) )
        {
            $this->arr_view_data['mobcode_data'] = $get_mobcode->toArray();
        }*/

        // for seo 
        $this->arr_view_data['title']               = "Online Doctor 24/7 | Doctor Consultation | Dr Online | Droo";
        $this->arr_view_data['keyword']             = "Doctors Online, Online Doctor, Online Dr, Dr Online, Doctoroo, quick consultation, Online Doctor 24/7";
        $this->arr_view_data['description']         = "Find doctors online in Australia to book Dr online for quick consultation, prescription order, referral request in the convenient way. See doctor 24/7 hour.";

        $this->arr_view_data['page_title'] = "I Care For You";
        return view($this->module_view_folder.".coming_soon",$this->arr_view_data);
    }

    public function index()
    { 
         /*$slug  = URL::current();
        $page_slug = basename($slug);*/
        $site_records  = $this->SiteSettingsModel->get();
        if(isset($site_records) && count($site_records))
        {
            $site_rec                      = $site_records->toArray();
            if($site_rec[0]['site_status']=='0')
            {
                return view('front.home.coming-soon');
            }
            else
            {
                $speciality = $this->SpecialityModel->where('speciality_status','Active')->orderBy('id', 'DESC')->take(12)->get();
                if(isset($speciality) && (count($speciality)>0))
                {
                    $this->arr_view_data['speciality'] = $speciality->toArray();
                }
                $social_links = $this->SocialLinksModel->where('id',1)->first();
                if(isset($social_links) && count($social_links)>0)
                {
                    $this->arr_view_data['social_links'] = $social_links->toArray();
                }

               /* $dynamic_info = $this->StaticPagesModel->get();
              
                if($dynamic_info!=FALSE)
                {
                    $this->arr_view_data['dynamic_info'] = $dynamic_info->toArray();
                }*/



                $this->arr_view_data['page_title']      = $this->module_title;
                return view($this->module_view_folder.'.index',$this->arr_view_data);                
            }     
        }
    }

    public function static_page_info($page_slug=FALSE)
    {
        if($page_slug)
        {
            $page_info = $this->StaticPagesModel->where('page_slug',$page_slug)->where('page_status','Active')->first();

            if($page_info!=FALSE)
            {

               $info = $page_info->toArray();
                
               if(isset($info) && sizeof($info)>0) 
               {
                    $this->arr_view_data['page_title'] = isset($info['page_name'])?$info['page_name']:'';
                    $this->arr_view_data['info']       = $info;
                    if($page_slug=='about-us')
                    {
                        $arr_data = $this->HowitWorksModel->get();

                        if($arr_data!=FALSE)
                        {
                            $result = $arr_data->toArray();
                            if(isset($result) && sizeof($result)>0)
                            {
                                $this->arr_view_data['arr_data'] = $result;
                            }
                        }

                        // for seo 
                        $this->arr_view_data['title']               = isset($info['meta_title'])?$info['meta_title']:'';
                        $this->arr_view_data['description']         = isset($info['meta_desc'])?$info['meta_desc']:'';
                        
                        return view($this->module_view_folder.'.about-us',$this->arr_view_data);
                    }    
               }            
            }
            else
            {
                return redirect()->back();
            }
            
        }
        
        return redirect()->back();
    }

    public function contact_us()
    {
        $this->arr_view_data['page_title'] = 'Contact Us';

        $contact_info = $this->AdminProfileModel->where('user_id',1)->first();

        if($contact_info!=FALSE)
        {
            $info_arr = $contact_info->toArray();

            if(isset($info_arr) && sizeof($info_arr)>0)
            {

                $this->arr_view_data['contact_info']  = $info_arr; 
                return view($this->module_view_folder.'.contact-us',$this->arr_view_data);        
            }
        }
    }

    public function store(Request $request)
    {
        $this->arr_view_data['page_title'] = 'Contact Us';

        $arr_rules = array();

        $arr_rules['name']     = 'required';
        $arr_rules['email_id'] = 'required|email';
        $arr_rules['phone_no'] = 'required|min:6';
        $arr_rules['message']  = 'required';

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all();

        $arr_data['name']        = $form_data['name'];
        $arr_data['phone_no']    = $form_data['phone_no'];
        $arr_data['email']       = $form_data['email_id'];
        $arr_data['message']     = $form_data['message'];

        $enquiry    = $this->ContactEnquiryModel->create($arr_data);

        if($enquiry)
        {
            $arr_admin = array();
            $obj_admin =  $this->AdminProfileModel->where('user_id','1')->with(['user_details'])->first();


            if($obj_admin!=FALSE)
            {
                $arr_admin = $obj_admin->toArray();
            }

            $data = array();
            $to_email_id  = isset($arr_admin['contact_email'])?$arr_admin['contact_email']:config('app.project.support_mail');
            
            $project_name = config('app.project.name');
            $mail_subject = 'New Contact Enquiry';
            $mail_form    = isset($arr_admin['contact_email'])?$arr_admin['contact_email']:config('app.project.support_mail');
           
            $arr_data['enquiry_message'] = $form_data['message'];
            $data = $arr_data;

            Mail::send('front.email.new_contact_enquiry', $data, function ($message) use ($to_email_id,$mail_form,$project_name,$mail_subject) 
                  {
                          $message->from($mail_form, $project_name);
                          $message->subject($project_name.' : '.$mail_subject);
                          $message->to($to_email_id);

                  });   
            Flash::success('Your Enquiry Send Successfully.');
        }   
        else
        {
            Flash::error('Problem Occured While Sending Enquiry.');
        }

        return redirect()->back();
    }

    public function about_us()
    {
        return view($this->module_view_folder.'.about_us');
    }

    public function pharmacy()
    {
        return view($this->module_view_folder.'.pharmacy_business');
    }
    public function pricing($page_slug=null)
    {   $slug  = URL::current();
        $page_slug = basename($slug);
       
        if($page_slug)
        {
            $this->arr_view_data['page_title'] = 'Pricing';
            $info       = $this->StaticPagesModel->where('page_slug',$page_slug)->first();
            $arr_info   = $this->PricingNoteModel->limit(10)->get();
            $arr_desc   = $this->PricingPlanModel->where('id','1')->first();
            $arr_table  = $this->PricingTableModel->limit(10)->get();
             //dd($arr_info);
            if($info!=FALSE)
            {
                $arr = $info->toArray();
                
                $pricingnote    = $arr_info->toArray();
                $pricingtable   = $arr_table->toArray();
                $pricingdesc    = $arr_desc->toArray();
                 //dd($pricingdesc);
                if(isset($arr) && sizeof($arr)>0)
                {
                    $this->arr_view_data['info']                = $arr;
                    $this->arr_view_data['pricingnote']         = $pricingnote;
                    $this->arr_view_data['pricing']             = $pricingtable;
                    $this->arr_view_data['pricingdata']         = $pricingdesc;

                    // for seo 
                    $this->arr_view_data['title']               = "Pricing Plans - Australia Most Affordable Doctoroo";
                    $this->arr_view_data['description']         = "Doctoroo the Australia's most affordable online doctor consulation platforms helps you to save time and money. Visit today to know the pricing plans.";

                    return view($this->module_view_folder.'.pricing',$this->arr_view_data);
                }
            }
        }
        //return view($this->module_view_folder.'.pricing');
    }
    public function dynamic($page_slug=null)
    {
        $this->arr_view_data['page_title'] = 'Dynamic';
        if(isset($page_slug) && $page_slug!=null)
        {
            $dynamic_info = $this->StaticPagesModel->where('page_slug',$page_slug)->first();

            if($dynamic_info!=FALSE)
            {
                $info_arr = $dynamic_info->toArray();
                if(isset($info_arr) && sizeof($info_arr)>0)
                {

                    $this->arr_view_data['dynamic_info']  = $info_arr; 
                    $this->arr_view_data['info']  = $info_arr;
                    //dd($this->arr_view_data['info']);
                    return view($this->module_view_folder.'.dynamic',$this->arr_view_data);        
                }
            }


        }
        return redirect()->back();
    }
    
    public function pages($page_slug=FALSE)
    { 
        $slug  = URL::current();
        $page_slug = basename($slug);

        if($page_slug)
        {
            $this->arr_view_data['page_title'] = 'Pages';
            $info =  $this->DynamicPagesModel->with(['descriptioninfo','aboutinfo','dynamicfaq'])->where('page_slug',$page_slug)->first();
           
            $faqs_info = $this->FaqsModel->where('status','Active')->limit(10)->get();
            $this->arr_view_data['faq_info'] = array();
            $arr_info = $this->PricingTableModel->limit(10)->get();
            /*$dynamicfaq = $this->DynamicFaqModel->get();*/
           
            if($info!=FALSE)
            {
                $arr = $info->toArray();
                $info_arr = $faqs_info->toArray();
                $pricing = $arr_info->toArray();
                if(isset($arr) && sizeof($arr)>0)
                {
                    $this->arr_view_data['page_title'] = $arr['page_title'];
                    $this->arr_view_data['info']     = $arr;
                    $this->arr_view_data['faq']      = $info_arr; 
                    $this->arr_view_data['pricing']  = $pricing;

                    // for seo 
                    //$this->arr_view_data['title']               = "Frequently Asked Questions | Doctoroo";
                    //$this->arr_view_data['description']         = "Common questions and answers about our online medical advice services, contact to doctoroo.com.au";

                    // for seo 
                    $this->arr_view_data['title']               = $info['meta_title'];
                    $this->arr_view_data['keyword']             = $info['meta_keyword'];
                    $this->arr_view_data['description']         = $info['meta_desc'];

                    if($info['footer_dynamic']=="yes") 
                    {
                      return view($this->module_view_folder.'.dynamicpage',$this->arr_view_data); 
                    }
                    else
                    {
                      return view($this->module_view_folder.'.pagedescription',$this->arr_view_data);
                    }        
                }
            }
        }
    }
    
    /*--------------------Ankit Aher--------------------------------*/
    public function faqs()
    {
        $this->arr_view_data['page_title'] = 'FAQs';
        $faqs_info = $this->FaqsModel->where('category_id', '7')->where('status','Active')->get();
        $this->arr_view_data['faq_info'] = array();

        if($faqs_info!=FALSE)
        {
            $info_arr = $faqs_info->toArray();
            if(isset($info_arr) && sizeof($info_arr)>0)
            {
                $this->arr_view_data['faq_info']  = $info_arr;
            }
        }

        // for seo 
        $this->arr_view_data['title']               = "Frequently Asked Questions | Doctoroo";
        $this->arr_view_data['description']         = "Common questions and answers about our online medical advice services, contact to doctoroo.com.au";

        return view($this->module_view_folder.'.faqs',$this->arr_view_data);     
    }

    /*
    | Function  : Get all the doctor consultation price
    | Author    : Deepak Arvind Salunke
    | Date      : 27/07/2017
    | Output    : Show all the doctor faqs
    */
    
    public function doctor_faqs()
    {
        $doc_consult_arr = $this->DoctorConsultationPriceModel->get();
        if($doc_consult_arr)
        {
            $this->arr_view_data['doc_consult'] = $doc_consult_arr->toArray();
        }

        $patient_consult_arr = $this->ConsultationPriceModel->where('doctor_day_fee', 0)
                                                            ->where('day_profit', 0)
                                                            ->where('doctor_night_fee', 0)
                                                            ->where('night_profit', 0)
                                                            ->get();
        if($patient_consult_arr)
        {
            $this->arr_view_data['patient_consult'] = $patient_consult_arr->toArray();
        }
        //dd($this->arr_view_data['patient_consult']);

        $this->arr_view_data['page_title']      = "Doctor FAQ's";

        return view($this->module_view_folder.'.doctor_faqs',$this->arr_view_data);
    } // end doctor_faqs

}