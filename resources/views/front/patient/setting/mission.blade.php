 @extends('front.patient.layout._no_sidebar_master')
@section('main_content')

 <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/legal" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align">{{$data_arr['page_title']}}</h1>
    </div>
    <div class="container posrel has-header has-footer minhtnor pdtbrl">
        <p><strong class="bluedoc-text">Mission</strong></p>
        <?php $page_desc=htmlentities($data_arr['page_desc']); $page_desc=html_entity_decode($page_desc); ?>
        <p class="grey-text">   {{$page_desc}}  </p>
        <div class="divider"></div>
        
    </div>
    <!--Container End-->
    @endsection