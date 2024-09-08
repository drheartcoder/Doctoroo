<!--share a link popup start here-->
<div id="referral_share" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
   <div class="modal-dialog loign-insw">
      <!-- Modal content-->
      <div class="modal-content share-link-modal">
         <div class="modal-header head-loibg">
            <button type="button" class="login_close close" data-dismiss="modal"><img src="{{ url('/') }}/public/images/close-popup.png" alt=""></button>
         </div>
         <div class="modal-body bdy-pading">
            <div class="login_box signup2">
              
               <div class="tag-txt green-title">Welcome to the Doctroo community !</div>
               <div class="tag-txt1">To receive your $10 credit..</div>
               <div class="tag-txt">Simply share your link or code with your friends so we can take care of them too - They'll love you for it!</div>
               <ul class="share-links">

                   <li><a href="javascript:void(0);" class="link_skype skype-share" data-href="{{ url('/') }}" data-lang='' data-text="What's the best way to see a doctor? On any device, anytime, anywhere! Sign up to doctoroo for free like I did to see a doctor online, get your prescriptions, certificates and medication delivered when you or your family need it most:" width='780' height='550'><img src="{{ url('/') }}/public/images/skype.png" class="img-responsive" alt=""/></a></li>

                   <li><a href="" class="link_share twitter link_twitter"><i class="fa fa-twitter"></i></a></li>

                   <li><a href="" class="link_share fb link_fb"><i class="fa fa-facebook"></i></a></li>

                   <li><a href="" class="link_share goole-plus link_gplus"><i class="fa fa-google-plus-official"></i></a></li>

               </ul>
               
               <div class="clearfix"></div>

               <p class="or-block">---OR---</p>
               <p class="green-txt">Share Link</p>
               <div class="user_box">
                  <input type="text" id="referral_url" class="input_acct-logn signp" value="{{ url('/') }}/referral_code/" />
               </div>
               <div class="user_box">
                  <input type="text" id="referral_code" class="input-code" value="" style="width: 140px;" />
               </div>
               <div class="clearfix"></div>
               <div class="login-bts round-btn m-top-remove">
                   <button id="copy_link" class="btn btn-search-login" value="submit">Copy Link</button>
               </div>
              <div class="tag-txt green-title">Stay connected with the community !</div>
              <div class="tag-txt">Be the first to know when we launch </div>
               
               @php $social_media = get_social_links(); @endphp
               <ul class="share-links2">
                  @if(!empty($social_media['facebook_link']) && isset($social_media['facebook_link']))
                    <li><a href="{{ $social_media['facebook_link'] }}" target="_blank" class="fb2"><i class="fa fa-facebook-official"></i></a></li>
                  @endif
                  @if(!empty($social_media['twitter_link']) && isset($social_media['twitter_link']))
                    <li><a href="{{ $social_media['twitter_link'] }}" target="_blank" class="tw2"><i class="fa fa-twitter-square"></i></a></li>
                  @endif
                  @if(!empty($social_media['google_link']) && isset($social_media['google_link']))
                    {{-- <li><a href="{{ $social_media['google_link'] }}" class=""><i class="fa fa-twitter"></i></a></li> --}}
                  @endif
                  @if(!empty($social_media['instagram_link']) && isset($social_media['instagram_link']))
                    <li><a href="{{ $social_media['instagram_link'] }}" target="_blank" class="insta2"><i class="fa fa-instagram"></i></a></li>
                  @endif
               </ul>
               <div class="extra-txt">
               <p>Once your friend has signed up using your unique link you'll have your free $10 credit automatically applied to your account to use when doctroo launches.</p>
               <a href="{{url('/')}}/health/terms-of-use" target="_blank">Terms and Conditions apply</a>
               </div>
                
                <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--share a link popup end here-->

<script>
 $('#copy_link').click(function()
  {
    $('#referral_url').val();
    $('#referral_url').select();
    document.execCommand('copy');
  });
</script>

{{-- share popup window start here --}}
<script>
  
  /*$( document ).ready(function() {
    var referral_url = $('#referral_url').val();
    $("a.link_skype").attr("href", referral_url);
    $("a.link_gmail").attr("href", referral_url);
    $("a.link_twitter").attr("href", "https://twitter.com/intent/tweet?text=There+is+a+good+website+of+doctor+which+is+very+useful+to+all.+Use+this+link+to+register.&url="+referral_url);
    $("a.link_fb").attr("href", "https://www.facebook.com/sharer/sharer.php?u="+referral_url);
    $("a.link_gplus").attr("href", "https://plus.google.com/share?url="+referral_url);
    $("a.link_whatsapp").attr("href", referral_url);
  });*/

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '.link_share', function(e){

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });
</script>
{{-- share popup window end here --}}

{{-- Skype share popup window start here --}}
<script>
// Place this code in the head section of your HTML file 
(function(r, d, s) {
  r.loadSkypeWebSdkAsync = r.loadSkypeWebSdkAsync || function(p) {
    var js, sjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(p.id)) { return; }
    js = d.createElement(s);
    js.id = p.id;
    js.src = p.scriptToLoad;
    js.onload = p.callback
    sjs.parentNode.insertBefore(js, sjs);
  };
  var p = {
    scriptToLoad: 'https://swx.cdn.skype.com/shared/v/latest/skypewebsdk.js',
    id: 'skype_web_sdk'
  };
  r.loadSkypeWebSdkAsync(p);
})(window, document, 'script');
</script>

<!-- Add class skype-share and data-style attribute with value (large, small, circle, square) to get the default button style -->
<!-- Additional attributes: data-lang='en-US' (for language) data-href='' (use '' for page URL, 'www.skype.com' for specific URL) -->
<!-- data-text = 'some message' (to pre-fill the message to that will be shared by the user, use '' to prompt user to enter a message) -->
<!-- Place the code of the share button where you what the share button to appear -->
<!-- <div class='skype-share' data-href='http://http://192.168.1.31/doctoroo/public/' data-lang='' data-text='' data-style='circle' ></div> -->

{{-- Skype share popup window end here --}}