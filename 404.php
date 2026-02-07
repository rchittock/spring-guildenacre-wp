<?php get_header(); ?>

<main class="page-content">
	
	<section class="panels main-content">
			
		<article class="panel panel-hero panel-theme-dark">
			
			<div class="container">
				
				<div class="columns">
					
					<div class="column column-content">
						
						<div class="inner">
							
							<div class="contact-info">
								<a href="<?php echo home_url(); ?>" class="btn">
									&lt; Back to home
								</a>
								<a href="tel:<?php echo format_telephone(get_field( 'telephone', 'option' )); ?>" class="tel">
									<?php load_svg('phone'); ?>
									<span class="text"><?php the_field( 'telephone', 'option' ); ?></span>
								</a>
							</div>
						
							<a href="<?php echo home_url(); ?>">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/public/images/logo.png" alt="Logo for <?php bloginfo('name'); ?>" class="logo" />
							</a>
						
							<h1 class="heading heading-1 heading-size-small">
								Page not found
							</h1>
							
							<div class="content">
								<p>Sorry this page cannot be found.</p>
								<p>Please go to the <a href="<?php echo home_url('/'); ?>">homepage</a></p>
							</div>
							
						</div>
						
					</div>
					
					<div class="column column-media">
						
						<?php 
						$image = get_field('404_hero_image', 'option');
						if ( !empty($image['url']) ) : ?>
							<svg class="hero-blob" viewBox="0 0 656 834" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
								<defs>
									<clipPath id="hero-image">
									<path d="M588.02 796.31C732.57 730.94 833.11 585.47 833.11 416.55C833.11 186.5 646.64 0 416.55 0C186.46 0 0 186.5 0 416.55C0 514.68 33.93 604.88 90.69 676.06C48.02 717.82 17.75 772.16 5.81 833.1H416.56C477.69 833.1 535.73 819.95 588.02 796.3V796.31ZM200.15 416.55C200.15 297.03 297.04 200.14 416.56 200.14C536.08 200.14 632.97 297.03 632.97 416.55C632.97 536.07 536.08 632.96 416.56 632.96C297.04 632.96 200.15 536.07 200.15 416.55Z"
											fill-rule="evenodd"/>
									</clipPath>
								</defs>			
								<image
									href="<?php echo $image['url']; ?>"
									width="656" height="834"
									preserveAspectRatio="xMidYMid slice"
									clip-path="url(#hero-image)"
								/>
							</svg>
						<?php endif; ?>
			
					</div>
			
				</div>
			
			</div>
			
		</article>
		
	</section>
			
</main>

<?php get_footer(); ?>