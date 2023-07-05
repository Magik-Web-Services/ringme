<?php
session_start();
?>
<HTML dir="rtl">

<HEAD>
	<title>ניהול דיווחים</title>
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
	include "functionss.php";
	if ($_SESSION["ad_group"] != 1)
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

	$do = $_GET['do'];
	switch ($do) {
		case 'delete':
			ordr_delete();
			break;

		case 'all':
			ordr_all();
			break;
		case 'alls':
			ordr_alls();
			break;
		default:
			ordr_main();
			break;
	}



	function ordr_main()
	{
		include "../../conf.php";
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול דיווחים:</font> <b>ניהול שליחת דיווחים</b></td>
	</tr>
	</table>
	<br>
END;

		$limit = "15";
		$cpage = intval($_GET['page']);
		if (!$_GET['page'] || $_GET['page'] < 1) {
			$cpage = 1;
		}
		$t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM reports"));
		$p1 = $t / $limit;
		$pages = ceil($p1);
		$npage = $cpage + 1;
		$ppage = $cpage - 1;
		$i = ($cpage * $limit) - $limit;
		$res = mysqli_query($link, "SELECT * FROM reports ORDER BY id LIMIT $i,$limit ");
		echo "<form method=\"POST\" song=\"form\" action=\"?act=reports&do=delete\">";

		echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='6' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>מאגר הדיווחים באתר</b> <a href='?act=reports&do=all'><u><font color='red'>מחק הכל</font></u></a> / <a href='?act=reports&do=alls'><u><font color='blue'>אפס</font></u></a></td>
	</tr>";

		echo "<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>סמן</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>שם המדווח</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>אימייל</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>תוכן הדיווח</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>אייפי</b></td>
	</tr>";


		$num_rows = mysqli_num_rows($res);
		if ($num_rows > 0) {
			while ($r = mysqli_fetch_array($res)) {

				echo "<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'><input type='checkbox' value='$r[id]' name='Del[]'></td>
	<input type='hidden' value='$r[id]' name='del' />
	<td align='right' style='font-size:11px;'>{$r["id"]}</td>
	<td align='right' style='font-size:11px;'>{$r["name"]}</td>
	<td align='right' style='font-size:11px;'>{$r["email"]}</td>
	<td align='right' style='font-size:11px;'>{$r["text"]}</td>
	<td align='right' style='font-size:11px;'>{$r["ip"]}</td>
	</tr>";
			}


			echo "<tr bgcolor=\"white\">";
			echo "<td colspan=\"6\" align='center'><input type=\"submit\" class=\"click\" value=\"מחק\" song=\"submit\"></td>";
			echo "</tr>";
		} else {
			echo "	<tr>
	<td align='center' colspan='6' style='font-size:11px;background-color:#FFFFFF;'>אין דיווחים חדשים כרגע</td>
	</tr>";
		}
		if ($res <= "0") {
			echo "<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>";
			echo "<td colspan=\"6\" align='center'>אין דיווחים חדשים כרגע</td>";
			echo "</tr>";
		}
		echo "</table></form>";
		if ($pages != 1) {
			$ii = 1;
			echo "<div align=center>";
			while ($ii <= $pages) {
				echo ",<a href='?act=reports&page=$ii'><font color='black'>$ii</font></a>";
				$ii++;
			}
			echo "</div>";
		}
		echo "</div>";
	}

	function ordr_all()
	{
		include "../../conf.php";
		$log = "מחק את כל הדיווחים";
		$song = $_SESSION["ad_user"];
		mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP())");
		mysqli_query($link, "DELETE FROM reports");

		$users = $_SESSION["ad_user"];
		mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

		redirect_user("reports.php", "כל הדיווחים נמחקו בהצלחה!");
	}


	function ordr_alls()
	{
		include "../../conf.php";
		$log = "איפס את מספר הדיווחים";
		$song = $_SESSION["ad_user"];
		mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '4')");
		mysqli_query($link, "TRUNCATE TABLE reports");

		$users = $_SESSION["ad_user"];
		mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

		redirect_user("reports.php", "מספר הדיווחים באתר אופס בהצלחה!");
	}

	function ordr_delete()
	{
		include "../../conf.php";
		echo <<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">מחיקת דיווח</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$error = (empty($_POST['Del'])) ? "אנה בחר דיווח" : "";
		if (empty($error)) {
			$id = $_POST['Del'];
			$delete_id = implode(",", $id);
			$ues = mysqli_query($link, "SELECT * FROM reports WHERE `id` = '$id'");
			$u = mysqli_fetch_array($ues);

			$ids = $_POST['del'];
			$uess = mysqli_query($link, "SELECT * FROM reports WHERE `id` = '$ids'");
			$us = mysqli_fetch_array($uess);
			$songd = $us['text'];
			$log = "מחק את הדיווח: <u>{$songd}</u>";

			$song = $_SESSION["ad_user"];
			mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '3')");

			$users = $_SESSION["ad_user"];
			mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

			mysqli_query($link, "DELETE FROM `reports` WHERE `id` IN (" . $delete_id . ")");
			redirect_user("reports.php", "הדיווח נמחק בהצלחה!");
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		}
		echo "</div>";
	}
	?>