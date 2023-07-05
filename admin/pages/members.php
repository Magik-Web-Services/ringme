<?php
session_start(); 
date_default_timezone_set("Asia/Jerusalem");
?>
<HTML dir="rtl">
<HEAD>
  <TITLE>ניהול משתמשים</TITLE>
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

$admin = $_SESSION[ad_user];
$tes = mysqli_query($link,"SELECT * FROM `members` WHERE `user` = '{$admin}'");
$r = mysqli_fetch_array($tes);

if($r["group"] > "1")
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

if ($_SESSION["ad_group"] != 1)
die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

$do = $_GET['do'];
  switch($do)
  {	
	case 'add':
		mem_add();
		break;
	case 'delete':
		mem_delete();
		break;
	case 'edit':
		mem_edit();
		break;
	default:
		mem_main();
		break;             
  } 


	function mem_main()
	{
	    include "../../conf.php";
echo<<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>אדמינים וצוות האתר:</font> <b>רשימת משתמשים</b></td>
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
		$t = mysqli_num_rows(mysqli_query($link,"SELECT id FROM members"));  
		$p1 = $t/$limit;
		$pages = ceil($p1);
		$npage = $cpage+1;
		$ppage = $cpage-1;
		$i = ($cpage * $limit) - $limit;
		$res = mysqli_query($link,"SELECT * FROM members ORDER BY id LIMIT $i,$limit ");

echo<<<END
		<form method="POST" name="form" action="">
<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='10' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת משתמשים במערכת</b> </td>
	</tr>

	<tr>
	

	<td align='center' style='font-size:12px;background-color:#f2f2f2;'>ערוך</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>מחק</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'><b>#</b></td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>שם משתמש:</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>אימייל</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>שם פרטי</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>פלאפון</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>הרשאות</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>איפי</td><td align='center' style='font-size:12px;background-color:#f2f2f2;'>תאריך הרשמה</td>
</tr>
END;

		while($r = mysqli_fetch_array($res))
		{
		$group = ($r[group] == 1) ? "מנהל" : "עובד";
		$date = $r[joindate];
		@list($d, $m, $y) = split('/', date("j/n/Y", $date)); 
		@list($yom, $chodesh, $shana) = split(' ', jdtojewish(gregoriantojd($m, $d, $y), true)); 
		$date = @date("H:i:s",$date)." "."$yom $chodesh $shana";                         ;


    		$rowa = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `members` WHERE `id` = '{$r[id]}'"));
   		 // get the date
    		$da = date("d/m/Y", $rowa['joindate']);
    		// get the time
    		$ga = date("G:i", $rowa['joindate']);

		echo "<tr bgcolor='white' onMouseOver=this.bgColor='#f4f4f4' onMouseOut=this.bgColor='white'>";
		echo "<td align='center'><input type=\"radio\" value=\"$r[id]\" name=\"edit\" onclick=\"form.action='?act=members&do=edit'\"></td><td align='center'><input type=\"radio\" value=\"$r[id]\" name=\"edit\" onclick=\"form.action='?act=members&do=delete'\"disabled></td><td  align='center'>$r[id]</td><td  align='center'>$r[user]</td><td  align='center'>$r[email]</td><td  align='center'>$r[name]</td><td align='center'>$r[phone]</td><td  align='center'>$group</td><td  align='center'>$r[ip]</td><td  align='center'>$da - $ga</td>";
		echo "</tr>";
		} 
		echo "<tr bgcolor=\"white\">";
		echo "<td colspan=\"10\" align='center'><input type=\"submit\" class=\"click\" value=\"שלח\" name=\"submit\"></td>";
		echo "</tr>";
		echo "</table></form>";
		if ($pages != 1) {
			if ($cpage == 1) {
				echo "<a href=\"?act=members&page=$npage\">דף הבא</a>";
			} elseif ($cpage == $pages) {
				echo "<a href=\"?act=members&page=$ppage\">דף קודם</a>";
			} else {
				echo "<a href=\"?act=members&page=$ppage\">דף קודם</a>";
				echo " | ";
				echo "<a href=\"?act=members&page=$npage\">דף הבא</a>";
			}
		}
	echo "</div>";
	}

	function mem_add()
	{
	    include "../../conf.php";
echo<<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>אדמינים וצוות האתר:</font> <b>הוספת משתמש</b></td>
	</tr>
	</table>
	<br>
		<div dir="rtl">
END;
		function add_form()
		{
		    include "../../conf.php";
		if ($_SESSION["ad_group"] == 1) {
		$option = '<tr><td align="right"><font size="3" face="arial" color="000000"><b>רמת הרשאה: </b></font></td><td align="right"><select name="group"><option value="1">מנהל</option><option value="2" selected>עובד</option></td></tr>';
		} else {
		$option = "<input type='hidden' name='group' value='2'>";
		}
		echo <<<END
		<form method="post" action="?act=members&do=add">
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם משתמש: </b></font>
				</td>
				<td align="right">
					<input type="text" name="user">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>סיסמא: </b></font>
				</td>
				<td align="right">	
					<input type="password" name="pass">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אימייל: </b></font>
				</td>
				<td align="right">
					<input type="text" name="email">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם פרטי: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name">
				</td>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>פלאפון: </b></font>
				</td>
				<td align="right">
<input type='text' class='forminput' name='phone' size='10' maxlength='7' style='text-align:left;border:1px solid #d1d1d1;;direction:ltr' onKeyPress='return isNumberKey(event)'> <select name="kidomet" class='forminput' style='border:1px solid #d1d1d1;'>
        	<option value='02'>02</option>
		<option value='03' SELECTED>03</option>
		<option value='04'>04</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='050'>050</option>
		<option value='052'>052</option>
		<option value='054'>054</option>
		<option value='057'>057</option>
		<option value='072'>072</option>
		<option value='073'>073</option>
		<option value='077'>077</option>
        </select>
</td></tr>
			</tr>
			{$option}	
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name = "submit" value="הוסף"></td>
			</tr>
		</table>
		</form> 
END;
		}
		
		if (isset($_POST[submit])) {
			$user = $_POST[user];
			$pass =md5($_POST[pass]);
			$email = $_POST[email];
			$group = $_POST[group];
			$kidomet = $_POST[kidomet];
			$phone = $_POST[phone];
			$name = $_POST[name];
			if (empty($user) || empty($pass) || empty($email) || empty($phone) || empty($kedomet) || empty($name)) {
				$error = "<font color='red'>אנא מלא את כל שדות הטופס</font>";
			} else {
				$res = mysqli_query($link,"SELECT id FROM members WHERE `user` = '$user'");
				if (mysqli_num_rows($res) == 0) {
					$res = mysqli_query($link,"SELECT id FROM members WHERE `email` = '$email'");
					if (mysqli_num_rows($res) == 0) {

		$_POST["phone"] = $_POST["kidomet"]."-".$_POST["phone"];

						mysqli_query($link,"INSERT INTO `members` ( `ip`, `user` ,`pass` ,`email` ,`name` ,`phone` ,`group` , `joindate` ) VALUES ('{$_SERVER[REMOTE_ADDR]}', '$user', '$pass', '$email', '$name', '$phone', '$group', UNIX_TIMESTAMP())");
						if (mysqli_insert_id()) {
							$reg ="OK";
							$error = "הוספת המשתמש בוצעה בהצלחה";
							$log = "<u>יצירת משתמש:</u> $user";
							$user = $_SESSION["ad_user"];
							mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER[REMOTE_ADDR]}', '$log', '$user', UNIX_TIMESTAMP(), '3')");
						} else {
							$error = "אירעה שגיאה במהלך הרישום, אנה נסה שנית";
						}
					} else {
						$error = "אימייל זה טפוס, אנה בחר אימייל אחר";
					}
				} else {
					$error = "שם משתמש זה תפוס, אנה בחר שם משתמש אחר";
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

	function mem_edit()
	{
	    include "../../conf.php";
		$id = $_POST['edit'];
		$res = mysqli_query($link,"SELECT * FROM members WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
echo<<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>אדמינים וצוות האתר:</font> <b>רשימת משתמשים</b></td>
	</tr>
	</table>
	<br>

		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">עריכת משתמש {$r[user]}</td> {$r[id]},,,, {$r[name]},,,,
		</tr>
		</table>

		<div dir="rtl">



		<form method="post" action="?act=members&do=edit">
		<input type='hidden' name='edit' value='{$r[id]}'>
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם משתמש: </b></font>
				</td>
				<td align="right">
					<input type="text" name="user" value="{$r[user]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>סיסמא: </b></font>
				</td>
				<td align="right">	
					<input type="password" name="pass">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אימייל: </b></font>
				</td>
				<td align="right">
					<input type="text" name="email" value="{$r[email]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם פרטי: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" value="{$r[name]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>פלאפון: </b></font>
				</td>
				<td align="right">
<input type='text' class='forminput' name='phone' maxlength='12' style='text-align:left;border:1px solid #d1d1d1;direction:ltr' onKeyPress='return isNumberKey(event)' value="{$r[phone]}">
</td></tr>
			<tr>
				<td align="right">
					<font size='3' face='arial' color="000000"><b>רמת הרשאה: </b></font>
				</td>
				<td align="right">
					<select name='group'>
END;
if($r[group] == 1) { 	echo "<option value='1'>מנהל</option><option value='2'>עובד</option>"; }
if($r[group] == 2) { 	echo "<option value='2'>עובד</option><option value='1'>מנהל</option>"; }
echo <<<END
				</td>			
			</tr>			
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 

END;
		function edit_form()
		{

include "../../conf.php";

		// $id = $_POST[edit];

//$id = $_POST['edit'];
//		$res = mysqli_query($link,"SELECT * FROM members WHERE `id` = '$id'");
		//$r = mysqli_fetch_array($res);

		//$res = mysqli_query($link,"SELECT * FROM members WHERE `id` = '$id'");
		//$r = mysqli_fetch_array($res);
		echo <<<END

		<form method="post" action="?act=members&do=edit">
		<input type='hidden' name='edit' value='{$r[id]}'>
		<table>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם משתמש: </b></font>
				</td>
				<td align="right">
					<input type="text" name="user" value="{$r[user]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>סיסמא: </b></font>
				</td>
				<td align="right">	
					<input type="password" name="pass">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אימייל: </b></font>
				</td>
				<td align="right">
					<input type="text" name="email" value="{$r[email]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם פרטי: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" value="{$r[name]}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>פלאפון: </b></font>
				</td>
				<td align="right">
<input type='text' class='forminput' name='phone' maxlength='12' style='text-align:left;border:1px solid #d1d1d1;direction:ltr' onKeyPress='return isNumberKey(event)' value="{$r[phone]}">
</td></tr>
			<tr>
				<td align="right">
					<font size='3' face='arial' color="000000"><b>רמת הרשאה: </b></font>
				</td>
				<td align="right">
					<select name='group'>
END;
if($r[group] == 1) { 	echo "<option value='1'>מנהל</option><option value='2'>עובד</option>"; }
if($r[group] == 2) { 	echo "<option value='2'>עובד</option><option value='1'>מנהל</option>"; }
echo <<<END
				</td>			
			</tr>			
			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 
END;
		}

		if (isset($_POST[submit]) && $_POST[submit] == "ערוך") {
			$id = $_POST[edit];
			$res = mysqli_query($link,"SELECT * FROM members WHERE id='$id' ");
			$r = mysqli_fetch_array($res);
			$false = false;
			// work or admin
			if ($_SESSION[ad_group] != 1 && $_SESSION[ad_user] != $r[user]) {
				$error = "<font color='red'>אין לך הרשאות</font>";	
				$false = true;
			} 
			// vars
			$id = $r[id];
			$user = $_POST[user];
			$pass = $_POST[pass];
			$email = $_POST[email];
			$group = $_POST[group];
			$name = $_POST[name];
			$phone = $_POST[phone];
			//vars
			// if x else y
			if ($user == $r[user]) { 
			$user = $r[user];
			$uk = "ok";
			}
			if (empty($pass)) {
			$pass = $r[pass];
			} else {
 			$pass = md5($_POST[pass]);
			}
			if ($email == $r[email]) {
			$email = $r[email];
			$ek = "ok";
			}
			// if x eles y
			// check if exist email & user in our system
			if ($ek != "ok") {
				$tes = mysqli_query($link,"SELECT id FROM members WHERE email='$email'");
				if (mysqli_num_rows($tes) > 0) {
					$error = "<font color='red'>אימייל זה תפוס אנה בחר אימייל שונה</font>";
					$false = true;
				}
			}
			if ($uk != "ok") {
				$tes = mysqli_query($link,"SELECT id FROM members WHERE user='$user'");
				if (mysqli_num_rows($tes) > 0) {
					$error = "<font color='red'>שם משתמש זה תפוס אנה בחר שם אחר</font>";
					$false = true;
				}
			}


			// end check
			if ($false == false) {
			// start update
				if (empty($user) || empty($pass) || empty($email)) {
					$error = "<font color='red'>אנא מלא את כל שדות הטופס</font>";
				} else {
						mysqli_query($link,"UPDATE `members` SET `user` = '$user' WHERE `id` = $id ");
						mysqli_query($link,"UPDATE `members` SET `email` = '$email' WHERE `id` = $id ");
						mysqli_query($link,"UPDATE `members` SET `pass` = '$pass' WHERE `id` = $id ");
						mysqli_query($link,"UPDATE `members` SET `group` = '$group' WHERE `id` = $id ");
						mysqli_query($link,"UPDATE `members` SET `name` = '$name' WHERE `id` = '$id' ");
						mysqli_query($link,"UPDATE `members` SET `phone` = '$phone' WHERE `id` = '$id' ");

						$error = "עריכת המשתמש בוצעה בהצלחה";
						$edit = "OK";
						$log = "<u>עריכת משתמש:</u> $user";
						$user = $_SESSION["ad_user"];
						mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER[REMOTE_ADDR]}', '$log', '$user', UNIX_TIMESTAMP(), '2')");
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

	function mem_delete()
	{
include "../../conf.php";
echo<<<END
		<table dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" class="tile">מחיקת משתמש</td>
		</tr>
		</table>
		<div dir="rtl">
END;
		$error = (empty($_POST[edit])) ? "אנה בחר משתמש" : "";
		if (empty($error)) {
		$id = $_POST[edit];
		$ues = mysqli_query($link,"SELECT user FROM members WHERE `id` = '$id'");
		$u = mysqli_fetch_array($ues);
		$userd = $u[user];
		$log = "<u>מחיקת משתמש:</u> $userd";
		$user = $_SESSION["ad_user"];
		mysqli_query($link,"INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER[REMOTE_ADDR]}', '$log', '$user', UNIX_TIMESTAMP(), '3')");
		mysqli_query($link,"DELETE FROM `members` WHERE `id` = '$id' ");
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