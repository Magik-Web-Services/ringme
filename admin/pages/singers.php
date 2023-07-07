<?php
session_start();
?>
<HTML dir="rtl">

<HEAD>
	<TITLE>ניהול זמרים</TITLE>
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

	if ($_SESSION["ad_group"] != 1)
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

	include "../../conf.php";
	// include "functionss.php";

	$do = (isset($_GET['do']) && !empty($_GET['do'])) ? $_GET['do'] : '';
	switch ($do) {
		case 'add':
			singer_add();
			break;

		case 'delete':
			if ($_SESSION["ad_group"] != 1)
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

			$admin = $_SESSION['ad_user'];
			$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$r = mysqli_fetch_array($tes);

			if ($r["group"] > "1")
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

			singer_delete();
			break;
		case 'edit':
			if ($_SESSION["ad_group"] != 1)
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
			singer_edit();
			break;

		case 'search':
			singer_search();
			break;

		default:
			singer_main();
			break;
	}

	$idcat = (isset($_GET['catt']) && !empty($_GET['catt'])) ? $_GET['catt'] : '';
	function singer_main()
	{
		$APage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		include "../../conf.php";
		$admin = $_SESSION['ad_user'];
		$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
		$r = mysqli_fetch_array($tes);

		if ($r["group"] == "1") {
			$ups = "<a href='../urikaskings.php'>העלה</a>";
		} else {
		}

		if (!$APage) {
			$page = "";
		} else {
			$page = " עמוד מספר " . $APages;
		}

		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול זמרים:</font> <b>רשימת זמרים</b> {$page} </td>
	</tr>
	</table>
	<br>

	<table cellpadding='3' cellspacing='0' width='100%' style='background-color:#FFFFFF;color:#062b4d;border:1px dashed #d1d1d1'>
	<tr>
	<td align='right'><img src='images/search.jpg' style='vertical-align:middle'> חיפוש זמר</td>
	<td align='right'><form action='?act=singers&do=search' method='post'>
	מס' הזמר: <input type='text' name='keysd' maxlength='6' onKeyPress='return isNumberKey(event);' class='forminput' value='' style='text-align:center;direction:ltr;width:50px'>
	<input type='submit' name='submits' value=' חפש ' class='forminput'></td> 
	<td align='right'>
	שם הזמר: <input type='text' name='keys' onKeyPress='return isNumberKey(event);' class='forminput' value='' style='text-align:center;direction:ltr;width:100px'>
	<input type='submit' name='submits' value=' חפש ' class='forminput'>
	</form></td>
	</tr>
	</table>
	<br>
END;

		if (isset($_POST['submit'])) {
			$_SESSION["catss"] = $_POST["catt"];
		}

		$limit = "20";
		$cpage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$cpage || $cpage < 1) {
			$cpage = 1;
		}
		$t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM singers"));
		$p1 = $t / $limit;
		$pages = ceil($p1);
		$npage = $cpage + 1;
		$ppage = $cpage - 1;
		$i = ($cpage * $limit) - $limit;
		$corder = (isset($_GET['order']) && !empty($_GET['order'])) ? $_GET['order'] : '';

		if (!$corder) {
			$downa = "<a href='?order=1'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות צלצולים' border='0'> <b>מס' צלצולים</b></a>";
		} else if ($corder == "1") {
			$downa = "<a href='singers.php'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות צלצולים' border='0'> <b>מס' צלצולים</b></a>";
		}


		echo "<form method=\"POST\" name=\"form\" action=\"\">";

		echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='8' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת זמרים במערכת</b></td>
	</tr>

	<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>שם הזמר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>מספר צלצולים</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוז צלצולים</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>מספר הורדות</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוז הורדות</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>עריכה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>מחיקה</td>
	</tr>";

		if ($_SESSION["ad_group"] != 1) {
			$save = "disabled=\"disabled\"";
		} else {
			$save = "";
		}


		$res = mysqli_query($link, "SELECT * FROM singers ORDER by id DESC LIMIT $i,$limit");

		$r = 1;
		$tes = mysqli_query($link, "SELECT * FROM `singers`");
		$t = mysqli_fetch_array($tes);






		while ($r = mysqli_fetch_array($res)) {

			session_start();
			$admin = $_SESSION['ad_user'];
			$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$rq = mysqli_fetch_array($tesq);

			if ($rq["group"] == "1") {
				$delete = "<a href='?act=singers&do=delete&id={$r['id']}'><img src='images/delete.png' alt='מחיקה' border='0' style='vertical-align:middle'></a>";
			}

			$song = $r['name'];
			$query = "SELECT SUM(downloads) FROM songs WHERE `artist` LIKE '%$song%'";
			$result = mysqli_query($link, $query) or die();
			while ($row = mysqli_fetch_array($result)) {
				$downloadsss = $row['SUM(downloads)'];
			}

			$query = "SELECT SUM(downloads) FROM songs";
			$result = mysqli_query($link, $query) or die();
			while ($row = mysqli_fetch_array($result)) {
				$downloadss = $row['SUM(downloads)'];
			}

			$all = $downloadss;
			$ccc = $downloadsss;
			if ($all != 0)
				$p = ceil(($ccc / $all) * 100);
			else
				$p = 0;
			$p = "{$p}%";

			if ($p > 2) {
				$p = "<font color='green'><b>{$p}</b></font>";
			} else {
				$p = "{$p}";
			}

			$song = $r['name'];
			$pagews = mysqli_query($link, "SELECT artist FROM songs  WHERE `artist` LIKE '%$song%'");
			$sums = mysqli_num_rows($pagews);

			$pagess = mysqli_query($link, "SELECT * FROM songs");
			$num_rowsSS = mysqli_num_rows($pagess);


			$alls = $num_rowsSS;
			$cccs = $sums;
			if ($alls != 0)
				$ps = ceil(($cccs / $alls) * 100);
			else
				$ps = 0;
			$ps = "{$ps}%";

			if ($ps > 5) {
				$ps = "<font color='green'><b>{$ps}</b></font>";
			} else {
				$ps = "{$ps}";
			}

			echo "
<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'><b>{$r['id']}</b></td>
	<td align='right' style='font-size:11px;'>{$r['name']}</td>
	<td align='right' style='font-size:11px;'>{$sums}</td>
	<td align='right' style='font-size:11px;'>{$ps}</td>
	<td align='right' style='font-size:11px;'>{$downloadsss}</td>
	<td align='right' style='font-size:11px;'>{$p}</td>
	<td align='center' style='font-size:11px;'><a href='?act=singers&do=edit&id={$r['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
	<td align='center' style='font-size:11px;'>{$delete}</td>
	</tr>";
		}
		echo "</table></form>";
		if ($pages != 1) {
			$ii = 1;
			echo "<br /><div align=center>";
			echo "<u>עמודים</u>:  ";
			while ($ii <= $pages) {

				if ($ii == $_GET['page']) {
					echo " ,<a href='?act=singers&page=$ii'><font color='black' style='font-size:15px;'><b><font color='#9112ff'>$ii</font></b></font></a>";
				} else {
					echo " ,<a href='?act=singers&page=$ii'><font color='black' style='font-size:13px;'>$ii</font></a>";
				}

				$ii++;
			}
			echo "</div>";
		}
		echo "</div>";
	}

	function singer_add()
	{
		include "../../conf.php";
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול זמרים:</font> <b>רשימת זמרים > הוספת זמר</b></td>
	</tr>
	</table>
	<br>
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">הוספת זמר חדש</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		function add_form()
		{
			include "../../conf.php";
			echo <<<END
		<form method="post" action="?act=singers&do=add" enctype="multipart/form-data" name="phuploader">
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם הזמר: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50" value="">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תמונה: </b></font>
				</td>
				<td align="right">	
					<input type="text" name="image" size="50" value="">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תגיות: </b></font>
				</td>
				<td align="right">
					<input type="text" name="keywords" size="50" dir="ltr" value="">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תוכן: </b></font>
				</td>
				<td align="right">
					<textarea  name="coment" rows="15" cols="80" style="width: 100%"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name = "submit" value="הוסף"></td>
			</tr>
		</table>
		</form> 
END;
		}

		$reg = "";
		$error = "";
		if (isset($_POST['submit'])) {

			$name = $_POST['name'];
			$image = $_POST['image'];
			$keywords = $_POST['keywords'];
			$coment = $_POST['coment'];
			if (empty($name) || empty($image) || empty($coment)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {



				$query = "SELECT MAX(id) FROM singers";
				$result = mysqli_query($link, $query) or die();
				$row = mysqli_fetch_array($result);
				$idsaq = $row['MAX(id)'] + 1;
				$idsaqq = $row['MAX(id)'];

				mysqli_query($link, "INSERT INTO `singers` ( `id` ,`name` ,`image` ,`keywords` ,`coment` ) VALUES ( '$idsaq' ,'$name' ,'$image' ,'$keywords' ,'$coment' )");
				if ($idsaqq < $idsaq) {
					$reg = "OK";
					$error = "הוספת הזמר בוצעה בהצלחה";
					$log = "<u>יצירת זמר:</u> $name";
					$name = $_SESSION["ad_user"];
					mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$name', UNIX_TIMESTAMP(), '1')");


					$users = $_SESSION["ad_user"];
					mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
				} else {
					$error = "אירעה שגיאה במהלך הרישום, אנה נסה שנית";
				}
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

	function singer_edit()
	{
		include "../../conf.php";
		$id = $_GET['id'];
		$res = mysqli_query($link, "SELECT * FROM singers WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול זמרים:</font> <b>רשימת זמרים > עריכת זמר</b></td>
	</tr>
	</table>
	<br>

		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">עריכת זמר - <b>{$r['name']}</b></td>
		</tr>
		</table>
		<div dir="rtl">
END;

		$id = $_GET['id'];
		$res = mysqli_query($link, "SELECT * FROM singers WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
		echo <<<END
		<form method="post" action="?act=singers&do=edit&id={$id}">
		<input type='hidden' name='edit' value='{$id}'>
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם הזמר: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50" value="{$r['name']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תמונה: </b></font>
				</td>
				<td align="right">	
					<input type="text" name="image" size="50" value="{$r['image']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תגיות: </b></font>
				</td>
				<td align="right">
					<input type="text" name="keywords" size="50" dir="ltr" value="{$r['keywords']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>תוכן: </b></font>
				</td>
				<td align="right">
					<textarea  name="comentt" rows="15" cols="80" style="width: 100%">{$r['coment']}</textarea>
				</td>
			</tr>
END;

		session_start();
		$admin = $_SESSION['ad_user'];
		$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
		$rq = mysqli_fetch_array($tesq);

		if ($rq["group"] == "1") {
			echo <<<END
END;
		}
		echo <<<END
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 
END;

		$edit = "";
		$error = "";

		if (isset($_POST['submit']) && $_POST['submit'] == "ערוך") {
			$id = $_POST['edit'];
			$res = mysqli_query($link, "SELECT * FROM singers WHERE id='$id' ");
			$r = mysqli_fetch_array($res);
			// vars
			$id = $r['id'];
			$name = $_POST['name'];
			$image = $_POST['image'];
			$keywords = $_POST['keywords'];
			$comentt = $_POST['comentt'];
			// start update
			if (empty($name) || empty($image) || empty($comentt)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				mysqli_query($link, "UPDATE `singers` SET `coment` = '{$comentt}' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `singers` SET `name` = '$name' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `singers` SET `image` = '$image' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `singers` SET `keywords` = '$keywords' WHERE `id` = $id ");


				$error = "<font color='green' size='5'><b>עריכת הזמר בוצעה בהצלחה</b></font>";
				$edit = "OK";
				$log = "<u>עריכת זמר:</u> $name";
				$user = $_SESSION["ad_user"];
				mysqli_query($link, "INSERT INTO `adminslog` ( `text`, `user` ,`ip` , `date`, `img` ) VALUES ('{$log}', '{$user}', '{$_SERVER['REMOTE_ADDR']}', UNIX_TIMESTAMP(), '2')");

				$users = $_SESSION["ad_user"];
				mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
			}
		}

		if ($edit == "OK") {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
			$ur = "singers.php?" . $_SERVER["QUERY_STRING"];
			// redirect_user($ur,"עריכת הצלצול בוצעה בהצלחה!");
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		}
		echo "</div>";
	}

	function singer_delete()
	{
		include "../../conf.php";
		$id = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : '1';
		echo <<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">מחיקת זמר</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$error = (empty($id)) ? "אנא בחר זמר" : "";
		if (empty($error)) {
			$ues = mysqli_query($link, "SELECT * FROM singers WHERE `id` = '$id'");
			$u = mysqli_fetch_array($ues);
			$named = $u['name'];
			$art = $u['commesnt'];
			$namedd = $named . " - " . $art;
			$log = "<u>מחיקת זמר:</u> $named - $art";
			$user = $_SESSION["ad_user"];
			mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP(), '3')");

			$users = $_SESSION["ad_user"];
			mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
			echo "<div align=\"center\">";
			echo " הזמר $namedd נמחק בהצלחה!";
			echo "</div>";
			mysqli_query($link, "DELETE FROM `singers` WHERE `id` = '$id' ");
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		}
		echo "</div>";
	}


	function singer_search()
	{
		include "../../conf.php";
		if (isset($_POST['submits'])) {
			$id = $_POST['keysd'];
			$name = $_POST['keys'];
			echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול זמרים:</font> <b>חיפוש זמרים</b> </td>
	</tr>
	</table>
	<br>
END;
			echo "<form method=\"POST\" name=\"form\" action=\"\">";
			echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='8' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת זמרים במערכת</b></td>
	</tr>

	<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>שם הזמר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>מספר צלצולים</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוז צלצולים</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>מספר הורדות</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוז הורדות</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>עריכה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>מחיקה</td>
	</tr>";


			$limit = "5";
			$cpage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
			if (!$cpage || $cpage < 1)
				$cpage = 1;
			$t = mysqli_num_rows(mysqli_query($link, "SELECT * FROM `singers` WHERE `id` LIKE '%$id%' AND `name` LIKE '%$name%'"));
			$ec = "";
			if ($t == 0)
				$ec = "<br /><font color='red'><b>אנא נסה מספר אחר</b></font>";
			$p = $t / $limit;
			$pages = ceil($p);
			$npage = $cpage + 1;
			$ppage = $cpage - 1;
			$i = ($cpage * $limit) - $limit;
			$res = mysqli_query($link, "SELECT * FROM `songs` WHERE `name` LIKE '%$name%' AND `id` LIKE '%$id%' ORDER BY `id` DESC LIMIT $i,$limit ");
			while ($r = mysqli_fetch_array($res)) {
				if ($r['id'] == 1) {
					$cats = "מזרחית";
				} else if ($r['id'] == 2) {
					$cats = "מזרחית רמיקס";
				}
				if ($r['id'] == 3) {
					$cats = "דיכאון";
				} else if ($r['id'] == 4) {
					$cats = "שונות";
				} else if ($r['catid'] == 5) {
					$cats = "הבקשות שלכם";
				}

				$query = "SELECT SUM(downloads) FROM songs";
				$result = mysqli_query($link, $query) or die();
				while ($row = mysqli_fetch_array($result)) {
					$downloadss = $row['SUM(downloads)'];
				}


				session_start();
				$admin = $_SESSION['ad_user'];
				$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
				$rq = mysqli_fetch_array($tesq);

				if ($rq["group"] == "1") {
					$delete = "<a href='?act=singers&do=delete&id={$r['id']}'><img src='images/delete.png' alt='מחיקה' border='0' style='vertical-align:middle'></a>";
				}


				$all = $downloadss;
				$ccc = $r['downloads'];
				if ($all != 0)
					$p = ceil(($ccc / $all) * 100);
				else
					$p = 0;
				$p = "{$p}%";

				if ($p > 2) {
					$p = "<font color='green'><b>{$p}</b></font>";
				} else {
					$p = "{$p}";
				}



				$song = $r['name'];
				$query = "SELECT SUM(downloads) FROM songs WHERE `artist` LIKE '%$song%'";
				$result = mysqli_query($link, $query) or die();
				while ($row = mysqli_fetch_array($result)) {
					$downloadsss = $row['SUM(downloads)'];
				}

				$query = "SELECT SUM(downloads) FROM songs";
				$result = mysqli_query($link, $query) or die();
				while ($row = mysqli_fetch_array($result)) {
					$downloadss = $row['SUM(downloads)'];
				}

				$all = $downloadss;
				$ccc = $downloadsss;
				if ($all != 0)
					$p = ceil(($ccc / $all) * 100);
				else
					$p = 0;
				$p = "{$p}%";

				if ($p > 2) {
					$p = "<font color='green'><b>{$p}</b></font>";
				} else {
					$p = "{$p}";
				}

				$song = $r['name'];
				$pagews = mysqli_query($link, "SELECT artist FROM songs  WHERE `artist` LIKE '%$song%'");
				$sums = mysqli_num_rows($pagews);

				$pagess = mysqli_query($link, "SELECT * FROM songs");
				$num_rowsSS = mysqli_num_rows($pagess);


				$alls = $num_rowsSS;
				$cccs = $sums;
				if ($alls != 0)
					$ps = ceil(($cccs / $alls) * 100);
				else
					$ps = 0;
				$ps = "{$ps}%";

				if ($ps > 5) {
					$ps = "<font color='green'><b>{$ps}</b></font>";
				} else {
					$ps = "{$ps}";
				}

				echo <<<END
<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'><b>{$r['id']}</b></td>
	<td align='right' style='font-size:11px;'>{$r['name']}</td>
	<td align='right' style='font-size:11px;'>{$sums}</td>
	<td align='right' style='font-size:11px;'>{$ps}</td>
	<td align='right' style='font-size:11px;'>{$downloadsss}</td>
	<td align='right' style='font-size:11px;'>{$p}</td>
	<td align='center' style='font-size:11px;'><a href='?act=singers&do=edit&id={$r['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
	<td align='center' style='font-size:11px;'>{$delete}</td>
	</tr>
END;
			}
			echo "</table></form>";
			echo $ec;
		}
	}

	?>