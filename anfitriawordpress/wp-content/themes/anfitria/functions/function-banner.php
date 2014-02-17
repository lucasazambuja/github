<?php
function get_banner() {
    $querybanner = array('post_type' => 'banners', 'showposts' => '1');
    query_posts($querybanner);

    if (have_posts()) : while (have_posts()) : the_post();    
   
    $attr = array(
        'class'	=> "banner",
        'alt'	=> "anfitria-banner",
    );
    
     the_post_thumbnail('',$attr ); 
    
    endwhile; endif;
    
    wp_reset_query();
}?>