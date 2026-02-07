<?php
$callout = get_sub_field( 'callout' );
if ( $callout ) { ?> 
	<div class="callout">
		<?php echo $callout; ?>
	</div>
<?php } ?>