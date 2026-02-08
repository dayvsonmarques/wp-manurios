<?php
/**
 * Admin Permissions & Cleanup
 * 
 * Handles custom capabilities for Editors and hides unused admin sections.
 */

/**
 * 1. Grant "Editor" role access to Menus and Customizer
 */
function _wp_manurios_add_editor_caps() {
    $role = get_role( 'editor' );
    if ( $role && ! $role->has_cap( 'edit_theme_options' ) ) {
        $role->add_cap( 'edit_theme_options' );
    }
}
add_action( 'admin_init', '_wp_manurios_add_editor_caps' );

/**
 * 2. Cleanup Admin Menu
 */
function _wp_manurios_cleanup_admin_menu() {
    // Remove Comments
    remove_menu_page( 'edit-comments.php' );

    // If current user is not administrator, maybe hide "Themes" selection to focus only on Customize/Menu
    if ( ! current_user_can( 'administrator' ) ) {
        // Keeps 'customize.php' and 'nav-menus.php' accessible, but hides the main "Themes" grid
        remove_submenu_page( 'themes.php', 'themes.php' ); 
        
        // Hide File Editor (security best practice)
        remove_submenu_page( 'themes.php', 'theme-editor.php' );
    }
}
add_action( 'admin_menu', '_wp_manurios_cleanup_admin_menu' );

/**
 * 3. Remove Comments from Admin Bar
 */
function _wp_manurios_cleanup_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'comments' );
}
add_action( 'wp_before_admin_bar_render', '_wp_manurios_cleanup_admin_bar' );

/**
 * 4. Disable Comments Support on Post Types
 */
function _wp_manurios_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', '_wp_manurios_disable_comments_post_types_support');

/**
 * 5. Close comments on front-end
 */
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

/**
 * 6. Hide existing comments
 */
add_filter('comments_array', '__return_empty_array', 10, 2);
