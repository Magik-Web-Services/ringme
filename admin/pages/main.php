<?php
date_default_timezone_set('Europe/Athens');
session_start();
?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
<!-- <html dir="rtl" lang="he"> -->

<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <TITLE>הגדרות כלליות</TITLE>
    <link href='stylesheet.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='../java.js'></script>
    <style>
        body {
            background-image: url('https://www.ringme.co.il/admin/images/bg.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</HEAD>

<body style='padding:15px'>
    <?php
    //© All Rights Reserved 09/10 - CMS.co.il ©//
    define('_MATAN', 1);
    // session
    if (empty($_SESSION["ad_group"]))
        die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

    // include "../../conf.php";
    include "functionss.php";
    defined('_MATAN');


    $do = $_GET['do'];
    switch ($do) {
        case 'all':
            main_all();
            break;
        case 'alls':
            main_alls();
            break;
        case 'week':
            main_week();
            break;
        default:
            main_main();
            break;
    }


    function main_all()
    {
        include "../../conf.php";
        mysqli_query($link, "DELETE FROM adminslog");
        $log = "מחק את כל הפעולות האחרונות";
        $song = $_SESSION["ad_user"];
        mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP())");
        redirect_user("main.php", "הפעולות האחרונות נמחקו בהצלחה!");
    }


    function main_alls()
    {
        include "../../conf.php";
        mysqli_query($link, "TRUNCATE TABLE adminslog");
        $log = "איפס את כל הפעולות האחרונות";
        $song = $_SESSION["ad_user"];
        mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '4')");
        redirect_user("main.php", "הפעולות האחרונות התאפסו בהצלחה!");
    }

    function main_week()
    {
        include "../../conf.php";
        mysqli_query($link, "UPDATE songs SET downweek = '0'");
        $log = "איפס את כל ההורדות השבועיות";
        $song = $_SESSION["ad_user"];
        mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$song', UNIX_TIMESTAMP(), '4')");
        redirect_user("main.php", "ההורדות השבועיות התאפסו בהצלחה!");
    }

    function main_main()
    {
        include "../../conf.php";

        $pagesqs = mysqli_query($link, "SELECT * FROM songs");
        $num_rowssq = mysqli_num_rows($pagesqs);
        $songss = $num_rowssq;

        $pages = mysqli_query($link, "SELECT * FROM orders");
        $num_rows = mysqli_num_rows($pages);
        $bakss = $num_rows;


        $pagesnum = mysqli_query($link, "SELECT * FROM category WHERE id");
        $num_rowsnum = mysqli_num_rows($pagesnum);
        $catssq = $num_rowsnum;


        $result = mysqli_query($link, "SELECT * FROM members");
        $admins = mysqli_num_rows($result);

        $result = mysqli_query($link, "SELECT * FROM settings");
        $row = mysqli_fetch_array($result);
        $server_status = $row['send'];
        if ($server_status == 0)
            $server_status = "<img src='../images/on.gif' style='vertical-align:middle' alt='פעיל'> <font color='Green'>פעיל</font>";
        else
            $server_status = "<img src='../images/off.gif' style='vertical-align:middle' alt='לא פעיל'> <font color='Red'>לא פעיל</font>";

        $site_status = $row['sends'];
        if ($site_status == 0)
            $site_status = "<img src='../images/on.gif' style='vertical-align:middle' alt='פעיל'> <font color='Green'>פעיל</font>";
        else
            $site_status = "<img src='../images/off.gif' style='vertical-align:middle' alt='לא פעיל'> <font color='Red'>לא פעיל</font>";


        if ($bakss <= "0") {
            $baksss = "<font color='green'><b>0</b></font>";
        } else {
            $baksss = "<font color='red'><b>" . $bakss . "</b></font>";
        }

        $pages = mysqli_query($link, "SELECT * FROM singers");
        $num_rows = mysqli_num_rows($pages);
        $articles = $num_rows;

        $pagesss = mysqli_query($link, "SELECT * FROM songs WHERE `urliphone` != '' ");
        $num_rowsss = mysqli_num_rows($pagesss);
        $iphoness = $num_rowsss;

        $pagews = mysqli_query($link, "SELECT SUM(downloads) FROM songs WHERE yesorno = '0' ");
        $num_rows = mysqli_num_rows($pagews);


        $query = "SELECT SUM(downloads) FROM songs";
        $result = mysqli_query($link, $query) or die();
        while ($row = mysqli_fetch_array($result)) {
            $downloadss = $row['SUM(downloads)'];
        }

        $query = "SELECT SUM(oldownloads) FROM songs";
        $result = mysqli_query($link, $query) or die();
        while ($row = mysqli_fetch_array($result)) {
            $oldownloadss = $row['SUM(oldownloads)'];
        }


        $query = "SELECT SUM(downweek) FROM songs";
        $result = mysqli_query($link, $query) or die();
        while ($row = mysqli_fetch_array($result)) {
            $downweek = $row['SUM(downweek)'];
        }
    ?>

        <table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
            <tr>
                <td align='right' style='font-size:16px;'>
                    <font color='black'>הגדרות המערכת:</font> <b>סטטיסטיקות</b>
                </td>
            </tr>
        </table>
        <br>
        <?php
        $pagessq = mysqli_query($link, "SELECT * FROM orders");
        $num_rowssq = mysqli_num_rows($pagessq);
        $baksssq = $num_rowssq;

        if ($baksssq > 0) {
            echo "
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#ad1010;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'><b>בקשות צלצולים חדשות ממתינות! טפל בהם..</b></font></td>
	</tr>
	</table>
	<br>
";
        }
        ?>
        <table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
            <tr>
                <td align='right' colspan='4' style='font-size:14px;background-color:#FFFFFF;'><img src='images/poll.gif' style='vertical-align:middle'> <b>סטטיסטיקות המערכת</b></td>
            </tr>
            <tr>
                <td align='right' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>מצב האתר</b></td>
                <td align='right' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>מצב הבקשות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>דוא"ל ליצירת קשר</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>מנהלים</b></td>
            </tr>
            <tr>
                <td align='right' style='font-size:11px;background-color:#ffffff;'><?php echo $server_status ?></td>
                <td align='right' style='font-size:11px;background-color:#ffffff;'><?php echo $site_status ?></td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'>styleurik@gmail.com</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $admins ?></td>
            </tr>
        </table>

        <br />

        <table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
            <tr>
                <td align='right' colspan='8' style='font-size:14px;background-color:#FFFFFF;'><img src='images/poll.gif' style='vertical-align:middle'> <b>סטטיסטיקות כלליות</b></td>
            </tr>
            <tr>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ צלצולים</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ קטגוריות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ צלצולים לאייפון</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ בקשות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ זמרים</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>סה"כ הורדות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>הורדות חדשות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>הורדות שבועיות</b><a href='?act=main&do=week' border='0' /><img src='http://www.ringme.co.il/images/refresh.png'></a></td>
            </tr>
            <tr>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $songss; ?> צלצולים</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $catssq; ?> קטגוריות</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $iphoness; ?> צלצולים</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $baksss; ?> בקשות</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $articles; ?> זמרים</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $downloadss + $oldownloadss; ?> הורדות</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $downloadss; ?> הורדות</td>
                <td align='center' style='font-size:11px;background-color:#ffffff;'><?php echo $downweek; ?> הורדות</td>
            </tr>
        </table>
        <br />

        <table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
            <tr>
                <td align='right' colspan='7' style='font-size:14px;background-color:#FFFFFF;'><img src='images/cup.gif' width='15' height='15' style='vertical-align:middle'> <b>5 הצלצולים הכי מורדים בזמן האחרון</b></td>
            </tr>
            <tr>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>דירוג</b></td>
                <td align='right' style='font-size:12px;background-color:#f2f2f2;' width='30%'><b>שם הצלצול והזמר</b></td>
                <td align='right' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>קטגורייה</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>מס' במערכת</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>אחוזי הורדה</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='30%'><b>מס' הורדות</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='30%'><b>מס' הורדות שבועיות</b></td>
            </tr>

            <?php


            $r = 1;

            $tes = mysqli_query($link, "SELECT * FROM `songs` ORDER BY  `downweek` desc LIMIT 0,1");
            while ($t = mysqli_fetch_array($tes)) {
                $all = $downloadss;
                $ccc = $t['downloads'];
                if ($all != 0)
                    $p = ceil(($ccc / $all) * 100);
                else
                    $p = 0;

                if ($p > 3) {
                    $p = "<font color='green'><b>{$p}%</b></font>";
                } else {
                    $p = "{$p}%";
                }

                if ($t['catid'] == 1) {
                    $cats = "מזרחית";
                } else if ($t['catid'] == 2) {
                    $cats = "מזרחית רמיקס";
                }
                if ($t['catid'] == 3) {
                    $cats = "דיכאון";
                } else if ($t['catid'] == 4) {
                    $cats = "שונות";
                } else if ($t['catid'] == 5) {
                    $cats = "הבקשות שלכם";
                }

                if ($r == 1) {
                    echo "<tr bgcolor='white' onMouseOver=this.bgColor='#f4f4f4' onMouseOut=this.bgColor='white'>
		<td align='center' style='font-size:11px;background-color:#ffffff;'><img src='images/cup.gif' width='15' height='15' style='vertical-align:middle'></td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$t['name']} - {$t['artist']}</td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$cats}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['id']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$p}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downloads']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downweek']}</td>
	</tr>";
                } else {
                    echo "	<tr bgcolor='white' onMouseOver=this.bgColor='#f4f4f4' onMouseOut=this.bgColor='white'>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$urik}</td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$t['name']} - {$t['artist']}</td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$cats}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['id']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$p}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downloads']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downweek']}</td>
	</tr>";
                }
                $urik = $r++;
            }

            $rq = 2;

            $tes = mysqli_query($link, "SELECT * FROM `songs` ORDER BY  `downweek` desc LIMIT 1,4");
            while ($t = mysqli_fetch_array($tes)) {
                $all = $downloadss;
                $ccc = $t['downloads'];
                if ($all != 0)
                    $p = ceil(($ccc / $all) * 100);
                else
                    $p = 0;

                if ($p > 3) {
                    $p = "<font color='green'><b>{$p}%</b></font>";
                } else {
                    $p = "{$p}%";
                }

                if ($t['catid'] == 1) {
                    $cats = "מזרחית";
                } else if ($t['catid'] == 2) {
                    $cats = "מזרחית רמיקס";
                }
                if ($t['catid'] == 3) {
                    $cats = "דיכאון";
                } else if ($t['catid'] == 4) {
                    $cats = "שונות";
                } else if ($t['catid'] == 5) {
                    $cats = "הבקשות שלכם";
                }
                $urikq = $rq++;

                echo "	<tr bgcolor='white' onMouseOver=this.bgColor='#f4f4f4' onMouseOut=this.bgColor='white'>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$urikq}</td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$t['name']} - {$t['artist']}</td>
		<td align='right' style='font-size:11px;background-color:#ffffff;'>{$cats}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['id']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$p}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downloads']}</td>
		<td align='center' style='font-size:11px;background-color:#ffffff;'>{$t['downweek']}</td>
	</tr>";
            }

            ?>

        </table>


        <br />


        <table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
            <tr>
                <td align='right' colspan='5' style='font-size:14px;background-color:#FFFFFF;'><img src='images/key.gif' style='vertical-align:middle'> <b>10 פעולות אחרונות של מנהלים</b> <a href='?act=main&do=all'><u>
                            <font color='red'>מחק הכל</font>
                        </u></a> / <a href='?act=main&do=alls'><u>
                            <font color='blue'>אפס</font>
                        </u></a></td>
            </tr>
            <tr>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>#</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='12%'><b>מנהל</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='12%'><b>כתובת אייפי</b></td>
                <td align='center' style='font-size:12px;background-color:#f2f2f2;' width='13%'><b>תאריך</b></td>
                <td align='right' style='font-size:12px;background-color:#f2f2f2;' width='53%'><b>פעולה</b></td>
            </tr>


            <?php
            $result = mysqli_query($link, "SELECT * FROM adminslog ORDER BY id DESC LIMIT 10");
            $n = mysqli_num_rows($result);
            if ($n > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $d = @mysqli_query($link, "SELECT * FROM members ");
                    $a = @mysqli_fetch_array($d);

                    if ($row['text'] == "התחבר למערכת")
                        $row['text'] = "<font color='green'>{$row['user']}</font>";

                    if ($row['img'] == "1")
                        $row['img'] = "<img src='images/add.gif' style='vertical-align:middle'>";

                    if ($row['img'] == "2")
                        $row['img'] = "<img src='images/edit.png' style='vertical-align:middle'>";

                    if ($row['img'] == "3")
                        $row['img'] = "<img src='images/delete.png' style='vertical-align:middle'>";

                    if ($row['img'] == "4")
                        $row['img'] = "<img src='images/refresh.png' style='vertical-align:middle'>";

                    if ($row['img'] == "5")
                        $row['img'] = "<img src='images/on.gif' style='vertical-align:middle'>";

                    if ($row['img'] == "6")
                        $row['img'] = "<img src='images/off.gif' style='vertical-align:middle'>";

                    $rowa = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `adminslog` WHERE `id` = '{$row['id']}'"));
                    // get the date
                    $da = date("d/m/Y", $rowa['date']);
                    // get the time
                    $ga = date("G:i", $rowa['date']);



                    date('d-m-Y H:i:s');


                    echo "<tr>
	<td align='center' style='font-size:11px;background-color:#ffffff;'>{$row['id']}</td>
	<td align='center' style='font-size:11px;background-color:#ffffff;'>{$row['user']}</td>
	<td align='center' style='font-size:11px;background-color:#ffffff;'>{$row['ip']}</td>
	<td align='center' style='font-size:11px;background-color:#ffffff;'>{$da} - {$ga}</td>
	<td align='right' style='font-size:11px;background-color:#ffffff;'>{$row['img']} {$row['text']}</td>
	</tr>";
                }
            } else
                echo "<tr>
	<td align='center' style='font-size:11px;background-color:#ffffff;' colspan='3'>פעולות אחרונות של אדמינים לא זמינים כרגע</td>
	</tr>";

            ?>
        </table>
    <?php
    }
    ?>