		
		<?php $footer_map = get_field( 'footer_map', 'option' ); ?>
		<?php if ( $footer_map ) : ?>
			<aside class="footer-map">
				<img src="<?php echo esc_url( $footer_map['url'] ); ?>" 
					alt="<?php echo esc_attr( $footer_map['alt'] ); ?>" 
					loading="lazy" />
			</aside>
		<?php endif; ?>
		
		<footer class="footer">
			
			<div class="container">
				
				<div class="columns">
					
					<div class="column column-menus">
						
						<p class="heading"><?php the_field( 'footer_menu_heading', 'option' ); ?></p>
		
						<div class="menu-surround desktop-menus">
							
							<?php for ( $i = 1; $i < 4; $i++ ) : ?>
								<?php
								wp_nav_menu( array( 
									'container_class' => 'footer-menu footer-menu-' . $i, 
									'theme_location' =>  'footer-menu-' . $i, 
									'container' => 'nav',
									'menu_class' => 'menu'
								) );
								?>	
							<?php endfor; ?>
						
						</div>
						
						<div class="menu-surround mobile-menus">
							
							<?php for ( $i = 1; $i < 3; $i++ ) : ?>
								<?php
								wp_nav_menu( array( 
									'container_class' => 'footer-mobile-menu footer-mobile-menu-' . $i, 
									'theme_location' =>  'footer-mobile-menu-' . $i, 
									'container' => 'nav',
									'menu_class' => 'menu'
								) );
								?>	
							<?php endfor; ?>
							
						</div>
						
					</div>
					
					<div class="column column-form">
										
						<div class="divider">
							<?php load_svg('footer-divider'); ?>
						</div>
						
						<p class="heading"><?php the_field( 'mailing_list_heading', 'option' ); ?></p>
		
						<!-- Form -->
						<form class="mailing-list-form">
							<div class="form-row">
								<input type="text" name="first_name" placeholder="First name" required />
								<input type="email" name="email_address" placeholder="Email address" required />
							</div>
							<div class="form-row">
								<button class="button button--filled">Sign Up</button>
							</div>
						</form>
						
						<p>
							<small>Sign up to receive email updates from Helmingham about this event and related news. You can unsubscribe to withdraw consent at any time. Click to read our Privacy Policy and Cookie Policy. 
							<br/>
							This site is protected by reCAPTCHA and Google’s Privacy Policy and Terms of Service apply.</small>
						</p>
						
					</div>
				</div>
			</div>
		</footer>
		
		<footer class="footer-credits">
			<div class="container">
				<p class="copyright">&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?></p>					
				<a href="<?php echo home_url(); ?>" class="logo" aria-label="Go to Homepage">
					<?php load_svg('footer-logo'); ?>
				</a>
				<a href="https://springagency.co.uk/" target="_blank" class="author">Website by Spring</a>
			</div>
		</footer>

	</div>
</div>

<?php wp_footer(); ?>

</body>
	
</html>