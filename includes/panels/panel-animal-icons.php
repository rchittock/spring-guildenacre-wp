<div class="container">

		<?php if( have_rows('icons') ): ?>
			<div class="icons">
				<?php 
				$animal_couter = 1;
				while( have_rows('icons') ): the_row(); ?>
			        <?php if( get_row_layout() == 'icon' ): ?>
			            <div class="icon transition-element transition-delay-<?php echo $animal_couter; ?>">
			                <?php include('components/image.php'); ?>
						</div>
					<?php endif; ?>
				<?php $animal_couter++; endwhile; ?>
			</div>
		<?php endif; ?>

</div>