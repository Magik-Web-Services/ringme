<?php
session_start();
?>
<HTML dir="rtl">

<HEAD>
	<TITLE>עריכת בלוקים באתר</TITLE>
	<link href='stylesheet.css' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='../../java.js'></script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="he" />
</HEAD>

<body bgcolor="#FFFFFF" style='padding:15px'>

	<?php
	//© All Rights Reserved 09/10 - CMS.co.il ©//
	define('_MATAN', 1);
	// session

	include "../../conf.php";
	//  // include "functionss.php";
	defined('_MATAN');

	$admin = $_SESSION['ad_user'];
	$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
	$r = mysqli_fetch_array($tes);

	if ($r["group"] > "1")
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

	if ($_SESSION["ad_group"] != 1)
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
	?>
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
		<tr>
			<td align='right' style='font-size:16px;'>
				<font color='black'>הגדרות המערכת:</font> <b>ניהול דפי האתר</b>
			</td>
		</tr>
	</table>
	<br>

	<form method="post">
		<div dir="rtl" align="center" style="border:0;padding:0">
			<?php
			if (isset($_POST['submit'])) {
				$text[1] = $_POST['text1'];
				$text[2] = $_POST['text2'];
				$text[4] = $_POST['text4'];
				$text[5] = $_POST['text5'];
				$text[6] = $_POST['text6'];
				$text[8] = $_POST['text8'];
				$tes = mysqli_query($link, "SELECT `id` FROM `blocks` ORDER BY `id`");
				for ($i = 1; $i <= mysqli_num_rows($tes); $i++) {
					if ($i == 3 || $i == 7) {
					} else {
						mysqli_query($link, "UPDATE `blocks` SET `text` = '$text[$i]' WHERE `id` ='$i' ");
					}
				}

				echo "<font color='green'><b>הבלוקים עודכנו בהצלחה</b></div><br />";
				$log = "עריכת בלוקים";
				$user = $_SESSION["ad_user"];
				mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP())");
			}
			$res = mysqli_query($link, "SELECT `text` FROM `blocks` ORDER BY `id`");
			for ($i = 1; $i <= mysqli_num_rows($res); $i++) {
				$r = mysqli_fetch_array($res);
				$file[$i]  = $r['text'];
			}
			?>

			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<font style='font-size:14px'><b>עריכת בלוק ברוך הבא</b></font><br>
					</td>
				</tr>
			</table>
			<textarea id="editor_kama" name="text1" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[1];
echo $current;
?>
					</textarea>
			<script type='text/javascript'>
				//<![CDATA[
				CKEDITOR.replace('editor_kama', {
					skin: 'kama',
					language: 'he'
				});
				//]]>
			</script>
			<br />
			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<font style='font-size:14px'><b>עריכת בלוק פרסומות</b></font><br>
					</td>
				</tr>
			</table>
			<textarea name="text2" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[2];
echo $current;
?>
					</textarea>

			<br /><br />
			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<font style='font-size:14px'><b>עריכת בלוק פרסומות גדולות</b></font><br>
					</td>
				</tr>
			</table>
			<textarea name="text6" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[6];
echo $current;
?>
					</textarea>
			<br />
			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<br />
						<font style='font-size:14px'><b>עריכת בלוק קישורים</b></font><br>
					</td>
				</tr>
			</table>
			<textarea name="text4" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[4];
echo $current;
?>
					</textarea>
			<br />
			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<br />
						<font style='font-size:14px'><b>עריכת בלוק קטגוריות</b></font><br>
					</td>
				</tr>
			</table>
			<textarea id="editor_kama2" name="text5" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[5];
echo $current;
?>
					</textarea>
			<script type='text/javascript'>
				//<![CDATA[
				CKEDITOR.replace('editor_kama2', {
					skin: 'kama',
					language: 'he'
				});
				//]]>
			</script>
			<br />

			<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">
						<br />
						<font style='font-size:14px'><b>עריכת עיצוב האתר</b></font><br>
					</td>
				</tr>
			</table>
			<textarea name="text8" rows="15" cols="80" style="width: 100%">
<?php
$current = $file[8];
echo $current;
?>
					</textarea>
			<br />
			<input type="submit" name="submit" class="click" value="עדכן נתונים">
	</form>
	</div>