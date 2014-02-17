<?php require_once '../wp-config.php'; 
$hostname_BLOG_MATRIZ = DB_HOST;
$database_BLOG_MATRIZ = DB_NAME;
$username_BLOG_MATRIZ = DB_USER;
$password_BLOG_MATRIZ = DB_PASSWORD;
$BLOG_MATRIZ = mysql_pconnect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ) or trigger_error(mysql_error(),E_USER_ERROR); 
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

function slug( $string ) {
        if (is_string($string)) {
                $string = strtolower(trim(utf8_decode($string)));
                
                $before = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
                $after  = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';           
                $string = strtr($string, utf8_decode($before), $after);
                                
                $replace = array(
                        '/[^a-z0-9.-]/'	=> '-',
                		'/-+/'			=> '-',
                        '/\-{2,}/'		=> ''
                );
                $string = preg_replace(array_keys($replace), array_values($replace), $string);
        }
        return $string;
}

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES (NULL, %s, %s, '0')",
                       GetSQLValueString($_POST['cat_nome'], "text"),
                       GetSQLValueString(sanitize_title($_POST['cat_nome']), "text"));

  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
  $Result = mysql_query($insertSQL, $BLOG_MATRIZ) or die(mysql_error());
  
    global $wpdb;
  $id = $wpdb->get_var('SELECT MAX(term_id) FROM wp_terms');

  $insertSQL1 = sprintf("INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES (%s, %s, 'category', 'category', '0', '0')",
  		       GetSQLValueString($id, "int"),
  		       GetSQLValueString($id, "int"));
  		       
  $Result1 = mysql_query($insertSQL1, $BLOG_MATRIZ) or die(mysql_error());
  
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "altera")) {
  $updateSQL = sprintf("UPDATE wp_terms SET name=%s WHERE term_id=%s",
                       GetSQLValueString($_POST['cat_nome'], "text"),
                       GetSQLValueString($_POST['cat_id'], "int"));

  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
  $Result1 = mysql_query($updateSQL, $BLOG_MATRIZ) or die(mysql_error());
}

if ((isset($_GET['deletebox'])) && ($_GET['deletebox'] != "")) {
  $deleteSQL = sprintf("DELETE FROM wp_terms WHERE term_id=%s",
                       GetSQLValueString($_GET['deletebox'], "int"));

  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
  $Result1 = mysql_query($deleteSQL, $BLOG_MATRIZ) or die(mysql_error());
}

mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
$query_mostra_categoria = "SELECT * FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE parent = 0) ORDER BY name ASC";
$mostra_categoria = mysql_query($query_mostra_categoria, $BLOG_MATRIZ) or die(mysql_error());
$row_mostra_categoria = mysql_fetch_assoc($mostra_categoria);
$totalRows_mostra_categoria = mysql_num_rows($mostra_categoria);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../stylesheet.css" type="text/css" charset="utf-8">
<style type="text/css" media="screen">
h1.fontface {
	font: 60px 'CaviarDreamsRegular', Arial, sans-serif;
	letter-spacing: 0;
}
.style3 {
	font: 14px 'CaviarDreamsRegular', Arial, sans-serif;
}
.style4 {
	font: 25px 'CaviarDreamsBold', Arial, sans-serif;
}
.style5 {
	font: 14px 'CaviarDreamsRegular', Arial, sans-serif;
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Maiusc">Nome da Nova Categoria:</td>
      <td><input name="cat_nome" type="text" class="Maiusc" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Salvar" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<table width="30%" border="0" align="center" cellpadding="3" cellspacing="3">
   <?php do { ?><tr><form id="altera" name="altera" method="POST" action="<?php echo $editFormAction; ?>">
   
    <td width="56%" nowrap="nowrap">
      <input name="cat_nome" type="text" class="Maiusc" id="cat_nome" value="<?php echo $row_mostra_categoria['name']; ?>" />
      <input name="cat_id" type="hidden" id="cat_id" value="<?php echo $row_mostra_categoria['term_id']; ?>" /></td>
    <td width="23%"><input type="submit" name="button" id="button" value="Alterar" /></td>
    <td width="21%" nowrap="nowrap">&nbsp;</td>
    <input type="hidden" name="MM_update" value="altera" />
   </form>
    <td width="21%" nowrap="nowrap"><form id="deleta" name="deleta" method="get" action="">
      <input name="deletebox" type="checkbox" id="deletebox" value="<?php echo $row_mostra_categoria['term_id']; ?>" />
      <input type="submit" name="button2" id="button2" value="Deletar" />
    </form></td>
    
  </tr><?php } while ($row_mostra_categoria = mysql_fetch_assoc($mostra_categoria)); ?>
</table>
<p>  

</p>
</body>
</html>