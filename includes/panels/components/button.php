<?php if ( have_rows( 'button' ) ) : ?>
	<?php while ( have_rows( 'button' ) ) : the_row(); 
		$text = get_sub_field( 'text' );
		$link = get_sub_field( 'link' );
		$external_link = get_sub_field( 'external_link' );
		if ( $external_link ) :
			$target = $external_link;
		else :
			$target = $link['url'];
		endif;
		if ( $target && $text ) : ?>
			<a href="<?php echo $target; ?>" class="button"<?php if ( $external_link ) : ?> target="_blank"<?php endif; ?>>
				<?php echo $text; ?>
			</a>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>