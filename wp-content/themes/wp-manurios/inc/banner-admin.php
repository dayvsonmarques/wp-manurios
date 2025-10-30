<?php
/**
 * Banner Admin Page
 * Custom admin page for banner management
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom admin menu
 */
function wp_manurios_add_banner_admin_menu() {
    // Menu principal com dashboard
    add_menu_page(
        __('Sistema de Banners', 'wp-manurios'),
        __('Banners', 'wp-manurios'),
        'manage_options',
        'banner-management',
        'wp_manurios_banner_admin_page',
        'dashicons-format-image',
        30
    );
    
    // Submenu: Dashboard (mesma página do menu principal)
    add_submenu_page(
        'banner-management',
        __('Dashboard', 'wp-manurios'),
        __('Dashboard', 'wp-manurios'),
        'manage_options',
        'banner-management',
        'wp_manurios_banner_admin_page'
    );
    
    // Submenu: Todos os Banners
    add_submenu_page(
        'banner-management',
        __('Gerenciar Banners', 'wp-manurios'),
        __('Todos os Banners', 'wp-manurios'),
        'manage_options',
        'edit.php?post_type=banner'
    );
    
    // Submenu: Adicionar Banner
    add_submenu_page(
        'banner-management',
        __('Adicionar Banner', 'wp-manurios'),
        __('Adicionar Banner', 'wp-manurios'),
        'manage_options',
        'post-new.php?post_type=banner'
    );
    
    // Submenu: Posições dos Banners
    add_submenu_page(
        'banner-management',
        __('Posições dos Banners', 'wp-manurios'),
        __('Posições', 'wp-manurios'),
        'manage_options',
        'banner-positions',
        'wp_manurios_banner_positions_page'
    );
    
    // Submenu: Configurações
    add_submenu_page(
        'banner-management',
        __('Configurações', 'wp-manurios'),
        __('Configurações', 'wp-manurios'),
        'manage_options',
        'banner-settings',
        'wp_manurios_banner_settings_page'
    );
}
add_action('admin_menu', 'wp_manurios_add_banner_admin_menu');

/**
 * Banner admin page callback
 */
function wp_manurios_banner_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Gerenciar Banners', 'wp-manurios'); ?></h1>
        
        <div class="banner-admin-dashboard">
            <div class="banner-stats">
                <?php
                $total_banners = wp_count_posts('banner');
                $active_banners = get_posts(array(
                    'post_type' => 'banner',
                    'meta_key' => '_banner_status',
                    'meta_value' => 'active',
                    'posts_per_page' => -1
                ));
                $inactive_banners = get_posts(array(
                    'post_type' => 'banner',
                    'meta_key' => '_banner_status',
                    'meta_value' => 'inactive',
                    'posts_per_page' => -1
                ));
                ?>
                
                <div class="banner-stat-box">
                    <h3><?php _e('Total de Banners', 'wp-manurios'); ?></h3>
                    <span class="stat-number"><?php echo $total_banners->publish; ?></span>
                </div>
                
                <div class="banner-stat-box">
                    <h3><?php _e('Banners Ativos', 'wp-manurios'); ?></h3>
                    <span class="stat-number active"><?php echo count($active_banners); ?></span>
                </div>
                
                <div class="banner-stat-box">
                    <h3><?php _e('Banners Inativos', 'wp-manurios'); ?></h3>
                    <span class="stat-number inactive"><?php echo count($inactive_banners); ?></span>
                </div>
            </div>
            
            <div class="banner-actions">
                <a href="<?php echo admin_url('post-new.php?post_type=banner'); ?>" class="button button-primary">
                    <?php _e('Adicionar Novo Banner', 'wp-manurios'); ?>
                </a>
                <a href="<?php echo admin_url('edit.php?post_type=banner'); ?>" class="button">
                    <?php _e('Ver Todos os Banners', 'wp-manurios'); ?>
                </a>
            </div>
            
            <div class="banner-recent">
                <h2><?php _e('Banners Recentes', 'wp-manurios'); ?></h2>
                <?php
                $recent_banners = get_posts(array(
                    'post_type' => 'banner',
                    'posts_per_page' => 5,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($recent_banners) {
                    echo '<table class="wp-list-table widefat fixed striped">';
                    echo '<thead><tr>';
                    echo '<th>' . __('Título', 'wp-manurios') . '</th>';
                    echo '<th>' . __('Status', 'wp-manurios') . '</th>';
                    echo '<th>' . __('Posição', 'wp-manurios') . '</th>';
                    echo '<th>' . __('Data', 'wp-manurios') . '</th>';
                    echo '<th>' . __('Ações', 'wp-manurios') . '</th>';
                    echo '</tr></thead><tbody>';
                    
                    foreach ($recent_banners as $banner) {
                        $status = get_post_meta($banner->ID, '_banner_status', true);
                        $position = get_post_meta($banner->ID, '_banner_position', true);
                        
                        echo '<tr>';
                        echo '<td><strong>' . $banner->post_title . '</strong></td>';
                        echo '<td><span class="status-' . $status . '">' . ucfirst($status) . '</span></td>';
                        echo '<td>' . ucfirst($position) . '</td>';
                        echo '<td>' . date('d/m/Y', strtotime($banner->post_date)) . '</td>';
                        echo '<td>';
                        echo '<a href="' . get_edit_post_link($banner->ID) . '" class="button button-small">' . __('Editar', 'wp-manurios') . '</a> ';
                        echo '<a href="' . get_permalink($banner->ID) . '" class="button button-small" target="_blank">' . __('Ver', 'wp-manurios') . '</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody></table>';
                } else {
                    echo '<p>' . __('Nenhum banner encontrado.', 'wp-manurios') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <style>
    .banner-admin-dashboard {
        margin-top: 20px;
    }
    
    .banner-stats {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .banner-stat-box {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        text-align: center;
        flex: 1;
    }
    
    .banner-stat-box h3 {
        margin: 0 0 10px 0;
        font-size: 14px;
        color: #666;
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: bold;
        color: #0073aa;
    }
    
    .stat-number.active {
        color: #46b450;
    }
    
    .stat-number.inactive {
        color: #dc3232;
    }
    
    .banner-actions {
        margin-bottom: 30px;
    }
    
    .banner-actions .button {
        margin-right: 10px;
    }
    
    .banner-recent table {
        margin-top: 20px;
    }
    
    .status-active {
        color: #46b450;
        font-weight: bold;
    }
    
    .status-inactive {
        color: #dc3232;
        font-weight: bold;
    }
    </style>
    <?php
}

/**
 * Banner settings page callback
 */
function wp_manurios_banner_settings_page() {
    if (isset($_POST['submit'])) {
        update_option('wp_manurios_banner_settings', $_POST['banner_settings']);
        echo '<div class="notice notice-success"><p>' . __('Configurações salvas com sucesso!', 'wp-manurios') . '</p></div>';
    }
    
    $settings = get_option('wp_manurios_banner_settings', array());
    ?>
    <div class="wrap">
        <h1><?php _e('Configurações de Banners', 'wp-manurios'); ?></h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Largura Máxima', 'wp-manurios'); ?></th>
                    <td>
                        <input type="number" name="banner_settings[max_width]" value="<?php echo esc_attr($settings['max_width'] ?? '1200'); ?>" class="regular-text" />
                        <p class="description"><?php _e('Largura máxima dos banners em pixels.', 'wp-manurios'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('Altura Máxima', 'wp-manurios'); ?></th>
                    <td>
                        <input type="number" name="banner_settings[max_height]" value="<?php echo esc_attr($settings['max_height'] ?? '400'); ?>" class="regular-text" />
                        <p class="description"><?php _e('Altura máxima dos banners em pixels.', 'wp-manurios'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('Qualidade da Imagem', 'wp-manurios'); ?></th>
                    <td>
                        <input type="range" name="banner_settings[quality]" min="1" max="100" value="<?php echo esc_attr($settings['quality'] ?? '85'); ?>" class="regular-text" />
                        <span id="quality-value"><?php echo esc_attr($settings['quality'] ?? '85'); ?>%</span>
                        <p class="description"><?php _e('Qualidade de compressão das imagens (1-100%).', 'wp-manurios'); ?></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('Lazy Loading', 'wp-manurios'); ?></th>
                    <td>
                        <input type="checkbox" name="banner_settings[lazy_loading]" value="1" <?php checked($settings['lazy_loading'] ?? 1, 1); ?> />
                        <label><?php _e('Ativar carregamento preguiçoso das imagens', 'wp-manurios'); ?></label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php _e('CSS Personalizado', 'wp-manurios'); ?></th>
                    <td>
                        <textarea name="banner_settings[custom_css]" rows="10" cols="50" class="large-text"><?php echo esc_textarea($settings['custom_css'] ?? ''); ?></textarea>
                        <p class="description"><?php _e('CSS personalizado para os banners.', 'wp-manurios'); ?></p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const qualitySlider = document.querySelector('input[name="banner_settings[quality]"]');
        const qualityValue = document.getElementById('quality-value');
        
        qualitySlider.addEventListener('input', function() {
            qualityValue.textContent = this.value + '%';
        });
    });
    </script>
    <?php
}

/**
 * Banner positions page callback
 */
function wp_manurios_banner_positions_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Posições dos Banners', 'wp-manurios'); ?></h1>
        
        <div class="banner-positions-info">
            <h2><?php _e('Posições Disponíveis', 'wp-manurios'); ?></h2>
            
            <div class="position-cards">
                <div class="position-card">
                    <h3><?php _e('Cabeçalho', 'wp-manurios'); ?></h3>
                    <p><?php _e('Exibido antes do menu principal do site.', 'wp-manurios'); ?></p>
                    <code>do_action('wp_manurios_before_header');</code>
                    <div class="position-stats">
                        <?php
                        $header_banners = get_posts(array(
                            'post_type' => 'banner',
                            'meta_key' => '_banner_position',
                            'meta_value' => 'header',
                            'posts_per_page' => -1
                        ));
                        echo '<strong>' . count($header_banners) . '</strong> ' . __('banners ativos', 'wp-manurios');
                        ?>
                    </div>
                </div>
                
                <div class="position-card">
                    <h3><?php _e('Conteúdo', 'wp-manurios'); ?></h3>
                    <p><?php _e('Exibido antes do conteúdo principal das páginas.', 'wp-manurios'); ?></p>
                    <code>do_action('wp_manurios_before_content');</code>
                    <div class="position-stats">
                        <?php
                        $content_banners = get_posts(array(
                            'post_type' => 'banner',
                            'meta_key' => '_banner_position',
                            'meta_value' => 'content',
                            'posts_per_page' => -1
                        ));
                        echo '<strong>' . count($content_banners) . '</strong> ' . __('banners ativos', 'wp-manurios');
                        ?>
                    </div>
                </div>
                
                <div class="position-card">
                    <h3><?php _e('Sidebar', 'wp-manurios'); ?></h3>
                    <p><?php _e('Exibido na sidebar através do widget Banner Widget.', 'wp-manurios'); ?></p>
                    <code>Widget: Banner Widget</code>
                    <div class="position-stats">
                        <?php
                        $sidebar_banners = get_posts(array(
                            'post_type' => 'banner',
                            'meta_key' => '_banner_position',
                            'meta_value' => 'sidebar',
                            'posts_per_page' => -1
                        ));
                        echo '<strong>' . count($sidebar_banners) . '</strong> ' . __('banners ativos', 'wp-manurios');
                        ?>
                    </div>
                </div>
                
                <div class="position-card">
                    <h3><?php _e('Rodapé', 'wp-manurios'); ?></h3>
                    <p><?php _e('Exibido no topo do rodapé do site.', 'wp-manurios'); ?></p>
                    <code>do_action('wp_manurios_footer_top');</code>
                    <div class="position-stats">
                        <?php
                        $footer_banners = get_posts(array(
                            'post_type' => 'banner',
                            'meta_key' => '_banner_position',
                            'meta_value' => 'footer',
                            'posts_per_page' => -1
                        ));
                        echo '<strong>' . count($footer_banners) . '</strong> ' . __('banners ativos', 'wp-manurios');
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="position-usage">
                <h2><?php _e('Como Usar as Posições', 'wp-manurios'); ?></h2>
                
                <h3><?php _e('1. Via Código PHP', 'wp-manurios'); ?></h3>
                <p><?php _e('Adicione estes hooks nos templates do seu tema:', 'wp-manurios'); ?></p>
                <pre><code><?php _e('// No header.php, antes do menu', 'wp-manurios'); ?>
do_action('wp_manurios_before_header');

<?php _e('// No index.php, antes do conteúdo', 'wp-manurios'); ?>
do_action('wp_manurios_before_content');

<?php _e('// No footer.php, no topo do rodapé', 'wp-manurios'); ?>
do_action('wp_manurios_footer_top');</code></pre>
                
                <h3><?php _e('2. Via Widget', 'wp-manurios'); ?></h3>
                <p><?php _e('Vá em Aparência > Widgets e adicione o "Banner Widget" na sidebar desejada.', 'wp-manurios'); ?></p>
                
                <h3><?php _e('3. Via Shortcode', 'wp-manurios'); ?></h3>
                <p><?php _e('Use o shortcode em posts e páginas:', 'wp-manurios'); ?></p>
                <pre><code>[banners position="content" limit="3"]</code></pre>
            </div>
        </div>
    </div>
    
    <style>
    .banner-positions-info {
        margin-top: 20px;
    }
    
    .position-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .position-card {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .position-card h3 {
        margin: 0 0 10px 0;
        color: #0073aa;
        font-size: 18px;
    }
    
    .position-card p {
        margin: 0 0 15px 0;
        color: #666;
        line-height: 1.4;
    }
    
    .position-card code {
        background: #f1f1f1;
        padding: 4px 8px;
        border-radius: 3px;
        font-family: monospace;
        font-size: 12px;
        display: block;
        margin: 10px 0;
    }
    
    .position-stats {
        background: #f9f9f9;
        padding: 10px;
        border-radius: 3px;
        margin-top: 15px;
        text-align: center;
        color: #0073aa;
    }
    
    .position-usage {
        margin-top: 40px;
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
        padding: 20px;
    }
    
    .position-usage h2 {
        margin-top: 0;
        color: #23282d;
    }
    
    .position-usage h3 {
        color: #0073aa;
        margin-top: 25px;
    }
    
    .position-usage pre {
        background: #f1f1f1;
        padding: 15px;
        border-radius: 4px;
        overflow-x: auto;
        margin: 10px 0;
    }
    
    .position-usage code {
        background: #f1f1f1;
        padding: 2px 6px;
        border-radius: 3px;
        font-family: monospace;
    }
    </style>
    <?php
}
