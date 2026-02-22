<div class="container container-wide">

	<?php if ( get_sub_field( 'heading' ) != '' || get_sub_field( 'sub_heading' ) != '' ) : ?>
		<h1 class="heading">
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
		</h1>
	<?php endif; ?>

	<?php include('components/button.php'); ?>

	<?php include('components/divider.php'); ?>

</div>