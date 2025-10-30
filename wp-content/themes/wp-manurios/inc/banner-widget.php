<?php
/**
 * Banner Widget
 * Widget to display banners in sidebar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Banner Widget Class
 */
class WP_Manurios_Banner_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'wp_manurios_banner_widget',
            __('Banner Widget', 'wp-manurios'),
            array(
                'description' => __('Exibe banners na sidebar', 'wp-manurios'),
            )
        );
    }
    
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $position = !empty($instance['position']) ? $instance['position'] : 'sidebar';
        $media_type = !empty($instance['media_type']) ? $instance['media_type'] : '';
        $limit = !empty($instance['limit']) ? absint($instance['limit']) : 1;
        $size = !empty($instance['size']) ? $instance['size'] : 'small';
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        // Display banners
        $banners = wp_manurios_get_active_banners($position, $limit);
        
        if (!empty($banners)) {
            echo '<div class="banner-widget-container">';
            foreach ($banners as $banner) {
                // Filtrar por tipo de mídia se especificado
                if ($media_type) {
                    $banner_media_type = get_post_meta($banner->ID, '_banner_media_type', true);
                    if ($banner_media_type !== $media_type) {
                        continue;
                    }
                }
                wp_manurios_display_banner($banner->ID);
            }
            echo '</div>';
        } else {
            echo '<p class="no-banners">' . __('Nenhum banner ativo encontrado.', 'wp-manurios') . '</p>';
        }
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $position = !empty($instance['position']) ? $instance['position'] : 'sidebar';
        $media_type = !empty($instance['media_type']) ? $instance['media_type'] : '';
        $limit = !empty($instance['limit']) ? absint($instance['limit']) : 1;
        $size = !empty($instance['size']) ? $instance['size'] : 'small';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Título:', 'wp-manurios'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Posição:', 'wp-manurios'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
                <option value="sidebar" <?php selected($position, 'sidebar'); ?>><?php _e('Sidebar', 'wp-manurios'); ?></option>
                <option value="header" <?php selected($position, 'header'); ?>><?php _e('Cabeçalho', 'wp-manurios'); ?></option>
                <option value="content" <?php selected($position, 'content'); ?>><?php _e('Conteúdo', 'wp-manurios'); ?></option>
                <option value="footer" <?php selected($position, 'footer'); ?>><?php _e('Rodapé', 'wp-manurios'); ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('media_type'); ?>"><?php _e('Tipo de Mídia:', 'wp-manurios'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('media_type'); ?>" name="<?php echo $this->get_field_name('media_type'); ?>">
                <option value="" <?php selected($media_type, ''); ?>><?php _e('Todos os tipos', 'wp-manurios'); ?></option>
                <option value="image" <?php selected($media_type, 'image'); ?>><?php _e('Apenas Imagens', 'wp-manurios'); ?></option>
                <option value="video" <?php selected($media_type, 'video'); ?>><?php _e('Apenas Vídeos', 'wp-manurios'); ?></option>
                <option value="audio" <?php selected($media_type, 'audio'); ?>><?php _e('Apenas Áudios', 'wp-manurios'); ?></option>
                <option value="url" <?php selected($media_type, 'url'); ?>><?php _e('Apenas URLs', 'wp-manurios'); ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Quantidade:', 'wp-manurios'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($limit); ?>" size="3">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Tamanho:', 'wp-manurios'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
                <option value="small" <?php selected($size, 'small'); ?>><?php _e('Pequeno', 'wp-manurios'); ?></option>
                <option value="medium" <?php selected($size, 'medium'); ?>><?php _e('Médio', 'wp-manurios'); ?></option>
                <option value="large" <?php selected($size, 'large'); ?>><?php _e('Grande', 'wp-manurios'); ?></option>
                <option value="full" <?php selected($size, 'full'); ?>><?php _e('Completo', 'wp-manurios'); ?></option>
            </select>
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['position'] = (!empty($new_instance['position'])) ? sanitize_text_field($new_instance['position']) : 'sidebar';
        $instance['media_type'] = (!empty($new_instance['media_type'])) ? sanitize_text_field($new_instance['media_type']) : '';
        $instance['limit'] = (!empty($new_instance['limit'])) ? absint($new_instance['limit']) : 1;
        $instance['size'] = (!empty($new_instance['size'])) ? sanitize_text_field($new_instance['size']) : 'small';
        
        return $instance;
    }
}

/**
 * Register the Banner Widget
 */
function wp_manurios_register_banner_widget() {
    register_widget('WP_Manurios_Banner_Widget');
}
add_action('widgets_init', 'wp_manurios_register_banner_widget');
