<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" prefix="og: http://ogp.me/ns#">
   <head>
      @include('front.layout.css_js')
      <script>
         $(window).load(function() { 
         $("#flexiselDemo3").flexisel({
         visibleItems:5,
         animationSpeed: 1000,
         autoPlay: true,
         autoPlaySpeed: 3000,            
         pauseOnHover: true,
         enableResponsiveBreakpoints: true,
         responsiveBreakpoints: { 
          portrait: { 
              changePoint:480,
              visibleItems: 1
          }, 
          landscape: { 
              changePoint:640,
              visibleItems: 2
          },
          tablet: { 
              changePoint:769,
              visibleItems: 3
          },
             laptop: { 
                    changePoint:1024,
                    visibleItems: 3
                }
         }
         });
      
         });        
         
         (function() {
         /**
         * Video element
         * @type {HTMLElement}
         */
         var video = document.getElementById("my-video");
         if(video){         
         /**
         * Check if video can play, and play it
         */
           video.addEventListener( "canplay", function() {
            video.play();
         
         }); }
         });


         
      
      </script>
      
</head>
<body>