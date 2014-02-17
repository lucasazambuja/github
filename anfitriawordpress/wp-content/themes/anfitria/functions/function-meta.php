<?php

function myplugin_add_custom_box() {

    $screens = array( 'menus' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $args = array(
	'posts_per_page'   => 100,
	'orderby'          => 'title',
	'order'            => 'DESC',
	'post_type'        => 'page',
  );
  
  $getPosts = get_posts($args);
  
  $args = array(
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'    		   => '0'
  );
  
  $getCategories = get_categories( $args );
    
  $value = get_post_meta( $post->ID, 'link_value_key', true );
  
	if (!$value) :
	
		echo '<p>';
		echo '<label for="myplugin_new_field">';
		       _e( "Informe seu Link", 'myplugin_textdomain' );
		echo '</label> ';
		  
		echo '<input type="text" style="width:100%;" id="myplugin_new_field" name="myplugin_new_field" value="" size="25" />';
		echo '</p>';
		  
		echo '<p>';
		echo '<label for="myplugin_new_field_select">';
		       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
		echo '</label> ';
		  
		echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
		echo '<option value="0">NULL</option>';
		  
		foreach ($getPosts as $getPost)
			echo '<option value="' . $getPost->ID . '">' . $getPost->post_title . '</option>';
			
		foreach ($getCategories as $getCategorie)
			echo '<option value="category-' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
		  	
		echo '</select>';
		echo '</p>';

	else :
	
		if ( (is_numeric($value) && $value != 0) || preg_match("/^category-[0-9]+$/", $value) ) :
		
		
			if (is_numeric($value) && $value != 0) :
				$getPage = get_post($value);
				$optionTitle = $getPage->post_title;
			else :
				$termID = preg_replace('/^category-([0-9]+)$/', '${1}', $value);
				$term = get_term( $termID, 'category');
				$optionTitle = $term->name;
			endif;
		
			echo '<p>';
			echo '<label for="myplugin_new_field">';
			       _e( "Informe seu Link", 'myplugin_textdomain' );
			echo '</label> ';
			  
			echo '<input type="text" style="width:100%;" id="myplugin_new_field" name="myplugin_new_field" value="" size="25" />';
			echo '</p>';
			
			echo '<p>';
			echo '<label for="myplugin_new_field_select">';
			       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
			echo '</label> ';
			  
			echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
			echo '<option value="' . $value . '">' . $optionTitle . '</option>';
			  
			foreach ($getPosts as $getPost)
				echo '<option value="' . $getPost->ID . '">' . $getPost->post_title . '</option>';
				
			foreach ($getCategories as $getCategorie)
				echo '<option value="category-' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
			  	
			echo '</select>';
			echo '</p>';
		
		else :
		
			echo '<p>';
			echo '<label for="myplugin_new_field">';
			       _e( "Informe seu Link", 'myplugin_textdomain' );
			echo '</label> ';
			  
			echo '<input type="text" style="width:100%;" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr($value) . '" size="25" />';
			echo '</p>';
			
			echo '<p>';
			echo '<label for="myplugin_new_field_select">';
			       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
			echo '</label> ';
			  
			echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
			echo '<option value="0">NULL</option>';
			  
			foreach ($getPosts as $getPost)
				echo '<option value="' . $getPost->ID . '">' . $getPost->post_title . '</option>';
				
			foreach ($getCategories as $getCategorie)
				echo '<option value="category-' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
			  	
			echo '</select>';
			echo '</p>';
			
		endif;
		
	endif;

}

function save_link_meta ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
    	return $post_id;
	
	$mydata = (!empty($_POST['myplugin_new_field'])) ? $_POST['myplugin_new_field'] : $_POST['myplugin_new_field_select'];
	update_post_meta( $post_id, 'link_value_key', $mydata );
	
}

add_action( 'save_post', 'save_link_meta' );




function myplugin_add_custom_description() {

    $screens = array( null );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_description',
            $screen
        );
    }
}

// add_action( 'add_meta_boxes', 'myplugin_add_custom_description' );

function myplugin_inner_custom_description( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_description', 'myplugin_inner_custom_description_nonce' );
  $value = get_post_meta( $post->ID, 'description_value_key', true );
  
  echo '<label for="description">';
	_e( "Informe Descricao", 'myplugin_textdomain' );
  echo '</label> ';
			  
  echo '<textarea id="description" name="description" style="width:100%;">' . esc_attr( $value ) . '</textarea>';
  
}

function save_description_meta ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_description_nonce'] ) )
    	return $post_id;
	
	$mydata = sanitize_text_field( $_POST['description'] );
	update_post_meta( $post_id, 'description_value_key', $mydata );
	
}

add_action( 'save_post', 'save_description_meta' );




function myplugin_add_custom_link_text() {

    $screens = array( 'links', 'patrocinio' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_link_text',
            $screen
        );
    }
}

add_action( 'add_meta_boxes', 'myplugin_add_custom_link_text' );

function myplugin_inner_custom_link_text( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_link_text', 'myplugin_inner_custom_link_text_nonce' );
  $value = get_post_meta( $post->ID, 'link_text_value_key', true );
  
  echo '<label for="link_text">';
	_e( "Informe a url", 'myplugin_textdomain' );
  echo '</label> ';
			  
  echo '<input type="text" id="link_text" name="link_text" style="width:100%;" value="' . esc_attr( $value ) . '">';
  
}

function save_link_text_meta ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_link_text_nonce'] ) )
    	return $post_id;
	
	$mydata = sanitize_text_field( $_POST['link_text'] );
	update_post_meta( $post_id, 'link_text_value_key', $mydata );
	
}

add_action( 'save_post', 'save_link_text_meta' );



function myplugin_add_custom_box_destak() {

    $screens = array( 'destaque' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box_destak',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box_destak' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_inner_custom_box_destak( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_box_destak', 'myplugin_inner_custom_box_destak_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  
  $args = array(
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'    		   => '0'
  );
  
  $getCategories = get_categories( $args );
    
  $value = get_post_meta( $post->ID, 'link_value_key_destak', true );
  
	if (!$value) :
		  
		echo '<p>';
		echo '<label for="myplugin_new_field_select">';
		       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
		echo '</label> ';
		  
		echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
		echo '<option value="0">NULL</option>';
			
		foreach ($getCategories as $getCategorie)
			echo '<option value="' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
		  	
		echo '</select>';
		echo '</p>';

	else :
			
			echo '<p>';
			echo '<label for="myplugin_new_field_select">';
			       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
			echo '</label> ';
			  
			echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
			echo '<option value="' . $value . '">' . get_term( $value, 'category')->name . '</option>';
				
			foreach ($getCategories as $getCategorie)
				echo '<option value="' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
			  	
			echo '</select>';
			echo '</p>';
		
	endif;

}

function save_link_meta_destak ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_box_destak_nonce'] ) )
    	return $post_id;
	
	$mydata = (!empty($_POST['myplugin_new_field'])) ? $_POST['myplugin_new_field'] : $_POST['myplugin_new_field_select'];
	update_post_meta( $post_id, 'link_value_key_destak', $mydata );
	
}

add_action( 'save_post', 'save_link_meta_destak' );




function myplugin_add_custom_box_video() {

    $screens = array( 'video' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box_video',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box_video' );

function myplugin_inner_custom_box_video( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'myplugin_inner_custom_box_video', 'myplugin_inner_custom_box_video_nonce' );
  $value = get_post_meta( $post->ID, 'video_link_value_key', true );
  
  echo '<label for="video-link">';
	_e( "Informe o link do video", 'myplugin_textdomain' );
  echo '</label> ';
			  
  echo '<input type="text" id="video-link" name="video-link" style="width:100%;" value="' . esc_attr($value) . '"/>';
  
  $args = array(
	'posts_per_page'   => 10000,
	'orderby'          => 'title',
	'order'            => 'ASC'
  );
  
  $getPosts = get_posts($args);
  $value = get_post_meta( $post->ID, 'link_value_key', true );
  
	echo '<p>';
	echo '<label for="myplugin_new_field_select">';
	       _e( "Selecione uma Pagina", 'myplugin_textdomain' );
	echo '</label> ';
	  
	echo '<select style="width:100%;" id="myplugin_new_field_select" name="myplugin_new_field_select">';
	echo (!$value) ? '' : '<option value="' . $value . '">' . get_post($value)->post_title . '</option>';
	echo '<option value="0">NULL</option>';
	  
	foreach ($getPosts as $getPost)
		echo '<option value="' . $getPost->ID . '">' . $getPost->post_title . '</option>';
		
	foreach ($getCategories as $getCategorie)
		echo '<option value="category-' . $getCategorie->term_id . '">' . $getCategorie->name . '</option>';
	  	
	echo '</select>';
	echo '</p>';
  
  
}

function save_video_meta ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_box_video_nonce'] ) )
    	return $post_id;
	
	$mydata = sanitize_text_field( $_POST['video-link'] );
	update_post_meta( $post_id, 'video_link_value_key', $mydata );
	
	$mydata = $_POST['myplugin_new_field_select'];
	update_post_meta( $post_id, 'link_value_key', $mydata );
	
}

add_action( 'save_post', 'save_video_meta' );

function myplugin_add_custom_box_gallery() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid_gallery',
            __( 'My Post Section Title', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box_gallery',
            $screen
        );
    }
}

add_action( 'add_meta_boxes', 'myplugin_add_custom_box_gallery' );

function myplugin_inner_custom_box_gallery( $post, $paged = 1, $array = array(null), $is_array = false ) {
	
wp_nonce_field( 'myplugin_inner_custom_box_gallery', 'myplugin_inner_custom_box_gallery_nonce' );
$value = get_post_meta( $post->ID, 'gallery_value_key', true );

global $arrayImagesValues;

if (!$is_array)
	$arrayImagesValues = $value;

if (!$is_array)
	$array = explodegallery($value);

global $arrayImages;
$arrayImages = $array;

$query = array(
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
    'post_status' => 'inherit',
	'posts_per_page' => 20,
	'paged' => $paged
);
	
query_posts($query);

get_template_part('functions/metabox-view/gallery');

}

function save_gallery_meta ( $post_id ) {
	
	if ( ! isset( $_POST['myplugin_inner_custom_box_gallery_nonce'] ) )
    	return $post_id;
	
	$mydata = sanitize_text_field( $_POST['images-gallery'] );
	update_post_meta( $post_id, 'gallery_value_key', $mydata );
	
}

add_action( 'save_post', 'save_gallery_meta' );

function box_gallery_ajax(){
	
	global $post;
	global $arrayImagesValues;
	$paged = $_POST['paged'];
	$array = explodegallery($_POST['ids']);
	$arrayImagesValues = $_POST['ids'];
	myplugin_inner_custom_box_gallery( $post->ID, $paged, $array, true );
	die();
	
}

add_action('wp_ajax_nopriv_box_gallery_ajax', 'box_gallery_ajax');
add_action('wp_ajax_box_gallery_ajax', 'box_gallery_ajax');

function explodegallery($str){
	
	return explode('-', substr($str, 0, -1));
	
}

function theImagesValues() {
	
	global $arrayImagesValues;
	echo esc_attr($arrayImagesValues);
	
}

function getImagesValuesArray() {
	
	global $arrayImagesValues;
	return explodegallery( $arrayImagesValues );
	
}

function getImageArray() {
	
	global $arrayImages;
	
	return array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
	    'post_status' => 'inherit',
		'posts_per_page' => 100,
		'paged' => 1,
		'post__in' => $arrayImages
	);
	
}

function getImagesArrayPost($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$value = get_post_meta( $post->ID, 'gallery_value_key', true );
	return explodegallery($value);
	
}

function getImageUrlModify($src) {
	
	return str_replace("test/anfitriawordpress/", "", $src);
	
}

?>