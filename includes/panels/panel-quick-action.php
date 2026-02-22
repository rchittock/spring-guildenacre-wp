<?php if( have_rows('popups') ): ?>
	
	<div class="container">	
		<div class="popup-icons">
			<?php while( have_rows('popups') ): the_row(); ?>
		        <?php if( get_row_layout() == 'popup' ):
					$popup_id = strtolower(str_replace(' ', '-', get_sub_field('heading'))); ?>
		            <a href="#<?php echo $popup_id; ?>" class="popup-icon glightbox" data-gallery="gallery_<?php echo rand(); ?>">
		                <?php include('components/image.php'); ?>
		                <span class="heading heading-6">
		                    <span class="mobile-text"><?php the_sub_field('mobile_heading') ?></span>
							<span class="tablet-text"><?php the_sub_field('heading') ?></span>
		                </span>
					</a>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
		
		<div class="divider tablet-divider">
			<?php load_svg('quick-action-divider'); ?>
		</div>
		
	</div>

	<?php while( have_rows('popups') ): the_row(); ?>
		<?php if( get_row_layout() == 'popup' ):
			$popup_id = strtolower(str_replace(' ', '-', get_sub_field('heading'))); ?>
			<div id="<?php echo $popup_id; ?>" class="popup" style="display: none;">
				<div class="inline-inner">
					<h2 class="heading heading-2">
						<?php include('components/heading.php'); ?>
					</h2>
					<?php include('components/content.php'); ?>
					<a class="gtrigger-close inline-close-btn" href="#">Close</a>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>

		
<?php endif; ?>
