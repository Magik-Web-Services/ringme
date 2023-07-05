<?php
$description = "רינג מי - אתר צלצולים להורדה בחינם המקנה שרות צלצולים להורדה בחינם במהירות וביעילות! צלצולים להורדה בחינם ללא צורך בהרשמה! באתר זה תוכלו להוריד צלצולים,רינגטונים,טרוטונים הכי חדשים הכי חמים והכי לוהטים ממגוון הז'אנרים:ים תיכוני, ישראלי, דיכאון ,היפ הופ לועזי, האוס אלקטרו ועוד... להורדה בחינם!";
$keywords = "צלצולים להורדה, צלצולים להורדה בחינם, צלצולים, צלצולים לפלאפון, סלולרי, נוקיה, פלאפון, אורנג', מזרחית, מזרחית רמיקס, דיכאון, האוס, היפ הופ, רוק, דודו אהרון, משה פרץ, רינג מי, רינגמי, טונס, RingMe, שירים להורדה, ים תיכוני";
$charset = "UTF-8";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
<html dir="rtl" lang="he">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo$charset;?>" />
	<title>רינג מי - צלצולים להורדה - צלצולים להורדה בחינם - צלצולים</title>
	<meta name="keywords" content="<?=$keywords?>" />
	<meta name="description" content="<?=$description?>" /> 
	<link rel="stylesheet" type="text/css" href="https://www.RingMe.co.il/style.css">
</head>
<body>
<?php 
include ("conf.php");   
$mail_check=true; 
if(trim($_POST["name"])=="") 
    $mail_check=false; 
if(trim($_POST["name2"])=="") 
    $mail_check=false; 
if(trim($_POST["email"])=="") 
    $mail_check=false; 
if(trim($_POST["content"])=="") 
    $mail_check=false; 
$links = "https://www.RingMe.co.il/song-{$_POST['links']}.html";
$songname = $_POST["songname"];
$art = $_POST["art"];
$down = $_POST["down"];
if($mail_check){ 
    $to = $_POST["email"]; 
    $subject = $_POST['name']." שלח לך את הצלצול - ".$songname." - RingMe.co.il"; 
    $content = "<br> שלום ".$_POST['name2']." <br> <u>".$_POST['name']." שלח לך את הצלצול:</u> ".$art." - ".$songname." <br><u>מס' פעמים שהורד:</u> ".$_POST['down']."<br><u> קישור להאזנה והורדה:</u> <a href=\"$links\">".$links."</a> <br> <u>הערות:</u> ".$_POST['content']."<br>";
    $message = '<html>
<head>
<link rel="stylesheet" type="text/css" href="https://www.RingMe.co.il/style.css">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>$lang["newemailarriveed"]</title>
</head>
<body> 
<div id="header">
    <center><a href="https://www.RingMe.co.il"><img src="https://www.RingMe.co.il/images/logo.png" alt="צלצולים להורדה" border="0" /></a></center>

</br></br>'.$content.' 
    </br></br></br>-----------<br /> 
    <b>'.$lang["info"].':</b><br /> 
    '.$lang["fullname"].': '.$_POST["name"].'<br /> 
    '.$lang["iemail"].': '.$_POST["email"].'<br />
	</div> 
    </body>
</html>'; 
    $headers  = 'MIME-Version: 1.0' . "\r\n"; 
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
    $headers .= 'From: '.$_POST["name"].' <'.$config["email"].'>' . "\r\n"; 
mail($to,$subject,$message,$headers);

    if(mail($to,$subject,$message,$headers)){ 
        $uri = "<b><font color='green'>".$lang["success"]."</font></b>"; 
mail($to,$subject,$message,$headers);
    } 
    else{ 
        $uri = "<b><font color='red'>".$lang["eror1"]."</font></b>"; 
    } 
}else{ 
    $uri = "<b><font color='red'>".$lang["eror2"]."</font></b>"; 
} 

echo $uri;


$headers  = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
$headers .= 'From: <styleurik@gmail.com>' . "\r\n";

mail($to,$subject,$message,$headers);
?>
</body>
</html>