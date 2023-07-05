<?php
session_start(); 
?>

<HTML dir="rtl">
<HEAD>
  <TITLE>ניהול קבוצות</TITLE>
<link href='stylesheet.css' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='../java.js'></script> 
</HEAD>
<body bgcolor="#FFFFFF" style='padding:15px'>

<?php
//© All Rights Reserved 09/10 - CMS.co.il ©//
define( '_MATAN', 1 );
// session
include "../../conf.php";

$admin = $_SESSION['ad_user'];
$tes = mysqli_query($link,"SELECT * FROM `members` WHERE `user` = '{$admin}'");
$r = mysqli_fetch_array($tes);

if($r["group"] > "1")
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

defined('_MATAN');
if ($_SESSION["ad_group"] != 1)
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
$do = $_GET['do'];
switch($do)
{	
	case 'add':
		group_add();
		break;
	case 'delete':
		group_delete();
		break;
	case 'edit':
		group_edit();
		break;
	default:
		group_main();
		break;             
}  

	function group_main()
	{
	    include "../../conf.php";
echo<<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">רשימת הדרגות באתר</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$res = mysqli_query($link,"SELECT * FROM `groups` ORDER BY `id`");
		echo "<form method=\"POST\" name=\"form\" action=\"\">";
		echo "<table align = \"center\" cellpadding=\"2\" cellspacing=\"1\" style=\"background-color:#ededed; font-family:Arial; font-size:8pt\" width=\"95%\" dir=\"rtl\">";
		echo "<tr bgcolor=\"white\">";
		echo "<td align='center'>ערוך</td><td align='center'>מחק</td><td align='center'>ID:</td><td  align='center'>שם:</td><td  align='center'>מס' משתמשים</td>";
		echo "</tr>";
		while($r = mysqli_fetch_array($res))
		{
		$perfix = html_entity_decode($r['perfix']);
		$serfix = html_entity_decode($r['serfix']);
		$numofmem = mysqli_num_rows(mysqli_query($link,"SELECT `id` FROM `members` WHERE `group`='$r[id]' "));
		echo "<tr bgcolor='white' onMouseOver=this.bgColor='#f4f4f4' onMouseOut=this.bgColor='white'>";
		echo "<td align='center'><input type=\"radio\" value=\"$r[id]\" name=\"edit\" onclick=\"form.action='?act=group&do=edit'\"></td><td align='center'><input type=\"radio\" value=\"$r[id]\" name=\"edit\" onclick=\"form.action='?act=group&do=delete'\"></td><td  align='center'>$r[id]</td><td  align='center'>$perfix$r[name]$serfix</td><td  align='center'>$numofmem</td>";
		echo "</tr>";
		} 
		echo "<tr bgcolor=\"white\">";
		echo "<td colspan=\"11\" align='center'><input type=\"submit\" class='click' value=\"שלח\" name=\"submit\"></td>";
		echo "</tr>";
		echo "</table></form>";
	echo "</div>";
	}

	function group_add()
	{
	    include "../../conf.php";
echo<<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">הוספת דרגה חדשה</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		function add_form()
		{
		echo <<<END
		<form method="post" action="?act=group&do=add">
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם:</b></font>
				</td>
				<td align="right">
					<input type="text" name="name">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קידומת:</b></font>
				</td>
				<td align="right">	
					<input type="text" name="perfix">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>סיומת:</b></font>
				</td>
				<td align="right">
					<input type="text" name="serfix">
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" class='click' name = "submit" value="הוסף"></td>
			</tr>
		</table>
		</form> 
END;
		}
		
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$perfix = htmlentities(trim($_POST['perfix']));
			$serfix = htmlentities(trim($_POST['serfix']));
			if (empty($name)) {
				$error = "אנה מלא את כל שדות הטופס הרצויים";
			} else {
				$res = mysqli_query($link,"SELECT `id` FROM `groups` WHERE `name` = '$name'");
				if (mysqli_num_rows($res) == 0) {
					mysqli_query($link,"INSERT INTO `groups` ( `name`, `perfix` ,`serfix` ) VALUES ('$name', '$perfix', '$serfix' )");
					// if (mysqli_insert_id()) {
						$reg ="OK";
						$error = "הוספת הקבוצה בוצעה בהצלחה";
						$log = " $name יצירת קבוצה";
						$user = $_SESSION["ad_user"];
						mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP())");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
					} else {
						$error = "אירעה שגיאה במהלך הרישום, אנה נסה שנית";
					}
				// } else {
				// 	$error = "שם זה תפוס, אנה בחר שם אחר לדרגה החדשה";
				// }
			}
		}
		if ($reg == "OK") {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
			add_form();	
		}
	echo "</div>";
	}

	function group_edit()
	{
	    include "../../conf.php";
		$id = $_POST['edit'];
		$tes = mysqli_query($link,"SELECT name FROM groups WHERE `id` = '$id'");
		$t = mysqli_fetch_array($tes);
echo<<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">עריכת דרגת {$t['user']}</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		function edit_form()
		{
		    include "../../conf.php";
		$id = $_POST['edit'];
		$res = mysqli_query($link,"SELECT * FROM `groups` WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
		$perfix = $r['perfix'];
		$serfix = $r['serfix'];
		echo <<<END
		<form method="post" action="?act=group&do=edit">
		<input type='hidden' name='edit' value='{$id}'>
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם הדרגה: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" value="{$r['name']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קידומת: </b></font>
				</td>
				<td align="right">
					<input type="text" name="perfix" value="{$perfix}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>סיומת: </b></font>
				</td>
				<td align="right">
					<input type="text" name="serfix" value="{$serfix}">
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" class='click' name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 
END;
		}

		if (isset($_POST['submit']) && $_POST['submit'] == "ערוך") {
			$id = $_POST['edit'];
			$res = mysqli_query($link,"SELECT id, name FROM groups WHERE id='$id' ");
			$r = mysqli_fetch_array($res);
			// vars
			$id = $r['id'];
			$name = $_POST['name'];
			$perfix = htmlentities(mysqli_real_escape_string($link,trim($_POST['perfix'])));
			$serfix = htmlentities(mysqli_real_escape_string($link,trim($_POST['serfix'])));
			$false = false;
			//vars
			// if x else y
			if ($name == $r['name']) { 
			$name = $r['name'];
			$uk = "ok";
			}
			// if x eles y
			// check if exist email & user in our system
			if ($uk != "ok") {
				$tes = mysqli_query($link,"SELECT id FROM groups WHERE `name`='$name'");
				if (mysqli_num_rows($tes) != 0) {
					$error = "שם זה תפוס אנה בחר שם אחר";
					$false = true;
				}
			}
			// end check
			if ($false == false) {
			// start update
			if (empty($name)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				mysqli_query($link,"UPDATE `groups` SET `name` = '$name' WHERE `id` = '$id' ");
				mysqli_query($link,"UPDATE `groups` SET `perfix` = '$perfix' WHERE `id` = '$id' ");
				mysqli_query($link,"UPDATE `groups` SET `serfix` = '$serfix' WHERE `id` = '$id' ");

				$error = "עריכת הקבוצה בוצעה בהצלחה";
				$edit = "OK";
				$log = " $user עריכת קבוצה";
				$user = $_SESSION["ad_user"];
				mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP())");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
			}
		}
		}
		
		if ($edit == "OK") {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
			edit_form();	
		}
	echo "</div>";
	}

	function group_delete()
	{
	    include "../../conf.php";
echo<<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">מחיקת קבוצה</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$error = (empty($_POST['edit'])) ? "אנה בחר קבוצה" : "";
		if (empty($error)) {
		$id = $_POST['edit'];
		$ues = mysqli_query($link,"SELECT name FROM groups WHERE `id` = '$id'");
		$u = mysqli_fetch_array($ues);
		$userd = $u['name'];
		$log = "$userd מחיקת קבוצה";
		$user = $_SESSION["ad_user"];
		mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP())");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

		mysqli_query($link,"DELETE FROM `groups` WHERE `id` = '$id' ");
		echo "<div align=\"center\">";
		echo " המשתמש $userd נמחק בהצלחה!";
		echo "</div>";
		} else {
		echo "<div align=\"center\">";
		echo $error;
		echo "</div>";
		}
	echo "</div>";
	}
?>