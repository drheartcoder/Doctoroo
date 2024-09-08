<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\BlogFavoriteModel;
use App\Models\BlogCategoryModel;
use App\Models\BlogCommentModel;
use App\Models\PharmacyModel;
use App\Models\BlogViewModel;
use Sentinel;
use DB;
use Flash;

class BlogController extends Controller
{
    public function __construct(BlogModel $BlogModel , BlogFavoriteModel $BlogFavoriteModel,BlogCategoryModel $BlogCategoryModel,BlogCommentModel $BlogCommentModel , PharmacyModel $PharmacyModel,BlogViewModel $BlogViewModel)
	{
		$this->module_view_folder 	= 'front.blog';
		$this->arr_view_data 		= [];
		$this->blog_image_url 		= url('/public').config('app.project.img_path.blog_image');
		$this->BlogModel 			= $BlogModel;
		$this->BlogFavoriteModel 	= $BlogFavoriteModel;
		$this->BlogCategoryModel 	= $BlogCategoryModel;
		$this->BlogCommentModel 	= $BlogCommentModel;
		$this->PharmacyModel 		= $PharmacyModel;
		$this->BlogViewModel 		= $BlogViewModel;

		$this->pharmacy_base_img_path   		= public_path().config('app.project.img_path.pharmacy');
    	$this->pharmacy_public_img_path 		= url('/public').config('app.project.img_path.pharmacy');

    	$this->user_profile_base_img_path 		= public_path().config('app.project.img_path.patient');
    	$this->user_profile_public_img_path 	= url('/public').config('app.project.img_path.patient');

    	$this->doctor_base_img_path   			= public_path().config('app.project.img_path.doctor');
     	$this->doctor_public_img_path 			= url('/public').config('app.project.img_path.doctor');

	}

	public function index(Request $request)
	{
		$arr_pagination =$this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = $this->arr_view_data['blog_arr_popular']= $this->arr_view_data['blog_category']=array();
		$this->arr_view_data['page_title']  = 'Blog';
		$this->arr_view_data['blog_image_url'] = $this->blog_image_url;
		
		/*$blog_category_obj = $this->BlogCategoryModel->orderBy('id', 'DESC')->where('status','Active')->get();
		if($blog_category_obj)
		{
			$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
		}*/
		//dd($this->arr_view_data['blog_category_arr']);

		if($request->txt_search!=null && $request->txt_search!='')
		{
			$blog_obj = $this->BlogModel->with('category_details')->where('status','Active')->with('category_details')->where('title','like','%'.$request->txt_search.'%')->orderBy('id', 'DESC')->paginate(10);
			if($blog_obj)
			{
				$arr_pagination = clone $blog_obj;
				$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
				$this->arr_view_data['arr_pagination'] = $arr_pagination;
			}	
		}
		else
		{
			$blog_obj = $this->BlogModel->with(['category_details'=>function($q){
											$q->where('status','Active');
										}])
										->whereHas('category_details', function($q){
											$q->where('status','Active');
										})
										->where('status','Active')
										->orderBy('id', 'DESC')
										->paginate(10);
			if($blog_obj)
			{
				$arr_pagination = clone $blog_obj;
				$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
				$this->arr_view_data['arr_pagination'] = $arr_pagination;
			}
		}

		$blog_obj_latest = $this->BlogModel->with('category_details')->where('status','Active')->orderBy('id', 'DESC')->get()->take(3);
		if($blog_obj_latest)
		{
			$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
		}
		$BlogTable = $this->BlogModel->getTable();
		$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
		$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
													->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
													->groupBy('blog_id')
													->orderBy('blog_order','DESC')->take(3)->get();
		
		if($blog_obj_popular)
		{
			$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
		}

		$BlogTable = $this->BlogModel->getTable();
		$BlogCategoryTable = $this->BlogCategoryModel->getTable();
		$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
													->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
													->groupBy($BlogCategoryTable.'.id')
													->where($BlogTable.'.status', 'Active')
													->orderBy('cat_order','DESC')->take(3)->get();
		
		if($blog_category)
		{
			$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
		}
		//dd($this->arr_view_data['blog_category']);

		$user = Sentinel::check();
		if($user)
		{
			$user_id = $user->id;
			$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
			if($blog_info)
			{
				$arr_b = $blog_info->toArray();//$this->arr_view_data['blog_arr_fav']
				if(count($arr_b)>0)
				{
				 	foreach ($arr_b as $key => $value) {
				 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
				 	}
				}
			}
		}

		$arr = $this->getYearHeirarchy();
		$this->arr_view_data['YearHeirarchy'] = $arr;

		// for seo 
        $this->arr_view_data['title']               = "Blog | Doctoroo";
        $this->arr_view_data['description']         = "Get the latest information and updates about health related issues.";

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function addtofavorite($blog_id , $user_id)
	{
		if($blog_id!='' && $user_id!='' && $blog_id!='0')
		{
			$num = $this->BlogFavoriteModel->where('blog_id',$blog_id)->where('user_id',$user_id)->count();
			if($num==0)
			{
				$res = $this->BlogFavoriteModel->create(array('blog_id'=>$blog_id,'user_id'=>$user_id));
				if($res)
				{
					echo 'success';
				}
				else
				{
					echo 'error';
				}
			}
			else
			{
				$del = $this->BlogFavoriteModel->where('blog_id',$blog_id)->where('user_id',$user_id)->delete();
				if($del)
				{
					echo 'success';
				}
				else
				{
					echo 'error';
				}
			}
		}
	}

	public function blog_details($slug)
	{
		$arr_pagination =$this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = $this->arr_view_data['blog_arr_popular']= $this->arr_view_data['blog_category']=array();

		if(trim($slug)=='')
		{
			return redirect('/blogs');
		}
		
		$arr_slug = $slug;

		$blog_obj = $this->BlogModel->where('slug',$slug)->first();
		if($blog_obj)
		{
			$get_blog = $blog_obj->toArray();

			$blog_id = $get_blog['id'];

			$num_count = $this->BlogViewModel->where('blog_id',$blog_id)->where('ip_address',$_SERVER['REMOTE_ADDR'])->count();
			if($num_count==0)
			{
				$this->BlogViewModel->create(array('blog_id'=>$blog_id,'ip_address'=>$_SERVER['REMOTE_ADDR']));
			}

			$this->arr_view_data['blog_arr'] 		= $this->arr_view_data['blog_arr_fav'] = array();
			$this->arr_view_data['blog_image_url'] 	= $this->blog_image_url;
			/*$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
			if($blog_category_obj)
			{
				$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
			}*/
			$blog_obj_latest = $this->BlogModel->where('status','Active')->get()->take(3);
			if($blog_obj_latest)
			{
				$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
			}
			$BlogTable = $this->BlogModel->getTable();
			$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
			$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
														->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
														->groupBy('blog_id')
														->orderBy('blog_order','DESC')->take(3)->get();
			
			if($blog_obj_popular)
			{
				$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
			}

			$BlogTable = $this->BlogModel->getTable();
			$BlogCategoryTable = $this->BlogCategoryModel->getTable();
			$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
														->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
														->groupBy($BlogCategoryTable.'.id')
														->orderBy('cat_order','DESC')->take(3)->get();
			
			if($blog_category)
			{
				$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
			}
			//dd($this->arr_view_data['blog_category']);

			$user = Sentinel::check();
			if($user)
			{
				$user_id = $user->id;
				$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
				if($blog_info)
				{
					 $arr_b = $blog_info->toArray();//$this->arr_view_data['blog_arr_fav']
					 if(count($arr_b)>0)
					 {
					 	foreach ($arr_b as $key => $value) {
					 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
					 	}
					 }

				}
			}
			
			$this->arr_view_data['blog_arr']['meta_title'] = $this->arr_view_data['blog_arr']['meta_desc'] = $this->arr_view_data['blog_arr']['meta_keyword'] = $this->arr_view_data['blog_arr']['title'] = '';

			$blog_obj = $this->BlogModel->with('category_details')->where('id',$blog_id)->first();
			if($blog_obj)
			{
				$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
				//dd($this->arr_view_data['blog_arr']);

				// for seo 
		        $this->arr_view_data['title']               = $this->arr_view_data['blog_arr']['meta_title'];
		        $this->arr_view_data['description']         = $this->arr_view_data['blog_arr']['meta_desc'];
		        $this->arr_view_data['keywords']         	= $this->arr_view_data['blog_arr']['meta_keyword'];
			}
			
			$this->arr_view_data['comment_str'] = $this->build_comment_string($blog_id);

			$arr = $this->getYearHeirarchy();
			$this->arr_view_data['YearHeirarchy'] = $arr;
			$this->arr_view_data['page_title'] = $this->arr_view_data['blog_arr']['title'];
			return view($this->module_view_folder.'.details',$this->arr_view_data);
		}
		else
		{
			$get_blog_cat = $this->BlogCategoryModel->where('slug',$arr_slug)->first();
			if($get_blog_cat)
			{
				$blog_cat_arr = $get_blog_cat->toArray();
			}
			$category_id = $blog_cat_arr['id'];

			$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
			if($blog_category_obj)
			{
				$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
			}

			$arr_pagination =$this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = $this->arr_view_data['blog_arr_popular']= $this->arr_view_data['blog_category']=array();
			$this->arr_view_data['page_title']  = 'Blog';
			$this->arr_view_data['blog_image_url'] = $this->blog_image_url;

			$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
			if($blog_category_obj)
			{
				$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
			}
			
			if($category_id!=null && $category_id!='')
			{
				$blog_obj = $this->BlogModel->with('category_details')->where('status','Active')->where('category',$category_id)->paginate(10);
				if($blog_obj)
				{
					$arr_pagination = clone $blog_obj;
					$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
					$this->arr_view_data['arr_pagination'] = $arr_pagination;
				}	
			}
			else
			{
				return redirect('/blogs');	
			}
			$blog_obj_latest = $this->BlogModel->where('status','Active')->get()->take(3);
			if($blog_obj_latest)
			{
				$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
			}
			$BlogTable = $this->BlogModel->getTable();
			$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
			$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
														->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
														->groupBy('blog_id')
														->orderBy('blog_order','DESC')->take(3)->get();
			
			if($blog_obj_popular)
			{
				$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
			}

			$BlogTable = $this->BlogModel->getTable();
			$BlogCategoryTable = $this->BlogCategoryModel->getTable();
			$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
														->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
														->groupBy($BlogCategoryTable.'.id')
														->orderBy('cat_order','DESC')->take(3)->get();
			
			if($blog_category)
			{
				$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
			}

			$user = Sentinel::check();
			if($user)
			{
				$user_id = $user->id;
				$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
				if($blog_info)
				{
					$arr_b = $blog_info->toArray();
					if(count($arr_b)>0)
					{
					 	foreach ($arr_b as $key => $value) {
					 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
					 	}
					}
				}
			}
			$arr = $this->getYearHeirarchy();
			$this->arr_view_data['YearHeirarchy'] = $arr;
			return view($this->module_view_folder.'.index',$this->arr_view_data);
		}
	}

	public function blog_details2($slug)
	{
		$arr_pagination =$this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = $this->arr_view_data['blog_arr_popular']= $this->arr_view_data['blog_category']=array();

		if(trim($slug)=='')
		{
			return redirect('/blogs');
		}
		
		$arr_slug = explode('-',$slug);
		if(count($arr_slug)>0)
		{
			$blog_id = last($arr_slug);
		}
		if(!is_numeric($blog_id))
		{
			return redirect('/blogs');	
		}
		//dd($blog_id);

		$num_count = $this->BlogViewModel->where('blog_id',$blog_id)->where('ip_address',$_SERVER['REMOTE_ADDR'])->count();
		if($num_count==0)
		{
			$this->BlogViewModel->create(array('blog_id'=>$blog_id,'ip_address'=>$_SERVER['REMOTE_ADDR']));
		}

		$this->arr_view_data['blog_arr'] 		= $this->arr_view_data['blog_arr_fav'] = array();
		$this->arr_view_data['blog_image_url'] 	= $this->blog_image_url;
		/*$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
		if($blog_category_obj)
		{
			$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
		}*/
		$blog_obj_latest = $this->BlogModel->where('status','Active')->get()->take(3);
		if($blog_obj_latest)
		{
			$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
		}
		$BlogTable = $this->BlogModel->getTable();
		$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
		$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
													->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
													->groupBy('blog_id')
													->orderBy('blog_order','DESC')->take(3)->get();
		
		if($blog_obj_popular)
		{
			$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
		}

		$BlogTable = $this->BlogModel->getTable();
		$BlogCategoryTable = $this->BlogCategoryModel->getTable();
		$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
													->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
													->groupBy($BlogCategoryTable.'.id')
													->orderBy('cat_order','DESC')->take(3)->get();
		
		if($blog_category)
		{
			$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
		}
		//dd($this->arr_view_data['blog_category']);

		$user = Sentinel::check();
		if($user)
		{
			$user_id = $user->id;
			$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
			if($blog_info)
			{
				 $arr_b = $blog_info->toArray();//$this->arr_view_data['blog_arr_fav']
				 if(count($arr_b)>0)
				 {
				 	foreach ($arr_b as $key => $value) {
				 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
				 	}
				 }

			}
		}
		
		$this->arr_view_data['blog_arr']['meta_title'] = $this->arr_view_data['blog_arr']['meta_desc'] = $this->arr_view_data['blog_arr']['meta_keyword'] = $this->arr_view_data['blog_arr']['title'] = '';

		$blog_obj = $this->BlogModel->with('category_details')->where('id',$blog_id)->first();
		if($blog_obj)
		{
			$this->arr_view_data['blog_arr'] = $blog_obj->toArray();

			// for seo 
	        $this->arr_view_data['title']               = $this->arr_view_data['blog_arr']['meta_title'];
	        $this->arr_view_data['description']         = $this->arr_view_data['blog_arr']['meta_desc'];
	        $this->arr_view_data['keywords']         	= $this->arr_view_data['blog_arr']['meta_keyword'];
		}
		
		$this->arr_view_data['comment_str'] = $this->build_comment_string($blog_id);

		$arr = $this->getYearHeirarchy();
		$this->arr_view_data['YearHeirarchy'] = $arr;
		$this->arr_view_data['page_title'] = $this->arr_view_data['blog_arr']['title'];
		return view($this->module_view_folder.'.details',$this->arr_view_data);
	}

	public function getYearHeirarchy()
	{
		
		$arr_months = array(1=>'January',
                          	2=>'February',
                          	3=>'March',
                          	4=>'April',
                          	5=>'May',
                          	6=>'June',
                          	7=>'July',
                          	8=>'August',
                          	9=>'Septmber',
                          	10=>'Octomber',
                          	11=>'November',
                          	12=>'December'); 
		$final_arr = array();

		$year_obj = $this->BlogModel->where('status','Active')->selectRaw(' DISTINCT(YEAR(date)) AS years')->get();
		if($year_obj)
		{
			$year_arr = $year_obj->toArray();
			if(count($year_arr)>0)
			{
				foreach ($year_arr as $ykey => $y) 
				{
					$month_obj = $this->BlogModel->whereRaw('YEAR(date) = '.$y['years'])->selectRaw(' DISTINCT(MONTH(date)) AS months')->get();
					$month_arr = $month_obj->toArray(); 
					if(count($month_arr)>0)
					{
						foreach ($month_arr as  $m) 
						{	
							$final_arr[$y['years']][]	= $arr_months[$m['months']];
						}
					}
				}
			}
		}
		return $final_arr;
	}

	public function blog_search_heirarchy($year,$month)
	{
		$arr_months = array(1=>'January',
                          	2=>'February',
                          	3=>'March',
                          	4=>'April',
                          	5=>'May',
                          	6=>'June',
                          	7=>'July',
                          	8=>'August',
                          	9=>'Septmber',
                          	10=>'Octomber',
                          	11=>'November',
                          	12=>'December');

		$arr_pagination = $this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = array();
		$this->arr_view_data['page_title']  = 'Blog';
		$this->arr_view_data['blog_image_url'] = $this->blog_image_url;

		if($year!='' && $month!='')
		{
			$index = array_search($month,$arr_months);
			if(!$index)
			{
				return redirect('/blogs');
			}
			$blog_obj = $this->BlogModel->whereRaw('YEAR(date) = '. $year)->whereRaw('MONTH(date) ='.$index)->where('status','Active')->paginate(10);
			if($blog_obj)
			{
				$arr_pagination = clone $blog_obj;
				$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
				$this->arr_view_data['arr_pagination'] = $arr_pagination;
			}
		}

		$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
		if($blog_category_obj)
		{
			$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
		}
		

		$blog_obj_latest = $this->BlogModel->where('status','Active')->get()->take(3);
		if($blog_obj_latest)
		{
			$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
		}
		$BlogTable = $this->BlogModel->getTable();
		$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
		$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
												 ->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
												 ->groupBy('blog_id')
												 ->orderBy('blog_order','DESC')->take(3)->get();
		
		if($blog_obj_popular)
		{
			//$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
			$this->arr_view_data['blog_arr_popular'] = '';
		}

		$BlogTable = $this->BlogModel->getTable();
		$BlogCategoryTable = $this->BlogCategoryModel->getTable();
		$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
													->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
													->groupBy($BlogCategoryTable.'.id')
													->orderBy('cat_order','DESC')->take(3)->get();
		
		if($blog_category)
		{
			$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
		}
		//dd($this->arr_view_data['blog_category']);

		$user = Sentinel::check();
		if($user)
		{
			$user_id = $user->id;
			$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
			if($blog_info)
			{
				$arr_b = $blog_info->toArray();//$this->arr_view_data['blog_arr_fav']
				if(count($arr_b)>0)
				{
				 	foreach ($arr_b as $key => $value) {
				 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
				 	}
				}
			}
		}
		$arr = $this->getYearHeirarchy();
		$this->arr_view_data['YearHeirarchy'] = $arr;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function blog_search_category($category_slug)
	{
		if(trim($category_slug)=='')
		{
			return redirect('/blogs');
		}

		$arr_slug = explode('-',$category_slug);
		if(count($arr_slug)>0)
		{
			$category_id = last($arr_slug);
		}

		if(!is_numeric($category_id))
		{
			return redirect('/blogs');	
		}	

		$arr_pagination =$this->arr_view_data['blog_arr'] = $this->arr_view_data['blog_arr_fav'] = $this->arr_view_data['blog_arr_popular']= $this->arr_view_data['blog_category']=array();
		$this->arr_view_data['page_title']  = 'Blog';
		$this->arr_view_data['blog_image_url'] = $this->blog_image_url;
		$blog_category_obj = $this->BlogCategoryModel->where('status','Active')->get();
		if($blog_category_obj)
		{
			$this->arr_view_data['blog_category_arr'] = $blog_category_obj->toArray();
		}//dd($this->arr_view_data['blog_category_arr']);
		
		if($category_id!=null && $category_id!='')
		{
			$blog_obj = $this->BlogModel->where('status','Active')->where('category',$category_id)->paginate(10);
			if($blog_obj)
			{
				$arr_pagination = clone $blog_obj;
				$this->arr_view_data['blog_arr'] = $blog_obj->toArray();
				$this->arr_view_data['arr_pagination'] = $arr_pagination;
			}	
		}
		else
		{
			return redirect('/blogs');	
		}
		$blog_obj_latest = $this->BlogModel->where('status','Active')->get()->take(3);
		if($blog_obj_latest)
		{
			$this->arr_view_data['blog_arr_latest'] = $blog_obj_latest->toArray();
		}
		$BlogTable = $this->BlogModel->getTable();
		$BlogFavoriteTable = $this->BlogFavoriteModel->getTable();
		$blog_obj_popular = DB::table($BlogTable)->select(DB::raw('COUNT(blog_id) AS blog_order,blog_id,image,title,date'))
													->join($BlogFavoriteTable,$BlogFavoriteTable.'.blog_id',"=",$BlogTable.'.id')
													->groupBy('blog_id')
													->orderBy('blog_order','DESC')->take(3)->get();
		
		if($blog_obj_popular)
		{
			$this->arr_view_data['blog_arr_popular'] = json_decode(json_encode($blog_obj_popular),true);
		}

		$BlogTable = $this->BlogModel->getTable();
		$BlogCategoryTable = $this->BlogCategoryModel->getTable();
		$blog_category = DB::table($BlogTable)->select(DB::raw('COUNT('.$BlogCategoryTable.'.id) AS cat_order,'.$BlogCategoryTable.'.id,'.$BlogCategoryTable.'.category'))
													->join($BlogCategoryTable,$BlogCategoryTable.'.id',"=",$BlogTable.'.category')
													->groupBy($BlogCategoryTable.'.id')
													->orderBy('cat_order','DESC')->take(3)->get();
		
		if($blog_category)
		{
			$this->arr_view_data['blog_category'] = json_decode(json_encode($blog_category),true);
		}
		//dd($this->arr_view_data['blog_category']);

		$user = Sentinel::check();
		if($user)
		{
			$user_id = $user->id;
			$blog_info = $this->BlogFavoriteModel->where('user_id',$user_id)->select('blog_id')->get();
			if($blog_info)
			{
				$arr_b = $blog_info->toArray();//$this->arr_view_data['blog_arr_fav']
				if(count($arr_b)>0)
				{
				 	foreach ($arr_b as $key => $value) {
				 		$this->arr_view_data['blog_arr_fav'][] = $value['blog_id'];
				 	}
				}
			}
		}
		$arr = $this->getYearHeirarchy();
		$this->arr_view_data['YearHeirarchy'] = $arr;
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function comment_store(Request $request)
	{
		$user = Sentinel::check();
		if(!$user)
		{
			return redirect('/');
		}
		//dd($user->id);
		if($request->blog_id!=null && $request->blog_id!='0')
		{
			$inser_arr  = array('user_id'=>$user->id,'blog_id'=>$request->blog_id,'parent_id'=>$request->blog_parent,'comment'=>$request->txt_comments);
			$res 		= $this->BlogCommentModel->create($inser_arr);
			if($res)
			{	
				Flash::success('Your comment has been submitted successfully!');
				return redirect()->back();
			}
			else
			{
				Flash::error('Error while submitting your comment please try again later.');
				return redirect()->back();
			}
		}
		return redirect()->back();		
	}

	public function build_comment_string($blog_id)
	{
		$user = Sentinel::check();
		/*if(!$user)
		{
			return redirect('/blogs');
		}*/

		$comment_str  ='';
		if($blog_id!='')
		{
			#get all parent comments
			//DB::enableQueryLog();
			$obj_comments = $this->BlogCommentModel->with('user_details')->where('blog_id',$blog_id)->where('parent_id','0')->orderby('id','DESC')->get();
			if($obj_comments)
			{
				$arr_comments = $obj_comments->toArray();
			}
			//dd($arr_comments);
			if(count($arr_comments)>0)
			{
				foreach ($arr_comments as $bvalue) 
				{
					## get user details
					$user_name = (($bvalue['user_details']['first_name']." ".$bvalue['user_details']['last_name'])?$bvalue['user_details']['first_name']." ".$bvalue['user_details']['last_name']:'unkown');
					$posted_date = date('F d, Y',strtotime($bvalue['created_at']));

					$user_img = url('/').'/uploads/front/doctor/default-image.jpeg';

					$user_blog = Sentinel::findById($bvalue['user_details']['id']);
					if($user_blog)
					{
						if($user_blog->inRole('patient'))
						{
							if(file_exists($this->user_profile_base_img_path.$bvalue['user_details']['profile_image']) && $bvalue['user_details']['profile_image']!='')
							{
								$user_img = url('/timthumb.php?src='.$this->user_profile_public_img_path.$bvalue['user_details']['profile_image'].'&h=100&w=100');
							}						
						}
						else if($user_blog->inRole('doctor'))
						{
							if(file_exists($this->doctor_base_img_path.$bvalue['user_details']['profile_image']) && $bvalue['user_details']['profile_image']!='')
							{
								$user_img = url('/timthumb.php?src='.$this->doctor_public_img_path.$bvalue['user_details']['profile_image'].'&h=100&w=100');	
							}						
						} 
						else if($user_blog->inRole('pharmacy'))
						{
							$obj = $this->PharmacyModel->where('user_id',$bvalue['user_details']['id'])->first(); 
							if($obj) {$arra = $obj->toArray(); } 
							if(file_exists($this->pharmacy_base_img_path.$arra['logo']) && $arra['logo']!='')
							{
								$user_img = url('/timthumb.php?src='.$this->pharmacy_public_img_path.$arra['logo'].'&h=100&w=100');
							}						
						}
						
						$reply = '';

						if($bvalue['parent_id']==0)
						{
							$reply ='<div class="repl-text">
	                                    <a href="javascript:void(0);" onclick="javascript:addreply('.$bvalue['id'].');">
	                                        <span><i class="fa fa-reply"></i>
	                                        </span>
	                                        Reply
	                                    </a>
	                                </div>';
						}
						
						$sub_arr_comm = array(); $sub_comm_str='';
						$sub_comments = $this->BlogCommentModel->with('user_details')->where('parent_id',$bvalue['id'])->orderBy('id','DESC')->get();
						if($sub_comments)
						{
							$sub_arr_comm = $sub_comments->toArray();
						}
						if(count($sub_arr_comm)>0)
						{
							foreach ($sub_arr_comm as  $svalue) 
							{
								$suser_name = (($svalue['user_details']['first_name']." ".$svalue['user_details']['last_name'])?$svalue['user_details']['first_name']." ".$svalue['user_details']['last_name']:'unkown');
								$sposted_date = date('F d, Y',strtotime($svalue['created_at']));

								$suser_img = url('/').'/uploads/front/doctor/default-image.jpeg';

								$suser_blog = Sentinel::findById($svalue['user_details']['id']);
								if($user_blog)
								{
									if($suser_blog->inRole('patient'))
									{
										if(file_exists($this->user_profile_base_img_path.$svalue['user_details']['profile_image']) && $svalue['user_details']['profile_image']!='')
										{
											$suser_img = url('/timthumb.php?src='.$this->user_profile_public_img_path.$svalue['user_details']['profile_image'].'&h=100&w=100');
										}						
									}
									else if($suser_blog->inRole('doctor'))
									{
										if(file_exists($this->doctor_base_img_path.$svalue['user_details']['profile_image']) && $svalue['user_details']['profile_image']!='')
										{
											$suser_img = url('/timthumb.php?src='.$this->doctor_public_img_path.$svalue['user_details']['profile_image'].'&h=100&w=100');	
										}						
									}
									else if($suser_blog->inRole('pharmacy'))
									{
										$obj = $this->PharmacyModel->where('user_id',$svalue['user_details']['id'])->first(); 
										if($obj) {$arra = $obj->toArray(); } 
										if(file_exists($this->pharmacy_base_img_path.$arra['logo']) && $arra['logo']!='')
										{
											$suser_img = url('/timthumb.php?src='.$this->pharmacy_public_img_path.$arra['logo'].'&h=100&w=100');
										}						
									}
								}
								$sub_comm_str .= '<div class="inn-comm">
                                <div class="comme-img">
                                    <img alt="comment img" src="'.$suser_img.'" />
                                </div>
                                <div class="comm-txt">
                                    <div class="coome-nm">
                                        '.$suser_name.'
                                    </div>
                                    <div class="share-date"><span> <img alt="img" src="'.url('/').'/images/art-cal.png" /> </span> <span>'.$sposted_date.'</span></div>
                                    <div class="com-content-text">
                                        <p>'.$svalue['comment'].'</p>
                                    </div>
                                </div>
                            	</div>';	
							}
						}
						
						$cal_img = url('/images/art-cal.png');
						$comment_str  .= 
							'<div class="comme-img">
	                            <img alt="comment img" src="'.$user_img.'" />
	                        </div>
	                        <div class="comm-txt">
	                            <div class="coome-nm">
	                                '.$user_name.$reply.'	                                
	                            </div>
	                            <div class="share-date"><span> <img alt="img" src="'.$cal_img.'" /> </span> <span>'.$posted_date.'</span></div>
	                            <div class="com-content-text">
	                                <p>'.$bvalue['comment'].'</p>
	                            </div>
	                            '.$sub_comm_str.'
	                        </div>';
	                }
	            }

	            $url = url("/blogs/comment/store/".$bvalue['blog_id']);
	            $comment_str .= '<br/>
                                <div class="comment-head">Leave a Comment</div>
                                <form name="frm_comment" id="frm_comment" method="post" action="'.$url.'">
                                    <div class="user-two">
                                        <input type="hidden" name="blog_parent" id="blog_parent" value="0" />
                                        <input type="hidden" name="blog_id" id="blog_id" value="'.$bvalue['blog_id'].'" />
                                        '.csrf_field().'
                                        <textarea placeholder="Comment*" name="txt_comments" id="txt_comments" class="text-com" rows="" cols=""> </textarea>
                                    </div>';
                                    
                                        $user = Sentinel::check();
                                    
                                    if(!$user)
                                    {
                                    	$comment_str .= '<div class="user-two">
                                        			<button class="post-com-btn" type="button" data-toggle="modal" href="#login">Post Comment</button>
                                        			<div class="clr"></div>
                                    			</div>';  
                                    }
                                    else
                                    {
                                    		$comment_str .= '<div class="user-two">
                                        		<button class="post-com-btn" type="submit">Post Comment</button>
                                        		<div class="clr"></div>
                                    		</div>';
                                    }
                                    
                                    $comment_str .= '<div class="clearfix"></div></form>';
			}
			else
			{
				$url = url("/blogs/comment/store/".$blog_id);
				$comment_str = '<br/>
		        <div class="comment-head">Leave a Comment</div>
		        <form name="frm_comment" id="frm_comment" method="post" action="'.$url.'">
		            <div class="user-two">
		                <input type="hidden" name="blog_parent" id="blog_parent" value="0" />
		                <input type="hidden" name="blog_id" id="blog_id" value="'.$blog_id.'" />
		                '.csrf_field().'
		                <textarea placeholder="Comment*" name="txt_comments" id="txt_comments" class="text-com" rows="" cols=""> </textarea>
		            </div>';
		            
		                $user = Sentinel::check();
		            
		            if(!$user)
		            {
		            	$comment_str .= '<div class="user-two">
		                			<button class="post-com-btn" type="button" data-toggle="modal" href="#login">Post Comment</button>
		                			<div class="clr"></div>
		            			</div>';  
		            }
		            else
		            {
		            		$comment_str .= '<div class="user-two">
		                		<button class="post-com-btn" type="submit">Post Comment</button>
		                		<div class="clr"></div>
		            		</div>';
		            }
		            
		            $comment_str .= '<div class="clearfix"></div></form>';
			}
			return $comment_str;
		}
	}
}