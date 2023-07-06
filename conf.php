<?php
if (!defined('MAIN_DIR')) define('MAIN_DIR', 'http://localhost/demo/ringme/');
if (!defined('SITE_URL')) define('SITE_URL', 'http://localhost/demo/ringme/');


error_reporting(1);
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);

$hname = 'localhost';
$unamedb = 'root';
$passdb = '';
$namedb = 'ringme_test';

$link = mysqli_connect("localhost","root","","ringme_test");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
//
// $link = mysqli_connect("localhost","root","","ringme_test") or die ("Couldn't connect to server");


mysqli_set_charset($link, "utf8");


$db = mysqli_select_db($link,"ringme_test") or die("Couldn't connect to DB");


$conn = new mysqli($hname, $unamedb, $passdb, $namedb);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} mysqli_set_charset($conn,"utf8");


$site = "RingMe";
$slogan = "רינג מי - צלצולים להורדה";
$charset = "UTF-8";
$dir = "rtl";

$lang["success"] = "ההודעה נשלחה בהצלחה.";
$lang["info"] = "מידע";
$lang["fullname"] = "שם מלא";
$lang["iemail"] = "אימייל";
$lang["eror1"] = "שגיאה: ההודעה לא נשלחה";
$lang["eror2"] = "שגיאה: אחד או יותר השדות ריקים.";
?>