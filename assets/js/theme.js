window.Project = (function (window, document, $, undefined) {
	'use strict';

	var app = {
		initialize: function () {
			app.initNavSticky('.header-area');
			app.initSlickNav('ul#nav');
			app.initTestimonial('.testimonial-slides');
			app.initSlider();
			app.initPopularProductSlide('.owl-popular-slide');
			//app.initFeatureSlider('.owl-popular-slide');
			$('.header-search-icon').on('click', app.initSearchForm );
			app.initSmallMatchHeight('.adjust_small_post_height');
			app.initMediumMatchHeight('.adjust_medium_post_height');
			app.initBigMatchHeight('.adjust_big_post_height');
			app.initMenuHeight();
			app.initCategoryLinstingMenu();
			app.initCategoryListingPosition();
			$('.load-more-posts-btn').on('click', app.handleLoadMore);
		},

		initPopularProductSlide:function($selector){
			$($selector).owlCarousel({
				items: 1,
				loop: true,
				autoplay: true,
				autoplayTimeout: 1000,
				nav: false,
				dots: false,
				margin:10,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items: 1
					},
					600:{
						items: 3
					},
					1000:{
						items: 6
					}
				}
			});
		},

		initCategoryListingPosition:function(){
			var featureWidth =$('.feature-inner').width();
			var featureContainer =$('.feature-inner .container').width();
			var featureWrap= (featureWidth-featureContainer)/2;
			$('.catagory-listing-menu').css({
				left: featureWrap
			});
			console.log(featureWrap);
            

		},

		 handleLoadMore: function (e) {
            e.preventDefault();
            var $button = $(this),
                query = $button.data('query'),
                $appendTo = $('.category_grid_post .row');
            $button.text('Loading....');
            wp.ajax.send('ctmirror_get_more_posts', {
                data: query,
                success: function (res) {
                    console.log(res);
                    $button.text('LOAD MORE');
                    if(res.posts){
                        query.offset = res.query.offset;
                        $appendTo.append(res.posts);
                        $button.attr('data-query', query);
                        app.initSmallMatchHeight('.adjust_small_post_height');
                    }else{
                    	$button.hide('slow');
                    }
                },
                error: function (error) {
                    $button.text('No More Posts');
                    console.log(error);
                }
            });

            console.log(query);

            return false;

        },
		initCategoryLinstingMenu: function(){
			$('ul.listing>li, ul.sub-menu>li').hover(function () {
				if ($('> ul.sub-menu',this).length > 0) {
					$('> a',this).addClass('angle-right');
				}
			},function () {
				$('> a',this).removeClass('angle-right');
			});
		},
		initMenuHeight : function(){
			$(window).resize(function() {
				$('body').css('margin-top', $('.header-area').height()+20);
			}).resize();    
		},
		initSmallMatchHeight : function($selector){
			$($selector).matchHeight({
				property: 'height'
			});
		},
		initMediumMatchHeight : function($selector){
			$($selector).matchHeight({
				property: 'height'
			});
		},
		initBigMatchHeight : function($selector){
			$($selector).matchHeight({
				property: 'height'
			});
		},

		initNavSticky: function ($selector) {
			$(window).on('scroll', function () {
				if ($(window).scrollTop() > 50) {
					$($selector).addClass('menu-sticky');
				} else {
					$($selector).removeClass('menu-sticky');
				}
			});

		},

		initSlickNav: function ($selector) {
			$($selector).slicknav({
				prependTo: '.mobile_menu'
			});
		},

		initTestimonial: function ($selector) {
			$($selector).owlCarousel({
				items: 1,
				loop: true,
				autoplay: true,
				autoplayTimeout: 5000,
				nav: true,
				dots: true,
				navText: ['<i class=\'fa fa-angle-double-left\'></i>', '<i class=\'fa fa-angle-double-right\'></i>']
			});
		},
		initFeatureSlider:function ($selector) {
			$($selector).owlCarousel({
				items: 1,
				loop: true,
				autoplay: true,
				autoplayTimeout: 5000,
				nav: false,
				dots: true,
				navText: ['<i class=\'fa fa-angle-double-left\'></i>', '<i class=\'fa fa-angle-double-right\'></i>']
			});
		},
		initSlider: function () {
			$('.slider-for').slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				fade: true,
				asNavFor: '.slider-nav'
			});

			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: false,
				focusOnSelect: true
			});

			$('a[data-slide]').click(function(e) {
				e.preventDefault();
				var slideno = $(this).data('slide');
				$('.slider-nav').slick('slickGoTo', slideno - 1);
			});
		},

		initSearchForm:function () {
			$('.header-search-form').slideToggle();
			return false;
		}

	};

	$(document).ready(app.initialize);
	$(window).load(app.initFeatureSlider('.feature-sliders'));

	return app;
})(window, document, jQuery);


