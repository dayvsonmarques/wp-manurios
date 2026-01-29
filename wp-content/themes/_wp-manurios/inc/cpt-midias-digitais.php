<?php
/**
 * Register Custom Post Type: Mídias Digitais
 */

function wp_manurios_register_cpt_midias() {
	$labels = array(
		'name'                  => _x( 'Na Mídia', 'Post Type General Name', '_wp-manurios' ),
		'singular_name'         => _x( 'Mídia', 'Post Type Singular Name', '_wp-manurios' ),
		'menu_name'             => __( 'Na Mídia', '_wp-manurios' ),
		'name_admin_bar'        => __( 'Na Mídia', '_wp-manurios' ),
		'archives'              => __( 'Arquivos de Mídia', '_wp-manurios' ),
		'attributes'            => __( 'Atributos de Mídia', '_wp-manurios' ),
		'parent_item_colon'     => __( 'Mídia Pai:', '_wp-manurios' ),
		'all_items'             => __( 'Todas as Mídias', '_wp-manurios' ),
		'add_new_item'          => __( 'Adicionar Nova Mídia', '_wp-manurios' ),
		'add_new'               => __( 'Adicionar Nova', '_wp-manurios' ),
		'new_item'              => __( 'Nova Mídia', '_wp-manurios' ),
		'edit_item'             => __( 'Editar Mídia', '_wp-manurios' ),
		'update_item'           => __( 'Atualizar Mídia', '_wp-manurios' ),
		'view_item'             => __( 'Ver Mídia', '_wp-manurios' ),
		'view_items'            => __( 'Ver Mídias', '_wp-manurios' ),
		'search_items'          => __( 'Buscar Mídia', '_wp-manurios' ),
		'not_found'             => __( 'Nenhuma encontrada', '_wp-manurios' ),
		'not_found_in_trash'    => __( 'Nenhuma encontrada na lixeira', '_wp-manurios' ),
		'featured_image'        => __( 'Imagem de Capa (Banner)', '_wp-manurios' ),
		'set_featured_image'    => __( 'Definir imagem de capa', '_wp-manurios' ),
		'remove_featured_image' => __( 'Remover imagem de capa', '_wp-manurios' ),
		'use_featured_image'    => __( 'Usar como imagem de capa', '_wp-manurios' ),
		'insert_into_item'      => __( 'Inserir na mídia', '_wp-manurios' ),
		'uploaded_to_this_item' => __( 'Atualizado para esta mídia', '_wp-manurios' ),
		'items_list'            => __( 'Lista de mídias', '_wp-manurios' ),
		'items_list_navigation' => __( 'Navegação da lista de mídias', '_wp-manurios' ),
		'filter_items_list'     => __( 'Filtrar lista de mídias', '_wp-manurios' ),
	);
	$args = array(
		'label'                 => __( 'Mídia', '_wp-manurios' ),
		'description'           => __( 'Links de matérias divulgados na internet', '_wp-manurios' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, // Não precisa de página de arquivo própria por enquanto
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'rewrite'               => array( 'slug' => 'na-midia' ),
	);
	register_post_type( 'midias-digitais', $args );
}
add_action( 'init', 'wp_manurios_register_cpt_midias', 0 );


/**
 * Meta Boxes para Mídias Digitais
 */
function wp_manurios_midia_add_meta_boxes() {
	add_meta_box(
		'midia_meta_box',
		'Informações da Mídia',
		'wp_manurios_midia_meta_box_callback',
		'midias-digitais',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wp_manurios_midia_add_meta_boxes' );

function wp_manurios_midia_meta_box_callback( $post ) {
	wp_nonce_field( 'wp_manurios_midia_save_meta_box_data', 'wp_manurios_midia_meta_box_nonce' );

	$source_name = get_post_meta( $post->ID, '_midia_source_name', true );
	$source_url  = get_post_meta( $post->ID, '_midia_source_url', true );
	$date_custom = get_post_meta( $post->ID, '_midia_date_custom', true );

	echo '<p>';
	echo '<label for="midia_source_name"><strong>Nome do Veículo (Fonte):</strong></label><br>';
	echo '<input type="text" id="midia_source_name" name="midia_source_name" value="' . esc_attr( $source_name ) . '" style="width:100%;" placeholder="Ex: Portal G1, Revista Saúde, YouTube">';
	echo '</p>';

	echo '<p>';
	echo '<label for="midia_source_url"><strong>Link da Matéria (URL):</strong></label><br>';
	echo '<input type="url" id="midia_source_url" name="midia_source_url" value="' . esc_attr( $source_url ) . '" style="width:100%;" placeholder="https://...">';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="midia_date_custom"><strong>Data da Matéria:</strong></label><br>';
	echo '<input type="date" id="midia_date_custom" name="midia_date_custom" value="' . esc_attr( $date_custom ) . '">';
	echo '<br><span class="description">Se não preenchido, usará a data de publicação do post.</span>';
	echo '</p>';
}

function wp_manurios_midia_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wp_manurios_midia_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wp_manurios_midia_meta_box_nonce'], 'wp_manurios_midia_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['midia_source_name'] ) ) {
		update_post_meta( $post_id, '_midia_source_name', sanitize_text_field( $_POST['midia_source_name'] ) );
	}
	if ( isset( $_POST['midia_source_url'] ) ) {
		update_post_meta( $post_id, '_midia_source_url', esc_url_raw( $_POST['midia_source_url'] ) );
	}
	if ( isset( $_POST['midia_date_custom'] ) ) {
		update_post_meta( $post_id, '_midia_date_custom', sanitize_text_field( $_POST['midia_date_custom'] ) );
	}
}
add_action( 'save_post', 'wp_manurios_midia_save_meta_box_data' );

/**
 * Seed initial data for Mídias Digitais
 */
function wp_manurios_seed_midias_data() {
	if ( get_option( 'wp_manurios_midias_seeded_v1' ) ) {
		return; // Already seeded
	}

	$midias = array(
		array(
			'title'   => 'Entrevista ao Portal G1: Ansiedade e Tecnologia',
			'source'  => 'Portal G1',
			'date'    => date( 'Y-m-d', strtotime( '-15 days' ) ),
			'excerpt' => 'Confira a matéria completa onde discuto os impactos do uso excessivo de telas na saúde mental e estratégias de equilíbrio.',
			'image'   => 'banner-1.jpg',
		),
		array(
			'title'   => 'Podcast Mente em Foco: Carreira e Bem-estar',
			'source'  => 'YouTube',
			'date'    => date( 'Y-m-d', strtotime( '-1 month' ) ),
			'excerpt' => 'Um bate-papo descontraído sobre como gerenciar o estresse no ambiente corporativo e a importância do autocuidado.',
			'image'   => 'banner-2.jpg',
		),
		array(
			'title'   => 'Revista Saúde: A importância do sono',
			'source'  => 'Revista Saúde',
			'date'    => date( 'Y-m-d', strtotime( '-2 months' ) ),
			'excerpt' => 'Meu artigo mais recente aborda a higiene do sono como pilar fundamental para uma vida saudável e produtiva.',
			'image'   => 'banner-1.jpg',
		),
	);

	foreach ( $midias as $midia ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $midia['title'],
			'post_excerpt' => $midia['excerpt'],
			'post_status'  => 'publish',
			'post_type'    => 'midias-digitais',
		) );

		if ( ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_midia_source_name', $midia['source'] );
			update_post_meta( $post_id, '_midia_source_url', '#' ); // Placeholder link
			update_post_meta( $post_id, '_midia_date_custom', $midia['date'] );
			
			// We can't easily attach the image without it being in the media library, 
			// so we'll skip the Featured Image attachment for this script 
			// and let the frontend fall back gracefully or use a placeholder if thumb is missing.
            // Or better, we just don't set it and rely on the frontend check "if ( has_post_thumbnail() )".
		}
	}

	update_option( 'wp_manurios_midias_seeded_v1', true );

    // Seeding V2 - Add 3 more items
    if ( ! get_option( 'wp_manurios_midias_seeded_v2' ) ) {
        $midias_v2 = array(
            array(
                'title'   => 'Live Instagram: Dicas para lidar com o Burnout',
                'source'  => 'Instagram',
                'date'    => date( 'Y-m-d', strtotime( '-3 weeks' ) ),
                'excerpt' => 'Uma conversa ao vivo respondendo dúvidas dos seguidores sobre os sinais iniciais do Burnout e como buscar ajuda profissional.',
                'image'   => 'banner-1.jpg',
            ),
            array(
                'title'   => 'Blog Viva Bem: 5 passos para uma rotina equilibrada',
                'source'  => 'UOL Viva Bem',
                'date'    => date( 'Y-m-d', strtotime( '-2 months 1 week' ) ),
                'excerpt' => 'Artigo onde detalho cinco passos práticos para organizar a rotina e melhorar a qualidade de vida no dia a dia.',
                'image'   => 'banner-2.jpg',
            ),
            array(
                'title'   => 'Jornal Local: O impacto da alimentação na saúde mental',
                'source'  => 'Jornal da Cidade',
                'date'    => date( 'Y-m-d', strtotime( '-3 months' ) ),
                'excerpt' => 'Entrevista sobre como a nutrição adequada pode auxiliar no tratamento de transtornos de ansiedade e depressão.',
                'image'   => 'banner-1.jpg',
            ),
        );

        foreach ( $midias_v2 as $midia ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $midia['title'],
                'post_excerpt' => $midia['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'midias-digitais',
            ) );
    
            if ( ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_midia_source_name', $midia['source'] );
                update_post_meta( $post_id, '_midia_source_url', '#' );
                update_post_meta( $post_id, '_midia_date_custom', $midia['date'] );
            }
        }
        update_option( 'wp_manurios_midias_seeded_v2', true );
    }
}
add_action( 'init', 'wp_manurios_seed_midias_data' );
