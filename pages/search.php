<?
defined('_MATAN');


	$resa = mysqli_query($link,"SELECT `text` FROM `blocks` WHERE id = '2' ");
	$ra = mysqli_fetch_array($resa);
	$pirsomots = $ra['text'];

	$res = mysqli_query($link,"SELECT `text` FROM `blocks` WHERE id = '6' ");
	$r = mysqli_fetch_array($res);
	$b = $r['text'];

	$ress = mysqli_query($link,"SELECT * FROM `settings` WHERE id = '1' ");
	$rs = mysqli_fetch_array($ress);
	$sendup = $rs['sendup'];
	if($sendup == "0") {
	$popup = " onclick=\"return window.open('http://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
	} else if($sendup == "1") {
	$popup = "";
	}

	$ressa = mysqli_query($link,"SELECT * FROM `settings` WHERE id = '1' ");
	$rsa = mysqli_fetch_array($ressa);
	$sendupa = $rsa['sendupa'];
	if($sendupa == "0") {
	$popupa = " onclick=\"return window.open('http://www.ringme.co.il/adsa.php', 'myWindow', 'status = 1, height = 170, width = 730, resizable = 0')\"";
	} else if($sendupa == "1") {
	$popupa = "";
	}

$q = $_GET['q'];
?>

    <?php include MAIN_DIR . 'pages/blocks/navigation.php'; ?>

  <main>



<div id="header">
	<div class="main">
		<div id="headerinside">
			<div id="requestringtone">
				<div class="title">בקש צלצול אונליין</div>
<?php include ("blocks/send.php"); ?>
			</div>
			<div id="logo">
				<div id="logocenter">
				<a href="#"><img src="images/logo.png" alt="צלצולים להורדה"/></a>
<div class="player">
<iframe src="" height="30" width="300" SCROLLING="no" frameborder="0" name="songs"></iframe>
</div>
				</div>
			</div>
			<div id="searchringtone">
				<div class="title">חפש צלצול אונליין</div>
<?php include ("blocks/search.php"); ?>
			</div>
		</div>
		<div id="updates">
			<div id="updatestext"><marquee behavior="scroll" direction="right"><?php include ("blocks/idkonim.php"); ?></marquee></div>
		</div>
	</div>
</div>
</div>

<div class="main">
<div id="ads">
<?phpecho $b; ?>
</div>
	<div id="sidebar">
		<div class="widget">
			<div class="title">קטגוריות</div>
			<div class="text">
<?php include ("blocks/category.php"); ?>
			</div>
		</div>

		<div class="widget">
			<div class="title">פרסומת</div>
			<div class="text">
<?phpecho $pirsomots; ?>
			</div>
		</div>
	</div>
	<div id="site">
	<div id="cat">
<?
if(isset($_POST['submit'])) {


	$artist = $_POST['artist'];
	$song = $_POST['song'];

$url = strtolower($artist);
if(str_replace(array("kill","setcookie","javascript","insert","select","union","update","drop","alert","hack","banzona","h1","alret","red","green","<h1>"),'',strip_tags($url)) != $url){
	$artist = "";
	$song = "";
	$eror = "<font color='red'>לא ניתן להשתמש בערך החיפוש הזה</font>";


		$erors ="<div class=\"ringtonesc\">
		<div class=\"namec\">
		<b>{$eror}</b>
		</div>
		</div>";
       }

$urls = strtolower($song);
if(str_replace(array("kill","setcookie","javascript","insert","select","union","update","drop","alert","hack","banzona","h1","alret","red","green","<h1>"),'',strip_tags($urls)) != $urls){
	$artist = "";
	$song = "";
	$eror = "<font color='red'>לא ניתן להשתמש בערך החיפוש הזה</font>";

		$erors ="<div class=\"ringtonesc\">
		<div class=\"namec\">
		<b>{$eror}</b>
		</div>
		</div>";

       }


if ($artist == "שם הזמר") {
$uri = " - <b><u>".$song."</u></b>";
} else if ($song == "שם השיר") {
$uri = "- <b><u>".$artist."</u></b>";
} else if($eror == ""){

$uri = "- <b><u>".$artist."</u></b> - <b><u>".$song."</u></b>";
}


}
?>
			<div class="titlec">תוצאות חיפוש <?phpecho $uri; ?></div>
			<div class="lestringtonesc">
<?php
if(isset($_POST['submit'])) {
	$artist = $_POST['artist'];
	$song = $_POST['song'];

		if($artist == "")
			$artist = "שם הזמר";
		if($song == "")
			$song = "שם השיר";

	if (($artist == "שם הזמר" && $song == "שם השיר")) {
header('Location: http://www.ringme.co.il/search.html');
	echo "<div class=\"ringtonesc\">";
	echo "<div class=\"namec\">";
	echo "<b>מילת החיפוש קצרה מידי או שהיא ריקה</b>";
	echo "</div>";
	echo "</div>";
	} else {
		if($artist == "שם הזמר")
			$artist = "";
		if($song == "שם השיר")
			$song = "";


		$limit = "15";
		$cpage = intval($_GET['page']);
		if (!$_GET['page'] || $_GET['page'] < 1) 
			$cpage = 1;
		$t = mysqli_num_rows(mysqli_query($link,"SELECT `id` FROM `songs` WHERE `name` LIKE '%$song%' AND `artist` LIKE '%$artist%'"));  
		if ($t == 0)
		{
		echo "<div class=\"ringtonesc\">";
		echo "<div class=\"namec\">";
		echo "<b>אנא נסה מילות חיפוש אחרות</b>";
		echo "</div>";
		echo "</div>";
		echo $erors;
		}
		$p = $t/$limit;
		$pages = ceil($p);
		$npage = $cpage+1;
		$ppage = $cpage-1;
		$i = ($cpage * $limit) - $limit;
		$res = mysqli_query($link,"SELECT * FROM `songs` WHERE `name` LIKE '%$song%' AND `artist` LIKE '%$artist%' ORDER BY `id` DESC LIMIT $i,$limit ");
		while ($r = mysqli_fetch_array($res))
		{
$artist = $r[artist];
if (isset($_SESSION["ad_login"])) {
$down = " - <u>".$r[downloads]."</u> הורדות";
} else {
$down = "";
}


if($r['urliphone'] == "") {
$ec = "<a onclick=\"return window.open('send-{$r[id]}.html', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\">שלח לחבר</a>";
} else {
$ec = "<a href=\"{$r[urliphone]}\"{$popup}>הורד לאייפון</a>";
}


echo<<<END
			<div class="ringtonesc">
			<div class="namec"><a href="/song-{$r[id]}.html"{$popupa}>{$artist} - {$r[name]}</a></div>
&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.ringme.co.il/song-{$r[id]}.html&amp;layout=button_count&amp;show_faces=true&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=21" style="border: medium none; overflow: hidden; width: 100px; height: 21px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>
			<div class="linksc">
			<img border="0" src="images/l.png" alt="האזן" /><a target="songs" href="/play-{$r[id]}.html"{$popupa}>האזן</a>
			<img border="0" src="images/s.png" alt="הורד" /><a href="?act=download&songid={$r[id]}"{$popup}>הורד</a>
			<img border="0" src="images/send.png" alt="שלח" />{$ec}
			</div>
			</div>
END;
		}
	}
} else {
header('Location: http://www.ringme.co.il/search.html');
}
?>
			</div>
		</div>
	</div>
<br /><br />
	</div>
</div>