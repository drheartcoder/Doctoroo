@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

<div class="header z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/setting" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">Family Doctor</h1>
    <div class="fix-add-btn">
        <a href="{{ url($module_url_path.'/family_doctors/add') }}"><span class="grey-text">Add a Doctor</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
        </a>
    </div>
</div>

<?php 
    $user_dumpId        = isset($arr_personal_details[0]['dump_id'])?$arr_personal_details[0]['dump_id']:'';
    $user_dumpSessionId = isset($arr_personal_details[0]['dump_session'])?$arr_personal_details[0]['dump_session']:'';
?>

<div class="medi minhtnor family-doct">
    <style>.required_field{color:red;}</style>
    
    <!--<div class="fixed-action-btn hidetext">
           <div class="container align-right">
            <a href="{{ url($module_url_path.'/family_doctors/add') }}"><span class="grey-text">Add a Doctor</span>
                <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
            </a>
          </div>
    </div>-->
    
    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer">
        <div class="container book-doct-wraper">
        
        @if(isset($family_doctors) && !empty($family_doctors))
        <ul class="collection brdrtopsd ">
            @foreach($family_doctors as $key => $val)

            <li class="collection-item avatar valign-wrapper">
                <div class="image-avtar left"> <img src="{{ url('/') }}/public/new/images/doctor-avtar.png" alt="" class="circle" /></div>
                <div class="doc-detail wid90 left"><span class="title" id="family_doctor_{{$key}}">{{isset($val['first_name']) && $val['first_name']!='' ? ucwords($val['first_name']) : "NA"}} {{isset($val['last_name']) && $val['last_name']!='' ? ucwords($val['last_name']) : "NA"}}</span></div>
                <div class="right posrel"> <a href="#" data-activates="dropdown_{{$val['id']}}" class="dropdown-button"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                <ul id='dropdown_{{$val["id"]}}' class='dropdown-content doc-rop rightless'>
                    <li>
                        <a href="{{$module_url_path}}/family_doctors/view/{{base64_encode($val['id'])}}">View Details</a>
                    </li>
                    <li><a href="{{$module_url_path}}/family_doctors/edit/{{base64_encode($val['id'])}}">Edit</a></li>
                    <li><a href="#remove_doctor" value='delete' doctor_id="{{$val['id']}}" class="remove_doctor_btn">Delete</a></li>
                    <li><a href="#remove_doctor" value='unlink' doctor_id="{{$val['id']}}" class="remove_doctor_btn">Unlink Family Doctor</a></li>
                </ul>
                <div class="clearfix"></div>
                @endforeach
            </li>
        </ul>
        @else
        <h5 class="center-align no-data">There is no doctor added yet.</h5>
        @endif
        <div class="clr"></div>
       

        <div id="remove_doctor" class="modal requestbooking">
            <div class="modal-data"><a class="modal-close closeicon"><i class="material-icons">close</i></a>
                <div class="row">
                    <div class="col s12 l12">
                        <input type="hidden" id="remove_doctor_id">
                        <p class="center"></p>
                        <input type="hidden" id="remove_doctor_action">
                    </div>
                </div>
            </div>
            <div class="modal-footer center-align two-btn-block">
                <a class="modal-close modal-action waves-effect waves-green btn-cancel-cons">Cancel</a>
                <a href="" value="" class="modal-action waves-effect waves-green btn-cancel-cons" id="btn_remove_member"></a>
            </div>
        </div>
    
    </div>
    </div>
    <!--Container End-->
</div>

   <!-- Data Decrypt -->
<script type="text/javascript">
var virgilToken   = '{{ env("VIRGIL_TOKEN") }}';
var dumpSessionId = '{{ $user_dumpSessionId }}';
var dumpId        = '{{ $user_dumpId }}';
var api           = virgil.API(virgilToken);
var key           = api.keys.import(dumpSessionId);

function decrypt(api, enctext, key)
{
    var decrpyttext = key.decrypt(enctext);
    var plaintext = decrpyttext.toString();
    return plaintext;
}


function encrypt(api, text, cards)
{
  // encrypt the text using User's cards
  var encryptedMessage = api.encryptFor(text, cards);

  var encData = encryptedMessage.toString("base64");

  return encData;
}

</script>

<script>
    var url="<?php echo $module_url_path; ?>";
    $(document).ready(function(){
        $('.remove_doctor_btn').click(function(e){
            e.preventDefault();
            
            $('#remove_doctor_id').val($(this).attr('doctor_id'));
            if($(this).attr('value')=='delete')
            {
                $('#remove_doctor_id').next('p').html("Do you really want to delete this Doctor?");
                $('#btn_remove_member').html('Delete');
                $('#remove_doctor_action').val('delete');
            }
            else
            {
                $('#remove_doctor_id').next('p').html("Do you really want to unlink Doctor?");
                $('#btn_remove_member').html('Unlink');
                $('#remove_doctor_action').val('unlink');   
            }
        });

        $('#btn_remove_member').click(function(e){
            e.preventDefault();
            var doctor_id=$('#remove_doctor_id').val();
            var action=$('#remove_doctor_action').attr('value');
            $.ajax({
                url:url+'/family_doctors/delete_unlink',
                type:'get',
                data:{doctor_id:doctor_id,action:action},
                success:function(data){
                    if(data.msg)
                    {
                        $("#remove_doctor .modal-close").click()
                        $(".open_popup").click();
                        $('.flash_msg_text').html(data.msg);
                    }
                }
            });
        });
    });
</script>

<!-- @if(isset($family_doctors) && !empty($family_doctors))
<script type="text/javascript">
  
  var family_doctors = '<?php echo json_encode($family_doctors); ?>';
  var family_doctors = jQuery.parseJSON( family_doctors );

  $.each(family_doctors, function (inner_key, val) {
    var first_name   = decrypt(api, val.first_name, key);
    var last_name   = decrypt(api, val.last_name, key);
    var name = first_name+' '+last_name;
    $('#family_doctor_'+inner_key).html(name);

  });

</script>
@endif -->

@endsection