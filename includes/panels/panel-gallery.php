<div class="container container-wide">

	<?php if( have_rows('images') ): ?>
	    <div class="images-grid">
	        <?php while( have_rows('images') ): the_row(); ?>
	            <?php include('components/image.php'); ?>
	        <?php endwhile; ?>
	    </div>
	<?php endif; ?>

</div>