<?php
require_once '../wp-config.php';

if (is_user_logged_in() != 1){
    header('location: '.get_option('siteurl').'/admarea');
}

fotos();
function fotos(){
    head_iframe();
	  
    
    get_imagem_iframe();
    
    echo '<script>imagem();</script>';
    
    

    /*
    if($_GET['pagina_iframe'] == 'fotos')
    {get_imagem_iframe();}
    
    if($_GET['pagina_iframe'] == 'links')
    {get_links_adm();}
    
    if($_GET['pagina_iframe'] == 'categoria')
    {get_edit_categorias();}
    
    if($_GET['pagina_iframe'] == 'sub-categoria')
    {get_edit_sub_categorias();}
    
    echo '<script>links();</script>';
    echo '<script>imagem();</script>';*/
    
wp_footer();
}




function head_iframe(){?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
                <link rel="stylesheet" href="<?php echo get_option('siteurl');?>/admarea/style/iframe.css" type="text/css" media="all" />
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<meta http-equiv="content-language" content="<?php bloginfo( 'language' ); ?>" />
                
                <title>tilte</title>
                
                <?php wp_head();?>
                
	</head>
<?php }




function get_imagem_iframe(){
    global $wpdb;
    $conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
    $db = mysql_select_db(DB_NAME);

    $busca = "SELECT * FROM ".$wpdb->prefix."posts where `post_type` = 'attachment' and `post_status` = 'inherit' order by ID desc";
    $total_reg = "20";
    $pagina = $_GET['pagina'];
    $logo = $_GET['logo'];

    if(!$logo){$logo = 'marca';}

    if (!$pagina) {$pc = "1";} else {$pc = $pagina;}

    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;

    $limite = mysql_query("$busca LIMIT $inicio,$total_reg");
    $todos = mysql_query("$busca");

    $tr = mysql_num_rows($todos); // verifica o número total de registros
    $tp = $tr / $total_reg; // verifica o número total de páginas

    //$result .= '<form id="upload-imagem" action="?pagina_iframe=fotos&upload" method="post" enctype="multipart/form-data">';
    $result .= '<form id="upload-imagem" action="?upload" method="post" enctype="multipart/form-data">';
	$result .= '<input type="file" id="imagem" name="imagem">';
    $result .= '<select name="jumpMenu" id="jumpMenu">';
    $result .= '<option value="'.$logo.'">Selecione</option>';
    $result .= '<option value="marca">Logo Matiz</option>';
    $result .= '<option value="marcaz">Assinatura Preto</option>';
    $result .= '<option value="marcab">Assinatura Branco</option>';
    $result .= '<option value="marca-sem-borda">Logo Matiz Sem Borda</option>';
    $result .= '<option value="marcaz-sem-borda">Assinatura Preto Sem Borda</option>';
    $result .= '<option value="marcab-sem-borda">Assinatura Branco Sem Borda</option>';
    $result .= '</select>';
    $result .= '<input type="submit" value="enviar" id="upload" name="upload">';
    $result .= '</form>';


    // vamos criar a visualização
    $result .= '<div id="exibe-imagens">';

    $class = 'superwidth post_imagem';

    if (strpos($logo, '-sem-borda') != NULL){
     $class = 'superwidth post_imagem_sb';
     $logo = str_replace('-sem-borda', '', $logo);
    }

    while ($dados = mysql_fetch_array($limite)) {

    //$imagem = get_option('siteurl').'/wp-content/themes/anfitria/admin/admarea/'.$logo.'.php?show='.str_replace(get_option('siteurl').'/wp-content/', '../../../../', $dados['guid']);
 $imagem = get_option('siteurl').'/wp-content/uploads/'.str_replace(get_option('siteurl').'/wp-content/uploads/', '', $dados['guid']);
    $result .= '<div style="padding:5px; FLOAT:left; width:100px;"><img src="'.$imagem.'" border="1" class="'.$class.'" width="100%"><img src="'.get_option('siteurl').'/wp-content/themes/anfitria/admin/admarea/del.gif" width="109" height="18" border="0" usemap="#Map'.$dados['ID'].'" />';
    $result .= '<map name="Map'.$dados['ID'].'" id="Map'.$dados['ID'].'">';
    $result .= '<area shape="rect" coords="96,6,103,13" href="#" target="_self" class="delete_attachment">';
    $result .= '</map>';
    $result .= '</div>';

     }
    $result .= '</div>';
    $result .= '<br><br>';
    $result .= '<div id="paginacao">';

    // agora vamos criar os botões "Anterior e próximo"
    $anterior = $pc -1;
    $proximo = $pc +1;
    if ($pc>1) {
    $result .= " <a href='?pagina_iframe=fotos&pagina=$anterior&logo=$logo' id='pagina-$anterior' class='paginar_imagens'><- Anterior</a> ";
    }
    $result .= "|";
    if ($pc<$tp) {
    $result .= " <a href='?pagina_iframe=fotos&pagina=$proximo&logo=$logo' id='pagina-$proximo' class='paginar_imagens'>Próxima -></a>";
    }
    $result .= '<input type="hidden" value="'.$pc.'" id="imagens-pagina-at"/>';
    $result .= '</div>';

    echo $result;
    
    if (isset($_GET['upload']))
    {upload_imagem2();}
}

function get_links_adm(){
    global $wpdb; 
    global $post;
    
    $result = '<div id="edit-links">';
    $result .= 'titulo: <input type="text" id="links-nome"> link: <input type="text" id="links-link"><input type="button" value="criar links" id="new-link">';
    $result .= '<br><br><br>';
    $busca = 'SELECT * FROM '.$wpdb->prefix.'posts where post_type = "links" and post_status = "publish"';
    query_posts($busca);
    $query = new WP_Query('post_type=links&post_status=pusblish&orderby=data&order=ASC&showposts=100');

        while ($query->have_posts()) {
        $query->the_post();
    
            $result.='<li id="links-'.$post->ID.'">';
            $result.= '<input type="text" value="'.$post->post_title.'"><input type="text" value="'.get_field('link_url').'"><input type="button" id="alterar-links-'.$post->ID.'" class="alterar-links" value="alterar" ><input type="checkbox" class="confirm-delete"><input type="button" id="deletar-links-'.$post->ID.'" class="deletar-links" value="deletar" >';
            $result.='</li>';
        
        }
    $result.='</div>';
    echo $result;
    wp_reset_query();
}

function get_edit_categorias(){
    global $wpdb; 
    $result = '<div id="edit-category">';
    $result .= '<input type="text" id="categoria-nome"><input type="button" value="criar categoria" id="new-categoria">';
    $result .= '<br><br><br>';
    $categorys = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."terms WHERE `term_id` IN (SELECT term_id FROM ".$wpdb->prefix."term_taxonomy WHERE `parent` = 0) and term_id != 1");
    foreach ($categorys as $category){
        $result.='<li id="categoria-'.$category->term_id.'">';
        $result.= '<input type="text" value="'.$category->name.'"><input type="button" id="alterar-categoria-'.$category->term_id.'" class="alterar-categoria" value="alterar"><input type="checkbox" class="confirm-delete"><input type="button" id="deletar-categoria-'.$category->term_id.'" class="deletar-categoria" value="deletar">';
        $result.='</li>';
    }
    $result.='</div>';
    echo $result;
    wp_reset_query();
}

function get_edit_sub_categorias(){
    global $wpdb; 
    $result = '<div id="edit-sub-category">';
    $result .= '<input type="text" id="sub-categoria-nome"><input type="button" value="criar sub-categoria" id="new-sub-categoria">';
    $result .= '<br><br><br>';
    $sub_categorys = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."terms WHERE `term_id` IN (SELECT term_id FROM ".$wpdb->prefix."term_taxonomy WHERE parent = ".$_POST['parent'].")");
    foreach ($sub_categorys as $sub_category){
        $result.='<li id="sub-categoria-'.$sub_category->term_id.'">';
        $result.= '<input type="text" value="'.$sub_category->name.'"><input type="button" id="alterar-sub-categoria-'.$sub_category->term_id.'" class="alterar-sub-categoria" value="alterar"><input type="checkbox" class="confirm-delete"><input type="button" id="deletar-sub-categoria-'.$sub_category->term_id.'" class="deletar-sub-categoria" value="deletar">';
        $result.='</li>';
    }
    $result.='</div>';
    echo $result;
    wp_reset_query();
}

function upload_imagem2(){
    $wp_upload_dir = wp_upload_dir();
    $name = 'anfitria_'.time().'_'. $_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], $wp_upload_dir['path'] .'/'.$name);
	//move_uploaded_file($_FILES['img']['tmp_name'][$key], $destino);
    $filename = $wp_upload_dir['url'].'/'.$name;
    
if($_GET['logo'] == 'marca')
    //$content = get_option('siteurl').'/wp-content/themes/anfitria/admin/admarea/marca.php?show='.str_replace(get_option('siteurl').'/wp-content/', '../../../../', $filename);
	  $content = get_option('siteurl').'/wp-content'.str_replace(get_option('siteurl').'/wp-content', '/', $filename);
if($_GET['logo'] == 'marcab')
    //$content = get_option('siteurl').'/wp-content/themes/anfitria/admin/admarea/marcab.php?show='.str_replace(get_option('siteurl').'/wp-content/', '../../../../', $filename);
	$content = get_option('siteurl').'/wp-content'.str_replace(get_option('siteurl').'/wp-content', '/', $filename);
if($_GET['logo'] == 'marcaz')
	$content = get_option('siteurl').'/wp-content'.str_replace(get_option('siteurl').'/wp-content', '/', $filename);
//$content = get_option('siteurl').'/wp-content/themes/anfitria/admin/admarea/marcaz.php?show='.str_replace(get_option('siteurl').'/wp-content/', '../../../../', $filename);
      $wp_filetype = wp_check_filetype(basename($filename), null );
      $attachment = array(
         'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
         'post_mime_type' => $wp_filetype['type'],
         'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
         'post_content' => '',
         'post_status' => 'inherit',
         'post_content' => $content
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, 0 );
      // you must first include the image.php file
      // for the function wp_generate_attachment_metadata() to work
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      /*
      $script .= '<script>';
      $script .= 'url = window.location;';
      $script .= 'url = url.toString();';
      $script .= 'new_url = url.replace(/(.{1,})\?(upload&logo=\(w{1,})/,"$1?pagina_iframe=fotos&pagina=1&logo=marca");';
      $script .= 'alert(new_url);';
      $script .= '</script>';
      
      echo $filename;*/
	  $imagem = $wp_upload_dir['path'] .'/'.$name;
     
	$imagemjpg = $imagem;
	$largura_alvo = 595;
	 
	$img = imagecreatefromjpeg($imagemjpg);
	 
	$largura_original = imagesX($img);
	$altura_original = imagesY($img);
	 
	$altura_nova = (int) ($altura_original * $largura_alvo)/$largura_original;
	 
	$nova = ImageCreateTrueColor($largura_alvo,$altura_nova);
	imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura_alvo, $altura_nova, $largura_original,  $altura_original);

	imagejpeg($nova, $imagem, 75);
}

?>
