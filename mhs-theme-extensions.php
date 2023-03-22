<?php

/*
 * Plugin Name:     MHS Theme Extension
 * Version:         1.0.3
 * Requires PHP:    7.4
 * Author:          MIKE HOME STUDIO Michał Okoń
 * Author URI:      https://mikehomestudio.pl
 * Text Domain:     _pluginname
 * Domain Path:     /languages
 * License:         GPL v2 or later
 */

namespace MhsThemeExtension;

if( ! defined( 'ABSPATH' ) ) exit;

$pluginDir = dirname(plugin_basename(__FILE__));
$pluginMainPath = plugin_dir_url(__FILE__);
$pluginCssDir = plugin_dir_url(__FILE__) . 'assets/css/';

define('MHSTE_PLUGIN_DIR', $pluginDir);
define('MHSTE_PLUGIN_FULL_PATH_DIR', $pluginMainPath);
define('MHSTE_PLUGIN_CSS_DIR', $pluginCssDir);

class MhsMain 
{
    public function __construct() 
    {
        add_action( 'init', array( $this, 'languages' ) ); 
    }

    public function languages() 
    {
        load_plugin_textdomain( '_pluginname', false, MHSTE_PLUGIN_DIR . '/languages' );
    }
}

$mhsMain = new MhsMain();

require_once('inc/mhs-settings-page.php');
require_once('inc/mhs-info-page.php');
require_once('inc/mhs-icons.php');
require_once('inc/mhs-shortcodes.php');
require_once('inc/mhs-helpers.php');
require_once('inc/mhs-assets.php');