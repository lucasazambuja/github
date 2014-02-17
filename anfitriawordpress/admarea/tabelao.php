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

mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);
$query_comentarios = "SELECT * FROM comments ORDER BY comment_nome ASC";
$comentarios = mysql_query($query_comentarios, $BLOG_MATRIZ) or die(mysql_error());
$row_comentarios = mysql_fetch_assoc($comentarios);
$totalRows_comentarios = mysql_num_rows($comentarios);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="iso-8859-1">
<title>Untitled Document</title>
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-transform: uppercase;
}
</style>
</head>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="3">
  <tr>
    <td><strong>NOME</strong></td>
    <td><strong>EMAIL</strong></td>
    <td><strong>TEXTO</strong></td>
    <td><strong>RESPOSTA</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_comentarios['comment_nome']; ?></td>
      <td><?php echo $row_comentarios['comment_mail']; ?></td>
      <td><?php echo $row_comentarios['comment_texto']; ?></td>
      <td><?php echo $row_comentarios['comment_resposta']; ?></td>
    </tr>
    <tr>
      <td colspan="4"><hr></td>
    </tr>
    <?php } while ($row_comentarios = mysql_fetch_assoc($comentarios)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($comentarios);
?>
