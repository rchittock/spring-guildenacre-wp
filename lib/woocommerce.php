<?php

/* WooCommerce */
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

// Turn off Blocks
add_filter( 'woocommerce_should_load_cart_block', '__return_false' );
add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );

// Sit WC inside of main layout
add_action('woocommerce_before_main_content', 'hooks_open_div', 7);
function hooks_open_div() {
	echo '<main class="page-wrapper">
			<div class="page-inner">
				<div class="page-content">';
}

function hooks_close_div() {
	echo '		</div>';
	echo '	</div>';
	echo '</main>';
}
add_action('woocommerce_after_main_content', 'hooks_close_div', 33);

// Related Products

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20);

add_filter('woocommerce_product_related_products_heading', function(){return false;});

function custom_woocommerce_product_loop_start( $html ) {
	if ( wc_get_loop_prop( 'name', 'related' ) && is_single() ) {
		$html = '
			<div class="panel-header">
				<h4 class="heading heading-2">Similar products</h4>
				<a href="#events" class="button" target="_blank">See all products</a>
			</div>' 
			. $html;
	}
	return $html;
}
add_filter( 'woocommerce_product_loop_start', 'custom_woocommerce_product_loop_start' );

function custom_woocommerce_product_loop_end( $html ) {
	if ( wc_get_loop_prop( 'name', 'related' ) && is_single() ) {
		$html .= '<div class="divider">' . get_svg('divider') . '</div>';
	}
	return $html;
}
add_filter( 'woocommerce_product_loop_end', 'custom_woocommerce_product_loop_end' );

function custom_related_products_args( $args ) {
	$args['posts_per_page'] = 2;
	$args['columns']        = 2;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'custom_related_products_args' );

// Add in panels
function custom_woocommerce_after_single_product_summary() {
	
	echo '				</div>';
	echo '			</section>';
	
	if ( have_rows( 'panels' ) ) :
		include TEMPLATEPATH . '/panels.php';
	endif;
}
add_action( 'woocommerce_after_single_product', 'custom_woocommerce_after_single_product_summary', 15 ); 

// Hide Sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Hide Breadcrumbs
remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb', 20 );

// Hide Sale Badge
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Add Back link
function custom_woocommerce_single_product_summary_title() { ?>	
	<section class="panel panel-woocommerce">
		<div class="container container-wide">
			<a href="javascript:history.back(1);" class="heading heading-7 back-link">	
				<span class="text">&lt; BACK TO PRODUCTS</span>
			</a>
<?php }
add_action( 'woocommerce_before_single_product', 'custom_woocommerce_single_product_summary_title', 0 ); 

// Activate slider
function custom_add_wc_gallery_lightbox() { 
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'custom_add_wc_gallery_lightbox', 100 );

// Remove image links gallery
function wc_remove_link_on_thumbnails( $html ) {
	return strip_tags( $html,'<div><img><ul><ol><li><img>' );
} 
add_filter('woocommerce_single_product_image_thumbnail_html','wc_remove_link_on_thumbnails' );

// Gallery to only show full size images
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
  return 'full';
});

// Use dots instead of images
function custom_update_woo_flexslider_options( $options ) {
	$options['controlNav'] = true;
	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'custom_update_woo_flexslider_options' );

// Remove tabs
add_filter( 'woocommerce_product_tabs', '__return_empty_array', 98 );

// Description
function short_description_add_content(){
	echo '<h3 class="heading heading-7">Description</h3>';
	echo '<div class="content">' . get_the_content() . '</div>';
}
add_action( 'woocommerce_single_product_summary', 'short_description_add_content', 15 );

function woocommerce_template_single_excerpt() {
	return;
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remove Category
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0 );

// Custom quantity
function custom_display_quantity_minus() {
   if ( ! is_product() ) return;
	echo '<span class="">Quantity</span>';
	echo '<button type="button" class="minus" disabled="">-</button>';
}
add_action( 'woocommerce_before_quantity_input_field', 'custom_display_quantity_minus' );
 
function custom_display_quantity_plus() {
   if ( ! is_product() ) return;
   echo '<button type="button" class="plus">+</button>';
}
add_action( 'woocommerce_after_quantity_input_field', 'custom_display_quantity_plus' );
 
function custom_add_cart_quantity_plus_minus() {
   wc_enqueue_js( "
		$('form.cart').on( 'click', 'button.plus, button.minus', function() {
			var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
			var val = parseFloat(qty.val());
			var max = parseFloat(qty.attr( 'max' ));
			var min = parseFloat(qty.attr( 'min' ));
			var step = parseFloat(qty.attr( 'step' ));
			if ( $( this ).is( '.plus' ) ) {
				if ( max && ( max <= val ) ) {
					qty.val( max );
				} else {
					qty.val( val + step );
				}
			} else {
				if ( min && ( min >= val ) ) {
					qty.val( min );
				} else if ( val > 1 ) {
					qty.val( val - step );
				}
			}
			var newVal = parseFloat(qty.val());
			if ( newVal < 2 ) {
				$('.minus').prop('disabled', true);
			} else {
				$('.minus').prop('disabled', false);
			}
			qty.change();
			
			// var price = parseFloat($('.dynamic-price').data('price'));
			// if ( $('.woocommerce-variation-price').length > 0 ) {
			// 	console.log($('.woocommerce-variation-price').text());
			// }			
			// $('.dynamic-price').text('£' + ( price * newVal ).toFixed(2));
		});"
	);
}
add_action( 'woocommerce_before_single_product', 'custom_add_cart_quantity_plus_minus' );