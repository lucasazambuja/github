<?php 

// Register Script
function custom_styles() {

	$url = get_template_directory_uri() . '/css/widgets.css';
	wp_register_style( 'widgets-css', $url, false, false, false );
	wp_enqueue_style( 'widgets-css' );
	
	$url = get_template_directory_uri() . '/jquery/jfacybox/facybox.css';
	wp_register_style( 'facybox-css', $url, false, false, false );
	wp_enqueue_style( 'facybox-css' );
	
	$url = get_template_directory_uri() . '/jquery/photogrid/photogrid.css';
	wp_register_style( 'photogrid-css', $url, false, false, false );
	wp_enqueue_style( 'photogrid-css' );
	
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_styles' );

function admin_custom_styles() {
	
	$url = get_template_directory_uri() . '/jquery/galerry/gallery.css';
	wp_register_style( 'gallery-css', $url, false, false, false );
	wp_enqueue_style( 'gallery-css' );
	
	$url = 'http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css';
	wp_register_style( 'jquery-ui-css', $url, false, false, false );
	wp_enqueue_style( 'jquery-ui-css' );
	
}

// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'admin_custom_styles' );

?>