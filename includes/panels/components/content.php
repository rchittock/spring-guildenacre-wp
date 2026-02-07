<?php
$content = get_sub_field( 'content' );

if ( $content ) { ?> 
	<div class="content">
		<?php echo $content; ?>
	</div>
<?php } ?>