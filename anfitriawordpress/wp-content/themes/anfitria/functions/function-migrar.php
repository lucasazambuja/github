<?php

function migrar_comment(){
    
       $hostname_BLOG_MATRIZ = "localhost";
        $database_BLOG_MATRIZ = "anfitria_bloganfitria";
        $username_BLOG_MATRIZ = "anfitria_blog";
        $password_BLOG_MATRIZ = "B@b1l0ni4";
        $BLOG_MATRIZ = mysql_connect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ); 
        mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
       	  $post_id = $_GET['id'];
         
         $result = mysql_query("SELECT * FROM `anfitria_bloganfitria`.`posts` where post_id = ".$_GET['postid']." LIMIT 1");
          
	global $wpdb;
	
 while($row = mysql_fetch_array($result)){
          $content = str_replace('src="../uploads/', 'src="http://www.anfitria.com.br/uploads/', $row['post_texto']);
          $content = iconv('latin1','utf8', $content);
          $content = substr($content, 0, 150);
          
          $posts = $wpdb->get_results('SELECT * FROM wp_posts WHERE post_content like \''.$content.'%\' and post_date = \''.$row['post_data'].' 00:00:00\' and post_status = \'publish\' LIMIT 1');
	}
	
	foreach($posts as $unpost){$postid = $unpost->ID;}
	
	echo '<br>';
	$result = mysql_query("SELECT * FROM comments WHERE comment_post = ".$_GET['postid']." and comment_status = 1 ORDER BY comment_id  ASC");
	while($row = mysql_fetch_array($result)){
	   // echo '<br>' . $row['comment_id'];
	    $comment_content = iconv('latin1','utf8',$row['comment_texto']);
	    $comment_content = substr($comment_content, 0, 50);
	    echo $comment_content . '<br>';
	    $comments = $wpdb->get_var('SELECT * FROM wp_comments WHERE comment_approved = 1 and comment_post_ID = ' . $postid. ' and comment_content like \''.$comment_content.'%\'');
	     if($comments == NULL){
	       
                  $data = array(
                    'comment_post_ID' => $postid,
                    'comment_author' => iconv('latin1','utf8',$row['comment_nome']),
                    'comment_author_email' => $row['comment_mail'],
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$row['comment_texto']) . ' - '. iconv('latin1','utf8',$row['comment_nome']),
                    'comment_type' => '',
                    'comment_parent' => 0,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => $comment['comment_status']
                );

        $parent_id = wp_insert_comment($data);

              if ($comment['comment_resposta'] != NULL){
                  $data = array(
                    'comment_post_ID' => $postid,
                    'comment_author' => 'Priscilla Marques',
                    'comment_author_email' => 'admin@admin.com',
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$row['comment_resposta']),
                    'comment_type' => '',
                    'comment_parent' => $parent_id,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => 1
                );
                wp_insert_comment($data);
              }
	     
	     }
	}
        
}

function migrar_full_comment(){
    
       $hostname_BLOG_MATRIZ = "localhost";
        $database_BLOG_MATRIZ = "anfitria_bloganfitria";
        $username_BLOG_MATRIZ = "anfitria_blog";
        $password_BLOG_MATRIZ = "B@b1l0ni4";
        $BLOG_MATRIZ = mysql_connect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ); 
        mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
       	  $post_id = $_GET['id'];
         
         $result = mysql_query("SELECT * FROM `anfitria_bloganfitria`.`posts` where post_id > ".$_GET['postid']);
          
	global $wpdb;
	
 while($row = mysql_fetch_array($result)){
          $content = str_replace('src="../uploads/', 'src="http://www.anfitria.com.br/uploads/', $row['post_texto']);
          $content = iconv('latin1','utf8', $content);
          $content = substr($content, 0, 150);
          
          $posts = $wpdb->get_results('SELECT * FROM wp_posts WHERE post_content like \''.$content.'%\' and post_date = \''.$row['post_data'].' 00:00:00\' LIMIT 1');
	}
	
	foreach($posts as $unpost){$postid = $unpost->ID;}
	
	echo '<br>';
	$result = mysql_query("SELECT * FROM comments WHERE comment_post = ".$_GET['postid']." and comment_status = 1 ORDER BY comment_id  ASC");
	while($row = mysql_fetch_array($result)){
	   // echo '<br>' . $row['comment_id'];
	    $comment_content = iconv('latin1','utf8',$row['comment_texto']);
	    $comment_content = substr($comment_content, 0, 100);
	    echo $comment_content . '<br>';
	    $comments = $wpdb->get_var('SELECT * FROM wp_comments WHERE comment_approved = 1 and comment_post_ID = ' . $postid. ' and comment_content like \''.$comment_content.'%\'');
	     if($comments == NULL){
	       
                  $data = array(
                    'comment_post_ID' => $postid,
                    'comment_author' => iconv('latin1','utf8',$row['comment_nome']),
                    'comment_author_email' => $row['comment_mail'],
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$row['comment_texto']) . ' - '. iconv('latin1','utf8',$row['comment_nome']),
                    'comment_type' => '',
                    'comment_parent' => 0,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => $comment['comment_status']
                );

        $parent_id = wp_insert_comment($data);

              if ($comment['comment_resposta'] != NULL){
                  $data = array(
                    'comment_post_ID' => $postid,
                    'comment_author' => 'Priscilla Marques',
                    'comment_author_email' => 'admin@admin.com',
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$row['comment_resposta']),
                    'comment_type' => '',
                    'comment_parent' => $parent_id,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => 1
                );
                wp_insert_comment($data);
              }
	     
	     }
	}
        
}

function migrar(){
    global $wpdb;
        $hostname_BLOG_MATRIZ = "localhost";
        $database_BLOG_MATRIZ = "anfitria_bloganfitria";
        $username_BLOG_MATRIZ = "anfitria_misterx";
        $password_BLOG_MATRIZ = "102030x";
        $BLOG_MATRIZ = mysql_connect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ); 
        mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

        $result = mysql_query("SELECT * FROM `anfitria_bloganfitria`.`posts` where post_id = ".$_GET['postid']." LIMIT 1");

        while($row = mysql_fetch_array($result)){
          $title = iconv('latin1','utf8',$row['post_titulo']);
          $content = str_replace('src="../uploads/', 'src="http://www.anfitria.com.br/uploads/', $row['post_texto']);
          $content = iconv('latin1','utf8', $content);
          // echo $content;

          if ($row['post_status'] == '1'){
              $post_status  = 'publish';
          } else {
              $post_status = 'draft';
          }
          if ($row['post_sub'] == NULL){
              
                $category_result = mysql_query("SELECT `cat_nome` FROM `categoria` where `cat_id` = ".$row['post_cat']);
                $category_name = mysql_fetch_row($category_result);
                $slug = sanitize_title($category_name[0]);
                $termid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($termid == NULL){$termid=1;}
              
                $category = array($termid);
//              $category_exibe = $category[0];
          } else {
                $subcategory_result = mysql_query("SELECT sub_nome FROM subcategoria where sub_id = ".$row['post_sub']);
                $subcategory_name = mysql_fetch_row($subcategory_result);
                $slug = sanitize_title($subcategory_name[0]);
                $subtermid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($subtermid == NULL){$subtermid=0;}
                
                $category_result = mysql_query("SELECT `cat_nome` FROM `categoria` where `cat_id` = ".$row['post_cat']);
                $category_name = mysql_fetch_row($category_result);
                $slug = sanitize_title($category_name[0]);
                $termid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($termid == NULL){$termid=1;}
                
                $category = array($termid,$subtermid);
//              $category_exibe = $category[0] . " " . $category[1];
          }

            $my_post = array(
          'post_title'    => $title,
          'post_content'  => $content,
          'post_date'     => $row['post_data'] . ' 00:00:00',
          'post_status'   => $post_status,
          'post_author'   => 1,
          'post_category' => $category
        );

        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );

          $results = mysql_query("SELECT * FROM `comments` WHERE `comment_post` = ".$row['post_id']);
          while($comment = mysql_fetch_assoc($results)){

                  $data = array(
                    'comment_post_ID' => $post_id,
                    'comment_author' => iconv('latin1','utf8',$comment['comment_nome']),
                    'comment_author_email' => $comment['comment_mail'],
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$comment['comment_texto']) . ' - '. iconv('latin1','utf8',$comment['comment_nome']),
                    'comment_type' => '',
                    'comment_parent' => 0,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => $comment['comment_status']
                );

        $parent_id = wp_insert_comment($data);

              if ($comment['comment_resposta'] != NULL){
                  $data = array(
                    'comment_post_ID' => $post_id,
                    'comment_author' => 'Priscilla Marques',
                    'comment_author_email' => 'admin@admin.com',
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$comment['comment_resposta']),
                    'comment_type' => '',
                    'comment_parent' => $parent_id,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => 1
                );
                wp_insert_comment($data);
              }
          }
add_register_like($post_id, $row['post_tags']);
        }

        mysql_close($BLOG_MATRIZ);
return $post_id;
}

function migrar_ma(){
    global $wpdb;
        $hostname_BLOG_MATRIZ = "localhost";
        $database_BLOG_MATRIZ = "anfitria_bloganfitria";
        $username_BLOG_MATRIZ = "anfitria_misterx";
        $password_BLOG_MATRIZ = "102030x";
        $BLOG_MATRIZ = mysql_connect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ); 
        mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

        $result = mysql_query("SELECT * FROM `anfitria_bloganfitria`.`posts` where post_id > ".$_GET['postid']." LIMIT 1");

        while($row = mysql_fetch_array($result)){
          $title = iconv('latin1','utf8',$row['post_titulo']);
          $content = str_replace('src="../uploads/', 'src="http://www.anfitria.com.br/uploads/', $row['post_texto']);
          $content = iconv('latin1','utf8', $content);
          // echo $content;

          if ($row['post_status'] == '1'){
              $post_status  = 'publish';
          } else {
              $post_status = 'draft';
          }
          if ($row['post_sub'] == NULL){
              
                $category_result = mysql_query("SELECT `cat_nome` FROM `categoria` where `cat_id` = ".$row['post_cat']);
                $category_name = mysql_fetch_row($category_result);
                $slug = sanitize_title($category_name[0]);
                $termid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($termid == NULL){$termid=1;}
              
                $category = array($termid);
//              $category_exibe = $category[0];
          } else {
                $subcategory_result = mysql_query("SELECT sub_nome FROM subcategoria where sub_id = ".$row['post_sub']);
                $subcategory_name = mysql_fetch_row($subcategory_result);
                $slug = sanitize_title($subcategory_name[0]);
                $subtermid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($subtermid == NULL){$subtermid=0;}
                
                $category_result = mysql_query("SELECT `cat_nome` FROM `categoria` where `cat_id` = ".$row['post_cat']);
                $category_name = mysql_fetch_row($category_result);
                $slug = sanitize_title($category_name[0]);
                $termid = $wpdb->get_var('SELECT term_id FROM '.$wpdb->prefix.'terms where slug = "'.$slug.'"');
                if ($termid == NULL){$termid=1;}
                
                $category = array($termid,$subtermid);
//              $category_exibe = $category[0] . " " . $category[1];
          }

            $my_post = array(
          'post_title'    => $title,
          'post_content'  => $content,
          'post_date'     => $row['post_data'] . ' 00:00:00',
          'post_status'   => $post_status,
          'post_author'   => 1,
          'post_category' => $category
        );

        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );

          $results = mysql_query("SELECT * FROM `comments` WHERE `comment_post` = ".$row['post_id']);
          while($comment = mysql_fetch_assoc($results)){

                  $data = array(
                    'comment_post_ID' => $post_id,
                    'comment_author' => iconv('latin1','utf8',$comment['comment_nome']),
                    'comment_author_email' => $comment['comment_mail'],
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$comment['comment_texto']) . ' - '. iconv('latin1','utf8',$comment['comment_nome']),
                    'comment_type' => '',
                    'comment_parent' => 0,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => $comment['comment_status']
                );

        $parent_id = wp_insert_comment($data);

              if ($comment['comment_resposta'] != NULL){
                  $data = array(
                    'comment_post_ID' => $post_id,
                    'comment_author' => 'Priscilla Marques',
                    'comment_author_email' => 'admin@admin.com',
                    'comment_author_url' => 'http://',
                    'comment_content' => iconv('latin1','utf8',$comment['comment_resposta']),
                    'comment_type' => '',
                    'comment_parent' => $parent_id,
                    'user_id' => 2,
                    'comment_author_IP' => '',
                    'comment_agent' => '',
                    'comment_approved' => 1
                );
                wp_insert_comment($data);
              }
          }
add_register_like($post_id, $row['post_tags']);
        }

        mysql_close($BLOG_MATRIZ);
return $post_id;
}
if(isset($_GET['migrar'])){
    migrar();?><script type="text/javascript">//document.location="http://localhost/anfitriablog/wp-admin/edit.php";</script><?php
}

if(isset($_GET['migrarma'])){
    migrar_ma();?><script type="text/javascript">//document.location="http://localhost/anfitriablog/wp-admin/edit.php";</script><?php
}

if(isset($_GET['migrarcomment'])){
    migrar_comment();?><script type="text/javascript">//document.location="http://localhost/anfitriablog/wp-admin/edit.php";</script><?php
}

if(isset($_GET['migrarfullcomment'])){
    migrar_full_comment();?><script type="text/javascript">//document.location="http://localhost/anfitriablog/wp-admin/edit.php";</script><?php
}
?>