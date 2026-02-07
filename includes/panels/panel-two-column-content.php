<div class="container">

		<?php if( have_rows('columns') ): ?>
			<div class="columns">
				<?php while( have_rows('columns') ): the_row(); ?>
			        <?php if( get_row_layout() == 'one_column' ): ?>
			            <div class="one-column">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php include('components/content.php'); ?>

						</div>
					<?php endif; ?>

			        <?php if( get_row_layout() == 'two_columns' ): ?>
			            <div class="two-columns">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php echo get_sub_field('content_1'); ?>

			                <?php echo get_sub_field('content_2'); ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

</div>