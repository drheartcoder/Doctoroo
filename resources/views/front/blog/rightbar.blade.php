 <div class="col-sm-12 col-md-3 col-lg-3">
 						<form name="frm_blog_search" id="frm_blog_search" action="{{ url('/blogs') }}" method="get">
 						{{ csrf_field() }}
		                    <div class="search-block-main">
		                        <input type="text" name="txt_search" id="txt_search" value="{{ Request::query('txt_search') }}" placeholder="Search.." />
		                        <button class="search-magni-btn" type="submit" name="btn_search" id="btn_search"  /><i class="fa fa-search"></i></button>
		                    </div>
		                </form>
		                    <div class="diver-blog-right-section"></div>
		                    <div class="blog-tab-section">
		                        <div data-responsive-tabs class="garag-profile-nav ans-tabs">
		                            <nav>
		                                <ul>
		                                    <li><a href="#one" class="title-archive-block">Latest</a> </li>
		                                    <!-- <li><a href="#two">Popular</a></li> -->
		                                </ul>
		                            </nav>
		                            <div class="content res-full-tab">
		                                <div id="one">
		                                @if(count($blog_arr_latest)>0)
                    						@foreach($blog_arr_latest as $blogarr)
		                                    
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

		                                    <div class="latest-blog-one">
		                                        <div class="blog-img-latest">
		                                            <img src="{{ $blog_image }}" alt="" />
		                                            <!-- <img src="{{ url('/') }}/timthumb.php?src={{ $blog_image_url.$blogarr['image'] }}&h=355&w=370" alt="" /> -->
		                                        </div>
		                                        <div class="latest-blog-head">
		                                            <div class="head-blog-latest">
		                                                <a href="{{ url('/blogs/'.$blogarr['slug']) }}" style="color:#09273f;">{{ $blogarr['title'] }}</a>
		                                            </div>
		                                            <div class="latest-block-date">
		                                                 {{ date('D d, Y',strtotime($blogarr['date'])) }}
		                                            </div>
		                                        </div>
		                                    </div>
		                                	@endforeach
                        				@endif
		                                </div>
		                                
		                            </div>
		                        </div>
		                    </div>
		                    <?php
		                    $img_arr = array('blog-right-img-1.jpg','blog-right-img-2.jpg','blog-right-img-3.jpg','blog-right-img-4.jpg');
		                    $i=0;
		                    ?>
		                    <div class="diver-blog-right-section"></div>
		                    @if(count($blog_category)>0)
		                    	@foreach($blog_category as $bc)
		                    <div class="right-section-categories">
		                        <div class="child-care-section">
		                            <img src="{{ url('/') }}/public/images/{{ $img_arr[$i] }}" alt="" />
		                            <div class="cate-count-block">
		                                @php $slug_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $bc['category']))); @endphp
		                                <!-- <a href="{{ url('/blogs/'.$slug_name.'-'.$bc['id']) }}" style="color:#ffffff;">{{ $bc['category'] }}({{ 
		                                $bc['cat_order']}})</a> -->
		                                <a href="{{ url('/blogs/'.$slug_name) }}" style="color:#ffffff;">{{ $bc['category'] }}({{ $bc['cat_order']}})</a>
		                            </div>
		                        </div>
		                    </div>
		                    <?php $i++; ?>
		                    	@endforeach
		                    @endif
		                    <div class="diver-blog-right-section"></div>
		                    @if(count($blog_category)>0)
		                    <div class="tag-cloud-block">
		                        <div class="title-tag-cloud">
		                            tag cloud
		                        </div>
		                        
		                        	@foreach($blog_category as $blg_a)
		                        		@php $slug_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $blg_a['category']))); @endphp
		                        		<!-- <a href="{{ url('/blogs/'.$slug_name.'-'.$blg_a['id']) }}" style="text-decoration:none;">{{ $blg_a['category'] }}</a> -->
		                        		<a href="{{ url('/blogs/'.$slug_name) }}" style="text-decoration:none;">{{ $blg_a['category'] }}</a>
		                        	@endforeach
		                    </div>
		                    @endif
		                    <div class="diver-blog-right-section"></div>
		                    <?php $instagrm_images = getInstaImages(); ?>
		                    @if(count($instagrm_images)>0)
		                    <div class="instagram-block-main">
		                        <div class="title-tag-cloud">
		                            Instagram
		                        </div>
		                        <div class="instagram-block">
		                        	@foreach($instagrm_images as $ins_img)
		                            <div class="instagram-images">
		                                <a href="{{ $ins_img['link'] }}"><img src="{{ $ins_img['img_src'] }}" alt="" height="83" width="83" /></a>
		                            </div> 
		                            @endforeach
		                            <div class="clr"></div>
		                        </div>                       
		                    </div>
		                    <div class="diver-blog-right-section"></div>
		                    @endif

		                    
		                    
		                    <div class="find-us-on-facebood">
		                        <div class="title-tag-cloud">
		                            find us on facebook
		                        </div>
		                        <div class="find-us-img">
		                        <div id="fb-root"></div>
								<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								<div class="fb-page" data-href="https://www.facebook.com/mydoctoroo" data-tabs="timeline" data-width="272" data-height="519" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"></div>
								
		                            <!-- <img src="{{ url('/') }}/public/images/find-us-facebood-img.jpg" alt="" /> -->
		                        </div>
		                    </div>
		                    <div class="diver-blog-right-section"></div>
		                    
		                    @if(count($YearHeirarchy)>0)
		                    <div class="archive-block">
		                        <div class="title-archive-block">
		                            Archive
		                        </div>
		                        <div class="archive-content-block" id="accordion">
		                        	@foreach($YearHeirarchy as $hkey => $hvalue) 
		                              <div class="panel panel-default">
		                                <div class="panel-heading">
		                                    <h4 class="panel-title">
		                                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $hkey }}">{{ $hkey }}</a>
		                                    </h4>
		                                </div>
		                                <div id="collapseOne{{ $hkey }}" class="panel-collapse collapse in">
		                                @if(count($hvalue)>0)
		                                 	@foreach($hvalue as $hv_year)
		                                    <div class="panel-body">
		                                       <div class="month-name-block">
		                                           <a href="{{ url('/blogs/search/'.$hkey.'/'.$hv_year) }}" style="text-decoration:none;color:#3a3a3a;">{{ $hv_year }}</a>
		                                       </div>
		                                    </div>
		                                    @endforeach
		                                @endif
		                                </div>
		                              </div>
		                             @endforeach
		                        </div>
		                    </div>
		                    @endif
		                </div>