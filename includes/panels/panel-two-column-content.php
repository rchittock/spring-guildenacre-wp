<div class="container container-wide">

	<?php if( have_rows('columns') ): ?>
		<?php while( have_rows('columns') ): the_row(); ?>
	        
			<?php if( get_row_layout() == 'one_column' ): ?>
	            
				<h3 class="heading heading-3">
					<?php include('components/heading.php'); ?>
				</h3>
				
				<?php include('components/content.php'); ?>

			<?php endif; ?>

	        <?php if( get_row_layout() == 'two_columns' ): ?>

                <h3 class="heading heading-3">
                    <?php include('components/heading.php'); ?>
                </h3>
				
				<div class="columns">
					<div class="column">
						<div class="content">
							<?php echo get_sub_field('content_1'); ?>
						</div>
					</div>
					<div class="column">
						<div class="content">
							<?php echo get_sub_field('content_2'); ?>
						</div>
					</div>
				</div>
				
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

</div>