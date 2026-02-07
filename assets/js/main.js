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
});