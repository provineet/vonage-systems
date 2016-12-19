<?php
/*
 * Plugin Name: Vonage Systems
 * Version: 1.0
 * Plugin URI: http://www.wordpressbeast.com/
 * Description: Plugin to integrate Vonage API
 * Author: Vineet Verma
 * Author URI: http://www.vineetverma.me/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: vonage-systems
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Vineet Verma
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'VONAGE_SYSTEMS_PATH', plugin_dir_path( __FILE__ ) );

// Load plugin class files
require_once( 'includes/class-vonage-systems.php' );
require_once( 'includes/class-vonage-systems-settings.php' );

// Load plugin libraries
require_once( 'includes/class-vonage-systems-admin-api.php' );
require_once( 'includes/class-vonage-systems-public-api.php' );

/**
 * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
function vonage_systems () {
	$instance = Vonage_Systems::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = Vonage_Systems_Settings::instance( $instance );
	}

	return $instance;
}

vonage_systems();