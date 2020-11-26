window.Project = (function (window, document, $, undefined) {
	'use strict';

	var capp = {
		initialize: function () {
			capp.initCategorySlider('.category-slider');
		
		},

		initCategorySlider: function ($selector) {
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
	

	};

	$(document).ready(capp.initialize);

	return capp;
})(window, document, jQuery);


