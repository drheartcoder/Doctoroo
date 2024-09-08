/*Doctroo project common used js script*/
/*please note here all scripts added by designer plz do not remove any script its all important for project*/

// on click toggle for training
function delivery(ref)
{
      if(ref =='delivery-door') {
        $(".fp_radio_content1").show();
        $(".sp_radio_content1").hide();
      }
      
      if(ref =='delivery-collect') {
        $(".sp_radio_content1").show();
        $(".fp_radio_content1").hide();
      }      
}


 // footer start here
   var min_applicable_width = 991;
   
   $(document).ready(function() {
       applyResponsiveSlideUp($(this).width(), min_applicable_width);
   
   });
   
   
   
   function applyResponsiveSlideUp(current_width, min_applicable_width) {
       /* Set For Initial Screen */
       initResponsiveSlideUp(current_width, min_applicable_width);
   
       /* Listen Window Resize for further changes */
       $(window).bind('resize', function() {
           if ($(this).width() <= min_applicable_width) {
               unbindResponsiveSlideup();
               bindResponsiveSlideup();
           } else {
               unbindResponsiveSlideup();
           }
       });
   }
   
   function initResponsiveSlideUp(current_width, min_applicable_width) {
       if (current_width <= min_applicable_width) {
           unbindResponsiveSlideup();
           bindResponsiveSlideup();
       } else {
           unbindResponsiveSlideup();
       }
   }
   
   function bindResponsiveSlideup() {
       $(".footer-links").hide();
       $(".footer-heading").bind('click', function() {
           $(".footer-heading").not($(this)).removeClass('active');
           $(this).toggleClass('active');
           var $ans = $(this).next(".footer-links");
           $ans.slideToggle();
           $(".footer-links").not($ans).slideUp();
   
           $('.footer-links').removeClass('active');
           $(this).next('.footer-links').toggleClass('active');
       });
   }
   
   function unbindResponsiveSlideup() {
       $(".footer-heading").unbind('click');
       $(".footer-links").show();
   }

/*script for responsive menu */
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function() {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function() {
            $('#wrapper').toggleClass('toggled');
        });

       
 
   
//fluent js
;(function($) {

	// DOM ready
	$(function() {
		
	// Add some classes and Append the mobile icon nav
		$('.nav').append($('<div class="nav-mobile"></div>'));
		$('.nav > ul').addClass('nav-list');
		$('.nav > ul > li').addClass('nav-item');
		$('.nav > ul > li > ul').addClass('nav-submenu');
		$('.nav > ul > li > ul > li').addClass('nav-submenu-item');
		
	// Add a <span> to every .nav-item that has a <ul> inside. And add an sub menu icon indicator.
		$('.nav-item').has('ul').prepend('<span class="nav-click"><i></i></span>');
		
// Click to reveal the mobile menu
$('.nav-mobile').click(function(){
    $('.nav-list').toggle();
    $('.nav-submenu').hide(); // This will close the submenu when i click the top ribbon (.nav-mobile) to close the mobile menu
    if(!$('.nav-list').is(':visible')){ // the menu was closed because it's not visible anymore
        $('.nav-item .nav-click').each(function(){ // loop through nav clicks
            if($(this).hasClass('icon-close')) { // This will toggle back the + icon on mobile menu close/open
              $(this).toggleClass('icon-close');           
            }
        }); 
    }
});
	
// Dynamic binding to on 'click' and Toggle the nested nav
$('.nav-list').on('click', '.nav-click', function(){
    var currentSubmenu = $(this).siblings('.nav-submenu');
    var currentNavClick = $(this);
    $('.nav-submenu').not(currentSubmenu).slideUp();
    $('.nav-click').not(currentNavClick).removeClass('icon-close');
    $(this).siblings('.nav-submenu').toggle();


	// This will toggle the + and - when clicked
		$(this).removeClass('nav-click');
		$(this).toggleClass('icon-close');
		$(this).toggleClass('nav-click');   
	});
	
	// This will toggle the menu/submenu/- when click outside of the menu
		$('.wrapper').click(function(event) {
        $('html').one('click',function() {
        $('.nav-list').hide();
        $('.nav-submenu').hide(); // This will close the submenu when you click the top ribbon (hamburger button) to close the mobile menu
        if(!$('.nav-list').is(':visible')){ // the menu was closed because it's not visible anymore
        $('.nav-item .nav-click').each(function(){ // loop through nav clicks
        if($(this).hasClass('icon-close')) { // This will toggle the +/- icon on mobile menu close/open
         $(this).toggleClass('icon-close');
         }
      }); 
    }
 });
 event.stopPropagation();
});

});	

})(jQuery);


//droup down my accout top

        $(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                });
        });

   
//sticky menu only for color
    
        /*    var stickyNavTop = $('.header').offset().top;

            var stickyNav = function() {
                var scrollTop = $(window).scrollTop();

                if (scrollTop > stickyNavTop) {
                    $('.header').addClass('sticky');
                } else {
                    $('.header').removeClass('sticky');
                }
            };

            stickyNav();

            $(window).scroll(function() {
                stickyNav();
            });*/


