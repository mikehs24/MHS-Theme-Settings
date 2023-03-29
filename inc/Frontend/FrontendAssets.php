<?php

declare(strict_types=1);

namespace Mhs\Frontend;

class FrontendAssets
{
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'frontendAssets') );
    }

    public function frontendAssets()
    {
        wp_enqueue_style( 'mhs-theme-extension-frontend', MHSTE_PLUGIN_CSS_DIR . 'mhste-style.css' );
    }
}