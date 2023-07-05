<?php
session_start(); 
?>
<HTML dir="rtl">
<HEAD>
  <TITLE>ניהול בקשות</TITLE>
<link href='stylesheet.css' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='../java.js'></script> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="he" />
</HEAD>
<body bgcolor="#FFFFFF" style='padding:15px'>
<?php
//© All Rights Reserved 09/10 - CMS.co.il ©//
define( '_MATAN', 1 );
// session

include "../../conf.php";
include "functionss.php";
/*
if ($_SESSION["ad_group"] != 1)
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
*/
$do = $_GET['do'];
  switch($do)
  {	
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


$pages = mysqli_query($link,"SELECT * FROM orders");
$num_rows = mysqli_num_rows($pages);
$bakss = $num_rows;

if($bakss == "0") {
$baksss = "<font color='green'>(<b>0</b>)</font>";
} else {
$baksss = "<font color='red'>(<b>".$bakss."</b>)</font>";
}
echo<<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>ניהול בקשות צלצולים</b> {$baksss}</td>
	</tr>
	</table>
	<br>
END;

		$limit = "15";
		$cpage = intval($_GET['page']);
		if (!$_GET['page'] || $_GET['page'] < 1) 
		{
			$cpage = 1;
		}    
		$t = mysqli_num_rows(mysqli_query($link,"SELECT id FROM orders"));  
		$p1 = $t/$limit;
		$pages = ceil($p1);
		$npage = $cpage+1;
		$ppage = $cpage-1;
		$i = ($cpage * $limit) - $limit;
		$res = mysqli_query($link,"SELECT * FROM orders ORDER BY id LIMIT $i,$limit ");
		echo "<form method=\"POST\" song=\"form\" action=\"?act=orders&do=delete\">";

	echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='4' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>מאגר הבקשות באתר</b> <a href='?act=orders&do=all'><u><font color='red'>מחק הכל</font></u></a> / <a href='?act=orders&do=alls'><u><font color='blue'>אפס</font></u></a></td>
	</tr>";

	echo "<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>סמן</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>שם השיר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>שם האומן</b></td>
	</tr>";


		$num_rows = mysqli_num_rows($res);
		if ( $num_rows > 0 ) {
		while($r = mysqli_fetch_array($res))
		{

	echo "<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'><input type='checkbox' value='$r[id]' name='Del[]'></td>
	<input type='hidden' value='$r[id]' name='del' />
	<td align='right' style='font-size:11px;'>{$r['id']}</td>
	<td align='right' style='font-size:11px;'>{$r['song']}</td>
	<td align='right' style='font-size:11px;'>{$r['artist']}</td>
	</tr>";
		} 


		echo "<tr bgcolor=\"white\">";
		echo "<td colspan=\"4\" align='center'><input type=\"submit\" class=\"click\" value=\"מחק\" song=\"submit\"></td>";
		echo "</tr>";

} else {
echo "	<tr>
	<td align='center' colspan='4' style='font-size:11px;background-color:#FFFFFF;'>אין בקשות חדשות כרגע</td>
	</tr>";
}
		if($res <= "0"){
		echo "<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>";
		echo "<td colspan=\"4\" align='center'>אין בקשות חדשות כרגע</td>";
		echo "</tr>";
		}
		echo "</table></form>";
		if ($pages != 1) {
			$ii = 1;
			echo "<div align=center>";
			while ($ii <= $pages) {
			echo ",<a href='?act=orders&page=$ii'><font color='black'>$ii</font></a>";
			$ii++;
			}
			echo "</div>";
		}
	echo "</div>";
	}

	function ordr_all()
	{
	    include "../../conf.php";
	$log = "מחק את כל הבקשות";
	$song = $_SESSION["ad_user"];
	mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP())");
	mysqli_query($link,"DELETE FROM orders");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

	redirect_user ("orders.php","כל הבקשות נמחקו בהצלחה!");
	}


	function ordr_alls()
	{
	    include "../../conf.php";
	$log = "איפס את מספר הבקשות";
	$song = $_SESSION["ad_user"];
	mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '4')");
	mysqli_query($link,"TRUNCATE TABLE orders");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

	redirect_user ("orders.php","מספר הבקשות באתר אופס בהצלחה!");
	}

	function ordr_delete()
	{
	    include "../../conf.php";
echo<<<END


<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>מחיקת בקשות באתר</b></td>
	</tr>
	</table>
	<br>
	<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='4' style='font-size:14px;background-color:#FFFFFF;'><img src='images/delete.png' style='vertical-align:middle'> <b>בחרת למחוק בקשה באיזור הבקשות</b> >> הבקשה <?phpecho $songd; ?> נמחק בהצלחה!</td>
	</tr>
	</table>
END;
		$error = (empty($_POST['Del'])) ? "אנה בחר בקשה" : "";
		if (empty($error)) {
		$id = $_POST['Del'];
		$delete_id = implode(",",$id);
		$ues = mysqli_query($link,"SELECT * FROM orders WHERE `id` = '$id'");
		$u = mysqli_fetch_array($ues);

		$ids = $_POST['del'];
		$uess = mysqli_query($link,"SELECT * FROM orders WHERE `id` = '$ids'");
		$us = mysqli_fetch_array($uess);
		$songd = $us['song'];
		$log = "מחק את הבקשה: <u>{$songd}</u>";

		$song = $_SESSION["ad_user"];
		mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '3')");

				$users = $_SESSION["ad_user"];
				mysqli_query($link,"UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

		mysqli_query($link,"DELETE FROM `orders` WHERE `id` IN (".$delete_id.")");
			redirect_user ("orders.php","הבקשה נמחקה בהצלחה!");
		} else {
		echo "<div align=\"center\">";
		echo $error;
		echo "</div>";
		}
	echo "</div>";
	}
?>