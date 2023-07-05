<?php
include("conf.php");

class meta
{

	function getPageTitle($act)
	{
		include("conf.php");
		$site = "רינג מי";
		$slogan = "צלצולים: צלצולים להורדה, צלצולים לאייפון בחינם";
		$rh = " - ";
		$title = "";

		switch ($act) {
			case 'search':
				$slogan = "צלצולים להורדה";
				$title = " - חיפוש";
				$rh = " - ";
				break;
			case 'send':
				$slogan = "צלצולים להורדה";
				$title = " - שליחת בקשה";
				$rh = " - ";
				break;
			case 'cat':
				$catid = intval($_GET['catid']);
				$tes = mysqli_query($link, "SELECT `name` FROM `category` WHERE `id`='$catid'");
				$t = mysqli_fetch_array($tes);
				$slogan = "צלצולים להורדה";
				$title = " - קטגוריית צלצולים" . " " . $t['name'];
				$rh = " - ";
				break;
			case 'youtube':
				$slogan = "";
				$rh = " - ";
				$title = "הורדת שירים מיוטיוב בחינם";
				break;
			case 'bigbrother':
				$slogan = "";
				$rh = " - ";
				$title = "האח הגדול שידור חי";
				break;

			case 'tops':
				$slogan = "";
				$rh = " - ";
				$title = "30 הצלצולים הכי מבוקשים באתר";
				break;
			case 'iphone':
				$slogan = "";
				$rh = " - ";
				$title = "צלצולים להורדה לאייפון";
				break;
			case 'report':
				$slogan = "";
				$rh = " - ";
				$title = "דווח על בעיה";
				break;
			case 'ask':
				$slogan = "";
				$rh = " - ";
				$title = "חיפוש/בקשת צלצול להורדה";
				break;
			case 'searchs':
				$slogan = "";
				$rh = " - ";
				$title = "חיפוש צלצול להורדה";
				break;
			case 'howto':
				$slogan = "";
				$rh = " - ";
				$title = "איך להוריד צלצולים בחינם";
				break;
			case 'singer':
				$singid = intval($_GET['id']);
				$tes = mysqli_query($link, "SELECT `name` FROM `singers` WHERE `id`='$singid'");
				$t = mysqli_fetch_array($tes);
				$site = "רינג מי - " . $t['name'] . " צלצולים, צלצולים להורדה, צלצולים לאייפון";
				$rh = "";
				$slogan = "";
				break;
			case 'ref':
				$refid = intval($_GET['id']);
				$tes = mysqli_query($link, "SELECT `name` FROM `sites` WHERE `id`='$refid'");
				$t = mysqli_fetch_array($tes);
				$site = "רינג מי - הפניית אתר";
				$rh = " - ";
				$slogan = $t['name'];
				break;
			default:

				break;
		}



		return $site . $rh . $slogan . $title;
	}

	function getPageDesc($act)
	{
		include("conf.php");
		$descadd = "";
		switch ($act) {
			case 'search':
				$descadd = "חיפוש";
				break;
			case 'send':
				$descadd = "שליחת בקשה";
				break;
			case 'cat':
				$catid = intval($_GET['catid']);
				$tes = mysqli_query($link, "SELECT `name` FROM `category` WHERE `id`='$catid'");
				$t = mysqli_fetch_array($tes);
				$descadd = "קטגוריית צלצולים" . " " . $t['name'];
				break;
			default:
				$title = "דף הבית";
				break;
		}
		return $descadd;
	}

	function getAdminPageTitle($act)
	{
		$site = "RingMe";

		switch ($act) {
			case 'members':
				$adtitle = "עריכת משתמשים";
				break;
			case 'group':
				$adtitle = "עריכת דרגות משתמשים";
				break;
			case 'orders':
				$adtitle = "ניהול בקשות שירים";
				break;
			case 'songs':
				$adtitle = "עריכת שירים";
				break;
			default:
				$adtitle = "דף הבית";
				break;
		}
		return $site . " - " . "פאנל ניהול" . " - " . $adtitle;
	}

	function getLoginPageTitle($act)
	{
		$site = "RingMe";

		switch ($act) {
			case 'logout':
				$adtitle = "התנתקות";
				break;
			default:
				$adtitle = "התחברות";
				break;
		}
		return $site . " - " . "פאנל ניהול" . " - " . $adtitle;
	}
}
