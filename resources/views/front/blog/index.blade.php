@extends('front.layout.master-coming-soon')
@section('main_content')
 <div class="banner-section-blog" style="background: transparent url('{{ url('/') }}/public/images/blog-banner-image.jpg'); background-repeat:no-repeat;
         -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover; background-attachment: fixed; background-position: center center; height: 246px;">
        Blogs <span class="border-head-bottom"></span>
    </div>
    <div class="block-section-block bck-none pad-b-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    	@if(count($blog_arr['data'])>0) 
                    		@foreach($blog_arr['data'] as $blogarr)
                    		<?php $count_fav = get_count_favorite($blogarr['id']); ?>
                        <div class="blog-one-main">
                           <div class="row">
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="block-img-block">

                                    @php
                                    // check listisng image
                                    if ( isset($blogarr['image']) && !empty($blogarr['image']) )
                                    {
                                        $blog_image = url('/')."/timthumb.php?src=".$blog_image_url.$blogarr['image']."&h=355&w=370";
                                        // check if image exists or not
                                        if ( File::exists($blog_image) ) 
                                        {
                                            $blog_image = url('/')."/timthumb.php?src=".$blog_image_url."default-thumbnail.jpg&h=355&w=370";
                                        } // end if
                                    } // end if
                                    else
                                    {
                                        $blog_image = url('/')."/timthumb.php?src=".$blog_image_url."default-thumbnail.jpg&h=355&w=370";
                                    } // end else
                                    @endphp

                                    <img src="{{ $blog_image }}" alt="" />
                                    <div class="date-block-img">
                                        <div class="month-block">
                                           {{ date('F',strtotime($blogarr['date'])) }}
                                        </div>
                                        <div class="date-year-block">
                                            {{ date('d, Y',strtotime($blogarr['date'])) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="content-block">
                                    <div class="block-head-content">
                                        <a href="{{ url('/blogs/'.$blogarr['slug']) }}" style="color: #3a3a3a;">{{ $blogarr['title'] }}</a>
                                    </div>
                                    <div class="cardiology-block" style="text-transform: inherit;">
                                        <span><i class="fa fa-heartbeat"></i> {{ isset($blogarr['category_details']['category'])?$blogarr['category_details']['category']:'' }}</span><span><i class="fa fa-circle"></i> By {{ $blogarr['postedby'] }} </span>
                                    </div>
                                    <div class="content-blog-container">
                                       
                                        <?php echo strip_tags($blogarr['description']); ?>
                                           
                                    </div>
                                    <div class="blog-read-more">
                                        <!-- <a href="{{ url('/blogs/'.str_replace(' ','-',str_replace('?','',$blogarr['title']).'-'.$blogarr['id'])) }}"  class="btn-read-block">Read More</a> -->
                                        <a href="{{ url('/blogs/'.$blogarr['slug']) }}" class="btn-read-block">Read More</a>
                                    </div>
                                    <div class="share-view-block">
                                    <?php 
                                    	$user = Sentinel::check();
                                    	if($user){$user_id = $user->id;}
                                    	else{$user_id = 0;}
                                    ?>
                                    <ul>
                                        <li><a style="cursor: pointer;"><i class="fa fa-share-alt"></i></a></li>
                                        <li><a style="cursor: pointer;"><i class="fa fa-eye"></i> {{  $cnt = getViewCountBlog($blogarr['id']) }}</a></li>
                                        <li><a style="cursor: pointer;"><i class="fa fa-comments-o"></i> {{ $num = getCommentCountBlog($blogarr['id']) }}</a></li>
                                        @if(in_array($blogarr['id'],$blog_arr_fav))
                                        <li><a style="cursor: pointer;" class="addtofavorite" data-blog="{{  $blogarr['id']  }}" data-user="{{ $user_id }}"><i class="fa fa-heart"></i> {{ $count_fav }}</a></li>
                                        @else
                                        <li><a style="cursor: pointer;" class="addtofavorite" data-blog="{{  $blogarr['id']  }}" data-user="{{ $user_id }}"><i class="fa fa-heart-o"></i> {{ $count_fav }}</a></li>
                                        @endif
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        	@endforeach
                            @include('front.layout._pagination_view', ['paginator' =>$arr_pagination]) 
                        @else
                            {{ 'Blogs Coming Soon...' }}
                        @endif                       
                        
		                </div>
		               @include('front.blog.rightbar')
            </div>
        </div>
    </div>
    
@stop