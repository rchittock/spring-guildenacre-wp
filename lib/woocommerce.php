<?php

/* WooCommerce */
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

/* Turn off Blocks */

add_filter( 'woocommerce_should_load_cart_block', '__return_false' );
add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );