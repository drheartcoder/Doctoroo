<?php

namespace App\Http\Controllers\Front\Patient;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AnswerAQuestionModel;


use Validator;
use Flash;
use Sentinel;
use Activation;
use Reminder;
use URL;
use Session;


class QuestionController extends Controller
{

    public function __construct(AnswerAQuestionModel $answer_question)
    {	

        $this->AnswerAQuestionModel = $answer_question;
    	$this->arr_view_data        =  [];

        $this->module_view_folder   = 'front.patient.question';
        $this->module_url_path      = url('/').'/patient/question';
        
        $user = Sentinel::check();
        if($user)
        {
            $this->user_id = $user->id;
        }



    }	
    /*
        Rohini jagtap
        show answered & unanswerd questions
    */
   
    public function show_unanswered_questions()
    {
        $arr_unanswerd_question    =[];
        $arr_unanswerd_question    = $this->get_unanswerd_question();

        $this->arr_view_data['arr_unanswerd_question']  = $arr_unanswerd_question;
        $this->arr_view_data['page_title']              = 'Unanswered Question';
        $this->arr_view_data['module_url_path']         = $this->module_url_path;
        return view($this->module_view_folder.'.unanswered_question',$this->arr_view_data);

    }
    public function show_answered_questions()
    {
           $arr_answerd_question   =[];
           $arr_answerd_question   = $this->get_answerd_question();  
           $this->arr_view_data['arr_answerd_question']    = $arr_answerd_question; 
           $this->arr_view_data['page_title']              = 'Answered Question';
           $this->arr_view_data['module_url_path']         = $this->module_url_path;
           return view($this->module_view_folder.'.answered_question',$this->arr_view_data);
    }
    public function store(Request $request)
    {
        $arr_rules = $arr_question = [];
        $arr_rules['question']  = 'required';
      
        $validator  =   Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {

           Flash::error("Problem Occured.".$validator->messages()->all()); 
           return back()->withErrors($validator)->withInput();
        }
        $arr_question['question']   = $request->input('question');
        $arr_question['patient_id'] = $this->user_id;

        $status = $this->AnswerAQuestionModel->create($arr_question);
        if($status)
        {
            Flash::success("Questions saved successfully.");

        }
        else
        {
            Flash::error("Problem occured while creating a questions.");
        }
        return redirect()->back();

    }
    public function get_unanswerd_question()
    {
        $arr_question = $arr_pagination = [];
        $obj_question = $this->AnswerAQuestionModel->where('patient_id','=',$this->user_id)
                                                   ->with(['patientinfo'=>function($q){
                                                        $q->select('id','first_name','last_name');
                                                     }])
                                                   ->where('doctor_id','=',0)
                                                   ->orderBy('id','desc')
                                                   ->paginate(3);

        if($obj_question)
        {
          $arr_pagination = clone $obj_question;
          $arr_question   = $obj_question->toArray();  

        }
        $arr_view_data['arr_pagination'] = $arr_pagination;
        $arr_view_data['arr_question']   = $arr_question;
        return $arr_view_data;
    }
    public function get_answerd_question()
    {
        $arr_question   = $arr_pagination = [];
        $obj_question   = $this->AnswerAQuestionModel->where('patient_id','=',$this->user_id)
                                                     ->with(['patientinfo'=>function($q){
                                                        $q->select('id','first_name','last_name');
                                                     }])
                                                     ->with(['doctorinfo'=>function($q){
                                                        $q->select('id','first_name','last_name');
                                                     }])
                                                     ->where('doctor_id','<>',0)
                                                     ->orderBy('id','desc')
                                                     ->paginate(3);
        if($obj_question)
        {
           $arr_pagination = clone $obj_question;
           $arr_question   = $obj_question->toArray();  

        }
        $arr_view_data['arr_pagination'] = $arr_pagination;
        $arr_view_data['arr_question']   = $arr_question;
        return $arr_view_data;
    }


}