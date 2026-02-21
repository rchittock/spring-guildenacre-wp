<?php 
$column_class = get_sub_field('columns');
$display_class = get_sub_field('display');
$box_count = count(get_sub_field('boxes'));
?>

<div class="container container-wide">

	<?php if( have_rows('boxes') ): ?>
		<div class="boxes boxes-<?php echo $box_count; ?> boxes-<?php echo $display_class; ?> box-columns-<?php echo $column_class; ?>">
			<?php while( have_rows('boxes') ): the_row(); ?>
		        <?php if( get_row_layout() == 'box' ): 
					$box_width = get_sub_field('box_width');
					$overlay_class = ( get_sub_field('heading') != '' || get_sub_field('content') != '' ) ? 'overlay' : 'no-overlay'; ?>
		            <div class="box box-width-<?php echo $box_width; ?> box-<?php echo $overlay_class; ?>">
						
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