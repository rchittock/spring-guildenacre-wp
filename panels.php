<?php

$panel_id = 1;

if ( !isset($scope) ) {
	$scope = get_the_ID();
}

$has_hero = false;

if ( have_rows( 'panels', $scope ) ) :
	
	while ( have_rows( 'panels', $scope ) ) : the_row();
		
		$panel = strtolower(str_replace('_', '-', get_row_layout()));
		
		if ( $panel == 'global-panel') :
			
			$global_panel = get_sub_field( 'panel' );
			
			include('includes/panels/panel-'.$panel.'.php');
			
		else :
			
			$panel_classes = get_panel_classes($panel);
			
			$background_image = get_sub_field( 'background_image' );			
			
			$panel_styles = get_panel_spacing_style(); ?>
	
			<section id="panel-<?php echo $panel_id; ?>" class="panel <?php echo rtrim(implode(' ', $panel_classes)); ?>"<?php echo $panel_styles; ?>>		
			
				<?php include('includes/panels/panel-'.$panel.'.php'); ?>	
				
			</section>
			
			<?php if ( $panel == 'homepage-hero' ) : 
				$has_hero = true; ?>
				<div class="page-background">
			<?php endif; ?>
		
		<?php  $panel_id++;
	
	endif;
	$style = '';
	
	endwhile; 
	
endif;
 
if ( $has_hero ) :
	echo '</div>';	 
endif;

$scope = '';