<?php

declare(strict_types=1);

namespace Mhs\Admin;

use Mhs\Admin\PageInterface;
use Mhs\Frontend\Woo as WooFrontend;

class Woo implements PageInterface
{
    protected WooFrontend $wooFrontend;

    public function __construct()
    {
        if( get_option('mhste_show_woo_options_page') === '1' ){
            add_action( 'admin_menu', array( $this, 'addSettingsPage' ) );

            $this->wooFrontend = new WooFrontend();
        }
    }

    public function addSettingsPage()
    {
        add_submenu_page( 
            'mhs-settings-page', 
            esc_html__('WooCommerce options', 'mhste'), 
            esc_html__('WooCommerce', 'mhste'), 
            'manage_options', 
            'mhs-options-woo', 
            array( $this, 'pageHtml' ) 
        );
    }

    public function save(): void
    {
        if( wp_verify_nonce( $_POST['mhste_security_woo_options'], 'mhste_save_woo_options' ) && current_user_can( 'manage_options' ) ) {
            update_option( 'mhste_woo_product_info', sanitize_text_field( $_POST['mhste_woo_product_info'] ) );
            update_option( 'mhste_woo_product_message', sanitize_text_field( $_POST['mhste_woo_product_message'] ) ); 
            
            ?>
            <div class="updated">
                <p><?php esc_html_e( 'Your settings are succefuly saved.', 'mhste' ) ?></p>
            </div> 
            <?php
        } else { 
            ?>
            <div class="error">
                <p><?php esc_html_e( 'Sorry, you do not have permission to perform that action.', 'mhste' ) ?></p>
            </div>
            <?php 
        }
    }

    public function pageHtml(): void
    {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'WooCommerce options', 'mhste' ) ?></h1>
        <?php if( isset($_POST['mhste_options_woo_submited']) && $_POST['mhste_options_woo_submited'] == 'true' ) $this->save(); ?>
        <form method="POST">
            <input type="hidden" name="mhste_options_woo_submited" value="true">
            <?php wp_nonce_field( 'mhste_save_woo_options', 'mhste_security_woo_options' ) ?>
            <div class="mhsadmin-info mhsadmin-info-section">
                <h2 class="mhsadmin-settings__title"><?php esc_html_e( 'WooCommerce options', 'mhste' ) ?></h2>
                <div class="mhsadmin-info__input-group">
                    <div class="mhsadmin-info__input-box" style="display:inline;margin-top:2rem;">
                        <label for="mhste_woo_product_info"><strong><?php esc_html_e( 'Message on product page:', 'mhste' ) ?></strong></label> <select name="mhste_woo_product_info">
                            <option value="0" <?php selected( get_option('mhste_woo_product_info'), '0' ) ?>><?php esc_html_e( 'Disable', 'mhste' ) ?></option>
                            <option value="1" <?php selected( get_option('mhste_woo_product_info'), '1' ) ?>><?php esc_html_e( 'Before single product', 'mhste' ) ?></option>
                            <option value="2" <?php selected( get_option('mhste_woo_product_info'), '2' ) ?>><?php esc_html_e( 'In single product sumary box', 'mhste' ) ?></option>
                            <option value="3" <?php selected( get_option('mhste_woo_product_info'), '3' ) ?>><?php esc_html_e( 'Before add to cart form', 'mhste' ) ?></option>
                            <option value="4" <?php selected( get_option('mhste_woo_product_info'), '4' ) ?>><?php esc_html_e( 'After add to cart form', 'mhste' ) ?></option>
                            <option value="5" <?php selected( get_option('mhste_woo_product_info'), '5' ) ?>><?php esc_html_e( 'After single product summary', 'mhste' ) ?></option>
                        </select>
                    </div>
                </div>
                <div class="mhsadmin-info__input-group">
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_woo_product_message"><strong><?php esc_html_e( 'Message:', 'mhste' ) ?></strong></label>
                        <textarea name="mhste_woo_product_message" id="mhste_woo_product_message" placeholder="<?php esc_html_e( 'Enter message here...', 'mhste' ) ?>"><?php echo esc_textarea( get_option( 'mhste_woo_product_message', '' ) ) ?></textarea>
                    </div>
                </div>
                <div class="mhsadmin-info__input-box mhsadmin-info__input-box--submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save changes', 'mhste' ) ?>">
                </div>
            </div>
        </form>
    </div>
    <?php
    }
}