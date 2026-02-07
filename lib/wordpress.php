<?php

// Clean up WordPress Header
function remove_version() {
	return '';
}
add_filter('the_generator', 'remove_version');
 
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
 
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'wp_resource_hints', 2 );

function cleanup_query_string( $src ){ 
	$parts = explode( '?', $src ); 
	return $parts[0]; 
} 
//add_filter( 'script_loader_src', 'cleanup_query_string', 15, 1 ); 
//add_filter( 'style_loader_src', 'cleanup_query_string', 15, 1 );

//Remove Emojis
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

//Filter function used to remove the tinymce emoji plugin.
 function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

//Remove emoji CDN hostname from DNS prefetching hints
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
	/** This filter is documented in wp-includes/formatting.php */
	$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

	$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

//Remove Unused WP files
function remove_unused_files(){
	
	//Remove Gutenburg styling
	wp_dequeue_style( 'wp-block-library' );

	//oEmbed
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'remove_unused_files', 100 );

//Only load CF7 on contact page
function custom_contact_script_conditional_loading(){
   if(!is_page_template('template-contact.php')) {		
      wp_dequeue_script('contact-form-7'); // Dequeue JS Script file.
      wp_dequeue_style('contact-form-7');  // Dequeue CSS file. 
   }
}
add_action( 'wp_enqueue_scripts', 'custom_contact_script_conditional_loading' );
