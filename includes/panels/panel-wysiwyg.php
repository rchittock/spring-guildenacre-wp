<div class="container">

	<?php if ( get_sub_field( 'heading' ) != '' || get_sub_field( 'sub_heading' ) != '' ) : ?>
		<h2 class="heading">
			<?php if ( get_sub_field( 'sub_heading' ) != '' ) : ?>
				<span class="heading-2 heading-mobile-2 sub-heading">
					<?php echo get_sub_field('sub_heading'); ?>
				</span>
			<?php endif; ?>
			<?php if ( get_sub_field( 'heading' ) != '' ) : ?>
				<span class="heading-1">
					<?php include('components/heading.php'); ?>
				</span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>
	
	<?php include('components/content.php'); ?>

	<?php include('components/button.php'); ?>

</div>