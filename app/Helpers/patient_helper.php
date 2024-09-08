<?php //Seema(6-March-2017)
use App\Models\FamilyMemberModel;
use App\Models\MedicalhistoryModel;
function get_profile_image()
{
  $user          = Sentinel::check();
  $user_info     = array();
  $arr_data      = array();
  if($user)
  {
    $user_info                                = $user->toArray();
    $arr_data['profile_image']                = $user_info['profile_image'];
    $arr_data['user_profile_public_img_path'] = url('/public').config('app.project.img_path.patient');
    $arr_data['user_profile_base_img_path'] = public_path().config('app.project.img_path.patient');
  }
  return $arr_data;
}
function get_familiy_member()
{
    $arr_famility_member  = [];
    $user                 = Sentinel::check();
    if($user)
    {
        $user_id                 = $user->id;
        $obj_familiy_member      = FamilyMemberModel::where('user_id','=',$user_id)->select('id','first_name','last_name')
                                                                                   ->get();
        if($obj_familiy_member)
        {
            $arr_famility_member = $obj_familiy_member->toArray();
        }

    }
    return $arr_famility_member;
}
function get_patient_data()
{
    $total_field    = 0;
    $member_id      = $obj_patient = '';
    $is_exist       = false;
    $user     = Sentinel::check();
    if($user)
    {
          $user_id                 = $user->id;
          $member_id               = Session::get('family_member_id');
          if(isset($member_id) && $member_id=="")
          {
             $member_id = 0;
          }

          $obj_patient             = MedicalhistoryModel::where('user_id','=',$user_id)
                                                         ->where('family_member_id','=',$member_id)
                                                         ->with(['illnessinfo'=>function($q) use($member_id,$user_id){

                                                            $q->where('user_id','=',$user_id);
                                                            $q->where('family_member_id','=',$member_id);
                                                            $q->select('id','user_id','family_member_id','illness_id');

                                                        }])
                                                         ->with(['patient_medical_history'=>function($q1)use($member_id,$user_id) {

                                                            $q1->where('user_id','=',$user_id);
                                                            $q1->where('family_member_id','=',$member_id);
                                                            $q1->select('id','user_id','family_member_id','medication_name');

                                                        }])
                                                      ->first();
                                                     // dd($obj_patient->toArray());
          if(isset($obj_patient) && $obj_patient!=false)
          {
              $is_exist = true;
          }


    }
    return $is_exist; 
}
function get_familiy_member_info()
{
          $arr_famility_member     = [];
          $member_id               = Session::get('family_member_id');
          if(isset($member_id) && $member_id!="")
          {
              $obj_familiy_member = FamilyMemberModel::where('id','=',$member_id)->select('id','first_name','last_name')->first();

              if($obj_familiy_member)
              {
                  $arr_famility_member = $obj_familiy_member->toArray();
              }

          }
          return $arr_famility_member;
}

?>