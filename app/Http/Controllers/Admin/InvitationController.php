<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\RegularDoctorModel;
use App\Models\UserModel;
use App\Models\DoctorInvitationModel;
use App\Models\PharmacyInvitationModel;
use App\Models\PatientInvitationModel;
use Validator;
use Flash;
use Sentinel;
use Session;

class InvitationController extends Controller
{
     public function __construct(RegularDoctorModel $regulardoctor,UserModel $user, DoctorInvitationModel $invitation,PharmacyInvitationModel           $pharmacy_invt_model, PatientInvitationModel $PatientInvitationModel)
    {
        $this->RegularDoctorModel      = $regulardoctor;
        $this->UserModel               = $user;
        $this->DoctorInvitationModel   = $invitation;
        $this->pharmacy_invt_model     = $pharmacy_invt_model;
        $this->PatientInvitationModel  = $PatientInvitationModel;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/invitation");
        $this->module_title            = "Invitation";
        $this->module_view_folder      = "admin.invitation";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }


    public function doctor_invitation()
     {
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
               $arr_manage=$this->DoctorInvitationModel->where('invite_this_doctor',1)
                                                       ->orderBy('id' ,'desc')
                                                       ->with('userinfo')
                                                       ->get();                                          

                if($arr_manage!=FALSE)
                {
                    $arr_invitation = $arr_manage->toArray(); 
                }
   
                $this->arr_view_data['arr_data']        = $arr_invitation;               
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/doctor',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function doctor_invitation_delete($enc_id=FALSE)
    {     
        if($enc_id)
        {
            $id = base64_decode($enc_id);
          
            $deleteinvitation =    $this->DoctorInvitationModel->where('id',$id)->delete();
                
            if($deleteinvitation)
                {
                   
                    Flash::success('Doctor invitation deleted successfully.');
                }
                else
                {
                   
                    Flash::error('Problem Occured, While Deleting Doctor.');
                }
        }
        else
        {
            Flash::error('Invalid Request.');
        }
        
        return redirect()->back();
    }

    public function doctor_multi_action(Request $request)
    {      

        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {    
                $deleteuser= $this->DoctorInvitationModel->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    Flash::success('Doctor Invitation\'s deleted successfully.'); 
                }            
            } 
        
        }
                    
       return redirect()->back();
    }

    public function pharmacy_invitation()
     {
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
               $arr_manage=$this->pharmacy_invt_model->orderBy('id' ,'desc')
                                                       ->with('userinfo')
                                                       ->get();                                          

                if($arr_manage!=FALSE)
                {
                    $arr_invitation = $arr_manage->toArray(); 
                }
   
                $this->arr_view_data['arr_data']        = $arr_invitation;               
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/pharmacy',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function pharmacy_invitation_delete($enc_id=FALSE)
    {     
        if($enc_id)
        {
            $id = base64_decode($enc_id);
          
            $deleteinvitation =    $this->pharmacy_invt_model->where('id',$id)->delete();
                
            if($deleteinvitation)
                {
                   
                    Flash::success('Pharmacy invitation deleted successfully.');
                }
                else
                {
                   
                    Flash::error('Problem Occured, While Deleting invitation.');
                }
        }
        else
        {
            Flash::error('Invalid Request.');
        }
        
        return redirect()->back();
    }
    
    public function pharmacy_multi_action(Request $request)
    {      

        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {    
                $deleteuser= $this->pharmacy_invt_model->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    Flash::success('Pharmacy Invitation\'s deleted successfully.'); 
                }            
            } 
        
        }
                    
       return redirect()->back();
    }    

    public function patient_invitation()
     {
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
               $arr_manage=$this->PatientInvitationModel->orderBy('id' ,'desc')
                                                        ->with('userinfo')
                                                        ->get();                                          

                if($arr_manage!=FALSE)
                {
                    $arr_invitation = $arr_manage->toArray(); 
                }
   
                $this->arr_view_data['arr_data']        = $arr_invitation;               
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/patient',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function patient_invitation_delete($enc_id=FALSE)
    {     
        if($enc_id)
        {
            $id = base64_decode($enc_id);
          
            $deleteinvitation =    $this->PatientInvitationModel->where('id',$id)->delete();
                
            if($deleteinvitation)
                {
                   
                    Flash::success('Patient\'s invitation deleted successfully.');
                }
                else
                {
                   
                    Flash::error('Problem Occured, While Deleting invitation.');
                }
        }
        else
        {
            Flash::error('Invalid Request.');
        }
        
        return redirect()->back();
    }

    public function patient_multi_action(Request $request)
    {      

        $arr_rules = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {    
                $deleteuser= $this->PatientInvitationModel->where('id',$record_id)->delete();
                if($deleteuser)
                {
                    Flash::success('Patient\'s invitation(s) deleted successfully.'); 
                }            
            } 
        
        }
                    
       return redirect()->back();
    }
        
}