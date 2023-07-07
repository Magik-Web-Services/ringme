<?php
session_start();
date_default_timezone_set("israel");

if ($_SESSION["ad_group"] != 1)
	die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");
?>
<!DOCTYPE html>
<html dir="rtl" lang="he">

<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<HEAD>
		<TITLE>ניהול צלצולים</TITLE>
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<link href='stylesheet.css' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style>
			<?php
			if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad8')) {
			?>table {
				overflow-x: auto;
				display: block;
			}

			<?php
			}
			?>td {
				overflow: hidden;
				text-overflow: ellipsis;
				word-wrap: break-word;
			}

			.name {
				display: flex;
				justify-content: center;
				align-items: center;

				width: 70%;
				margin: 50px auto;
				padding: 15px 10px;
				border: 1px solid #A475D2;
				border-radius: 20px;

				transition: all .2s ease;
			}

			.name.focused {
				border-color: rgb(143, 79, 207);
				transform: scale(1.1);
			}

			.name-input {
				border: none;
				font-size: 2rem;
				margin: 0px 10px;

				color: #533e67;
			}

			.name .name-input:focus {
				outline: none;
				border-color: black;
			}

			.name-input::placeholder {
				color: #A475D2;
			}
		</style>
		<script type='text/javascript' src='../java.js'></script>
		<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
	</HEAD>

<body bgcolor="#FFFFFF" style='padding:15px'>
	<?php
	//© All Rights Reserved 09/10 - CMS.co.il ©//
	define('_MATAN', 1);
	include("../../getid3/getid3.php");

	include "../../conf.php";
	// include "functionss.php";
	$do = (isset($_GET['do']) && !empty($_GET['do'])) ? $_GET['do'] : '';
	switch ($do) {
		case 'add':
			sng_add();
			break;

		case 'hot':
			sng_hot();
			break;

		case 'upload':
			sng_upload();
			break;

		case 'delete':
			if ($_SESSION["ad_group"] != 1)
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

			$admin = $_SESSION['ad_user'];
			$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$r = mysqli_fetch_array($tes);

			if ($r["group"] > "1")
				die("אין לך גישה, אנה פנה למנהל שלך על מנת לפתור בעיה זו");

			sng_delete();
			break;
		case 'edit':

			sng_edit();
			break;


		default:
			sng_main();
			break;
	}


	function sng_hot()
	{

		include "../../conf.php";
		$admin = $_SESSION['ad_user'];
		$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
		$r = mysqli_fetch_array($tes);

		$Apage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$Apage) {
			$page = "";
		} else {
			$page = "> עמוד מספר " . $Apage;
		}

		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת צלצולים חמים</b> {$page} 
</td>
	</tr>
	</table>
	<br>
END;

		if (isset($_POST['submit'])) {
			$_SESSION["catss"] = $_POST["catt"];
		}

		$limit = "30";
		$cpage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$cpage || $cpage < 1) {
			$cpage = 1;
		}
		$t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM songs"));
		$p1 = $t / $limit;
		$pages = ceil($p1);
		$npage = $cpage + 1;
		$ppage = $cpage - 1;
		$i = ($cpage * $limit) - $limit;

		$order = (isset($_GET['order']) && !empty($_GET['order'])) ? $_GET['order'] : '';

		if ($order == "") {
			$res = mysqli_query($link, "SELECT * FROM songs WHERE `hot` = '2' ORDER by id DESC");
		} else if ($order == "2") {
			$limit = "100";
			$res = mysqli_query($link, "SELECT * FROM songs ORDER BY oldownloads DESC LIMIT $i,$limit");
		} else if ($order == "") {
			$res = mysqli_query($link, "SELECT * FROM songs ORDER by id DESC LIMIT $i,$limit");
		} else if ($order == "1") {
			$limit = "100";
			$res = mysqli_query($link, "SELECT * FROM songs ORDER BY downloads DESC LIMIT $i,$limit");
		}


		if (!$order) {
			$downa = "<a href='?order=1'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		} else if ($order == "1") {
			$downa = "<a href='songs.php'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		}

		if (!$order) {
			$olddowna = "<a href='?order=2'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		} else if ($order == "2") {
			$olddowna = "<a href='songs.php'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		}


		echo "<form method=\"POST\" name=\"form\" action=\"\">";

		echo "<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='11' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת צלצולים במערכת</b></td>
	</tr>

	<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>שם הצלצול</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='15%'><b>שם הזמר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>קטגורייה</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='20%'><b>לינק להורדה</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>אחוזי הורדה</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>תומך ב</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>מילים</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'>{$downa}</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>האזנה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>עריכה</td>
	</tr>";

		if ($_SESSION["ad_group"] != 1) {
			$save = "disabled=\"disabled\"";
		} else {
			$save = "";
		}

		$query = "SELECT SUM(downloads) FROM songs";
		$result = mysqli_query($link, $query) or die();
		while ($row = mysqli_fetch_array($result)) {
			$downloadss = $row['SUM(downloads)'];
		}



		$r = 1;
		$tes = mysqli_query($link, "SELECT * FROM `songs` ORDER BY  `downloads`");
		$t = mysqli_fetch_array($tes);

		$num = "1";
		while ($r = mysqli_fetch_array($res)) {



			if ($r['text'] == "") {
				$ecss = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
			} else {
				$ecss = "<img src='https://www.ringme.co.il/images/v.png'>";
			}

			if ($r['catid'] == 1) {
				$cats = "מזרחית";
			} else if ($r['catid'] == 2) {
				$cats = "מזרחית רמיקס";
			}
			if ($r['catid'] == 3) {
				$cats = "דיכאון";
			} else if ($r['catid'] == 4) {
				$cats = "לועזי";
			} else if ($r['catid'] == 5) {
				$cats = "הבקשות שלכם";
			} else if ($r['catid'] == 6) {
				$cats = "טראנס";
			}


			$all = $downloadss;
			$ccc = $r['downloads'];
			if ($all != 0)
				$p = ceil(($ccc / $all) * 100);
			else
				$p = 0;
			$p = "{$p}%";

			if ($p > 2) {
				$p = "<font color='green'><b>{$p}</b></font>";
			} else {
				$p = "{$p}";
			}


			session_start();
			$admin = $_SESSION['ad_user'];
			$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$rq = mysqli_fetch_array($tesq);

			if ($rq["group"] == "1") {
				$delete = "<a href='?act=songs&do=delete&id={$r['id']}'><img src='images/delete.png' alt='מחיקה' border='0' style='vertical-align:middle'></a>";
			}


			$numu = $num++;


			if ($numu <= "11") {
				$uri = "<a href='https://www.ringme.co.il/song-{$r['id']}.html'><font color='green'><b>{$r['id']}</b></font></a>";
			} else {
				$uri = "<a href='https://www.ringme.co.il/song-{$r['id']}.html'><b>{$r['id']}</b></a>";
			}



			$tes77 = $r['url'];
			$name22 = "../../" . $tes77;
			if (file_exists($name22)) {
				$ec = "<img src='https://www.ringme.co.il/images/v.png'>";
			} else {
				$ec = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
			}

			$tes7 = $r['urliphone'];
			$name8 = "../../" . $tes7;
			if (file_exists($name8)) {
				$stringt = " <font color=\"green\"><b><u>הקובץ נמצא</u></b></font><br />";
			} else {
				$stringt = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
			}




			if ($r['url'] == "") {
				$ec = "לא הוכנס";
			}
			if ($r['urliphone'] == "") {
				$stringt = " לא הוכנס<br />";
			}



			echo "
<tr bgcolor='white' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"white\"'>
	<td align='center' style='font-size:11px;'>{$uri}</td>
	<td align='right' style='font-size:11px;'>{$r['name']}</td>
	<td align='right' style='font-size:11px;'>{$r['artist']}</td>
	<td align='right' style='font-size:11px;'>{$cats}</td>
	<td align='left' style='font-size:11px;'>{$r['url']}</td>
	<td align='center' style='font-size:11px;'>{$p}</td>
	<td align='center' style='font-size:11px;'>{$ec} // {$stringt}</td>
	<td align='center' style='font-size:11px;'>{$ecss}</td>
	<td align='center' style='font-size:11px;'>{$r['downloads']}</td>
	<td align='center' style='font-size:11px;'><a target='songs' href='https://www.ringme.co.il/song-{$r['id']}.html'><img border='0' src='https://ringme.co.il/images/play.png' style='width: 20px; height: 20px;' /></a></td>
	<td align='center' style='font-size:11px;'><a href='?act=songs&do=edit&id={$r['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
	</tr>";
		}
		echo "</table></form>";
		echo "</div>";
	}

	$idcat = (isset($_POST['catt']) && !empty($_POST['catt'])) ? $_POST['catt'] : '';




	function sng_main()
	{
		include "../../conf.php";
		$admin = $_SESSION['ad_user'];
		$tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
		$r = mysqli_fetch_array($tes);

		$Apage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$Apage) {
			$page = "";
		} else {
			$page = "> עמוד מספר " . $Apage;
		}

		echo <<<END


	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת צלצולים</b> {$page} 
</td>
	</tr>
	</table>
	<br>

	<table cellpadding='3' cellspacing='0' width='100%' style='background-color:#FFFFFF;color:#062b4d;border:1px dashed #d1d1d1'>
	<tr>
	<td align='right'><img src='images/search.jpg' style='vertical-align:middle'> חיפוש צלצול</td>
	<td align='right'>
	מס' צלצול: <div class="searchid"><input type="text" name="searchid" id="searchid" placeholder="ID..." class='forminput' value='' style='text-align:center;direction:ltr;width:50px' /></div>
	</td> 
	<td align='right'>
	שם הצלצול:     <div class="search"><input type="text" name="search" id="search" placeholder="חפש צלצול..." class='forminput' style='text-align:center;direction:ltr;width:100px' /></div>
	
	</form></td>
	</tr>
	</table>
	<br>



<div id="output"></div>
<div id="outputid"></div>
<script type="text/javascript">
    $(document).ready(function () {
        function attachPlayEventToPlayButtons(playButtons) {
            playButtons.forEach(el => el.addEventListener('click', function () {

                const isThisPlaying = el.querySelector('img').getAttribute('src').includes('pause') ? true : false;

                pauseMusic();

                // set pause
                const thisImage = this.querySelector('img');
                if (isThisPlaying) {
                    thisImage.setAttribute('src', './img/svg/play.svg');


                } else {
                    // remove pause icon from all
                    document.querySelectorAll('.play img').forEach(pl => pl.setAttribute('src', './img/svg/play.svg'));

                    thisImage.setAttribute('src', './img/svg/pause.svg');
                    setTimeout(() => {

                        playMusic(this);
                    }, 200);
                }
            }));
        }

        function pauseMusic() {
            document.querySelectorAll('audio').forEach(au => {
                au.pause()
                au.currentTime = 0;
            });
        }

        function playMusic(el) {
            el.querySelector('audio').play();
        }

        // handle scroll to top
        const scrollToTop = document.querySelector('.to-page-top');
        window.addEventListener('scroll', function () {
            console.log('scrolling')
            if (window.pageYOffset > 100 && !scrollToTop.classList.contains('show'))
                scrollToTop.classList.add('show');

            else if (window.pageYOffset <= 100 && scrollToTop.classList.contains('show'))
                scrollToTop.classList.remove('show');
        });


        function debounce(func, wait, immediate) {
        var timeout;
        return function() {
        var context = this, args = arguments;
        var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
        };
};


        $("#search").on('keyup', debounce(function (e) {
            const query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: 'ajax-db-search.php',
                    method: 'POST',
                    data: { query },
                    success: function (data) {
                        $('#output').html(data);
                        $('#output').css('display', 'block');
                        const playButtons = document.querySelectorAll('#output .play');
                        attachPlayEventToPlayButtons(playButtons);
                    }
                });
            } else {
                $('#output').css('display', 'none');
            }
        }, 300));


        $("#searchid").on('keyup', debounce(function (e) {
            const query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: 'ajax-db-searchh.php',
                    method: 'POST',
                    data: { query },
                    success: function (data) {
                        $('#outputid').html(data);
                        $('#outputid').css('display', 'block');
                        const playButtons = document.querySelectorAll('#output .play');
                        attachPlayEventToPlayButtons(playButtons);
                    }
                });
            } else {
                $('#outputid').css('display', 'none');
            }
        }, 300));






        const dropdownHeadlines = document.querySelectorAll('.dropdown-headline'),
            dropdowns = document.querySelectorAll('.dropdown');


        // on hover, add class open
        dropdowns.forEach(el => {
            el.addEventListener('click', function () {
                this.querySelector('.dropdown-content').classList.toggle('open');
            });


            document.addEventListener('click', function (event) {
                var isClickInside = el.contains(event.target);
                if (!isClickInside) {
                    el.querySelector('.dropdown-content').classList.remove('open');
                }
            });
        });
        const playButtons = document.querySelectorAll('.play');
        attachPlayEventToPlayButtons(playButtons);

    });
</script>
END;

		if (isset($_POST['submit'])) {
			$_SESSION["catss"] = $_POST["catt"];
		}



		$limit = "13";
		$cpage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';
		if (!$cpage || $cpage < 1) {
			$cpage = 1;
		}
		$t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM songs"));
		$p1 = $t / $limit;
		$pages = ceil($p1);
		$npage = $cpage + 1;
		$ppage = $cpage - 1;
		$i = ($cpage * $limit) - $limit;

		$order = (isset($_GET['order']) && !empty($_GET['order'])) ? $_GET['order'] : '';

		if ($order == "") {
			$res = mysqli_query($link, "SELECT * FROM songs ORDER by id DESC LIMIT $i,$limit");
		} else if ($order == "2") {
			$limit = "100";
			$res = mysqli_query($link, "SELECT * FROM songs ORDER BY oldownloads DESC LIMIT $i,$limit");
		} else if ($order == "") {
			$res = mysqli_query($link, "SELECT * FROM songs ORDER by id DESC LIMIT $i,$limit");
		} else if ($order == "1") {
			$limit = "100";
			$res = mysqli_query($link, "SELECT * FROM songs ORDER BY downloads DESC LIMIT $i,$limit");
		}


		if (!$order) {
			$downa = "<a href='?order=1'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		} else if ($order == "1") {
			$downa = "<a href='songs.php'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		}

		if (!$order) {
			$olddowna = "<a href='?order=2'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		} else if ($order == "2") {
			$olddowna = "<a href='songs.php'><img src='images/menu_open.gif' style='vertical-align:middle' alt='סדר לפי כמות הורדות' border='0'> <b>מס' הורדות</b></a>";
		}

		$Auser = (isset($user['url']) && !empty($user['url'])) ? $user['url'] : '';
		$tes1 = $Auser;
		$name2 = "../../" . $tes1;
		if (file_exists($name2)) {
			$ec = "<img src='https://www.ringme.co.il/images/v.png'>";
		} else {
			$ec = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
		}
		$tes = (isset($user['urliphone']) && !empty($user['urliphone'])) ? $user['urliphone'] : '';
		$name1 = "../../" . $tes;

		if ($name1 == "../../") {
			$string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
		} else {
			if (file_exists($name1)) {
				$string = " <font color=\"green\"><b><u>הקובץ נמצא</u></b></font><br />";
			} else {
				$string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
			}
		}

		$Aurl = (isset($user['url']) && !empty($user['url'])) ? $user['url'] : '';
		if ($Aurl == "") {
			$ec = "לא הוכנס";
		}
		if ($Aurl == "") {
			$string = " לא הוכנס<br />";
		}



		echo "<form method=\"POST\" name=\"form\" action=\"\">";

		echo "<table cellpadding='2' cellspacing='1'  style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='13' style='font-size:14px;background-color:#FFFFFF;'><img src='images/package.png' style='vertical-align:middle'> <b>רשימת צלצולים במערכת</b></td>
	</tr>

	<tr>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='3%'><b>#</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>שם הצלצול</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>שם הזמר</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='6%'><b>קטגורייה</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='10%'><b>לינק להורדה</b></td>
	<td align='right' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>זמן צלצול</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'><b>תומך ב</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='4%'><b>מילים</b></td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='5%'>{$downa}</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='4%'>האזנה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='4%'>עריכה</td>
	<td align='center' style='font-size:12px;background-color:#f2f2f2;' width='4%'>מחיקה</td>
	</tr>";

		if ($_SESSION["ad_group"] != 1) {
			$save = "disabled=\"disabled\"";
		} else {
			$save = "";
		}

		$query = "SELECT SUM(downloads) FROM songs";
		$result = mysqli_query($link, $query) or die();
		while ($row = mysqli_fetch_array($result)) {
			$downloadss = $row['SUM(downloads)'];
		}



		$r = 1;
		$tes = mysqli_query($link, "SELECT * FROM `songs` ORDER BY  `downloads`");
		$t = mysqli_fetch_array($tes);

		$num = "1";

		while ($r = mysqli_fetch_array($res)) {


			if ($r['text'] == "") {
				$ecss = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
			} else {
				$ecss = "<img src='https://www.ringme.co.il/images/v.png'>";
			}

			if ($r['catid'] == 1) {
				$cats = "מזרחית";
			} else if ($r['catid'] == 2) {
				$cats = "מזרחית רמיקס";
			}
			if ($r['catid'] == 3) {
				$cats = "דיכאון";
			} else if ($r['catid'] == 4) {
				$cats = "לועזי";
			} else if ($r['catid'] == 5) {
				$cats = "הבקשות שלכם";
			} else if ($r['catid'] == 6) {
				$cats = "טראנס";
			}

			session_start();
			$admin = $_SESSION['ad_user'];
			$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$rq = mysqli_fetch_array($tesq);

			if ($rq["group"] == "1") {
				$delete = "<a href='?act=songs&do=delete&id={$r['id']}'><img src='images/delete.png' alt='מחיקה' border='0' style='vertical-align:middle'></a>";
			}


			$numu = $num++;


			if ($numu <= "6") {
				$uri = "<a href='https://www.ringme.co.il/song-{$r['id']}.html'><font color='green'><b>{$r['id']}</b></font></a>";
			} else {
				$uri = "<a href='https://www.ringme.co.il/song-{$r['id']}.html'><b>{$r['id']}</b></a>";
			}



			$tesqpp = mysqli_query($link, "SELECT * FROM songs ");
			$rqpp = mysqli_fetch_array($tesqpp);

			if ($r['hot'] == "2") {
				$urikascolor = "red";
			} else if ($r['hot'] == "1") {
				$urikascolor = "white";
			}


			$urltest = "https://www.ringme.co.il/ring/EyalGolan-RacevetHarim.m4r";
			if (!file_exists($urltest)) {
				$filefound = '0';
			} else {
				$filefound = '1';
			}


			$tes1 = $r['url'];
			$name2 = "../../" . $tes1;
			if (file_exists($name2)) {
				$ec = "<img src='https://www.ringme.co.il/images/v.png'>";
			} else {
				$ec = "<img src='https://www.ringme.co.il/images/icon-no.png'>";
			}

			$tes = $r['urliphone'];
			$name1 = "../../" . $tes;

			if ($name1 == "../../") {
				$string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
			} else {
				if (file_exists($name1)) {
					$string = " <font color=\"green\"><b><u>הקובץ נמצא</u></b></font><br />";
				} else {
					$string = " <font color=\"red\"><b><u>הקובץ לא נמצא</u></b></font><br />";
				}
			}





			if ($r['url'] == "") {
				$ec = "לא הוכנס";
			}
			if ($r['urliphone'] == "") {
				$string = " לא הוכנס<br />";
			}

			if ($r['id'] <= "551") {
				$olddo = "{<font style='font-size:9px;'>{$r['oldownloads']}</font>}";
			}

			$Afile = (isset($file['playtime_seconds']) && !empty($file['playtime_seconds'])) ? $file['playtime_seconds'] : '1';
			$filename = '../../' . $r['url'];
			$getID3 = new getID3;
			$file = $getID3->analyze($filename);
			$secc = gmdate( $Afile);

			echo "
<tr bgcolor='{$urikascolor}' onMouseOver='this.bgColor=\"#f4f4f4\"' onMouseOut='this.bgColor=\"{$urikascolor}\"'>
	<td align='center' style='font-size:11px;'>{$uri}</td>
	<td align='right' style='font-size:11px;'>{$r['name']}</td>
	<td align='right' style='font-size:11px;'>{$r['artist']}</td>
	<td align='right' style='font-size:11px;'>{$cats}</td>
	<td align='left' style='font-size:11px;'>{$r['url']}</td>
	<td align='center' style='font-size:11px;'>{$secc} שניות</td>
	<td align='center' style='font-size:11px;'>{$ec}  // {$string}</td>
	<td align='center' style='font-size:11px;'>{$ecss}</td>
	<td align='center' style='font-size:11px;'>{$olddo} {$r['downloads']}</td>
	<td align='center' style='font-size:11px;'>
              <div class='play'>
                <audio id='myAudio'>
                  <source src='https://www.ringme.co.il/{$r['url']}' type='audio/mpeg'>
                </audio>
                <img src='./img/svg/play.svg' style='width: 20px; height: 20px;' alt='נגן'>
              </div>
</td>
	<td align='center' style='font-size:11px;'><a href='?act=songs&do=edit&id={$r['id']}'><img src='images/edit.png' alt='עריכה' border='0' style='vertical-align:middle'></a></td>
	<td align='center' style='font-size:11px;'>{$delete}</td>
	</tr>";
		}
		echo "</table></form>";
		if ($pages != 1) {
			$ii = 1;
			echo "<br /><div align=center>";
			echo "<u>עמודים</u>:  ";
			while ($ii <= $pages) {

				if ($ii == $_GET['page']) {
					echo " ,<a href='?act=songs&page=$ii'><font color='black' style='font-size:15px;'><b><font color='#9112ff'>$ii</font></b></font></a>";
				} else {
					echo " ,<a href='?act=songs&page=$ii'><font color='black' style='font-size:13px;'>$ii</font></a>";
				}

				$ii++;
			}
			echo "</div>";
		}
		echo "</div>";
	}

	function sng_add()
	{
		include "../../conf.php";
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת צלצולים > הוספת צלצול</b></td>
	</tr>
	</table>
	<br>
		<div dir="rtl">
END;
		$reg = "";
		$error = "";
		function add_form()
		{
			include "../../conf.php";
			$idcat = (isset($_SESSION["catss"]) && !empty($_SESSION["catss"])) ? $_SESSION["catss"] : '';
			$query = "SELECT MAX(id) FROM songs";
			$result = mysqli_query($link, $query) or die();
			$row = mysqli_fetch_array($result);
			$idsaq = $row['MAX(id)'] + 1;
			$values = $idsaq;
			echo <<<END

		

		{$idcat}
		<form method="post" action="?act=songs&do=add" enctype="multipart/form-data" name="phuploader">
		<table>

			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>מס צלצול: </b></font>
				</td>
				<td align="right">
					<input type="text" name="values" size="50" disabled value="#{$values}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם צלצול: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אומן: </b></font>
				</td>
				<td align="right">	
					<input type="text" name="artist" size="50">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קובץ: </b></font>
				</td>
				<td align="right">
					<input type="text" name="url" dir="ltr" size="50" value="ring/">
				</td>
			</tr>

			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קובץ אייפון: </b></font>
				</td>
				<td align="right">
					<input type="text" name="urliphone" dir="ltr" size="50" value="ring/">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קטגוריה: </b></font>
				</td>
				<td align="right">
					<select name="cat">
					<option value="1" selected>מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6">טראנס</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קבצים:</b></font>
				</td>
				<td align="right">
					<input type="file" name="file[]" size="50" />
					<input type="file" name="file[]" size="50" />
					<input type="hidden" name="submit" value="true" />
				</td>
			</tr>


			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>פיזמון: </b></font>
				</td>
				<td align="right">
					<textarea id="editor_kama"  name="des" rows="15" cols="80" style="width: 100%"></textarea>

				</td>
			</tr>


			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name = "submit" value="הוסף"></td>
			</tr>
		</table>
		</form> 
END;
		}

		if (isset($_POST['submit'])) {

			$des = $_POST['des'];
			$dess = '"' . $des . '"';



			// גודל העלאה מקסימלי KB
			$max_file_size = "10000";

			// גודל העלאה מקסימלי להעלאת 2 קבצים KB
			$max_combined_size = "50000";

			//כמה קבצים יהיה ניתן להעלות בהעלאה אחת?
			$file_uploads = "0";

			//השם של מערכת האתר
			$websitename = "ringme.co.il";

			// השתמש בשמות קובץ אקראיים? true = כן (מומלץ), false = השתמש בשם הקובץ המקורי. שמות אקראיים יעזרו למנוע כתיבה על קבצים קיימים!
			$random_name = false;

			// קבצים מותרים להעלאה
			$allow_types = array("mp3", "m4r");

			// נתיב תקיית העלות
			$folder = "../../ring/";

			// הכתובת המלאה של המערכת. סיים בסלאש
			$full_url = "https://www.ringme.co.il/ring/";

			// השתמש במשתנה זה רק אם ברצונך להשתמש בנתיבי שרת מלאים. אחרת השאר את זה ריק! עם סלאש עוקב.
			$fullpath = "";

			//סיסמת גישה להעלאת קבצים
			$password = "";

			/*
//================================================================================
* ! שים לב !
//================================================================================
:אל תערוך את השורות אם אתה לא יודע PHP.
*/

			// MD5 the password.. why not?
			$password_md5 = md5($password);

			// If you set a password this is how they get verified!
			if ($password) {
				if ($_POST['verify_password'] == true) {
					if (md5($_POST['check_password']) == $password_md5) {
						setcookie("phUploader", $password_md5, time() + 86400);
						sleep(1); //seems to help some people.
						header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
						exit;
					}
				}
			}

			// The password form, if you set a password and the user has not entered it this will show.
			$password_form = "";
			if ($password) {
				if ($_COOKIE['phUploader'] != $password_md5) {
					$password_form = "<form method=\"POST\" action=\"" . $_SERVER['PHP_SELF'] . "\">\n";
					$password_form .= "<table align=\"center\" class=\"table\">\n";
					$password_form .= "<tr>\n";
					$password_form .= "<td width=\"100%\" class=\"table_header\" colspan=\"2\">נדרשת סיסמא</td>\n";
					$password_form .= "</tr>\n";
					$password_form .= "<tr>\n";
					$password_form .= "<td width=\"35%\" class=\"table_body\">הקש סיסמא:</td>\n";
					$password_form .= "<td width=\"65%\" class=\"table_body\"><input type=\"password\" name=\"check_password\" /></td>\n";
					$password_form .= "</tr>\n";
					$password_form .= "<td colspan=\"2\" align=\"center\" class=\"table_body\">\n";
					$password_form .= "<input type=\"hidden\" name=\"verify_password\" value=\"true\">\n";
					$password_form .= "<input type=\"submit\" value=\" אמת סיסמא \" />\n";
					$password_form .= "</td>\n";
					$password_form .= "</tr>\n";
					$password_form .= "</table>\n";
					$password_form .= "</form>\n";
				}
			}
			$types = "";
			// Function to get the extension a file.
			function get_ext($key)
			{
				$key = strtolower(substr(strrchr($key, "."), 1));
				// Cause there the same right?
				$key = str_replace("jpeg", "jpg", $key);
				return $key;
			}

			$ext_count = count($allow_types);
			$i = 0;
			foreach ($allow_types as $extension) {

				//Gets rid of the last comma for display purpose..

				if ($i <= $ext_count - 2) {
					$types .= "*." . $extension . ", ";
				} else {
					$types .= "*." . $extension;
				}
				$i++;
			}
			unset($i, $ext_count); // why not

			$error = "";
			$display_message = "";
			$uploaded = false;

			// Dont allow post if $password_form has been populated
			if ($_POST['submit'] == true and !$password_form) {

				for ($i = 0; $i <= $file_uploads - 1; $i++) {
					
					if ($_FILES['file']['name'][$i]) {

						$ext = get_ext($_FILES['file']['name'][$i]);
						$size = $_FILES['file']['size'][$i];
						$max_bytes = $max_file_size * 1024;

						// For random names
						if ($random_name) {
							$file_name[$i] = time() + rand(0, 100000) . "." . $ext;
						} else {
							$file_name[$i] = $_FILES['file']['name'][$i];
						}

						//Check if the file type uploaded is a valid file type. 

						if (!in_array($ext, $allow_types)) {

							$error .= "Invalid extension for your file: " . $_FILES['file']['name'][$i] . ", only " . $types . " are allowed.<br />Your file(s) were <b>not</b> uploaded.<br />";

							//Check the size of each file

						} elseif ($size > $max_bytes) {

							$error .= "Your file: " . $_FILES['file']['name'][$i] . " is to big. Max file size is " . $max_file_size . "kb.<br />Your file(s) were <b>not</b> uploaded.<br />";

							// Check if the file already exists on the server..
						} elseif (file_exists($folder . $file_name[$i])) {

							$error .= "The file: " . $_FILES['file']['name'][$i] . " exists on this server, please rename your file.<br />Your file(s) were <b>not</b> uploaded.<br />";
						}
					} // If Files

				} // For

				//Tally the size of all the files uploaded, check if it's over the ammount.

				$total_size = array_sum($_FILES['file']['size']);

				$max_combined_bytes = $max_combined_size * 1024;

				if ($total_size > $max_combined_bytes) {
					$error .= "The max size allowed for all your files combined is " . $max_combined_size . "kb<br />";
				}


				// If there was an error take notes here!

				if ($error) {

					$display_message = $error;
				} else {

					// No errors so lets do some uploading!

					for ($i = 0; $i <= $file_uploads - 1; $i++) {

						if ($_FILES['file']['name'][$i]) {

							if (@move_uploaded_file($_FILES['file']['tmp_name'][$i], $folder . $file_name[$i])) {
								$uploaded = true;
							} else {
								$display_message .= "Couldn't copy " . $file_name[$i] . " to server, please make sure " . $folder . " is chmod 777 and the path is correct.\n";
							}
						}
					} //For

				} // Else

			} // $_POST AND !$password_form


			$name = mysqli_real_escape_string($link, $_POST['name']);
			$nameq = $name;
			$artist = $_POST['artist'];
			$url = $_POST['url'];
			$urliphone = $_POST['urliphone'];
			$cat = $_POST['cat'];
			$des = mysqli_real_escape_string($link, $_POST['des']);
			$dess = '"' . $des . '"';
			if ($_POST['des'] == "") {
				$dess = "";
			}
			if (empty($name) || empty($artist) || empty($url) || empty($cat)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				$query = "SELECT MAX(id) FROM songs";
				$result = mysqli_query($link, $query) or die();
				$row = mysqli_fetch_array($result);
				$idsaq = $row['MAX(id)'] + 1;

				mysqli_query($link, "INSERT INTO `songs` (`id`, `name`, `artist`, `downloads`, `oldownloads`, `downweek`, `hot`, `url`, `catid`, `yesorno`, `text`, `urliphone`) VALUES ('$idsaq', '{$name}', '{$artist}', '0', '0', '0', '1', '{$url}', '$cat', '0', '$dess', '$urliphone')");
				// if (mysqli_insert_id()) {
				$reg = "OK";
				$error = "הוספת הצלצול בוצעה בהצלחה";
				$log = "<u>יצירת צלצול:</u> $name - $artist";
				$name = $_SESSION["ad_user"];

				mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$name', UNIX_TIMESTAMP(), '1')");

				mysqli_query($link, "UPDATE `songs` SET `text` = '$dess' WHERE `id` = '$idsaq' ");
				mysqli_query($link, "UPDATE `songs` SET `name` = '{$nameq}' WHERE `id` = $idsaq ");
				$users = $_SESSION["ad_user"];
				mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
				// } else {
				// 	$error = "אירעה שגיאה במהלך הרישום, אנא נסה שנית";
				// }
			}
		}
		if ($reg == "OK") {
			$name = mysqli_real_escape_string($link, $_POST['name']);
			$artist = $_POST['artist'];
			echo <<<END

	<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='4' style='font-size:14px;background-color:#FFFFFF;'><img src='images/add.gif' style='vertical-align:middle'> <b>בחרת להוסיף צלצול לאתר</b> >> הצלצול <b>{$nameq} - {$artist}</b> נוסף בהצלחה!</td>
	</tr>
	</table>
END;
			echo "<div align=\"center\">";
			echo "</div>";
			// redirect_user("songs.php", "הוספת השיר בוצעה בהצלחה!");
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
			add_form();
		}
		echo "</div>";
	}

	function sng_edit()
	{
		include "../../conf.php";
		$id = $_GET['id'];
		$res = mysqli_query($link, "SELECT * FROM songs WHERE `id` = '$id'");
		$r = mysqli_fetch_array($res);
		echo <<<END
	<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>רשימת צלצולים > עריכת צלצול</b></td>
	</tr>
	</table>
	<br>


		<table dir="rtl" width="100%" style='background-color:#FFFFFF;color:#062b4d;border:1px dashed #d1d1d1' cellspacing="0" cellpadding="0">
		<tr>
			<td class="tile"><img src="http://www.ringme.co.il/admin/pages/images/icons8-edit.gif" width="30" height="30"> עריכת צלצול - <b>{$r['name']} ({$r['artist']})</b></td>
		</tr>
		</table>
		<div dir="rtl">
END;
		function edit_form()
		{
			include "../../conf.php";
			$id = $_GET['id'];
			$res = mysqli_query($link, "SELECT * FROM songs WHERE `id` = '$id'");
			$r = mysqli_fetch_array($res);


			if ($r['hot'] == 1) {
				$opthot = '<option value="1" selected>לא חם</option>
					<option value="2">חם</option>>';
			} else if ($r['hot'] == 2) {
				$opthot = '<option value="1">לא חם</option>
					<option value="2" selected>חם</option>';
			}

			if ($r['catid'] == 1) {
				$opt = '<option value="1" selected>מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6">טראנס</option>';
			} else if ($r['catid'] == 2) {
				$opt = '<option value="1">מזרחית</option>
					<option value="2" selected>מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6">טראנס</option>';
			} else if ($r['catid'] == 3) {
				$opt = '<option value="1">מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3" selected>דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6">טראנס</option>';
			} else if ($r['catid'] == 4) {
				$opt = '<option value="1">מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4" selected>לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6">טראנס</option>';
			} else if ($r['catid'] == 5) {
				$opt = '<option value="1">מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5" selected>הבקשות שלכם</option>
					<option value="6">טראנס</option>';
			} else if ($r['catid'] == 6) {
				$opt = '<option value="1">מזרחית</option>
					<option value="2">מזרחית רימקס</option>
					<option value="3">דיכאון</option>
					<option value="4">לועזי</option>
					<option value="5">הבקשות שלכם</option>
					<option value="6" selected>טראנס</option>';
			}


			echo <<<END
		<form method="post" action="?act=songs&do=edit&id={$id}">
		<input type='hidden' name='edit' value='{$id}'>
		<table>


			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>מס צלצול: </b></font>
				</td>
				<td align="right">
					<input type="text" name="values" size="50" disabled value="#{$id}">
				</td>
			</tr>


			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>שם צלצול: </b></font>
				</td>
				<td align="right">
					<input type="text" name="name" size="50" value="{$r['name']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>אומן: </b></font>
				</td>
				<td align="right">	
					<input type="text" name="artist" size="50" value="{$r['artist']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קובץ: </b></font>
				</td>
				<td align="right">
					<input type="text" name="url" size="50" dir="ltr" value="{$r['url']}">
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קובץ אייפון: </b></font>
				</td>
				<td align="right">
					<input type="text" name="urliphone" size="50" dir="ltr" value="{$r['urliphone']}">
				</td>
			</tr>
END;

			session_start();
			$admin = $_SESSION['ad_user'];
			$tesq = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
			$rq = mysqli_fetch_array($tesq);

			if ($rq["group"] == "1") {
				echo <<<END
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>הורדות: </b></font>
				</td>
				<td align="right">
					<input type="text" name="downloads" size="50" dir="ltr" value="{$r['downloads']}">
				</td>
			</tr>

			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>הורדות שבועיות: </b></font>
				</td>
				<td align="right">
					<input type="text" name="downweek" size="50" dir="ltr" value="{$r['downweek']}">
				</td>
			</tr>
END;
			}
			echo <<<END
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>קטגוריה: </b></font>
				</td>
				<td align="right">
					<select name="cat">
					{$opt}
				</td>
			</tr>		
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>צלצול חם: </b></font>
				</td>
				<td align="right">
					<select name="hot">
					{$opthot}
				</td>
			</tr>
			<tr>
				<td align="right">
					<font size="3" face="arial" color="000000"><b>פיזמון: </b></font>
				</td>
				<td align="right">
					<textarea  name="des" rows="15" cols="80" style="width: 100%">{$r['text']}</textarea>
<script type='text/javascript'>
//<![CDATA[
CKEDITOR.replace( 'editor_kama',
{
skin : 'kama',
language : 'he'
});
//]]></script>
				</td>
			</tr>


			<tr>
				<td align="center" colspan="2"><input type="submit" class="click" name="submit" value="ערוך"></td>
			</tr>
		</table>
		</form> 
END;
		}

		if (isset($_POST['submit']) && $_POST['submit'] == "ערוך") {
			$id = $_POST['edit'];
			$res = mysqli_query($link, "SELECT * FROM songs WHERE id='$id' ");
			$r = mysqli_fetch_array($res);
			// vars
			$id = $r['id'];
			$name = mysqli_real_escape_string($link, $_POST['name']);
			$name4 = $name;
			$artist = $_POST['artist'];
			$url = $_POST['url'];
			$urliphone = $_POST['urliphone'];
			$downloads = $_POST['downloads'];
			$downweek = $_POST['downweek'];
			$des = mysqli_real_escape_string($link, $_POST['des']);
			$hot = $_POST['hot'];
			$cat = $_POST['cat'];
			// start update

			if (empty($name) || empty($artist) || empty($url) || empty($cat)) {
				$error = "אנה מלא את כל שדות הטופס";
			} else {
				mysqli_query($link, "UPDATE `songs` SET `catid` = '$cat' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `hot` = '$hot' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `artist` = '{$artist}' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `url` = '$url' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `urliphone` = '$urliphone' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `downloads` = '$downloads' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `downweek` = '$downweek' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `text` = '{$des}' WHERE `id` = $id ");
				mysqli_query($link, "UPDATE `songs` SET `name` = '{$name4}' WHERE `id` = $id ");

				$error = "<font color='green' size='5'><b>עריכת הצלצול בוצעה בהצלחה</b></font>";
				// redirect_user("songs.php", "עריכת הצלצול בוצעה בהצלחה!");
				$edit = "OK";
				$log = "<u>עריכת צלצול:</u> $name - $artist";
				$user = $_SESSION["ad_user"];
				mysqli_query($link, "INSERT INTO `adminslog` ( `text`, `user` ,`ip` , `date`, `img` ) VALUES ('{$log}', '{$user}', '{$_SERVER['REMOTE_ADDR']}', UNIX_TIMESTAMP(), '2')");


				$users = $_SESSION["ad_user"];
				mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");
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

	function sng_delete()
	{
		include "../../conf.php";
		$id = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';;
		$error = (empty($id)) ? "אנא בחר צלצול" : "";
		if (empty($error)) {
			$ues = mysqli_query($link, "SELECT * FROM songs WHERE `id` = '$id'");
			$u = mysqli_fetch_array($ues);
			$named = $u['name'];
			$art = $u['artist'];
			$namedd = $named . " - " . $art;

			$file_pointer = "../../" . $u['url'];
			$file_pointeriphone = "../../" . $u['urliphone'];
			if (!unlink($file_pointer)) {
				echo ("$file_pointer cannot be deleted due to an error");
			} else {
				echo ("$file_pointer has been deleted");
			}
			if (!unlink($file_pointeriphone)) {
				echo ("$file_pointeriphone cannot be deleted due to an error");
			} else {
				echo ("$file_pointeriphone has been deleted");
			}

			echo <<<END
<table cellpadding='4' cellspacing='0' width='100%' style='border:1px solid #5f8806;background-color:#d0e5a3;color:#5f8806'>
	<tr>
	<td align='right' style='font-size:16px;'><font color='black'>ניהול צלצולים:</font> <b>מחיקת צלצול קיים במערכת</b></td>
	</tr>
	</table>
	<br>
	<table cellpadding='2' cellspacing='1' width='100%' style='background-color:#d1d1d1;color:#062b4d'>
	<tr>
	<td align='right' colspan='4' style='font-size:14px;background-color:#FFFFFF;'><img src='images/delete.png' style='vertical-align:middle'> <b>בחרת למחוק צלצול במערכת</b> >> הצלצול <b>{$namedd}</b> נמחק בהצלחה!</td>
	</tr>
	</table>
END;


			$log = "<u>מחיקת צלצול:</u> $named - $art";
			$user = $_SESSION["ad_user"];
			mysqli_query($link, "INSERT INTO `adminslog` ( `ip`, `text` ,`user` , `date`, `img` ) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$log', '$user', UNIX_TIMESTAMP(), '3')");

			$users = $_SESSION["ad_user"];
			mysqli_query($link, "UPDATE `members` SET `ip` = '{$_SERVER['REMOTE_ADDR']}' WHERE `user` = '$users' ");

			mysqli_query($link, "DELETE FROM `songs` WHERE `id` = '$id' ");
			// redirect_user("songs.php", "מחיקת הצלצול בוצעה בהצלחה!");
		} else {
			echo "<div align=\"center\">";
			echo $error;
			echo "</div>";
		}
		echo "</div>";
	}


	function sng_upload()
	{
	}
	?>
</body>
</HEAD>