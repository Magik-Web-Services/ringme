-- MySQL dump 10.13  Distrib 5.7.39, for Linux (x86_64)
--
-- Host: localhost    Database: ringme_test
-- ------------------------------------------------------
-- Server version	5.7.39-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adminmsg`
--

DROP TABLE IF EXISTS `adminmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminmsg` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminmsg`
--

LOCK TABLES `adminmsg` WRITE;
/*!40000 ALTER TABLE `adminmsg` DISABLE KEYS */;
INSERT INTO `adminmsg` (`id`, `text`) VALUES (1,'<p style=\"text-align: center;\">\r\n	<span style=\"color: #ffcc33;\"><strong><span style=\"font-family: arial,helvetica,sans-serif; font-size: medium;\"><span data-scayt_word=\"ברוכים\" data-scaytid=\"1\">ברוכים</span> <span data-scayt_word=\"הבאים\" data-scaytid=\"2\">הבאים</span></span></strong></span></p>\r\n<p style=\"text-align: right;\">\r\n	<font face=\"arial, helvetica, sans-serif\" size=\"2\">שלום לכם מנהלים יקרים,</font><img alt=\"\" src=\"https://www.ringme.co.il/images/flowers.png\" style=\"width: 28px; height: 18px;\" /><br />\r\n	<font face=\"arial, helvetica, sans-serif\" size=\"2\"> זהו פאנל הניהול של כולנו, בו נוכל לערוך את האתר ולסדר אותו.</font></p>\r\n<p style=\"text-align: right;\">\r\n	מנהלים יקרים שימו &hearts; בבקשה-</p>\r\n<p style=\"text-align: right;\">\r\n	1. כשמעלים שיר חדש צריך להוסיף &quot;&quot; בפזמון לדוגמא- &quot;זה היה ביתי&quot; (ככה אמור להיות הפזמון)</p>\r\n<p style=\"text-align: right;\">\r\n	2. המערכת עוברת שידרוגים, בקרוב הפתעות חדשות!</p>\r\n<p style=\"text-align: right;\">\r\n	<span style=\"color: rgb(255, 0, 0);\"><span style=\"font-size:14px;\"><strong><u><span data-scayt_word=\"הודעה\" data-scaytid=\"7\">הודעה</span> <span data-scayt_word=\"חשובה\" data-scaytid=\"8\">חשובה</span></u>: <span data-scayt_word=\"במידה\" data-scaytid=\"9\">במידה</span> ויש&nbsp;</strong></span></span><strong style=\"font-size: 14px; color: rgb(255, 0, 0);\"><span data-scayt_word=\"בקשות\" data-scaytid=\"10\">בקשות</span>, <span data-scayt_word=\"זה\" data-scaytid=\"11\">זה</span> <span data-scayt_word=\"הדבר\" data-scaytid=\"12\">הדבר</span> <span data-scayt_word=\"הראשון\" data-scaytid=\"13\">הראשון</span> <span data-scayt_word=\"שעושים\" data-scaytid=\"14\">שעושים</span>!</strong></p>\r\n');
/*!40000 ALTER TABLE `adminmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminslog`
--

DROP TABLE IF EXISTS `adminslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminslog` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 NOT NULL,
  `user` varchar(30) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL,
  `date` text CHARACTER SET utf8 NOT NULL,
  `img` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminslog`
--

LOCK TABLES `adminslog` WRITE;
/*!40000 ALTER TABLE `adminslog` DISABLE KEYS */;
INSERT INTO `adminslog` (`id`, `text`, `user`, `ip`, `date`, `img`) VALUES (1,'איפס את כל הפעולות האחרונות','admin','147.235.198.157','1688057575','4'),(2,'<u>מחיקת צלצול:</u> 77 - 77','admin','147.235.198.157','1688059853','3'),(3,'<u>מחיקת צלצול:</u> fd - dff','admin','147.235.198.157','1688059858','3'),(4,'מחק את הבקשה: <u>סיגליות</u>','admin','147.235.198.157','1688061529','3'),(5,'<u>עריכת צלצול:</u> DXB to TLV - עומר אדם','admin','147.235.198.157','1688080179','2'),(6,'<u>עריכת צלצול:</u> רונדלים - סטטיק','admin','147.235.198.157','1688080196','2'),(7,'<u>עריכת צלצול:</u> ואת אינך - אייל גולן','admin','147.235.198.157','1688080204','2'),(8,'<u>עריכת צלצול:</u> האמת (גרסא 2) - אודיה','admin','147.235.198.157','1688080210','2'),(9,'<u>עריכת צלצול:</u> נחמות מתוקות - אייל גולן','admin','147.235.198.157','1688080228','2'),(10,'מחק את הבקשה: <u>סיגליות</u>','admin','147.235.202.194','1688232106','3'),(11,'מחק את הבקשה: <u>סיגליות</u>','admin','147.235.202.194','1688232157','3');
/*!40000 ALTER TABLE `adminslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banneds`
--

DROP TABLE IF EXISTS `banneds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banneds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET hebrew NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banneds`
--

LOCK TABLES `banneds` WRITE;
/*!40000 ALTER TABLE `banneds` DISABLE KEYS */;
/*!40000 ALTER TABLE `banneds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` (`id`, `text`) VALUES (1,'<p>ברוכים הבאים לרינג מי,<br />\r\nבאתר תוכלו למצוא&nbsp;<strong>צלצולים להורדה</strong>&nbsp;בחינם ללא צורך בתשלום כלשהו,<br />\r\n<strong>צלצולים להורדה</strong>&nbsp;בחינם באמצעות אתר רינג מי יאפשרו לכם להנות ממגוון רחב של סינגלים אהובים!<br />\r\nתוכלו להוריד צלצולים למחשב האישי שלכם ולהעביר בקלות למכשיר הסלולרי שלכם,<br />\r\nבמידה וחיפשתם צלצולים להורדה הגעתם למקום הנכון.<br />\r\nאתם מוזמנים לגלוש באתר ולהנות ממגוון&nbsp;<strong>צלצולים להורדה</strong>&nbsp;חופשית בחינם!<br />\r\n&nbsp;</p>\r\n\r\n<p>באתר תמצאו ז&#39;אנרים מחולקים, צלצולים מובילים וחדשים והורדה לכל סוגי הסמארטפונים!&nbsp;<img alt=\"\" src=\"https://www.ringme.co.il/images/flowers.png\" style=\"height:18px; width:28px\" /></p>\r\n'),(2,'\r\n<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:inline-block;width:180px;height:150px\"\r\n     data-ad-client=\"ca-pub-8382417683683617\"\r\n     data-ad-slot=\"8358142886\"></ins>\r\n<script>\r\n     (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n																																																																																																																																																																'),(3,'<font color=\"#800080\">ברוכים הבאים לאתר רינג מי המאפשר צלצולים להורדה בחינם, כל הרינגטונים החדשים לשנת 2020 כבר כאן להורדה בחינם.</font>'),(4,'<center>\r\n<h2>צלצולים להורדה</h2>\r\n<div id =\"animated_div\">Ringme.co.il</div>\r\n</center>										'),(5,'<ul>\r\n	<li><a href=\"?act=main\"><span>דף</span> <span>ראשי</span></a></li>\r\n	<li><a href=\"?act=cat&amp;catid=1\"><span>מזרחית</span></a></li>\r\n	<li><a href=\"?act=cat&amp;catid=2\"><span>מזרחית</span> <span>רמיקס</span></a></li>\r\n	<li><a href=\"?act=cat&amp;catid=3\"><span>דיכאון</span></a></li>\r\n	<li><a href=\"?act=cat&amp;catid=4\"><span>שונות</span></a></li>\r\n	<li><a href=\"?act=cat&amp;catid=5\"><span>הבקשות</span> <span>שלכם</span></a></li>\r\n	<li><a href=\"#\"><span style=\"color:#008000\"><span>הקבוצה</span> <span>בפייסבוק</span></span></a></li>\r\n</ul>\r\n'),(6,'\r\n<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n<!-- urikas -->\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-8382417683683617\"\r\n     data-ad-slot=\"8495377285\"\r\n     data-ad-format=\"auto\"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>																																																																																																																																																																																																																																	'),(7,''),(8,'* {border:0;outline:0;margin:0;padding:0;font-family:Arial;}\r\nbody {direction:rtl;font-size:13px;}\r\na{ text-decoration:none; }\r\nA:link { color: #000000; text-decoration: none }\r\nA:active { color: #000000; text-decoration: none }\r\nA:visited { color: #000000; text-decoration: none }\r\nA:hover { color: #9112ff; text-decoration: underline }\r\n/* #9112ff #a466de #efefef D8D8D8 E0E0E0 */\r\n\r\n\r\n@media screen and (min-width: 480px) and (max-width: 960px) {\r\n    #header {\r\n        display: none;\r\n    }\r\n}\r\n\r\n\r\n.body {\r\n	background: url(\"images/bg.png\");\r\n	direction: rtl;\r\n	background-repeat: repeat-x;\r\n	font-family: arial;\r\n	color: #000000;\r\n	text-align: right;\r\n	margin-top: 0px;\r\n	font-size: 12px;\r\n}\r\n\r\n.from {font-family:Arial;font-size:11px;color:#607e8e;background:white url(inputbg.gif) repeat-x;vertical-align:middle;border-right:1px solid #d1d1d1;border-left:1px solid #f7f7f7;border-top:1px solid #efefef;border-bottom:1px solid #b6b6b6;}\r\n\r\n\r\n.clear {clear:both;}\r\n.main {width:845px;margin:0 auto;}\r\n.main2 {width:845px;margin:50 auto;}\r\n#header {background:url(\'http://urikas.wek.co.il/images/BgA.png\')repeat-x;width:100%;height:80px;}\r\n#headerinside {float:right;margin-top:30px;}\r\n#requestringtone {float:right;width:210px;}\r\n#requestringtone .title {font-size:12px;font-weight:bold;color:#33025e;}\r\n#requestringtone .requestringtone {width:202px;height:21px;border:1px solid #d1d1d1;color:#aaaaaa;font-weight:bold;padding-right:5px;margin-top:5px;}\r\n#requestringtone .requestringtonesubmit {background:url(\'images/button.png\')no-repeat;width:84px;height:19px;font-size:12px;color:#33025e;margin-top:5px;font-weight:bold;margin-right:55px;}\r\n#logo {float:right;text-align:center;width:425px;}\r\n#searchringtone {float:right;width:210px;}\r\n#searchringtone .title {font-size:12px;font-weight:bold;color:#33025e;}\r\n#searchringtone .searchringtone {width:202px;height:21px;border:1px solid #d1d1d1;color:#aaaaaa;font-weight:bold;padding-right:5px;margin-top:5px;}\r\n#searchringtone .searchringtonesubmit {background:url(\'images/button.png\')no-repeat;width:84px;height:19px;font-size:12px;color:#33025e;margin-top:5px;font-weight:bold;margin-right:55px;}\r\n#updates {background:url(\'images/updates.png\')repeat-x;float:right;width:845px;height:24px;margin-top:7px;}\r\n#updatestext {float:left;padding-left:20px;line-height:22px;width:725px;}\r\n\r\n#linkcat {color:#9112ff;font-weight:bold;}\r\n.linkcatt {color:#9112ff;font-weight:bold;}\r\n\r\n#ads {float:right;padding-right:60px;padding-top:15px;width:725px;line-height:22px;}\r\n#pagess {float:right;}\r\n\r\n#sidebar {float:right;width:194px;margin-top:15px;}\r\n#sidebar .widget {float:right;width:181px;}\r\n#sidebar .title {background:url(\'images/sidebartitle.png\')no-repeat;width:166px;height:27px;margin-bottom:5px;font-size:14px;color:#fff;line-height:25px;padding-right:15px;}\r\n#sidebar .text {background:url(\'images/sidebar-bg.png\')no-repeat;width:181px;height:207px;}\r\n#sidebar .text ul {list-style:none;margin:0;padding:0;}\r\n#sidebar .text ul li {float:right;width:181px;font-size:14px;line-height:22px;padding-right:20px;}\r\n#site {float:right;width:651px;margin-top:15px;}\r\n#welcome {background:url(\'images/welcome.png\')no-repeat center left;width:651px;height:183px;border:1px solid #b8b8b8;}\r\n#welcome .title {background:url(\'images/title.png\')no-repeat;width:641px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px}\r\n#welcome .article {width:550px;padding:5px;}\r\n\r\n\r\n\r\n\r\n\r\n#week {background:width:845px;height:100%;border:1px solid #b8b8b8;margin-top:2px;}\r\n#week .title {background:url(\'images/weekend.png\')no-repeat;width:833px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px}\r\n#week .lestringtones {background:url(\'images/weeklest.png\')no-repeat;width:843px;height:134px;}\r\n#week .ringtones {width:833px;height:17px;padding:5px;}\r\n#week .ringtones .name {float:right;}\r\n#week .ringtones .links {float:left;}\r\n\r\n\r\n#lest {background:width:651px;height:100%;border:1px solid #b8b8b8;margin-top:15px;}\r\n#lest .title {background:url(\'images/title.png\')no-repeat;width:640px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px}\r\n#lest .lestringtones {background:url(\'images/lest.png\')no-repeat;width:649px;height:299px;}\r\n#lest .ringtones {width:639px;height:17px;padding:5px;}\r\n#lest .ringtones .name {float:right;}\r\n#lest .ringtones .like {padding:0px;}\r\n#lest .ringtones .links {float:left;}\r\n\r\n\r\n\r\n#cat {background:width:653px;height:100%;border:1px solid #b8b8b8;}\r\n#cat .titlec {background:url(\'images/title.png\')no-repeat;width:641px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px}\r\n#cat .lestringtonesc {background:url(\'images/cat.png\')no-repeat;width:653px;height:393px;}\r\n#cat .datea {float:left;padding-left:7px}\r\n#cat .ringtonesc {width:639px;height:16.2px;padding:5px;}\r\n#cat .ringtonesc .namec {float:right;}\r\n#cat .ringtonesc .like {float:center;}\r\n#cat .ringtonesc .linksc {float:left;}\r\n\r\n\r\n#art {background:width:653px;height:100%;border:1px solid #b8b8b8;}\r\n#art .titlec {background:url(\'images/title.png\')no-repeat;width:641px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px}\r\n#art .lestringtonesc {background:url(\'images/articles.png\')no-repeat;width:653px;height:393px;}\r\n#art .datea {float:left;padding-left:7px}\r\n#art .ringtonesc {width:639px;height:16.2px;padding:5px;}\r\n#art .ringtonesc .namec {float:right;}\r\n#art .ringtonesc .like {float:center;}\r\n#art .ringtonesc .linksc {float:left;}\r\n.rightss {\r\n	font-size: 14px;\r\n	float:right;\r\n}\r\n\r\n.leftss {\r\n	font-size: 14px;\r\n	float:left;\r\n}\r\n\r\n#mov {background:width:653px;height:100%;border:1px solid #b8b8b8;}\r\n#mov .titlec {background:url(\'images/title.png\')no-repeat;width:641px;height:27px;font-size:14px;color:#fff;line-height:25px;padding-right:10px;float:left}\r\n#mov .lestringtonesc {background:url(\'images/mov.png\')no-repeat;width:653px;height:360px;padding-top:6px}\r\n#mov .ringtonesc {width:595px;height:16.2px;padding:5px;}\r\n#mov .ringtonesc .namec {float:right;}\r\n#mov .ringtonesc .like {float:center;}\r\n#mov .ringtonesc .linksc {float:left;}\r\n\r\n#mov .lestringtonescd {background:url(\'images/mov.png\')no-repeat;width:653px;height:360px;padding-left:10px}\r\n#mov .ringtonescd {width:595px;height:16.2px;padding:5px;padding-top:30px}\r\n#mov .ringtonescd .namecd {float:right;}\r\n#mov .ringtonescd .liked {float:center;}\r\n#mov .ringtonescd .linkscd {float:left;}\r\n\r\n#footer {float:right;width:845px;border-top:1px solid #c8c8c8; padding-top:5px;color:#515151;}\r\n#footer a {color:#515151;}\r\n#footer .right {float:right;}\r\n#footer .left {float:left;}\r\n\r\n\r\n.artist-ringtones {\r\n	float: right;\r\n	width: 500px;\r\n	margin-right: 20px;\r\n\r\n}\r\n\r\n.artist-info {\r\n	float: right;\r\n	width: 300px;\r\n	padding: 10px;\r\n	-webkit-border-radius: 10px;\r\n	-moz-border-radius: 10px;\r\n	border-radius: 10px;\r\n	background-color: #f0f0f0;\r\n	border: 3px solid #d3d3d3;\r\n}\r\n\r\n.artist-title {\r\n	text-align: center;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 18px;\r\n	float: center;\r\n	text-shadow: 0px 2px 3px #a8a8a8;\r\n\r\n}\r\n\r\n.artist-img {\r\n	margin-top: 5px;\r\n	text-align: center;\r\n}\r\n\r\n.artist-text {\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 16px;\r\n	text-align: right;\r\n	margin-top: 10px;\r\n}\r\n\r\n.artist-ringtitle {\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	font-size: 16px;\r\n	font-weight: bold;\r\n	text-align: right;\r\n	background-color: #0064a3;\r\n	font-weight: bold;\r\n	color: #FFFFFF;\r\n	height: 32px;\r\n	padding-top: 8px;\r\n	padding-right: 8px;\r\n}\r\n\r\n.artist-back {\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	margin-top: 20px;\r\n	font-weight: bold;\r\n	color: #666666;\r\n	font-size: 14px;\r\n	float: left;\r\n	background-color: #f0f0f0;\r\n	width: 500px;\r\n	padding-top: 7px;\r\n	padding-bottom: 7px;\r\n	margin-right: 20px;\r\n	text-align: center;\r\n}\r\n\r\n.artist-back a:link {\r\n	color: #666666;\r\n}\r\n\r\n.artist-back a:active {\r\n	color: #666666;\r\n}\r\n\r\n.artist-back a:visited {\r\n	color: #666666;\r\n}\r\n\r\n.artist-back a:hover {\r\n	color: #333333;\r\n}\r\n\r\n\r\n.ring {\r\n	text-align: right;\r\n	color:#202020;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	padding-right: 5px;\r\n	height: 25px;\r\n	padding-top: 4px;\r\n	margin-top: 6px;\r\n	background-color: #f5f8ee;\r\n	padding-left: 5px;\r\n}\r\n\r\n.ringl {\r\n		float:left;\r\n}\r\n\r\n.ring2 {\r\n	text-align: right;\r\n	color:#202020;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	padding-right: 5px;\r\n	height: 25px;\r\n	padding-top: 4px;\r\n	margin-top: 6px;\r\n	background-color: #eaf1dd;\r\n	padding-left: 5px;\r\n}\r\n\r\n.ring3 {\r\n	text-align: left;\r\n	color:#202020;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	height: 25px;\r\n	padding-top: 4px;\r\n	margin-top: 6px;\r\n	background-color: #F5F8EE;\r\n	padding-left: 5px;\r\n	padding-right: 5px;\r\n	direction:ltr;\r\n}\r\n\r\n.ring4 {\r\n	text-align: left;\r\n	color:#202020;\r\n	font-family: Arial, Helvetica, sans-serif;\r\n	height: 25px;\r\n	padding-top: 4px;\r\n	margin-top: 6px;\r\n	background-color: #eaf1dd;\r\n	padding-left: 5px;\r\n	padding-right: 5px;\r\n	direction:ltr;\r\n}\r\n\r\n.page {\r\n	width: 900px;\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n}\r\n\r\n\r\n.under {\r\ntext-decoration: underline;\r\n}\r\n\r\n.g-plusone {\r\n	float: right;\r\n}\r\n');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES (1,'מזרחית'),(2,'מזרחית רמיקס'),(3,'דיכאון'),(4,'לועזי'),(5,'הבקשות שלכם'),(6,'טראנס');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `perfix` text NOT NULL,
  `serfix` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `perfix`, `serfix`) VALUES (1,'מנהל','<font color=\"#FF0000\"><b>','</b></font>'),(2,'מעלה צלצולים','&lt;font color=\\&quot;#0000FF\\&quot;&gt;','&lt;/font&gt;');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `group` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `name` varchar(32) NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `joindate` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `user`, `pass`, `group`, `ip`, `name`, `phone`, `email`, `joindate`) VALUES (1,'admin','445bb729ad78a67a6bf356546bce29cd',1,'147.235.202.194','אורי','050-9492523','styleurik@gmail.com',1308141357);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song` varchar(55) NOT NULL,
  `artist` varchar(55) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `song`, `artist`, `ip`, `date`) VALUES (2,'חישגוזים ','עדן חסון','77.137.75.22',1688063407),(13,'עטלף עיוור','אייל גולן','77.137.76.105',1688234325),(4,'עטלף עיוור','חנו בן ארי','2.55.174.114',1688098217),(5,'אדם הוא אדם ','בניה ברבי','147.235.200.220',1688115715),(6,'I ain’t worried','Onerepublic','79.182.71.155',1688127872),(14,'חברה שלי','סתיו שמש','87.71.172.210',1688235410),(8,'חיכיתי לך','ששון איפרם','46.19.85.68',1688143126),(9,'עטלף עיוור','אייל גולן','77.137.193.173',1688149171),(10,'טוהר','נהוראי אריאלי','188.64.207.109',1688195482),(11,'השם רק תודה','איציק אשל','149.106.148.22',1688220364),(12,'סיגליות','דיויד ברוזה','5.28.177.46',1688221921),(15,'כל הזמן הזה','נצי נצ','176.12.231.100',1688236494),(16,'ים של דמעות','נותי ליברמן ','212.76.114.145',1688237178);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `text` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `send` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `site_off_title` text NOT NULL,
  `site_off_desc` text NOT NULL,
  `sends` int(11) NOT NULL,
  `sendup` int(11) NOT NULL,
  `sendupa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`send`, `id`, `site_off_title`, `site_off_desc`, `sends`, `sendup`, `sendupa`) VALUES (0,1,'האתר בשדרוגים..','<p>היי גולשים יקרים האתר בשדרוגים נחזור כמה שיותר מהר :)</p>\r\n',0,0,0);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `singers`
--

DROP TABLE IF EXISTS `singers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `singers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `keywords` text NOT NULL,
  `coment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `singers`
--

LOCK TABLES `singers` WRITE;
/*!40000 ALTER TABLE `singers` DISABLE KEYS */;
INSERT INTO `singers` (`id`, `name`, `image`, `keywords`, `coment`) VALUES (1,'אייל גולן','1370342554275.jpg','אייל גולן','הזמר הישראלי אייל גולן הספיק להוציא כבר עשרות אלבומים ועומד מאחורי המון הצלחות מוזיקליות גדולות בכל רחבי הארץ, נכון לשנת 2013 האלבום האחרון אותו אייל גולן הוציא נקרא \"הלב על השולחן\" שזכה להיכרות בכל תחנות הרדיו ולהשמעות חוזרות ומיליוני צפיות ביוטיוב שזה עזר לאייל גולן לכבוש גם את רחבי האינטרנט בטופ המוזיקה בכל המקומות הראשונים באתר יוטיוב.<br /><br />\r\nבמרץ 2017 גולן הוציא את האלבום \"לא פשוט להיות פשוט\", לראשונה בקריירה מוציא גולן אלבום כפול, אשר גם מציין 20 שנות פעילות. האלבום התחלק לשני דיסקים - הראשון שירים שקטים, השני דיסק עם שירים קצביים יותר.<br /><br />\r\nבשנת 2020 הוציא את הסינגלים \"עומד כאן לבדי\", \"רכבת הרים\", \"לעשות איתך שלום\" ו-\"מכאן ועד הנצח\" שהקדיש לבת זוגתו דניאל.\r\nוכמובן כל הצלצולים מוכנים להורדה הישר אליכם בחינם! &#9829;'),(2,'Skazi','1370445046766.jpg','Skazi','סקאזי (Skazi) הוא אחד היוצרי טראנס פסיכודלי הגדולים והמוכרים בעולם! שמו האמיתי של סקאזי הוא אשר סוויסה ושותפו אסף בי-באס אשר התחילו את דרכם בכלל במוזיקת הפאנק וביחד עם השנים סקאזי התחיל ליצור את הסגנון המוזיקלי משלו: טראנס פסיכודלי.<br />\r\nבשנת 2012 יצא אלבומו ØMy Way\" שעזר לסקאזי לחזור לעניינים לאחר שלא שיחרר אלבום כבר 6 שנים ואנשים בארץ התחילו לשכוח ממנו. סקאזי עושה את רוב הופעותיו בדרום אמריקה מול עשרות אלפי מעריצי מוזיקת טראנס פסיכודלי שאוהבים להתפרע במסיבות.<br />\r\nאת סקאזי מכירים בארץ בעיקר בזכות השיר \"hit and run\" ששר ביג פישי ואפילו בזכות השיר \"i wish\" שגם זכה להמון ניגונים בכל מסיבות הטראנס פסיכודלי ברחבי העולם ביחד עם הגיטרה החשמלית המפורסת שלו שכל המעריצים כבר זכו לראות.<br />\r\nהרינגטונים שתוכלו למצוא באתר של סקאזי הם השירים הפופולרים ביותר שלו, הרינגטונים לאייפון שלכם כבר מוכנים וחתוכים יפה ומה שנשאר זה רק להוריד אותו להעביר אותו לאייטונס ולסנכרן את האייפון שלכם! רוצים שיר שעדין אין באתר? חפשו בחלק העליון של האתר בקשת רינגטון ונשתדל להעלות את הבקשה שלכם בהקדם.'),(3,'ליאור נרקיס','1370716239354.jpg','ליאור נרקיס','ליאור נרקיס הינו אחד הזמרים הים תיכוניים המוכרים ביותר והמוערכים ביותר במוסיקה הישראלית. ליאור נרקיס החל את דרכו המוסיקלית לפני יותר מ-20 שנה, כבר בהיותו נער בן 16 בלבד. את ההכרה הגדולה היותר קיבל ליאור נרקיס בתחילת שנות ה-2000, כאשר הוציא את הדואט Øלכל אחד ישØ ביחד עם שלומי שבת שזכה להצלחה רבה. ליאור נרקיס ייצג את ישראל באירוויזיון בלטביה שנערך בשנת 2003. האלבום האחרון של ליאור נרקיס יצא בשנת 2012, האלבום נקרא Øאם תרציØ. לאחר המון שנים בהם ידע עליות ומורדות, ללא ספק ניתן להגיד על ליאור נרקיס שהוא אחד הזמרים המובילים ביותר בתעשיית המוסיקה הישראלית - הן מבחינת הרווחים, והן מבחינת כמות הקהל אשר מגיעה להופעות שלו.<br />\r\n<br />\r\nאצלנו באתר, תוכלו למצוא עשרות רינגטונים של הזמר ליאור נרקיס - אשר פרוסים על גבי הקריירה הארוכה של הזמר המצליח. במידה ואינכם מוצאים את אחד השירים של ליאור נרקיס, תוכלו לבקש את הרינגטון בעמוד Øבקשת רינגטוןØ אשר נמצא בתפריט העליון של האתר.'),(4,'Rihanna','1371315683280.jpg','Rihanna','Rihanna היא אחת מזמרות הפופ המצליחות ביותר בעולם כיום, ומחזיקה בתארים ופרסים רבים – ושיריה כבשו במהרה את כל תחנות הרדיו ומצעדי השירים בכל רחבי העולם. עד כה יש לRihanna כ-7 אלבומים סך הכל, כאשר האחרון שבהם יצא בשנת 2012 והוא נקרא Unapologetic.<br />\r\n<br />\r\nההצלחה הגדולה של Rihanna הגיעה כבר עם אלבומה הראשון שיצא בשנת 2006, שהגיע למספר רב של קניות כ-500 אלף עותקים נמכרו בארה\"ב ויותר מ-2 מיליון עותקים בכל העולם. הסינגל הראשון מתוך האלבום \"Pon de Replay\" זיכה את האלבום בהכרה והצלחה כה גדולה. כיום Rihanna היא אחת הזמרות המוכרות ביותר בעולם, ובאופן טבעי גם המרוויחות ביותר מהכנסות על ידי דוגמנות, ראיונות ואלבומים אותם היא מוציאה.<br />\r\n<br />\r\nגם אתם רוצים שאחד השירים של Rihanna יהיה הרינגטון בפלאפון שלכם? אתם מוזמנים לשוטט באתר – ולבחור את הרינגטון המושלם לפלאפון שלכם, וכמובן גם להוריד אותו בקלות. במידה ואתם מתקשים למצוא את אחד השירים של Rihanna אתם מוזמנים לבקש אותו על ידי לחיצה על הלשונית \"בקשת רינגטונים\" בתפריט העליון.');
/*!40000 ALTER TABLE `singers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `artist` varchar(50) CHARACTER SET utf8 NOT NULL,
  `downloads` int(100) NOT NULL DEFAULT '0',
  `oldownloads` int(100) NOT NULL DEFAULT '0',
  `downweek` int(100) NOT NULL DEFAULT '0',
  `hot` int(11) NOT NULL DEFAULT '1',
  `url` text CHARACTER SET utf8 NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `yesorno` int(11) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET utf8 NOT NULL,
  `urliphone` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2553 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` (`id`, `name`, `artist`, `downloads`, `oldownloads`, `downweek`, `hot`, `url`, `catid`, `yesorno`, `text`, `urliphone`) VALUES (300,'Out Of My Skin','Offer Nissim',828,495,2,1,'ring/OfferNissim-OutOfMySkin.mp3',5,0,'','');
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ringme_test'
--

--
-- Dumping routines for database 'ringme_test'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-01 21:39:15
