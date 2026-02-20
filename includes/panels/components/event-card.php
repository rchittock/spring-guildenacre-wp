<?php

$acf_format = 'd/m/Y g:i a';

$start_raw = get_field('start_date');
$end_raw   = get_field('end_date');

$start_date = $start_raw ? DateTime::createFromFormat($acf_format, $start_raw) : null;
$end_date   = $end_raw   ? DateTime::createFromFormat($acf_format, $end_raw) : null;
	
if (!$start_date && !$end_date) {
	$date_string = ''; // or fallback text
} else {
	$custom_date_text = get_field('custom_date_text');
	$date_string = get_date_string($start_date, $end_date, $custom_date_text, 'd F');
}	

$age_range_text = get_field('age_range_text');
$age_range_terms = get_the_terms($post->ID, 'event-age-range');

$age_range_string = '';

if ( $age_range_text != '' ) {
	$age_range_string = $age_range_text;
	
} else if ( !empty($age_range_terms) ) {
	$age_range_string = $age_range_terms[0]->name;
}

$price = get_field('price');
$before_price_text = get_field('before_price_text');
$after_price_text = get_field('after_price_text');
?>

<div class="card event-card">
	
	<?php the_post_thumbnail($post->ID, array('size' => 'thumbnail')); ?>
	
	<div class="inner">
	
		<h3 class="heading heading-4"><?php the_title(); ?></h3>
		
		<p class="date"><?php echo $date_string; ?></p>
		
		<div class="info">
			
			<p class="age-range">
				<?php load_svg('event-card-person'); ?>
				<span class="text"><?php echo $age_range_string; ?></span>
			</p>
			
			<p class="price">
				<?php load_svg('event-card-ticket'); ?>
				<span class="text">
					<?php echo $before_price_text; ?>
					£<?php echo $price; ?>
					<?php echo $after_price_text; ?>
				</span>
			</p>
			
		</div>
		
		<a href="<?php the_permalink(); ?>" class="button">
			Book Tickets
		</a>
		
	</div>

</div>