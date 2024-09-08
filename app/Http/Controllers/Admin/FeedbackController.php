<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FeedbackModel;
use Sentinel;
use Flash;
use Validator;

class FeedbackController extends Controller
{
    public function __construct(FeedbackModel $FeedbackModel)
    {
    	$this->FeedbackModel      =  $FeedbackModel;
    	$this->arr_view_data      =  [];
    	$this->module_url_path    =  url(config('app.project.admin_panel_slug').'/feedback');
    	$this->module_title       =  'Feedbacks';
    	$this->module_view_folder =  'admin.feedback';
    	$this->admin_panel_slug   =   config('app.project.admin_panel_slug');
	}

	public function index()
	{
		$this->arr_view_data['page_title'] = str_singular($this->module_title);
		$arr_feedbacks 					   = array();
		$user 							   = Sentinel::check();
		if($user)
		{
			if($user->inRole('admin'))
			{
				$arr_feedbacks 			   			= $this->FeedbackModel->with(['user_details'])->orderBy('feedback_id','DESC')->get();
				if(isset($arr_feedbacks) && count($arr_feedbacks)>0)
				{
					$this->arr_view_data['arr_feedbacks'] 	= $arr_feedbacks->toArray();
				}
				$this->arr_view_data['module_url_path'] = $this->module_url_path;
				$this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/index',$this->arr_view_data);
			}
			else
			{
				Flash::error("You don't have sufficient privileges.");
				redirect($this->admin_panel_slug.'/login');
			}
		}
		else
		{
			Flash::error("Please login to your account.");
			redirect($this->admin_panel_slug.'/login');
		}
	}

	public function delete($enc_id=FALSE)
	{
		if($enc_id)
		{
			$feedback_id   	= base64_decode($enc_id);
			$feedback_rec   = $this->FeedbackModel->where('feedback_id',$feedback_id)->first();
			if(isset($feedback_rec) && sizeof($feedback_rec)>0)
			{
				$status 	= $feedback_rec->delete();
				if($status)
				{
					 Flash::success("Feedback deleted successfully.");
				}
				else
				{
					FLash::error("Error while deleting record.");
				}
			}
			else
			{
				Flash::error("Sorry,invalid request.");
			}
		}
		else
		{
			Flash::error("Sorry,invalid request");
		}
		return redirect()->back();
	}

	public function changeStatus($enc_id=FALSE,$status=FALSE)
	{
	  if($enc_id && $status)
	  {
	  	$feedback_id 		=  base64_decode($enc_id);
	  	$feedback_rec 		=  $this->FeedbackModel->where('feedback_id',$feedback_id);
	  	if(isset($feedback_id) && sizeof($feedback_id))
	  	{
	  		$status 		=  $feedback_rec->update(['status'=>$status]);
	  		if($status)
	  		{
	  			Flash::success("Status changed successfully.");
	  		}
	  		else
		  	{
		  		Flash::error("Error while changing status.");
		  	}
	  	}
	  	else
	  	{
	  		Flash::error("Sorry..Invalid request.");
	  	}
	  }
	  else
	  {
	  	Flash::error("Sorry..Invalid request.");
	  }
	  return redirect()->back();

	}

	public function multi_action(Request $request)
	{

		$arr_rules 	   			    = array();
		$arr_rules['multi_action']  = "required";
		$arr_rules['checked_record']= "required";
		$validator 					= Validator::make($request->all(),$arr_rules);
		if($validator->fails())
		{
			Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
		}

		$multi_action 				= $request->input("multi_action");
		$checked_record 			= $request->input("checked_record");

		if(is_array($checked_record) && sizeof($checked_record)<=0)
		{
			Flash::error("Problem occur while doing multi action.");
			return redirect()->back();
		}
		foreach($checked_record as $record)
		{
			$feedback_id = base64_decode($record);
			$feedback_rec = $this->FeedbackModel->where('feedback_id',$feedback_id)->first();
			if($multi_action=='activate')
			{
				if(isset($feedback_rec) && sizeof($feedback_rec)>0)
				{
					$status   = $feedback_rec->update(['status'=>'Active']);
					if($status)
					{
						Flash::success("Record(s) status activated successfully.");
					}
					else
					{
						Flash::error("Error while changing status.");
					}
				}
				else
				{
					Flash::error("Sorry..!Invalid request.");

				}

			}
			else if($multi_action == 'deactivate')
			{
				if(isset($feedback_rec) && sizeof($feedback_rec)>0)
				{
					$status 	= $feedback_rec->update(['status'=>'Block']);
					if($status)
					{
						Flash::success("Record(s) status deactivated successfully.");
					}
					else
					{
						Flash::error("Error while changing status.");
					}
				}
				else
				{
					Flash::error("Sorry..!Invalid request.");
				}

			}
			else if($multi_action == 'delete')
			{
				if(isset($feedback_rec) && sizeof($feedback_rec)>0)
				{
					$status       =  $feedback_rec->delete();
					if($status)
					{
						Flash::success("Record(s) deleted successfully.");
					}
					else
					{
						Flash::error("Error while deleting records.");
					}
				}
			}
		}
		return redirect()->back();
	}
 
}
