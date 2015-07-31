<?php
/**
 * Remove noties of wootheme update
 * */
if(is_admin())
    remove_action( 'admin_notices', 'woothemes_updater_notice' );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'kt_header_add_to_cart_fragment' );
function kt_header_add_to_cart_fragment( $fragments ) {
	$fragments['#cart-block.shopping-cart-box'] = kt_cart_button();
	
	return $fragments;
}