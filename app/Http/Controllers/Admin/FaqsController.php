<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\FaqsModel;
use App\Models\FaqCategoryModel;
use Validator;
use Flash;
use Sentinel;
use Session;
/*-------------------------------Ankit Aher(20th feb 2017)---------------------------*/
class FaqsController extends Controller
{
     public function __construct(FaqsModel $faqs, FaqCategoryModel $faq_cat
        )
    {
        $this->FaqsModel               = $faqs;
        $this->FaqcatModel             = $faq_cat;
        $this->arr_view_data           = [];
        $this->module_url_path         = url(config('app.project.admin_panel_slug')."/faqs");
        $this->module_title            = "FAQS";
        $this->module_view_folder      = "admin.faqs";
        $this->admin_panel_slug        = config('app.project.admin_panel_slug');
    }

     public function index()
     {
        $this->arr_view_data['page_title']  =  str_singular($this->module_title);
        $arr_social_settings = array();

        $user = Sentinel::check();

        if($user)
        {
            if($user->inRole('admin'))
            {
                $arr_manage =  $this->FaqsModel->get();   
                
                if($arr_manage!=FALSE)
                {
                    $arr_faqs = $arr_manage->toArray();
                }
                
                $this->arr_view_data['arr_info']        = $arr_faqs;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['module_title']    = str_singular($this->module_title);
                return view($this->module_view_folder.'/index',$this->arr_view_data);
            }
            else
            {
                Flash::error('You don\'t have sufficient privileges.');
                redirect($this->admin_panel_slug.'/login');
            }
        }
        else
        {
            Flash::error('Please login to your account.');
            redirect($this->admin_panel_slug.'/login');
        }
    }

    public function create()
    {

        $faq_cats = $this->FaqcatModel->where('status', 'Active')->get()->toArray();

        //dd($this->speciality_img_base_path);
        $this->arr_view_data['page_title']      = 'Add Faqs Question & Answer';
        $this->arr_view_data['module_url_path'] =  $this->module_url_path;
        $this->arr_view_data['module_title']    =  str_singular($this->module_title);
        $this->arr_view_data['faq_cats']        =  $faq_cats;
        return view($this->module_view_folder.'/create',$this->arr_view_data);   
    }

    public function store(Request $request)
    { 

        $arr_rules = array();
        $arr_rules['faq_cat']       = 'required';
        $arr_rules['question']      = 'required';        
        $arr_rules['answer']        = 'required';
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withError($validator)->withInput($request->all());
        }


        $form_data = array();
        $form_data = $request->all();
        $arr_data = array();

        $slugArray = array(array('question','=',$form_data['question']));
        $slugName = Self::create_slug($form_data['question'],'dod_faqs',$slugArray);

        $arr_data['question']    = $form_data['question'];
        $arr_data['slug']        = $slugName;
        $arr_data['answer']      = $form_data['answer'];
        $arr_data['category_id'] = $form_data['faq_cat'];

        $store_info = $this->FaqsModel->create($arr_data);

        if($store_info)
        {
            Flash::success('Question & Answer Added Successfully.');
        }
        else
        {
            Flash::error('Problem Occured, While Adding Question & Answer.');
        }

        return redirect()->back();
    }

    public function edit($enc_id=null)
    {
        if($enc_id)
        {
            $id  = base64_decode($enc_id);

            $information = $this->FaqsModel->with('faq_catgeory')->where('id',$id)->first();
            if($information)
            {
                $data = $information->toArray();
            }
            //dd($data);

            $faq_cats = $this->FaqcatModel->where('status', 'Active')->get()->toArray();

            $this->arr_view_data['faq_cats']        = $faq_cats;
            $this->arr_view_data['data_info']       = $data;
            $this->arr_view_data['enc_id']          = $enc_id;
            $this->arr_view_data['page_title']      = 'Edit Faqs Question & Answer ';
            $this->arr_view_data['module_url_path'] = $this->module_url_path;
            $this->arr_view_data['module_title']    = str_singular($this->module_title);

            return view($this->module_view_folder.'/edit',$this->arr_view_data);     
        }

        return redirect()->back();
    }


    public function update(Request $request,$enc_id=null)
    { 
        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $arr_rules = array();
            $arr_rules['faq_cat']     = 'required';
            $arr_rules['question']    = 'required';
            $arr_rules['answer']      = 'required';
           
            $validator = Validator::make($request->all(),$arr_rules);

            if($validator->fails())
            {
                return redirect()->back()->withError($validator)->withInput($request->all());
            }

            $form_data = array();
            $form_data = $request->all();
            $arr_data = array();

            $slugArray = array(array('question','=',$form_data['question']), array('id','<>',$id));
            $slugName = Self::create_slug($form_data['question'],'dod_faqs',$slugArray);

            $arr_data['category_id']    = $form_data['faq_cat'];
            $arr_data['question']       = $form_data['question'];
            $arr_data['slug']           = $slugName;
            $arr_data['answer']         = $form_data['answer'];
           
                    
            $update_data = $this->FaqsModel->where('id',$id)->update($arr_data);
            
            if($update_data)
            {
                Flash::success('FAQ\'s Updated Successfully.');
            }
            else
            {
                Flash::error('Problem Occured, While Updating Data.');
            }

        }

        return redirect()->back();
    }
     
    public function activate($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $id     = base64_decode($enc_id);

            $result = $this->FaqsModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Active']);

                if($result_status)
                {
                    Flash::success('Activated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Activating Status.');
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
            $id = base64_decode($enc_id);

            $result = $this->FaqsModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_status = $result->update(['status'=>'Block']);

                if($result_status)
                {
                    Flash::success('Deactivated Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deactivating Status.');
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
    public function delete($enc_id=FALSE)
    {

        if($enc_id)
        {
            $id = base64_decode($enc_id);

            $result = $this->FaqsModel->where('id',$id)->first();

            if(isset($result) && sizeof($result)>0)
            {
                $result_info = $result->delete();

                if($result_info)
                {
                    Flash::success('Data Deleted Successfully.');
                }
                else
                {
                    Flash::error('Problem Occured, While Deleting Data.');
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
               $result = $this->FaqsModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_info = $result->delete();

                    if($result_info)
                    {
               
                        Flash::success('Data Deleted Successfully'); 
                    }
                }        
            } 
            elseif($multi_action=="activate")
            {

                $result = $this->FaqsModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Active']);

                    if($result_status)
                    { 
                        Flash::success('Data Activated Successfully'); 
                    }
                }        
            }
            elseif($multi_action=="deactivate")
            {
               
                $result = $this->FaqsModel->where('id',$record_id)->first();

                if(isset($result) && sizeof($result)>0)
                {
                    $result_status = $result->update(['status'=>'Block']);

                    if($result_status)
                    {  
                        Flash::success('Data Blocked Successfully');  
                    }
                }        
            }
        }

        return redirect()->back();
    }


    /*
    | Function  : get all the category
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : display all the category
    */

    
    public function category()
    {
        $cat_info = $this->FaqcatModel->get();
        
        if($cat_info!=FALSE)
        {
            $catdata = $cat_info->toArray();
        }
        //dd($catdata);
        $this->arr_view_data['page_title']      = 'Category';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        $this->arr_view_data['arr_cat']         = $catdata;
        return view($this->module_view_folder.'/category',$this->arr_view_data);    
    }

    /*
    | Function  : show create new category form
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : show create new category form
    */

    public function createcategory()
    {
        $this->arr_view_data['page_title']      = 'Add Category';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = str_singular($this->module_title);
        return view($this->module_view_folder.'/createcat',$this->arr_view_data);   
    }

    /*
    | Function  : store new catgeory
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */
     
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

        $slugArray = array(array('category_name','=',$form_data['category']));
        $slugName = Self::create_slug($form_data['category'],'dod_faq_category',$slugArray);

        $arr_data['category_name']  = $form_data['category'];
        $arr_data['cat_slug']       = $slugName;
        
        $cat_info = $this->FaqcatModel->create($arr_data);

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

    /*
    | Function  : with the help of id getthe catgeory
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : display all the details of the selected catgeory
    */
    
    public function editcategory($enc_id=null)
    {
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);
            $cat_information = $this->FaqcatModel->where('id',$cat_id)->first();
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

    /*
    | Function  : save the updated data of the category
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */
    
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

            $slugArray = array(array('category_name','=',$form_data['category']), array('id','<>',$cat_id));
            $slugName = Self::create_slug($form_data['category'],'dod_faq_category',$slugArray);

            $arr_data['category_name']  = $form_data['category'];
            $arr_data['cat_slug']       = $slugName;

            $update_data = $this->FaqcatModel->where('id',$cat_id)->update($arr_data);

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

    /*
    | Function  : delete the selected catgeory
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */

    public function deletecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->FaqcatModel->where('id',$cat_id)->first();

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

    /*
    | Function  : activate the selected category
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */

    public function activatecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->FaqcatModel->where('id',$cat_id)->first();
           
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

    /*
    | Function  : deactivate the selected category
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */

    public function deactivatecategory($enc_id=FALSE)
    { 
        if($enc_id)
        {
            $cat_id = base64_decode($enc_id);

            $result = $this->FaqcatModel->where('id',$cat_id)->first();

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

    /*
    | Function  : select multi-catgeory and perform action according to the selected task
    | Author    : Deepak Arvind Salunke
    | Date      : 25/07/2017
    | Output    : Success or Error
    */

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
               $result = $this->FaqcatModel->where('id',$record_id)->first();

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
                $result = $this->FaqcatModel->where('id',$record_id)->first();

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
                $result = $this->FaqcatModel->where('id',$record_id)->first();

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
    | Date      : 25/07/2017
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
        $numHits = \DB::table($tableName)->where($slugArray)->count();
        
        /*$numHits = $row['NumHits'];*/

        $finalSlug = ($numHits > 0) ? ($string.'-'.$numHits) : $string;
        return $finalSlug ;
        /*$finalSlug = ($ext) ? $string.'-'.$numHits.$ext : $string.'-'.$numHits;*/

        /*$string = "what is your name ?";
        $slug = create_slug($string); */
    } // end create_slug
   
}   
