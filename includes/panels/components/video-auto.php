<?php 
$video = get_sub_field( 'video', false, false);
if (strpos($video, '.mp4') !== false) : ?>
	
	<video autoplay="" muted="" loop="" playsinline="">
		<source src="<?php the_sub_field( 'video', false, false); ?>" type="video/mp4">
	</video>
	
<?php else : ?>
	
	<div class="embed-container">
		<?php the_sub_field('video'); ?>				   
	</div>

<?php endif; ?>