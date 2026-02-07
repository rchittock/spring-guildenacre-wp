<div class="container">

		<h2 class="heading heading-2">
		    <?php include('components/heading.php'); ?>
		</h2>

		<?php include('components/button.php'); ?>

		<?php if( have_rows('faqs') ): ?>
			<div class="faqs">
				<?php while( have_rows('faqs') ): the_row(); ?>
			        <?php if( get_row_layout() == 'faq' ): ?>
			            <div class="faq">

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