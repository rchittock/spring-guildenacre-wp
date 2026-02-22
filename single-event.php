<?php get_header(); ?>

<main class="page-wrapper">

	<div class="page-inner">

		<div class="page-content">

			<section id="panel-5" class="panel panel-50-50 panel-align-right panel-show-stars panel-circle-orientation-right animation-running">

				<div class="container container-wide">

					<div class="columns">

						<div class="column column-content">

							<div class="inner">
								
								<a href="<?php echo home_url('whats-on'); ?>" class="button">
									Back to Events
								</a>

								<h1 class="heading heading-1"><?php the_title(); ?></h1>
								
								<p class="date"><?php echo get_event_date_string(get_the_ID()); ?></p>
								
								<div class="info">
									
									<p class="age-range">
										<?php load_svg('event-card-person'); ?>
										<span class="text"><?php echo get_event_age_range_string(get_the_ID()); ?></span>
									</p>
									
									<p class="price">
										<?php load_svg('event-card-ticket'); ?>
										<span class="text">
											<?php echo get_event_price_string(get_the_ID()); ?>
										</span>
									</p>
									
								</div>

								<div class="divider">
									<?php load_svg('divider'); ?>
								</div>
							</div>

						</div>

						<div class="column column-media">

							<div class="media-frame masked masked-5050-right">
								<picture class="frame image-style-">
									<?php the_post_thumbnail(); ?>
								</picture>
							</div>

						</div>

					</div>

				</div>

			</section>
			
			<?php include('panels.php'); ?>	

		</div>

	</div>

</main>

<?php get_footer(); ?>