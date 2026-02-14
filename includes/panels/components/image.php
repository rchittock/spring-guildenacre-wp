<?php 
$image = get_sub_field( 'image' );
$mobile_image = get_sub_field( 'mobile_image' );

if ( $image ) : 
	$image_position = get_sub_field( 'image_position' );
	$image_style = get_sub_field( 'image_style' );
	$width = get_sub_field( 'width' );
	$height = get_sub_field( 'height' ); ?>
	<picture class="frame image-style-<?php echo $image_style; ?>">
		<?php if ( $mobile_image ) : ?>
			<source 
				media="(max-width: 768px)" 
				srcset="<?php echo esc_url( $mobile_image['sizes']['large'] ); ?>" />
		<?php endif; ?>
		<img 
			src="<?php echo esc_url( $image['sizes']['large'] ); ?>" 
			alt="<?php echo esc_attr( $image['alt'] ); ?>" 
			loading="lazy" 
			style="object-position: <?php echo $image_position; ?>"
			<?php if ( $width ) : ?> width="<?php echo $width; ?>"<?php endif; ?>
			<?php if ( $height ) : ?> height="<?php echo $height; ?>"<?php endif; ?>
		/>
	</picture>
<?php endif; ?>