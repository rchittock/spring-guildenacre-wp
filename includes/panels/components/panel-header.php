<?php if ( get_sub_field( 'heading' ) != '' || !empty(get_sub_field('button')) ) : ?>
	<div class="panel-header">
		<?php if ( get_sub_field( 'heading' ) != '' ) : ?>
			<h2 class="heading heading-2">
				<?php include('heading.php'); ?>
			</h2>
		<?php endif; ?>
		<?php include('button.php'); ?>
	</div>
<?php endif; ?>