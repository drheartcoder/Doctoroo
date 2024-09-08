<?php 

use App\Models\PharmacyModel;

function get_pharmacy_profile_data()
{
    $arr_details = $arr_pharmacy_profile = [];

    $pharmacy_base_img_path   = public_path().config('app.project.img_path.pharmacy');
    $pharmacy_public_img_path = url('/public').config('app.project.img_path.pharmacy');

    $user   = Sentinel::check();
    if($user)
    {
        $obj_details     = PharmacyModel::where('user_id',$user->id)
                                  ->first(['pharmacy_name','logo']);
        if($obj_details)
        {
          $arr_details   = $obj_details->toArray();
        }
        $arr_pharmacy_profile['pharmacy_base_img_path']   = $pharmacy_base_img_path;
        $arr_pharmacy_profile['pharmacy_public_img_path'] = $pharmacy_public_img_path;
        $arr_pharmacy_profile['logo']                     = $arr_details['logo'];
        $arr_pharmacy_profile['pharmacy_name']            = $arr_details['pharmacy_name'];
    }
    return  $arr_pharmacy_profile;
    
}

?>