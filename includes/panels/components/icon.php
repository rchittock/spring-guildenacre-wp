<?php 
$icon = get_sub_field( 'icon' );
if ( $icon ) : ?>
	<img 
		src="<?php echo esc_url( $icon['sizes']['large'] ); ?>" 
		alt="<?php echo esc_attr( $icon['alt'] ); ?>" 
		loading="lazy" 
		class="icon"
	/>
<?php endif; ?>