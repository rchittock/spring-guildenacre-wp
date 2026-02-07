<div class="container">

		<?php if( have_rows('icons') ): ?>
			<div class="icons">
				<?php while( have_rows('icons') ): the_row(); ?>
			        <?php if( get_row_layout() == 'icon' ): ?>
			            <div class="icon">

			                <?php include('components/image.php'); ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

</div>