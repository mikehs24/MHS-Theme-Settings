<?php

/*
 * Plugin Name:     MHS Website Extensions
 * Version:         1.0.0
 * Requires PHP:    7.4
 * Author:          MIKE HOME STUDIO Michał Okoń
 * Author URI:      https://mikehomestudio.pl
 * Text Domain:     mhsextension
 * Domain Path:     /languages
 * License:         GPL v2 or later
 */

if( ! defined( 'ABSPATH' ) ) exit;

class MhsMain {
    function __construct() {
        add_action( 'init', array( $this, 'languages' ) ); 
    }

    function languages() {
        load_plugin_textdomain( 'mhsextension', false, dirname(plugin_basename(__FILE__)) . '/languages' );
    }
}

$mhsMain = new MhsMain();

require_once('inc/mhs-settings-page.php');
require_once('inc/mhs-info-page.php');
require_once('inc/mhs-icons.php');
require_once('inc/mhs-shortcodes.php');
require_once('inc/mhs-helpers.php');
require_once('inc/mhs-asssets.php');