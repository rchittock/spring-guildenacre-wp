<div class="container container-wide">

	<?php include('components/panel-header.php'); ?>
	
	<?php $events = get_sub_field('events'); ?>
	<?php if ($events): ?>
		<div class="carousel-container">
			<div class="carousel">
				<?php foreach ($events as $post): ?>
					<?php setup_postdata($post); ?>
					<?php echo include('components/event-card.php'); ?>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</div>	
			<div class="slider-buttons">
				<button type="button" aria-label="Slide Left" class="slider-arrow slider-arrow-prev">Prev</button>
				<?php include('components/divider.php'); ?>
				<button type="button" aria-label="Slide Right" class="slider-arrow slider-arrow-next">Next</button>
			</div>
		</div>
	
	<?php else: ?>
		
		<?php
		$args = array(
			'posts_per_page' => -1,
			'post_type'   => 'event',
			'meta_key' => 'start_date',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_type' => 'DATETIME',	
		);
		
		$events = new WP_Query($args);
		
		if ( $events->have_posts() ) : ?>
			
			<div class="carousel-container">
				<div class="carousel">
					<?php 
					while ( $events->have_posts() ) : $events->the_post(); 
						include('components/event-card.php');
					endwhile;
					?>
				</div>	
				<div class="slider-buttons">
					<button type="button" aria-label="Slide Left" class="slider-arrow slider-arrow-prev">Prev</button>
					<?php include('components/divider.php'); ?>
					<button type="button" aria-label="Slide Right" class="slider-arrow slider-arrow-next">Next</button>
				</div>
			</div>
			
		<?php endif; ?>
		
		<?php 
		wp_reset_query();
		?>
		
	<?php endif; ?>

</div>