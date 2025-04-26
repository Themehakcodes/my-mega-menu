<?php
/**
 * Plugin Name: My Mega Menu Widget
 */

if (!defined('ABSPATH')) exit;


// Include WordPress Widget
require_once MCMW_PATH . 'includes/class-menu-selector.php';
require_once MCMW_PATH . 'includes/class-mcmw-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-mcmw-walker-nav-menu.php';

// Admin Menu Page
add_action('admin_menu', function () {
    add_menu_page(
        'Menu Selector',
        'Menu Selector',
        'manage_options',
        'menu-selector',
        'mcmw_menu_selector_page',
        'dashicons-menu',
        100
    );
});

function mcmw_menu_selector_page() {
    (new MCMW_Menu_Selector())->render_page();
}

// Admin styles/scripts
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('mcmw-admin-style', MCMW_URL . 'assets/css/admin.css');
    wp_enqueue_script('mcmw-admin-js', MCMW_URL . 'assets/js/admin.js', [], null, true);
});

// Frontend styles/scripts
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('mcmw-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    wp_enqueue_style('mcmw-frontend-style', MCMW_URL . 'assets/css/hamburger.css');
    wp_enqueue_script('mcmw-hamburger', MCMW_URL . 'assets/js/mcmw-hamburger.js', [], null, true);
});

// Elementor Integration
add_action('elementor/widgets/register', function($widgets_manager) {
    require_once MCMW_PATH . 'includes/class-mcmw-elementor-widget.php';
    $widgets_manager->register(new \MCMW_Elementor_Hamburger_Menu_Widget());
});


// Register WordPress classic Widget
add_action('widgets_init', function () {
    register_widget('MCMW_Hamburger_Menu_Widget');
});


