<?php

if (!defined('ABSPATH')) exit;

class MCMW_Walker_Nav_Menu extends Walker_Nav_Menu {

    // Start Level (for submenu <ul>)
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"hidden absolute left-full top-0 ml-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg group-hover:block\">\n";
    }

    // Start Element (for each <li>)
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'relative group'; // Make <li> relative and group for hover

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="flex justify-between items-center w-full px-5 py-3 text-gray-700 hover:bg-gray-100 rounded-md transition-colors duration-200">';
        $item_output .= $args->link_before . $title . $args->link_after;

        // Add arrow if has children
        if (in_array('menu-item-has-children', (array) $item->classes)) {
            $item_output .= '<svg class="w-4 h-4 ml-3 transform group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                             </svg>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>
