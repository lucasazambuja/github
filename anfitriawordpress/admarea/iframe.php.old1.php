<?php
require_once '../wp-config.php';

if (is_user_logged_in() == NULL){
     header('location: '.get_option('siteurl').'/admarea');
}

   if (isset($_GET['upload']))
    {upload_imagem2();}

    if( (isset($_GET['delete'])) && ($_GET['delete'] != '') ){
       wp_delete_post($_GET['delete']);
       $voltar=$_GET['voltar'];
       echo '<meta http-equiv="refresh" content="1;URL='.$voltar.'" />';
    }

 fotos();

function fotos(){
    head_iframe();
    
    get_imagem_iframe();
    
    echo '<script>imagem();</script>';
    
    
wp_footer();
}




function head_iframe(){?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
                <link rel="stylesheet" href="style/iframe.css" type="text/css" media="all" />
                <script type="text/javascript" src="js/iframe.js"></script>
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

    $busca = "SELECT * FROM ".$wpdb->prefix."posts where `post_type` = 'attachment' and `post_status` = 'inherit' ORDER BY ID DESC";
    $total_reg = "10";
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
    ?>

    <form id="upload-files" action="?upload" method="post" enctype="multipart/form-data">
    <input type="file" name="img[]" name="img[]" class="multi" maxlength="20" accept="jpeg|jpg|png|gif" multiple/>
    <select name="jumpMenu" id="jumpMenu">
    <option value="'.$logo.'">Selecione</option>
    <option value="marcasem">Sem Logo</option>
    <option value="marca">Logo Matiz</option>
    <option value="marcaz">Assinatura Preto</option>
    <option value="marcab">Assinatura Branco</option>
    <option value="marcasem-sem-borda">Sem Logo Sem Borda</option>
    <option value="marca-sem-borda">Logo Matiz Sem Borda</option>
    <option value="marcaz-sem-borda">Assinatura Preto Sem Borda</option>
    <option value="marcab-sem-borda">Assinatura Branco Sem Borda</option>
    </select>
    <input type="submit" value="enviar" id="upload" name="upload">
    </form>


    <div id="exibe-imagens">

  <?php  $class = 'superwidth post_imagem';

    if (strpos($logo, '-sem-borda') != NULL){
     $class = 'superwidth post_imagem_sb';
     $logo = str_replace('-sem-borda', '', $logo);
    }
    
    $voltar = get_option('siteurl').'/admarea/iframe.php?pagina_iframe=fotos&pagina=1&logo=marca';

    while ($dados = mysql_fetch_array($limite)) {

    $imagem = get_option('siteurl').'/wp-content/uploads/'.$logo.'.php?show='.str_replace(get_option('siteurl').'/wp-content/uploads/', '', $dados['guid']);
    
    ?>
    

    <div style="padding:5px; FLOAT:left; width:100px;"><img src="<?php echo $imagem;?>" border="1" class="<?php echo $class;?>" width="100%"><img src="<?php echo get_option('siteurl');?>/wp-content/themes/anfitria/admin/admarea/del.gif" width="109" height="18" border="0" usemap="#Map<?php echo $dados['ID'];?>" />
    <map name="Map<?php echo $dados['ID'];?>" id="Map<?php echo $dados['ID'];?>">
    <area shape="rect" coords="96,6,103,13" href="?delete=<?php echo $dados['ID'];?>&voltar=<?php echo $voltar;?>" target="_self" class="delete_attachment">
    </map>
    </div>

   <?php  }?>
    </div>
    <br><br>
    <div id="paginacao">

  <?php // agora vamos criar os botões "Anterior e próximo"
    $anterior = $pc -1;
    $proximo = $pc +1;
    if ($pc>1) {
      echo " <a href='?pagina_iframe=fotos&pagina=$anterior&logo=$logo' id='pagina-$anterior' class='paginar_imagens'><- Anterior</a> ";
    }
    echo "|";
    if ($pc<$tp) {
      echo " <a href='?pagina_iframe=fotos&pagina=$proximo&logo=$logo' id='pagina-$proximo' class='paginar_imagens'>Próxima -></a>";
    }?>
    <input type="hidden" value="<?php echo $pc;?>" id="imagens-pagina-at"/>
    </div>

<?php  if (isset($_GET['upload']))
    {upload_imagem2();}}?>

<?php

    function upload_imagem2(){
     
   // $vetor = array();
    foreach($_FILES['img']['error'] as $key => $error){
    
     if($error == UPLOAD_ERR_OK){
     $wp_upload_dir = wp_upload_dir();

     $name = 'anfitria_'. time() . $key . '.jpg';
     $destino = $wp_upload_dir['path'] . '/' . $name;
    
     move_uploaded_file($_FILES['img']['tmp_name'][$key], $destino);
     
     $filename = $wp_upload_dir['url'] . '/' . $name;
     
     //$vetor[$key] = $destino;

      $wp_filetype = wp_check_filetype(basename($filename), null );
      $attachment = array(
         'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
         'post_mime_type' => $wp_filetype['type'],
         'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
         'post_content' => '',
         'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, 0 );
      // you must first include the image.php file
      // for the function wp_generate_attachment_metadata() to work
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
        }
    } //end foreach
    
//foreach ($vetor as $imagem){

$imagem = $filename;
     
$imagemjpg = $imagem;
$largura_alvo = 595;
 
$img = imagecreatefromjpeg($imagemjpg);
 
$largura_original = imagesX($img);
$altura_original = imagesY($img);
 
$altura_nova = (int) ($altura_original * $largura_alvo)/$largura_original;
 
$nova = ImageCreateTrueColor($largura_alvo,$altura_nova);
imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura_alvo, $altura_nova, $largura_original,  $altura_original);

imagejpeg($nova, $imagem, 75);

//}

echo 'Imagens enviadas com sucesso!';

      $script .= '<script>';
      $script .= 'window.document.location.replace(\'iframe.php\');';
      $script .= '</script>';
      
      echo $script;
} ?>