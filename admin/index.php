<?php
define('_MATAN', 1);


// if (!isset($_SESSION["ad_login"])) {
//   header('location: ../admin.php');
// }
session_start();
$_SESSION['ad_user'] = 'admin';

// include
include("../conf.php");
require '../meta.php';
$meta = new meta;

// Meta
$act = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';
$title = $meta->getAdminPageTitle($act);

if ($_SESSION['ad_user'] == "admin") {
  $nameadmin = "Admin";
} else {
  $nameadmin = $_SESSION['ad_user'];
}

if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad8')) {
?>
  <!DOCTYPE html>
  <html xmlns="https://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
  <html dir="rtl" lang="he">

  <HEAD>
    <TITLE>CMS v2.0 (מחובר)</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="he" />
  </HEAD>
  <frameset rows="80%,150">

    <frame src="pages/main.php" name="frame1" id="frame1" noresize="1" frameborder='0' marginwidth="0" marginheight="0">
      <frame src="menu.php" name="frame2" id="frame2" noresize="1" frameborder='0' style='border-left:0px solid #c0c0c0' marginwidth="0" marginheight="0">

  </frameset>
<?php
} else {
?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <HTML dir="rtl">

  <HEAD>
    <TITLE>CMS v2.0 (מחובר)</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="he" />
  </HEAD>


  <frameset cols="80%,180">
    <frame src="pages/main.php" name="frame1" id="frame1" noresize="1" frameborder='0' marginwidth="0" marginheight="0">
      <frame src="menu.php" name="frame2" id="frame2" noresize="1" frameborder='0' style='border-left:0px solid #c0c0c0' marginwidth="0" marginheight="0">
  </frameset>

<?php
}
?>
</body>

  </html>