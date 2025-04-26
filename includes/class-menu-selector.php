<?php
class MCMW_Menu_Selector {
    public function render_page() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_menu'])) {
            update_option('mcmw_selected_menu', sanitize_text_field($_POST['selected_menu']));
            echo '<div class="notice notice-success is-dismissible"><p><strong>Menu saved successfully!</strong></p></div>';
        }

        $menus = wp_get_nav_menus();
        $saved_menu = get_option('mcmw_selected_menu');

        echo '<div class="wrap">';
        echo '<h1 class="wp-heading-inline">Select a Menu</h1>';
        echo '<p>Choose a menu to use for the widget display. More settings coming soon!</p>';
        
        echo '<form method="POST" style="margin-top: 20px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); max-width: 600px;">';
        
        echo '<table class="form-table">';
        echo '<tbody>';
        
        echo '<tr>';
        echo '<th scope="row"><label for="selected_menu">Menu</label></th>';
        echo '<td>';
        echo '<select name="selected_menu" id="selected_menu" class="regular-text">';
        foreach ($menus as $menu) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            echo '<option value="' . esc_attr($menu->term_id) . '" ' . selected($saved_menu, $menu->term_id, false) . '>';
            echo esc_html($menu->name) . ' (ID: ' . $menu->term_id . ', Slug: ' . $menu->slug . ', Items: ' . count($menu_items) . ')';
            echo '</option>';
        }
        echo '</select>';
        echo '</td>';
        echo '</tr>';
        
        echo '</tbody>';
        echo '</table>';
        
        echo '<p class="submit">';
        echo '<button type="submit" class="button button-primary">Save Selected Menu</button>';
        echo '</p>';

        // Footer
        echo '<hr style="margin: 30px 0;">';
        echo '<div style="text-align: center; font-size: 14px; color: #666;">';
        echo 'Developed by <strong>Kunal</strong> | ';
        echo '<a href="https://github.com/kunalsharma6419" target="_blank" style="color: #0073aa; text-decoration: none;">GitHub Profile</a>';
        echo '</div>';

        echo '</form>';
        echo '</div>';
    }
}
?>
