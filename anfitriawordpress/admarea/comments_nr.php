<?php require_once('../wp-config.php'); 
$hostname_BLOG_MATRIZ = DB_HOST;
$database_BLOG_MATRIZ = DB_NAME;
$username_BLOG_MATRIZ = DB_USER;
$password_BLOG_MATRIZ = DB_PASSWORD;
$BLOG_MATRIZ = mysql_pconnect($hostname_BLOG_MATRIZ, $username_BLOG_MATRIZ, $password_BLOG_MATRIZ) or trigger_error(mysql_error(),E_USER_ERROR); 
header('Content-Type: text/html; charset=iso-8859-1'); 
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



$currentPage = $_SERVER["PHP_SELF"];



if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {

global $wpdb;
$existe = $wpdb->get_var('SELECT comment_ID FROM wp_comments WHERE comment_parent = '. $_GET['delete']);

if($existe != NULL){$deleteSQL1 = sprintf("DELETE FROM wp_comments WHERE comment_ID=%s",

                       GetSQLValueString($existe, "int"));}


  $deleteSQL = sprintf("DELETE FROM wp_comments WHERE comment_ID=%s",

                       GetSQLValueString($_GET['delete'], "int"));



  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

  $Result1 = mysql_query($deleteSQL, $BLOG_MATRIZ) or die(mysql_error());
  
  if($existe != NULL){$Result = mysql_query($deleteSQL1, $BLOG_MATRIZ) or die(mysql_error());}

}



$maxRows_comments = 10;

$pageNum_comments = 0;

if (isset($_GET['pageNum_comments'])) {

  $pageNum_comments = $_GET['pageNum_comments'];

}

$startRow_comments = $pageNum_comments * $maxRows_comments;



mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_comments = "SELECT * FROM `wp_comments` WHERE comment_approved = 1 and comment_parent = 0 and `comment_ID` NOT IN (SELECT comment_parent FROM wp_comments WHERE comment_parent != 0) ORDER BY `wp_comments`.`comment_ID`  DESC";

$query_limit_comments = sprintf("%s LIMIT %d, %d", $query_comments, $startRow_comments, $maxRows_comments);

$comments = mysql_query($query_limit_comments, $BLOG_MATRIZ) or die(mysql_error());

$row_comments = mysql_fetch_assoc($comments);



if (isset($_GET['totalRows_comments'])) {

  $totalRows_comments = $_GET['totalRows_comments'];

} else {

  $all_comments = mysql_query($query_comments);

  $totalRows_comments = mysql_num_rows($all_comments);

}

$totalPages_comments = ceil($totalRows_comments/$maxRows_comments)-1;



$queryString_comments = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_comments") == false && 

        stristr($param, "totalRows_comments") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_comments = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_comments = sprintf("&totalRows_comments=%d%s", $totalRows_comments, $queryString_comments);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../stylesheet.css" type="text/css" charset="utf-8">

<style type="text/css" media="screen">

.style3 {

	font: 14px 'MuliRegular', Arial, sans-serif;

}

.style4 {

	font: 25px 'MuliRegular', Arial, sans-serif;

}

.style5 {

	font: 12px 'MuliRegular', Arial, sans-serif;
	letter-spacing:1px;

}

.Maiusc {

	font: 12px 'MuliRegular', Arial, sans-serif;
    
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

<title>Comentários</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>



<body>
<table width="80%" height="67" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td width="20%" align="center" bgcolor="#CCCCCC" class="Maiusc"><a href="comments_nr.php">Ativos  n&atilde;o respondidos</a></td>
    <td width="20%" align="center" bgcolor="#999999" class="Maiusc"><a href="comments_na.php">Somente os n&atilde;o ativos</a></td>
    <td width="20%" align="center" bgcolor="#666666" class="Maiusc"><a href="comments_sr.php">Somente os respondidos</a></td>
    <td width="20%" align="center" bgcolor="#F7F7F7" class="Maiusc"><a href="comments.php">TODOS</a></td>
<td width="20%" align="center" bgcolor="#F7F7F7" class="Maiusc"><a href="comments_spam.php">EXCLUIR VÁRIOS</a></td>
  </tr>
</table>
<?php do { ?>

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1">

 

    <tr>
        <td width="37%" align="center" bgcolor="#F4F4F4" class="Maiusc"><strong><?php echo $row_comments['comment_author']; ?></strong></td>
      <td width="55%" align="center" bgcolor="#F4F4F4" class="style5"><?php echo $row_comments['comment_author_email']; ?></td>
      <td bgcolor="#F4F4F4" class="style5">
      
      <?php
if ($row_comments['comment_approved'] == 0) {;?>
      <a href="ativa.php?post_id=<?php echo $row_comments['comment_ID']; ?>&voltar=http://www.anfitria.com.br<?php printf("%s?pageNum_comments=%d%s", $currentPage, min($totalPages_comments, $pageNum_comments), $queryString_comments); ?>"><img src="ativa.gif" width="109" height="18" border="0" /></a>

<?php } else {
    echo "Já Ativo";
	echo "<br>";
	echo "<a href=\"encaminhar.php?post_id=".$row_comments['comment_ID']."&unica=".$row_comments['comment_post_ID']."\" target=\"_blank\" ><img src=\"encaminhar.gif\" width=\"109\" height=\"18\" border=\"0\" /></a>";
}
?>
      
      
      </td>
    </tr>
    <tr>

      <td colspan="2" align="left" bgcolor="#F4F4F4" class="Maiusc"><span class="style5" onclick="MM_openBrWindow('<?php echo get_permalink($row_comments['comment_post_ID']); ?> ','pop','status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=600,height=400')" style="cursor:pointer;"><?php echo $row_comments['comment_content']; ?></span></td>

      <td width="8%" bgcolor="#F4F4F4" class="style5"><a href="?delete=<?php echo $row_comments['comment_ID']; ?>" onClick="return (confirm('Voc&ecirc; realmente quer deletar?'))"><img src="del.gif" width="109" height="18" border="0" /></a></td>

    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#F4F4F4" class="Maiusc" ><form id="form1" name="form1" method="POST" action="responde.php">
        <input name="email" type="hidden" id="email" value="<?php echo $row_comments['comment_author_email']; ?>" />
        <input name="post_id" type="hidden" id="post_id" value="<?php echo $row_comments['comment_post_ID']; ?>" />
        <input name="post_parent" type="hidden" id="post_parent" value="<?php echo $row_comments['comment_ID']; ?>" />
        <textarea name="resposta" id="resposta" cols="50" rows="4" style="width:80%;"><?php
        global $wpdb;
        $comment_resposta = $wpdb->get_var('SELECT comment_content FROM '.$wpdb->prefix.'comments where comment_parent = '.$row_comments['comment_ID'].' LIMIT 0,1');
if ($comment_resposta == '') {; ?><?php echo ucwords($row_comments['comment_author']); ?>
,   beijos<?php } else {
 echo iconv('utf8','latin1',$comment_resposta);
}
?></textarea>
        <input type="submit" name="button" id="button" value="Responder" />
        <input name="voltar" type="hidden" id="voltar" value="http://www.anfitria.com.br<?php printf("%s?pageNum_comments=%d%s", $currentPage, min($totalPages_comments, $pageNum_comments), $queryString_comments); ?>" />
      </form></td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF" class="Maiusc">&nbsp;</td>
    </tr>

    

</table>

<?php } while ($row_comments = mysql_fetch_assoc($comments)); ?>

<table width="80%" border="0" align="center">

  <tr class="Maiusc">

    <td width="25%"><?php if ($pageNum_comments > 0) { // Show if not first page ?>

        <a href="<?php printf("%s?pageNum_comments=%d%s", $currentPage, 0, $queryString_comments); ?>">First</a>

        <?php } // Show if not first page ?></td>

    <td width="25%"><?php if ($pageNum_comments > 0) { // Show if not first page ?>

        <a href="<?php printf("%s?pageNum_comments=%d%s", $currentPage, max(0, $pageNum_comments - 1), $queryString_comments); ?>">Previous</a>

        <?php } // Show if not first page ?></td>

    <td width="25%"><?php if ($pageNum_comments < $totalPages_comments) { // Show if not last page ?>

        <a href="<?php printf("%s?pageNum_comments=%d%s", $currentPage, min($totalPages_comments, $pageNum_comments + 1), $queryString_comments); ?>">Next</a>

        <?php } // Show if not last page ?></td>

    <td width="25%"><?php if ($pageNum_comments < $totalPages_comments) { // Show if not last page ?>

        <a href="<?php printf("%s?pageNum_comments=%d%s", $currentPage, $totalPages_comments, $queryString_comments); ?>">Last</a>

        <?php } // Show if not last page ?></td>

  </tr>

</table>

</body>

</html>

<?php

mysql_free_result($comments);

?>