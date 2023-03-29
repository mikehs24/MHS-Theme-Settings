<?php

declare(strict_types=1);

namespace Mhs\Admin;

require_once 'PageInterface.php';

use Mhs\Admin\PageInterface;
use Mhs\Frontend\ContactInfo;

class Info implements PageInterface
{
    protected ContactInfo $contactInfo;

    public function __construct()
    {
        if( get_option('mhste_show_contact_info_page') === '1' ){
            add_action( 'admin_menu', array( $this, 'addSettingsPage' ) );

            $this->contactInfo = new ContactInfo();
        }
    }

    public function addSettingsPage()
    {
        add_submenu_page( 
            'mhs-settings-page', 
            esc_html__('Information', 'mhste'), 
            esc_html__('Information', 'mhste'), 
            'manage_options', 
            'mhs-info-page', 
            array( $this, 'pageHtml' ) 
        );
    }

    public function save(): void
    {
        if( wp_verify_nonce( $_POST['mhste_security_info_options'], 'mhste_save_info_options' ) && current_user_can( 'manage_options' ) ) {
            update_option( 'mhste_company_name', sanitize_text_field( $_POST['mhste_company_name'] ) );
            update_option( 'mhste_company_vat_number', sanitize_text_field( $_POST['mhste_company_vat_number'] ) );
            update_option( 'mhste_phone_number', sanitize_text_field( $_POST['mhste_phone_number'] ) );
            update_option( 'mhste_email', sanitize_email( $_POST['mhste_email'] ) );
            update_option( 'mhste_address_line_one', sanitize_text_field( $_POST['mhste_address_line_one'] ) );
            update_option( 'mhste_address_line_two', sanitize_text_field( $_POST['mhste_address_line_two'] ) ); 
            
            ?> 
            <div class="updated">
                <p><?php esc_html_e( 'Your informations are succefuly saved.', 'mhste' ) ?></p>
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
        <h1><?php esc_html_e('Contact info', 'mhste') ?></h1>
        <p>To view contact info in your website use shortcode: <strong>[mhs_show_contact_info iconcolor=#F0F0F0 textcolor=#E5E5E5 linkcolor=#abc123]</strong></p>
        <?php if( isset($_POST['mhste_settings_general_submited']) && $_POST['mhste_settings_general_submited'] == 'true' ) $this->save(); ?>
        <form method="POST">
            <input type="hidden" name="mhste_settings_general_submited" value="true">
            <?php wp_nonce_field( 'mhste_save_info_options', 'mhste_security_info_options' ) ?>
            <div class="mhsadmin-info mhsadmin-info-section">
                <div class="mhsadmin-info__input-group">
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_company_name" class="mhsadmin-info__input-label"><?php esc_html_e( 'Company name:', 'mhste' ) ?></label>
                        <input type="text" name="mhste_company_name" id="mhste_company_name" value="<?php echo esc_attr( get_option( 'mhste_company_name' ) ) ?>" class="mhsadmin-info__text-field">
                    </div>
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_company_vat_number" class="mhsadmin-info__input-label"><?php esc_html_e( 'Company VAT Number:', 'mhste' ) ?></label>
                        <input type="text" name="mhste_company_vat_number" id="mhste_company_vat_number" value="<?php echo esc_attr( get_option( 'mhste_company_vat_number' ) ) ?>" class="mhsadmin-info__text-field">
                    </div>
                </div>
                <div class="mhsadmin-info__input-group">
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_phone_number" class="mhsadmin-info__input-label"><?php esc_html_e( 'Phone number:', 'mhste' ) ?></label>
                        <input type="tel" name="mhste_phone_number" id="mhste_phone_number" value="<?php echo esc_attr( get_option( 'mhste_phone_number' ) ) ?>" class="mhsadmin-info__text-field">
                    </div>
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_email" class="mhsadmin-info__input-label"><?php esc_html_e( 'Email:', 'mhste' ) ?></label>
                        <input type="email" name="mhste_email" id="mhste_email" value="<?php echo esc_attr( get_option( 'mhste_email' ) ) ?>" class="mhsadmin-info__text-field">
                    </div>
                </div>
                <div class="mhsadmin-info__input-group">
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_address_line_one" class="mhsadmin-info__input-label"><?php esc_html_e( 'Address Line 1:', 'mhste' ) ?></label>
                        <input type="text" name="mhste_address_line_one" id="mhste_address_line_one" value="<?php echo esc_attr( get_option( 'mhste_address_line_one' ) ) ?>" class="mhsadmin-info__text-field">
                    </div>
                    <div class="mhsadmin-info__input-box">
                        <label for="mhste_address_line_two" class="mhsadmin-info__input-label"><?php esc_html_e( 'Address Line 2:', 'mhste' ) ?></label>
                        <input type="text" name="mhste_address_line_two" id="mhste_address_line_two" value="<?php echo esc_attr( get_option( 'mhste_address_line_two' ) ) ?>" class="mhsadmin-info__text-field">
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