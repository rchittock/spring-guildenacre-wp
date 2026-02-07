<div class="container">

		<?php if( have_rows('popups') ): ?>
			<div class="popups">
				<?php while( have_rows('popups') ): the_row(); ?>
			        <?php if( get_row_layout() == 'popup' ): ?>
			            <div class="popup">

			                <?php include('components/image.php'); ?>

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php include('components/content.php'); ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

</div>