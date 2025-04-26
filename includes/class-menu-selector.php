<?php
class MCMW_Menu_Selector {
    public function render_page() {
        if ($_POST && isset($_POST['selected_menu'])) {
            update_option('mcmw_selected_menu', sanitize_text_field($_POST['selected_menu']));
            echo "<div class='updated'><p>Menu saved!</p></div>";
        }

        $menus = wp_get_nav_menus();
        $saved_menu = get_option('mcmw_selected_menu');

        echo '<form method="POST"><select name="selected_menu">';
        foreach ($menus as $menu) {
            echo '<option value="' . esc_attr($menu->term_id) . '" ' . selected($saved_menu, $menu->term_id, false) . '>' . esc_html($menu->name) . '</option>';
        }
        echo '</select><button type="submit">Save Menu</button></form>';
    }
}
