<?php

function _themenameFrontendCss() {
    wp_enqueue_style( 'mhsFrontendExtensions', MHSTE_PLUGIN_CSS_DIR . 'mhset-style.css' );
}
add_action( 'wp_enqueue_scripts', '_themenameFrontendCss' );

function mhsEnqueueAssetsFrontend() {
    wp_enqueue_style( 'mhsExtensions', MHSTE_PLUGIN_CSS_DIR . 'mhs-extension.css' );
}
add_action( 'admin_enqueue_scripts', 'mhsEnqueueAssetsFrontend' );