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


add_action('elementor/frontend/after_enqueue_styles', function() {
    wp_register_style('mcmw-widget-style', MCMW_URL . 'assets/css/widget.css');
});

add_action('elementor/frontend/after_enqueue_scripts', function() {
    wp_register_script('mcmw-widget-script', MCMW_URL . 'assets/js/widget.js', [], null, true);
});


add_action('init', function() {
    // Register Elementor widget
    if ( did_action( 'elementor/loaded' ) ) {
        require_once MCMW_PATH . 'includes/class-elementor-widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register( new \MCMW_Elementor_Menu_Widget() );
    }
});
