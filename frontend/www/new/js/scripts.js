( function ($) {
'use strict';
jQuery(document).ready(function() {

	//preloader
	$("#status").fadeOut();
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 350);
	
	// Animate the header components
	$('#header-photo').delay( 100 ).animate({opacity: '1', 'margin-top' : '0'}, 1000, 'easeInOutCubic', function() {
		$('#header h1').delay( -200 ).animate({opacity: '1', 'padding-top': '0'}, 600, 'easeInOutCubic', function() {
			$('#header p').animate({opacity: '1'}, 400, 'easeInOutCubic');
		});
	});

	$('input, textarea').placeholder();

	// Minify the Nav Bar
	$(window).scroll(function () {
		var position = $(document).scrollTop(),
			headerHeight = $('#header').outerHeight(),
			navbar = $('.navbar');
		if (position >= 80){
			navbar.removeClass('navbar-on-header');
		} else {
			navbar.addClass('navbar-on-header');
		}
		if (position >= headerHeight){
			navbar.addClass('navbar-fixed-top minified');
		} else {
			navbar.removeClass('navbar-fixed-top minified');
		}


		// Parallax effect on #Header
		$(".banner .container").css({
			'opacity' : (1 - position/500)
		});

		// Show "Back to Top" button
		if (position >= headerHeight - 100){
			$('.scrolltotop').addClass('show-to-top');
		} else {
			$('.scrolltotop').removeClass('show-to-top');
		}

	});

	$(window).trigger("scroll");

	$("#menu-trigger").on("click", function(e) {
		var _self = $(this);
        //$(this).toggleClass("menu-trigger-visible");
        if ($("body").hasClass("show-menu")) {
        	_self.removeClass("menu-trigger-visible").addClass("menu-trigger-hidden");
            $("#menu-container").fadeOut(400, function() {
                $("body").removeClass("show-menu");
            });
        } else {
        	_self.removeClass("menu-trigger-hidden").addClass("menu-trigger-visible");
            $("body").addClass("show-menu");
            $("#menu-container").fadeIn(600);
        }
        return false;
        e.stopPropagation();
        e.preventDefault;
    });

	// Nice scroll to DIVs
	$('#my-nav li a').on("click", function(e){
		var place = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $(place).offset().top
			}, 1200, 'easeInOutCubic');
		if ($("body").hasClass("show-menu")) {
			$("#menu-trigger").removeClass("menu-trigger-visible").addClass("menu-trigger-hidden");
            $("#menu-container").fadeOut(400, function() {
                $("body").removeClass("show-menu");
            });
        }
		pde(e);
	});

	if ($("#typer").length > 0) {
		$('[data-typer-targets]').typer();
	}

	// Scroll down from Header
	$('#header p a').on("click", function(e) {
		var place = $(this).attr('href');
		$('html, body').animate({scrollTop: $(place).offset().top}, 1200, 'easeInOutCubic');
		pde(e);
	});


	// Scroll on Top
	$('.scrolltotop, .navbar-brand').on("click", function(e) {
		$('html, body').animate({scrollTop: '0'}, 1200, 'easeInOutCubic');
		pde(e);
	});


	//$(".dynamic-title").dynamicTitle();

	
	//Count numbers
	$("#count-projects").countUp(8000);
	$("#count-clients").countUp(40000);
	$("#count-hours").countUp(3000);
	$("#count-grow").countUp(2000);

	//Portfolio
	portfolio();

   
	// Testimonial slider
	$("#testimonials-slide").owlCarousel({
    	navigation : false,
      	paginationSpeed : 800,
	  	rewindSpeed:800,
      	singleItem:true,
 	  	autoPlay : true,
      	stopOnHover : false,
	  	dragBeforeAnimFinish : false,
	  	baseClass : "owl-carousel",
      	theme : "owl-theme",
      	mouseDrag : false,
      	touchDrag : false,
  	});
	
	//Twitter feed
	$("#tweet-slide").owlCarousel({
    	navigation : false,
      	paginationSpeed : 800,
	  	rewindSpeed:800,
      	singleItem:true,
 	  	autoPlay : true,
      	stopOnHover : false,
	  	dragBeforeAnimFinish : false,
	  	baseClass : "owl-carousel",
      	theme : "owl-theme",
      	mouseDrag : false,
      	touchDrag : false,
  	});
	
	//Function to prevent Default Events
	function pde(e){
		if(e.preventDefault)
			e.preventDefault();
		else
			e.returnValue = false;
	}

	// gmap
	if ($('#google-map-footer').length>0) {
		var pos=new google.maps.LatLng(35.394904, -120.863427),
			map={zoom:17,center:new google.maps.LatLng(35.394904, -120.863427),
			mapTypeId:google.maps.MapTypeId.ROADMAP,
			mapTypeControl:false,
			scrollwheel:false,
			zoomControl: true,
			zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL},
			draggable:!0,
			navigationControl:!1
		},
			gmap =new google.maps.Map(document.getElementById("google-map-footer"),map);
			google.maps.event.addDomListener(window,"resize",function(){var pos=gmap.getCenter();
			google.maps.event.trigger(gmap,"resize"),gmap.setCenter(pos)});
			
			var g='<div class="map-marker"><h4>Onemini</h4><p>2 Sandalwood Ave, California</p><p>United States of America</p></div>',
				a=new google.maps.InfoWindow({content:g}),
				t=new google.maps.MarkerImage(
						"images/google-marker.png",
						new google.maps.Size(36,48),
						new google.maps.Point(0,0),new google.maps.Point(25,50)),
						i=new google.maps.LatLng(35.394904, -120.863427),
						p=new google.maps.Marker({position:i,map:gmap,icon:t,zIndex:3});
			google.maps.event.addListener(p,"click",function(){a.open(gmap,p)}),
			$(".gmap-button").on("click", function(){$("#google-map-footer").slideToggle(300,function(){google.maps.event.trigger(gmap,"resize"),gmap.setCenter(pos)}),
			$(this).toggleClass("show-map")});
			
	}

	// blog list
	$('.flexslider').flexslider({controlNav:false});;
	$(".video-wrapper").fitVids();

	if ($("[data-rel=tooltip]").length) {
        $("[data-rel=tooltip]").tooltip();
    }

    /*==============================
        Ajax contact form
    ==============================*/
    if($("#send-message-form").length > 0){
      // Validate the contact form
      $('#send-message-form').validate({
        // Add requirements to each of the fields
        rules: {
          name: {
            required: true,
            minlength: 2
          },
          email: {
            required: true,
            email: true
          },
          message: {
            required: true,
            minlength: 10
          }
        },

        // Specify what error messages to display
        // when the user does something horrid
        messages: {
          name: {
            required: "Please enter your first name.",
            minlength: $.format("At least {0} characters required.")
          },
          email: {
            required: "Please enter your email.",
            email: "Please enter a valid email."
          },
          message: {
            required: "Please enter a message.",
            minlength: $.format("At least {0} characters required.")
          }
        },

        // Use Ajax to send everything to processForm.php
        submitHandler: function(form) {
          $("#submit-contact").html("Sending...");
          $(form).ajaxSubmit({
            success: function(responseText, statusText, xhr, $form) {
              $("#contact-content").slideUp(600, function() {
                $("#contact-content").html(responseText).slideDown(600);
              });
            }
          });
          return false;
        }
      });
    }

});



	function portfolio() {

		var container = $('.portfolio-box'),
			filter = $('.portfolio-filters'),
			loadmorediv = $('.load-more-portfolio'); 

		portfolioitem($(".portfolio-box"));
		portfolioNav();
		container.isotope({
			itemSelector : '.item',
			layoutMode: 'fitRows'
		});
		container.infinitescroll({
			navSelector : '.load-more-portfolio',
			nextSelector : '.load-more-portfolio a',
			itemSelector : '.item',
			loading: {
				finishedMsg: 'No more item to load.',
			  },
			errorCallback: function(){
			  loadmorediv.remove();              
			},
		  },
		  function(newElements) {
			var newElems = $(newElements);
			newElems.imagesLoaded(function(){
			container.isotope('appended', newElems );
			newCols();
			container.isotope('reLayout');
			portfolioitem(newElems);
			});
		  }
		);
		$(window).unbind('.infscr'); 
		$(".load-more-portfolio").on("click", function(){
			$('.portfolio-box').infinitescroll('retrieve');
			loadmorediv.show();
			return false;
		});
		filter.find('a').on("click", function() {
			var selector = $(this).attr('data-filter');
			filter.find('a').removeClass('active');
			$(this).addClass('active');
			container.isotope({ 
				filter: selector,
				animationOptions:{
				  animationDuration: 400,
				  queue: false
				}
			});
			return false;
		});
		function colType() { 
		  var winWidthfP = $(window).width(), 
		  colNumber = 1;
		  if (winWidthfP > 1200) {
		  	colNumber = 4;
		  } else if (winWidthfP > 767) {
		  	colNumber = 3;
		  } else if (winWidthfP > 480) {
		  	colNumber = 1;
		  } 
		  return colNumber;
		}
		function newCols() { 
		  var winWidthfP = $(window).width(), 
		  colNumber = colType(), 
		  itemWdt = Math.floor(winWidthfP / colNumber);
		
		  container.find('.item').each(function () { 
			  $(this).css({ 
			  	width : itemWdt + 'px' 
			  });
		  });
		}
		
		$(window).on('resize', function () { 
		  newCols();
		  container.isotope('reLayout');     
		});
		
		container.imagesLoaded(function () { 
		  newCols();
		  container.isotope('reLayout');
		});
	}

	/* Portfolio Items */
	function portfolioitem(e){
		$('.portfolio-details', e).on( "click", function() {
			var portfolioItemUrl = $(this).attr("href")+"?"+(new Date()).getTime(); 
			$('html, body').animate({ scrollTop: $(".portfolio-top").offset().top - 50},400);
			$('.portfolio-loading').css({ "display": "block", "opacity": "0"}).animate({"opacity": "0.6"},300);
			$('#portfolio-details-box').animate({opacity:0}, 400,function(){
			  $("#portfolio-details-box").load(portfolioItemUrl,function(){
				$('.flexslider').flexslider({animation: "fade",controlNav:false});
				$(".container").fitVids();
			  });
			  $('#portfolio-details-box').animate({opacity:1},400);
			});
			$('.portfolio-wrapper').slideUp(400, function(){
			  $('.portfolio-loading').delay(800).animate({ "opacity": "0" }, 100,function(){
				$('.portfolio-loading').css("display","none");
			  });
			  $('#portfolio-details-box').css('visibility', 'visible');}).delay(800).slideDown(400,function(){
				$('#portfolio-details-box').animate({opacity:1}, 400);
			  });
			return false;
		});
		
	} 

	function portfolioNav() {
		$('#portfolio-next').on( "click", function() {
			var portfolioItemNextUrl = $(".projectNextUrl").attr("href")+"?"+(new Date()).getTime();
			$('#portfolio-details-box').animate({opacity:0}, 400,function(){
			  $("#portfolio-details-box").load(portfolioItemNextUrl,function(){
				$('.flexslider').flexslider({animation: "fade",controlNav:false});
				$(".container").fitVids();
			  });
			  $('#portfolio-details-box').animate({opacity:1},400);
			});
		  return false;
		});
		
		$('#portfolio-prev').on( "click", function() {
			var portfolioItemPrevUrl = $(".projectPrevUrl").attr("href")+"?"+(new Date()).getTime();
			$('#portfolio-details-box').animate({opacity:0}, 400,function(){
			  $("#portfolio-details-box").load(portfolioItemPrevUrl,function(){
				$('.flexslider').flexslider({animation: "fade",controlNav:false});
				$(".container").fitVids();
			  });
			  $('#portfolio-details-box').animate({opacity:1},400);
			});
			return false;
		});
		
		$('#portfolio-close').on( "click", function() {
		  $('.portfolio-wrapper').slideUp(400, function(){
			  $('#portfolio-details-box').empty();
		  });
		  return false;
		});
	}
			
}( jQuery ));