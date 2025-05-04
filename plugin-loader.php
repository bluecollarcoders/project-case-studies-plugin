<?php
/**
 * Plugin Name: Project Case Studies
 * Plugin URI:  https://yourwebsite.com
 * Description: A custom post type plugin for case studies.
 * Version:     1.0
 * Author:      Caleb Matteis
 * Author URI:  https://calebmatteis.online
 * License:     GPL-2.0+
 */

use Projectportfolio\ProjectPortfolio\Loader;

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Composer Autoloader.
$autoload = __DIR__ . '/vendor/autoload.php';

if ( ! file_exists( $autoload ) ) {
	return;
}

// Autoload.php.
require_once $autoload;

Loader::get_instance();
