<?php
class Custom_Mega_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth === 0) $output .= '<div class="mega-menu"><div class="mega-column-wrapper">';
        else $output .= '<ul class="sub-menu">';
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth === 0) $output .= '</div></div>';
        else $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = implode(' ', $item->classes);
        $output .= "<li class='menu-item $classes'><a href='{$item->url}'>{$item->title}</a>";
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= '</li>';
    }
};