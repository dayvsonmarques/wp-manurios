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
        )
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

