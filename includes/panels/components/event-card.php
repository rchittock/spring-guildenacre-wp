<div class="card event-card">
	
	<div class="masked masked-event-card">
		<?php the_post_thumbnail($post->ID, array('size' => 'thumbnail')); ?>
	</div>
	
	<div class="inner">
	
		<h3 class="heading heading-4"><?php the_title(); ?></h3>
		
		<p class="date"><?php echo get_event_date_string(get_the_ID()); ?></p>
		
		<div class="info">
			
			<p class="age-range">
				<?php load_svg('event-card-person'); ?>
				<span class="text"><?php echo get_event_age_range_string(get_the_ID()); ?></span>
			</p>
			
			<p class="price">
				<?php load_svg('event-card-ticket'); ?>
				<span class="text">
					<?php echo get_event_price_string(get_the_ID()); ?>
				</span>
			</p>
			
		</div>
		
		<a href="<?php the_permalink(); ?>" class="button">
			Book Tickets
		</a>
		
	</div>

</div>