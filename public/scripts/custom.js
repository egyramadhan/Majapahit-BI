
$(window).on('load',function() { 
	//Preloaders
	setTimeout(function(){$("#preloader").addClass('hide-preloader');},250);// will fade out the white DIV that covers the website.
	$('#preloader').addClass('hide-objects');
	$('body').prepend('<div class="page-change-preloader preloader-light"><div id="preload-spinner"></div></div>');
});


$(document).ready(function(){      
    'use strict'	
	function init_template(){	
				
		//Demo Purposes.
		$('a').on('click', function(){var attrs = $(this).attr('href');	if(attrs === '#'){return false;}});	  
			
        //Toggle Dark Mode
        if($('body').hasClass('dark-menus')){$('.menu-wrapper').toggleClass('menu-light'); $('.menu-wrapper').toggleClass('menu-dark'); $('.dark-menu-toggle').addClass('toggle-active');}   
        if($('body').hasClass('dark-mode')){$('body').addClass('dark-mode'); $('.dark-mode-toggle').addClass('toggle-active');}
        $('.dark-mode-toggle a, .activate-dark-mode').on('click',function(){$('body').toggleClass('dark-mode');});     
				$('.dark-menu-toggle a, .activate-dark-menu').on('click',function(){$('body').toggleClass('dark-menus'); $('.menu-wrapper').toggleClass('menu-light'); $('.menu-wrapper').toggleClass('menu-dark'); });
				//Custom BI Majapait
        if($('body').hasClass('dark-mode')){$('body').addClass('dark-mode'); $('.toggle-dark-mode-header').addClass('toggle-active');}
        $('.toggle-dark-mode-header .toggle-trigger').on('click',function(){$('body').toggleClass('dark-mode');});     
        
		//Toggle Box
		$('[data-toggle-box]').on('click',function(){
			var toggle_box = $(this).data('toggle-box');
			if($('#'+toggle_box).is(":visible")){
				$('#'+toggle_box).slideUp(250);
			}else{
				$("[id^='box']").slideUp(250);
				$('#'+toggle_box).slideDown(250);
			}
		});
		
		//Read More Box
		$('.read-more-show').on('click',function(){
			$(this).hide();
			$(this).parent().parent().find('.read-more-box').show();
		});
        
		/*Menus*/
        $('.menu-wrapper').css({'display': 'block'})
		setTimeout(function(){
			$('#header, .scale-hover').css('transition','all 350ms ease');
			$('.menu-wrapper').addClass('activate-page');
		},250)
		$('.page-content-scroll').css('min-height', ($(window).height()));
		var page_height = $(window).height();
		$('#page-content').css({'min-height':page_height})
		$('.center-text-page').css('height', ($(window).height()) - 55);
		
		$('.menu-top').each(function(i) {
			var data_menu_size = $(this).data('menu-size');
			var data_menu_size_negative = data_menu_size * (-1);
			$(this).css({'height':data_menu_size, 'transition': 'all 0ms ease', 'transform': 'translateY(' + data_menu_size_negative + 'px)'});
		});	    

		$('.menu-bottom').each(function(i) {
			var data_menu_size = $(this).data('menu-size');
			$(this).css({'height':data_menu_size, 'transition': 'all 0ms ease', 'transform': 'translateY(' + data_menu_size + 'px)'});
		});	
		
		$('.menu-modal').each(function(i) {
			var data_menu_size = $(this).data('menu-size');
			var data_menu_size_negative = (data_menu_size/2)*(-1);
			$(this).css({'height':data_menu_size, 'margin-top':data_menu_size_negative, 'transition': 'all 0ms ease'});
		});		
		
		if($('.menu-fixed').length > 0){
			$('#page-content-scroll').css({'padding-bottom': '60px'})
			$('.back-to-top-badge').addClass('footer-clear-top');
		};
				
		$('a[data-submenu]').each(function(i) {
			var data_item_number = $(this).data('submenu');
			var data_item_ident = $('#'+ data_item_number);
			var data_item_submenus =  data_item_ident.children().length;
			if(data_item_submenus > 7){$('#'+ data_item_number).css({'transition':'all 500ms ease'})}		
			if(data_item_submenus < 7){$('#'+ data_item_number).css({'transition':'all 300ms ease'})}
			$(this).find('.submenu-items').append(data_item_submenus);
		});				
				
		setTimeout(function(){$('.menu-modal').css({'transition': 'all 250ms ease'});},150);
		setTimeout(function(){$('.menu-top').css({'transition': 'all 350ms ease'});},150);
		setTimeout(function(){$('.menu-bottom').css({'transition': 'all 350ms ease'});},150);
					
		$('#page-transitions').append('<div class="delete-menu"></div>');
		$('a[data-deploy-menu]').on( "click", function(){
			submenu_icon()
			$('.menu-wrapper').removeClass('active-menu');
			var menu_ident = $(this).data('deploy-menu');
			$('#'+menu_ident).toggleClass('active-menu');
			$('.page-content').removeClass('body-left body-right');
			
			if($(this).hasClass('deploy-perspective-left')){
				setTimeout(function(){$('#header').removeClass('body-left');},5);
				setTimeout(function(){$('#page-content').removeClass('body-left');},5);
				$('#header').addClass('perspective-left-header');
				$('#page-content').addClass('perspective-left');
				$('.delete-menu').addClass('perspective-delete');
			}			
			
			if($(this).hasClass('deploy-perspective-right')){
				setTimeout(function(){$('#header').removeClass('body-right');},5);
				setTimeout(function(){$('#page-content').removeClass('body-right');},5);
				$('#header').addClass('perspective-right-header');
				$('#page-content').addClass('perspective-right');
				$('.delete-menu').addClass('perspective-delete');
			}
						
			if($(this).hasClass('dismiss-with-button')){} else {
				if($('.menu-sidebar-left, .menu-side-left').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-left');}
				if($('.menu-sidebar-right, .menu-side-right').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-right');}
				if($('.menu-sidebar-left-small').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-left');}
				if($('.menu-sidebar-right-small').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-right');}
				if($('.menu-top').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-top');}
				if($('.menu-bottom').hasClass('active-menu')){$('.page-content, #header, .menu-fixed').addClass('body-bottom');}
				$('.delete-menu').addClass('delete-menu-active');
			}
		});
		
		$('.delete-menu, .close-menu').on('click', function(){
			$(this).removeClass('perspective-delete');
			$('.search-results').addClass('disabled-search-list');
			$('[data-search]').val('');
			$('.menu-wrapper').removeClass('active-menu');
			$('.page-content, #header, .menu-fixed').removeClass('body-left body-right body-top body-bottom perspective-left perspective-left-header perspective-right perspective-right-header');
			$('.delete-menu').removeClass('delete-menu-active');
			setTimeout(function(){$('.hamburger-animated em, .dropdown-animated em, .plushide-animated em').removeClass('hm1a hm2a hm3a dm1a dm2a ph1a ph2a');},30);
		});
		
        //Generating Menu Icons
        $('.hamburger-animated').html('<em class="hm1"></em><em class="hm2"></em><em class="hm3"></em>');
        $('.hamburger-animated').on("click",function(){$(this).find('.hm1').toggleClass('hm1a'); $(this).find('.hm2').toggleClass('hm2a'); $(this).find('.hm3').toggleClass('hm3a'); });     
        $('.dropdown-animated').html('<em class="dm1"></em><em class="dm2"><em>');
        $('.dropdown-animated').on("click",function(){$(this).find('.dm1').toggleClass('dm1a'); $(this).find('.dm2').toggleClass('dm2a');});
		$('.plushide-animated').html('<em class="ph1"></em><em class="ph2"></em>');
        $('.plushide-animated').on("click",function(){$(this).find('.ph1').toggleClass('ph1a'); $(this).find('.ph2').toggleClass('ph2a');});
				
		function submenu_icon(){
			if($('a[data-submenu]').hasClass('active-item')){
				var sub_data = $('.active-item').attr('data-submenu');
				var sub_id =  $('#'+sub_data)
				var sub_nr = $('#'+sub_data).children().length;
				setTimeout(function(){$('.active-item').find('.ph1, .ph2').addClass('ph1a ph2a'); },150);
				sub_id.css("height", sub_nr * 50)
			}
			$('.submenu-item a').prepend('<i class="fa fa-angle-right"></i>');
		}
		
		$('a[data-submenu]').on( "click", function(){
			$(this).find('.ph1, .ph2').removeClass('ph1a ph2a'); 

			var sub_data = $(this).data('submenu');
			var sub_id =  $('#'+sub_data)
			var sub_nr = $('#'+sub_data).children().length;
			
			if(sub_id.height() > 0){
			   $(this).removeClass('active-item');
			   sub_id.css("height", sub_nr * 0)
				$(this).find('.ph1, .ph2').removeClass('ph1a ph2a'); 
			} else {	
				$(this).addClass('active-item');
				$(this).find('.ph1, .ph2').addClass('ph1a ph2a'); 
			   sub_id.css("height", sub_nr * 50)
			}
		})
		
		setTimeout(function(){
			submenu_icon();
			$('.submenu-item a').append('<i class="fa fa-circle"></i>');
			$('.menu-large .menu-item, .menu-perspective .menu-item').append('<i class="fa fa-circle"></i>');
			$('a[data-submenu]').append('<em class="plushide-animated"><em class="ph1"></em><em class="ph2"></em></em>');
		},150);		
		
		//Mobile Ads
		$('.close-mobile-ad').on("click",function(){$('.mobile-ad-box').removeClass('mobile-ad-active');});
		$('a[data-mobile-ad]').on( "click", function(){
			$('.mobile-ad-box').removeClass('mobile-ad-active');
			var ad_number = $(this).data('mobile-ad');
			$('#'+ad_number).addClass('mobile-ad-active');
		});		
		$('.active-ad-timer').on('click',function(){
			setTimeout(function(){
				$('.timed-mobile-box').addClass('mobile-ad-active');
			},5000);
		});
		
		//Snackbars
		$('a[data-deploy-snack]').on( "click", function(){
			var snack_number = $(this).data('deploy-snack');
			$('#'+snack_number).addClass('active-snack');
			setTimeout(function(){$('#'+snack_number).removeClass('active-snack');},5000);
		});
		$('.snackbar a').on('click', function(){$(this).parent().removeClass('active-snack');});
		$('.snb').on( "click", function(){var snb_height = $('.notification-bar').height(); $('.notification-bar').toggleClass('toggle-notification-bar');});
		
		//Back Button
		$('.back-button').on('click', function(){
			$('#page-transitions').addClass('back-button-clicked');
			$('#page-transitions').removeClass('back-button-not-clicked');
			window.history.go(-1);
		});

		//Sortable List
		if( $('#sortable').length ){var list = document.getElementById("sortable"); Sortable.create(list);}
		
		//Search List
		$('[data-search]').on('keyup', function() {
			var searchVal = $(this).val();
			var filterItems = $(this).parent().parent().find('[data-filter-item]');
			if ( searchVal != '' ) {
				$(this).parent().parent().find('.search-results').removeClass('disabled-search-list');
				$(this).parent().parent().find('[data-filter-item]').addClass('disabled-search');
				$(this).parent().parent().find('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('disabled-search');
			} else {
				$(this).parent().parent().find('.search-results').addClass('disabled-search-list');
				$(this).parent().parent().find('[data-filter-item]').removeClass('disabled-search');
			}
		});
		
        //FastClick
        $(function() {FastClick.attach(document.body);});

        //Preload Image
        $(function() {$(".preload-image").lazyload({threshold : 500});});
                        
		//Accordions
		$('a[data-accordion]').on( "click", function(){
			var accordion_number = $(this).data('accordion');
			$('.accordion-content').slideUp(200);
			$('.accordion i').removeClass('rotate-180');			
			if($('#'+accordion_number).is(":visible")){
				$('#'+accordion_number).slideUp(200); 
				$(this).find('i:last-child').removeClass('rotate-180');
			}else{
				$('#'+accordion_number).slideDown(200); 
				$(this).find('i:last-child').addClass('rotate-180');
  			}
		});		
		
		//Tabs
		$('.active-tab').slideDown(0);
		$('a[data-tab]').on( "click", function(){
			var tab_number = $(this).data('tab'); 
			$(this).parent().find('[data-tab]').removeClass('active-tab-button');
			$(this).parent().parent().find('.tab-titles a').removeClass('active-tab-button'); 
			$(this).addClass('active-tab-button'); 
			$(this).parent().parent().find('.tab-item').slideUp(200); 
			$('#'+tab_number).slideDown(200);
		});		
		
		
		$('a[data-tab-pill]').on( "click", function(){
			var tab_number = $(this).data('tab-pill'); 
			var tab_bg = $(this).parent().parent().find('.tab-pill-titles').data('active-tab-pill-background');
			$(this).parent().find('[data-tab-pill]').removeClass('active-tab-pill-button ' + tab_bg);
			$(this).parent().parent().find('.tab-titles a').removeClass('active-tab-pill-button ' + tab_bg); 
			$(this).addClass('active-tab-pill-button ' + tab_bg); 
			$(this).parent().parent().find('.tab-item').slideUp(200); 
			$('#'+tab_number).slideDown(200);
		});		
				
		//Toast Boxes
		$('a[data-toast]').on( "click", function(){
			$('.toast').removeClass('show-toast');
			var toast_number = $(this).data('toast');
			$('#'+toast_number).addClass('show-toast');
			setTimeout(function(){$('#'+toast_number).removeClass('show-toast');},3000);
		});
		
		//Notifications
		$('.close-notification').on('click',function(){
			$(this).parent().slideUp(250);
		});
		
		//Article Card
		if ($('.article-card, .instant-box').length) {
			//var activate_clone = window.location.hash.substring(1);
			setTimeout(function(){
				$('[data-article-card="'+activate_clone+'"]').addClass('active-card');
				$('[data-instant="'+activate_clone+'"]').addClass('active-instant');
			},0);
		}
		$('[data-article-card]').clone().addClass('article-clone').removeClass('article-card-round').appendTo('#page-transitions');
		$('.article-clone .article-header').append('<span class="article-back"><i class="fa fa-angle-left"></i> Back</span>');
		$('[data-deploy-card]').on('click',function(){
			$('.article-clone a').removeAttr('data-deploy-card');
			var data_card = $(this).data('deploy-card');
			$('[data-article-card="'+data_card+'"]').addClass('active-card');
			//window.location.hash = data_card;
            $('.article-card').animate({scrollTop: 0}, 0);
		});
		$('.article-clone .article-back, .close-article').on('click', function(){
			$('.article-clone').removeClass('active-card');
			return false;
			//window.location.href.substr(0, window.location.href.indexOf('#'));
		});	
		
		//Instant Box
		$('.instant-box').clone().addClass('instant-box-clone').appendTo('#page-transitions');
		$('[data-deploy-instant]').on('click',function(){
			$('.instant-box-clone .instant-content').removeAttr('data-deploy-instant');
			var data_card = $(this).data('deploy-instant');
			$('[data-instant="'+data_card+'"]').addClass('active-instant');
			//window.location.hash = data_card;
            $('.instant-box').animate({scrollTop: 0}, 0);
		});
		$('.instant-clone').remove('instant-hidden-large');
		$('.close-instant').on('click', function(){
			$('.instant-box-clone').removeClass('active-instant');
			//window.location.href.substr(0, window.location.href.indexOf('#'));
			return false;
		});	
		
		//Toggles
		$('.toggle-trigger, .toggle-title').on('click', function(){
			$(this).parent().toggleClass('toggle-active'); 
			$(this).parent().find('.toggle-content').slideToggle(250);
		});
		
		//FAQ 
		$('.faq-question').on('click', function(){
			$(this).parent().find('.faq-answer').slideToggle(300);	
			$(this).find('.fa-plus').toggleClass('rotate-45');
			$(this).find('.fa-chevron-down').toggleClass('rotate-180');
			$(this).find('.fa-arrow-down').toggleClass('rotate-180');
		})
		
		//Dropdowns
		$('.inner-link-list').on('click',function(){
			$(this).parent().find('.link-list').slideToggle(250);
		});
		
        //Detect if iOS WebApp Engaged and permit navigation without deploying Safari
        (function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")

        //Detecting Mobiles//
		$('head').append('<meta charset="utf-8">');
		$('head').append('<meta name="apple-mobile-web-app-capable" content="yes">');
        var isMobile = {
            Android: function() {return navigator.userAgent.match(/Android/i);},
            iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
            Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
            any: function() {return (isMobile.Android()  || isMobile.iOS() || isMobile.Windows());}
        };
        if( !isMobile.any() ){
            $('.show-blackberry, .show-ios, .show-windows, .show-android').addClass('disabled');
            $('.show-no-detection').removeClass('disabled');
        }
        if(isMobile.Android()) {
            //Status Bar Color for Android
            $('head').append('<meta name="theme-color" content="#000000"> />');
            $('.show-android').removeClass('disabled');
            $('.show-blackberry, .show-ios, .show-windows, .show-download').addClass('disabled');
            $('.sidebar-scroll').css('right', '0px');
            $('.set-today').addClass('mobile-date-correction');
        }
        if(isMobile.iOS()) {
            $('.show-ios').removeClass('disabled');
            $('.show-blackberry, .show-android, .show-windows, .show-download').addClass('disabled');
            $('.set-today').addClass('mobile-date-correction');
        }
        if(isMobile.Windows()) {
            $('.show-windows').removeClass('disabled');
            $('.show-blackberry, .show-ios, .show-android, .show-download').addClass('disabled');
        }
		
		//Show Map
		$('.show-map, .hide-map').on('click',function(){
			$('.map-full .cover-content').toggleClass('deactivate-map');
			$('.map-full .cover-overlay').toggleClass('deactivate-map');
			$('.map-full .hide-map').toggleClass('activate-map');
		});
		        
        //Show Back To Home When Scrolling
        $(window).on('scroll', function () {
            var total_scroll_height = document.body.scrollHeight
            var inside_header = ($(this).scrollTop() <= 200);
            var passed_header = ($(this).scrollTop() >= 0); //250
            var passed_header2 = ($(this).scrollTop() >= 150); //250
            var footer_reached = ($(this).scrollTop() >= (total_scroll_height - ($(window).height() + 300 )));

            if (inside_header === true) {
				$('.store-product-button-fixed').removeClass('show-store-product-button');
				$('.back-to-top-badge').removeClass('back-to-top-badge-visible');
            }
			else if(passed_header === true){
				$('.store-product-button-fixed').addClass('show-store-product-button');
				$('.back-to-top-badge').addClass('back-to-top-badge-visible');
			} 
            if (footer_reached == true){
				$('.store-product-button-fixed').removeClass('show-store-product-button');
				$('.back-to-top-badge').removeClass('back-to-top-badge-visible');
			}
        });
                
        //Back to top Badge
        $('.back-to-top-badge, .back-to-top').on( "click", function(e){
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });
              
        //Set inputs to today's date by adding class set-day
        var set_input_now = new Date();
        var set_input_month = (set_input_now.getMonth() + 1);               
        var set_input_day = set_input_now.getDate();
        if(set_input_month < 10) 
            set_input_month = "0" + set_input_month;
        if(set_input_day < 10) 
            set_input_day = "0" + set_input_day;
        var set_input_today = set_input_now.getFullYear() + '-' + set_input_month + '-' + set_input_day;
        $('.set-today').val(set_input_today);

        //Copyright Year 
        var dteNow = new Date();
        var intYear = dteNow.getFullYear();
        $('#copyright-year, .copyright-year').html(intYear);
        
        //Contact Form
        var formSubmitted = "false";
        jQuery(document).ready(function(e) {
            function t(t, n) {
                formSubmitted = "true";
                var r = e("#" + t).serialize();
                e.post(e("#" + t).attr("action"), r, function(n) {
                    e("#" + t).hide();
                    e("#formSuccessMessageWrap").fadeIn(500)
                })
            }

            function n(n, r) {
                e(".formValidationError").hide();
                e(".fieldHasError").removeClass("fieldHasError");
                e("#" + n + " .requiredField").each(function(i) {
                    if (e(this).val() == "" || e(this).val() == e(this).attr("data-dummy")) {
                        e(this).val(e(this).attr("data-dummy"));
                        e(this).focus();
                        e(this).addClass("fieldHasError");
                        e("#" + e(this).attr("id") + "Error").fadeIn(300);
                        return false
                    }
                    if (e(this).hasClass("requiredEmailField")) {
                        var s = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                        var o = "#" + e(this).attr("id");
                        if (!s.test(e(o).val())) {
                            e(o).focus();
                            e(o).addClass("fieldHasError");
                            e(o + "Error2").fadeIn(300);
                            return false
                        }
                    }
                    if (formSubmitted == "false" && i == e("#" + n + " .requiredField").length - 1) {
                        t(n, r)
                    }
                })
            }
            e("#formSuccessMessageWrap").hide(0);
            e(".formValidationError").fadeOut(0);
            e('input[type="text"], input[type="password"], textarea').focus(function() {
                if (e(this).val() == e(this).attr("data-dummy")) {
                    e(this).val("")
                }
            });
            e("input, textarea").blur(function() {
                if (e(this).val() == "") {
                    e(this).val(e(this).attr("data-dummy"))
                }
            });
            e("#contactSubmitButton").click(function() {
                n(e(this).attr("data-formId"));
                return false
            })
        })
			
		//Reading Time
		$(window).scroll(function() {
			var wintop = $(window).scrollTop(), docheight = $('#page-content').height(), winheight = $(window).height();
			var totalScroll = (wintop/(docheight-winheight))*100;
			$(".reading-line").css("width",totalScroll+"%");
		});		
		$(function() {
			var $article = $('.reading-time-box');
			$article.readingTime({
				readingTimeAsNumber: true,
				readingTimeTarget: $article.find('.reading-time'),
				wordCountTarget: $article.find('.reading-words'),
				wordsPerMinute: 1075,
				round: false,
				lang: 'en',
			});
		});
		
		//Progress Bar
		if($('.progress-bar').length > 0){
			$('.progress-bar-wrapper').each(function(){
				var progress_height = $(this).data('progress-height');
				var progress_border = $(this).data('progress-border');
				var progress_round = $(this).attr('data-progress-round');
				var progress_color = $(this).data('progress-bar-color');
				var progress_bg = $(this).data('progress-bar-background');
				var progress_complete = $(this).data('progress-complete');
				var progress_text_visible = $(this).attr('data-progress-text-visible');
				var progress_text_color = $(this).attr('data-progress-text-color');
				var progress_text_size = $(this).attr('data-progress-text-size');
				var progress_text_position = $(this).attr('data-progress-text-position');
				var progress_text_before= $(this).attr('data-progress-text-before');
				var progress_text_after= $(this).attr('data-progress-text-after');
					
				if (progress_round ==='true'){			
					$(this).find('.progress-bar').css({'border-radius':progress_height})
					$(this).css({'border-radius':progress_height})				  
				}
				
				if( progress_text_visible === 'true'){
					$(this).append('<em>'+ progress_text_before + progress_complete +'%' + progress_text_after + '</em>')
					$(this).find('em').css({
						"color":progress_text_color,
						"text-align":progress_text_position,
						"font-size":progress_text_size + 'px',
						"height": progress_height +'px',
						"line-height":progress_height + progress_border +'px'
					});
				} 
				
				$(this).css({
					"height": progress_height + progress_border,
					"background-color": progress_bg,
				})

				$(this).find('.progress-bar').css({
					"width":progress_complete + '%',
					"height": progress_height - progress_border,
					"background-color": progress_color,
					"border-left-color":progress_bg,
					"border-right-color":progress_bg,
					"border-left-width":progress_border,
					"border-right-width":progress_border,
					"margin-top":progress_border,
				})
			});
		}
		
		//Owl Carousel Sliders
		setTimeout(function(){
			$('.single-slider').owlCarousel({loop:true, margin:0, nav:false, autoHeight:true, lazyLoad:true, items:1, autoplay: true, autoplayTimeout:3500});		
			$('.menu-fixed-slider').owlCarousel({loop:false, margin:0, nav:false, items:5});	
			$('.single-slider-no-timeout').owlCarousel({loop:true, margin:0, nav:false, dots:false, items:1, autoHeight:true});
			$('.single-store-slider').owlCarousel({loop:false, margin:10, nav:false, autoHeight:true, lazyLoad:true, items:1, autoplay: true, autoplayTimeout:3500});	
			$('.double-slider').owlCarousel({loop:true, margin:20, nav:false, autoHeight:true, lazyLoad:true, items:2, autoplay: true, autoplayTimeout:3500});	
			$('.thumb-slider').owlCarousel({loop:true, margin:10, nav:false, autoHeight:true, lazyLoad:true, items:3, autoplay: true, autoplayTimeout:3500});	
			$('.cover-slider').owlCarousel({loop:true, nav:false, lazyLoad:true, items:1, autoplay: true, autoplayTimeout:3500});		
			$('.cover-walkthrough-slider').owlCarousel({loop:false, nav:false, lazyLoad:true, items:1, autoplay: false, autoplayTimeout:3500});		
			$('.cover-slider-full').owlCarousel({loop:false, nav:false, dots:false, mouseDrag:false, touchDrag:false, pullDrag:false, lazyLoad:true, items:1, autoplay: true, autoplayTimeout:3500});		
			$('.timeline-slider').owlCarousel({loop:true, lazyLoad:true, nav:false, items:1, autoplay: true, autoplayTimeout:3500});
		
			$('.next-slide-arrow, .next-slide-text, .next-slide-custom').on('click',function(){
				$(this).parent().find('.owl-carousel').trigger('next.owl.carousel');
			});		
			
			$('.prev-slide-arrow, .prev-slide-text, .prev-slide-custom').on('click',function(){
				$(this).parent().find('.owl-carousel').trigger('prev.owl.carousel');
			});		
		
		},100);
		
		//Galleries
		baguetteBox.run('.gallery', {});		
		baguetteBox.run('.profile-gallery', {});		
		
		if($('.gallery-filter').length > 0){$('.gallery-filter').filterizr();}		

		$('.gallery-filter-controls li').on('click',function(){
			$('.gallery-filter-controls li').removeClass('gallery-filter-active');	
			$(this).addClass('gallery-filter-active');	
		})
		
		$('#menu-filter a[data-filter]').on('click',function(){
			var filter_selected = $(this).text()
			$('a[data-deploy-menu="menu-filter"]').text(filter_selected)
		});
		
		//Coverpage
		setTimeout(function(){resize_coverpage();},250);
		$(window).on('resize', function(){resize_coverpage();})
		
		function resize_coverpage(){
			var cover_height = $(window).height();
			var cover_width = $(window).width();
			if($('.page-content-full').length > 0){
				var header_height = "0";
			} else{
				var header_height = "55";
			}
			
			$('.cover-item').css({"height":(cover_height - header_height), "width":cover_width})			
			$('.cover-item-full').css({"margin-top": header_height * (-1), "height":cover_height, "width":cover_width})
			$('.coverpage-full .cover-item').css({"height":cover_height, "width":cover_width});
			$('.coverpage-full').css({"margin-top": header_height * (-1)});

			$('.cover-content-center').each(function(){
				var cover_content_center_height = $(this).innerHeight();
				var cover_content_center_width = $(this).innerWidth();
				$(this).css({"margin-left": (cover_content_center_width/2)*(-1), 	"margin-top": ((cover_content_center_height/2)*(-1)) })
			});			
			$('.cover-content-center-full').each(function(){
				var cover_content_center_height = $(this).innerHeight();
				$(this).css({"margin-top": (cover_content_center_height/2)*(-1)})
			});
		}

		//Countdown
		function countdown(dateEnd) {
		  var timer, years, days, hours, minutes, seconds;
		  dateEnd = new Date(dateEnd);
		  dateEnd = dateEnd.getTime();
		  if ( isNaN(dateEnd) ) {return;}
		  timer = setInterval(calculate, 1);
		  function calculate() {
			var dateStart = new Date();
			var dateStart = new Date(dateStart.getUTCFullYear(), dateStart.getUTCMonth(), dateStart.getUTCDate(), dateStart.getUTCHours(), dateStart.getUTCMinutes(), dateStart.getUTCSeconds());
			var timeRemaining = parseInt((dateEnd - dateStart.getTime()) / 1000)

			if ( timeRemaining >= 0 ) {
			  years    = parseInt(timeRemaining / 31536000);
			  timeRemaining   = (timeRemaining % 31536000);		
			  days    = parseInt(timeRemaining / 86400);
			  timeRemaining   = (timeRemaining % 86400);
			  hours   = parseInt(timeRemaining / 3600);
			  timeRemaining   = (timeRemaining % 3600);
			  minutes = parseInt(timeRemaining / 60);
			  timeRemaining   = (timeRemaining % 60);
			  seconds = parseInt(timeRemaining);

				if($('.countdown').length > 0){
				  $(".countdown #years")[0].innerHTML    = parseInt(years, 10);
				  $(".countdown #days")[0].innerHTML    = parseInt(days, 10);
				  $(".countdown #hours")[0].innerHTML   = ("0" + hours).slice(-2);
				  $(".countdown #minutes")[0].innerHTML = ("0" + minutes).slice(-2);
				  $(".countdown #seconds")[0].innerHTML = ("0" + seconds).slice(-2);
				}
			} else { return; }}
		  function display(days, hours, minutes, seconds) {}
		}
		countdown('01/19/2030 03:14:07 AM');	

		//Charts
		$(document).ready(function() {
			if($('.chart').length > 0){
			var loadJS = function(url, implementationCode, location){
				var scriptTag = document.createElement('script');
				scriptTag.src = url;
				scriptTag.onload = implementationCode;
				scriptTag.onreadystatechange = implementationCode;
				location.appendChild(scriptTag);
			};
			var call_charts_to_page = function(){
				new Chart(document.getElementById("pie-chart"), {
					type: 'pie',
					data: {
					  labels: ["tes"],
					  datasets: [{
						backgroundColor: ["#4FC1E9", "#FC6E51", "#ED5565", "#A0D468","#293462",
										"#216583","#f76262","#f76262","#fff1c1","#ed3833","#f9ed69",
										"#f08a5d","#b83b5e","#6a2c70","#30e3ca","#ffc8c8","#ff9a00","#ff165d",
										"#1fab89","#62d2a2"],
						borderColor:"rgba(255,255,255,0.2)",
						data: ["10000"]
					  }]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						tooltips:{enabled:true}, animation:{duration:1500},
					},
				});		

				// new Chart(document.getElementById("doughnut-chart"), {
				// 	type: 'doughnut',
				// 	data: {
				// 	  labels: ["Apple Inc.", "Samsung", "Google", "One Plus", "Huawei"],
				// 	  datasets: [{
				// 		backgroundColor: ["#CCD1D9", "#5D9CEC","#FC6E51", "#434A54", "#4FC1E9"],
				// 		borderColor:"rgba(255,255,255,0.2)",
				// 		data: [5500,4000,2000,3000,1000]
				// 	  }]
				// 	},
				// 	options: {
				// 		legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
				// 		tooltips:{enabled:true}, animation:{duration:1500}, layout:{ padding: {bottom: 30}}
				// 	}
				// });		

				new Chart(document.getElementById("polar-chart"), {
					type: 'polarArea',
					data: {
					  labels: ["tes"],
					  datasets: [{
						backgroundColor: ["#CCD1D9", "#5D9CEC","#FC6E51"],
						borderColor:"rgba(255,255,255,0.2)",
						data: ['10000']
					  }]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						tooltips:{enabled:true}, animation:{duration:1500}, layout:{ padding: {bottom: 30}}
					}
				});			

				new Chart(document.getElementById("vertical-chart"), {
					type: 'bar',
					data: {
					  labels: ["2010", "2015", "2020", "2025"],
					  datasets: [
						{
						  label: "Lalapan Domba Bakar Jumbo",
						  backgroundColor: "#A0D468",
						  data: [900,1000,1200,1400]
						}, {
						  label: "Lalapan Domba Goreng",
						  backgroundColor: "#4A89DC",
						  data: [890,950,1100,1300]
						}
					  ]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						title: {display: false}
					}
				});	


				new Chart(document.getElementById("horizontal-chart"), {
					type: 'horizontalBar',
					data: {
					  labels: ["2010", "2013", "2016", "2020"],
					  datasets: [
						{
						  label: "Mobile",
						  backgroundColor: "#BF263C",
						  data: [330,400,580,590]
						}, {
						  label: "Responsive",
						  backgroundColor: "#EC87C0",
						  data: [390,450,550,570]
						}
					  ]
					},
					options: {
						legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
						title: {display: false}
					}
				});	

				// new Chart(document.getElementById("line-chart"), {
				//   type: 'line',
				//   data: {
				// 	labels: [2000,2005,2010,2015,2020],
				// 	datasets: [{ 
				// 		data: [500,400,300,200,300],
				// 		label: "Produk 1",
				// 		borderColor: "#D8334A"
				// 	  }, { 
				// 		data: [0,100,300,400,500],
				// 		label: "Produk 2",
				// 		borderColor: "#4A89DC"
				// 	  }
				// 	]
				//   },
				//   options: {
				// 	legend: {display: true, position:'bottom', labels:{fontSize:13, padding:15,boxWidth:12},},
				// 	title: {display: false}
				//   }
				// });
			}
			loadJS('scripts/charts.js', call_charts_to_page, document.body);
		}
		} );
		//Cookie Box
		function createCookie(e,t,n){if(n){var o=new Date;o.setTime(o.getTime()+48*n*60*60*1e3);var r="; expires="+o.toGMTString()}else var r="";document.cookie=e+"="+t+r+"; path=/"}function readCookie(e){for(var t=e+"=",n=document.cookie.split(";"),o=0;o<n.length;o++){for(var r=n[o];" "==r.charAt(0);)r=r.substring(1,r.length);if(0==r.indexOf(t))return r.substring(t.length,r.length)}return null}function eraseCookie(e){createCookie(e,"",-1)}

		$('.show-cookie').on('click',function(){$('#menu-cookie').addClass('active-cookie');});
		$('.hide-cookie').on('click',function(){$('#menu-cookie').removeClass('active-cookie');});

		if (!readCookie('enabled_cookie_themeforest_appeca1')) {setTimeout(function(){$('#menu-cookie').addClass('active-cookie');},1500);}
		if (readCookie('enabled_cookie_themeforest_appeca1')) {$('#menu-cookie').removeClass('active-cookie');}
		$('.hide-cookie').click(function() {$('#menu-cookie').removeClass('active-cookie'); createCookie('enabled_cookie_themeforest_appeca1', true, 1)});					
		
	}//Init Template Function

    
	setTimeout(init_template, 0);//Activating all the plugins
    $(function(){
		'use strict';
		var options = {
			prefetch: true,
			prefetchOn: 'mouseover',
			cacheLength: 100,
			scroll: true, 
			blacklist: '.default-link' && '.show-gallery',
			forms: 'contactForm',
			onStart: {
				duration:250, // Duration of our animation
				render: function ($container) {
				$container.addClass('is-exiting');// Add your CSS animation reversing class
				$('#page-transitions').addClass('back-button-not-clicked');
				$('.menu-wrapper').removeClass('active-menu');
				$('.delete-menu').removeClass('delete-menu-active');
				$('.page-change-preloader').addClass('show-change-preloader');
				$('#header *').find('em').removeClass('hm1a hm2a hm3a dm1a dm2a ph1a ph2a');
				$('.page-content, #header').removeClass('body-left body-right body-top body-bottom');
				return false;
			}
        },
        onReady: {
			duration: 50,
			render: function ($container, $newContent) {
				$container.removeClass('is-exiting');// Remove your CSS animation reversing class
				$container.html($newContent);// Inject the new content
				$('.page-change-preloader').addClass('show-change-preloader');
			}
		},
        onAfter: function($container, $newContent) {
            setTimeout(init_template, 0)//Timeout required to properly initiate all JS Functions. 
			setTimeout(function(){$('.page-change-preloader').removeClass('show-change-preloader');},250);

        }
      };
      var smoothState = $('#page-transitions').smoothState(options).data('smoothState');
    });    
});