<?php
$global_panel = get_sub_field( 'panel' );
if ( $global_panel ) :
	$post = $global_panel;
	setup_postdata( $post );
	
	$scope = $post;
	
	if ( have_rows( 'panels', $scope ) ) :
		
		while ( have_rows( 'panels', $scope ) ) : the_row();
			
			$panel = strtolower(str_replace('_', '-', get_row_layout()));
			
			if ( $panel != 'global-panel') :
			
				$panel_classes = get_panel_classes($panel);
				
				$background_image = get_sub_field( 'background_image' );			
				$panel_styles = ''; ?>
				
				<section id="panel-<?php echo $panel_id; ?>" class="panel <?php echo rtrim(implode(' ', $panel_classes)); ?>"<?php echo $panel_styles; ?>>		
				
					<?php include('panel-'.$panel.'.php'); ?>	
					
				</section>
				
				<?php
				
				$panel_id++;
				$style = '';
			
			endif;
		
		endwhile; 
		
	endif;
	 
	$scope = '';
	
	wp_reset_postdata(); ?>
	
<?php endif; ?>