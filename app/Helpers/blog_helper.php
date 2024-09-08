<?php
use App\Models\BlogFavoriteModel;
use App\Models\BlogCommentModel;
use App\Models\BlogViewModel;
use App\Models\BlogModel;

function get_count_favorite($blog_id)
{
  $res_count = '';
  if($blog_id!='' && $blog_id!='0')
  {
    $num = BlogFavoriteModel::where('blog_id',$blog_id)->count();  
    if($num==0)
      {}else{return $num;}
  }
  return $res_count;
}

function get_blog_details_new($blog_id)
{
	
	$res_array = array();
  	if($blog_id!='' && $blog_id!='0')
  	{
    	$num = BlogModel::where('id',$blog_id)->first();  
    	if($num)
      	{
      		return $num->toArray();
      	}
  	}
  	return $res_array;
}

function getInstaImages()
{
	$arr_tmp = array();
	$access_token = '4339373895.6654187.4dd1c4d95fcc4c5b879283e59943b197';
	$photo_count=9;
	     
	$json_link="https://api.instagram.com/v1/users/self/media/recent/?";
	$json_link.="access_token={$access_token}&count={$photo_count}";

	$json = @file_get_contents($json_link); //dd($json_link);
	$record = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json));

	if(sizeof($record)>0)
	{
		foreach($record->data as $key => $sub_arr) 
		{
			$res=0;
			$arr_tmp[$key]['img_src'] = $sub_arr->images->low_resolution->url;
			$arr_tmp[$key]['link'] = $sub_arr->link;
		}
	}
	return $arr_tmp;
}

function getCommentCountBlog($blog_id)
{
		$res_count = 0;
		if($blog_id!='' && $blog_id!='0')
		{
			$num = BlogCommentModel::where('blog_id',$blog_id)->count();  
			if($num==0)
			{}else{return $num;}
		}
		return $res_count;
}

function getViewCountBlog($blog_id)
{
		$res_count = 0;
		if($blog_id!='' && $blog_id!='0')
		{
			$num = BlogViewModel::where('blog_id',$blog_id)->count();  
			if($num==0)
			{}else{return $num;}
		}
		return $res_count;
}

?>