<?php

$panel_id = 1;

if ( !isset($scope) ) {
	$scope = get_the_ID();
}

$has_breadcrumbs = get_field( 'show_breadcrumbs' ) == 1; 

if ( have_rows( 'panels', $scope ) ) :
	
	while ( have_rows( 'panels', $scope ) ) : the_row();
		
		$panel = strtolower(str_replace('_', '-', get_row_layout()));
		
		if ( $panel == 'global-panel') :
			
			include('includes/panels/panel-'.$panel.'.php');
			
		else :
			
			$panel_classes = get_panel_classes($panel);
			
			$background_image = get_sub_field( 'background_image' );			
			$panel_styles = ''; ?>
	
			<section id="panel-<?php echo $panel_id; ?>" class="panel <?php echo rtrim(implode(' ', $panel_classes)); ?>"<?php echo $panel_styles; ?>>		
			
				<?php include('includes/panels/panel-'.$panel.'.php'); ?>	
				
			</section>
		
		<?php  $panel_id++;
	
	endif;
	$style = '';
	
	endwhile; 
	
endif;
 
$scope = '';