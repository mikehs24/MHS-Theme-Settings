<?php

declare(strict_types=1);

namespace Mhs\Admin;

class AdminAssets
{
    public function __construct()
    {
        add_action( 'admin_enqueue_scripts', array($this, 'adminAssets') );
    }

    public function adminAssets()
    {
        wp_enqueue_style( 'mhs-theme-extension-admin', MHSTE_PLUGIN_CSS_DIR . 'mhste-admin.css' );
    }
}