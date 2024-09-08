<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ContactEnquiryModel;
use App\Models\AdminProfileModel;
use Sentinel;
use Flash;
use Session;
use Validator;
use Mail;

class ContactEnquiryController extends Controller
{
	public function __construct(ContactEnquiryModel  $ContactEnquiry,AdminProfileModel $AdminProfile)
	{
		$this->ContactEnquiryModel = $ContactEnquiry;
		$this->AdminProfileModel   = $AdminProfile;	
		$this->arr_view_data       = [];
        $this->module_url_path     = url(config('app.project.admin_panel_slug')."/ContactEnquiry");
		$this->module_title        = "Manage Contact Enquiry";
		$this->module_view_folder  = "admin.contactenquiry";
        $this->admin_panel_slug    = config('app.project.admin_panel_slug');
    }
    public function index()
    {
		$this->arr_view_data['page_title'] = str_singular($this->module_title);
    	$arr_contact_enquiry 			   = array();
    	$user 							   = Sentinel::check();
    	if($user)
    	{
    		if($user->inRole('admin'))
     		{
     			
    			$arr_contact = $this->ContactEnquiryModel->get();
    			if($arr_contact!=FALSE)
    			{
    				$arr_contact_enquiry 					= $arr_contact->toArray();
    				$this->arr_view_data['arr_data'] 		= $arr_contact_enquiry;
    				$this->arr_view_data['module_url_path'] = $this->module_url_path;
    				$this->arr_view_data['module_title'] 	= $this->module_title;
    				return view($this->module_view_folder.'/index',$this->arr_view_data);

				}
    		}
    		else
    		{
    			Flash::error("You dont have sufficient privileges to access.");
    			redirect($this->admin_panel_slug.'/login');	
    		}

    	} 
    	else
    	{
    		Flash::error("Please login to your account.");
    		redirect($this->admin_panel_slug.'/login');

    	}
    }

    public function delete($enc_id=false)
    {
    	if($enc_id)
    	{
    		$id 				= base64_decode($enc_id);
    		$contact_details	= $this->ContactEnquiryModel->where('id',$id)->first();
    		if(isset($contact_details) && $contact_details)
    		{
    			$status 		= $contact_details->delete();
    			if($status)
    			{
    				flash::success("Record deleted successfully.");
    			}
    			else
    			{
    				flash::error("Error while deleting record.");
    			}
    		}
    		else
    		{
    			flash::error("Sorry..!No records found.");
    		}
    	}
    	else
    	{
    		Flash::error("Sorry..!Invalid request.");
    	}
    	return redirect()->back();
    }
    public function reply($enc_id)
    {
    	$arr_data 									= array();
    	if($enc_id)
    	{
    		$contact_id 							= base64_decode($enc_id); 
    		$user_rec 								= $this->ContactEnquiryModel->where('id',$contact_id)->first();
    		if(isset($user_rec) && count($user_rec)>0)
    		{
    			$this->arr_view_data['arr_data'] 	= $user_rec->toArray();	
    		}
    		$this->arr_view_data['module_url_path'] = $this->module_url_path;
			$this->arr_view_data['module_title'] 	= $this->module_title;
			$this->arr_view_data['page_title']		= "Reply";
			return view($this->module_view_folder.'/reply',$this->arr_view_data);
		}
	}
	public function view($enc_id=FALSE)
	{
		if($enc_id)
		{
			$contact_id 				            =  base64_decode($enc_id);
			$contact_rec 				            =  $this->ContactEnquiryModel->where('id',$contact_id)->first();
			$this->arr_view_data['arr_data']        =  $contact_rec->toArray();
			$this->arr_view_data['module_url_path'] = $this->module_url_path;
			$this->arr_view_data['module_title'] 	= $this->module_title;
			$this->arr_view_data['page_title']		= "View Details";
			return view($this->module_view_folder.'/view',$this->arr_view_data);

		}

	}
	public function send(Request $request)
	{
		$arr_rules = array();
		$arr_rules['email']  	=  "required";
		$arr_rules['message']	=  "required";
		$validator 				=  Validator::make($request->all(),$arr_rules);
		$admin_rec 				= $this->AdminProfileModel->first();
		if(isset($admin_rec))
		{
			$rec 			    = $admin_rec->toArray();
			$email_from 		= $rec['contact_email'];
		}
		
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}
		   $email 						= $request->input('email');
		   $message 					= $request->input('message');
		   $data 						= array();
           $to_email_id			 		= isset($email)?$email:config('app.project.support_mail');
           $project_name 				= config('app.project.name');
           $mail_subject		 		= 'Contact enquiry response';
           $mail_form 		    		= isset($email_from)?$email_from:config('app.project.support_mail');
         
           $contact_person 				= $this->ContactEnquiryModel->where('email',$email)->first();
           if(isset($contact_person) && count($contact_person))
           {
           	  $person_details 			= $contact_person->toArray();
           	  $data['name'] 			= $person_details['name'];
		   }

           $data['to_email_id'] 		= $to_email_id;
           $data['project_name']		= $project_name;
           $data['response_message']    = $message;


           Mail::send('admin.email.contact_enquiry_response', $data, function ($message) use ($to_email_id,$mail_form,$project_name,$mail_subject) 
                  {
                          $message->from($mail_form, $project_name);
                          $message->subject($project_name.' : '.$mail_subject);
                          $message->to($to_email_id);

                  });   
          Flash::success('Contact enquiry response send successfully.');
          return redirect()->back();
    }




    public function multi_action(Request $request)
    {
    	$arr_rules 					= array();
    	$arr_rules['multi_action']  = "required";
    	$arr_rules['checked_record']= "required";

    	$validator 					= Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		  Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
              return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}
    	$multi_action 	= $request->input("multi_action");
    	$checked_record = $request->input("checked_record");

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        
        foreach($checked_record as $key=>$record_id)
        {
        	$record_id 	=  base64_decode($record_id);
        	if($multi_action=="delete")
        	{
        		$result  =  $this->ContactEnquiryModel->where('id',$record_id)->first();
        		if(isset($result) && count($result)>0)
        		{
        			$record_del = $result->delete();
        			if($record_del)
        			{
        				Flash::success("Record(s) deleted successfully.");
        			}
        			else
        			{
        				Flash::error("Error while deleting record.");
        			}
        		}
        	} 
        }
        return redirect()->back();

    }
}
