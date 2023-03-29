<?php
/*
 * Plugin Name:     MHS Theme Extension
 * Version:         1.1.0
 * Requires PHP:    7.4
 * Author:          MIKE HOME STUDIO Michał Okoń
 * Author URI:      https://mikehomestudio.pl
 * Text Domain:     mhste
 * Domain Path:     /languages
 * License:         GPL v2 or later
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// require_once 'inc/dump.php';
require_once 'inc/Internalization.php';
require_once 'inc/Admin/Page.php';
require_once 'inc/Frontend/Woo.php';
require_once 'inc/Frontend/ContactInfo.php';
require_once 'inc/Frontend/FrontendAssets.php';
        
require_once 'inc/helpers.php';
require_once('inc/icons.php');

$pluginDir = dirname(plugin_basename(__FILE__));
$pluginMainPath = plugin_dir_url(__FILE__);
$pluginCssDir = plugin_dir_url(__FILE__) . 'assets/css/';

define('MHSTE_PLUGIN_DIR', $pluginDir);
define('MHSTE_PLUGIN_FULL_PATH_DIR', $pluginMainPath);
define('MHSTE_PLUGIN_CSS_DIR', $pluginCssDir);

use Mhs\Admin\Page;
use Mhs\Frontend\FrontendAssets;
use Mhs\Internalization;

new Page();
new FrontendAssets();
new Internalization();