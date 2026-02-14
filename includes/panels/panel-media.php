<?php 
$column_class = get_sub_field('columns');
$box_count = count(get_sub_field('boxes'));
$box_even = $box_count % 2 == 0 ? 'even' : 'odd';
?>

<div class="container container-wide">

	<?php if( have_rows('boxes') ): ?>
		<div class="boxes boxes-<?php echo $box_count; ?> boxes-<?php echo $box_even; ?> box-columns-<?php echo $column_class; ?>">
			<?php while( have_rows('boxes') ): the_row(); ?>
		        <?php if( get_row_layout() == 'box' ): 
					$overlay_class = ( get_sub_field('heading') != '' || get_sub_field('content') != '' ) ? 'overlay' : 'no-overlay'; ?>
		            <div class="box box-<?php echo $overlay_class; ?>">
						
						<div class="frame">
							<?php include('components/image.php'); ?>
							<?php //include('components/video.php'); ?>
						</div>
						
						<div class="inner">
							
							<?php if( get_sub_field('heading') ) : ?>
								<h2 class="heading heading-3">
									<?php include('components/heading.php'); ?>
								</h2>
							<?php endif; ?>
	
							<?php include('components/content.php'); ?>
	
							<?php include('components/button.php'); ?>
						</div>
						
						<?php include('components/icon.php'); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; ?>
		</div>
	<?php endif; ?>
	
	<?php 
	if ( $column_class != 'full' ) :
		include('components/divider.php'); 
	endif;
	?>

	<?php //echo get_sub_field('star_position'); ?>

	<?php //echo get_sub_field('leaf_position'); ?>

</div>