<?php

add_action('wp_ajax_venue_open_status', 'venue_open_status');
add_action('wp_ajax_nopriv_venue_open_status', 'venue_open_status');

function venue_open_status() {
	
	// Basic security
	check_ajax_referer('venuecal_nonce', 'nonce');
	
	$date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';
	if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
		wp_send_json_error(['message' => 'Invalid date format.']);
	}
	
	// UK formatting for display
	$ts = strtotime($date . ' 12:00:00');
	$formatted_date = wp_date('l j F Y', $ts);
	
	//Date for Query
	$clicked_ymd = (int) date('Ymd', strtotime($date . ' 12:00:00'));
	
	// Weekday based on date
	$weekday_num = (int) date('N', $ts);
	
	$open_key_map = [
		1 => 'open_on_monday',
		2 => 'open_on_tuesday',
		3 => 'open_on_wednesday',
		4 => 'open_on_thursday',
		5 => 'open_on_friday',
		6 => 'open_on_saturday',
		7 => 'open_on_sunday',
	];
	
	$open_key = $open_key_map[$weekday_num];
	
	// Find the season post where start_date <= $date <= end_date
	// IMPORTANT: this works best if dates are stored as YYYY-MM-DD (string compare works)
		
	$args = [
		'post_type'      => 'opening_time',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'orderby'        => 'meta_value',
		'meta_key'       => 'season_start',
		'order'          => 'DESC',
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => 'season_start',
				'value'   => $clicked_ymd,
				'compare' => '<=',
				'type'    => 'NUMERIC',
			],
			[
				'key'     => 'season_end',
				'value'   => $clicked_ymd,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			],
		],
	];
	
	$q = new WP_Query($args);
	
	if (!$q->have_posts()) {
		wp_send_json_success([
			'opening_status' => $opening_status,
			'opening_dates' => $formatted_date,
			'opening_times' => $opening_times,
			'opening_content' => 'No season found for this date.'
		]);
	}
	
	$post_id = $q->posts[0]->ID;
	$season_title = get_the_title($post_id);
	  
	$is_open = get_field($open_key, $post_id);
	
	$opening_status = ( $is_open ) ? "We're Open!" : "We're closed!";
	
	$opening_times = get_field('opening_time', $post_id) . ' - ' . get_field('closing_time', $post_id);
	
	wp_send_json_success([
		'opening_status' => $opening_status,
		'opening_dates' => $formatted_date,
		'opening_times' => $opening_times,
		'opening_content' => 
			get_field('last_entry_text', $post_id) . ' ' . get_field('last_entry_time', $post_id) . '.' . 
			get_field('custom_text', $post_id)
	]);
}