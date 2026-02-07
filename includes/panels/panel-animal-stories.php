<div class="container">

		<h2 class="heading heading-2">
		    <?php include('components/heading.php'); ?>
		</h2>

		<?php if( have_rows('stories') ): ?>
			<div class="stories">
				<?php while( have_rows('stories') ): the_row(); ?>
			        <?php if( get_row_layout() == 'story' ): ?>
			            <div class="story">

			                <?php include('components/icon.php'); ?>

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php include('components/content.php'); ?>

			                <?php include('components/image.php'); ?>

			                <?php include('components/video.php'); ?>

			                <?php echo get_sub_field('star_position'); ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

</div>