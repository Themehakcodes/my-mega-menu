<?php
class MCMW_Tailwind_Walker_Nav_Menu extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="ml-4 pl-4 border-l border-gray-300">';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = implode(' ', $item->classes);
        $output .= sprintf(
            '<li class="text-sm py-1"><a href="%s" class="hover:text-indigo-600 transition">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
