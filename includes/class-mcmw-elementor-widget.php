<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class MCMW_Elementor_Hamburger_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'mcmw_hamburger_menu';
    }

    public function get_title() {
        return __('Hamburger Menu', 'mcmw');
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'mcmw'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'info',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('This widget displays the selected menu from Plugin Settings.', 'mcmw'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $menu_id = get_option('mcmw_selected_menu');
    
        if (!$menu_id) {
            echo '<p class="text-red-500">No menu selected.</p>';
            return;
        }
        ?>
    
        <div class="relative inline-block text-left z-50">
            <!-- Hamburger icon for the menu -->
            <div class="hamburger" onclick="mcmwToggleMenu(this)">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
    
            <!-- Dropdown menu -->
            <div id="mcmwDropdown" class="hidden absolute  mt-2 w-64  rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-2">
                    <?php
                    wp_nav_menu([
                        'menu' => $menu_id,
                        'container' => false,
                        'menu_class' => 'mcmw-menu space-y-2',
                        'walker' => new MCMW_Walker_Nav_Menu(), // custom walker
                    ]);
                    ?>
                </div>
            </div>
        </div>
    
        <style>

           /* Make the main dropdown menu take full height */
#mcmwDropdown {
    height: 100vh; 
    
}

/* Hamburger styles */
.hamburger {
    cursor: pointer;
    width: 30px;
    height: 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Bar styles for hamburger */
.hamburger .bar {
    background-color: #333;
    height: 4px;
    width: 100%;
    transition: 0.4s;
}

/* Menu styles */
.mcmw-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    height: 100%;  /* Ensure the menu itself fills the full height */
    display: flex;
    flex-direction: column; /* Stack items vertically */
}

/* Ensure menu items take full height and scroll if needed */
.mcmw-menu li {
    position: relative;
    flex-grow: 1;  /* Allow items to stretch vertically */
}

/* Link styling */
.mcmw-menu li a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 16px;
    text-decoration: none;
    color: #333;
    font-size: 15px;
    transition: background 0.3s;
    height: 100%;  /* Make sure the link takes full available height */
}

/* Hover effect for links */
.mcmw-menu li a:hover {
    background-color: #f9f9f9;
}

.mcmw-menu li {
    position: relative; /* Needed to position submenus correctly */
}

/* Sub-menu styles */
.mcmw-menu ul {
    position: absolute; /* Position the submenu correctly */
    top: 0;
    left: 100%; /* Ensure it opens to the right of the parent menu */
    display: none; /* Initially hidden */
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 8px 0;
    margin: 0;
    list-style: none;
    min-width: 180px;
    z-index: 10;
    height: 100vh; /* Full height for submenus */
}

/* Show submenus on hover */
.mcmw-menu li:hover > ul {
    display: block;
}

/* Submenu item styling */
.mcmw-menu ul li a {
    white-space: nowrap;
    padding: 8px 20px;
    font-size: 14px;
}

/* Optional: Rotate arrow on hover */
.mcmw-menu li:hover > a::after {
    transform: rotate(90deg);
}



</style>

    
        <script>
            // Toggle the menu on click
            function mcmwToggleMenu(el) {
                el.classList.toggle('open');
                document.getElementById('mcmwDropdown').classList.toggle('hidden');
            }
        </script>
    
        <?php
    }
    
}
