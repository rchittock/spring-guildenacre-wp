<div class="container container-wide">

	<div class="panel-header">
		<h2 class="heading heading-2">
		    <?php include('components/heading.php'); ?>
		</h2>
		<?php include('components/button.php'); ?>
	</div>
	
	<?php if( have_rows('faqs') ): ?>
		<div class="accordions">
			<?php while( have_rows('faqs') ): the_row(); ?>
		        <?php if( get_row_layout() == 'faq' ): ?>
		          	<details class="accordion">
						<summary class="accordion-heading heading heading-5 heading-mobile-5">
							<span class="text"><?php include('components/heading.php'); ?></span>
							<span class="arrow"><?php load_svg('slider-arrow'); ?></span>
						</summary>
						<div class="expander">
							<?php include('components/content.php'); ?>
						</div>
					</details>
				<?php endif; ?>

			<?php endwhile; ?>
		</div>
	<?php endif; ?>
	
	<div class="panel-footer">
		<?php include('components/button.php'); ?>
	</div>

	<?php include('components/divider.php'); ?>
	
</div>