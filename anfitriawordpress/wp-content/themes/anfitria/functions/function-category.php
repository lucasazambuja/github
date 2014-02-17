<?php
    
function register_categoria(){
    global $post;
    $query = array('post_type' => 'page');
    query_posts($query);

    if (have_posts()) : while (have_posts()) : the_post();    
    
        if (!term_exists( $post->post_name, 'category')){
            
                wp_insert_term(
                        $post->post_title,
                        'category',
                        array('slug' => $post->post_name)
               );
        }
    endwhile; endif;
}

add_action('publish_page','register_categoria');
?>
