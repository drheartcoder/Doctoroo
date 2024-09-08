<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;
use Validator;
use Flash;
use DB;

class BlogController extends Controller
{
    public function __construct(BlogModel $blog,BlogCategoryModel $category)
    {
        $this->BlogModel                = $blog;
        $this->BlogCategoryModel        = $category;
        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/blog");
        $this->blog_img_base_path       = base_path() . '/public'.config('app.project.img_path.blog_image');
        $this->blog_img_url_path        = url('/') .config('app.project.img_path.blog_image');
        $this->module_title             = "Blog";
        $this->module_url_slug          = "blog";
        $this->module_view_folder       = "admin.blog";
       
    }

    public function index()
    {  
        $this->arr_view_data['cat_arr'] = array();
        $blog_info = $this->BlogModel->get();
        
    	if($blog_info!=FALSE)
    	{
    		$blogdata = $blog_info->toArray();
    	}
        
    	$this->arr_view_data['page_title']        = 'Manage Blog';
    	$this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['blog_img_url_path'] = $this->blog_img_url_path;
    	$this->arr_view_data['module_title']      = str_singular($this->module_title);
    	$this->arr_view_data['arr_blog']          = $blogdata;
    	return view($this->module_view_folder.'/index',$this->arr_view_data);	 
    }

    public function create()
    {
        $cat_info = $this->BlogCategoryModel->get();
        if($cat_info)
        {
            $this->arr_view_data['cat_arr'] = $cat_info->toArray();
        }
        $this->arr_view_data['page_title']      = 'Add Blog';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        return view($this->module_view_folder.'/create',$this->arr_view_data);   
    }

    public function store(Request $request)
    {  
        $arr_rules = array();

        $arr_rules['title']           = 'required';        
        $arr_rules['blog_cat']        = 'required';        
        $arr_rules['date']            = 'required';
        $arr_rules['postedby']        = 'required';
        $arr_rules['description']     = 'required';        
        $arr_rules['meta_title']      = 'required';
        $arr_rules['meta_keyword']    = 'required';
        $arr_rules['meta_desc']       = 'required';  
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all();
        $arr_data  = array();

        $slugArray = array(array('title','=',$form_data['title']));
        $slugName = Self::create_slug($form_data['title'],'dod_blog',$slugArray);

        $arr_data['title']                  = $form_data['title'];
        $arr_data['slug']                   = $slugName;
        $arr_data['category']               = $form_data['blog_cat'];              
        $arr_data['date']                   = $form_data['date'];
        $arr_data['postedby']               = $form_data['postedby'];
        $arr_data['description']            = $form_data['description'];
        $arr_data['meta_title']             = $form_data['meta_title'];
        $arr_data['meta_keyword']           = $form_data['meta_keyword'];
        $arr_data['meta_desc']              = $form_data['meta_desc'];

        if($request->hasFile('blog_image')) 
        {
            $img_valiator = Validator::make(array('image'=>$request->file('blog_image')),array(
                                            'image' => 'mimes:png,jpeg,jpg'));            

              if ($request->file('blog_image')->isValid() && $img_valiator->passes())
              {
                  $speciality_image_name = "";
                  $fileExtension = strtolower($request->file('blog_image')->getClientOriginalExtension()); 

                  if($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg')
                  {
                      $speciality_image_name = sha1(uniqid().$speciality_image_name.uniqid()).'.'.$fileExtension;

                      $request->file('blog_image')->move($this->blog_img_base_path, $speciality_image_name);                      
                      $arr_data['image'] = $speciality_image_name;
                  }
              }
        }
        $store_info = $this->BlogModel->create($arr_data);

        if($store_info)
        {
            Flash::success('Blog has Added Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Creating blog.');
        }

        return redirect()->back();
    }

    public function edit($enc_id=null)
    {
            if($enc_id)
            {
                $blog_id  = base64_decode($enc_id);

                $blog_information = $this->BlogModel->where('id',$blog_id)->first();

                if($blog_information)
                {
                    $blog_data = $blog_information->toArray();
                }   

                $this->arr_view_data['blog_data']       = $blog_data;
                $this->arr_view_data['img_path']        = $this->blog_img_url_path;
                $this->arr_view_data['enc_id']          = $enc_id;
                $this->arr_view_data['page_title']      = 'Edit Blog';
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);

                return view($this->module_view_folder.'/edit',$this->arr_view_data);     
            }

            return redirect()->back();
    }

    public function update(Request $request, $enc_id)
    { 
        $blog_id   = base64_decode($enc_id);
        $arr_rules = array();
        $status    = FALSE;

        $arr_rules['title']           = 'required';        
        $arr_rules['date']            = 'required';
        $arr_rules['postedby']        = 'required';
        $arr_rules['description']     = 'required';        
        $arr_rules['meta_title']      = 'required';
        $arr_rules['meta_keyword']    = 'required';
        $arr_rules['meta_desc']       = 'required';  
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }
        
        $form_data = array();
        $form_data = $request->all();

        $obj_blog = $this->BlogModel->where('id',$blog_id);
        
        if($obj_blog && sizeof($obj_blog) > 0)
        {
           $arr_data = array();

           $slugArray = array(array('title','=',$form_data['title']), array('id','<>',$blog_id));
           $slugName = Self::create_slug($form_data['title'],'dod_blog',$slugArray);

           $arr_data['title']                 = $form_data['title'];
           $arr_data['slug']                  = $slugName;
           $arr_data['date']                  = $form_data['date'];
           $arr_data['postedby']              = $form_data['postedby'];
           $arr_data['description']           = $form_data['description'];
           $arr_data['meta_title']            = $form_data['meta_title'];
           $arr_data['meta_keyword']          = $form_data['meta_keyword'];
           $arr_data['meta_desc']             = $form_data['meta_desc'];

         if($request->hasFile('blog_image')) 
         {
            $img_valiator = Validator::make(array('image'=>$request->file('blog_image')),array(
                                            'image' => 'mimes:png,jpeg,jpg')); 

              if ($request->file('blog_image')->isValid() && $img_valiator->passes())
              {
                  $blog_image_name = $form_data['blog_image'];
                  $fileExtension   = strtolower($request->file('blog_image')->getClientOriginalExtension()); 
                  if($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg')
                  {
                      $blog_image_name = sha1(uniqid().$blog_image_name.uniqid()).'.'.$fileExtension;
                      $request->file('blog_image')->move($this->blog_img_base_path, $blog_image_name);
                      $arr_data['image'] = $blog_image_name;

                       //unlink exiting image
                      if ($blog_image_name && isset($obj_blog->blog_image) && $obj_blog->blog_image!="") 
                      {
                          if ($obj_blog->blog_image!='defaul_profile_image.png') 
                          {
                              $file_exits = file_exists($this->blog_img_base_path.$obj_blog->blog_image);

                              if ($file_exits) 
                              {
                                  unlink($this->blog_img_base_path.$obj_blog->image);
                              }
                          }
                      }
                  }
              }
          }
            $status = $obj_blog->update($arr_data);
            $obj_blog_details  = $this->BlogModel->where('id',$blog_id); 
 
        }
        if ($status) 
        {
              $this->arr_view_data['arr_data']                = $arr_data;  
              $this->arr_view_data['page_title']              = "Edit Blog";
              $this->arr_view_data['module_title']            = "Edit Blog";
              $this->arr_view_data['module_url_path']         = $this->module_url_path;
                           
              Flash::success('Blog has Updated Successfully');
        }
        else
        {
             Flash::error('Problem Occured, While Updating Blog.');
        }        
        return redirect()->back();
    }

    public function delete($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $blog_id = base64_decode($enc_id);

            $result = $this->BlogModel->where('id',$blog_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Blog has Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Blog.');
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
            $blog_id = base64_decode($enc_id);

            $result = $this->BlogModel->where('id',$blog_id)->first();
           
            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Blog has Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Blog Status.');
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
            $blog_id = base64_decode($enc_id);

            $result = $this->BlogModel->where('id',$blog_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Blog has Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Blog Status.');
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
        $arr_rules = array();
        $arr_rules['multi_action']     = 'required';
        $arr_rules['checked_record']   = 'required';

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
               $result = $this->BlogModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success('Blog\'s has Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {
                $result = $this->BlogModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Blog\'s has Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
                $result = $this->BlogModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Blog\'s has Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    } 
   
   /*---------------------category---------------------------------*/
    public function category()
    {
        $cat_info = $this->BlogCategoryModel->get();
        
        if($cat_info!=FALSE)
        {
            $catdata = $cat_info->toArray();
        }
        $this->arr_view_data['page_title']      = 'Category';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['arr_cat']         = $catdata;
        return view($this->module_view_folder.'/category',$this->arr_view_data);    
    }

    public function createcategory()
    {
        $this->arr_view_data['page_title']      = 'Add Category';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        return view($this->module_view_folder.'/createcat',$this->arr_view_data);   
    }
     
    public function storecategory(Request $request)
    {  
        $arr_rules = array();

        $arr_rules['category'] = 'required';        
         
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }

        $form_data = array();
        $form_data = $request->all();
        $arr_data  = array();

        $slugArray = array(array('category','=',$form_data['category']));
        $slugName = Self::create_slug($form_data['category'],'dod_blog_category',$slugArray);

        $arr_data['category']  = $form_data['category'];
        $arr_data['slug']      = $slugName;
        
        $cat_info = $this->BlogCategoryModel->create($arr_data);

        if($cat_info)
        {
            Flash::success('Category has Added Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Creating Category.');
        }

        return redirect()->back();
    }
    
    public function editcategory($enc_id=null)
    {
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);
            $cat_information = $this->BlogCategoryModel->where('id',$cat_id)->first();
            if($cat_information)
            {
                $cat_data = $cat_information->toArray();
            }
            $this->arr_view_data['cat_data']        = $cat_data;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Edit Category';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);
            return view($this->module_view_folder.'/editcat',$this->arr_view_data);

        }
        return redirect()->back();

    }
    
    public function updatecategory(Request $request,$enc_id=null)
    { 
        if($enc_id)
        {
            $cat_id    = base64_decode($enc_id);

            $arr_rules                = array();
            $arr_rules['category']    = 'required';   
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data  = array();

            $slugArray = array(array('category','=',$form_data['category']), array('id','<>',$cat_id));
            $slugName = Self::create_slug($form_data['category'],'dod_blog_category',$slugArray);

            $arr_data['category']  = $form_data['category'];
            $arr_data['slug']      = $slugName;

            $update_data = $this->BlogCategoryModel->where('id',$cat_id)->update($arr_data);

            if($update_data)
            {
                Flash::success('Category has Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Category.');
            }

        }

        return redirect()->back();
    }

    public function deletecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->BlogCategoryModel->where('id',$cat_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Category has Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Category.');
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

    public function activatecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->BlogCategoryModel->where('id',$cat_id)->first();
           
            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Category has Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Category Status.');
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

    public function deactivatecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->BlogCategoryModel->where('id',$cat_id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Category has Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Category Status.');
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

    public function multiaction_category(Request $request)
    {      
        $arr_rules                       = array();
        $arr_rules['multi_action']       = 'required';
        $arr_rules['checked_record']     = 'required';

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
               $result = $this->BlogCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success('Category\'s has Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {
                $result = $this->BlogCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Category\'s has Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {       
                $result = $this->BlogCategoryModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Category\'s has Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }


    /*
    | Function  : Get blog title and convert it into slug
    | Author    : Deepak Arvind Salunke
    | Date      : 14/07/2017
    | Output    : created slug
    */

    public static function create_slug($string, $tableName,$slugArray)
    {

        $replace = '-';
        $string = strtolower($string);
        /*replace / and . with white space*/
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        /*remove multiple dashes or whitespaces*/
        $string = preg_replace("/[\s-]+/", " ", $string);
        /*convert whitespaces and underscore to $replace*/
        $string = preg_replace("/[\s_]/", $replace, $string);
        /*limit the slug size*/
        $string = substr($string, 0, 100);
        /*slug is generated*/

        /*$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));*/
        $numHits = DB::table($tableName)->where($slugArray)->count();
        
        /*$numHits = $row['NumHits'];*/

        $finalSlug = ($numHits > 0) ? ($string.'-'.$numHits) : $string;
        return $finalSlug ;
        /*$finalSlug = ($ext) ? $string.'-'.$numHits.$ext : $string.'-'.$numHits;*/

        /*$string = "what is your name ?";
        $slug = create_slug($string); */
    } // end create_slug

}
