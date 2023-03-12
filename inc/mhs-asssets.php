<?php

function mhsEnqueueAssetsFrontend() {
    wp_enqueue_style( 'mhsExtensions', plugin_dir_url(__FILE__) . '../assets/css/mhs-extension.css' );
}
add_action( 'admin_enqueue_scripts', 'mhsEnqueueAssetsFrontend' );