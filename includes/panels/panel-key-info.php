<div class="container">

		<?php if( have_rows('tabs') ): ?>
			<div class="tabs">
				<?php while( have_rows('tabs') ): the_row(); ?>
			        <?php if( get_row_layout() == 'opening_times' ): ?>
			            <div class="opening-times">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php include('components/content.php'); ?>

						</div>
					<?php endif; ?>

			        <?php if( get_row_layout() == 'directions' ): ?>
			            <div class="directions">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php if( have_rows('columns') ): ?>
			                    <div class="columns-wrapper">
			                        <?php while( have_rows('columns') ): the_row(); ?>
			                            <?php include('components/icon.php'); ?>

			                            <h2 class="heading heading-2">
			                                <?php include('components/heading.php'); ?>
			                            </h2>

			                            <?php include('components/content.php'); ?>

			                            <?php if( have_rows('buttons') ): ?>
			                                <div class="buttons-wrapper">
			                                    <?php while( have_rows('buttons') ): the_row(); ?>
			                                        <?php include('components/button.php'); ?>

			                                    <?php endwhile; ?>
			                                </div>
			                            <?php endif; ?>

			                        <?php endwhile; ?>
			                    </div>
			                <?php endif; ?>

						</div>
					<?php endif; ?>

			        <?php if( get_row_layout() == 'expectations' ): ?>
			            <div class="expectations">

			                <h2 class="heading heading-2">
			                    <?php include('components/heading.php'); ?>
			                </h2>

			                <?php if( have_rows('columns') ): ?>
			                    <div class="columns-wrapper">
			                        <?php while( have_rows('columns') ): the_row(); ?>
			                            <h2 class="heading heading-2">
			                                <?php include('components/heading.php'); ?>
			                            </h2>

			                            <?php include('components/content.php'); ?>

			                            <?php include('components/image.php'); ?>

			                            <?php if( have_rows('icon_list') ): ?>
			                                <div class="icon-list-wrapper">
			                                    <?php while( have_rows('icon_list') ): the_row(); ?>
			                                        <?php include('components/icon.php'); ?>

			                                        <?php include('components/content.php'); ?>

			                                    <?php endwhile; ?>
			                                </div>
			                            <?php endif; ?>

			                        <?php endwhile; ?>
			                    </div>
			                <?php endif; ?>

						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		<?php endif; ?>

</div>