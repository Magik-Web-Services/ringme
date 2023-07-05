<?php
$servername = 'localhost';
$username = '';
$password = '';
$dbname = "";
$conn = mysqli_connect($servername, $username, $password, "$dbname");
mysqli_set_charset($conn, "utf8");
if (!$conn) {
    die('Could not Connect MySql Server:' );
}

       include("../../getid3/getid3.php");


$queryy = "SELECT SUM(downloads) FROM songs"; 
$resultt = mysqli_query($conn,$queryy);
while($row = mysqli_fetch_array($resultt)){
	$downloadss = $row['SUM(downloads)'];
}

if (isset($_POST['query'])) {
    $strr = $_POST['query'];

    $words = explode(' ', $strr);
    $words = array_filter($words);
    $regex = implode('|', $words);

//    $query = "SELECT * FROM songs WHERE name REGEXP '{$regex}' OR artist REGEXP '{$regex}' order by (name LIKE '%$strr%')  DESC LIMIT 50";
    $query = "SELECT *, CONCAT(name, ' ', artist) as full_name FROM songs WHERE ";
    $flag = 1;
    foreach ($words as $word) {
        if ($flag === 1) {
            $query .= " CONCAT(name, ' ', artist) LIKE '%" . ($word) . "%'";
        } else {
            $query .= " AND CONCAT(name, ' ', artist) LIKE '%" . ($word) . "%'";
        }
        $flag++;
    }
    $query .= " LIMIT 10";
    $result = mysqli_query($conn, $query);



    if (mysqli_num_rows($result) > 0) {


	echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='13' style='font-size:14px;background-color:#FFFFFF;'><img src='https://www.ringme.co.il/img/svg/search.svg' style='vertical-align:middle'> <b>חיפוש מהיר של צלצולים במערכת</b> • <font color=lightblue'><b><u>לפי טקסט</u></b></font> •</td>
	</tr>

	<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>שם הצלצול</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>שם הזמר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>קטגורייה</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>לינק להורדה</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוזי הורדה</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>זמן צלצול</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>תומך ב</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>מילים</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'>מס הורדות</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>האזנה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>עריכה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>מחיקה</td>
	</tr>";


        while ($user = mysqli_fetch_array($result)) {
            $newstr = $user['name'];
            $newstra = $user['artist'];
            $strrra = $newstra;
            $strrr = $newstr;


       $filename = '../../'.$user['url'];
       $getID3 = new getID3;
       $file = $getID3->analyze($filename);
       $playtime_seconds = $file['playtime_seconds'];
       $secc = gmdate("s", $playtime_seconds);

if ($user['catid'] == 1)
{
$cats = "מזרחית";
} else if ($user['catid'] == 2) {
$cats = "מזרחית רמיקס";
} if ($user['catid'] == 3) {
$cats = "דיכאון";
} else if ($user['catid'] == 4) {
$cats = "לועזי";
} else if ($user['catid'] == 5) {
$cats = "הבקשות שלכם";
} else if ($user['catid'] == 6) {
$cats = "טראנס";
}

$all = $downloadss;
$ccc = $user['downloads'];
	if ( $all != 0 )
		$p = ceil(($ccc/$all) * 100);
	else
		$p = 0;
	$p = "{$p}%";

if ($p > 2) {
$p = "<font color='green'><b>{$p}</b></font>";
} else {
$p = "{$p}";
}

$tes1 = $user['url'];
$name2 = "../../".$tes1;
    if(file_exists($name2))
    {
        $ec = "<img src='https://www.ringme.co.il/images/v.png'>";
       
    }
    else
    {
       $ec = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
        
    }

$tes = $user['urliphone'];
$name1 = "../../".$tes;

if($name1 == "../../") {
        $string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
} else {
    if(file_exists($name1))
    {
        $string = " <font color=\"green\"><b><u>הקובץ נמצא</u></b></font><br />";
    }
    else
    {
        $string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
    }
}


if($user['url'] == "") {
       $ec = "לא הוכנס";
}
if($user['urliphone'] == "") {
        $string = " לא הוכנס<br />";
}

if($user['text'] == "") {
$ecss = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
} else {
$ecss = "<img src='https://www.ringme.co.il/images/v.png'>";
}

$uri = "<a href='https://www.ringme.co.il/song-{$user['id']}.html'><b>{$user['id']}</b></a>";


session_start();
$admin = $_SESSION['ad_user'];
$tesq = mysqli_query($conn,"SELECT * FROM `members` WHERE `user` = '{$admin}'");
$rq = mysqli_fetch_array($tesq);

if($rq["group"] == "1") {
$delete = "<a href='?act=songs&do=delete&id={$r['id']}'><img src='images/delete.png' alt='מחיקה' border='0' style='vertical-align:middle'></a>";
}




            echo <<<END

<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'>{$uri}</td>
	<td align='right' style='font-size:11px;'>{$user['name']}</td>
	<td align='right' style='font-size:11px;'>{$user['artist']}</td>
	<td align='right' style='font-size:11px;'>{$cats}</td>
	<td align='left' style='font-size:11px;'>{$user['url']}</td>
	<td align='center' style='font-size:11px;'>{$p}</td>
	<td align='center' style='font-size:11px;'>{$secc} שניות</td>
	<td align='center' style='font-size:11px;'>{$ec}  // {$string}</td>
	<td align='center' style='font-size:11px;'>{$ecss}</td>
	<td align='center' style='font-size:11px;'>{$user['downloads']}</td>
	<td align='center' style='font-size:11px;'>              <div class="play">
                <audio id="myAudio">
                  <source src="https://www.ringme.co.il/{$user['url']}" type="audio/mpeg">
                </audio>
                <img src="./img/svg/play.svg" style='width: 20px; height: 20px;' alt="נגן">
              </div></td>
	<td align='center' style='font-size:11px;'><a href='?act=songs&do=edit&id={$user['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
<td align='center' style='font-size:11px;'>{$delete}</td>
	</tr>


END;
        }
echo "</table>";
    } else {

        $query = "SELECT * FROM songs WHERE name LIKE '%$strr%' OR artist LIKE '%$strr%' ORDER BY id DESC LIMIT 6";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $newstr = $user['name'];
            $newstra = $user['artist'];
            $strrra = $newstra;
            $strrr = $newstr;

            echo <<<END





END;


        } else {
            echo "<h2>הצלצול לא נמצא באתר</h2>";
        }

    }
    echo "<br /><br /><br />";
}
