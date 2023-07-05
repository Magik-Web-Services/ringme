<?php
defined('_MATAN');
include('../conf.php')
?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">
<style>
	.requestringtone {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	.requestringtones {
		width: 100%;
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	.requestringtones:hover {
		background-color: #45a049;
	}
</style>

<?php include 'blocks/navigation.php'; ?>

<main>


	<table cellpadding='2' cellspacing='0' width='100%' style='background-color:#FFFFFF;color:#062b4d;border:1px dashed #800080'>
		שלום גולש יקר,<br />
		מצאת בעיה באתר? צלצול שמשמיע שיר אחר? בעיות בדפי האתר?, דווח לנו ונתקן את הבעיה!<br />
		כמו כן תוכלו לדווח לנו על שירים שלא פעילים, טעויות בטקסט האתר, ככל שתעזרו לנו האתר יהיה גדול יותר!<br />
		ואתם הגולשים - תהנו מתוכן איכותי יותר ומצלצולים להורדה בחינם!<br />
		תאר את הבעיה ואת מיקומה באתר ואנחנו נטפל בזה בהקדם.
		<tr>
			<td></td>
		</tr>
	</table>

	<form method="post" action="">
		<input type="text" onclick="this.value=''" name="namerep" value="שם המדווח" tabindex="11" class="requestringtone" />
		<input type="text" onclick="this.value=''" name="emailrep" value="אימייל" tabindex="11" class="requestringtone" />
		<textarea rows="5" cols="20" onclick="this.value=''" name="txtrep" class="requestringtone">כתוב כאן את תוכן הדיווח</textarea>


		<input type="submit" name="submit" class="requestringtones" value="שלח דיווח!">

	</form>

	<?php


	if (isset($_POST['submit'])) {
		if ($_POST['namerep'] == "שם המדווח" || $_POST['txtrep'] == "כתוב כאן את תוכן הדיווח")
			die("אנא רשום דיווח הגיוני.");
		if ($_POST['namerep'] == "" || $_POST['txtrep'] == "") {
			echo "<b>אנא מלא את שדות החובה</b>";
		} else {

			$namerep = $_POST['namerep'];
			$emailrep = $_POST['emailrep'];
			$txtrep = $_POST['txtrep'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$date = time();

			$res = mysqli_query($link, "SELECT `date` FROM `reports` WHERE `ip`='$ip' ORDER BY id DESC");
			if (mysqli_num_rows($res) > 0)
				$r = mysqli_fetch_array($res);
			else
				$r['date'] = 0;
			if (time() > ($r['date'] + (60 * 60 * 24))) {
				mysqli_query($link, "INSERT INTO `reports` (`name`, `email`, `text`, `ip`, `date`) VALUES ('$namerep', '$emailrep', '$txtrep', '$ip', '$date')");
				echo "<font color='green'><b>הדיווח נשלח בהצלחה!</b></font>, בזמן הקרוב צוות האתר יבדוק את הדיווח שלכם!";
			} else {
				echo "<b>לא ניתן לדווח פעמיים ביום, תודה והמשך גלישה מהנה.</b>";
			}
		}
	}
	?>