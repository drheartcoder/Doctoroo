<?php //Seema

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\HowItWorksModel;

use Validator;
use Flash;
class HowItWorksController extends Controller
{
    public function __construct(HowItWorksModel $howitwork)
	{
		$this->arr_view_data      = [];
		$this->HowItWorksModel    = $howitwork;
		$this->module_url_path    = url(config('app.project.admin_panel_slug')."/howitworks");
        $this->module_title       = "How It Works";
        $this->module_view_folder = "admin.howitworks";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');

	}
    public function index()
    {
    	$result_data = array();
    	$this->arr_view_data['page_title']   = 'Manage';
    	$this->arr_view_data['module_title'] = str_singular($this->module_title);

    	$info = $this->HowItWorksModel->orderBy('id', 'DESC')->get();

    	if($info!=FALSE)
    	{	
    		$result_data = $info->toArray();
      	}

      	$this->arr_view_data['arr_result']      = $result_data; 
      	$this->arr_view_data['module_url_path'] = $this->module_url_path;
    	return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function create()
    {
    	$this->arr_view_data['page_title']      = 'Add';
    	$this->arr_view_data['module_title']    = str_singular($this->module_title);
    	$this->arr_view_data['module_url_path'] = $this->module_url_path;
    	return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function store(Request $request)
    {
    	$arr_rules = array();
        $arr_data  = array();

    	$arr_rules['title']       = 'required';
    	$arr_rules['description'] = 'required';

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

        $form_data               = array();
        $form_data               = $request->all();
        $arr_data['title']       = $request->input('title');
        $arr_data['slug']        = str_slug($arr_data['title']);
        $arr_data['description'] = $request->input('description');
        $arr_data['image']       = $request->input('image');

        if($request->hasFile('image'))
        {
            $img_validator = Validator::make(array('image'=>$request->file('image')),array(
                                                'image' => 'mimes:png,jpeg,gif')); 
            if ($request->file('image')->isValid() && $img_validator->passes())
            {

                list($width, $height) = getimagesize($form_data['image']);
                if ($width<=88 && $height<=110) 
                {
                
                    $company_logo_name = $form_data['image'];
                    $imageExtension    = $request->file('image')->getClientOriginalExtension();
                    $imageName         = sha1(uniqid().$company_logo_name.uniqid()).'.'.$imageExtension;
             
                    $request->file('image')->move(
                        base_path() . '/public/uploads/admin/howitworks/', $imageName
                    );

                    $arr_data['image'] = $imageName;
                }
                else
                {
                     Flash::error("Please upload image with size less than 88*110.");
                     return back()->withErrors($validator)->withInput($request->all());
                }
            }
            else
            {
                 Flash::error("Please upload valid image.");
                 return back()->withErrors($validator)->withInput($request->all());
            }
        } 

        $result = $this->HowItWorksModel->create($arr_data);
        if($result)
        {
            Flash::success("Content Added Successfully.");
        }
        else
        {
            Flash::error('Problem Occurred, While Adding '.str_singular($this->module_title));
        }

        return redirect()->back();
    }

    public function edit($enc_id=FALSE)
    {
        $this->arr_view_data['admin_img_path'] = url('/').'/uploads/admin/howitworks/';
        if($enc_id)
        {
            $id = base64_decode($enc_id);
            $result = $this->HowItWorksModel->where('id',$id)->first();
            if($result!=FALSE)
            {
                $arr_data = $result->toArray();
            }

            $this->arr_view_data['page_title']      = 'Edit';
            $this->arr_view_data['arr_data']        = $arr_data;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['enc_id']          = $enc_id;
            return view($this->module_view_folder.'.edit',$this->arr_view_data);
        }
        
        return redirect()->back();    
    }

    public function update(Request $request,$enc_id=null)
    {
        if($enc_id)
        {
            $id        = base64_decode($enc_id);
            $arr_rules = array();
            $arr_data  = array();

            $arr_rules['title']       = 'required';
            $arr_rules['description'] = 'required';

            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            $form_data               = array();
            $form_data               = $request->all();
            $arr_data['title']       = $request->input('title');
            $arr_data['description'] = $request->input('description');
            $arr_data['image']       = $request->input('image');
            $arr_data['old_image']   = $request->input('old_image');

            if($request->hasFile('image'))
            {
                $img_validator = Validator::make(array('image'=>$request->file('image')),array(
                                                    'image' => 'mimes:png,jpeg,gif')); 
                if ($request->file('image')->isValid() && $img_validator->passes())
                {

                    list($width, $height) = getimagesize($form_data['image']);
                    if ($width<=88 && $height<=110) 
                    {
                    
                        $company_logo_name = $form_data['image'];
                        $imageExtension    = $request->file('image')->getClientOriginalExtension();
                        $imageName         = sha1(uniqid().$company_logo_name.uniqid()).'.'.$imageExtension;
                 
                        $request->file('image')->move(
                            base_path() . '/public/uploads/admin/howitworks/', $imageName
                        );

                        $arr_data['image'] = $arr_data['old_image'];
                    }
                    else
                    {
                         Flash::error("Please upload image with size less than 88*110.");
                         return back()->withErrors($validator)->withInput($request->all());
                    }
                }
                else
                {
                     Flash::error("Please upload valid image.");
                     return back()->withErrors($validator)->withInput($request->all());
                }
            } 

            $result = $this->HowItWorksModel->where('id',$id)->update($arr_data);
            if($result)
            {
                Flash::success("Content Added Successfully.");
            }
            else
            {
                Flash::error('Problem Occurred, While Adding '.str_singular($this->module_title));   
            }
        } 

        return redirect()->back();   
    }

    public function delete($enc_id=FALSE)
    {

        if($enc_id)
        {
            $id     = base64_decode($enc_id);

            $result = $this->HowItWorksModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Content Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Content.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function activate($enc_id=FALSE)
    {
      
        if($enc_id)
        {
            $id     = base64_decode($enc_id);
            
            $result = $this->HowItWorksModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Content Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Content Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function deactivate($enc_id=FALSE)
    {
        if($enc_id)
        {
            $id     = base64_decode($enc_id);

            $result = $this->HowItWorksModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Content Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Content Status.');
                }
            }
            else
            {
                Flash::error('Sorry, Invalid Request.');
            }
        }
        else
        {
            Flash::error('Sorry, Invalid Request.');
        }

        return redirect()->back();
    }

    public function multi_action(Request $request)
    {
       
        $arr_rules                   = array();
        $arr_rules['multi_action']   = 'required';
        $arr_rules['checked_record'] = 'required';

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $multi_action   = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Flash::error('Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            $record_id = base64_decode($record_id);

            if($multi_action=="delete")
            {
               $result = $this->HowItWorksModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                       Flash::success('Content(s) Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {

                $result = $this->HowItWorksModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Content(s) Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
               
                $result = $this->HowItWorksModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Content(s) Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }
}
