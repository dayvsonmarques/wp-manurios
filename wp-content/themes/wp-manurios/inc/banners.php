<?php
/**
 * Banner Management System
 * Custom Post Type and Admin Interface
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Banner Custom Post Type
 */
function wp_manurios_register_banner_post_type() {
    $labels = array(
        'name'                  => _x('Banners', 'Post type general name', 'wp-manurios'),
        'singular_name'         => _x('Banner', 'Post type singular name', 'wp-manurios'),
        'menu_name'             => _x('Banners', 'Admin Menu text', 'wp-manurios'),
        'name_admin_bar'        => _x('Banner', 'Add New on Toolbar', 'wp-manurios'),
        'add_new'               => __('Adicionar Novo', 'wp-manurios'),
        'add_new_item'          => __('Adicionar Novo Banner', 'wp-manurios'),
        'new_item'              => __('Novo Banner', 'wp-manurios'),
        'edit_item'             => __('Editar Banner', 'wp-manurios'),
        'view_item'             => __('Ver Banner', 'wp-manurios'),
        'all_items'             => __('Todos os Banners', 'wp-manurios'),
        'search_items'          => __('Buscar Banners', 'wp-manurios'),
        'parent_item_colon'     => __('Banners Pai:', 'wp-manurios'),
        'not_found'             => __('Nenhum banner encontrado.', 'wp-manurios'),
        'not_found_in_trash'    => __('Nenhum banner encontrado na lixeira.', 'wp-manurios'),
        'featured_image'        => _x('Imagem do Banner', 'Overrides the "Featured Image" phrase', 'wp-manurios'),
        'set_featured_image'    => _x('Definir imagem do banner', 'Overrides the "Set featured image" phrase', 'wp-manurios'),
        'remove_featured_image' => _x('Remover imagem do banner', 'Overrides the "Remove featured image" phrase', 'wp-manurios'),
        'use_featured_image'    => _x('Usar como imagem do banner', 'Overrides the "Use as featured image" phrase', 'wp-manurios'),
        'archives'              => _x('Arquivo de Banners', 'The post type archive label', 'wp-manurios'),
        'insert_into_item'      => _x('Inserir no banner', 'Overrides the "Insert into post"/"Insert into page" phrase', 'wp-manurios'),
        'uploaded_to_this_item' => _x('Enviado para este banner', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'wp-manurios'),
        'filter_items_list'     => _x('Filtrar lista de banners', 'Screen reader text for the filter links', 'wp-manurios'),
        'items_list_navigation' => _x('Navegação da lista de banners', 'Screen reader text for the pagination', 'wp-manurios'),
        'items_list'            => _x('Lista de banners', 'Screen reader text for the items list', 'wp-manurios'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'banner'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-format-image',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('banner', $args);
}
add_action('init', 'wp_manurios_register_banner_post_type');

/**
 * Add custom meta boxes for banner management
 */
function wp_manurios_add_banner_meta_boxes() {
    add_meta_box(
        'banner_settings',
        __('Configurações do Banner', 'wp-manurios'),
        'wp_manurios_banner_settings_callback',
        'banner',
        'normal',
        'high'
    );
    
    add_meta_box(
        'banner_display',
        __('Exibição do Banner', 'wp-manurios'),
        'wp_manurios_banner_display_callback',
        'banner',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'wp_manurios_add_banner_meta_boxes');

/**
 * Banner settings meta box callback
 */
function wp_manurios_banner_settings_callback($post) {
    wp_nonce_field('wp_manurios_banner_meta_box', 'wp_manurios_banner_meta_box_nonce');
    
    $banner_media_type = get_post_meta($post->ID, '_banner_media_type', true);
    $banner_media_id = get_post_meta($post->ID, '_banner_media_id', true);
    $banner_url = get_post_meta($post->ID, '_banner_url', true);
    $banner_target = get_post_meta($post->ID, '_banner_target', true);
    $banner_start_date = get_post_meta($post->ID, '_banner_start_date', true);
    $banner_end_date = get_post_meta($post->ID, '_banner_end_date', true);
    $banner_priority = get_post_meta($post->ID, '_banner_priority', true);
    $banner_css_class = get_post_meta($post->ID, '_banner_css_class', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="banner_media_type"><?php _e('Tipo de Mídia', 'wp-manurios'); ?></label>
            </th>
            <td>
                <select id="banner_media_type" name="banner_media_type" onchange="toggleMediaFields()">
                    <option value="none" <?php selected($banner_media_type, 'none'); ?>><?php _e('Nenhuma mídia', 'wp-manurios'); ?></option>
                    <option value="image" <?php selected($banner_media_type, 'image'); ?>><?php _e('Imagem', 'wp-manurios'); ?></option>
                    <option value="video" <?php selected($banner_media_type, 'video'); ?>><?php _e('Vídeo', 'wp-manurios'); ?></option>
                    <option value="audio" <?php selected($banner_media_type, 'audio'); ?>><?php _e('Áudio', 'wp-manurios'); ?></option>
                    <option value="url" <?php selected($banner_media_type, 'url'); ?>><?php _e('URL Externa', 'wp-manurios'); ?></option>
                </select>
                <p class="description"><?php _e('Escolha o tipo de mídia que será exibida no banner.', 'wp-manurios'); ?></p>
            </td>
        </tr>
        
        <tr id="media_selector_row" style="<?php echo ($banner_media_type && $banner_media_type !== 'none' && $banner_media_type !== 'url') ? '' : 'display:none;'; ?>">
            <th scope="row">
                <label for="banner_media_id"><?php _e('Selecionar Mídia', 'wp-manurios'); ?></label>
            </th>
            <td>
                <div class="media-selector">
                    <input type="hidden" id="banner_media_id" name="banner_media_id" value="<?php echo esc_attr($banner_media_id); ?>" />
                    <button type="button" class="button" id="select_media_btn">
                        <?php _e('Selecionar Mídia', 'wp-manurios'); ?>
                    </button>
                    <button type="button" class="button" id="remove_media_btn" style="<?php echo $banner_media_id ? '' : 'display:none;'; ?>">
                        <?php _e('Remover', 'wp-manurios'); ?>
                    </button>
                    <div id="media_preview" style="margin-top: 10px;">
                        <?php if ($banner_media_id) {
                            $media_url = wp_get_attachment_url($banner_media_id);
                            $media_type = get_post_mime_type($banner_media_id);
                            if (strpos($media_type, 'image/') === 0) {
                                echo '<img src="' . esc_url($media_url) . '" style="max-width: 200px; height: auto;" />';
                            } elseif (strpos($media_type, 'video/') === 0) {
                                echo '<video controls style="max-width: 200px; height: auto;"><source src="' . esc_url($media_url) . '" type="' . esc_attr($media_type) . '"></video>';
                            } elseif (strpos($media_type, 'audio/') === 0) {
                                echo '<audio controls><source src="' . esc_url($media_url) . '" type="' . esc_attr($media_type) . '"></audio>';
                            }
                        } ?>
                    </div>
                </div>
            </td>
        </tr>
        
        <tr id="url_field_row" style="<?php echo ($banner_media_type === 'url') ? '' : 'display:none;'; ?>">
            <th scope="row">
                <label for="banner_url"><?php _e('URL Externa', 'wp-manurios'); ?></label>
            </th>
            <td>
                <input type="url" id="banner_url" name="banner_url" value="<?php echo esc_attr($banner_url); ?>" class="regular-text" />
                <p class="description"><?php _e('URL para onde o banner deve redirecionar quando clicado.', 'wp-manurios'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="banner_target"><?php _e('Abrir em', 'wp-manurios'); ?></label>
            </th>
            <td>
                <select id="banner_target" name="banner_target">
                    <option value="_self" <?php selected($banner_target, '_self'); ?>><?php _e('Mesma janela', 'wp-manurios'); ?></option>
                    <option value="_blank" <?php selected($banner_target, '_blank'); ?>><?php _e('Nova janela', 'wp-manurios'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="banner_start_date"><?php _e('Data de Início', 'wp-manurios'); ?></label>
            </th>
            <td>
                <input type="datetime-local" id="banner_start_date" name="banner_start_date" value="<?php echo esc_attr($banner_start_date); ?>" />
                <p class="description"><?php _e('Data e hora de início da exibição do banner.', 'wp-manurios'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="banner_end_date"><?php _e('Data de Fim', 'wp-manurios'); ?></label>
            </th>
            <td>
                <input type="datetime-local" id="banner_end_date" name="banner_end_date" value="<?php echo esc_attr($banner_end_date); ?>" />
                <p class="description"><?php _e('Data e hora de fim da exibição do banner.', 'wp-manurios'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="banner_priority"><?php _e('Prioridade', 'wp-manurios'); ?></label>
            </th>
            <td>
                <input type="number" id="banner_priority" name="banner_priority" value="<?php echo esc_attr($banner_priority ?: 0); ?>" min="0" max="100" />
                <p class="description"><?php _e('Prioridade de exibição (0-100). Maior número = maior prioridade.', 'wp-manurios'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="banner_css_class"><?php _e('Classe CSS', 'wp-manurios'); ?></label>
            </th>
            <td>
                <input type="text" id="banner_css_class" name="banner_css_class" value="<?php echo esc_attr($banner_css_class); ?>" class="regular-text" />
                <p class="description"><?php _e('Classes CSS adicionais para personalização.', 'wp-manurios'); ?></p>
            </td>
        </tr>
    </table>
    
    <script>
    function toggleMediaFields() {
        var mediaType = document.getElementById('banner_media_type').value;
        var mediaSelectorRow = document.getElementById('media_selector_row');
        var urlFieldRow = document.getElementById('url_field_row');
        
        if (mediaType === 'url') {
            mediaSelectorRow.style.display = 'none';
            urlFieldRow.style.display = '';
        } else if (mediaType === 'none') {
            mediaSelectorRow.style.display = 'none';
            urlFieldRow.style.display = 'none';
        } else {
            mediaSelectorRow.style.display = '';
            urlFieldRow.style.display = 'none';
        }
    }
    
    jQuery(document).ready(function($) {
        // Media selector
        $('#select_media_btn').click(function(e) {
            e.preventDefault();
            
            var mediaType = $('#banner_media_type').val();
            var frame;
            
            if (mediaType === 'image') {
                frame = wp.media({
                    title: 'Selecionar Imagem',
                    button: {
                        text: 'Usar esta imagem'
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    }
                });
            } else if (mediaType === 'video') {
                frame = wp.media({
                    title: 'Selecionar Vídeo',
                    button: {
                        text: 'Usar este vídeo'
                    },
                    multiple: false,
                    library: {
                        type: 'video'
                    }
                });
            } else if (mediaType === 'audio') {
                frame = wp.media({
                    title: 'Selecionar Áudio',
                    button: {
                        text: 'Usar este áudio'
                    },
                    multiple: false,
                    library: {
                        type: 'audio'
                    }
                });
            }
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#banner_media_id').val(attachment.id);
                $('#remove_media_btn').show();
                
                var preview = $('#media_preview');
                if (attachment.type === 'image') {
                    preview.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
                } else if (attachment.type === 'video') {
                    preview.html('<video controls style="max-width: 200px; height: auto;"><source src="' + attachment.url + '" type="' + attachment.mime + '"></video>');
                } else if (attachment.type === 'audio') {
                    preview.html('<audio controls><source src="' + attachment.url + '" type="' + attachment.mime + '"></audio>');
                }
            });
            
            frame.open();
        });
        
        // Remove media
        $('#remove_media_btn').click(function(e) {
            e.preventDefault();
            $('#banner_media_id').val('');
            $('#media_preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

/**
 * Banner display meta box callback
 */
function wp_manurios_banner_display_callback($post) {
    $banner_status = get_post_meta($post->ID, '_banner_status', true);
    $banner_position = get_post_meta($post->ID, '_banner_position', true);
    $banner_size = get_post_meta($post->ID, '_banner_size', true);
    ?>
    <p>
        <label for="banner_status"><?php _e('Status:', 'wp-manurios'); ?></label><br>
        <select id="banner_status" name="banner_status">
            <option value="active" <?php selected($banner_status, 'active'); ?>><?php _e('Ativo', 'wp-manurios'); ?></option>
            <option value="inactive" <?php selected($banner_status, 'inactive'); ?>><?php _e('Inativo', 'wp-manurios'); ?></option>
        </select>
    </p>
    
    <p>
        <label for="banner_position"><?php _e('Posição:', 'wp-manurios'); ?></label><br>
        <select id="banner_position" name="banner_position">
            <option value="header" <?php selected($banner_position, 'header'); ?>><?php _e('Cabeçalho', 'wp-manurios'); ?></option>
            <option value="content" <?php selected($banner_position, 'content'); ?>><?php _e('Conteúdo', 'wp-manurios'); ?></option>
            <option value="sidebar" <?php selected($banner_position, 'sidebar'); ?>><?php _e('Sidebar', 'wp-manurios'); ?></option>
            <option value="footer" <?php selected($banner_position, 'footer'); ?>><?php _e('Rodapé', 'wp-manurios'); ?></option>
        </select>
    </p>
    
    <p>
        <label for="banner_size"><?php _e('Tamanho:', 'wp-manurios'); ?></label><br>
        <select id="banner_size" name="banner_size">
            <option value="small" <?php selected($banner_size, 'small'); ?>><?php _e('Pequeno', 'wp-manurios'); ?></option>
            <option value="medium" <?php selected($banner_size, 'medium'); ?>><?php _e('Médio', 'wp-manurios'); ?></option>
            <option value="large" <?php selected($banner_size, 'large'); ?>><?php _e('Grande', 'wp-manurios'); ?></option>
            <option value="full" <?php selected($banner_size, 'full'); ?>><?php _e('Completo', 'wp-manurios'); ?></option>
        </select>
    </p>
    <?php
}

/**
 * Save banner meta data
 */
function wp_manurios_save_banner_meta($post_id) {
    if (!isset($_POST['wp_manurios_banner_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['wp_manurios_banner_meta_box_nonce'], 'wp_manurios_banner_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'banner' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save meta fields
    $fields = array(
        'banner_media_type',
        'banner_media_id',
        'banner_url',
        'banner_target',
        'banner_start_date',
        'banner_end_date',
        'banner_priority',
        'banner_css_class',
        'banner_status',
        'banner_position',
        'banner_size'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'wp_manurios_save_banner_meta');

/**
 * Add custom columns to banner list
 */
function wp_manurios_banner_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['banner_media'] = __('Mídia', 'wp-manurios');
    $new_columns['banner_status'] = __('Status', 'wp-manurios');
    $new_columns['banner_position'] = __('Posição', 'wp-manurios');
    $new_columns['banner_priority'] = __('Prioridade', 'wp-manurios');
    $new_columns['banner_dates'] = __('Período', 'wp-manurios');
    $new_columns['date'] = $columns['date'];
    
    return $new_columns;
}
add_filter('manage_banner_posts_columns', 'wp_manurios_banner_columns');

/**
 * Display custom column content
 */
function wp_manurios_banner_column_content($column, $post_id) {
    switch ($column) {
        case 'banner_media':
            $media_type = get_post_meta($post_id, '_banner_media_type', true);
            $media_id = get_post_meta($post_id, '_banner_media_id', true);
            $banner_url = get_post_meta($post_id, '_banner_url', true);
            
            if ($media_type === 'image' && $media_id) {
                echo wp_get_attachment_image($media_id, array(50, 50));
            } elseif ($media_type === 'video' && $media_id) {
                echo '<span class="dashicons dashicons-video-alt3" title="Vídeo"></span>';
            } elseif ($media_type === 'audio' && $media_id) {
                echo '<span class="dashicons dashicons-format-audio" title="Áudio"></span>';
            } elseif ($media_type === 'url' && $banner_url) {
                echo '<span class="dashicons dashicons-admin-links" title="URL Externa"></span>';
            } elseif (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            } else {
                echo '<span class="dashicons dashicons-format-image" title="Sem mídia"></span>';
            }
            break;
            
        case 'banner_status':
            $status = get_post_meta($post_id, '_banner_status', true);
            $status_label = ($status === 'active') ? __('Ativo', 'wp-manurios') : __('Inativo', 'wp-manurios');
            $status_class = ($status === 'active') ? 'status-active' : 'status-inactive';
            echo '<span class="' . $status_class . '">' . $status_label . '</span>';
            break;
            
        case 'banner_position':
            $position = get_post_meta($post_id, '_banner_position', true);
            $positions = array(
                'header' => __('Cabeçalho', 'wp-manurios'),
                'content' => __('Conteúdo', 'wp-manurios'),
                'sidebar' => __('Sidebar', 'wp-manurios'),
                'footer' => __('Rodapé', 'wp-manurios')
            );
            echo isset($positions[$position]) ? $positions[$position] : $position;
            break;
            
        case 'banner_priority':
            echo get_post_meta($post_id, '_banner_priority', true) ?: '0';
            break;
            
        case 'banner_dates':
            $start_date = get_post_meta($post_id, '_banner_start_date', true);
            $end_date = get_post_meta($post_id, '_banner_end_date', true);
            
            if ($start_date) {
                echo '<strong>' . __('Início:', 'wp-manurios') . '</strong><br>';
                echo date('d/m/Y H:i', strtotime($start_date)) . '<br>';
            }
            
            if ($end_date) {
                echo '<strong>' . __('Fim:', 'wp-manurios') . '</strong><br>';
                echo date('d/m/Y H:i', strtotime($end_date));
            }
            
            if (!$start_date && !$end_date) {
                echo __('Sem período definido', 'wp-manurios');
            }
            break;
    }
}
add_action('manage_banner_posts_custom_column', 'wp_manurios_banner_column_content', 10, 2);

/**
 * Add CSS for admin columns
 */
function wp_manurios_banner_admin_styles() {
    ?>
    <style>
    .status-active { color: #46b450; font-weight: bold; }
    .status-inactive { color: #dc3232; font-weight: bold; }
    .banner-image { max-width: 50px; max-height: 50px; }
    </style>
    <?php
}
add_action('admin_head', 'wp_manurios_banner_admin_styles');
