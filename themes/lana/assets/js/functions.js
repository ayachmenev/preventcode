/*
 * Title: Main Lana Javascript File
 * Author: http://www.theme-vision.com
 */
 var THEMEVISION = THEMEVISION || {};
 
 (function($) {
	
	"use strict";
	
	/**
	 * Initialization
	 *
	 * @since 1.0.0
	 */
	THEMEVISION.initialize = {
		
		init: function() {
			
			THEMEVISION.initialize.backToTop();
			
		},
		
		stickyMenu: function() {
			var $enableStickyHeader = lana.sticky_header;

			if ($enableStickyHeader == 1 && $content.length > 0 && $mainMenu.length > 0) {
				var forchBottom;
				var stickyHeader 	= $mainMenu.clone().hide().appendTo(document.body).wrap("<div class='sticky-header hidden-mobile'><div class='container'></div></div>");
				var cloneLogo		= $logo.clone().prependTo('.sticky-header .container');
				var forch			= $content.first();
				
				forchBottom = forch.offset().top + 2;
				
				if( jQuery('#wpadminbar').length > 0 ) {
					jQuery('.sticky-header').css('top', '32px');
				}

				// On Scroll
				$window.on('scroll', function () {
					var top = $document.scrollTop();
					if (jQuery('.sticky-header').is(":hidden") && top > forchBottom) {
						jQuery('.sticky-header').slideDown(300);
					} else if (jQuery('.sticky-header').is(":visible") && top < forchBottom) {
						jQuery('.sticky-header').slideUp(200);
					}
				});
				
				// On Resize
				$window.on('resize', function () {
					var top = $document.scrollTop();
					if (jQuery('.sticky-header').is(":hidden") && top > forchBottom) {
						jQuery('.sticky-header').slideDown(300);
					} else if (jQuery('.sticky-header').is(":visible") && top < forchBottom) {
						jQuery('.sticky-header').slideUp(200);
					}
				});
				
				jQuery('.sticky-header').css("visibility", "hidden");
				stickyHeader.show();
				jQuery('.sticky-header').hide();
				jQuery('.sticky-header').css("visibility", "visible");
			}
		},
		
		backToTop: function() {
			$body.on("click", "#back-to-top", function(e){
				e.preventDefault();
				$body.animate({scrollTop: 0}, 1000);
			});
		}
		
	};
	
	THEMEVISION.header = {
		
		init: function() {
			
			THEMEVISION.header.navigationWrap();
			
		},
		
		navigationWrap: function() {
			$('#main-menu ul li a').not('#main-menu ul.sub-menu li a').wrapInner('<span></span>');
		},
		
		mobileMenu: function() {
			$(".mobile-menu ul.menu > li.menu-item-has-children").each(function(index) {
				var menuItemId = "mobile-menu-submenu-item-" + index;
				$('<button class="dropdown-toggle collapsed" data-toggle="collapse" data-target="#' + menuItemId + '"></button>').insertAfter($(this).children("a"));
				
				$(this).children("ul").prop("id", menuItemId);
				$(this).children("ul").addClass("collapse");

				$("#" + menuItemId).on("show.bs.collapse", function() {
					$(this).parent().addClass("open");
				});
				$("#" + menuItemId).on("hidden.bs.collapse", function() {
					$(this).parent().removeClass("open");
				});
			});
		}
		
	};
	
	THEMEVISION.slider = {
		
		init: function() {
			
			THEMEVISION.slider.start();
			
		},
		
		start: function() {
			if( $('div').hasClass('owl-carousel') ) {
				$('.owl-carousel').owlCarousel({
					autoplay: true,
					loop: true,
					autoHeight: false,
					responsiveClass: true,
					responsive:{
						0:{
							items: 1,
							nav: true
						},
						600:{
							items: 2,
							nav: true
						},
						1000:{
							items: 3,
							nav: true
						}
					},
					navText: []
				});
			}
		}
	};
	
	THEMEVISION.extras = {
		
		init: function() {
			
			THEMEVISION.extras.accordionNtoggles();
			
		},
		
		// accordion & toggles
		accordionNtoggles: function() {
			$(".toggle-container .panel-collapse").each(function() {
				if (!$(this).hasClass("in")) {
					$(this).closest(".panel").find("[data-toggle=collapse]").addClass("collapsed");
				}
			});
		}
		
	}
	
	/**
	 * Document on Resize
	 *
	 * @since 1.0.0
	 */
	THEMEVISION.documentOnResize = {
		init: function() {
			
			var t = setTimeout( function(){
				
			}, 500 );
			
		}
	}
	
	/**
	 * Document on Ready
	 *
	 * @since 1.0.0
	 */
	THEMEVISION.documentOnReady = {
		init: function() {
			
			THEMEVISION.initialize.init();
			THEMEVISION.header.init();
			THEMEVISION.slider.init();
			THEMEVISION.extras.init();
			
		},
		windowscroll: function(){
			$window.on( 'scroll', function(){
				
				// js on scroll code here
				
			});
		}
	}
	
	/**
	 * Document on Load
	 *
	 * @since 1.0.0
	 */
	THEMEVISION.documentOnLoad = {
		init: function() {
			
			THEMEVISION.initialize.stickyMenu();
			THEMEVISION.header.mobileMenu();
			
		}
	}
	
	var $window	 		= $(window),
		$document		= $(document),
		$body	 		= $('body'),
		$wpadminbar		= $('#wpadminbar'),
		$logo			= $('.logo'),
		$content		= $('#content'),
		$stickyHeader	= $('.sticky-header'),
		$mainMenu		= $('#main-menu ul.menu'),
		$slider			= $('#lana_slider'),
		$tooltip		= $('[data-toggle=tooltip]');
		
	$(document).ready( THEMEVISION.documentOnReady.init );
	$window.load( THEMEVISION.documentOnLoad.init );
	$window.on( 'resize', THEMEVISION.documentOnResize.init );
	
 })(jQuery);