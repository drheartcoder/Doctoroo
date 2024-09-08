//<!-- Min Top Menu Start Here  -->

// footer dropdown links start 
     var min_applicable_width = 991; 
  
  $(document).ready(function () 
  {
    applyResponsiveSlideUp($(this).width(),min_applicable_width);
    
  });
  function applyResponsiveSlideUp(current_width,min_applicable_width)
  {
    /* Set For Initial Screen */
    initResponsiveSlideUp(current_width,min_applicable_width);

    /* Listen Window Resize for further changes */
    $(window).bind('resize',function()
    {
      if($(this).width()<=min_applicable_width)
      {
        unbindResponsiveSlideup();  
        bindResponsiveSlideup();
      }
      else
      {
        unbindResponsiveSlideup();  
      }  
    });
  }

  function initResponsiveSlideUp(current_width,min_applicable_width)
  {
    if(current_width<=min_applicable_width)
    {
      unbindResponsiveSlideup();  
      bindResponsiveSlideup();
    }
    else
    {
      unbindResponsiveSlideup();  
    }
  }

  function bindResponsiveSlideup()
  {
    $(".f-menus").hide();

    $(".f-title").bind('click', function () 
    {
      var $ans = $(this).next(".f-menus");
      $ans.slideToggle();
      $(".f-menus").not($ans).slideUp();
      $('.f-menus').removeClass('active');
      
      $('.f-title').not($(this)).removeClass('active');
      $(this).toggleClass('active');
      $(this).next('.f-menus').toggleClass('active');
    });


  }

  function unbindResponsiveSlideup()
  {
    $(".f-title").unbind('click');
    $(".f-menus").show();
  }
    // footer dropdown links end


    // sticky menu start
$(document).ready(function () {
        var stickyNavTop = $('.after-login-header-bg').offset().top;

        var stickyNav = function () {
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                $('.after-login-header-bg').addClass('sticky');
            } else {
                $('.after-login-header-bg').removeClass('sticky');
            }
        };

        stickyNav();

        $(window).scroll(function () {
            stickyNav();
        });
    })

// script for profile image uploading
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#upload-f')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }
      
// end

  function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $("body").css({
            "margin-left": "250px",
            "overflow-x": "hidden",
            "transition": "margin-left .5s",
            "position": "fixed"
        });
        $("#main").addClass("overlay");
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $("body").css({
            "margin-left": "0px",
            "transition": "margin-left .5s",
            "position": "relative"
        });
        $("#main").removeClass("overlay");
    }
    //  Min Top Sub Menu Start Here  

    $(".min-menu > li > .drop-block").click(function () {
        if (false == $(this).next().hasClass('menu-active')) {
            $('.sub-menu > ul').removeClass('menu-active');
        }
        $(this).next().toggleClass('menu-active');

        return false;
    });

    // script for hide show of sub menu

    //     $('.main-content').click(function(){
    //         $(this).next('.sub-menu').slideToggle('1000');
    //         $(this).find('.arrow i').toggleClass('fa-angle-down fa-angle-up')
    //         });

    $("body").click(function () {
        $('.sub-menu > ul').removeClass('menu-active');
    });





