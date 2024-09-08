<?php
namespace App\Http\Controllers\Front\Doctor;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PatientConsultationBookingModel;
use App\Models\InvoiceModel;
use App\Models\AdminProfileModel;
use App\Models\DoctorModel;
use App\Models\DoctorCouponModel;
use App\Models\PatientModel;
use App\Models\ShareDiscountCodeModel;
use App\Models\PatientConsultationPaymentModel;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
Use Validator;
use Session;
use PDF;

class BillingController extends Controller
{
    public function __construct(PatientConsultationBookingModel  $consultation_model,
                                InvoiceModel                     $invoice,
                                AdminProfileModel                $admin_info,
                                DoctorModel                      $doctor,
                                DoctorCouponModel                $doctor_coupon,
                                PatientModel                     $patient_model,
                                ShareDiscountCodeModel           $ShareDiscountCodeModel,
                                PatientConsultationPaymentModel  $PatientConsultationPaymentModel
                                )
    {

        $this->arr_view_data                    = [];
        $this->PatientConsultationBookingModel  = $consultation_model;
        $this->InvoiceModel                     = $invoice;
        $this->AdminProfileModel                = $admin_info;
        $this->DoctorModel                      = $doctor;
        $this->DoctorCouponModel                = $doctor_coupon;
        $this->PatientModel                     = $patient_model;
        $this->ShareDiscountCodeModel           = $ShareDiscountCodeModel;
        $this->PatientConsultationPaymentModel  = $PatientConsultationPaymentModel;
      
        $this->module_url_path                  = url('/').'/doctor/billing';
        $this->module_membership_path           = url('/').'/doctor/patients/membersip';
        $this->module_view_folder               = 'front.doctor.billing';
        $this->patient_base_img_path            = public_path().config('app.project.img_path.patient');
        $this->patient_public_img_path          = url('/public').config('app.project.img_path.patient');

        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }
      
        $this->arr_view_data['page_title']              = "Memership";
    }
    
    public function index()
    {  
        $arr_bill = [];

        $get_invoice_data = $this->PatientConsultationPaymentModel->where('doctor_id', $this->user_id)
                                                                  ->with(['user_data', 'patient_data', 'doctor_user_data', 'consultation_details'])
                                                                  //->groupBy('booking_id')
                                                                  ->orderBy('id', "DESC")
                                                                  ->paginate(10);
        if($get_invoice_data)
        {
          $this->arr_view_data['paginate']      = clone $get_invoice_data;
          $this->arr_view_data['invoice_data']  = $get_invoice_data->toArray();
        }
        
        $this->arr_view_data['profile_image_public_img_path']      = $this->patient_public_img_path;      
        $this->arr_view_data['profile_image_base_img_path']        = $this->patient_base_img_path;        

        return view($this->module_view_folder.'.consultation_invoice_list',$this->arr_view_data);
    }

   public function consultation_invoice($enc_id)
    {  
        $arr_bill = [];
        $id = base64_decode($enc_id);
        
        $get_invoice_data = $this->PatientConsultationPaymentModel->where('booking_id', $id)
                                                                  ->with(['user_data', 'patient_data', 'doctor_user_data', 'consultation_details'])
                                                                  ->get();
        if($get_invoice_data)
        {
            $this->arr_view_data['invoice_data'] = $get_invoice_data->toArray();
        }

        $obj_admin = $this->AdminProfileModel->first();
        if($obj_admin)
        {
          $arr_admin = $obj_admin->toArray();
        }

        $this->arr_view_data['doctor_id']     = $this->user_id;
        $this->arr_view_data['arr_admin']   = $arr_admin;
        $this->arr_view_data['enc_booking_id'] = $enc_id;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        return view($this->module_view_folder.'.consultation_invoice',$this->arr_view_data);
    }

    public function invoice_download($enc_id = false)
    {
        $booking_id = '';

        if($enc_id != '')
        {
          $booking_id = base64_decode($enc_id);
        }

        $get_invoice_data = $this->PatientConsultationPaymentModel->where('booking_id', $booking_id)
                                                                  ->where('payment_status', 'completed')
                                                                  ->with('user_data')
                                                                  ->with('patient_data')
                                                                  ->with('doctor_user_data')
                                                                  ->with('consultation_details')
                                                                  ->get();
        if($get_invoice_data)
        {
            $this->arr_view_data['invoice_data'] = $get_invoice_data->toArray();
        }

        $get_admin_data = $this->AdminProfileModel->first();
        if($get_admin_data)
        {
            $this->arr_view_data['admin_data'] = $get_admin_data->toArray();
        }

        $this->arr_view_data['doctor_id']     = $this->user_id;
        Session::put("arr_invoice_data",'');
        return response()->json($this->arr_view_data);
    }

    public function generate_invoice_pdf(Request $request)
    {
      if($request->has('arr_data') && $request->input('arr_data')!='')
      {
        $arr_session_data = $request->input('arr_data');
        Session::put("arr_invoice_data",$arr_session_data);
        return response()->json(['status'=>'success']);
      }

      $arr_data = Session::get("arr_invoice_data");
      if(!empty($arr_data))
      {
        PDF::setHeaderCallback(function($pdf){
                $pdf->SetY(15);
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->Image('https://www.doctoroo.com.au/images/pdf/doctoroo-logo.png', 15, 10, 40, 13, 'png', '', '', true, 150, '', false, false, 0, false, false, false);
                $pdf->SetY(40);
         });

          
          PDF::setFooterCallback(function($pdf) {

              $pdf->SetY(-15);
              
              $pdf->SetFont('helvetica', 'I', 8);
              
              $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
          });

          $file_name="consultation_invoice";
        
          PDF::SetTitle('Doctoroo | Membership Invoice');
          PDF::SetMargins(10, 30, 10, 10);
          PDF::SetFontSubsetting(false);
          PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          PDF::AddPage();
          PDF::writeHTML(view($this->module_view_folder.'.pdf.consultation_invoice', $arr_data)->render());
          PDF::Output($file_name.'.pdf');      
      }
      
      return redirect()->back();

    }

    public function bank_account()
    {  
        $arr_bank = [];
        $obj_bank = $this->DoctorModel->where('user_id', $this->user_id)->with('userinfo')->first();
        if($obj_bank)
        {
            $arr_bank = $obj_bank->toArray();
        }
        $this->arr_view_data['arr_bank']    = $arr_bank;
        $this->arr_view_data['stripe_msg']  = '';


        return view($this->module_view_folder.'.bank_account',$this->arr_view_data);
    }
    
    public function unset_session()
    {
        Session::put('stripe_created_count','0');
        $msg    = "done";
        $status = 'success';
        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
    }
    public function stripe_msg($msg)
    {  
        $arr_bank = [];
        $obj_bank = $this->DoctorModel->where('user_id', $this->user_id)->first();
        if($obj_bank)
        {
            $arr_bank = $obj_bank->toArray();
        }
        $this->arr_view_data['arr_bank']    = $arr_bank;

        if($msg != null)
        {
          if($msg == 'success' || $msg == 'error')
          {
            $this->arr_view_data['stripe_msg'] = $msg;
          }
          
          else
          {
            return redirect(url('/').'/doctor/billing/bank_account');
          }
        }

        return view($this->module_view_folder.'.bank_account',$this->arr_view_data);
    }

    public function update_bank_details(Request $request)
    {
       $arr_rules = $arr_data = [];
       
       $arr_data['bank_account_name']      = $request->input('bank_name');
       $arr_data['bsb']                    = $request->input('bsb');
       $arr_data['account_number']         = $request->input('account_number');

       $sucess = $this->DoctorModel->where('user_id',$this->user_id)->update($arr_data);
       if($sucess)
       {
            $msg    = "Bank details updated successfully";
            $status = 'success';
       }
       else
       {
            $msg    = "Error occured while updatation";
            $status = 'error';
       }

        $data = array('status'=>$status,'msg'=>$msg);
        return response()->json($data);
    }


    public function my_discount()
    {  
        $arr_code = [];

        $today = date('Y-m-d');
        $active_code = $this->DoctorCouponModel->whereDate('expiry_date','>=',$today)
                                               ->where('status','=','0')
                                               ->where('doc_id',$this->user_id)
                                               ->orderBy('created_at','DESC')
                                               ->with('sharediscountcode')
                                               ->get();
        if($active_code)
        {
            $arr_code = $active_code->toArray();
        }
        
        $this->arr_view_data['arr_code']        = $arr_code;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;

        return view($this->module_view_folder.'.my_discount',$this->arr_view_data);
    }

    public function store(Request $request)
    {
        $arr_rules = $arr_data = [];

        $arr_rules['value']                = "required|numeric";
        $arr_rules['selected_date_submit'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        

        $arr_data['doc_id']      = $this->user_id;
        $arr_data['value']       = $request->input('value');
        $arr_data['expiry_date'] = $request->input('selected_date_submit');
        $arr_data['code']        = (mt_rand(10000000, 99999999));
        $arr_data['status']      = 0;

        $success = $this->DoctorCouponModel->create($arr_data);
        if($success)
        {   
            
            Session::flash('success','Coupon code inserted successfully');
            return redirect()->back();
        }
        else
        {
            Session::flash('error','Error in adding coupon code');
            return redirect()->back();
        }
        
    }
    public function update_codes(Request $request)
    {
        $date1 = strtr($request->expiry_date, '/', '-');
        $date=date('Y-m-d', strtotime($date1)); 

        $arr_data['value']       = $request->code_val;
        $arr_data['expiry_date'] = $date;

        $success = $this->DoctorCouponModel->where('id',$request->coupon_id)
                                           ->update($arr_data);
        if($success)
        {   
            $return_arr['msg'] = 'Coupon code updated successfully';
        }
        else
        {
            $return_arr['msg'] = 'Something went to wrong';
        }

        return response()->json($return_arr);
    }
    public function delete_codes(Request $request)
    {
        $this->ShareDiscountCodeModel->where('coupon_id' ,$request->coupen_id)
                                     ->delete();
        $res = $this->DoctorCouponModel->where('id',$request->coupen_id)
                                       ->delete();
        if($res)
        {
           $return_arr['msg'] = 'Coupon code deleted successfully'; 
        }
        else
        {
         $return_arr['msg'] = 'Something went to wrong ! Please try again later';    
        }

        return response()->json($return_arr);                                       
    }

    /*--------------------------------------------------------------------------
                                  SEARCH PATIENT BY NAME
    ----------------------------------------------------------------------------*/

    public function search_patient_name(Request $request)
    {
      $patient_keyword = $request->doc_keyword;
      if($request->patient_type == 'doctoroo' )
      {
        $patient_name = $this->PatientConsultationBookingModel->orderBy('id','desc')
                                                              ->whereHas('patient_user_details', function($user_details) use($patient_keyword) {
                                                                  if(!empty($patient_keyword))
                                                                    { 
                                                                      $user_details->where('first_name','like','%'.$patient_keyword.'%');
                                                                      $user_details->orWhere('last_name','like','%'.$patient_keyword.'%');
                                                                     }
                                                            })->with('patient_user_details')
                                                              ->groupby('patient_user_id')
                                                              ->paginate(10);                                                             
      }
      else if($request->patient_type == 'myown' )
      {
          $patient_name = $this->PatientModel->orderBy('id','desc')
                                             ->whereHas('userinfo', function($user_details) use($patient_keyword) {
                                                  if(!empty($patient_keyword))
                                                    { 
                                                      $user_details->where('first_name','like','%'.$patient_keyword.'%');
                                                      $user_details->orWhere('last_name','like','%'.$patient_keyword.'%');
                                                     }
                                           })->with('userinfo')
                                             ->where('created_by', $this->user_id)
                                             ->paginate(10); 
        
      }

      
      if($patient_name)
      {
        $patient_arr = $patient_name->toArray();
        $patient_arr =$patient_arr['data'];
        $arr_json['patient_type'] = $request->patient_type;
        $arr_json['status'] = 'success';
        $arr_json['data']   = $patient_arr;
      }
      else
      {
        $arr_json['status'] = 'error';        
      }
      return response()->json($arr_json);
    }

    /*--------------------------------------------------------------------------
                                  SEARCH PATIENT
    ----------------------------------------------------------------------------*/

     public function search_patient(Request $request)
    {
    
      Session::set('code_id', $request->code_id);

      if(!empty($request->sort_by))
      {
        $sort_by=$request->sort_by;
      }
      else
      {
        $sort_by="";
      }

        if($request->patient_type == 'doctoroo')
        {
            $obj_patient = "";
            $obj_patient = $this->PatientConsultationBookingModel->with(['patient_info','patient_user_details'])
                                                                 ->groupby('patient_user_id')
                                                                 ->orderBy('id',$sort_by);

            if($request->patient_name!="")
            {
              $this->arr_view_data['patient_name']  = $request->patient_name;
              $patient_name = $request->patient_name;
              if(strstr($patient_name, ' '))
              {
                list($fname,$lname) = explode(' ', $patient_name);
                if(isset($fname) && isset($lname))
                {
                  $obj_patient = $obj_patient->whereHas('patient_user_details', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                }
              }
              else
              { 
                $this->arr_view_data['patient_name']  = $request->patient_name;
                $obj_patient = $obj_patient->whereHas('patient_user_details', function($user_details) use($patient_name) {
                                                                        if(!empty($patient_name))
                                                                          { 
                                                                            $user_details->where('first_name',$patient_name);
                                                                           }
                                                                        });
              }        
            }

            if($request->gender!="")
            {
              $gender = $request->gender;
              $this->arr_view_data['gender']  = $gender;
              if($gender=='Male'){ $gen='M'; }else { $gen='F'; }      
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($gen) {
                                                                        if(!empty($gen))
                                                                          { 
                                                                            $user_details->where('gender',$gen);
                                                                           }
                                                                        });
            }

            if($request->dob!="")
            {
              $this->arr_view_data['dob']  = $request->dob;
              $date1 = strtr($request->dob, '/', '-');
              $dob=date('Y-m-d', strtotime($date1)); 
                    
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($dob) {
                                                                          if(!empty($dob))
                                                                            { 
                                                                              $user_details->where('date_of_birth',$dob);
                                                                             }
                                                                          });
            }

            if($request->entitlement_id!="")
            {
              $this->arr_view_data['entitlement_id']  = $request->entitlement_id;
              $entitlement_id = $request->entitlement_id;
                              
              $obj_patient = $obj_patient->whereHas('patient_info', function($user_details) use($entitlement_id) {
                                                                          if(!empty($entitlement_id))
                                                                            { 
                                                                              $user_details->where('card_no',$entitlement_id);
                                                                             }
                                                                         });
            }

            $obj_patient = $obj_patient->paginate(10);

            if($obj_patient)
            {
              $this->arr_view_data['paginate']                   = clone $obj_patient;
              $this->arr_view_data['patients_arr']               = $obj_patient->toArray();     
            } 
              
            $this->arr_view_data['module_url_path']             = $this->module_url_path;
            $this->arr_view_data['patient_base_img_path']       = $this->patient_base_img_path;
            $this->arr_view_data['patient_public_img_path']     = $this->patient_public_img_path;

            return view($this->module_view_folder.'.patient_search')->with($this->arr_view_data);
        }
        else if($request->patient_type =="myown")
        {
          $obj_patient = "";
            $obj_patient = $this->PatientModel->where('created_by',$this->user_id)
                                                                 ->with('userinfo')
                                                                 ->orderBy('id',$sort_by);

         if($request->patient_name!="")
            {
              $this->arr_view_data['doctor_name']  = $request->patient_name;
              $patient_name = $request->patient_name;
              if(strstr($patient_name, ' '))
              {
                list($fname,$lname) = explode(' ', $patient_name);
                if(isset($fname) && isset($lname))
                {
                  $obj_patient = $obj_patient->whereHas('userinfo', function($user_details) use($fname,$lname) {
                                                                      if(!empty($fname))
                                                                        { 
                                                                          $user_details->where('first_name',$fname);
                                                                          $user_details->where('last_name',$lname);
                                                                         }
                                                                      });
                }
              }
              else
              { 
                $this->arr_view_data['patient_name']  = $request->patient_name;
                $obj_patient = $obj_patient->whereHas('userinfo', function($user_details) use($patient_name) {
                                                                        if(!empty($patient_name))
                                                                          { 
                                                                            $user_details->where('first_name',$patient_name);
                                                                           }
                                                                        });
              }        
            }
            if($request->gender!="")
            {
              $gender = $request->gender;

              $this->arr_view_data['gender']  = $gender;

              if($gender=='Male'){ $gen='M'; }else { $gen='F'; }      
              $obj_patient = $obj_patient->where('gender',$gen);
                                                                            
            }

            if($request->dob!="")
            {
              $this->arr_view_data['dob']  = $request->dob;
              $date1 = strtr($request->dob, '/', '-');
              $dob=date('Y-m-d', strtotime($date1)); 
                    
              $obj_patient = $obj_patient->where('date_of_birth',$dob);
            }

            if($request->entitlement_id!="")
            {
              $this->arr_view_data['entitlement_id']  = $request->entitlement_id;
              $entitlement_id = $request->entitlement_id;
                              
              $obj_patient = $obj_patient->where('card_no',$entitlement_id);
            }

            $obj_patient = $obj_patient->paginate(10);

            if($obj_patient)
            {
              $this->arr_view_data['paginate']                   = clone $obj_patient;
              $this->arr_view_data['patients_arr']               = $obj_patient->toArray();  
                  
            } 
              
            $this->arr_view_data['module_url_path']             = $this->module_url_path;
            $this->arr_view_data['patient_base_img_path']       = $this->patient_base_img_path;
            $this->arr_view_data['patient_public_img_path']     = $this->patient_public_img_path;

            return view($this->module_view_folder.'.mypatient_search')->with($this->arr_view_data);
                                                                                                                      
        }
     
    }

    /*--------------------------------------------------------------------------
                                  COUPON CODE - STORE
    ----------------------------------------------------------------------------*/

    public function share_code($enc_id)
        {
          $coupon_id = "";
          if(Session::has('code_id'))
          {
            $coupon_id = Session::get('code_id');
          }
          $data_arr['coupon_id'] = $coupon_id;
          $data_arr['doctor_id'] = $this->user_id; 
          $data_arr['patient_id'] = base64_decode($enc_id); 
          $data_arr['status'] = 'pending'; 


          $res = $this->ShareDiscountCodeModel->create($data_arr);

          if($res)
          {
            $msg = "Code Shared successfully";
          }
          else
          {
             $msg = "Something went to wrong";
          }
          Session::flash('message', $msg);
          return redirect()->back();
        }

    public function get_shared_patients(Request $request)
    {
      $coupon_id = $request->coupon_id; 

      $get_patients = $this->ShareDiscountCodeModel->where('coupon_id',$coupon_id)
                                                   ->with('userinfo')
                                                   ->orderBy('created_at','DESC')
                                                   ->groupBy('patient_id')
                                                   ->get();

      if($get_patients)
      {
        $get_patients_arr = $get_patients->toArray();  
        $arr_json['status'] = 'success';
        $arr_json['data']   = $get_patients_arr;
      }
      else
      {
        $arr_json['status'] = 'error';
      }
      
      return response()->json($arr_json);
    }    
}
?>