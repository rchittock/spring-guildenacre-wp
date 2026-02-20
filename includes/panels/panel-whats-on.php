<div class="container container-wide">

	<div class="panel-header">
		<h2 class="heading heading-2">
			<?php include('components/heading.php'); ?>
		</h2>
		<div class="filters">
			<?php if ( get_sub_field('show_activity_type') == 1 ) : ?>
				<select class="filter filter-activity-type" name="activity-type">
					<option>Activity Type</option>
					<?php 
					$terms = get_terms([
						'taxonomy'   => 'event-activity-type', 
						'hide_empty' => 1,
						'orderby' => 'name', 
						'order' => 'ASC',
					]);
					if ( $terms ) :
						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->term_id; ?>">
								<?php echo $term->name; ?>
							</option>
						<?php endforeach;
					endif; ?>
				</select>	
			<?php endif; ?>
			
			<?php if ( get_sub_field('show_age_range') == 1 ) : ?>
				<select class="filter filter-age-range" name="age-range">
					<option>Age Range</option>
					<?php 
					$terms = get_terms([
						'taxonomy'   => 'event-age-range', 
						'hide_empty' => 1,
						'orderby' => 'name', 
						'order' => 'ASC',
					]);
					if ( $terms ) :
						foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->term_id; ?>">
								<?php echo $term->name; ?>
							</option>
						<?php endforeach;
					endif; ?>
				</select>	
			<?php endif; ?>
			
			<?php if ( get_sub_field('show_date_range') == 1 ) : ?>
				<div id="event-dates" class="filter filter-dates">
					Select Date
				</div>			
				<input id="date_selected" type="hidden" value="false" />
			<?php endif; ?>
			
		</div>
	</div>

	<div class="filter-results">
		
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
		
		$event_counter = 1;
		
		if ( $events->have_posts() ) :	
			while ( $events->have_posts() ) : $events->the_post(); 
				include('components/event-card.php');
				$event_counter++; 
			endwhile;
		endif; ?>
		
		<?php 
		wp_reset_query();
		?>
	</div>
</div>