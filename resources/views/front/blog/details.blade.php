@extends('front.layout.master-coming-soon')
@section('main_content')
    <div class="banner-section-blog" style="background: transparent url('{{ url('/') }}/public/images/blog-banner-image.jpg'); background-repeat:no-repeat;
         -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover; background-attachment: fixed; background-position: center center; height: 246px;">{{ $blog_arr['title'] }}<span class="border-head-bottom"></span>
    </div>
    
    <div class="block-section-block bck-none pad-b-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="details-semi-head">
                        {{ $blog_arr['category_details']['category'] }} / by <span>{{ $blog_arr['postedby'] }}</span>
                    </div>
                    <div class="details-head-block">
                        {{ $blog_arr['title'] }}
                    </div>
                    <div class="details-content-block">
                        <p>{!! $blog_arr['description'] !!}</p>
                    </div>
                    <div class="share-on-block-main">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="share-on-title-text tags-label-details">
                                    SHARE ON:
                                </div>
                                <div class="social-icon-block">
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52f871da3e2b6b3d"></script>
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <div class="date-details-blog">
                                    <i class="fa fa-calendar"></i> On {{ date('F d, Y',strtotime($blog_arr['date'])) }}
                                </div>
                            </div>
                        </div>
                    </div>
                   {!! $comment_str !!}
                </div>
                @include('front.blog.rightbar')

                <script>
                    function addreply(blog_id)
                    {
                        $('#blog_parent').val(blog_id);
                        $('#txt_comments').focus();
                        $("html, body").animate({ scrollTop: $(document).height()-parseInt(1000) }, 2000);
                    }

                </script>
            </div>
        </div>        
    </div>
@stop