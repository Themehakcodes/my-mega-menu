<?php
/**
 * Plugin Name: My Mega Menu
 * Plugin URI:  https://example.com/my-mega-menu
 * Description: A custom mega menu plugin for WordPress.
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: my-mega-menu
 * Domain Path: /languages
 */

// Hook to add admin menu
add_action('admin_menu', 'mega_menu_add_admin_menu');

// Hook to register settings
add_action('admin_init', 'mega_menu_register_settings');

// Create custom table on plugin activation
register_activation_hook(__FILE__, 'mega_menu_create_table');
function mega_menu_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'mega_menu_settings';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) NOT NULL AUTO_INCREMENT,
        menu_id BIGINT(20) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Add admin menu
function mega_menu_add_admin_menu() {
    add_menu_page(
        'Mega Menu Settings',
        'Mega Menu',
        'manage_options',
        'mega_menu_settings',
        'mega_menu_settings_page',
        'dashicons-menu'
    );
}

// Settings page
function mega_menu_settings_page() {
    // Handle save
    if (isset($_POST['mega_menu_options'])) {
        $menu_id = intval($_POST['mega_menu_options']['menu_location']);
        mega_menu_save_selected_menu($menu_id);
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $menu_id = mega_menu_get_selected_menu();
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Mega Menu Settings', 'my-mega-menu'); ?></h1>
        <form method="post" action="">
            <h2><?php esc_html_e('Menu Configuration', 'my-mega-menu'); ?></h2>
            <label for="menu_location"><?php esc_html_e('Select Menu Location', 'my-mega-menu'); ?></label>
            <br><br>
            <?php
            $menus = wp_get_nav_menus();

            if (!empty($menus) && function_exists('wp_dropdown_nav_menus')) {
                wp_dropdown_nav_menus(array(
                    'name'     => 'mega_menu_options[menu_location]',
                    'selected' => $menu_id,
                    'echo'     => true
                ));
            } else {
                echo '<p>' . esc_html__('No menus found. Please create one in Appearance > Menus.', 'my-mega-menu') . '</p>';
            }
            ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'my-mega-menu'); ?>">
            </p>
        </form>
    </div>
    <?php
}

// Register setting (not used with custom DB but kept for compatibility)
function mega_menu_register_settings() {
    register_setting('mega_menu_options_group', 'mega_menu_options');
}

// Save menu selection
function mega_menu_save_selected_menu($menu_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mega_menu_settings';

    // Check if any row exists
    $existing_menu = $wpdb->get_var("SELECT id FROM $table_name LIMIT 1");

    if ($existing_menu) {
        $wpdb->update(
            $table_name,
            array('menu_id' => $menu_id),
            array('id' => $existing_menu)
        );
    } else {
        $wpdb->insert(
            $table_name,
            array('menu_id' => $menu_id)
        );
    }
}

// Retrieve saved menu
function mega_menu_get_selected_menu() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'mega_menu_settings';

    return $wpdb->get_var("SELECT menu_id FROM $table_name LIMIT 1");
}
