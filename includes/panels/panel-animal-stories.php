<?php 

$story_panel_id = rand();

//echo get_sub_field('star_position'); ?>

<div class="container">

	<h2 class="heading heading-2">
	    <?php include('components/heading.php'); ?>
	</h2>

	<?php if( have_rows('stories') ): ?>
		
		<div class="slider-container">
		
			<div class="stories-nav">
				<?php 
				$story_counter = 0;
				while( have_rows('stories') ): the_row(); ?>
					<?php if( get_row_layout() == 'story' ): ?>
						<button type="button" data-slide="<?php echo $story_counter; ?>" class="story-button">
							<?php include('components/icon.php'); ?>
						</button>
					<?php endif; ?>
				<?php $story_counter++; endwhile; ?>
			</div>
				
			<div class="stories">
				<?php while( have_rows('stories') ): the_row(); ?>
					<?php if( get_row_layout() == 'story' ):
						$style = '';
						$background_image = get_sub_field('background_image');
						if ( !empty($background_image) ) :
							$style = ' style="background-image: url('. $background_image['url'] . ')"';
						endif; ?>
						<div class="story story-star-position-<?php echo get_sub_field('star_position'); ?>">
							<div class="inner"<?php echo $style; ?>>
								<div class="media-frame">
									<div class="masked masked-animal-stories">
										<?php include('components/image.php'); ?>
										<?php include('components/video.php'); ?>
									</div>
								</div>
								<h3 class="heading heading-3">
									<?php include('components/heading.php'); ?>
								</h3>
								<?php include('components/content.php'); ?>
							</div>
						</div>
						
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
			
			<div class="slider-buttons">
				<button type="button" aria-label="Slide Left" class="slider-arrow slider-arrow-prev">Prev</button>
				<?php include('components/divider.php'); ?>
				<button type="button" aria-label="Slide Right" class="slider-arrow slider-arrow-next">Next</button>
			</div>
		
		</div>
		
	<?php endif; ?>

</div>