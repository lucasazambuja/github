<?php

register_nav_menu( 'main-menu', __('Main Menu') );

register_sidebar( array(
	'name'          => __( 'My Sidebar' ),
	'id'            => 'sidebar-1',
	'class'			=> 'sidebar',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>')
);

register_sidebar( array(
	'name'          => __( 'My Sidebar Footer' ),
	'id'            => 'sidebar-2',
	'class'			=> 'sidebar',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>')
);

add_theme_support( 'post-thumbnails' );

$includes = array(
    'functions/function-like.php',
    'widgets/widgets.php',
    'functions/function-banner.php',
    'functions/function-category.php',
    'functions/function-comments.php',
    'functions/function-scripts.php',
    'functions/function-posttypes.php',
    'functions/function-styles.php',
    'functions/function-meta.php',
    'functions/function-taxonomy.php',
    'functions/function-contato.php'
);

foreach ($includes as $i) {
    locate_template($i, true);
}

function theDate($format = 'd/m/Y', $id = null) {
	global $post;
	$id = (!$id) ? $post->ID : $id;
	echo get_the_time($format, $post->ID);
}

function mounthName($monthnum) {
	
	switch( $monthnum ) :
		
	            case '01':
	                return 'Janeiro';
	                break;
	            case '02':
	                return 'Fevereiro';
	                break;
	            case '03':
	                return 'Mar�o';
	                break;
	            case '04':
	                return 'Abril';
	                break;
	            case '05':
	                return 'Maio';
	                break;
	            case '06':
	                return 'Junho';
	                break;
	            case '07':
	                return 'Julho';
	                break;
	            case '08':
	                return 'Agosto';
	                break;
	            case '09':
	                return 'Setembro';
	                break;
	            case '10':
	                return 'Outubro';
	                break;
	            case '11':
	                return 'Novembro';
	                break;
	            case '12':
	                return 'Dezembro';
	                break;
	endswitch;
	
}

function theCountComments($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$args = array(
		'order' => 'DESC',
		'parent' => 0,
		'post_id' => $postID,
		'count' => true
	);
	
	$num = get_comments( $args );
	
	switch ($num) :
		
		case 0:
			echo 'Comente';
		break;
		
		case 1:
			echo '1 Comentário';
		break;
		
		default:
       		echo $num . ' Comentários';
		
	endswitch;
	
}

function getComments($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID: $post->ID;
	
	$paged = (get_query_var('cpage')) ? get_query_var('cpage') : 1;
	
	$args = array (
		'parent'         => 0,
		'status'         => 'approve',
		'type'           => 'comment',
		'number'         => get_option('comments_per_page'),
		'offset'         => $paged - 1,
		'order' 		 => 'DESC',
		'post_id'        => $postID
	);
	
	$comment_query = new WP_Comment_Query;
	$comments = $comment_query->query( $args );
	
	return $comments;
	
}

function pageComments($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID: $post->ID;
	
	$args = array (
		'parent'         => 0,
		'status'         => 'approve',
		'type'           => 'comment',
		'post_id'        => $postID,
		'count'			 => true
	);
	
	$count = get_comments( $args );

}

function theHomeUrl($string = '/') {
	echo esc_url( home_url( $string ) );
}

function getReplyComment($commentID) {
	
	$args = array (
		'parent'         => $commentID,
		'status'         => 'approve',
		'type'           => 'comment'
	);
	
	$comment_query = new WP_Comment_Query;
	$comments = $comment_query->query( $args );
	
	return $comments[0];
	
}

function getMenu($termName) {
	
	// WP_Query arguments
	$args = array (
		'post_type'              => 'menus',
		'post_status'            => 'publish',
		'order' 				 => 'ASC',
		'posts_per_page'         => '100',
		'tax_query' => array(
				array(
					'taxonomy' => 'categorymenus',
					'field' => 'slug',
					'terms' => $termName
				))
	);

	// return The Query
	return new WP_Query( $args );
	
}

function getBanners() {
	
	// WP_Query arguments
	$args = array (
		'post_type'              => 'banners',
		'post_status'            => 'publish',
		'order' 				 => 'DESC',
		'posts_per_page'         => '1'
	);

	// return The Query
	return new WP_Query( $args );
	
}

function theUrlThumbFull($postID = null) {
	
	global $post;
	
	$postID = (!$postID) ? $post->ID : $postID;
	$thumb_id = get_post_thumbnail_id($postID);
	
	$thumb_url = wp_get_attachment_image_src($thumb_id, false);
	echo esc_url ($thumb_url[0]);
	
}

function getUrlThumbFull($postID = null) {

	global $post;
	
	$postID = (!$postID) ? $post->ID : $postID;
	$thumb_id = get_post_thumbnail_id($postID);
	
	$thumb_url = wp_get_attachment_image_src($thumb_id, false);
	return esc_url ($thumb_url[0]);
	
}

function theLinkMenu($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$value = get_post_meta( $postID, 'link_value_key', true );
	
	if ( (is_numeric($value) && $value != 0) || preg_match("/^category-[0-9]+$/", $value) ) :
		
		if (is_numeric($value) && $value != 0) :
		
			$postMenu = get_post($value);
			echo '<li class="collum"><div class="center center-page" style="background: url(\'' . getUrlThumbFull() . '\') no-repeat center top;"><a href="' . get_permalink( $postMenu->ID ) . '" class="menu-icon-title" >' .  get_the_title() . '</a></div></li>';
			
		else :
		
			$termMenu = getTerm($value);
			$termchildren = getTermChildren( $termMenu->term_id, 'category' );
			
			if ($termchildren) :
			
				echo '<li class="sub">';				
				echo '<div class="center"><a href="' . get_term_link( $termMenu, 'category' ) . '">' . getTitleMenu($post->post_title) . '</a><img src="' . getUrlThumbFull() . '"><div class="image-menu-mask"></div></div>';
				
				echo '<ul>';
				
				foreach ($termchildren as $child) :
					echo '<li class="sub-item"><div class="sub-center"><a href="' . get_term_link( $child, 'category' ) . '">' . $child->name . '</a></div></li>';
				endforeach;
				
				echo '</ul>';
				echo '</li>';
			
			else :
			
				echo '<li class="collum"><div class="center"><a href="' . get_term_link( $termMenu, 'category' ) . '">' . getTitleMenu($post->post_title) . '</a><img src="' . getUrlThumbFull() . '"><div class="image-menu-mask"></div></div></li>';
				
			endif;
			
		
		endif;
	
	else :
	
	endif;
	
}

function getTitleMenu($string) {
		
	$vars = explode(' ', $string);
	
	$max = sizeof($vars);
	
	for ( $i=0; $i<$max - 1; $i++ )
	
		if ( strlen($vars[$i+1]) > 3 )
			$vars[$i] = $vars[$i] . '<br>';
		
	return implode(' ', $vars);
	
}

function getTerm($value) {
	
	$id = preg_replace('/^category-([0-9]+)$/', '${1}', $value);
	return get_term($id, 'category');
	
}

function getTermChildren($termID, $taxonomy) {

	$args = array(
	    'fields'        => 'all',
		'hide_empty' 	=> 0,
		'parent'		=> $termID
	); 
	
	return get_terms( $taxonomy, $args );
	
}

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   comment_text();
   if ($depth)
   	echo '<div>' . $depth->comment_content . '</div>';
}

function getServerName($link) {
	
	$expres = '/^http:\/\/(www.)?youtube.com(.+)$/';
	
	if (preg_match($expres, $link))
		return 'youtube';

	$expres = '/^http:\/\/(www.)?vimeo.com(.+)$/';	
		
	if (preg_match($expres, $link))
		return 'vimeo';	
		
	return false;
		
}

function getLinkIframe($link) {
	
	if(getServerName($link) == 'youtube') {
		
		$pattern = '/^http:\/\/www.youtube.com\/watch\?v=(.+)$/';
		$replacement = '//www.youtube.com/embed/${1}?autoplay=1';
	    return preg_replace($pattern, $replacement, $link);
		
	}
	
	if(getServerName($link) == 'vimeo') {
		
		$pattern = '/^http:\/\/vimeo.com\/(.+)$/';
		$replacement = '//player.vimeo.com/video/${1}?badge=0&autoplay=1';
	    return preg_replace($pattern, $replacement, $link);
		
	}
		
}

function getThumbVideo($link) {

	if(getServerName($link) == 'youtube') {
		
		$pattern = '/^http:\/\/www.youtube.com\/watch\?v=(.+)$/';
		$replacement = 'http://img.youtube.com/vi/${1}/0.jpg';
	    return preg_replace($pattern, $replacement, $link);
		
	}
	
	if(getServerName($link) == 'vimeo') {
		
		$pattern = '/^http:\/\/vimeo.com\/(.+)$/';
		$replacement = 'http://vimeo.com/api/v2/video/${1}.php';
	    $hash = unserialize( file_get_contents(preg_replace($pattern, $replacement, $link)) );
		return $hash[0]["thumbnail_large"];
		
	}
	
	return false;
	
}

function theLinkIframe($postID = null) {
	
	global $post;
	$postID = (!$postID) ? $post->ID : $postID;
	
	$value = get_post_meta( $postID, 'video_link_value_key', true );
	echo esc_url( getLinkIframe($value) );
	
}

function theThumbVideo($postID = null) {
	
	global $post;
	$postID = (!$postID) ? $post->ID : $postID;
	
	$value = get_post_meta( $postID, 'video_link_value_key', true );
	echo esc_url( getThumbVideo($value) );
	
}

function getVideos() {
	
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	
	$args = array (
		'post_type'              => 'video',
		'post_status'            => 'publish',
		'order' 				 => 'ASC',
		'paged' 				 => $paged,
		'posts_per_page'         => '10'
	);
	
    	query_posts($args);
    
}

function theLinkPostMovie($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$id = get_post_meta( $postID, 'link_value_key', true );
	$postLink = get_post($id);
	echo esc_url(get_permalink( $postLink->ID ));
	
}

function theCase($postID = null) {
	
	echo getCase($postID);
	
}

function getCase($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$onePost = get_post($postID);
	
	$array = explode('<p>&nbsp;</p>', $onePost->post_content);
	
	foreach($array as $one) {
	
		$pattern = '/<img/i';
		
		if (preg_match($pattern, $one))
			return $one;
	
	}

}

function vardumpCase($postID = null) {
	
	global $post;
	$postID = ($postID) ? $postID : $post->ID;
	
	$onePost = get_post($postID);
	
	$array = explode('src="', $onePost->post_content);
	$loop = count($array);
	
	for ($i=1;$i<$loop;$i++) :
	
		$url = explode('"', $array[$i]);
		echo "image {$i} " . $url[0] . "<br/>";

	endfor;

}

function getArchiveMonth() {
	
    	global $query_string;
    	query_posts( $query_string . '&posts_per_page=5' );
    
}

function get_custom_permalink_comment($wp_query, $comment) {
	
	global $post;
	
	$permalink = get_option('home');
	$category_name = get_query_var('category_name');
	
	$permalink = ($category_name) ? $permalink . '/category/' . $wp_query->query['category_name'] : $permalink;
	
	$array = array( 'postid' => $post->ID, 'comment' => 'active' );
	
	if ($comment == false)
		$array = array( 'postid' => $post->ID );
	
	$permalink = get_custom_permalink( $array, $permalink . '/' );
	
	$paged = get_query_var('paged');
	
	$permalink = ($paged) ? $permalink . '/page/' . $paged . '/' : $permalink;
	
	return $permalink;
	
	
}

function get_custom_permalink($arr_params, $permalink = '') {
	
	$permalink = add_query_arg($arr_params, $permalink);
		
	$permalink = str_replace('?', '', $permalink);
	$permalink = str_replace('&', '/', $permalink);
	
	foreach ($arr_params as $key => $value) :
	
		$pattern = '/' . $key . '=([a-z0-9])/';
		$replacement = $key . '/$1';
		$permalink = preg_replace($pattern, $replacement, $permalink);
	
	endforeach;
	
	return $permalink;
}

function the_custom_permalink_comment($wp_query, $comment = true) {

	echo get_custom_permalink_comment( $wp_query, $comment);
	
}

function the_custom_permalink_post($wp_query){
	
	the_custom_permalink_comment($wp_query, false);
	
}

function add_my_rule() {
    
	global $wp; 
	
	$wp->add_query_var('post_open');
	$wp->add_query_var('comment'); 
	  
	add_rewrite_rule('postid/([0-9]+)/comment/(active)/?$','index.php?post_open=$matches[1]&comment=$matches[2]','top');
	add_rewrite_rule('postid/([0-9]+)/comment/(active)/page/([0-9]+)/?$','index.php?paged=$matches[3]&post_open=$matches[1]&comment=$matches[2]','top');
	add_rewrite_rule('category/(.+)/postid/([0-9]+)/comment/(active)/?$','index.php?category_name=$matches[1]&post_open=$matches[2]&comment=$matches[3]','top');
	add_rewrite_rule('category/(.+)/postid/([0-9]+)/comment/(active)/page/([0-9]+)/?$','index.php?category_name=$matches[1]&paged=$matches[4]&post_open=$matches[2]&comment=$matches[3]','top');
	add_rewrite_rule('category/.+/(.+)/postid/([0-9]+)/comment/(active)/?$','index.php?category_name=$matches[1]&post_open=$matches[2]&comment=$matches[3]','top');
	add_rewrite_rule('category/.+/(.+)/postid/([0-9]+)/comment/(active)/page/([0-9]+)/?$','index.php?category_name=$matches[1]&paged=$matches[4]&post_open=$matches[2]&comment=$matches[3]','top');
	
	add_rewrite_rule('postid/([0-9]+)/?$','index.php?post_open=$matches[1]','top');
	add_rewrite_rule('postid/([0-9]+)/page/([0-9]+)/?$','index.php?paged=$matches[2]&post_open=$matches[1]','top');
	add_rewrite_rule('category/(.+)/postid/([0-9]+)/?$','index.php?category_name=$matches[1]&post_open=$matches[2]','top');
	add_rewrite_rule('category/(.+)/postid/([0-9]+)/page/([0-9]+)/?$','index.php?category_name=$matches[1]&paged=$matches[3]&post_open=$matches[2]','top');
	add_rewrite_rule('category/.+/(.+)/postid/([0-9]+)/?$','index.php?category_name=$matches[1]&post_open=$matches[2]','top');
	add_rewrite_rule('category/.+/(.+)/postid/([0-9]+)/page/([0-9]+)/?$','index.php?category_name=$matches[1]&paged=$matches[3]&post_open=$matches[2]','top');
	
	global $wp_rewrite;
	
	$wp_rewrite->flush_rules();
    
}

add_action('init', 'add_my_rule');

?>