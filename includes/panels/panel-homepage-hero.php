<?php 
$layer_count = count(get_sub_field('layers'));
$show_fireflies = get_sub_field( 'show_fireflies' ) == 1;
if ( have_rows( 'layers' ) ) : ?>
	<div class="keyart" id="parallax" data-layers="<?php echo $layer_count; ?>">
		<?php 
		$counter = 1;
		while ( have_rows( 'layers' ) ) : the_row();
			$desktop_image = get_sub_field('desktop_image');         // desktop or universal
			$mobile_image = get_sub_field('mobile_image');  // mobile-specific (optional)
			$desktop_speed = (float) get_sub_field('desktop_speed');	
			$mobile_speed = (float) get_sub_field('mobile_speed');		
			$layer_id = 'keyart-' . $counter;
			
			$layer_class = 'keyart-layer';
			if ( $counter != $layer_count ) :
				$layer_class .= ' parallax';
			endif; ?>
		
			<div class="<?php echo $layer_class; ?>" data-speed="<?php echo esc_attr($desktop_speed); ?>" data-speed-mobile="<?php echo esc_attr($mobile_speed); ?>">
				<img src="<?php echo esc_url($mobile_image['url']); ?>" alt="" class="mobile" />
				<img src="<?php echo esc_url($desktop_image['url']); ?>" alt="" class="tablet" />
			</div>
			
			<?php 
			$counter++;
		endwhile;
		
		if ( $show_fireflies ) : ?>
			<div id="<?php echo $layer_id; ?>" class="<?php echo $layer_class; ?> firefly-container"></div>	
		<?php endif; ?>
		
	</div>
<?php endif; ?>

<a href="#panel-2" class="scroll-down-anchor heading heading-7">
	<span class="text transition-element"><?php include('components/heading.php'); ?></span>
	<span class="transition-element transition-delay-1"><?php load_svg('scroll-down'); ?></span>
</a>