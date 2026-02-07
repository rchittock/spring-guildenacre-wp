<?php if ( have_rows( 'media' ) ): ?>
	<div class="media-slider">
		<?php while ( have_rows( 'media' ) ) : the_row(); ?>
			<?php if ( get_row_layout() == 'image' ) :
				$image = get_sub_field( 'image' );
				$focus = get_sub_field( 'image_focus' ) != '' ? get_sub_field( 'image_focus' ) : 'center';
				$frame_style = get_sub_field( 'frame_style' );
				$alignment = $alignment != '' ? $alignment : 'vertical';		
				if ( $image ) : ?>
					<div class="<?php echo 'masked masked-' . $alignment . '-style-' . $frame_style; ?>">
						<img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" 
							alt="<?php echo esc_attr( $image['alt'] ); ?>"
							style="object-position: <?php echo $focus; ?>" class="slide" />
					</div>
				<?php endif; ?>
			<?php elseif ( get_row_layout() == 'carousel' ) : ?>
				<?php if ( have_rows( 'images' ) ) : ?>
					<ul class="carousel">
						<?php while ( have_rows( 'images' ) ) : the_row();
							$image = get_sub_field( 'image' );
							$focus = get_sub_field( 'image_focus' ) != '' ? get_sub_field( 'image_focus' ) : 'center';
							$frame_style = get_sub_field( 'frame_style' );
							$alignment = $alignment != '' ? $alignment : 'vertical';						
							if ( $image ) : ?>
								<li class="<?php echo 'masked masked-' . $alignment . '-style-' . $frame_style; ?>">
									<img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" 
										 alt="<?php echo esc_attr( $image['alt'] ); ?>" 
										 class="slide" />
								</li>
							<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			<?php elseif ( get_row_layout() == 'map' ) :
				include('map.php');
			elseif ( get_row_layout() == 'video' ) : 
				$frame_style = get_sub_field( 'frame_style' ); ?>
				<div class="masked masked-vertical-style-<?php echo $frame_style; ?>">
					<?php include('video.php'); ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>