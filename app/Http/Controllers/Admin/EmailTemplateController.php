<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplateModel;
use App\Models\UserModel;

use Validator;
use Flash;
use Sentinel;

class EmailTemplateController extends Controller
{   
	/*
    | Constructor : creates instances of model class 
    |               & handles the admin authantication
    | auther : MOHAN SONAR 
    | Date : 04/05/2016
    | @return \Illuminate\Http\Response
    */
 
    public function __construct(EmailTemplateModel $email_template,UserModel $UserModel)
    {
        
        $this->EmailTemplateModel = $email_template;
        $this->BaseModel          = $this->EmailTemplateModel;
        $this->UserModel          = $UserModel;
        $this->arr_view_data      = [];
        $this->module_title       = "Email Template";
        $this->module_view_folder = "admin.email_template";
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/email_template");
        /*For activity log*/
        /*$this->obj_data    = Sentinel::getUser();
        $this->first_name  = $this->obj_data->first_name;
        $this->last_name   = $this->obj_data->last_name;
        $this->ip_address  = $_SERVER['REMOTE_ADDR'];*/
    }

    /*
    | index() : Display listing of Email Templates
    | auther : MOHAN SONAR 
    | Date : 06-05-2016
    | @return \Illuminate\Http\Response
    */ 
 
    public function index()
    {
        $obj_data = $this->BaseModel->get();

        if($obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Manage ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    /*
    | create() : Show the Email Templates.
    | auther : MOHAN SONAR 
    | Date : 06-05-2016    
    | @param  \Illuminate\Http\Request  $request
    */

    public function view($enc_id)
    {
        $id                 = base64_decode($enc_id);
        $obj_email_template = $this->BaseModel->where('id',$id)->first();


        if($obj_email_template)
        {
            $arr_email_template = $obj_email_template->toArray();    

            $content            = $arr_email_template['template_html'];

            $site_url = '<a href="'.url('/').'">'.config('app.project.name').'</a>.<br/>' ;

            $content  = str_replace("##SITE_URL##",$site_url,$content);

            return view('front.email.common',compact('content','email_logo_image'))->render();
        }
        else
        {
            return redirect()->back();
        }
    }

    /*
    | create() : Show the form for creating a new Email Templates.
    | auther : MOHAN SONAR 
    | Date : 06-05-2016    
    | @param  \Illuminate\Http\Request  $request
    */
    
    public function create()
    {
        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        
        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    /*
    | store() : Save Email Template into Database.
    | auther : MOHAN SONAR 
    | Date : 01/02/2016
    | @param  \Illuminate\Http\Request  $request
    | @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $arr_rules['template_name'] 	=	"required";  
        $arr_rules['template_subject'] 	=	"required";  
        //$arr_rules['template_html'] 	=	"required";        
        $arr_rules['variables'] 		=	"required";

        $validator = Validator::make($request->all(),$arr_rules);
        //dd($validator->messages());
        if($validator->fails())
        {
             Flash::error('Please Fill All The Mandatory Fields');
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        foreach ($request->input('variables') as  $key => $value) 
        {
        	$arr_varaible[$key] = "##".$value."##";
        }

        $admin_email = $this->UserModel->where('id','1')->get();
        if($admin_email)
        {
            $res_admin_email = $admin_email->toArray();
        }

        $arr_data = array(
        						'template_name' 		=>	 $request->input('template_name'),
        						'template_subject' 		=>	 $request->input('template_subject'),
        						'template_html' 		=>	 $request->input('template_html'),
        						'template_variables' 	=>	 implode("~", $arr_varaible),
        						'template_from_mail' 	=>	 $res_admin_email[0]['email'],
        						'template_from'			=>	 'ADMIN'
        				 );

        $entity = $this->BaseModel->create($arr_data);

        if($entity)
        {
            Flash::success(str_singular($this->module_title).' Created Successfully');
 		}
 		else
 		{
 			Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));	
 		}

       return redirect()->back();
    }

    /*
    | edit() : Show the form for editing the specified Email Template.
    | auther : MOHAN SONAR 
    | Date : 06-05-2016
    | @param  int  $enc_id
    | @return \Illuminate\Http\Response
    */

    public function edit($enc_id)
    {
    	$id    = base64_decode($enc_id);

        $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = array();
        

        $obj_data = $this->BaseModel->where('id', $id)->first();

        if($obj_data != FALSE)
        {
        	$this->arr_view_data['arr_data'] = $obj_data->toArray(); 
        }

        $arr_variables = isset($this->arr_view_data['arr_data']['template_variables'])?
        				 explode("~",$this->arr_view_data['arr_data']['template_variables']):array();

        $this->arr_view_data['arr_variables'] = $arr_variables;

		if($this->arr_view_data['arr_data'])      
      	{
            return view($this->module_view_folder.'.edit', $this->arr_view_data);   
        }
        else
        {
            return redirect()->back();
        }
    }

    /*
    | update() : Update the specified Email Template
    | auther : MOHAN SONAR 
    | Date : 06-05-2016
    | @param  int  $enc_id
    | @return \Illuminate\Http\Response
    */

    public function update(Request $request, $enc_id)
    {
		$id = base64_decode($enc_id);

    	//$form_data = $request->all();

    	$arr_rules['template_name'] 		=	$request->input('template_name');
    	$arr_rules['template_from']			=	$request->input('template_from');
    	$arr_rules['template_from_mail']	=	$request->input('template_from_mail');
    	$arr_rules['template_subject']		=	$request->input('template_subject');
    	$arr_rules['template_html']			=	$request->input('template_html');

    	$arr_data  	=   array(
									'template_name'			=>	 $request->input('template_name'),
									'template_from'			=>	 $request->input('template_from'),
									'template_from_mail'	=>	 $request->input('template_from_mail'),
									'template_subject'		=>	 $request->input('template_subject'),
									'template_html'			=>	 $request->input('template_html')
    							);

/*
        $does_exists = $this->BaseModel->where('template_subject', $request->input('template_subject'))
                            ->count();

        // if($does_exists)
        if(FALSE)                    
        {
            Flash::error(str_singular($this->module_title).' Already Exists.');
            return redirect()->back();
        }
        else
        {*/
        	$entity = 	$this->BaseModel->where('id',$id)->update($arr_data);

        	if($entity)
        	{
               
        		Flash::success(str_singular($this->module_title).' Updated Successfully');
        	}
        	else
        	{
        		Flash::error('Problem Occured, While Updating '.str_singular($this->module_title));
        	}
        // }

    	return redirect()->back();
    }
}
