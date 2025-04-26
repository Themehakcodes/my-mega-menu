<?php
class MCMW_Hamburger_Menu_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'mcmw_hamburger_menu_widget',
            'Hamburger Menu',
            ['description' => 'Displays selected menu as a hamburger dropdown.']
        );
    }

    public function widget($args, $instance) {
        $menu_id = get_option('mcmw_selected_menu');
        if (!$menu_id) {
            echo '<p class="text-red-500">No menu selected.</p>';
            return;
        }
    
        echo '<div class="relative inline-block text-left z-50">';
        echo '<button id="mcmwToggleBtn" class="inline-flex items-center justify-center p-2 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-100 focus:outline-none transition">&#9776;</button>';
        echo '<div id="mcmwDropdown" class="hidden absolute mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">';
        echo '<div class="py-1">';
        wp_nav_menu([
            'menu' => $menu_id,
            'container' => false,
            'menu_class' => 'mcmw-menu space-y-1',
            'walker' => new Walker_Nav_Menu() // default walker supports nesting
        ]);
        echo '</div></div></div>';
    }
    

    public function form($instance) {
        echo '<p>This widget displays the menu selected in the plugin settings.</p>';
    }

    public function update($new_instance, $old_instance) {
        return $old_instance;
    }
}
