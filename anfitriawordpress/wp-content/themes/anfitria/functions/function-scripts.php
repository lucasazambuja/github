<?php

function theme_register_scripts() {
	
   if(!is_admin()){
        /* JAVASCRIPTS */
        wp_register_script('jquery-javascript', get_bloginfo('template_url') . '/jquery/jquery-1.8.2.js');
        wp_enqueue_script('jquery-javascript');
        
        wp_register_script('jquery-ui-javascript', get_bloginfo('template_url') . '/jquery/jquery-ui-1.9.0.custom.min.js');
        wp_enqueue_script('jquery-ui-javascript');
        
        wp_register_script('jquery-scripts-javascript', get_bloginfo('template_url') . '/jquery/scripts.js');
        wp_enqueue_script('jquery-scripts-javascript');
        
        wp_register_script('ajax-javascript', get_bloginfo('template_url') . '/jquery/ajax.js');
        wp_enqueue_script('ajax-javascript');
        wp_localize_script( 'ajax-javascript', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        
        wp_register_script('jquery-jfacybox-javascript', get_bloginfo('template_url') . '/jquery/jfacybox/facybox.js');
        wp_enqueue_script('jquery-jfacybox-javascript');
        
   }
   
}

add_action('init', 'theme_register_scripts');

function admin_theme_register_scripts() {
	
		wp_register_script('jquery-javascript', get_bloginfo('template_url') . '/jquery/jquery-1.8.2.js');
        wp_enqueue_script('jquery-javascript');
        
        wp_register_script('jquery-ui-javascript', get_bloginfo('template_url') . '/jquery/jquery-ui-1.9.0.custom.min.js');
        wp_enqueue_script('jquery-ui-javascript');
	
        wp_register_script('jquery-galerry-javascript', get_bloginfo('template_url') . '/jquery/galerry/galerry.js');
        wp_enqueue_script('jquery-galerry-javascript');
        
        wp_register_script('ajax-admin-javascript', get_bloginfo('template_url') . '/jquery/ajax-admin.js');
        wp_enqueue_script('ajax-admin-javascript');
        wp_localize_script( 'ajax-admin-javascript', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        
}

add_action( 'admin_enqueue_scripts', 'admin_theme_register_scripts' );

?>