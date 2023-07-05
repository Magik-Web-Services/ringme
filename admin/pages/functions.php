<?
include ("../../conf.php");
//משתנים חשובים לאתר//
$uploaddir = "../ring";

$uploaddirr = "../ring";
$fulldirr ="ring";
$filespathr = "/home/miztonu/domains/urikas.wek.co.il/public_html/ring";
$slu = "http://urikas.wek.co.il";
$fulldir = "ring";
$filespath = "/home/miztonu/domains/urikas.wek.co.il/public_html/ring";


$fullmonths = array('Jan' => 'ינואר','Feb' => 'פברואר','Mar' => 'מרץ','Apr' => 'אפריל','May' => 'מאי','Jun' => 'יוני','Jul' => 'יולי','Aug' => 'אוגוסט','Sep' => 'ספטמבר','Oct' => 'אוקטובר','Dec' => 'דצמבר');
//משתנים חשובים לאתר//

function checkadmin($username, $password) {
    include "../../conf.php";
	$query = mysqli_query($link,"SELECT * FROM admin Where username='{$username}' && password='{$password}'");
	$result = mysqli_fetch_array($query);
	if (mysqli_num_rows($query) > 0)
		return true;

	return false;
}

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
	session_start();
	$username = Security($_SESSION['username']);
	$password = Security($_SESSION['password']);
	$userinfo =  mysqli_fetch_array(mysqli_query($link,"SELECT * FROM users Where username='{$username}' AND password='{$password}'"));
	$userid = $userinfo[id];
} else {
	$username = Security($_COOKIE['username']);
	$password = Security($_COOKIE['password']);
	$userinfo =  mysqli_fetch_array(mysqli_query($link,"SELECT * FROM users Where username='{$username}' AND password='{$password}'"));
	$userid = $userinfo[id];
}

function checkingCorrect($r1,$r2) {
    include "../../conf.php";
	$check =  mysqli_num_rows(mysqli_query($link,"SELECT * FROM users Where username='{$r1}' AND password='{$r2}' order by id"));
	if ($check > 0 )
		return true;
	return false;
}

function onlineusers($username, $password, $title) {
    include "../../conf.php";
	$ip = getenv("REMOTE_ADDR");
	$check = mysqli_num_rows(mysqli_query($link,"SELECT * FROM admin Where username='{$username}' && password='{$password}'"));

	if (!isset($username) || $check <= 0) {
		$username = "$ip";
		$guest = 1;
	} else
		$guest = 0;

	$past = time()-300;
	mysqli_query($link,"DELETE FROM session WHERE time < $past");
	$result = mysqli_query($link,"SELECT time FROM session WHERE uname='{$username}'");
	$ctime = time();

	if ($row = mysqli_fetch_array($result)) {
		mysqli_query($link,"UPDATE session SET uname='{$username}', time='{$ctime}', host_addr='{$ip}', guest='{$guest}', title='{$title}' WHERE uname='{$username}'");

	} else {
		mysqli_query($link,"INSERT INTO session (uname, time, host_addr, guest, title) VALUES ('{$username}', '{$ctime}', '{$ip}', '{$guest}', '{$title}')");
	}
}

function statistic() {
    include "../../conf.php";
	$ip = $_SERVER['REMOTE_ADDR'];
	$check = mysqli_query($link,"SELECT * FROM logs Where ip='{$ip}'");
	$select = mysqli_fetch_array($check);
	$last = mysqli_fetch_array(mysqli_query($link,"SELECT MAX(id) AS LastID FROM statistic"));
	$lastInfo = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM statistic Where id='{$last[LastID]}'"));
	$day = date("d");
	$fullmonths = array('Jan' => 'ינואר','Feb' => 'פברואר','Mar' => 'מרץ','Apr' => 'אפריל','May' => 'מאי','Jun' => 'יוני','Jul' => 'יולי','Aug' => 'אוגוסט','Sep' => 'ספטמבר','Oct' => 'אוקטובר','Dec' => 'דצמבר');
	$month = $fullmonths[date("M")];
	$year = date("Y");

	if ($lastInfo[day] != $day || $lastInfo[month] != $month || $lastInfo[year] != $year)
		mysqli_query($link,"INSERT INTO statistic(day, month, year, unique_today, unique_month, unique_total, view_today, view_month, view_total) VALUES ('{$day}', '{$month}', '{$year}', '0','0','0','0','0','0')");


	if (mysqli_num_rows($check) == 0) {
		$selectip = mysqli_query($link,"SELECT * FROM logs Where ip=''");
		if (mysqli_num_rows($selectip) > 0) {
			mysqli_query($link,"UPDATE statistic SET `unique_today`=`unique_today` +1, `view_today`=`view_today` +1, `view_month`=`view_month` +1, `unique_month`=`unique_month` +1 WHERE day='{$day}' AND month='{$month}' AND year='{$year}'");
			mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1, `unique_total`=`unique_total` +1 WHERE id='1'");
		}
		else if ($select[day] == $day && $select[month] == $month && $select[year] == $year) {
			mysqli_query($link,"UPDATE statistic SET `view_today`=`view_today`, `unique_today`=`unique_today` +1, `view_month`=`view_month` +1, `unique_month`=`unique_month` WHERE day='{$day}' AND month='{$month}' AND year='{$year}'");
			mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1, `unique_total`=`unique_total` +1 WHERE id='1'");
		}
		else if ($select[day] != $day && $select[month] == $month && $select[year] == $year) mysqli_query($link,"UPDATE statistic SET `unique_month`=`unique_month` +1, `view_month`=`view_month` +1 WHERE month='{$month}' AND year='{$year}'");
		else if ($select[day] == $day && $select[month] != $month && $select[year] == $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] == $day && $select[month] == $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] != $month && $select[year] == $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] == $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] == $day && $select[month] != $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] != $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `unique_total`=`unique_total` +1, `view_total`=`view_total` +1 WHERE id='1'");
	} else if (mysql_num_rows($check) > 0) {
		if ($select[day] == $day && $select[month] == $month && $select[year] == $year) {
			mysqli_query($link,"UPDATE statistic SET `view_today`=`view_today` +1, `view_month`=`view_month` +1 WHERE day='{$day}' AND month='{$month}' AND year='{$year}'");
			mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		}
		else if ($select[day] != $day && $select[month] == $month && $select[year] == $year) {
			mysqli_query($link,"UPDATE statistic SET `view_month`=`view_month` +1 Where month='{$month}' AND year='{$year}'");
			mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 Where id='1'");
		}
		else if ($select[day] == $day && $select[month] != $month && $select[year] == $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] == $day && $select[month] == $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] != $month && $select[year] == $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] == $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] == $day && $select[month] != $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
		else if ($select[day] != $day && $select[month] != $month && $select[year] != $year) mysqli_query($link,"UPDATE statistic SET `view_total`=`view_total` +1 WHERE id='1'");
	}

	if (mysql_num_rows($check) == 0)
		mysqli_query($link,"INSERT INTO logs(ip, day, month, year) VALUES ('{$ip}', '{$day}', '{$month}', '{$year}')");
	else
		mysqli_query($link,"UPDATE logs SET day='{$day}', month='{$month}', year='{$year}' WHERE ip='{$ip}'");
}

function Security($val) { 
    include "../../conf.php";
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val); 

   $search = 'abcdefghijklmnopqrstuvwxyz'; 
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
   $search .= '1234567890!@#$%^&*()'; 
   $search .= '~`"<;:?>+/={}[]-_|\'\\'; 
   for ($i = 0; $i < strlen($search); $i++) { 
  
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); 
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);
   } 
    
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'xml', 'blink', 'link', 'style', 'script','alert', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'); 
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onr    owsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
   $ra = array_merge($ra1, $ra2); 
   $banlist = array ("drop", "echo", "insert", "select", "update", "delete", "distinct", "having", "truncate", "replace", "handler", "like", "procedure", "limit", "order by", "group by", "asc", "desc", "union", "include", "userdata", "tb_user", "account_char", 
   "בן זונה", "מניאק", "זונה", "שרמוטה", "בן שרמוטה", "חתיכת חרא", "fuck", "fuck off", "fucking", "asshole", "ass hole", "ass", "bitch");
    
   $found = true;
   while ($found == true) { 
      $val_before = $val; 
      for ($i = 0; $i < sizeof($ra); $i++) { 
         $pattern = '/'; 
         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
            if ($j > 0) { 
               $pattern .= '('; 
               $pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
               $pattern .= '|'; 
               $pattern .= '|(&#0{0,8}([9|10|13]);)'; 
               $pattern .= ')*'; 
            } 
            $pattern .= $ra[$i][$j]; 
         } 
         $pattern .= '/i'; 
         $replacement = ''; 
         $val = preg_replace($pattern, $replacement, $val); 
	 $val = str_replace($banlist, "****", $val); 
         if ($val_before == $val) { 
            $found = false; 
         } 
      } 
   } 
   return mysqli_real_escape_string($link,strip_tags(htmlspecialchars($val)));
} 

function checkprom($prom, $title) {
	if (strstr($prom, $title) == "")
		return false;
	return true;
}

function moveplace($move, $table, $place) {
    include "../../conf.php";
	$max = mysqli_fetch_array(mysqli_query($link,"SELECT MAX(place) as maxplace FROM $table"));
	if ($place == "" || !is_numeric($place)) {} 
	else {
		if ($move == "up") {
			$newplace = $place-1;
			$new = $max[maxplace]+1;
			mysqli_query($link,"UPDATE $table SET place='$new' Where place='$newplace'");
			mysqli_query($link,"UPDATE $table SET place='$newplace' Where place='$place'");
			mysqli_query($link,"UPDATE $table SET place='$place' Where place='$new'");
		}
		if ($move == "down") {
			$newplace = $place+1;
			$new = $max[maxplace]+1;
			mysqli_query($link,"UPDATE $table SET place='$new' Where place='$newplace'");
			mysqli_query($link,"UPDATE $table SET place='$newplace' Where place='$place'");
			mysqli_query($link,"UPDATE $table SET place='$place' Where place='$new'");
		}
	}
}

function checkifpic($name) {
	$base = strstr($name, '.');
	$mime = array('.jpg', '.jpeg', '.png', '.gif','.bmp');
	for ($i=0; $i<count($mime); $i++) {
		if ($mime[$i] == $base)
			return true;
	}
	return false;
}

function check_email($str){

	if( !preg_match( "/^[a-zA-Z0-9_\.\-]{2,}@[a-zA-Z0-9\-\.]{2,}\.[a-zA-Z0-9\-\.]{2,}$/",$str) )
	{
		return true;
	}else{
		return false;
	}

}

function pages ($thepage,$page,$pages) {
	if ($page == "0")
		$tp .= "


						<div class=\"black\">
							<div class=\"title3\">


<a href=\"#\">« הקודם</a>";
	else
		$tp .= "


						<div class=\"black\">
							<div class=\"title3\">
<a href=\"?act=$thepage&page=".($page-1)."\">« הקודם</a>";

	$curPage = $page;
	$totalPages = $pages+1;
	$x = 3;
	for($i=$curPage-1; $i <= $curPage+4; $i++) {
		if ($i > 0 && $i<=$totalPages) {
			if ($i == "".($page+1)."")
				$tp .= "




	<a href=\"#\"><font color=\"#000000\" style=\"background-color:#FFFFFF\">{$i}</font></a>";
			else
				$tp .= "
	<a href=\"?act=$thepage&page=".($i-1)."\"><font color=\"#000000\" style=\"background-color:#FFFFFF\">{$i}</font></a>";
		}
	}


	if (".($pages+1)." == "1" || ".($page+1)." == ".($pages+1).")
		$tp .= "<a href=\"#\">הבא »</a>";
	else
		$tp .= "<a href=\"?act=$thepage&page=".($page+1)."\">הבא »</a>";
					
	$tp .= "




	<font color=\"#000000\" style=\"background-color:#FFFFFF\">עמוד ".($page+1)." מתוך ".($pages+1)."</font>

							</div>

						</div>";
	return $tp;
}

function ReSize($url,$w,$h) {
	$filename = $url;
	$width = $w;
	$height = $h;
	header('Content-type: image/jpeg');
	list($width_orig, $height_orig) = getimagesize($filename);
	$ratio_orig = $width_orig/$height_orig;
	if ($width/$height > $ratio_orig)
		$width = $height*$ratio_orig;
	else
		$height = $width/$ratio_orig;
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	imagejpeg($image_p, null, 100);
	imagedestroy($image_p);
}
?>