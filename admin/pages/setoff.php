<?php
session_start(); 
?>
<HTML dir="rtl">
<HEAD>
  <TITLE>כיבוי/הפעלת המערכת</TITLE>
<link href='stylesheet.css' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='../../java.js'></script> 
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</HEAD>
<body bgcolor="#FFFFFF" style='padding:15px'>

<?php
//© All Rights Reserved 09/10 - CMS.co.il ©//
define( '_MATAN', 1 );
// session

if ($_SESSION["ad_group"] != 1)
die("אין לך גישה, אנא פנה למנהל שלך על מנת לפתור בעיה זו");

include "../../conf.php";
include "functionss.php";

$admin = $_SESSION[ad_user];
$tes = mysqli_query($link,"SELECT * FROM `members` WHERE `user` = '{$admin}'");
$r = mysqli_fetch_array($tes);

if($r["group"] > "1")
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

?>

<?php

    	switch($_POST["CODE"]) {
    		case '00':
    			edit();
    			break;
    		case '01':
    			do_edit();
    			break;
    		default:
    			edit();
    			break;
    	}

	function edit()
	{
include "../../conf.php";
		$result = mysqli_query($link,"SELECT * FROM settings");
		$row = mysqli_fetch_array($result);

		echo "
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>הגדרות המערכת:</font> <b>כיבוי/הפעלת המערכת</b></td>
	</tr>
	</table><br>
	<form action='setoff.php' method='post'>
	<input type='hidden' name='CODE' value='01'>
<table cellpadding='2' cellspacing='0'>
<tr>
<td style='font-size:12px'><b>כיבוי המערכת</b></td>
<td><input type='radio' name='off' value='0' class='forminput' style='border:0px' "; if ($row['send'] == 0) echo "checked"; echo"> לא <input type='radio' name='off' value='1' class='forminput' style='border:0px' "; if ($row['send'] == 1) echo "checked"; echo "> כן</td>	
</tr>
<tr>
<td style='font-size:12px'><b>כיבוי פרסומות קופצות - הורדה</b></td>
<td><input type='radio' name='offup' value='0' class='forminput' style='border:0px' "; if ($row['sendup'] == 0) echo "checked"; echo"> לא <input type='radio' name='offup' value='1' class='forminput' style='border:0px' "; if ($row['sendup'] == 1) echo "checked"; echo "> כן</td>	
</tr>
<tr>
<td style='font-size:12px'><b>כיבוי פרסומות קופצות - ספאם</b></td>
<td><input type='radio' name='offupa' value='0' class='forminput' style='border:0px' "; if ($row['sendupa'] == 0) echo "checked"; echo"> לא <input type='radio' name='offupa' value='1' class='forminput' style='border:0px' "; if ($row['sendupa'] == 1) echo "checked"; echo "> כן</td>	
</tr>
<tr>
<td style='font-size:12px'><b>כיבוי הבקשות</b></td>
<td><input type='radio' name='offs' value='0' class='forminput' style='border:0px' "; if ($row['sends'] == 0) echo "checked"; echo"> לא <input type='radio' name='offs' value='1' class='forminput' style='border:0px' "; if ($row['sends'] == 1) echo "checked"; echo "> כן</td>	
</tr>
<tr>
<td style='font-size:12px'><b>כותרת כיבוי המערכת</b></td>
<td><input type='text' size='25' maxlength='25' name='site_off_title' value='{$row['site_off_title']}' class='forminput'></td>	
</tr>
<tr>
<td style='font-size:12px'><b>פירוט כיבוי המערכת</b></td>
<td><textarea id='editor_kama' name='site_off_desc' cols='80' rows='10'>{$row['site_off_desc']}</textarea></td>

<script type='text/javascript'>
//<![CDATA[
CKEDITOR.replace( 'editor_kama',
{
skin : 'kama',
language : 'he'
});
//]]></script>

</tr>

</table>
<br>
	<input type='submit' name='submit' value='עדכן נתונים' class='forminput'>
	</form>

	";

	}

	function do_edit()
	{
	    include "../../conf.php";
		$result = mysqli_query($link,"UPDATE settings SET send = '{$_POST["off"]}' ");
		$result = mysqli_query($link,"UPDATE settings SET sendup = '{$_POST["offup"]}' ");
		$result = mysqli_query($link,"UPDATE settings SET sendupa = '{$_POST["offupa"]}' ");
		$result = mysqli_query($link,"UPDATE settings SET sends = '{$_POST["offs"]}' ");
		$result = mysqli_query($link,"UPDATE settings SET site_off_title = '{$_POST["site_off_title"]}' ");
		$result = mysqli_query($link,"UPDATE settings SET site_off_desc = '{$_POST["site_off_desc"]}' ");

	if ($_POST["off"] == 1) {
	$img = "6";
	$log = "כיבה את האתר";
	} else if ($_POST["off"] == 0) {
	$img = "5";
	$log = "הפעיל את האתר";
	} else if ($_POST["offupa"] == 1) {
	$img = "5";
	$log = "הפעיל את הפרסומות הקופצות - רגיל";
	} else if ($_POST["offupa"] == 0) {
	$img = "6";
	$log = "כיבה את הפרסומות הקופצות - רגיל";
	} else if ($_POST["offup"] == 1) {
	$img = "5";
	$log = "הפעיל את הפרסומות הקופצות - הורדה";
	} else if ($_POST["offup"] == 0) {
	$img = "6";
	$log = "כיבה את הפרסומות הקופצות - הורדה";
	}  
	//if ($_POST["offs"] == 1) {
	//$img = "6";
	//$log ="כיבה את בקשת הצלצולים";
	//} else if ($_POST["offs"] == 0) {
	//$img = "5";
	//$log = "הפעיל את בקשת הצלצולים";
	//}


	$user = $_SESSION["ad_user"];
	mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER[REMOTE_ADDR]}', '$log', '$user', UNIX_TIMESTAMP(), '$img')");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER[REMOTE_ADDR]}' WHERE `user` = '$users' ");

		redirect_user ("setoff.php","הגדרות המערכת עודכנו בהצלחה!");
	}

?>

</body>
</html>