jQuery(document).ready(function ($) {
	
	var tabletSize = 768;
	var desktopSize = 1280;

	function isMobile() {
		return $(window).outerWidth() < tabletSize;
	}
	
	function isTablet() {
		return $(window).outerWidth() >= tabletSize && $(window).outerWidth() < desktopSize;
	}
	
	function isDesktop() {
		return $(window).outerWidth() >= desktopSize;
	}
	
	function isTabletDesktop() {
		return $(window).outerWidth() >= tabletSize;
	}
	
	function isMobileTablet() {
		return $(window).outerWidth() < desktopSize;
	}
	
	/* Scroll Animations */
	
	$.fn.isInViewport = function() {
		var elementTop = $(this).offset().top;
		var elementBottom = elementTop + $(this).outerHeight();
		
		var viewportTop = $(window).scrollTop();
		var viewportBottom = viewportTop + $(window).height();
		
		return elementBottom > viewportTop && elementTop < viewportBottom;
	};
	
	function run_animation() {
	
		$('.panel').each( function(i){
			
			var element = $(this);
			
			animate_element( element );
		});
	}
	
	run_animation();
	
	$(document).on('scroll', function() {
		run_animation();
	});
	
	function animate_element( element ) {
		 
		if ($(element).isInViewport()) {
			
			if( !element.hasClass('animation-running') ) {
				
				setTimeout(function() { 
					$(element).addClass('animation-running');
				}, 10);
			}
		}	    
	}
	
	/* Stories Slider */
	
	const $wrap   = $('.panel-animal-stories');
	const $slider = $wrap.find('.stories');
	const $btns   = $wrap.find('.stories-nav .story-button');
	
	// Sync active state on init + after change
	$slider.on('init', function (e, slick) {
		$btns.removeClass('is-active');
		$btns.filter('[data-slide="0"]').addClass('is-active');
	});
	
	$slider.on('afterChange', function (e, slick, currentSlide) {
		$btns.removeClass('is-active');
		$btns.filter('[data-slide="' + currentSlide + '"]').addClass('is-active');
	});
	
	// Click pager -> go to slide
	$btns.on('click', function () {
		const index = parseInt(this.dataset.slide, 10);
		$slider.slick('slickGoTo', index);
	});
	  
	$slider.slick({
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		prevArrow: $('.panel-animal-stories .slider-arrow-prev'),
		nextArrow: $('.panel-animal-stories .slider-arrow-next'),
		adaptiveHeight: false,
		infinite: true
	});
	
	/* Tabbed Content */
	
	$('.panel-key-info .tab-button').click(function() {

		var target = $(this).data('tab');
		
		$('.panel-key-info .tab-button').removeClass('active');
		$(this).addClass('active');
		
		$('.panel-key-info .tab').removeClass('active');
		$('.panel-key-info #tab_' + target).addClass('active');
		
	});


	/* Calendar */ 
	
	const calendarEl = document.getElementById('calendar');
	if (!calendarEl) return;
	
	const $openingStatus = $('#opening-status');
	const $openingDates = $('#opening-dates');
	const $openingTimes  = $('#opening-times');
	const $openingContent  = $('#opening-content');
	
	const startDate = new Date();
	startDate.setDate(startDate.getDate());
	console.log(startDate);
	
	const cal = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		initialDate: startDate,
		headerToolbar: { left: 'prev', center: 'title', right: 'next' },
		nowIndicator: true,
		height: 'auto',
		contentHeight: 'auto',
		events: [],
		firstDay: 1,
		dayHeaderFormat: {
			 weekday: 'short'
		},
		
		dayHeaderContent: function(arg) {
			return arg.date.toLocaleDateString('en-GB', { weekday: 'short' }).charAt(0);
		},
		
		dateClick: function(info) {
			console.log('Clicking');
			
			const selected = info.dateStr; // YYYY-MM-DD
			
			var body = {
				url: core.ajax_url,
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'venue_open_status',
					nonce: core.nonce,
					date: selected
				}
			};
			
			console.log(body);
			
			$.ajax(body)
				.done(function(resp){
					if (resp && resp.success) {
						console.log(resp.data);
						$openingStatus.html(resp.data.opening_status);
						$openingDates.html(resp.data.opening_dates);
						$openingTimes.html(resp.data.opening_times);
						$openingContent.html('<p>' + resp.data.opening_content + '</p>');
						
					} else {
						$msg.text(resp?.data?.message || 'Sorry, something went wrong.');
					}
				})
				.fail(function(xhr){
					$msg.text('Request failed. Please try again.');
					console.log(xhr.responseText);
				});
		}
	});
	
	cal.render();
	
	/* Lightboxes */
	
	const lightbox = GLightbox({
		touchNavigation: false,
		loop: false,
		width: '1098px',
		svg: {
			close: '<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25.456 8.48528C25.7373 8.76659 25.8953 9.14812 25.8953 9.54594C25.8953 9.94377 25.7373 10.3253 25.456 10.6066L19.092 16.9706L25.456 23.3345C25.7373 23.6158 25.8953 23.9974 25.8953 24.3952C25.8953 24.793 25.7373 25.1745 25.456 25.4558C25.1747 25.7371 24.7931 25.8952 24.3953 25.8952C23.9975 25.8952 23.616 25.7371 23.3347 25.4558L16.9707 19.0919L10.6067 25.4558C10.3254 25.7371 9.94391 25.8952 9.54608 25.8952C9.14826 25.8952 8.76673 25.7371 8.48542 25.4558C8.20412 25.1745 8.04608 24.793 8.04608 24.3952C8.04608 23.9974 8.20412 23.6158 8.48542 23.3345L14.8494 16.9706L8.48542 10.6066C8.20412 10.3253 8.04608 9.94377 8.04608 9.54594C8.04608 9.14812 8.20412 8.76659 8.48542 8.48528C8.76673 8.20398 9.14826 8.04594 9.54608 8.04594C9.94391 8.04594 10.3254 8.20398 10.6067 8.48528L16.9707 14.8492L23.3347 8.48528C23.616 8.20398 23.9975 8.04594 24.3953 8.04594C24.7931 8.04594 25.1747 8.20398 25.456 8.48528Z" fill="#F6F2EC"/></svg>',
			prev: '<svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.105 5.72839e-07L15 1.89724L3.73469 13.5177L4.93586 14.7571L4.92986 14.7503L14.9394 25.0742L13.0717 27C10.3052 24.1466 2.58165 16.1804 -5.90878e-07 13.5177C1.91742 11.5387 0.0475379 13.4673 13.105 5.72839e-07Z" fill="#F6F2EC"/></svg>',
			next: '<svg width="15" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.89497 27L-1.65856e-06 25.1028L11.2653 13.4823L10.0641 12.2429L10.0701 12.2497L0.0605931 1.92584L1.92827 -1.71415e-06C4.69479 2.85336 12.4184 10.8196 15 13.4823C13.0826 15.4613 14.9525 13.5327 1.89497 27Z" fill="#F6F2EC"/></svg>'
		}
	});
	
});