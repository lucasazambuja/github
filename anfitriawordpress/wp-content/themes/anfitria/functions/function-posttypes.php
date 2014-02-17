<?php


/* ------------------------------------------------------------------------ *
 * Register theme post_type BANNER
 * ------------------------------------------------------------------------ */
if (!post_type_exists('banners')) {

    function banners_register() {
        $labels = array(
            'name' => __('Banners'),
            'singular_name' => __('Banner'),
            'add_new' => __('Novo Banner'),
            'add_new_item' => __('Adicionar novo Banner'),
            'edit_item' => __('Editar Banner'),
            'new_item' => __('Novo Banner'),
            'view_item' => __('Ver Banner'),
            'search_items' => __('Buscar Banner'),
            'not_found' => __('Nenhum Banner encontrado'),
            'not_found_in_trash' => __('Nada encontrado na Lixeira'),
            'menu_name' => __('Banners'),
            'parent_item_colon' => ''
        );

        $supports = array('title', 'thumbnail');

        $args = array(
            'labels' => $labels,
            'description' => 'Cadastre aqui seus banners',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menu' => '',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'banners'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'supports' => $supports,
            'show_in_tag_cloud' => true,
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'taxonomies' => array(null),
            'can_export' => true,
            'permalink_epmask' => '',
            'menu_icon' => 1
        );

        register_post_type('banners', $args);
    }

    add_action('init', 'banners_register');
}






/* ------------------------------------------------------------------------ *
 * Register theme post_type PATROCINIO
 * ------------------------------------------------------------------------ */
if (!post_type_exists('patrocinio')) {

    function patrocinio_register() {
        $labels = array(
            'name' => __('Patrocínio'),
            'singular_name' => __('Patrocínio'),
            'add_new' => __('Novo Patrocínio'),
            'add_new_item' => __('Adicionar novo Patrocínio'),
            'edit_item' => __('Editar Patrocínio'),
            'new_item' => __('Novo Patrocínio'),
            'view_item' => __('Ver Patrocínio'),
            'search_items' => __('Buscar Patrocínio'),
            'not_found' => __('Nenhum Patrocínio encontrado'),
            'not_found_in_trash' => __('Nada encontrado na Lixeira'),
            'menu_name' => __('Patrocínio'),
            'parent_item_colon' => ''
        );

        $supports = array('title', 'thumbnail');

        $args = array(
            'labels' => $labels,
            'description' => 'Cadastre aqui seus patrocínio',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menu' => '',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'supports' => $supports,
            'show_in_tag_cloud' => true,
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'taxonomies' => array(null),
            'can_export' => true,
            'permalink_epmask' => '',
            'menu_icon' => null //get_bloginfo('template_url') . '/images/portfolio_ui_icon.png',
        );

        register_post_type('patrocinio', $args);
    }

    add_action('init', 'patrocinio_register');
}


/* ------------------------------------------------------------------------ *
 * Register theme post_type LINKS
 * ------------------------------------------------------------------------ */
if (!post_type_exists('links')) {

    function links_register() {
        $labels = array(
            'name' => __('Links'),
            'singular_name' => __('Links'),
            'add_new' => __('Novo Link'),
            'add_new_item' => __('Adicionar novo Link'),
            'edit_item' => __('Editar Link'),
            'new_item' => __('Novo Link'),
            'view_item' => __('Ver Link'),
            'search_items' => __('Buscar Link'),
            'not_found' => __('Nenhum Link encontrado'),
            'not_found_in_trash' => __('Nada encontrado na Lixeira'),
            'menu_name' => __('Link'),
            'parent_item_colon' => ''
        );

        $supports = array('title');

        $args = array(
            'labels' => $labels,
            'description' => 'Cadastre aqui seus links',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menu' => '',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'supports' => $supports,
            'show_in_tag_cloud' => true,
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'taxonomies' => array(null),
            'can_export' => true,
            'permalink_epmask' => '',
            'menu_icon' => 1
        );

        register_post_type('links', $args);
    }

    add_action('init', 'links_register');
}


/* ------------------------------------------------------------------------ *
 * Register theme post_type DESTAQUE
 * ------------------------------------------------------------------------ */
if (!post_type_exists('destaque')) {

    function destaque_register() {
        $labels = array(
            'name' => __('Destaque'),
            'singular_name' => __('Destaque'),
            'add_new' => __('Novo Destaque'),
            'add_new_item' => __('Adicionar novo Destaque'),
            'edit_item' => __('Editar Destaque'),
            'new_item' => __('Novo Destaque'),
            'view_item' => __('Ver Destaque'),
            'search_items' => __('Buscar Destaque'),
            'not_found' => __('Nenhum Destaque encontrado'),
            'not_found_in_trash' => __('Nada encontrado na Lixeira'),
            'menu_name' => __('Destaque'),
            'parent_item_colon' => ''
        );

        $supports = array('title', 'thumbnail' );

        $args = array(
            'labels' => $labels,
            'description' => 'Cadastre aqui seus destaques',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menu' => '',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'supports' => $supports,
            'show_in_tag_cloud' => true,
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'taxonomies' => array(null),
            'can_export' => true,
            'permalink_epmask' => '',
            'menu_icon' => 1
        );

        register_post_type('destaque', $args);
    }

    add_action('init', 'destaque_register');
}



/* ------------------------------------------------------------------------ *
 * Register theme post_type Menu
 * ------------------------------------------------------------------------ */
if (!post_type_exists('menus')) {

    function menus_register() {
        $labels = array(
            'name' => __('Menus'),
            'singular_name' => __('Menu'),
            'add_new' => __('Novo Menu'),
            'add_new_item' => __('Adicionar novo Menu'),
            'edit_item' => __('Editar Menu'),
            'new_item' => __('Novo Menu'),
            'view_item' => __('Ver Menu'),
            'search_items' => __('Buscar Menu'),
            'not_found' => __('Nenhum Menu encontrado'),
            'not_found_in_trash' => __('Nada encontrado na Lixeira'),
            'menu_name' => __('Menus'),
            'parent_item_colon' => ''
        );

        $supports = array('title', 'thumbnail');

        $args = array(
            'labels' => $labels,
            'description' => 'Cadastre aqui seus menus',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menu' => '',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'menus'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'supports' => $supports,
            'show_in_tag_cloud' => true,
            'show_in_menu' => true,
            'exclude_from_search' => true,
            'taxonomies' => array('categorymenu'),
            'can_export' => true,
            'permalink_epmask' => '',
            'menu_icon' => 1
        );

        register_post_type('menus', $args);
    }

    add_action('init', 'menus_register');
}

/* ------------------------------------------------------------------------ *
 * Register theme post_type Video
 * ------------------------------------------------------------------------ */
function video_post_type() {

	$labels = array(
		'name'                => _x( 'Videos', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Video', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Video:', 'text_domain' ),
		'all_items'           => __( 'All Videos', 'text_domain' ),
		'view_item'           => __( 'View Video', 'text_domain' ),
		'add_new_item'        => __( 'Add New Video', 'text_domain' ),
		'add_new'             => __( 'New Video', 'text_domain' ),
		'edit_item'           => __( 'Edit Video', 'text_domain' ),
		'update_item'         => __( 'Update Video', 'text_domain' ),
		'search_items'        => __( 'Search videos', 'text_domain' ),
		'not_found'           => __( 'No videos found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No videos found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'video',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'video', 'text_domain' ),
		'description'         => __( 'Video information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt' ),
		'taxonomies'          => array( null ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 1,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'video',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	
	register_post_type( 'video', $args );

}

// Hook into the 'init' action
add_action( 'init', 'video_post_type', 0 );
?>