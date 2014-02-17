<?php

 // add_action( 'init', 'ewp_create_table' );
 
function ewp_create_table() {
    global $wpdb;
  // Acesso ao objeto global de gestão de bases de dados
 
  // Vamos checar se a nova tabela existe
  // A propriedade prefix é o prefixo de tabela escolhido na
  // instalação do WordPress
  $tablename = $wpdb->prefix . 'like';
 
  // Se a tabela não existe vamos criá-la
  if ( $wpdb->get_var( "SHOW TABLES LIKE '$tablename'" ) != $tablename ) {
 
    $sql = 'CREATE TABLE `'.$tablename.'` (
         `id` INT NULL AUTO_INCREMENT,
         `post_id` INT NULL,
         `num_likes` INT NOT NULL,
         `like` INT NOT NULL, PRIMARY KEY (`ID`)
    )';
    
    // Para usarmos a função dbDelta() é necessário carregar este ficheiro
   require_once ABSPATH . 'wp-admin/includes/upgrade.php';
 
    // Esta função cria a tabela na base de dados e executa as otimizações
    // necessárias.
    dbDelta( $sql );
 
  }
 
}

function get_like($post_id){
	
     global $wpdb;
     $like = $wpdb->get_var('SELECT num_likes FROM '.$wpdb->prefix.'like WHERE post_id = '. $post_id);
     $like = ($like) ? $like : 1;
     
     return $like;
     
}

function the_like($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	echo get_like($postID);
	
}

function add_like($post_id){
    global $wpdb;
    $like = get_like($post_id);
    $like = $like + 1;
    
    // Guardar os valores na tabela
    $wpdb->query('UPDATE '. $wpdb->prefix .'like SET num_likes = '. $like .' WHERE post_id = '. $post_id);
}

function register_like(){
    global $wpdb;
    global $post;
    
    $post_id = $post->ID;
    
    
        if (get_like($post_id) == NULL){   

          $new_like = array(
             'post_id' => $post_id,
             'num_likes' => '1',
             'like' => $post_id
           );

           // Guardar os valores na tabela
           $wpdb->insert( $wpdb->prefix . "like", $new_like );
           
        }          
}

add_action( 'wp_insert_post', 'register_like' );

function add_register_like($post_id, $num_likes) {
	
    global $wpdb;
    
        if (get_like($post_id) == NULL){   

          $new_like = array(
             'post_id' => $post_id,
             'num_likes' => $num_likes,
             'like' => $post_id
           );

           // Guardar os valores na tabela
           $wpdb->insert( $wpdb->prefix . "like", $new_like );
           
        }
        
}

function add_like_jquery(){

        add_like($_POST['idpost']);
        die();
}

add_action('wp_ajax_nopriv_add_like_jquery', 'add_like_jquery');
add_action('wp_ajax_add_like_jquery', 'add_like_jquery');

?>