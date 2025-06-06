<?php
/**
 * Plugin Name: Nestead Menu Widget
 * Description: Adds an admin panel to select menus and a custom Elementor widget to display them.
 * Version: 1.0
 * Author: Kunal Vashisht's 
 * Author URI: https://github.com/kunalsharma6419
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MCMW_PATH', plugin_dir_path( __FILE__ ) );
define( 'MCMW_URL', plugin_dir_url( __FILE__ ) );

// Load main plugin file
require_once MCMW_PATH . 'plugin.php';
