<?php
require_once '../wp-config.php';

 // global $wpdb;
 // $wpdb->query('DELETE FROM '. $wpdb->prefix .'comments WHERE comment_content like \'%[url=htttp://%\'');

if (is_user_logged_in() == NULL){
    header('location: '.get_option('siteurl').'/admarea');
}

head_comments();

if($_GET['tipo'] == 'ts')
{get_comments_admarea();}

if($_GET['tipo'] == 'na')
{get_comments_no_aproved_admarea();}

if($_GET['tipo'] == 'sr')
{comments_rs();}

if($_GET['tipo'] == 'nr')
{get_comments_aproved_no_rs_admarea();}

echo '<script>comment_admarea();</script>';

function head_comments(){?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
                <link rel="stylesheet" href="<?php echo get_option('siteurl');?>/admarea/style/comment.css" type="text/css" media="all" />
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta http-equiv="content-language" content="<?php bloginfo( 'language' ); ?>" />
	
                <title>comments admarea</title>
                <?php wp_head();?>
                <script type="text/javascript" src="js/comment.js"></script>
	</head>
<?php }


function comments_admarea($busca){
  $result .= '<table width="80%" height="67" border="0" align="center" cellpadding="5" cellspacing="5"><tbody>';
  $result .= '<tr>';
  $result .= '<td width="20%" align="center" bgcolor="#CCCCCC" class="maisculas"><a href="?tipo=nr&pagina=1" id="comments-nr">Ativos  não respondidos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#999999" class="maisculas"><a href="?tipo=na&pagina=1" id="comments-na">Somente os não ativos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#666666" class="maisculas"><a href="?tipo=sr&pagina=1" id="comments-sr">Somente os respondidos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#F7F7F7" class="maisculas"><a href="?tipo=ts&pagina=1" id="comments-ts">TODOS</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#F7F7F7" class="maisculas"><a href="#" id="comments-exc-varios">excluir varios</a></td>';
  $result .= '</tr>';
  $result .= '</tbody></table>';
  
  global $wpdb;
  $total_reg = "20";
  $pagina = $_GET['pagina'];
  
  if(!$pagina){$pagina=1;}

  $pc = $pagina;

    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;
  
  $todos = count($wpdb->get_results($busca));
  $busca .= ' LIMIT '. $inicio .','.$total_reg;
  $comments = $wpdb->get_results($busca);
  $tr = $todos;
  $tp = $tr / 20;
  
  foreach ($comments as $comment){
      if ($comment->comment_approved == 0){$status = '<div class="ativar"><img src="../wp-content/themes/anfitria/admin/admarea/ativa.gif"></div>';}
      else{$status = '<div class="encaminhar"><img src="../wp-content/themes/anfitria/admin/admarea/encaminhar.gif"></div>';}
      $parent = $wpdb->get_var('SELECT comment_content FROM '.$wpdb->prefix.'comments where comment_parent = '.$comment->comment_ID.' LIMIT 0,1');
      if ($parent == ''){$parent = $comment->comment_author. ', beijos';$input = '<input type="button" class="responder" value="responder">';}else{$input = '<input type="button" class="atualizar-resposta" value="atualizar resposta">';}
      $result .= '<div id="comentario-'.$comment->comment_ID.'" class="comentarios">';
      $result .= '<div id="header" ><div id="name">'.$comment->comment_author.'</div><div id="email">'.$comment->comment_author_email.'</div>'.$status.'</div>';
      $result .= '<div id="header-2"><div id="comentario">'.$comment->comment_content.'</div><div class="deletar" id="imagem"><img src="../wp-content/themes/anfitria/admin/admarea/del.gif"></div></div>';
      $result .= '<div id="content"><div class="textarea" id="textarea-post-'.$comment->comment_post_ID.'"><textarea>'.$parent.'</textarea>'.$input.'</div><a href="'.get_permalink($comment->comment_post_ID).'" target="_blank">'.get_the_title($comment->comment_post_ID).'</a></div>';
      $result .= '</div>';
  }
  
$anterior = $pc -1;
$proximo = $pc +1;

$result .= '<div id="paginacao">';
    if ($pc>1) {$result .= " <a href='comments.php?tipo=".$_GET['tipo']."&pagina=".$anterior."' id='comment-atpagina'><- Anterior</a> ";}
    $result .= "|";
    if ($pc<$tp){$result .= " <a href='comments.php?tipo=".$_GET['tipo']."&pagina=".$proximo."' id='comment-pmpagina'>Próxima -></a>";}

  $result .= '<input type="hidden" value="'.$proximo.'" id="pagina-num">';
  $result .= '<input type="hidden" value="'.$anterior.'" id="pagina-num-at">';
  $result .= '</div>';
  echo $result;
  wp_reset_query();
}

function get_comments_admarea(){
  global $wpdb;
  $busca = 'SELECT * FROM '.$wpdb->prefix.'comments where comment_parent = 0 order by comment_ID DESC';
  comments_admarea($busca);
}

function get_comments_no_aproved_admarea(){
  global $wpdb;
  $busca = 'SELECT * FROM '.$wpdb->prefix.'comments where comment_parent = 0 and comment_approved = 0 order by comment_ID DESC';
  comments_admarea($busca);
}

function get_comments_aproved_no_rs_admarea(){
  global $wpdb;
  $busca = 'SELECT * FROM '.$wpdb->prefix.'comments where comment_parent = 0 and comment_approved = 1 order by comment_ID DESC';
  comments_admarea($busca);
}

function comments_rs(){
  global $wpdb;
    
  $result .= '<table width="80%" height="67" border="0" align="center" cellpadding="5" cellspacing="5"><tbody>';
  $result .= '<tr>';
  $result .= '<td width="20%" align="center" bgcolor="#CCCCCC" class="maisculas"><a href="?tipo=nr&pagina=1" id="comments-nr">Ativos  não respondidos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#999999" class="maisculas"><a href="?tipo=na&pagina=1" id="comments-na">Somente os não ativos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#666666" class="maisculas"><a href="?tipo=sr&pagina=1" id="comments-sr">Somente os respondidos</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#F7F7F7" class="maisculas"><a href="?tipo=ts&pagina=1" id="comments-ts">TODOS</a></td>';
  $result .= '<td width="20%" align="center" bgcolor="#F7F7F7" class="maisculas"><a href="#" id="comments-exc-varios">excluir varios</a></td>';
  $result .= '</tr>';
  $result .= '</tbody></table>';
  
  $total_reg = "20";
  $pagina = $_GET['pagina'];

  $pc = $pagina;
  $busca = 'SELECT * FROM '.$wpdb->prefix.'comments where comment_parent != 0 order by comment_ID DESC';

    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;
    $total_reg = $total_reg+$inicio;
    
  $todos = count($wpdb->get_results($busca));
  $busca .= ' LIMIT '. $inicio .','.$total_reg;
  $parents = $wpdb->get_results($busca);
  $tr = $todos;
  $tp = $tr/20;
    
    foreach ($parents as $parent){
    $comments = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'comments where comment_ID = '.$parent->comment_parent);
    
      foreach ($comments as $comment){  
        if ($comment->comment_approved == 0){$status = '<div id="ativar"><img src="../wp-content/themes/anfitria/admin/admarea/ativa.gif"></div>';}
        else{$status = '<div id="encaminhar"><img src="../wp-content/themes/anfitria/admin/admarea/encaminhar.gif"></div>';}
        $content = $wpdb->get_var('SELECT comment_content FROM '.$wpdb->prefix.'comments where comment_parent = '.$comment->comment_ID.' LIMIT 0,1');
        if ($content == ''){$content = $comment->comment_author. ', beijos';}
        $result .= '<div id="comentario-'.$comment->comment_ID.'" class="comentarios">';
        $result .= '<div id="header" ><div id="name">'.$comment->comment_author.'</div><div id="email">'.$comment->comment_author_email.'</div>'.$status.'</div>';
        $result .= '<div id="header-2"><div id="comentario">'.$comment->comment_content.'</div><div id="imagem" class="deletar"><img src="../wp-content/themes/anfitria/admin/admarea/del.gif"></div></div>';
        $result .= '<div id="content"><div class="textarea" id="textarea-post-'.$comment->comment_post_ID.'"><textarea>'.$content.'</textarea><input type="button" class="atualizar-resposta" value="atualizar resposta"></div><a href="'.get_permalink($comment->comment_post_ID).'" target="_blank">'.get_the_title($comment->comment_post_ID).'</a></div>';
        $result .= '</div>';
      }
    }
    
    $anterior = $pc -1;
    $proximo = $pc +1;

    if ($pc>1) {$result .= " <a href='comments.php?tipo=".$_GET['tipo']."&pagina=".$anterior."' id='comment-atpagina'><- Anterior</a> ";}
    $result .= "|";
    if ($pc<$tp){$result .= " <a href='comments.php?tipo=".$_GET['tipo']."&pagina=".$proximo."' id='comment-pmpagina'>Próxima -></a>";}

  $result .= '<input type="hidden" value="'.$proximo.'" id="pagina-num">';
  $result .= '<input type="hidden" value="'.$anterior.'" id="pagina-num-at">';
  
  echo $result;
  wp_reset_query();
}
?>