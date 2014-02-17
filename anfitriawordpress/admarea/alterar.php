<?php require_once('../wp-config.php'); 
$hostname_BLOG_MATRIZ = DB_HOST;
$database_BLOG_MATRIZ = DB_NAME;
$username_BLOG_MATRIZ = DB_USER;
$password_BLOG_MATRIZ = DB_PASSWORD;
$BLOG_MATRIZ = mysql_pconnect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ) or trigger_error(mysql_error(),E_USER_ERROR); 
if (is_user_logged_in() == NULL){
    header('location: '.get_option('siteurl').'/admarea');
}
?>
<?php

if (!function_exists("GetSQLValueString")) {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

{

  if (PHP_VERSION < 6) {

    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  }



  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);



  switch ($theType) {

    case "text":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;    

    case "long":

    case "int":

      $theValue = ($theValue != "") ? intval($theValue) : "NULL";

      break;

    case "double":

      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";

      break;

    case "date":

      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";

      break;

    case "defined":

      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;

      break;

  }

  return $theValue;

}

}



$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {

  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    
    $date = $_POST['date'] . ' ' . date('H:i:s');
    
    $postid = $_POST['ID'];
    $data_content = $_POST['post_texto'];
    $data_content = preg_replace('/<p>&nbsp;<\/p>/i', '', $data_content);
    $data_content = preg_replace('/<p><\/p>/i', '', $data_content);
    $data_content = preg_replace('/<br>/i', '', $data_content);
    $data_content = preg_replace('/<\/p>/i', '</p><p>&nbsp;</p>', $data_content);
    $data_content = iconv('latin1','utf8', $data_content);
    $data_title = $_POST['post_titulo'];
    $data_title = iconv('latin1','utf8', $data_title);
    $data_status = $_POST['post_status'];
    $num_likes = $_POST['post_tags'];
    
    $my_post = array();
    $my_post['ID'] = $postid;
    $my_post['post_content'] = $data_content;
    $my_post['post_title'] = $data_title;
    $my_post['post_status'] = $data_status;
    $my_post['post_date'] = $date;
    $my_post['post_date_gmt'] = $date;
    $my_post['post_modified'] = $date;
    $my_post['post_modified_gmt'] = $date;
    
    wp_update_post( $my_post );
    
    add_register_like($postid, $num_likes);

    
}



mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_categorias = "SELECT * FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE parent = 0) ORDER BY name ASC";

$categorias = mysql_query($query_categorias, $BLOG_MATRIZ) or die(mysql_error());

$row_categorias = mysql_fetch_assoc($categorias);

$totalRows_categorias = mysql_num_rows($categorias);



$colname_mostra_categoria = "-1";

if (isset($_GET['categoria'])) {

  $colname_mostra_categoria = $_GET['categoria'];

}

mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_mostra_categoria = sprintf("SELECT * FROM wp_terms WHERE term_id = %s", GetSQLValueString($colname_mostra_categoria, "int"));

$mostra_categoria = mysql_query($query_mostra_categoria, $BLOG_MATRIZ) or die(mysql_error());

$row_mostra_categoria = mysql_fetch_assoc($mostra_categoria);

$totalRows_mostra_categoria = mysql_num_rows($mostra_categoria);



$get2 = $_GET['alterar']; $aux2 = explode(' ',$get2);



$colname_subcategoria = $aux2[1];

if (isset($_GET['categoria'])) {

  $colname_subcategoria = $_GET['categoria'];

}

mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_subcategoria = sprintf("SELECT * FROM wp_terms WHERE `term_id` IN (SELECT term_id FROM wp_term_taxonomy WHERE parent = %s)", GetSQLValueString($colname_subcategoria, "text"));

$subcategoria = mysql_query($query_subcategoria, $BLOG_MATRIZ) or die(mysql_error());

$row_subcategoria = mysql_fetch_assoc($subcategoria);

$totalRows_subcategoria = mysql_num_rows($subcategoria);


mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_posts = "SELECT * FROM wp_posts WHERE post_type = 'post' and post_status != 'trash' ORDER BY ID DESC";

$posts = mysql_query($query_posts, $BLOG_MATRIZ) or die(mysql_error());

$row_posts = mysql_fetch_assoc($posts);

$totalRows_posts = mysql_num_rows($posts);



$get3 = $_GET['alterar']; $aux3 = explode(' ',$get3);



$colname_alterar = "-1";

if (isset($_GET['alterar'])) {

  $colname_alterar = $aux3[0];

}

mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_alterar = sprintf("SELECT * FROM wp_posts WHERE ID = %s", GetSQLValueString($colname_alterar . "%", "int"));

$alterar = mysql_query($query_alterar, $BLOG_MATRIZ) or die(mysql_error());

$row_alterar = mysql_fetch_assoc($alterar);

$totalRows_alterar = mysql_num_rows($alterar);

?>

<html>

<head>
    
<title>htmlArea Example</title>

<style type="text/css">

<!--

body, td {

	font-family: arial;

	font-size: x-small;

}

a {

	color: #0000BB;

	text-decoration: none;

}

a:hover {

	color: #FF0000;

	text-decoration: underline;

}

.headline {

	font-family: arial black, arial;

	font-size: 28px;

	letter-spacing: -1px;

}

.headline2 {

	font-family: verdana, arial;

	font-size: 12px;

}

.subhead {

	font-family: arial, arial;

	font-size: 18px;

	font-weight: bold;

	font-style: italic;

}

.backtotop {

	font-family: arial, arial;

	font-size: xx-small;

}

.code {

	background-color: #EEEEEE;

	font-family: Courier New;

	font-size: x-small;

	margin: 5px 0px 5px 0px;

	padding: 5px;

	border: black 1px dotted;

}

font {

	font-family: arial black, arial;

	font-size: 28px;

	letter-spacing: -1px;

}

-->

</style>

<script language="Javascript1.2"><!-- // load htmlarea

_editor_url = "";                     // URL to htmlarea files

var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);

if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }

if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }

if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }

if (win_ie_ver >= 5.5) {

  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');

  document.write(' language="Javascript1.2"></scr' + 'ipt>');  

} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }

// --></script>

<link rel="stylesheet" href="../stylesheet.css" type="text/css" charset="utf-8">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  
  <script>
    $(function(){
        
    });
  </script>

<style type="text/css" media="screen">

.style3 {

	font: 14px 'CaviarDreamsRegular', Arial, sans-serif;

}

.style4 {

	font: 25px 'CaviarDreamsBold', Arial, sans-serif;

}

.style5 {

	font: 16px 'CaviarDreamsRegular', Arial, sans-serif;

}

.Maiusc {

	font: 14px 'CaviarDreamsBold', Arial, sans-serif;

	text-transform: uppercase;

}

#container {

	width: 900px;

	margin-left: auto;

	margin-right: auto;

	margin-top: 0px;

}

body {

	background-image: url(bg1.gif);

}

img.img {

	padding: 10px;

	width:500px;

}

</style>

</head>

<body>

<div align=center> <span class="headline">&Aacute;rea Administrativa do Blog Anfitri&atilde;</span><span class="headline2"><br>

  </span>

  <hr>

</div>

<table width="100%" border="0" cellspacing="3" cellpadding="3">

  <tr>

    <td valign="middle" nowrap><span class="Maiusc">Selecione uma Categoria:</span></td>

    <td valign="middle"></td>

    <td valign="middle"><span class="Maiusc">ALTERAR POST:</span></td>

  </tr>

  <tr>

    <form name="form2" method="get" action="">

      <td width="16%" valign="middle"><?php $get = $_GET['alterar']; $aux = explode(' ',$get); ?>

        <select name="alterar" class="style4" id="alterar" onChange="submit()" style="text-transform:uppercase">

          <option value="" <?php if (!(strcmp("", $aux[1]))) {echo "selected=\"selected\"";} ?>></option>

          <?php

do {  

?>

          <option value="<?php echo $aux[0]; ?> <?php echo $row_categorias['term_id']?>"<?php if (!(strcmp($row_categorias['term_id'], $aux[1]))) {echo "selected=\"selected\"";} ?>><?php echo $row_categorias['name']?></option>

          <?php

} while ($row_categorias = mysql_fetch_assoc($categorias));

  $rows = mysql_num_rows($categorias);

  if($rows > 0) {

      mysql_data_seek($categorias, 0);

	  $row_categorias = mysql_fetch_assoc($categorias);

  }

?>

        </select></td>

    </form>

    <td width="36%" valign="middle"><a href="cat.php" target="painel" class="style5">Criar Categoria</a></td>

    <form name="form3" method="get" action="alterar.php">

      <td width="48%" valign="middle"><select name="alterar" class="style4" onChange="submit()" style="text-transform:uppercase; width:98%">

          <option>SELECIONE </option>

          <?php
global $wpdb;
do {  
    $category = $wpdb->get_var('SELECT term_taxonomy_id FROM wp_term_relationships where object_id = '.$row_posts['ID'].' LIMIT 1');
?>

          <option value="<?php echo $row_posts['ID']?> <?php echo $category?>"><?php echo $row_posts['post_title']?></option>

          <?php

} while ($row_posts = mysql_fetch_assoc($posts));

  $rows = mysql_num_rows($posts);

  if($rows > 0) {

      mysql_data_seek($posts, 0);

	  $row_posts = mysql_fetch_assoc($posts);

  }

?>

        </select></td>

    </form>

  </tr>

</table>

<table width="100%" border="0" cellspacing="3" cellpadding="3">

  <!-- SUMIR TR -->

  <tr>

    <td width="52%" align="left"><form action="<?php echo $editFormAction; ?>" method="POST" name="form1">

        <input name="ID" type="hidden" id="ID" value="<?php $get = $_GET['alterar']; $aux = explode(' ',$get); echo $aux[0]; ?>">

        <input name="post_cat" type="hidden" id="post_cat" value="<?php $get = $_GET['alterar']; $aux = explode(' ',$get); echo $aux[1]; ?>">

        <table width="87%" align="center">

          <tr valign="baseline">

            <td><span class="Maiusc">sub categoria:</span><br>

              <select name="post_sub" class="style4" id="combo2" style="text-transform:uppercase">

                <option>SELECIONE</option>

                <?php

do {  
    
    $sub_category = $wpdb->get_var('SELECT term_taxonomy_id FROM wp_term_relationships where object_id = '.$row_alterar['ID'].' and term_taxonomy_id IN (SELECT term_id FROM wp_term_taxonomy WHERE parent = 0) LIMIT 1');

?>

                <option value="<?php echo $row_subcategoria['term_id']?>"<?php if (!(strcmp($row_subcategoria['term_id'], $sub_category))) {echo "selected=\"selected\"";} ?>><?php echo $row_subcategoria['name']?></option>

                <?php

} while ($row_subcategoria = mysql_fetch_assoc($subcategoria));

  $rows = mysql_num_rows($subcategoria);

  if($rows > 0) {

      mysql_data_seek($subcategoria, 0);

	  $row_subcategoria = mysql_fetch_assoc($subcategoria);

  }

?>

              </select>

              <a href="sub.php&categoria=<?php $get = $_GET['alterar']; $aux = explode(' ',$get); echo $aux[1]; ?>" target="painel" class="style5">[Criar Sub Categoria]</a></td>

          </tr>

          <tr valign="baseline">

            <td class="Maiusc">Titulo do post</td>

          </tr>

          <tr valign="baseline">

            <td><input name="post_titulo" type="text" class="Maiusc" style="width:650; font-size:26px;" value="<?php echo $row_alterar['post_title']; ?>" size="32"></td>

          </tr>

          <tr valign="baseline">

            <td class="Maiusc">Texto do post</td>

          </tr>

          <tr valign="baseline">

            <td><textarea name="post_texto" id="post_texto" cols="50" rows="5" style="width:650; height:600"><?php echo $row_alterar['post_content']; ?></textarea></td>

          </tr>

          <tr valign="baseline">

            <td class="Maiusc">GOSTARAM 
            <input name="post_tags" type="text" class="Maiusc" value="<?php echo get_like($row_alterar['ID']);?>" size="4"> 
            PESSOAS</td>

          </tr>
          
           <tr valign="baseline">

              <td>Data: <input type="text" id="date" name="date"></td>

          </tr>
          <?php
          $date = $row_alterar['post_date'];
          $date = explode(' ', $date);
          $date = explode('-', $date[0]);
          ?>
          <script>
            $('#date').datepicker();
            $('#date').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );

            var data = new Date(<?php echo $date[0];?>, <?php echo $date[1] - 1;?>, <?php echo $date[2];?>);
            $('#date').datepicker('setDate', data);
         </script>

          <tr valign="baseline">

            <td class="Maiusc">Status</td>

          </tr>
          

          <tr valign="baseline">

            <td><select name="post_status" class="Maiusc">

                <option value="publish" <?php if (!(strcmp('publish', $row_alterar['post_status']))) {echo "selected=\"selected\"";} ?>>Publicar</option>

                <option value="draft" <?php if (!(strcmp('draft', $row_alterar['post_status']))) {echo "selected=\"selected\"";} ?>>Rascunho</option>

              </select></td>

          </tr>

          <tr valign="baseline">

            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="77%"><input type="submit" value="SALVAR ALTERA&Ccedil;&Atilde;O"></td>

    <td width="23%" align="center" bgcolor="#000000" class="Maiusc" ><strong><a href="delete.php?post_id=<?php $get = $_GET['alterar']; $aux = explode(' ',$get); echo $aux[0]; ?>" style="color:#FFF" onClick="return (confirm('DELETAR POST: <?php echo $row_alterar['post_title']; ?> ?'))">DELETAR POST</a></strong></td>

  </tr>

</table>

</td>

          </tr>

        </table>

        

        <input type="hidden" name="MM_update" value="form1">

      </form></td>

    <td width="48%" valign="bottom">

    <table width="42%" border="0" cellspacing="15" cellpadding="0">

      <tr>

        <td height="57" align="center" bgcolor="#000000" class="Maiusc"><a href="admin.php" style="color:#FFF"><strong>CRIAR NOVO POST</strong></a></td>

      </tr>

    </table>

      <br>

<iframe name="painel" id="painel" height="400" width="100%" frameborder="1" src="iframe.php?pagina_iframe=fotos&pagina=1&logo=marca"></iframe>

      <br>

      COLE E COPIE:<br>

    <textarea name="textarea" id="textarea" cols="45" rows="25" style="width:90%"></textarea></td>

  </tr>

  <!-- SUMIR TR -->

</table>

<p>&nbsp;</p>

<script language="javascript1.2">

var config = new Object();    // create new config object



config.width = "650px";

config.height = "600px";

config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';

config.debug = 0;



// NOTE:  You can remove any of these blocks and use the default config!



config.toolbar = [

    ['fontname'],

    ['fontsize'],

    ['fontstyle'],

    ['linebreak'],

    ['bold','italic','underline','separator'],

//  ['strikethrough','subscript','superscript','separator'],

    ['justifyleft','justifycenter','justifyright','separator'],

    ['OrderedList','UnOrderedList','Outdent','Indent','separator'],

    ['forecolor','backcolor','separator'],

    ['HorizontalRule','Createlink','InsertImage','htmlmode','separator'],

    ['about','help','popupeditor'],

];



config.fontnames = {

    "Arial":           "arial, helvetica, sans-serif",

    "Courier New":     "courier new, courier, mono",

    "Georgia":         "Georgia, Times New Roman, Times, Serif",

    "Tahoma":          "Tahoma, Arial, Helvetica, sans-serif",

    "Times New Roman": "times new roman, times, serif",

    "Verdana":         "Verdana, Arial, Helvetica, sans-serif",

    "impact":          "impact",

    "WingDings":       "WingDings"

};

config.fontsizes = {

    "1 (8 pt)":  "1",

    "2 (10 pt)": "2",

    "3 (12 pt)": "3",

    "4 (14 pt)": "4",

    "5 (18 pt)": "5",

    "6 (24 pt)": "6",

    "7 (36 pt)": "7"

  };



//config.stylesheet = "http://www.domain.com/sample.css";

  

config.fontstyles = [   // make sure classNames are defined in the page the content is being display as well in or they won't work!

  { name: "TITULO", className: "style4", classStyle: "font: 25px 'CaviarDreamsBold', Arial, sans-serif;" },

  { name: "CAVIAR",     className: "style5",  classStyle: "font: 15px 'CaviarDreamsRegular', Arial, sans-serif;" },

  { name: "MAIUSCULA",    className: "Maiusc", classStyle: "font: 14px 'CaviarDreamsBold', Arial, sans-serif; text-transform: uppercase;" }





// leave classStyle blank if it's defined in config.stylesheet (above), like this:

//  { name: "verdana blue", className: "headline4", classStyle: "" }  

];



editor_generate('post_texto',config);

</script>

</body>

</html>

<?php

mysql_free_result($categorias);



mysql_free_result($mostra_categoria);



mysql_free_result($subcategoria);



mysql_free_result($posts);



mysql_free_result($alterar);

?>