<div class="container container-wide">

	<div class="columns">
		
		<div class="column column-content">
			
			<h2 class="heading heading-3">
				<?php include('components/heading.php'); ?>
			</h2>
			
			<?php include('components/content.php'); ?>
			
		</div>
		
		<div class="column column-content">
		
			<?php echo do_shortcode(get_sub_field('code_embed')); ?>	
			
		</div>
		
	</div>
	
</div>