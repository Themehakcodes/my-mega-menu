<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class MCMW_Elementor_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'custom_menu_hamburger';
    }

    public function get_title() {
        return 'Hamburger Menu';
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'mcmw-widget-style' ];
    }

    public function get_script_depends() {
        return [ 'mcmw-widget-script' ];
    }

    protected function render() {
        $menu_id = get_option('mcmw_selected_menu');
        if ( !$menu_id ) {
            echo '<p>No menu selected.</p>';
            return;
        }

        echo '<div class="mcmw-hamburger-menu">
                <div class="mcmw-toggle" onclick="document.querySelector(\'.mcmw-dropdown\').classList.toggle(\'open\')">
                    &#9776;
                </div>
                <div class="mcmw-dropdown">';
        wp_nav_menu([
            'menu' => $menu_id,
            'container' => false,
            'menu_class' => 'mcmw-menu',
        ]);
        echo '  </div>
              </div>';
    }
}
