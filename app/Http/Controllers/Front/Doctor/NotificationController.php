<?php
namespace App\Http\Controllers\Front\Doctor;
use App\Models\UserModel;
use App\Models\NotificationModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;

class NotificationController extends Controller
{
    public function __construct(
                                  UserModel           $user_model,
                                  NotificationModel   $NotificationModel
                                )
    {
        $this->arr_view_data                    = [];
        $this->UserModel                        = $user_model;
        $this->NotificationModel                = $NotificationModel;
      	$this->module_view_folder               = 'front.doctor.profile';
        $this->module_url_path                  = url('/').'/doctor/profile';
        $this->ahpra_certificate_base_path      = public_path().config('app.project.img_path.AHPRA_certificate');
        $this->driver_licence_base_path         = public_path().config('app.project.img_path.drivers_licence');
        $this->telehealth_certificate_base_path = public_path().config('app.project.img_path.telehealth_certificate');
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
    }

    public function index()
    {  
      $notification=$this->NotificationModel->where('to_user_id',$this->user_id)
                         ->orderBy('id','DESC')
                         ->with('user_details','booking_details')
                         ->paginate(10);

      if($notification)
      {
       $this->arr_view_data['paginate']                   = clone $notification;
       $this->arr_view_data['notification_arr']           = $notification->toArray();

       $this->NotificationModel->where('to_user_id',$this->user_id)
                               ->update(['status'=>'read']);

      }

      $this->arr_view_data['module_url_path'] = '';
      return view('front.doctor.notification.notification')->with($this->arr_view_data);
    }   
}
?>