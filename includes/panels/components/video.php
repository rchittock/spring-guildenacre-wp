<div class="video-container">
	
	<?php	
	$video = get_sub_field( 'video', false, false);
	$poster = get_sub_field( 'poster');
	$autoplay = get_sub_field( 'video_autoplay');
	$style = get_sub_field( 'video_style' );
	
	$video_focus = get_sub_field( 'video_focus' );
	if ( $video_focus == '' ) {
		$video_focus = 'center';
	}
	
	if (strpos($video, '.mp4') !== false) : ?>
		
		<video 
			<?php if ( !empty($poster['url'] ) ) : ?>poster="<?php echo $poster['url']; ?>"<?php endif; ?>
			<?php if ( $autoplay == 1 ) : ?>autoplay="" muted="" <?php endif; ?>
			loop=""		
			playsinline="" 
			 style="object-position: <?php echo $video_focus; ?>">
			<source src="<?php the_sub_field( 'video', false, false); ?>" type="video/mp4">
		</video>
		
		<?php if ( $autoplay != 1 ) : ?>
			<div class="play-btn">
				<?php load_svg('play'); ?>
			</div>
		<?php endif; ?>
		
	<?php else : ?>		
		<div class="embed-container">
			<?php the_sub_field('video'); ?>
		</div>
	<?php endif; ?>
	
</div>