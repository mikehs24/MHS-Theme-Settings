<?php

class MhsWebsiteInfoPage 
{
    function __construct() 
    {
        add_action( 'admin_menu', array( $this, 'infoWebsitePage' ) );
    }

    function infoWebsitePage() 
    {
        $mhsInfoPage = add_submenu_page( 'mhs-settings-page', esc_html__('Contact info', '_pluginname'), esc_html__('Contact info', '_pluginname'), 'manage_options', 'mhs-info-page', array( $this, 'infoPageHTML' ) );
    }

    function saveInfo() 
    { 
        if( wp_verify_nonce( $_POST['securityInfoDataSave'], 'saveInfoData' ) && current_user_can( 'manage_options' ) ) {
            update_option( 'mep_company_name', sanitize_text_field( $_POST['mep_company_name'] ) );
            update_option( 'mep_company_vat_number', sanitize_text_field( $_POST['mep_company_vat_number'] ) );
            update_option( 'mep_phone_number', sanitize_text_field( $_POST['mep_phone_number'] ) );
            update_option( 'mep_email', sanitize_email( $_POST['mep_email'] ) );
            update_option( 'mep_address_line_one', sanitize_text_field( $_POST['mep_address_line_one'] ) );
            update_option( 'mep_address_line_two', sanitize_text_field( $_POST['mep_address_line_two'] ) ); ?> 
            
            <div class="updated"><p><?php esc_html_e( 'Your informations are succefuly saved.', '_pluginname' ) ?></p></div> 
        <?php } else { ?> 
            <div class="error"><p><?php esc_html_e( 'Sorry, you do not have permission to Perform that action.', '_pluginname' ) ?></p></div>
        <?php }
    }
    
    function infoPageHTML() 
    { ?>
        <div class="wrap">
            <h1><?php esc_html_e('Contact info', '_pluginname') ?></h1>
            <p>To view contact info in your website use shortcode: <strong>[mhs_show_contact_info iconcolor=#F0F0F0 textcolor=#E5E5E5 linkcolor=#abc123]</strong></p>
            <?php if( isset($_POST['mhsjustsubmitted']) && $_POST['mhsjustsubmitted'] == 'true' ) $this->saveInfo(); ?>
            <form method="POST">
                <input type="hidden" name="mhsjustsubmitted" value="true">
                <?php wp_nonce_field( 'saveInfoData', 'securityInfoDataSave' ) ?>
                <div class="mhsadmin-info mhsadmin-info-section">
                    <div class="mhsadmin-info__input-group">
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_company_name" class="mhsadmin-info__input-label"><?php esc_html_e( 'Company name:', '_pluginname' ) ?></label>
                            <input type="text" name="mep_company_name" id="mep_company_name" value="<?php echo esc_attr( get_option( 'mep_company_name' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_company_vat_number" class="mhsadmin-info__input-label"><?php esc_html_e( 'Company VAT Number:', '_pluginname' ) ?></label>
                            <input type="text" name="mep_company_vat_number" id="mep_company_vat_number" value="<?php echo esc_attr( get_option( 'mep_company_vat_number' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                    </div>
                    <div class="mhsadmin-info__input-group">
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_phone_number" class="mhsadmin-info__input-label"><?php esc_html_e( 'Phone number:', '_pluginname' ) ?></label>
                            <input type="tel" name="mep_phone_number" id="mep_phone_number" value="<?php echo esc_attr( get_option( 'mep_phone_number' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_email" class="mhsadmin-info__input-label"><?php esc_html_e( 'Email:', '_pluginname' ) ?></label>
                            <input type="email" name="mep_email" id="mep_email" value="<?php echo esc_attr( get_option( 'mep_email' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                    </div>
                    <div class="mhsadmin-info__input-group">
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_address_line_one" class="mhsadmin-info__input-label"><?php esc_html_e( 'Address Line 1:', '_pluginname' ) ?></label>
                            <input type="text" name="mep_address_line_one" id="mep_address_line_one" value="<?php echo esc_attr( get_option( 'mep_address_line_one' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                        <div class="mhsadmin-info__input-box">
                            <label for="mep_address_line_two" class="mhsadmin-info__input-label"><?php esc_html_e( 'Address Line 2:', '_pluginname' ) ?></label>
                            <input type="text" name="mep_address_line_two" id="mep_address_line_two" value="<?php echo esc_attr( get_option( 'mep_address_line_two' ) ) ?>" class="mhsadmin-info__text-field">
                        </div>
                    </div>
                    <div class="mhsadmin-info__input-box mhsadmin-info__input-box--submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save changes', '_pluginname' ) ?>">
                    </div>
                </div>
            </form>
        </div>
    <?php }
}

$mhsWebsiteInfoPage = new MhsWebsiteInfoPage();
