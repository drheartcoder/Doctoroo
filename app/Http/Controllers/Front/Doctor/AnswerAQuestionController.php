<?php
namespace App\Http\Controllers\Front\Doctor;
use App\Models\UserModel;
use App\Models\LanguageModel;
use App\Models\DoctorModel;
use App\Models\AnswerAQuestionModel;
use App\Models\ViewAnswerAQuestionModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flash;
use Paginate;
use Sentinel;
use Activation;
use DateTime;
use Validator;
use Response;



class AnswerAQuestionController extends Controller
{
      public function __construct(UserModel     $user_model,
                                  LanguageModel $language_model,
                                  DoctorModel   $doctor_model,
                                  AnswerAQuestionModel $answer_model,
                                  ViewAnswerAQuestionModel $view_model
                                )
      {

          $this->arr_view_data      = [];

          $this->UserModel                    = $user_model;
          $this->LanguageModel                = $language_model;
          $this->DoctorModel                  = $doctor_model;
          $this->AnswerAQuestionModel         = $answer_model;
          $this->ViewAnswerAQuestionModel     = $view_model;


          $this->module_title                 = "Answer a Question";
        	$this->module_view_folder           = 'front.doctor.answer_a_question';
          $this->module_url_path              = url('/').'/doctor/answer-a-question';
          $this->base_path                    = base_path().'/public';

    }

    public function index()
    {

        $arr_new_question = $arr_answer_a_question = array();
        $arr_new_pagination = $arr_answer_pagination = array();

        $user = Sentinel::check();

        if($user)
        {

            /*================= New Question ========================*/ 

            $obj_new_question = $this->AnswerAQuestionModel->with('patientinfo')
                                                     ->where('doctor_id',0)
                                                     ->where('answer','=','') 
                                                     ->orderBy('id','DESC')
                                                     ->paginate(10); 


             if($obj_new_question!=FALSE)                                        
             {

                  $arr_new_pagination = clone $obj_new_question;
                  $arr_new_question   = $obj_new_question->toArray();
             }

           
            /*=================Answer a Question ========================*/ 

            $obj_answer_question = $this->AnswerAQuestionModel->with('patientinfo')
                                                     ->where('doctor_id',$user->id)
                                                     ->orderBy('id','DESC')
                                                     ->paginate(10); 

             if($obj_answer_question!=FALSE)                                        
             {

                  $arr_answer_pagination = clone $obj_answer_question;
                  $arr_answer_a_question = $obj_answer_question->toArray();
              }

        }   
         // dd($arr_answer_a_question);

        $this->arr_view_data['arr_pagination']          = $arr_new_pagination;  
        $this->arr_view_data['arr_answer_pagination']   = $arr_answer_pagination;

        $this->arr_view_data['arr_new_question']      = $arr_new_question;  
        $this->arr_view_data['arr_answer_a_question'] = $arr_answer_a_question;              
        $this->arr_view_data['page_title']            = str_singular($this->module_title);             
        $this->arr_view_data['module_url_path']       = $this->module_url_path;
        return view($this->module_view_folder.'.manage',$this->arr_view_data);
    }

    public function details($enc_id=FALSE)
    {

        $arr_details = array();$this->arr_view_data['attach_message']="";
        $check_exist = 0;

        if($enc_id!="")
        {

            $id = base64_decode($enc_id);

            /*===================Add View Question=============================*/

            $user = Sentinel::check();

            if($user)
            {

                $check_exist = $this->ViewAnswerAQuestionModel->where('doctor_id',$user->id)
                                                              ->where('question_id',$id)
                                                              ->count();
                if($check_exist==0)                                              
                {

                    $this->ViewAnswerAQuestionModel->create(['question_id'=>$id,'doctor_id'=>$user->id]);
                }


            }

            /*========================End==========================================*/

            $obj_details = $this->AnswerAQuestionModel->with('patientinfo')
                                                     ->where('id',$id)
                                                     ->orderBy('id','DESC')
                                                     ->first(); 

            if($obj_details!=FALSE)                                         
            {

                $arr_details = $obj_details->toArray();
                $this->arr_view_data['arr_details']  = $arr_details;                 
            }

            $this->arr_view_data['view_count']            = $check_exist;                         
            $this->arr_view_data['page_title']            = str_singular($this->module_title);             
            $this->arr_view_data['module_url_path']       = $this->module_url_path;
            return view($this->module_view_folder.'.details',$this->arr_view_data);

        }

        return redirect()->back();
  
    }

    public function reply(Request $request ,$enc_id=FALSE)
    {

        $form_data = $arr_rules = array();
        $arr_reply = array();
        $user = Sentinel::check();

        if($user && $enc_id!="")
        {

              $question_id = base64_decode($enc_id);

              $check_exist = $this->AnswerAQuestionModel->where('id',$question_id)
                                                        ->where('doctor_id',0)
                                                        ->where('answer','=','') 
                                                        ->count();
             

              if($check_exist)
              {

                     /*======================Update Answer========================================*/

                        $arr_rules['reply_msg'] = 'required';

                        $validator  =   Validator::make($request->all(),$arr_rules);
                        if($validator->fails())
                        {

                           Flash::error("Problem Occured.".$validator->errors()); 
                           return back()->withErrors($validator)->withInput();
                        }

                        $form_data = $request->all();

                        $file_name = "";

                        if($request->hasFile('attach_file'))
                        {

                            $attach_file   =   $request->file('attach_file');

                            if(isset($attach_file) && sizeof($attach_file)>0)
                            {

                                    $extention  =   strtolower($attach_file->getClientOriginalExtension());
                                    $valid_ext  =   ['doc','docx','pdf'];

                                    if(!in_array($extention, $valid_ext))
                                    {

                                        Flash::error('Please upload valid file with valid extension i.e doc,docx,pdf');
                                        return redirect()->back()->withInput($request->all());
                                    }
                                    else
                                    {
                                      
                                        $file_name      = $request->file('attach_file');
                                        $file_extension = strtolower($request->file('attach_file')->getClientOriginalExtension()); 
                                        $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                                        $upload_result  = $request->file('attach_file')->move($this->base_path.config('app.project.img_path.reply_attachment'), $file_name);
                                    }
                            }
                            else
                            {
                                Flash::error('Please upload valid file.');
                                return redirect()->back()->withInput($request->all());
                            }
                        }
                       

                      $arr_reply['answer']     = $form_data['reply_msg'];
                      $arr_reply['doctor_id']  = $user->id;
                      $arr_reply['attachment'] = $file_name;


                      $update_result = $this->AnswerAQuestionModel->where('id',$question_id)->update($arr_reply);
                      if($update_result)
                      {

                          Flash::success("Answer Added Successfully."); 
                          return redirect($this->module_url_path); 
                      }
                      else
                      {

                          Flash::error("Problem Occured, While adding answer."); 
                          return redirect()->back(); 
                      }

                      /*=========================================End================================*/
              }
              else
              {
              
                    Flash::error("Sorry,Answer is already exist."); 
                    return redirect()->back();
              }         

      }

      return redirect()->back();  
    }

    public function download($enc_id=FALSE)
    {

        $arr_question = array();

        if($enc_id!="")
        {

            $id = base64_decode($enc_id);

            $obj_question = $this->AnswerAQuestionModel->where('id',$id)->first();

            if($obj_question!=FALSE)
            {

                $arr_question = $obj_question->toArray();

                if(sizeof($arr_question)>0)
                {

                    if(isset($arr_question['attachment']) && $arr_question['attachment']!=""  && file_exists('uploads/front/doctor/reply_attachment/'.$arr_question['attachment']))
                    {    
                 
                        $file     = "uploads/front/doctor/reply_attachment/".$arr_question['attachment'];
                        return Response::download($file);

                    }    
                }    
            }
        }

       return redirect()->back(); 
    }

}
?>