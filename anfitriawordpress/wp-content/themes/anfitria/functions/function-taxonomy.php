<?php

// Register Custom Taxonomy
function custom_taxonomy_categorymenu()  {

	$labels = array(
		'name'                       => _x( 'CategoryMenu', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'CategoryMenu', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'CategoryMenu', 'text_domain' ),
		'all_items'                  => __( 'All CategoryMenus', 'text_domain' ),
		'parent_item'                => __( 'Parent CategoryMenu', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent CategoryMenu:', 'text_domain' ),
		'new_item_name'              => __( 'New CategoryMenu Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New CategoryMenu', 'text_domain' ),
		'edit_item'                  => __( 'Edit CategoryMenu', 'text_domain' ),
		'update_item'                => __( 'Update CategoryMenu', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate categorymenus with commas', 'text_domain' ),
		'search_items'               => __( 'Search CategoryMenus', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove CategoryMenu', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used CategoryMenus', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'categorymenu',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'categorymenu',
		'rewrite'                    => $rewrite,
	);
	
	register_taxonomy( 'categorymenus', 'menus', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy_categorymenu', 0 );

?>