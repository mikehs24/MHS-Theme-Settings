<?php

function mhsEnqueueAssetsFrontend() {
    wp_enqueue_style( 'mhsExtensions', MHSTE_PLUGIN_CSS_DIR . 'mhs-extension.css' );
}
add_action( 'admin_enqueue_scripts', 'mhsEnqueueAssetsFrontend' );