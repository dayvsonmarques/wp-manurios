<?php
/**
 * Custom Nav Walker for Jadoo Theme Integration
 * 
 * This walker creates navigation menus compatible with Jadoo's HTML structure
 */

if (!defined('ABSPATH')) {
    exit;
}

class Jadoo_Nav_Walker extends Walker_Nav_Menu {
    
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu dropdown-menu-end border-0 shadow-lg\" style=\"border-radius:0.3rem;\">\n";
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        
        if ($depth === 0) {
            // Top level items
            if ($has_children) {
                $class_names = 'nav-item dropdown px-3 px-lg-0';
            } else {
                $class_names = 'nav-item px-3 px-xl-4';
            }
        } else {
            // Dropdown items
            $class_names = '';
        }

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // Build link classes based on depth and whether it has children
        if ($depth === 0) {
            if ($has_children) {
                $link_class = 'd-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium';
                $attributes .= ' id="navbarDropdown-' . $item->ID . '" role="button" data-bs-toggle="dropdown" aria-expanded="false"';
            } else {
                $link_class = 'nav-link fw-medium';
                $attributes .= ' aria-current="page"';
            }
        } else {
            $link_class = 'dropdown-item';
        }

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a class="' . $link_class . '"' . $attributes .'>';
        $item_output .= (isset( $args->link_before ) ? $args->link_before : '') . apply_filters( 'the_title', $item->title, $item->ID ) . (isset( $args->link_after ) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}