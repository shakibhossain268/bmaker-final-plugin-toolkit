<?php
/*
Plugin Name: Bmaker Toolkit
Plugin URI: http://www.nesteditsolutions.com
Author: Nested It Solutions
Author URI: http://epilogtheme.com/
Version: 1.0
Description: This plugin required for Bmaker WP Theme.
textdomain: bmaker-toolkit
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Defines
define( 'BMAKER_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'BMAKER_ACC_PATH', plugin_dir_path( __FILE__ ) );



// Loading Elementor blocks
if ( in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( BMAKER_ACC_PATH . '/elementor/elementor-addon-elements.php' );
}

// Theme widgets
require_once( BMAKER_ACC_PATH . '/includes/widgets/widgets.php');

// Demo Importer
require BMAKER_ACC_PATH . '/includes/demo-importer.php';