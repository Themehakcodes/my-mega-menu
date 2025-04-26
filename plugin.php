<?php
add_action('admin_menu', function() {
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
    require_once MCMW_PATH . 'includes/class-menu-selector.php';
    (new MCMW_Menu_Selector())->render_page();
}

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('mcmw-admin-style', MCMW_URL . 'assets/css/admin.css');
    wp_enqueue_script('mcmw-admin-js', MCMW_URL . 'assets/js/admin.js', [], null, true);
});


add_action('wp_enqueue_scripts', function () {
    // Use CDN or your compiled Tailwind build
    wp_enqueue_style('mcmw-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
});


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('mcmw-hamburger', MCMW_URL . 'assets/js/mcmw-hamburger.js', [], null, true);
});




add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('mcmw-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    wp_enqueue_script('mcmw-hamburger', MCMW_URL . 'assets/js/mcmw-hamburger.js', [], null, true);
});


require_once MCMW_PATH . 'includes/class-mcmw-widget.php';

add_action('widgets_init', function () {
    register_widget('MCMW_Hamburger_Menu_Widget');
});


