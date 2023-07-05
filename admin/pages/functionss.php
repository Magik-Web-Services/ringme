<?
	function redirect_user ( $location,$text = "מעדכן נתונים" )
	{
	$t = "	(<a href='{$location}'>לחץ כאן אם אין ברצונך להמתין</a>)";
	echo "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='he' lang='he' dir='rtl'>
	<html dir='rtl' lang='he'>
	<head>
	<title>אנא המתן..</title>
	<meta http-equiv='refresh' content='1;url={$location}'>
	<link href='../stylesheet.css' rel='stylesheet' type='text/css'>
	</head>

	<body bgcolor='#FFFFFF'>
	<table width='100%' height='100%'>
	<tr>
	<td valign='middle' align='center'>

	<div align='center' style='width: 210px;position: relative;justify-content: space-between;margin-top: 2px;padding: 2rem;border-radius: 15px;box-shadow: 0px 3px 10px 0px rgba(49, 4, 94, 0.24);transition: all .15s ease;border:1px solid #eaeaea;'>
	<img src='http://www.ringme.co.il/admin/icons8-loading-bar.gif' width='30' height='30'><br/>
	<font style='font-size:12px;color:#00213f;font-family:Arial'><b>
	{$text}</b></font>
	<br />
	<font style='font-size:11px;color:Black;font-family:Arial'>
	המתן, אתה מועבר כעת...
	</font><br /><br /><font style='font-size:11px;color:Gray;font-family:Arial'>
	{$t}
	</font>
	</div>
	</form>
	</td>
	</tr>
	</table>
	</body>
	</html>";

	}
?>