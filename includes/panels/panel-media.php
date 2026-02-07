<div class="container">

		<?php echo get_sub_field('columns'); ?>

		<?php if( have_rows('boxes') ): ?>
			<div class="boxes">
				<?php while( have_rows('boxes') ): the_row(); ?>
			        <?php if( get_row_layout() == 'box' ): ?>
			            <div class="box">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php include('components/content.php'); ?>

			                <?php include('components/button.php'); ?>

			                <?php include('components/image.php'); ?>

			                <?php include('components/video.php'); ?>

			                <?php include('components/icon.php'); ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

		<?php echo get_sub_field('star_position'); ?>

		<?php echo get_sub_field('leaf_position'); ?>

</div>