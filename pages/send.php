<?
defined('_MATAN');

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
	$popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
	$popup = "";
}
?>

<?php include MAIN_DIR . 'pages/blocks/navigation.php'; ?>

<main>

	<div class="categoryName">
		<h1>בקשות צלצולים</h1>
	</div>

	<?php
	if (isset($_POST['submit'])) {
		if ($_POST['artist'] == "שם הזמר" || $_POST['song'] == "שם השיר") {

			// header('Location: https://www.ringme.co.il/send.html');

			echo "אנא בקש צלצול הגיוני, תודה!";


			echo "
</div>
</div>
			</div>
		</div>
	</div>";
		} else if ($_POST['artist'] == "" || $_POST['song'] == "") {
			echo '		<div class="ringtonesc">
		<div class="namec">';
			echo "<b>אנא מלא את שדות החובה</b>";
		} else {
			$artist = $_POST['artist'];
			$song = $_POST['song'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$date = time();

			$url = strtolower($artist);
			if (str_replace(array("kill", "setcookie", "javascript", "insert", "select", "union", "update", "drop", "alert", "hack", "banzona", "h1", "alret", "red", "green", "<h1>"), '', strip_tags($url)) != $url) {
				$artist = "";
				$song = "";
				$eror = "<font color='red'>לא ניתן להשתמש בערך החיפוש הזה</font>";

				echo '		<div class="ringtonesc">
		<div class="namec">';
				echo "<b>{$eror}</b>";
				die();
			}

			$urls = strtolower($song);
			if (str_replace(array("kill", "setcookie", "javascript", "insert", "select", "union", "update", "drop", "alert", "hack", "banzona", "h1", "alret", "red", "green", "<h1>"), '', strip_tags($urls)) != $urls) {
				$artist = "";
				$song = "";
				$eror = "<font color='red'>לא ניתן להשתמש בערך החיפוש הזה</font>";

				echo '		<div class="ringtonesc">
		<div class="namec">';
				echo "<b>{$eror}</b>";
				die();
			}


			$limit = "13";
			$cpage = intval($_GET['page']);
			if (!$_GET['page'] || $_GET['page'] < 1)
				$cpage = 1;
			$t = mysqli_num_rows(mysqli_query($link, "SELECT `id` FROM `songs` WHERE `name` LIKE '%$song%' AND `artist` LIKE '%$artist%'"));
			if ($t == 0) {

				$res = mysqli_query($link, "SELECT `date` FROM `orders` WHERE `ip`='$ip' ORDER BY id DESC");
				if (mysqli_num_rows($res) > 0)
					$r = mysqli_fetch_array($res);
				else
					$r['date'] = 0;
				if (time() > ($r['date'] + (60 * 60 * 24))) {
					mysqli_query($link, "INSERT INTO `orders` (`song`, `artist`, `ip`, `date`) VALUES ('$song', '$artist', '$ip', '$date')");
					echo '		<div class="ringtonesc">
		<div class="namec">';
					echo "<font color='green'><b>בקשתך נשלחה בהצלחה</b></font>, ב24 שעות הקרובות צוות האתר יוסיף את הצלצול בקטגוריה הבקשות שלכם!";
					die();
				} else {
					echo '		<div class="ringtonesc">
		<div class="namec">';
					echo "<b>לא ניתן לבקש פעמיים ביום, תודה.</b>";
					die();
				}
			}
			$p = $t / $limit;
			$pages = ceil($p);
			$npage = $cpage + 1;
			$ppage = $cpage - 1;
			$i = ($cpage * $limit) - $limit;

			echo '		<div class="ringtonesc">
		<div class="namec">
		<font color="green"><b>לא צריך לבקש את הצלצול, הוא כבר נמצא באתר!</b></font>
		</div>
		</div>';


			$res = mysqli_query($link, "SELECT * FROM `songs` WHERE `name` LIKE '%$song%' AND `artist` LIKE '%$artist%' ORDER BY `id` DESC LIMIT $i,$limit ");
			while ($r = mysqli_fetch_array($res)) {
				$artist = $r['artist'];

				if ($r['urliphone'] == "") {
					$ec = "<a onclick=\"return window.open('send-{$r['id']}.html', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\">שלח לחבר</a>";
				} else {
					$ec = "<a href=\"{$r['urliphone']}\"{$popup}>הורד לאייפון</a>";
				}

				echo <<<END
		<div class="ringtonesc">
		<div class="namec">
<a href="/song-{$r['id']}.html"{$popup}>{$artist} - {$r['name']}</a></div>
			<div class="linksc">
			<img border="0" src="images/l.png" alt="האזן" /><a target="songs" href="/play-{$r['id']}.html"{$popup}>האזן</a>
			<img border="0" src="images/s.png" alt="הורד" /><a href="?act=download&songid={$r['id']}"{$popup}>הורד</a>
			<img border="0" src="images/send.png" alt="שלח" />{$ec}
		</div>
		</div>
END;
			}
		}
	} else {
		header('Location: https://www.ringme.co.il/send.html');
	}
	?>
	</div>
	</div>
	</div>
	</div>
	</div>