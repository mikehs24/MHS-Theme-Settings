<?php

namespace Mhs\Frontend;

class Woo
{
    public function __construct()
    {
        get_option('mhste_woo_product_info') == '0' ? false : add_action( $this->choosenWoocommerceHook(get_option('mhste_woo_product_info')), array($this, 'productMessageOnFrontend') );
    }

    public function productMessageOnFrontend() 
    { 
        ?>
        <div class="mte-product-message">
            <p><?php echo esc_textarea( get_option( 'mhste_woo_product_message', '' ) ) ?></p>
        </div>
        <?php 
    }

    public function choosenWoocommerceHook($option)
    {
        $wcHook = [
            false,
            'woocommerce_before_single_product',
            'woocommerce_single_product_summary',
            'woocommerce_before_add_to_cart_form',
            'woocommerce_after_add_to_cart_form',
            'woocommerce_after_single_product'
        ];
        return $wcHook[$option];
    }
}