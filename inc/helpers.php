<?php 

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated(): bool {
		// if ( class_exists('woocommerce') ) { 
        //     return true; 
        // } else { 
        //     return false; 
        // }

        return class_exists('woocommerce') ? true : false;
	}
}