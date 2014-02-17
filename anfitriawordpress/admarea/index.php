<?php
require_once '../wp-config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../stylesheet.css" type="text/css" charset="utf-8">
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
<table width="90%" height="90%" border="0" align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td height="287"><form name="loginform" id="loginform" action="<?php echo get_option('siteurl');?>/wp-login.php" method="post">
        <table width="660" border="0" align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td class="style4">Administra&ccedil;&atilde;o</td>
          </tr>
          <tr>
            <td class="Maiusc">Login:
              <input type="text" name="log" id="user_login" /></td>
          </tr>
          <tr>
            <td class="Maiusc">Senha:
              <input type="text" name="pwd" id="user_pass" /></td>
          </tr>
          <tr>
            <td>	<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Lembrar</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Login">
		<input type="hidden" name="redirect_to" value="<?php echo get_option('siteurl');?>/admarea/admin.php">
		<input type="hidden" name="testcookie" value="1">
	</p>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>