<?php

// Add a spring dashboard widget

function spring_add_dashboard_widgets() {

	wp_add_dashboard_widget(
		'spring_dashboard_widget',          // Widget slug.
		'Spring',    						// Title.
		'spring_dashboard_widget_function'  // Display function.
    );	

}
add_action( 'wp_dashboard_setup', 'spring_add_dashboard_widgets' );

//Custom Dashboard Widget	
function spring_dashboard_widget_function() {
	echo file_get_contents('https://springagency.co.uk/wordpress/card.php');
}

// Adds spring to the admin footer instead.
add_filter('admin_footer_text', 'spring_wordpress_developer_link');
function spring_wordpress_developer_link() {
    echo '<span id="footer-thankyou"><a href="http://www.springagency.co.uk" target="_blank">Website by Spring</a></span>';
}