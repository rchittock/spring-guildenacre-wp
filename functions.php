<?php

$prefix = 'guildenacre';

$theme = wp_get_theme();

if ( defined('WP_DEBUG') && true === WP_DEBUG || strpos($_SERVER['SERVER_NAME'],'localhost') !== false || strpos($_SERVER['SERVER_NAME'],'springdevelopment.co.uk') !== false ) {
	define('THEME_VERSION', rand());
} else {
	define('THEME_VERSION', $theme->Version);	
}

define('GOOGLE_API_KEY', 'AIzaSyDA7Ziy1yief436fbG5v6rMt0cNIcqF2wU');

include('lib/spring.php');
include('lib/wordpress.php');
include('lib/woocommerce.php');
include('lib/opening-times.php');

//ACF
add_filter( 'acf/admin/prevent_escaped_html_notice', '__return_true' );
if(function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

function my_acf_init() {   
   acf_update_setting('google_api_key', GOOGLE_API_KEY);
}
add_action('acf/init', 'my_acf_init');

function hide_acf_for_non_admin_user() {
	if (get_current_user_id() !== 1) {
		remove_menu_page('edit.php?post_type=acf-field-group');
	}
}
add_action('admin_menu', 'hide_acf_for_non_admin_user');

//Support
add_theme_support( 'post-thumbnails', [ 'post', 'event', 'announcement' ] );	
add_post_type_support( 'page', 'excerpt' );

//Menus
register_nav_menus(
	array(  
		'primary' => __( 'Primary Navigation Right', $prefix),
		
		'footer-menu-1' => __( 'Footer Menu 1 Navigation', $prefix),
		'footer-menu-2' => __( 'Footer Menu 2 Navigation', $prefix),
		'footer-menu-3' => __( 'Footer Menu 3 Navigation', $prefix),
		
		'footer-mobile-menu-1' => __( 'Footer Menu 1 Navigation', $prefix),
		'footer-mobile-menu-2' => __( 'Footer Menu 2 Navigation', $prefix),
	)
);

//Load Assets
function custom_enqueue_styles() {

	//CSS
	wp_enqueue_style( 'main', get_bloginfo('template_directory') . '/public/css/main.min.css', array(), THEME_VERSION);
	
	//JS
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?loading=async&key=' . GOOGLE_API_KEY, array('jquery'), THEME_VERSION, true);
	wp_enqueue_script( 'main', get_bloginfo('template_directory') . '/public/js/main.min.js', array('jquery'), THEME_VERSION, true);
	
	
	// FullCalendar (CDN)
	wp_enqueue_style('fullcalendar-css', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css', array('jquery'), '6.1.15');
	wp_enqueue_script('fullcalendar', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js', array('jquery'), '6.1.15', true);
  
	wp_localize_script('main', 'core', [
	  'home' => home_url(),
	  'ajax_url' => admin_url( 'admin-ajax.php' ),
	  'nonce' => wp_create_nonce('venuecal_nonce'),
	]);
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles' );

//Editor Styles
function custom_editor_styles() {
	add_editor_style(get_bloginfo('template_directory') . '/public/css/editor-styles.min.css?v=' . THEME_VERSION);
}
add_action( 'admin_init', 'custom_editor_styles' );

//Editor Formats
function custom_format_dropdown($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'custom_format_dropdown');

function custom_formats( $init_array ) {

	$style_formats = array(  
		array(  
			'title' => 'Large Text',  
			'inline' => 'span',  
			'classes' => 'large-text',
			'wrapper' => true    
		),	 
		array(  
			'title' => 'Hand Written',  
			'inline' => 'span',  
			'classes' => 'signature',
			'wrapper' => true    
		)	
	);  
	
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
 
} 
add_filter( 'tiny_mce_before_init', 'custom_formats' ); 

//Custom Post Types
function create_post_types() {

	$post_types = array(
		'event' => array(
			'singular' => 'Event', 
			'plural' => 'Events', 
			'slug' => 'our-events', 
			'supports' => array('title', 'editor', 'thumbnail')
		),
		'global_panels' => array(
			'singular' => 'Panel', 
			'plural' => 'Panels', 
			'slug' => 'global-panels', 
			'supports' => array('title')
		),
		'announcement' => array(
			'singular' => 'Announcement', 
			'plural' => 'Announcements', 
			'slug' => 'our-announcements', 
			'supports' => array('title', 'editor', 'thumbnail')
		),
		'opening_time' => array(
			'singular' => 'Opening Time', 
			'plural' => 'Opening Times', 
			'slug' => 'our-opening-times', 
			'supports' => array('title')
		),
	);
	
	foreach( $post_types as $post_type_singular => $post_type) {
		register_post_type(
			$post_type_singular,
			array(
					'labels' => array(
					'name' => __( $post_type['plural'] ),
					'singular_name' => __( $post_type['singular'] )
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => $post_type['slug']),
				'supports' => $post_type['supports']
			)
		); 	
	}
}
add_action( 'init', 'create_post_types' );

//Create Taxonomies
function create_taxonomies() {

	$taxonomies = array(
		'event-activity-type' => array(
			'post_type' => array('event'), 
			'name' => 'Activity Type', 
			'slug' => 'event-activity-type'
		),
		'event-age-range' => array(
			'post_type' => array('event'), 
			'name' => 'Age Range', 
			'slug' => 'event-age-range'
		)
	);

	foreach( $taxonomies as $taxonomy_singular => $taxonomy ) {
		register_taxonomy(
			$taxonomy_singular,
			$taxonomy['post_type'],
			array(
				'label' => __( $taxonomy['name'] ),
				'rewrite' => array( 'slug' => $taxonomy['slug'] ),
				'hierarchical' => true
			)
		);
	}
}
add_action( 'init', 'create_taxonomies', 0 );

// function custom_add_query_vars_filter( $vars ){
// 	$vars[] = "filter-type";
// 	return $vars;
// }
// add_filter( 'query_vars', 'custom_add_query_vars_filter' );

// function get_date_string($start_date, $end_date, $custom_date_text, $date_format = 'j F Y') {
	// 
	// $date_string = '';
	// 
	// if ( $custom_date_text != '' ) :
	// 	$date_string = $custom_date_text;
	// else : 
	// 	$date_string = $start_date->format($date_format);
	// 	if ( $start_date->format($date_format) != $end_date->format($date_format) ) :
	// 		$date_string .= ' - ' . $end_date->format($date_format);
	// 	endif;
	// endif;
	// 
	// return $date_string;	
// }

function get_panel_classes($panel) {
	
	$panel_classes = [];
	
	$panel_classes[] = 'panel-' . $panel;
	
	if ( get_sub_field('alignment') != '' ) {
		$panel_classes[] = 'panel-align-' . get_sub_field('alignment');
	}
	
	if ( get_sub_field('theme') != '' ) {
		$panel_classes[] = 'panel-theme-' . get_sub_field('theme');
	}
	
	if ( get_sub_field('left_star_position') != '' ) {
		$panel_classes[] = 'panel-left-star-position-' . get_sub_field('left_star_position');
	}
	
	if ( get_sub_field('right_star_position') != '' ) {
		$panel_classes[] = 'panel-right-star-position-' . get_sub_field('right_star_position');
	}
	
	if ( get_sub_field('show_stars') != '' ) {
		$panel_classes[] = 'panel-show-stars';
	}
	
	if ( get_sub_field('circle_orientation') != '' ) {
		$panel_classes[] = 'panel-circle-orientation-' . get_sub_field('circle_orientation');
	}
	
	return $panel_classes;
}

function get_panel_styles($background_image) {
	
	$style = ' style="';
	
	if ( $background_image ) :
		$style .= 'background-image: url('.$background_image['sizes']['large'].'); ';
	endif;
	
	$style .= '"';
	
	return $style;
}

function get_first_category_name($taxonomy) {

	$category_name = '';
	
	$selected_slug = get_query_var($taxonomy);
	
	if ( $selected_slug != '' ) {
		
		$category = get_term_by('slug', $selected_slug, $taxonomy);
		
		$category_name = $category->name;
		
	} else {
		
		$categories = get_the_terms(get_the_ID(), $taxonomy);
		
		if(!empty($categories) && $categories[0] != null) {
		
			$category_name = $categories[0]->name;
		
		}		
	}

	return $category_name;
}

function get_first_category_id($taxonomy) {

	$category_id = '';
	
	$selected_slug = get_query_var($taxonomy);
	
	if ( $selected_slug != '' ) {
		
		$category = get_term_by('slug', $selected_slug, $taxonomy);
		
		$category_id = $category->term_id;
		
	} else {
		
		$categories = get_the_terms(get_the_ID(), $taxonomy);
		
		if(!empty($categories) && $categories[0] != null) {
		
			$category_id = $categories[0]->term_id;
		
		}		
	}

	return $category_id;
}

//Helpers

function print_pre($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function startsWith($haystack, $needle) {
  $length = strlen($needle);
  return (substr($haystack, 0, $length) === $needle);
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function randomise_svg_id($svg, $key) {
	$random_id = generateRandomString(5);
	$svg = str_replace('id="'.$key.'"', 'id="'.$key.'_'.$random_id.'"', $svg);
	$svg = str_replace('url(#'.$key.')', 'url(#'.$key.'_'.$random_id.')', $svg);	
	$svg = str_replace('xlink:href="#'.$key.'"', 'xlink:href="#'.$key.'_'.$random_id.'"', $svg);
	return $svg;
}

function update_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'update_mime_types');

function load_svg($name) {
	$file = get_template_directory() . '/public/svg/'.$name.'.svg';
	$svg = file_get_contents($file);
	$svg = clean_up_svg($svg);
	echo $svg;
}

function clean_up_svg($svg) {
	$svg = randomise_svg_id($svg, 'a');
	$svg = randomise_svg_id($svg, 'b');
	$svg = randomise_svg_id($svg, 'clip-path');
	$svg = randomise_svg_id($svg, 'rect');
	$svg = randomise_svg_id($svg, 'path-1');
	$svg = randomise_svg_id($svg, 'mask-2');
	return $svg;	
}

function is_basic_page() {
	return basename(get_page_template()) === 'page.php';
}

function format_telephone($telephone) {

	return preg_replace('/[^0-9.]+/', '', str_replace('+44', '', $telephone));
}

function sticky_posts_custom_query($query) {

	if ($query->is_main_query() && is_home()) {

		// set the number of posts per page
		$posts_per_page = get_option('posts_per_page');
		print_pre($posts_per_page);
		
		// get sticky posts array
		$sticky_posts = get_option( 'sticky_posts' );

		// if we have any sticky posts and we are at the first page
		if (is_array($sticky_posts) && !$query->is_paged()) {

			// count the number of sticky posts
			$sticky_count = count($sticky_posts);
			print_pre($sticky_count);

			// and if the number of sticky posts is less than
			// the number we want to set:
			if ($sticky_count < $posts_per_page) {
				$query->set('posts_per_page', $posts_per_page - $sticky_count);

			// if the number of sticky posts is greater than or equal
			// the number of pages we want to set:
			} else {
				$query->set('posts_per_page', 1);
			}

		// fallback in case we have no sticky posts
		// and we are not on the first page
		} else {
			$query->set('posts_per_page', $posts_per_page);
		}
	}
}
//add_action('pre_get_posts', 'sticky_posts_custom_query');

function numeric_posts_nav($max_num_pages, $page = 1) {
	
	/** Stop execution if there's only 1 page */
	if( $max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : $page;
	$max   = intval( $max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	
	$prev_page = $paged - 1;
	
	$next_page = $paged + 1;
	
	if ( $next_page > $max) {
		$next_page = $max;
	}

	$link_class = '';
	$active_class = 'active';
	$arrow_class = '';

	/**	Previous Post Link */
	$prev_hidden = ( $paged == 1 ) ? 'invisible' : '';
	echo '<div class="arrows '.$prev_hidden.'">';
	echo '<a href="'.esc_url( get_pagenum_link( $prev_page ) ).'" class="'.$arrow_class.'" data-paged="'.$prev_page.'" aria-label="Go to previous page">';
	load_svg('arrow-left');
	echo '</a>';
	echo '</div>';
	
	echo '<ul class="">' . "\n";
	
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="'.$active_class.'"' : '';

		printf( '<li%s><a href="%s" class="'.$link_class.'" data-paged="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1', '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><span class="'.$link_class.'">&hellip;</span></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="'.$active_class.'"' : '';
		printf( '<li%s><a href="%s" class="'.$link_class.'" data-paged="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link, $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><span class="'.$link_class.'">&hellip;</span></li>' . "\n";

		$class = $paged == $max ? ' class="'.$active_class.'"' : '';
		printf( '<li%s><a href="%s" class="'.$link_class.'" data-paged="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max, $max );
	}
	
	echo '</ul>' . "\n";

	/**	Next Post Link */
	$next_hidden = ( $paged == $max ) ? 'invisible' : '';
	echo '<div class="arrows '.$next_hidden.'">';
	echo '<a href="'.esc_url( get_pagenum_link( $next_page ) ).'" class="'.$arrow_class.'" data-paged="'.$next_page.'" aria-label="Go to next page">';
	load_svg('arrow-right');
	echo '</a>';
	echo '</div>';

}

function get_posts_years() {
  global $wpdb;
  $result = array();
  $status = 'publish';
  $years = $wpdb->get_results(
      $wpdb->prepare(
          "SELECT YEAR(post_date) FROM {$wpdb->posts} WHERE post_status = %s GROUP BY YEAR(post_date) DESC", $status
      ),
      ARRAY_N
  );
  if ( is_array( $years ) && count( $years ) > 0 ) {
      foreach ( $years as $year ) {
          $result[] = $year[0];
      }
  }
  return $result;
}


function show_posts_on_archive_page( $query ) {
	if ( !is_admin() && $query->is_archive() && $query->is_main_query() ) {
		$query->set( 'post_type', 'post' );
	}
}
add_action( 'pre_get_posts', 'show_posts_on_archive_page' );