<?php

function mhsEnqueueAssetsFrontend() {
    wp_enqueue_style( 'mhsExtensions', plugin_dir_url(__FILE__) . '../assets/css/shortcodes.css' );
}
add_action( 'wp_enqueue_scripts', 'mhsEnqueueAssetsFrontend' );