<?php require_once('../wp-config.php'); 
$hostname_BLOG_MATRIZ = DB_HOST;
$database_BLOG_MATRIZ = DB_NAME;
$username_BLOG_MATRIZ = DB_USER;
$password_BLOG_MATRIZ = DB_PASSWORD;
$BLOG_MATRIZ = mysql_pconnect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php

$resp = $_POST['resposta'];
$email = $_POST['email'];
$voltar = $_POST['voltar'];
$parent = $_POST['post_parent'];

global $wpdb;
$existe = $wpdb->get_var('SELECT comment_ID FROM wp_comments WHERE comment_parent = '. $parent);

if ($existe != NULL){
if ((isset($_POST['post_id'])) && ($_POST['post_id'] != "")) {
    
    $comment = array();
    $comment['comment_ID'] = $existe;
    $comment['comment_content'] = iconv('latin1','utf8',$resp);
    
    wp_update_comment($comment);
}
} else {

if ((isset($_POST['post_id'])) && ($_POST['post_id'] != "")) {
$comentid = $parent;
    
        $data = array(
    'comment_post_ID' => $_POST['post_id'],
    'comment_author' => 'Priscila Marques',
    'comment_author_email' => '',
    'comment_author_url' => '',
    'comment_content' => iconv('latin1','utf8',$resp),
    'comment_type' => '',
    'comment_parent' => $comentid,
    'user_id' => 1,
    'comment_author_IP' => '',
    'comment_agent' => '',
    'comment_approved' => 1
);

wp_insert_comment($data);
}
}
?>
<meta http-equiv="refresh" content="1;URL=<?php echo $voltar;?>" />