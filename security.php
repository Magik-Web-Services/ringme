<?php 
// SecMod
ob_start();


if (isset($_GET['act']) && !empty($_GET['act']) && $_GET['act'] == "urikas") {
unset($_COOKIE['Security']);
SETCOOKIE('Security','2',time()-3600);
}

$Sec['ip'] = $_SERVER["REMOTE_ADDR"];
$Sec['more'] = $_SERVER["HTTP_USER_AGENT"];

if(isset($_COOKIE['Security']) && !empty($_COOKIE['Security']))
              endmsg();
else
             checkinj();

function checkinj(){
global $Sec;
$url = strtolower($_SERVER['QUERY_STRING']);
if(str_replace(array("kill","setcookie","javascript","insert","select","union","update","drop","alert","hack","banzona"),'',strip_tags($url)) != $url){
        SETCOOKIE('Security','2',time()+3600);
        allmsg();
       }
}


function allmsg(){
global $Sec;
echo <<<HTML
			<html dir="rtl">
			<head><title>RingMe - אבטחה</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
			<style type='text/css'>
			html{ overflow-x:auto; }
			body{ background:#FFF; color:#222; font-family:Arial, Verdana, Tahoma, Times New Roman, Courier; font-size:11px; line-height:135%; margin:0; padding:0; text-align:center; }
			a:link, a:visited, a:active{ background:transparent; color:#0066CC; text-decoration:none; }
			a:hover{ background:transparent; color:#000000; text-decoration:underline; }
			#wrapper{ margin:5px auto 20px auto; text-align:right; width:80%; }
			.borderwrap{ background:#FFF; border:1px solid #EEE; padding:3px; margin:0; }
			.borderwrap p{ background:#F9F9F9; border:1px solid #CCC; margin:5px; padding:10px; text-align:right; }
			.warnbox{ border:1px solid #F00; background:#FFE0E0; padding:6px; margin-right:1%; margin-left:1%; text-align:right; }
			</style>
			</head>
			<body>
			<div id='wrapper'><br /><br />
			<div class='borderwrap'>


			<p style='font-size:15pt; color:#FF3300;'><b>אתה חסום מן המערכת!</b></p><br /><br /><center><img src="images/logo.png" border="0" /></center><br />
			<div class='warnbox'>
			<font size="2">Your IP: <strong>{$Sec['ip']}</strong></font> </font></p>
			</div>
			<br>
			<div align='center' style='border:1px solid #EEE; padding:5px 0px 5px 5px; color:#808080; font-face:Tahoma;'><a href='http://www.RingMe.co.il'></a> 
			Ⓒ 2022 <b>RingMe.co.il</b> Sec</div>	

		</div>
	</div>
	</body>
	</html>
HTML;
die();
}

function endmsg(){
global $Sec;
echo <<<HTML
	<html dir="rtl">
	<head><title>RingMe.co.il - אבטחה</title>
  	           <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
		<style type='text/css'>
			html{ overflow-x:auto; }
			body{ background:#FFF; color:#222; font-family:Arial, Verdana, Tahoma, Times New Roman, Courier; font-size:11px; line-height:135%; margin:0; padding:0; text-align:center; }
			a:link, a:visited, a:active{ background:transparent; color:#0066CC; text-decoration:none; }
			a:hover{ background:transparent; color:#000000; text-decoration:underline; }
			#wrapper{ margin:5px auto 20px auto; text-align:right; width:80%; }
			.borderwrap{ background:#FFF; border:1px solid #EEE; padding:3px; margin:0; }
			.borderwrap p{ background:#F9F9F9; border:1px solid #CCC; margin:5px; padding:10px; text-align:right; }
			.warnbox{ border:1px solid #F00; background:#FFE0E0; padding:6px; margin-right:1%; margin-left:1%; text-align:right; }
		</style>
	</head>
	<body>
	<div id='wrapper'><br /><br />
		<div class='borderwrap'>
			<p style='font-size:15pt; color:#FF3300;'><b>אתה חסום מן המערכת!</b></p><br /><center><img src="images/logo.png" border="0" /></center><br />
<div class='warnbox'>
<b>RingMe.co.il</b>
</div>
<br>
<div align='center' style='border:1px solid #EEE; padding:5px 0px 5px 5px; color:#808080; font-face:Tahoma;'> Ⓒ 2021 <b>RingMe.co.il</b> Sec</div>	
		</div>
	</div>
	</body>
	</html>
HTML;
die();
error_reporting (E_ALL);
if (isset($HTTP_POST_VARS['GLOBALS']) || isset($_POST['GLOBALS']) ||
isset($HTTP_POST_FILES['GLOBALS']) || isset($_FILES['GLOBALS']) ||
isset($HTTP_GET_VARS['GLOBALS']) || isset($_GET['GLOBALS']) ||
isset($HTTP_COOKIE_VARS['GLOBALS']) || isset($_COOKIE['GLOBALS'])) {
trigger_error('Is this a GLOBAL GPC hacking attempt?', E_USER_ERROR);
} 
$HTTP_SERVER_VARS = isset($_SERVER)?$_SERVER:array();
$HTTP_GET_VARS = isset($_GET)?$_GET:array();
$HTTP_POST_VARS = isset($_POST)?$_POST:array();
$HTTP_POST_FILES = isset($_FILES)?$_FILES:array();
$HTTP_COOKIE_VARS = isset($_COOKIE)?$_COOKIE:array();
$HTTP_ENV_VARS = isset($_ENV)?$_ENV:array();
$HTTP_SESSION_VARS = isset($_SESSION)?$_SESSION:array();
}
