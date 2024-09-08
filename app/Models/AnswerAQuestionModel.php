<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AnswerAQuestionModel extends Model
{
    

    protected $table      = "dod_answer_a_question";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'question',  
                                'answer',
                                'patient_id',
                                'doctor_id'
                            ];




    public function patientinfo()
    {
       return $this->belongsTo('App\Models\UserModel','patient_id','id');
       
    } 


    public function doctorinfo()
    {
       return $this->belongsTo('App\Models\UserModel','doctor_id','id');
       
    }   

    public function viewRecord()
    {
       return $this->belongsTo('App\Models\ViewAnswerAQuestionModel','id','question_id');
       
    }   

 }
