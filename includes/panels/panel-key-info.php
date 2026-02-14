<div class="container container-wide">

		<?php if( have_rows('tabs') ): ?>
			
			<div class="tab-nav">
				<?php 
				$tab_counter = 1;
				while( have_rows('tabs') ): the_row(); ?>
					<button class="tab-button<?php echo ( $tab_counter == 1 ) ? ' active': ''; ?>" data-tab="<?php echo $tab_counter; ?>">
						<?php include('components/heading.php'); ?>
					</button>
				<?php $tab_counter++; endwhile; ?>
			</div>
			
			<div class="tabs">
				<?php 
				$tab_counter = 1;
				while( have_rows('tabs') ): the_row(); ?>
			        <?php if ( get_row_layout() == 'opening_times' ): ?>
			            <div id="tab_<?php echo $tab_counter; ?>" class="tab tab-opening-times<?php echo ( $tab_counter == 1 ) ? ' active': ''; ?>">
						
							<div class="mobile-heading">
								<h3 class="heading heading-5 heading-mobile-5">
									<span class="icon icon-left"><?php load_svg('tab-icon'); ?></span>
									<span class="text"><?php include('components/heading.php'); ?></span>
									<span class="icon icon-right"><?php load_svg('tab-icon'); ?></span>
								</h3>
							</div>
							
							<div class="tab-inner">
								<div class="columns">
									<div class="column column-calendar">
										<div id="calendar"></div>
									</div>
									<div class="column column-opening-info">
										<p id="opening-status" class="opening-status">We're open!</p>
										<p id="opening-dates" class="opening-dates">Friday 10 July 2026</p>
										<p id="opening-times" class="opening-times">10AM - 4PM</p>
										<?php if( have_rows('buttons') ): ?>
											<div class="buttons-wrapper">
												<?php while( have_rows('buttons') ): the_row(); ?>
													<?php include('components/button.php'); ?>
												<?php endwhile; ?>
											</div>
										<?php endif; ?>
										<div id="opening-content" class="content">
											<?php the_sub_field('opening_times_content'); ?>
										</div>
									</div>
									<div class="column column-content">
										<?php include('components/content.php'); ?>		
									</div>
								</div>
							</div>

						</div>
					<?php endif; ?>

			        <?php if ( get_row_layout() == 'directions' ): ?>
			            <div id="tab_<?php echo $tab_counter; ?>" class="tab tab-directions">

			                <div class="mobile-heading">
								<h3 class="heading heading-5 heading-mobile-5">
									<span class="icon icon-left"><?php load_svg('tab-icon'); ?></span>
									<span class="text"><?php include('components/heading.php'); ?></span>
									<span class="icon icon-right"><?php load_svg('tab-icon'); ?></span>
								</h3>
							</div>
							
							<div class="tab-inner">
								<?php if( have_rows('columns') ): ?>
									<div class="columns">
										<?php while( have_rows('columns') ): the_row(); ?>
											<div class="column">
												<div class="column-header">
													<?php include('components/icon.php'); ?>
													<h4 class="heading heading-4 heading-mobile-4">
														<?php include('components/heading.php'); ?>
													</h4>
												</div>
												<div class="column-content">
													<?php include('components/content.php'); ?>	
													<?php if( have_rows('buttons') ): ?>
														<div class="buttons-wrapper">
															<?php while( have_rows('buttons') ): the_row(); ?>
																<?php include('components/button.php'); ?>
															<?php endwhile; ?>
														</div>
													<?php endif; ?>	
												</div>
											</div>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

			        <?php if ( get_row_layout() == 'expectations' ): ?>
			            <div id="tab_<?php echo $tab_counter; ?>" class="tab tab-expectations">

			                <div class="mobile-heading">
								<h3 class="heading heading-5 heading-mobile-5">
									<span class="icon icon-left"><?php load_svg('tab-icon'); ?></span>
									<span class="text"><?php include('components/heading.php'); ?></span>
									<span class="icon icon-right"><?php load_svg('tab-icon'); ?></span>
								</h3>
							</div>
							
							<div class="tab-inner">
								<?php if( have_rows('columns') ): ?>
									<div class="columns">
										<?php while( have_rows('columns') ): the_row(); ?>
											<div class="column">
												<div class="column-header">
													<?php include('components/icon.php'); ?>
													<h4 class="heading heading-4 heading-mobile-4">
														<?php include('components/heading.php'); ?>
													</h4>
												</div>
												<div class="column-content">
													<?php include('components/content.php'); ?>	
													<?php include('components/image.php'); ?>
													<?php if( have_rows('icon_list') ): ?>
														<div class="icon-list-wrapper">
															<?php while( have_rows('icon_list') ): the_row(); ?>
																<div class="icon-row">
																	<?php include('components/icon.php'); ?>
																	<?php include('components/content.php'); ?>
																</div>
															<?php endwhile; ?>
														</div>
													<?php endif; ?>
												</div>
											</div>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

				<?php $tab_counter++; endwhile; ?>
			</div>
		<?php endif; ?>

</div>