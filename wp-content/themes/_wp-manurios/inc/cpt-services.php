<?php
/**
 * Register Custom Post Type for Services/Products
 */
function _wp_manurios_register_service_cpt() {
    $labels = array(
        'name'                  => _x( 'Serviços & Produtos', 'Post Type General Name', '_wp-manurios' ),
        'singular_name'         => _x( 'Serviço', 'Post Type Singular Name', '_wp-manurios' ),
        'menu_name'             => __( 'Serviços', '_wp-manurios' ),
        'name_admin_bar'        => __( 'Serviço', '_wp-manurios' ),
        'archives'              => __( 'Arquivos de Serviço', '_wp-manurios' ),
        'attributes'            => __( 'Atributos de Serviço', '_wp-manurios' ),
        'parent_item_colon'     => __( 'Serviço Pai:', '_wp-manurios' ),
        'all_items'             => __( 'Todos os Serviços', '_wp-manurios' ),
        'add_new_item'          => __( 'Adicionar Novo Serviço', '_wp-manurios' ),
        'add_new'               => __( 'Adicionar Novo', '_wp-manurios' ),
        'new_item'              => __( 'Novo Serviço', '_wp-manurios' ),
        'edit_item'             => __( 'Editar Serviço', '_wp-manurios' ),
        'update_item'           => __( 'Atualizar Serviço', '_wp-manurios' ),
        'view_item'             => __( 'Ver Serviço', '_wp-manurios' ),
        'view_items'            => __( 'Ver Serviços', '_wp-manurios' ),
        'search_items'          => __( 'Buscar Serviço', '_wp-manurios' ),
        'not_found'             => __( 'Não encontrado', '_wp-manurios' ),
        'not_found_in_trash'    => __( 'Não encontrado na lixeira', '_wp-manurios' ),
        'featured_image'        => __( 'Ícone/Imagem Destaque', '_wp-manurios' ),
        'set_featured_image'    => __( 'Definir imagem destaque', '_wp-manurios' ),
        'remove_featured_image' => __( 'Remover imagem destaque', '_wp-manurios' ),
        'use_featured_image'    => __( 'Usar como imagem destaque', '_wp-manurios' ),
    );
    $args = array(
        'label'                 => __( 'Serviço', '_wp-manurios' ),
        'description'           => __( 'Post Type para Serviços e Produtos', '_wp-manurios' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-grid-view',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true, // Enable Gutenberg/Block Editor
    );
    register_post_type( 'mp_service', $args );
}
add_action( 'init', '_wp_manurios_register_service_cpt', 0 );

function _wp_manurios_get_service_icons() {
    return array(
        'palestras' => array(
            'label' => 'Palestras (Pessoa)',
            'svg'   => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'
        ),
        'livro' => array(
            'label' => 'Livro (Documento)',
            'svg'   => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
        ),
        'team' => array(
            'label' => 'Equipe (Pessoas)',
            'svg'   => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'
        ),
        'product' => array(
            'label' => 'Produto (Caixa)',
            'svg'   => 'M9 12h6m2 0a2 2 0 01-2 2H9a2 2 0 01-2-2m12 0a2 2 0 00-2-2H7a2 2 0 00-2 2m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6'
        ),
        'clipboard' => array(
            'label' => 'Prancheta',
            'svg'   => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'
        ),
        'heart' => array(
            'label' => 'Saúde (Coração)',
            'svg'   => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'
        ),
        'brain' => array(
            'label' => 'Mental (Lâmpada/Ideia)',
            'svg'   => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
        ),
        'money' => array(
             'label' => 'Financeiro (Cifrão)',
             'svg'   => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        ),
        'growth' => array(
            'label' => 'Crescimento (Gráfico)',
            'svg'   => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'
        ),
        'target' => array(
            'label' => 'Metas (Alvo)',
            'svg'   => 'M11.933 12.8a1 1 0 00-.866.5M12 3a9 9 0 100 18 9 9 0 000-18zm0 2a7 7 0 100 14 7 7 0 000-14zm0 3a4 4 0 100 8 4 4 0 000-8z'
        ),
        'chat' => array(
            'label' => 'Comunicação (Chat)',
            'svg'   => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'
        ),
        'globe' => array(
            'label' => 'Online (Globo)',
            'svg'   => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'
        ),
        'calendar' => array(
            'label' => 'Agenda (Calendário)',
            'svg'   => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
        ),
        'star' => array(
            'label' => 'Destaque (Estrela)',
            'svg'   => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'
        ),
        'shield' => array(
            'label' => 'Segurança (Escudo)',
            'svg'   => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
        ),
        'home' => array(
            'label' => 'Institucional (Casa)',
            'svg'   => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
        ),
        'settings' => array(
            'label' => 'Configuração (Engrenagem)',
            'svg'   => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
        ),
        'tech' => array(
            'label' => 'Tecnologia (Monitor)',
            'svg'   => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
        ),
        'zap' => array(
            'label' => 'Energia (Raio)',
            'svg'   => 'M13 10V3L4 14h7v7l9-11h-7z'
        ),
        'coffee' => array(
            'label' => 'Pausa (Cafe)',
            'svg'   => 'M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z'
        ),
    );
}

/**
 * Add Meta Box for Service Link & Icon
 */
function _wp_manurios_add_service_meta_box() {
    add_meta_box(
        'service_info_meta',
        __( 'Informações Adicionais', '_wp-manurios' ),
        '_wp_manurios_render_service_meta_box',
        'mp_service',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', '_wp_manurios_add_service_meta_box' );

function _wp_manurios_render_service_meta_box( $post ) {
    $url = get_post_meta( $post->ID, '_service_url', true );
    $label = get_post_meta( $post->ID, '_service_btn_label', true );
    $selected_icon = get_post_meta( $post->ID, '_service_icon', true );
    $icons = _wp_manurios_get_service_icons();

    wp_nonce_field( 'service_meta_save', 'service_meta_nonce' );
    ?>
    <p>
        <label for="service_url"><strong><?php _e( 'URL de Destino:', '_wp-manurios' ); ?></strong></label>
        <input type="url" id="service_url" name="service_url" value="<?php echo esc_attr( $url ); ?>" class="widefat" placeholder="https://...">
    </p>
    <p>
        <label for="service_btn_label"><strong><?php _e( 'Texto do Botão:', '_wp-manurios' ); ?></strong></label>
        <input type="text" id="service_btn_label" name="service_btn_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" placeholder="Ex: Saiba mais">
    </p>
    <div style="margin-top: 20px;">
        <label><strong><?php _e( 'Selecione um Ícone:', '_wp-manurios' ); ?></strong></label>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 10px;">
            <?php foreach ( $icons as $key => $data ) : ?>
                <label style="border: 1px solid #ddd; padding: 10px; text-align: center; border-radius: 4px; cursor: pointer; display: block;">
                    <input type="radio" name="service_icon" value="<?php echo esc_attr( $key ); ?>" <?php checked( $selected_icon, $key ); ?>>
                    <div style="margin: 5px 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #4CAF50;">
                            <path d="<?php echo $data['svg']; ?>"></path>
                        </svg>
                    </div>
                    <small style="display: block; font-size: 10px;"><?php echo esc_html( $data['label'] ); ?></small>
                </label>
            <?php endforeach; ?>
        </div>
        <p class="description">Se uma <strong>Imagem Destacada</strong> for definida para o post, ela terá prioridade sobre este ícone.</p>
    </div>
    <?php
}

function _wp_manurios_save_service_meta( $post_id ) {
    if ( ! isset( $_POST['service_meta_nonce'] ) || ! wp_verify_nonce( $_POST['service_meta_nonce'], 'service_meta_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['service_url'] ) ) {
        update_post_meta( $post_id, '_service_url', sanitize_url( $_POST['service_url'] ) );
    }
    if ( isset( $_POST['service_btn_label'] ) ) {
        update_post_meta( $post_id, '_service_btn_label', sanitize_text_field( $_POST['service_btn_label'] ) );
    }
    if ( isset( $_POST['service_icon'] ) ) {
        update_post_meta( $post_id, '_service_icon', sanitize_text_field( $_POST['service_icon'] ) );
    }
}
add_action( 'save_post', '_wp_manurios_save_service_meta' );

