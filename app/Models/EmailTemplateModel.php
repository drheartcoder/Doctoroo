<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EmailTemplateModel extends Model
{
	
	
    protected $table = 'dod_email_template';
    
    protected $fillable = ['template_name', 
    						'template_subject',
    						'template_from',
    						'template_from_mail', 
    						'template_html',
    						'template_variables'
    						];
}
