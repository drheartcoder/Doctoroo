<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MainMedicationModel extends Model
{
    

    protected $table      = "dod_main_medication";
    protected $primaryKey = "id";
    protected $fillable   = [   
                                'name',    
                                'dose',
                                'form',
                                'qty',
                                'status'
                            ];


}
