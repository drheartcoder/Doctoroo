@extends('front.patient.layout._dashboard_master')
@section('main_content')


<div class="header paymethodhead z-depth-2 bookhead">
    <div class="backarrow "><a href="{{ url('/') }}/patient/my_health/medical_history/general#medication-condition" class="center-align"><i class="material-icons">chevron_left</i></a></div>
    <h1 class="main-title center-align">My Health</h1>

    <div class="fix-add-btn">
      <a href="{{ url('/') }}/patient/my_health/add_medication"><span class="grey-text">Add Medication</span>
         <div class="btn-floating btn-large medblue"><i class="large material-icons">add</i></div> 
      </a>
    </div>
</div>

<!-- SideBar Section -->
@include('front.patient.layout._sidebar')


    <div class="header medicationhead z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/my_health/medical_history/general" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align truncate">Medication Details</h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer minhtnor medicationmain">
        <div class="container book-doct-wraper">
        <div class="form">
            <div class="input-field col s12 text-bx errormed-add">
                <input type="text" id="medication_name" class="validate">
                <label for="medication_name" data-error="wrong" data-success="right" class="truncate">Enter medication name or active ingredient<span style="color:red">*</span></label>
                <span class="error"></span>
            </div>
            <div class="clear"></div>
            <div class="input-field col s12 text-bx errormed-add">
               <input type="text" id="medication_purpose" class="validate medication_purpose" value="">
               <label for="medication_purpose" data-error="wrong" data-success="right" class="truncate">Enter use or why you take</label>
            </div>
            <div class="clear"></div>
            <div class="input-field col s12 text-bx errormed-add">
               <input type="text" id="medication_duration" class="validate medication_duration" value="">
               <label for="medication_duration" data-error="wrong" data-success="right" class="truncate">How long have you been taking it?</label>
            </div>
            <div class="clear"></div>

            <span class="right qusame rescahnge"><a href="javascript:void(0)" class="btn cart bluedoc-bg lnht round-corner" id="btn_save_medication">SAVE</a></span>

            
            <div class="clr"></div>

        </div>
        
        </div>
    </div>

<input type="hidden" id="medication_id" name="medication_id" value="" />
<script>
var url="<?php echo $module_url_path; ?>";
$(document).ready(function(){

    $('#btn_save_medication').click(function(){
        var medication_name     = $('#medication_name').val();
        var medication_purpose  = $('#medication_purpose').val();
        var medication_duration = $('#medication_duration').val();

        $('.error').html("");
        if($('#medication_name').val()=='' || $('#medication_name').val()==null)
        {
            $('.error').html("Please enter Medication name").css('color','red');
            return false;
        }


        var card_id              = "{{ $user_details->dump_id }}"
        var userkey              = "{{ $user_details->dump_session }}";
        var VIRGIL_TOKEN         = "{{ env('VIRGIL_TOKEN') }}";
        var api                  = virgil.API(VIRGIL_TOKEN);

        var findkey = api.cards.get(card_id)
           .then(function (cards) {

                    var enc_medication_name                  = encrypt(api, medication_name, cards);
                    var enc_medication_purpose               = encrypt(api, medication_purpose, cards);
                    var enc_medication_duration              = encrypt(api, medication_duration, cards);

                    var token = "<?php echo csrf_token(); ?>";
                     $.ajax({
                        url:url+'/medication_store',
                        type:'post',
                        data:{
                            _token:token,
                            medication_name:enc_medication_name,
                            medication_purpose:enc_medication_purpose,
                            medication_duration:enc_medication_duration
                        },
                        success:function(data){
                            
                            $(".open_popup").click();
                            $('.flash_msg_text').html(data.msg);
                            $('#medication_id').val(data.id);
                            $('#medication_name').val('');
                        }
                     });

        }).then(null, function (error) {
            $(".open_popup").click();
            $('.flash_msg_text').html(error);
            return false;
        });

          

    });

    $('.modal-close').click(function(){
        var id = $('#medication_id').val();
        if(id != '')
        {
            window.location = "{{ url('/') }}/patient/my_health/prescription/"+id;
        }
    });
});
</script>

    <!--Container End-->
@endsection