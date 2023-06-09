<?php

declare(strict_types=1);

namespace Mhs\Admin;

require_once 'AdminAssets.php';
require_once 'Info.php';
require_once 'Woo.php';

use Mhs\Admin\AdminAssets;
use Mhs\Admin\Info;
use Mhs\Admin\Woo;

class Page implements PageInterface
{
    protected AdminAssets $adminAssets;
    protected Info $infoPage;
    protected Woo $wooPage;

    public function __construct()
    {
        $this->adminAssets = new AdminAssets();
        add_action( 'admin_menu', array( $this, 'addSettingsPage' ) );

        if( get_option('mhste_show_contact_info_page') === '1' ){
            $this->infoPage = new Info();
        }

        if( get_option('mhste_show_woo_options_page') === '1' ){
            $this->wooPage = new Woo();
        }
    }

    public function addSettingsPage()
    {
        /**
         * Main menu plugin page
         */
        add_menu_page( 
            esc_html__('MHS Option', 'mhste'), 
            'MHS Ext', 
            'manage_options', 
            'mhs-settings-page', 
            array( $this, 'pageHtml' ), 
            'data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJsYXllcjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyNTAgMjUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyNTAgMjUwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGVsbGlwc2UgdHJhbnNmb3JtPSJtYXRyaXgoMC43MDcxIC0wLjcwNzEgMC43MDcxIDAuNzA3MSAtNDIuMTY0IDg1LjQyODEpIiBjeD0iODIuMDQiIGN5PSI5My42MSIgcng9IjkuMTMiIHJ5PSI5LjEzIi8+Cgk8cGF0aCBkPSJNMTk3LjkyLDE2Ljc2Yy0wLjU0LTMuNTEtNi4zNS01LjYyLTkuNDQtNS45MXY5NS43OWMwLDEuMzQtMi4yNyw1LjkyLTUuMzMsNS45MmMtMy40MiwwLTUuMzMtNC41OC01LjMzLTUuOTJWMTIuMDYKCQlsLTUyLjgyLDYzLjk1Yy0xLjc2LDIuMDMtMy45NSw0LjU5LTYuMjcsMy4wOEw2My4zNywzNC44OGMtMS4xOC0xLjI3LTIuODctMi4xLTQuNzQtMi4xNWMtMy42OS0wLjEtNi43OSwzLjA1LTYuODgsNi43NGwwLDAuMTEKCQlsMS43NSw3NC4wN2MwLjI1LDIuOSwwLjY2LDUuNzgsMS4xNiw4LjY1bDAuMzksMi4xNGwwLjQ1LDIuMTNjMC4xNCwwLjcxLDAuMzIsMS40MiwwLjQ5LDIuMTJjMC4xOCwwLjcsMC4zMywxLjQxLDAuNTMsMi4xMQoJCWMwLjc0LDIuODEsMS42Miw1LjU3LDIuNTgsOC4zMWMxLDIuNzIsMi4wNyw1LjQxLDMuMjcsOC4wNGMwLjI5LDAuNjYsMC42MiwxLjMxLDAuOTIsMS45NmwwLjQ3LDAuOTgKCQljMC4xNiwwLjMyLDAuMzMsMC42NCwwLjQ5LDAuOTdsMC45OSwxLjkzbDEuMDUsMS45YzEuNDMsMi41MSwyLjkyLDQuOTgsNC41Niw3LjM1bDAuNiwwLjlsMC42MywwLjg4CgkJYzAuNDIsMC41OCwwLjgzLDEuMTcsMS4yNiwxLjc1YzAuODcsMS4xNCwxLjczLDIuMywyLjY1LDMuNDFjMC44OSwxLjEzLDEuODQsMi4yMSwyLjc4LDMuM2MwLjQ4LDAuNTQsMC45NywxLjA2LDEuNDUsMS42CgkJbDAuNzMsMC43OWwwLjc1LDAuNzdjMS45OCwyLjA4LDQuMDcsNC4wNSw2LjIxLDUuOTVsMS42MywxLjRjMC41NCwwLjQ2LDEuMTEsMC45MSwxLjY2LDEuMzZsMC44MywwLjY4bDAuODUsMC42NWwxLjcsMS4zCgkJYzIuMzQsMS43MSw0LjU5LDMuMjQsNi44Nyw0LjgybDEzLjYzLDkuNDVsMTEuMyw3LjgzYy0wLjI2LDAuMTYtMC41MywwLjMzLTAuNzksMC40OWMtMi42NywxLjU0LTUuMjksMy4xNi04LjAxLDQuNjFsLTIuMDEsMS4xNAoJCWwtMSwwLjU3bC0wLjUsMC4yOWwtMC41MSwwLjI3Yy0xLjM3LDAuNzItMi43MiwxLjQ1LTQuMDgsMi4xOGwtMi4wMywxLjExYy0wLjY4LDAuMzYtMS4zOCwwLjY5LTIuMDcsMS4wNGwtNC4xNCwyLjFsLTEuMDMsMC41MwoJCWMtMC4zNSwwLjE4LTAuNywwLjMzLTEuMDUsMC41bC0yLjEsMC45OWMtMS40LDAuNjYtMi44LDEuMzQtNC4yLDIuMDJjLTEuNDEsMC42Ni0yLjg0LDEuMjctNC4yNSwxLjkzCgkJYy0xLjQyLDAuNjQtMi44NCwxLjMtNC4yNSwxLjk3Yy0yLjg3LDEuMjQtNS43NSwyLjQ4LTguNiwzLjg1bDAuMTYsMC41NGMzLjExLTAuNTYsNi4xOS0xLjI2LDkuMjctMS45NgoJCWMxLjUyLTAuNDEsMy4wNS0wLjg0LDQuNTctMS4yN2wyLjI4LTAuNjZsMS4xNC0wLjMzYzAuMzgtMC4xMSwwLjc2LTAuMjIsMS4xMy0wLjM2YzEuNS0wLjUxLDIuOTktMS4wMiw0LjQ5LTEuNTVsMi4yNC0wLjc5CgkJYzAuMzctMC4xNCwwLjc1LTAuMjYsMS4xMi0wLjQxbDEuMS0wLjQ1bDQuNC0xLjgyYzAuNzMtMC4zMSwxLjQ3LTAuNjEsMi4xOS0wLjkzbDIuMTYtMS4wMmMxLjQzLTAuNjksMi44Ny0xLjM4LDQuMjktMi4wOAoJCWwwLjUzLTAuMjZsMC41Mi0wLjI5bDEuMDUtMC41OGwyLjA4LTEuMTZjMC43LTAuMzksMS4zOC0wLjc5LDIuMDctMS4xOGMwLjM0LTAuMiwwLjY5LTAuMzksMS4wMy0wLjZsMS4wMS0wLjY0bDQuMDEtMi41OQoJCWMwLjg4LTAuNjEsMS43NS0xLjIzLDIuNjMtMS44NmwxMS4xNSw3LjY5bDEzLjY3LDkuNGwxMy42OSw5LjM3YzAuMjksMC4yLDAuNjksMC4xNCwwLjkxLTAuMTRjMC4yMy0wLjI5LDAuMTgtMC43MS0wLjExLTAuOTQKCQlsLTEzLjAyLTEwLjI4bC0xMy4wNS0xMC4yNGwtOS41OS03LjUxYzMuMDQtMi4yNiw2LjAyLTQuNjEsOC44OC03LjA5YzAuNjEtMC41MSwxLjIyLTEuMDEsMS44Mi0xLjU0bDEuNzYtMS42MWwxLjc2LTEuNjEKCQljMC4yOS0wLjI3LDAuNTktMC41MywwLjg4LTAuODFsMC44NS0wLjg0YzEuMTMtMS4xMiwyLjI2LTIuMjMsMy4zOC0zLjM2bDMuMjQtMy40OWM0LjIxLTQuNzYsOC4xLTkuOCwxMS41Ni0xNS4xMQoJCWMzLjQ0LTUuMzIsNi41LTEwLjg5LDguOTUtMTYuNzJsMC40Ni0xLjA5bDAuMjMtMC41NWwwLjIxLTAuNTVsMC44NS0yLjIxYzAuNTMtMS40OSwxLjA2LTIuOTcsMS41Mi00LjQ4CgkJYzAuODctMi44NSwxLjYyLTUuNzQsMi4wOC04LjdsMTQuNjQtMTUuNzFDMTk3Ljg4LDEyMC4zOCwxOTguMDIsMjAuMzcsMTk3LjkyLDE2Ljc2eiBNMTgwLjA3LDE0OC4zMgoJCWMtMC4yOSwwLjcyLTAuNTQsMS40Ni0wLjg2LDIuMTdsLTAuOTEsMi4xNWwtMC45NywyLjEybC0wLjI0LDAuNTNsLTAuMjYsMC41MmwtMC41MiwxLjA0Yy0wLjY3LDEuNC0xLjQ0LDIuNzUtMi4xNiw0LjEyCgkJYy0wLjM2LDAuNjgtMC43NywxLjM1LTEuMTYsMi4wMmMtMC40LDAuNjctMC43NywxLjM1LTEuMTgsMmMtMS42MywyLjY0LTMuMzQsNS4yMi01LjE3LDcuNzJjLTMuNjMsNS4wMS03LjY2LDkuNzMtMTEuOTgsMTQuMTQKCQlsLTMuMjgsMy4yN2MtMS4xMywxLjA2LTIuMjcsMi4wOS0zLjQxLDMuMTNsLTAuODUsMC43OGMtMC4yOSwwLjI2LTAuNTksMC41LTAuODgsMC43NWwtMS43NywxLjQ5bC0xLjc3LDEuNDkKCQljLTAuNiwwLjQ5LTEuMjIsMC45NS0xLjgzLDEuNDJjLTMuMjcsMi42Mi02Ljc0LDQuOTktMTAuMjcsNy4yNWwtMTIuMy05LjU4bC0xMy4wOC0xMC4xOWMtMi4xNy0xLjctNC40LTMuNDEtNi40NC01LjA3bC0xLjUzLTEuMwoJCWwtMC43Ni0wLjY1bC0wLjc0LTAuNjdjLTAuNDktMC40NS0wLjk5LTAuODktMS40OC0xLjM1bC0xLjQ0LTEuMzhjLTcuNjItNy40NS0xMy45Ni0xNi4xMi0xOC43LTI1LjU2bC0wLjg4LTEuNzdsLTAuODMtMS44CgkJYy0wLjE0LTAuMy0wLjI4LTAuNi0wLjQxLTAuOWwtMC4zOS0wLjkxYy0wLjI1LTAuNjEtMC41My0xLjIxLTAuNzctMS44MmMtMC45OS0yLjQ0LTEuODYtNC45My0yLjY2LTcuNDQKCQljLTAuNzYtMi41Mi0xLjQ1LTUuMDUtMi4wMi03LjYyYy0wLjE1LTAuNjQtMC4yNy0xLjI5LTAuNC0xLjkzYy0wLjEzLTAuNjQtMC4yNy0xLjI4LTAuMzctMS45M2wtMC4zNC0xLjk0bC0wLjI4LTEuOTUKCQljLTAuMzUtMi42LTAuNjEtNS4yLTAuNzMtNy44MmwxLjQ0LTU2LjcyYzAtMC4xMiwwLTAuMjMsMC0wLjM1bDQ3LjIyLDM4Ljg0YzQuOTQsMy41OCwxMC41Miw1LjE2LDE1LjYxLDEuNzkKCQljMS4xNi0wLjc3LDIuMTYtMS43NywzLjAxLTIuODdsMzYuNDEtNDcuMjZsLTAuNDQsNzhsMTUuNDIsMTUuNDVDMTgyLjA5LDE0Mi42NiwxODEuMTQsMTQ1LjUzLDE4MC4wNywxNDguMzJ6IE0xOTAuMTksMTI2LjA2CgkJbC02LjY0LDcuN2MtMC4zMywwLjM4LTAuOTEsMC4zOS0xLjI1LDAuMDJsLTcuMTUtNy43Yy0wLjUtMC41NC0wLjEyLTEuNDEsMC42MS0xLjQxaDEzLjc5CgkJQzE5MC4yNywxMjQuNjcsMTkwLjY2LDEyNS41MiwxOTAuMTksMTI2LjA2eiIvPgo8L2c+Cjwvc3ZnPg==', 
            3
        );
        add_submenu_page( 
            'mhs-settings-page', 
            esc_html__('Settings', 'mhste'), 
            esc_html__('Settings', 'mhste'), 
            'manage_options', 
            'mhs-settings-page', 
            array( $this, 'pageHtml' ) 
        );
    }

    public function save(): void
    {
        if( wp_verify_nonce($_POST['mhste_security_general_settings'], 'mhste_save_general_settings') && current_user_can('manage_options') ) {
            $infoOption = empty($_POST['mhsteEnableContactInfoOptions']) ? '0' : '1';
            $woocommerceOption = empty($_POST['mhsteEnableWoocommerceOptions']) ? '0' : '1';
            
            update_option( 'mhste_show_contact_info_page', $infoOption ); 
            update_option( 'mhste_show_woo_options_page', $woocommerceOption );

            ?>
            <div class="updated">
                <p><?php esc_html_e('Your settings are succefuly saved.', 'mhste') ?></p>
            </div> 
            <?php 

            header("Refresh:0");
        } else { 
            ?>
            <div class="error">
                <p><?php esc_html_e('Sorry, you do not have permission to perform that action.', 'mhste') ?></p>
            </div>
            <?php 
        }
    }

    public function pageHtml(): void
    {
    ?>
        <div class="wrap">
            <h1><?php esc_html_e('Enable/Disable settings', 'mhste') ?></h1>
            <?php if( isset($_POST['mhste_setting_submitted']) && $_POST['mhste_setting_submitted'] == 'true' ) $this->save(); ?>
            <form method="POST">
                <input type="hidden" name="mhste_setting_submitted" value="true">
                <?php wp_nonce_field( 'mhste_save_general_settings', 'mhste_security_general_settings' ) ?>
                <div class="mhsadmin-info mhsadmin-info-section">
                    <h2><?php esc_html_e('Manage options', 'mhste') ?></h2>
                    <p>
                        <input 
                            type="checkbox" 
                            name="mhsteEnableContactInfoOptions" 
                            id="mhsteEnableContactInfoOptions" 
                            value="1" 
                            <?php checked( get_option('mhste_show_contact_info_page'), '1' ); ?>
                        > <label for="mhsteEnableContactInfoOptions">Contact info</label>
                    </p>
                    <p>
                        <input 
                            type="checkbox" 
                            name="mhsteEnableWoocommerceOptions" 
                            id="mhsteEnableWoocommerceOptions" 
                            value="1" 
                            <?php 
                            checked( get_option('mhste_show_woo_options_page'), '1' );
                            if( ! is_woocommerce_activated() ) {
                                echo ' disabled';
                            }
                            ?>> <label for="mhsteEnableWoocommerceOptions">WooCommerce</label>
                        <?php if( ! is_woocommerce_activated() ) : ?>
                            <br><span class="mhsadmin-settings__info"><?php esc_html_e('The WooCommerce is disabled or not installed. Please install and activate WooCommerce first', 'mhste') ?></span>
                        <?php endif; ?>
                    </p>
                    <p>
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e('Save changes', 'mhste') ?>">
                    </p>
                </div>
            </form>
        </div>
    <?php
    }
}