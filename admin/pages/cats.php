<?php
session_start();
?>
<HTML dir="rtl">

<HEAD>
	<TITLE>ניהול קטגוריות</TITLE>
	<link href='stylesheet.css' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='../java.js'></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="he" />
</HEAD>

<body bgcolor="#FFFFFF" style='padding:15px'>
	<?php
	//© All Rights Reserved 09/10 - CMS.co.il ©//
	define('_MATAN', 1);
	// session

	include "../../conf.php";

	if ($_SESSION["ad_group"] != 1)
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

	$do = (isset($_GET['do']) && !empty($_GET['do'])) ? $_GET['do'] : '';
	switch ($do) {
		case 'add':
			sng_add();
			break;
		case 'delete':
			if ($_SESSION["ad_group"] != 1)
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
			cat_delete();
			break;
		case 'edit':
			if ($_SESSION["ad_group"] != 1)
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
			cat_edit();
			break;
		default:
			cat_main();
			break;
	}


	function cat_main()
	{
		include "../../conf.php";
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת קטגוריות</b></td>
	</tr>
	</table>
	<br>

	<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='5' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת קטגוריות במערכת</b></td>
	</tr>
END;

		$limit = "13";
		$cpage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$cpage || $cpage < 1) {
			$cpage = 1;
		}
		$t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM category"));
		$p1 = $t / $limit;
		$pages = ceil($p1);
		$npage = $cpage + 1;
		$ppage = $cpage - 1;
		$i = ($cpage * $limit) - $limit;
		$res = mysqli_query($link, "SELECT * FROM category ORDER by id LIMIT $i,$limit");
		echo "<form method=\"POST\" name=\"form\" action=\"\">";
		echo "<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>שם הקטגורייה</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='7%'><b>מס' צלצולים</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'>עריכה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'>מחיקה</td>
	</tr>";
		while ($r = mysqli_fetch_array($res)) {

			$pagews = mysqli_query($link, "SELECT catid FROM songs WHERE catid = '{$r['id']}' ");
			$num_rows = mysqli_num_rows($pagews);


			echo "<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'><b>{$r['id']}</b></td>
	<td align='right' style='font-size:11px;'>{$r['name']}</td>
	<td align='right' style='font-size:11px;'>{$num_rows}</td>
	<td align='center' style='font-size:11px;'><a href='?act=cats&do=edit&id={$r['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
	<td align='center' style='font-size:11px;'></td>
	</tr>";
		}
		echo "</table></form>";
		if ($pages != 1) {
			$ii = 1;
			echo "<div align=center>";
			while ($ii <= $pages) {
				echo ",<a href='?act=cats&page=$ii'><font color='black'>$ii</font></a>";
				$ii++;
			}
			echo "</div>";
		}
		echo "</div>";
	}

	function cat_add()
	{
		include "../../conf.php";
		echo <<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">הוספת קטגורייה</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		function add_form()
		{
			echo <<<END
		<form method="post" action="?act=catss&do=add">
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם הקטגורייה: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אומן: </b></font>
				</td>
				<td align="right">	
					<input type="text" name="artist" size="50">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>url: </b></font>
				</td>
				<td align="right">
					<input type="text" name="url" dir="ltr" size="50" value="http://www.mizton.co.il/ring">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קטגוריה: </b></font>
				</td>
				<td align="right">
					<select name="cat">
					<option value="1" selected>מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">שונות</option>
					<option value="5">הבקשות שלכם</option>
				</td>
			</tr>
			<tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name = "submit" value="הוסף"></td>
			</tr>
		</table>
		</form> 
END;
		}

		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			if (empty($name)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				mysqli_query($link, "INSERT INTO `songs` ( `name` ,`artist` ,`url` ,`catid` ) VALUES ( '$name' ,'$artist' ,'$url' ,'$cat' )");
				// if (mysqli_insert_id()) {
				$reg = "OK";
				$error = "הוספת השיר בוצעה בהצלחה";
				$log = " $name יצירת שיר";
				$name = $_SESSION["ad_user"];
				mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$name', UNIX_TIMESTAMP())");
				// } else {
				// $error = "אירעה שגיאה במהלך הרישום, אנה נסה שנית";
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

	function cat_edit()
	{
		include "../../conf.php";
		$id =(isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : '1';;
		$res = mysqli_query($link, "SELECT name FROM category WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת קטגוריות > עריכת קטגוריית {$r['name']}</b></td>
	</tr>
	</table>
	<br>
END;
		function edit_form()
		{
			include "../../conf.php";
			$id = $_GET['id'];
			$res = mysqli_query($link, "SELECT * FROM category WHERE `id` = '$id'");
			$r = mysqli_fetch_array($res);
			echo <<<END
		<form method="post" action="?act=cats&do=edit">
		<input type='hidden' name='edit' value='{$id}'>
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם הקטגורייה: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50" value="{$r['name']}">
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 
END;
		}
		$edit = "";
		$error = "";
		if (isset($_POST['submit']) && $_POST['submit'] == "ערוך") {
			$id = $_POST['edit'];
			$res = mysqli_query($link, "SELECT * FROM category WHERE id='$id' ");
			$r = mysqli_fetch_array($res);
			// vars
			$id = $r['id'];
			$name = $_POST['name'];
			// start update
			if (empty($name)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				mysqli_query($link, "UPDATE `category` SET `name` = '$name' WHERE `id` = $id ");

				$error = "עריכת השיר בוצעה בהצלחה";
				$edit = "OK";
				$log = "<u>עריכת קטגוריית:</u> $name";
				$name = $_SESSION["ad_user"];
				mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$name', UNIX_TIMESTAMP())");
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

	function cat_delete()
	{
		include "../../conf.php";
		echo <<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">מחיקת שיר</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$error = (empty($_POST['edit'])) ? "אנה בחר שיר" : "";
		if (empty($error)) {
			$id = $_POST['edit'];
			$ues = mysqli_query($link, "SELECT name FROM songs WHERE `id` = '$id'");
			$u = mysqli_fetch_array($ues);
			$named = $u['name'];
			$log = "$named מחיקת שיר";
			$name = $_SESSION["ad_user"];
			mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$name', UNIX_TIMESTAMP())");
			mysqli_query($link, "DELETE FROM `songs` WHERE `id` = '$id' ");
			echo "<div align=\"center\">";
			echo " השיר $named נמחק בהצלחה!";
			echo "</div>";
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		}
		echo "</div>";
	}
	?>