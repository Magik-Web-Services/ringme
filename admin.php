<?php
define('_MATAN', 1);


// include
include("conf.php");

require 'meta.php';
$meta = new meta;

// Meta
$act = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';
$title = $meta->getLoginPageTitle($act);
$code = rand(111111, 999999);
$code = "CLIENT{$code}";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="<?php echo $dir; ?>">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="<?= $keywords ?>" />
	<meta name="description" content="<?= $description ?>" />
	<meta name="robot" content="index,follow">
	<meta name="distribution" content="global" />
	<!-- <link rel="stylesheet" type="text/css" href="style/ad_style.css" /> -->
</head>

<body style="padding-top: 20px; background: #FFFFFF;" onload="document.loginform.user.focus();">
	<!----- <php echo $code; ?> ----->
	<!----- Container ----->
	<?php
	$act = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';
	switch ($act) {
		case 'logout':
			logout();
			break;
		default:
			login();
			break;
	}
	?>
	<!----- Container-End ----->
</body>

</html>
<?php

function login()
{
	function showForm()
	{
		echo <<<END
<form method="post" action="admin.php">
<div align="center">
<img src="admin/imagesadmin/title.png" />
</div>
<table style="width: 639px;" align="center" cellspacing="0" cellpadding="0">
 <tr>
  <td style="background: url('admin/imagesadmin/bgadmin.png') no-repeat top center; height: 107px; vertical-align: top">

	<div style="float: right; width: 264px; padding-right: 16px;">
		
	<form action="#" method="post" name="loginform"> 

	<table width="100%" >

	 <tr>
	  <td width="90%" style="vertical-align: top;">
	  
		<table width="100%">
		 <tr>
		  <td style="height: 10px;" colspan="2"></td>
		 </tr>

		 <tr>
		  <td style="font-weight: bold; color: #676767; width: 70%">
			<font face="Arial" size="2"><span style="font-weight: 400">שם משתמש:</span></font></td>

		  <td><input name="user" dir="ltr" type="text" value="" style="width: 130px; border: #dedede 1px solid; font-family: arial; font-size: 10pt; color: #676767;" /></td>
		 </tr>

		 <tr>
		  <td style="font-weight: bold; color: #676767">

			<font face="Arial" size="2"><span style="font-weight: 400">סיסמה:</span></font></td>
		  <td><input name="pass" dir="ltr" type="password" style="width: 130px; border: #dedede 1px solid; font-family: arial; font-size: 10pt; color: #676767;" /></td>
		 </tr>

		 <tr>

		  <td style="font-weight: bold; color: #676767">
			<img src="https://www.ringme.co.il/captcha.php" />
		  <td valign="top">

			<input name="security_code" id="security_code" dir="ltr" type="text" style="width: 130px; border: #dedede 1px solid; font-family: arial; font-size: 10pt; color: #676767;" /></td>
		 </tr>
		</table>
		
	  </td>
	  
	  <td style="padding-top: 20px; padding-right: 13px;">
	  		<input name="submit" type="hidden" value="submit" />
			<input type="image" src="admin/imagesadmin/hez.gif" />
	  </td>
	 </tr>

	</table>
	</form>
	</div>
</table>
END;
	}
	// Check if logged
	session_start();
	include("conf.php");
	if (isset($_SESSION["ad_login"])) {
		$login = "<img src=\"images/logo.png\"><br />";
		$login .= "<b>" . $_SESSION["ad_user"] . "</b> ברוך שובך, לא תצטרך להתחבר כי התחברת מקודם.<br />";
		$login .= "אתה מועבר כעת לפאנל..אנא המתן";
		$login .= "<meta http-equiv=\"refresh\" content=\"3;url=admin/index.php\">";

		$users = $_SESSION["ad_user"];
		mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");


		// Check if logged
	} else {
		// Do Login
		if (isset($_POST["submit"])) {
			/*if ($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'])) {*/
			$user = secure($_POST["user"]);
			$pass = md5($_POST["pass"]);
			if (empty($_POST["user"]) || empty($_POST["pass"])) {
				$msg = "אנא מלא את כל שדות הטופס";
			} else {

				$res = mysqli_query($link, "SELECT `id`,`user`,`group` FROM `members` WHERE `user` = '$user' AND `pass`='$pass'");
				if (mysqli_num_rows($res) > 0) {
					$r = mysqli_fetch_array($res);
					$_SESSION["ad_login"] = "logged";
					$_SESSION["ad_user"] = $r['user'];
					$_SESSION["ad_group"] = $r['group'];
					$login = "<img src=\"images/logo.png\"><br />";
					$login .= "ההתחברות בוצעה בהצלחה!" . $_SESSION['ad_login'];
					$login .= "<br />";
					$login .= "אתה מועבר כעת לפאנל..אנא המתן";
					$login .= "<meta http-equiv=\"refresh\" content=\"3;url=admin/index.php\">";
				} else {
					$msg = "שם משתמש ו/או סיסמא שגויים";
				}
			}
			/*unset($_SESSION['security_code']);*/
			/*} else {*/
			/*	$msg = "קוד האבטחה שגוי";*/
			/*}*/
		}
	}
	if ($login != "") {
		echo "<div align=\"center\">";
		echo $login;
		echo "</div>";
	} else {
		echo "<div align=\"center\">";
		echo $msg;
		echo "<br>";
		showForm();
		echo "</div>";
	}
}

function logout()
{
	session_destroy();
	echo "<div align=\"center\">";
	echo "ההתנתקות בוצעה בהצלחה!, אנה המתן...";
	echo "<meta http-equiv=\"refresh\" content=\"3;url=admin.php\">";
	echo "</div>";
}

function secure($sec)
{
	session_start();
	include("conf.php");
	return htmlspecialchars(mysqli_real_escape_string($link, trim($sec)));
}
?>