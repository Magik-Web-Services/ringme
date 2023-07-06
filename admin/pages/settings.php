<?php
session_start();
?>
<HTML dir="rtl">

<HEAD>
	<TITLE>הגדרות כלליות</TITLE>
	<link href='stylesheet.css' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='../../java.js'></script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</HEAD>

<body bgcolor="#FFFFFF" style='padding:15px'>
	<?php
	//© All Rights Reserved 09/10 - CMS.co.il ©//
	define('_MATAN', 1);
	// session
	$_SESSION["ad_group"] = 1;

	if ($_SESSION["ad_group"] != 1)
		die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

	include "../../conf.php";
	// include "functionss.php";

	$do = (isset($_GET['do']) && !empty($_GET['do'])) ? $_GET['do'] : '';
	switch ($do) {

		default:
			set_main();
			break;
	}


	function set_main()
	{
		include "../../conf.php";

		$res = mysqli_query($link, "SELECT * FROM `adminmsg` WHERE `id`='1' ");
		$r = mysqli_fetch_array($res);


		echo <<<END

	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>הגדרות המערכת:</font> <b>הגדרות כלליות</b></td>
	</tr>
	</table>
	<br>
<font style='font-size:16px;'><b>
ברוכים הבאים להגדרות המערכת, כאן תוכלו לערוך את הגדרות האתר, לצפות במצב המערכת </b></font><br />

					<form method="post">
				<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" class="tile">השאר הודעה למנהלים /הודעה אחרונה</td>
				</tr>
				</table>
				<div dir="rtl" align="center" style="border:0;padding:0">

				</div>
					<textarea id='editor_kama' name="texts" rows="10" cols="50" style="width: 50%">
					{$r['text']}
					</textarea>
<script type='text/javascript'>
//<![CDATA[
CKEDITOR.replace( 'editor_kama',
{
skin : 'kama',
language : 'he'
});
//]]></script>
	<br />
					<input type="submit" name="submit" class="click" value="פרסם">
					</form><br />
END;


		if (isset($_POST['submit'])) {
			$texts = $_POST['texts'];
			mysqli_query($link, "UPDATE `adminmsg` SET `text` = '$texts' WHERE `id` = '1' ");
			//echo "<div style=\"color:#ac5555;font-size:12px;font-weight: bold;\">ההודעה עודכנה בהצלחה</div>";
			//echo "<br /><div class='warn'>ההודעה עודכנה בהצלחה</div><br />";
			$log = " עריכת הודעה למנהלים";
			$user = $_SESSION["ad_user"];
			mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` , `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP(), '2')");
			$users = $_SESSION["ad_user"];
			mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
			// redirect_user("settings.php", "עריכת הודעה למנהלים עודכנה בהצלחה!");
		}
	}
	?>
</body>

</html>