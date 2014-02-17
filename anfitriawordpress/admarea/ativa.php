<?php require_once('../wp-config.php'); 
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

$voltar = $_GET['voltar'];

if ((isset($_GET['post_id'])) && ($_GET['post_id'] != "")) {

  $deleteSQL = sprintf("UPDATE wp_comments SET comment_approved = 1 WHERE comment_ID = %s",

                       GetSQLValueString($_GET['post_id'], "int"));



  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

  $Result1 = mysql_query($deleteSQL, $BLOG_MATRIZ) or die(mysql_error());





}

?>

<meta http-equiv="refresh" content="1;URL=<?php echo $voltar;?>" />