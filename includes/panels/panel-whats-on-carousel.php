<div class="container">

	<div class="panel-header">
		<h2 class="heading heading-2">
			<?php include('components/heading.php'); ?>
		</h2>
		<?php include('components/button.php'); ?>
	</div>

	<?php $events = get_sub_field('events'); ?>
	<?php if ($events): ?>
	    <?php foreach ($events as $post): ?>
	        <?php setup_postdata($post); ?>
	        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); ?>
	<?php endif; ?>

</div>