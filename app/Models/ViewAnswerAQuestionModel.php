<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ViewAnswerAQuestionModel extends Model
{
    

    protected $table      = "dod_view_answer_a_question";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'question_id',  
                                'doctor_id'

                            ];

  
 }
