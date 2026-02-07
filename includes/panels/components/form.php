<?php
$form = get_sub_field( 'form' );
if ( $form && class_exists( 'Ninja_Forms' ) ) : ?>
	<?php Ninja_Forms()->display( $form[ 'id' ] ); ?>
<?php endif; ?>