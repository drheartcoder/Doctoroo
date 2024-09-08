@extends('front.patient.layout._no_sidebar_master')
@section('main_content')

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/legal" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align"><?php if(!empty($conditions_arr['page_name'])){ echo $conditions_arr['page_name'];} ?></h1>
    </div>
    <div class="container posrel has-header has-footer minhtnor pdtbrl">
        
        <p class="grey-text">
        <?php if(!empty($conditions_arr['page_desc'])){ echo $conditions_arr['page_desc'];} ?>
        <div class="divider"></div>
        
    </div>
    <!--Container End-->

@endsection