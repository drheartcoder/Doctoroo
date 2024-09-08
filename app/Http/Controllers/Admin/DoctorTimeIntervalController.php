<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Common\Services\EmailService;

use App\Models\DoctorTimeIntervalModel;

use Validator;
use Flash;
use Sentinel;
use Session;
use Activation;
use URL;
use Paginator;
use DateTime;

class DoctorTimeIntervalController extends Controller
{
     public function __construct(DoctorTimeIntervalModel $DoctorTimeIntervalModel )
    {
        
        $this->DoctorTimeIntervalModel          = $DoctorTimeIntervalModel;
        $this->arr_view_data                    = [];
        $this->module_url_path                  = url(config('app.project.admin_panel_slug')."/doctor/time_interval");
        $this->module_title                     = "Doctor Time Interval";
        $this->module_view_folder               = "admin.time_interval";
        $this->base_path                        = base_path().'/public';
        $this->admin_panel_slug                 = config('app.project.admin_panel_slug');
        $this->ahpra_certificate_base_path      = public_path().config('app.project.img_path.AHPRA_certificate');
        $this->driver_licence_base_path         = public_path().config('app.project.img_path.drivers_licence');
        $this->telehealth_certificate_base_path = public_path().config('app.project.img_path.telehealth_certificate');
        $this->video_base_path                  = public_path().config('app.project.img_path.doctor_video');
        $this->video_public_path                = url('/public').config('app.project.img_path.doctor_video');
    }

     public function index()
     {
        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $time_interval = $this->DoctorTimeIntervalModel->first();

                if(isset($time_interval))
                {
                    $this->arr_view_data['time_interval_arr'] = $time_interval->toArray();
                }
            }
        }

        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = 'Doctor Time Interval';

        return view($this->module_view_folder.'/index',$this->arr_view_data);
    }

    public function edit(Request $request)
    {
        if(isset($request->time_interval))
        {
            $res = $this->DoctorTimeIntervalModel->where('id','1')
                                                 ->update(['time_interval' => $request->time_interval]);

            if($res)
            {
                Flash::success("Time interval updated successfully."); 
                return redirect()->back(); 
            } 
            else
            {
                Flash::error("Problem Occured, While updating time interval."); 
                return redirect()->back(); 
            }
        }
        else
        {
          Flash::error("Problem Occured, While updating time interval."); 
          return redirect()->back();   
        }
    }
}   

