 @extends('front.doctor.layout.new_master')
@section('main_content')

<link href="{{ url('/') }}/public/terms_pages/css/doctooroo.css" rel="stylesheet"/>

 <div class="header bookhead z-depth-2 ">
        <div class="backarrow "><a href="{{ url('/') }}/doctor/settings/legal" class="center-align"><i class="material-icons">chevron_left</i></a></div>
        <h1 class="main-title center-align"><?php if($data_arr['page_title']=='About Us'){echo "Our Mission";}else { echo $data_arr['page_title']; } ?></h1>
    </div>

    <!-- SideBar Section -->
    @include('front.doctor.layout._new_sidebar')

    <div class="mar300 has-header minhtnor">
    <div class="container pdmintb">
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