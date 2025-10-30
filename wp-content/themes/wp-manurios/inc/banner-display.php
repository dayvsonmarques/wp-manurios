<?php
/**
 * Banner Display Functions
 * Functions to display banners on the frontend
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get active banners based on position and criteria
 */
function wp_manurios_get_active_banners($position = '', $limit = -1) {
    $args = array(
        'post_type' => 'banner',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_banner_status',
                'value' => 'active',
                'compare' => '='
            )
        ),
        'orderby' => 'meta_value_num',
        'meta_key' => '_banner_priority',
        'order' => 'DESC'
    );

    if (!empty($position)) {
        $args['meta_query'][] = array(
            'key' => '_banner_position',
            'value' => $position,
            'compare' => '='
        );
    }

    // Add date filtering
    $current_date = current_time('Y-m-d H:i:s');
    $args['meta_query'][] = array(
        'relation' => 'OR',
        array(
            'key' => '_banner_start_date',
            'value' => $current_date,
            'compare' => '<=',
            'type' => 'DATETIME'
        ),
        array(
            'key' => '_banner_start_date',
            'compare' => 'NOT EXISTS'
        )
    );

    $args['meta_query'][] = array(
        'relation' => 'OR',
        array(
            'key' => '_banner_end_date',
            'value' => $current_date,
            'compare' => '>=',
            'type' => 'DATETIME'
        ),
        array(
            'key' => '_banner_end_date',
            'compare' => 'NOT EXISTS'
        )
    );

    return get_posts($args);
}

/**
 * Display banner HTML
 */
function wp_manurios_display_banner($banner_id, $echo = true) {
    $banner = get_post($banner_id);
    if (!$banner || $banner->post_type !== 'banner') {
        return '';
    }

    $banner_media_type = get_post_meta($banner_id, '_banner_media_type', true);
    $banner_media_id = get_post_meta($banner_id, '_banner_media_id', true);
    $banner_url = get_post_meta($banner_id, '_banner_url', true);
    $banner_target = get_post_meta($banner_id, '_banner_target', true) ?: '_self';
    $banner_css_class = get_post_meta($banner_id, '_banner_css_class', true);
    $banner_size = get_post_meta($banner_id, '_banner_size', true) ?: 'medium';
    $banner_position = get_post_meta($banner_id, '_banner_position', true) ?: 'content';

    // Determinar qual mídia usar
    $media_id = null;
    $media_url = '';
    $media_alt = $banner->post_title;
    
    if ($banner_media_type === 'image' && $banner_media_id) {
        $media_id = $banner_media_id;
        $media_url = wp_get_attachment_image_url($media_id, 'full');
        $media_alt = get_post_meta($media_id, '_wp_attachment_image_alt', true) ?: $banner->post_title;
    } elseif ($banner_media_type === 'video' && $banner_media_id) {
        $media_id = $banner_media_id;
        $media_url = wp_get_attachment_url($media_id);
    } elseif ($banner_media_type === 'audio' && $banner_media_id) {
        $media_id = $banner_media_id;
        $media_url = wp_get_attachment_url($media_id);
    } elseif ($banner_media_type === 'url' && $banner_url) {
        $media_url = $banner_url;
    } else {
        // Fallback para imagem destacada
        $image_id = get_post_thumbnail_id($banner_id);
        if ($image_id) {
            $media_id = $image_id;
            $media_url = wp_get_attachment_image_url($image_id, 'full');
            $media_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $banner->post_title;
        }
    }

    if (!$media_url) {
        return '';
    }

    // Size classes
    $size_classes = array(
        'small' => 'col-md-3',
        'medium' => 'col-md-6',
        'large' => 'col-md-9',
        'full' => 'col-12'
    );

    $size_class = isset($size_classes[$banner_size]) ? $size_classes[$banner_size] : $size_classes['medium'];

    // CSS classes
    $css_classes = array(
        'banner-item',
        'banner-' . $banner_position,
        'banner-' . $banner_size,
        $size_class
    );

    if ($banner_css_class) {
        $css_classes[] = $banner_css_class;
    }

    $css_class_string = implode(' ', $css_classes);

    $html = '<div class="' . esc_attr($css_class_string) . '">';
    
    // Determinar se deve ter link
    $link_url = '';
    if ($banner_media_type === 'url') {
        $link_url = $banner_url;
    } elseif ($banner_media_type === 'image' && $banner_url) {
        $link_url = $banner_url;
    } elseif ($banner_media_type === 'none' && $banner_url) {
        $link_url = $banner_url;
    }
    
    if ($link_url) {
        $html .= '<a href="' . esc_url($link_url) . '" target="' . esc_attr($banner_target) . '" class="banner-link">';
    }
    
    // Gerar HTML baseado no tipo de mídia
    if ($banner_media_type === 'video' && $media_url) {
        $html .= '<video class="banner-media" controls preload="metadata">';
        $html .= '<source src="' . esc_url($media_url) . '" type="' . esc_attr(get_post_mime_type($media_id)) . '">';
        $html .= __('Seu navegador não suporta vídeos.', 'wp-manurios');
        $html .= '</video>';
    } elseif ($banner_media_type === 'audio' && $media_url) {
        $html .= '<audio class="banner-media" controls preload="metadata">';
        $html .= '<source src="' . esc_url($media_url) . '" type="' . esc_attr(get_post_mime_type($media_id)) . '">';
        $html .= __('Seu navegador não suporta áudio.', 'wp-manurios');
        $html .= '</audio>';
    } elseif ($banner_media_type === 'image' && $media_url) {
        $html .= '<img src="' . esc_url($media_url) . '" alt="' . esc_attr($media_alt) . '" class="img-fluid banner-image" />';
    } elseif ($banner_media_type === 'url' && $media_url) {
        // Para URLs externas, tentar detectar se é uma imagem
        $url_info = pathinfo($media_url);
        $image_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg');
        if (in_array(strtolower($url_info['extension']), $image_extensions)) {
            $html .= '<img src="' . esc_url($media_url) . '" alt="' . esc_attr($media_alt) . '" class="img-fluid banner-image" />';
        } else {
            $html .= '<div class="banner-url-content">';
            $html .= '<span class="dashicons dashicons-admin-links"></span>';
            $html .= '<span>' . esc_html($banner->post_title) . '</span>';
            $html .= '</div>';
        }
    } else {
        // Fallback para imagem destacada
        $html .= '<img src="' . esc_url($media_url) . '" alt="' . esc_attr($media_alt) . '" class="img-fluid banner-image" />';
    }
    
    if ($link_url) {
        $html .= '</a>';
    }
    
    $html .= '</div>';

    if ($echo) {
        echo $html;
    } else {
        return $html;
    }
}

/**
 * Display banners by position
 */
function wp_manurios_display_banners_by_position($position, $limit = -1, $echo = true) {
    $banners = wp_manurios_get_active_banners($position, $limit);
    
    if (empty($banners)) {
        return '';
    }

    $html = '<div class="banners-container banners-' . esc_attr($position) . '">';
    $html .= '<div class="row">';
    
    foreach ($banners as $banner) {
        $html .= wp_manurios_display_banner($banner->ID, false);
    }
    
    $html .= '</div>';
    $html .= '</div>';

    if ($echo) {
        echo $html;
    } else {
        return $html;
    }
}

/**
 * Shortcode to display banners
 */
function wp_manurios_banner_shortcode($atts) {
    $atts = shortcode_atts(array(
        'position' => 'content',
        'limit' => -1,
        'size' => 'medium'
    ), $atts);

    return wp_manurios_display_banners_by_position($atts['position'], $atts['limit'], false);
}
add_shortcode('banners', 'wp_manurios_banner_shortcode');

/**
 * Add banner CSS
 */
function wp_manurios_banner_styles() {
    ?>
    <style>
    .banners-container {
        margin: 20px 0;
    }
    
    .banner-item {
        margin-bottom: 15px;
    }
    
    .banner-link {
        display: block;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    
    .banner-link:hover {
        opacity: 0.8;
    }
    
    .banner-image,
    .banner-media {
        width: 100%;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .banner-media {
        max-height: 400px;
        object-fit: cover;
    }
    
    .banner-url-content {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        text-decoration: none;
        color: #495057;
        transition: all 0.3s ease;
    }
    
    .banner-url-content:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        color: #212529;
    }
    
    .banner-url-content .dashicons {
        font-size: 24px;
        margin-right: 10px;
    }
    
    .banners-header {
        margin-bottom: 20px;
    }
    
    .banners-sidebar .banner-item {
        margin-bottom: 20px;
    }
    
    .banners-footer {
        background-color: #f8f9fa;
        padding: 20px 0;
    }
    
    .banners-content {
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .banner-item {
            margin-bottom: 10px;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'wp_manurios_banner_styles');

/**
 * Add banners to theme locations
 */
function wp_manurios_add_banners_to_theme() {
    // Add banners to header
    add_action('wp_manurios_before_header', 'wp_manurios_header_banners');
    
    // Add banners to content
    add_action('wp_manurios_before_content', 'wp_manurios_content_banners');
    
    // Add banners to sidebar
    add_action('wp_manurios_sidebar_bottom', 'wp_manurios_sidebar_banners');
    
    // Add banners to footer
    add_action('wp_manurios_footer_top', 'wp_manurios_footer_banners');
}
add_action('init', 'wp_manurios_add_banners_to_theme');

/**
 * Header banners
 */
function wp_manurios_header_banners() {
    wp_manurios_display_banners_by_position('header', 3);
}

/**
 * Content banners
 */
function wp_manurios_content_banners() {
    wp_manurios_display_banners_by_position('content', 2);
}

/**
 * Sidebar banners
 */
function wp_manurios_sidebar_banners() {
    wp_manurios_display_banners_by_position('sidebar', 1);
}

/**
 * Footer banners
 */
function wp_manurios_footer_banners() {
    wp_manurios_display_banners_by_position('footer', 4);
}
