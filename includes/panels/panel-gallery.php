<div class="container container-wide">

	<?php 
	$gallery_id = rand();
	if( have_rows('images') ): ?>
	    <div class="images-grid">
	        <?php while( have_rows('images') ): the_row(); 
				$image = get_sub_field('image');
				if ( $image ) : ?>
					<a href="<?php echo $image['url']; ?>" class="glightbox" data-gallery="gallery_<?php echo $gallery_id; ?>">
						<?php include('components/image.php'); ?>
					</a>
				<?php endif; ?>
	        <?php endwhile; ?>
	    </div>
	<?php endif; ?>

</div>