 @extends('front.patient.layout._dashboard_master')
@section('main_content')

    <link href="{{ url('/') }}/public/terms_pages/css/doctooroo.css" rel="stylesheet"/>

    <div class="header z-depth-2 bookhead">
        <div class="backarrow "><a href="{{ url('/') }}/patient/setting/legal" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align"><?php if($data_arr['page_title']=='About Us'){echo "Our Mission";}else { echo $data_arr['page_title']; } ?></h1>
    </div>

    <!-- SideBar Section -->
    @include('front.patient.layout._sidebar')

    <div class="mar300 has-header has-footer minhtnor pdtbrl">
        <div class="container book-doct-wraper">

    <!-- <div class="container posrel has-header has-footer minhtnor pdtbrl"> -->
        <p><strong class="bluedoc-text"><?php if($data_arr['page_title']=='About Us'){echo "Our Mission";}else { echo $data_arr['page_title']; } ?></strong></p>
        <?php 
            $page_desc=html_entity_decode($data_arr['page_desc']);
        ?>
           <?php echo $page_desc; ?>  
        <div class="divider"></div>
        
        </div>
    </div>
    <!--Container End-->

    @endsection