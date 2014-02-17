<?php require_once('../Connections/BLOG_MATRIZ.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";

$MM_donotCheckaccess = "true";



// *** Restrict Access To Page: Grant or deny access to this page

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 

  // For security, start by assuming the visitor is NOT authorized. 

  $isValid = False; 



  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 

  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 

  if (!empty($UserName)) { 

    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 

    // Parse the strings into arrays. 

    $arrUsers = Explode(",", $strUsers); 

    $arrGroups = Explode(",", $strGroups); 

    if (in_array($UserName, $arrUsers)) { 

      $isValid = true; 

    } 

    // Or, you may restrict access to only certain users based on their username. 

    if (in_array($UserGroup, $arrGroups)) { 

      $isValid = true; 

    } 

    if (($strUsers == "") && true) { 

      $isValid = true; 

    } 

  } 

  return $isValid; 

}



$MM_restrictGoTo = "../index.php";

if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   

  $MM_qsChar = "?";

  $MM_referrer = $_SERVER['PHP_SELF'];

  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";

  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 

  $MM_referrer .= "?" . $QUERY_STRING;

  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);

  header("Location: ". $MM_restrictGoTo); 

  exit;

}

?>
<?php

if ((isset($_POST["updown"])) && ($_POST["updown"] == "form3")) {

//UPLOAD IMAGENS



if($_FILES['foto']['name'] != "") 

{ //verifica se tem foto

	

$nome = $_FILES['foto']['name'];

$tipo = $_FILES['foto']['type'];

$nome = strtolower($nome);

$tipo = strtolower($tipo);

$extensao = strrchr($nome, '.');



$lista_segura = array(".jpg",".JPG",".jpeg",".gif",".png");

if (!(in_array($extensao, $lista_segura ))) {

	die('So podera fazer o uploade de imagens em formato GIF, JPEG e PNG. <a href="fotos.php">Voltar</a>');

}



$pos = strpos($nome, 'php');

if(!($pos === false)) {

	die('Erro, o ficheiro contem php nao permitido. <a href="fotos.php">Voltar</a>');

}



//$pos = strpos($nome, 'image');

//if($pos === false) {

//	die('Erro, o ficheiro nao e uma imagem.');

//}



$detalhes = getimagesize($_FILES['foto']['tmp_name']);

if($detalhes['mime'] != 'image/gif' && $detalhes['mime'] != 'image/jpeg' && $detalhes['mime'] != 'image/jpg' && $detalhes['mime'] != 'image/png') {

	die('Erro, o ficheiro nao e uma imagem. <a href="fotos.php">Voltar</a>');

}



if(substr_count($tipo, '/')>1){

	die('Erro, o ficheiro contem dupla extensao e tal nao e permitido. <a href="fotos.php">Voltar</a>');

}



if(!is_uploaded_file($_FILES['foto']['tmp_name'])) {

	die('So podera fazer o upload apartir do nosso script. <a href="fotos.php">Voltar</a>');

}



if($_FILES['foto']['size']  > (1024000)){

	die('Oops!  O seu ficheiro e demasiado grande, o limite e 1 MB.<a href="fotos.php">Voltar</a>');

}



$destino = "../uploads/";

if (!file_exists($destino)) {

	mkdir( $destino, 0777);

}

$logomarca = $_POST["codigo"];

$imagem_final = $destino . $logomarca . $extensao;

$nomedafoto = $logomarca . $extensao;


$moveu = move_uploaded_file($_FILES['foto']['tmp_name'],$imagem_final);

$imagem = $imagem_final; // imagem que será redimensionada
$imagem_redimensionada = $imagem_final; //nova imagem
list($largura, $altura) = getimagesize($imagem);
$nova_largura = 595; // nova largura
$nova_altura = ($nova_largura * $altura) / $largura; // calcula a nova altura
$image_p = imagecreatetruecolor($nova_largura, $nova_altura); 
$image = imagecreatefromjpeg($imagem);


imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura, $altura);
imagejpeg($image_p, $imagem_final, 90);
//imagedestroy($image_p);





if($moveu) { 

echo '<table width="100%" border="0" cellspacing="5" cellpadding="5">

    <tr>

      <td align="center" bgcolor="#ECFBFF" style="font-family:Tahoma, Geneva, sans-serif; color:#069; font-size:15px; border:solid 1px #09C;" >A foto foi enviada com sucesso!</td>

  </tr>

</table>
<meta http-equiv="refresh" content="2;url=http://anfitria.com.br/admarea/fotos.php"> 

'; 

} 

else 

{ 

    echo "O campo Foto do formulario nao foi preenchido"; 

	$imagem_final = "../laden/semfoto.jpg"; 

}



} //verifica se tem foto

else 

{ 

 echo "O campo Foto do formulario nao foi preenchido"; 

$imagem_final = "../laden/semfoto.jpg"; 

} //verifica se tem foto



// Upload Imagens

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



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {

  $insertSQL = sprintf("INSERT INTO foto (foto_codigo, foto_nome) VALUES (%s, %s)",

                       GetSQLValueString($_POST['codigo'], "text"),

                       GetSQLValueString($nomedafoto, "text"));



  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

  $Result1 = mysql_query($insertSQL, $BLOG_MATRIZ) or die(mysql_error());

}



if ((isset($_GET['deletar'])) && ($_GET['deletar'] != "")) {

  $deleteSQL = sprintf("DELETE FROM foto WHERE foto_id=%s",

                       GetSQLValueString($_GET['deletar'], "int"));



  mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

  $Result1 = mysql_query($deleteSQL, $BLOG_MATRIZ) or die(mysql_error());



$getfoto = $_GET['foto'];

//unlink("../uploads/$getfoto"); 



}



$currentPage = $_SERVER["PHP_SELF"];



$maxRows_mostra_fotos = 15;

$pageNum_mostra_fotos = 0;

if (isset($_GET['pageNum_mostra_fotos'])) {

  $pageNum_mostra_fotos = $_GET['pageNum_mostra_fotos'];

}

$startRow_mostra_fotos = $pageNum_mostra_fotos * $maxRows_mostra_fotos;



mysql_select_db($database_BLOG_MATRIZ, $BLOG_MATRIZ);

$query_mostra_fotos = "SELECT * FROM foto ORDER BY foto_id DESC";

$query_limit_mostra_fotos = sprintf("%s LIMIT %d, %d", $query_mostra_fotos, $startRow_mostra_fotos, $maxRows_mostra_fotos);

$mostra_fotos = mysql_query($query_limit_mostra_fotos, $BLOG_MATRIZ) or die(mysql_error());

$row_mostra_fotos = mysql_fetch_assoc($mostra_fotos);



if (isset($_GET['totalRows_mostra_fotos'])) {

  $totalRows_mostra_fotos = $_GET['totalRows_mostra_fotos'];

} else {

  $all_mostra_fotos = mysql_query($query_mostra_fotos);

  $totalRows_mostra_fotos = mysql_num_rows($all_mostra_fotos);

}

$totalPages_mostra_fotos = ceil($totalRows_mostra_fotos/$maxRows_mostra_fotos)-1;



$queryString_mostra_fotos = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_mostra_fotos") == false && 

        stristr($param, "totalRows_mostra_fotos") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_mostra_fotos = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_mostra_fotos = sprintf("&totalRows_mostra_fotos=%d%s", $totalRows_mostra_fotos, $queryString_mostra_fotos);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<style type="text/css">
.superwidth {
	width: 100%;
}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>



<body>

<table width="46%" border="0" cellspacing="3" cellpadding="3">

  <tr>

    <form name="form3" enctype="multipart/form-data" method="POST" action="<?php echo $editFormAction; ?>">

      <td width="67%" align="left" valign="middle" nowrap="nowrap">
        
        Upload Foto:
        
        <input name="foto" type="file" id="foto" size="15">
        
        <input type="submit" name="button" id="button" value="Enviar">
        
        <input name="updown" type="hidden" id="updown" value="form3">
        
      <input name="codigo" type="hidden" id="codigo" value="<?php echo time(); ?>"><input type="hidden" name="MM_insert" value="form3"></td>
      <td width="17%" align="center" nowrap="nowrap"><a href="fotox.php">
        <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('self',this,1)">
          <option value="fotos.php" selected="selected">Logo Matiz</option>
          <option value="fotox.php">Sem Carimbo</option>
          <option value="fotoy.php">S/ Carimbo e Contorno</option>
          <option value="fotoz.php" >Assinatura Preto</option>
          <option value="fotob.php">Assinatura Branco</option>
          <option value="fotoscz.php">S/ Carimbo + Ass Preto</option>
          <option value="fotoscb.php">S/ Carimbo + Ass Branco</option>
        </select>
      </a></td>
    </form>

  </tr>
 

</table>



<?php do { ?>

  <div style="padding:5px; FLOAT:left; width:100px;"><img src="../uploads/marca.php?show=<?php echo $row_mostra_fotos['foto_nome']; ?>" border="1" class="superwidth" style="border-color:#CCC; padding:5px;"><img src="del.gif" width="109" height="18" border="0" usemap="#Map<?php echo $row_mostra_fotos['foto_id']; ?>" />

    <map name="Map<?php echo $row_mostra_fotos['foto_id']; ?>" id="Map<?php echo $row_mostra_fotos['foto_id']; ?>">

      <area shape="rect" coords="96,6,103,13" href="?deletar=<?php echo $row_mostra_fotos['foto_id']; ?>&foto=<?php echo $row_mostra_fotos['foto_nome']; ?>" target="painel" onclick="return (confirm('Você realmente quer deletar essa foto?'))" >

    </map>

  </div>

  <?php } while ($row_mostra_fotos = mysql_fetch_assoc($mostra_fotos)); ?>

<p>&nbsp;</p>
<table width="300" border="0">
  <tr>
    <td><?php if ($pageNum_mostra_fotos > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_mostra_fotos=%d%s", $currentPage, 0, $queryString_mostra_fotos); ?>">|&lt;&lt;</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_mostra_fotos > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_mostra_fotos=%d%s", $currentPage, max(0, $pageNum_mostra_fotos - 1), $queryString_mostra_fotos); ?>">&lt;&lt;</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_mostra_fotos < $totalPages_mostra_fotos) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_mostra_fotos=%d%s", $currentPage, min($totalPages_mostra_fotos, $pageNum_mostra_fotos + 1), $queryString_mostra_fotos); ?>">&gt;&gt;</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_mostra_fotos < $totalPages_mostra_fotos) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_mostra_fotos=%d%s", $currentPage, $totalPages_mostra_fotos, $queryString_mostra_fotos); ?>">&gt;&gt;|</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>

</html>

<?php

mysql_free_result($mostra_fotos);

?>

