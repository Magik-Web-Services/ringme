<?php
defined('_MATAN');
include("../conf.php");

$page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '';

if ($_SERVER["REQUEST_URI"] == "/index.php?act=iphone&page={$page}") {
  $to = "https://www.ringme.co.il/iphone-{$page}.html";
  header("Location: $to");
}
if ($_SERVER["REQUEST_URI"] == "/index.php?act=iphone") {
  $to = "https://www.ringme.co.il/iphone.html";
  header("Location: $to");
}

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
  $popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
  $popup = "";
}
?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">

<?php include('blocks/navigation.php'); ?>

<main>
  <div class="categoryName">
    <?php
    $cpage =     (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '1';
    $tes = mysqli_query($link, "SELECT `name` FROM `category`");
    $t = mysqli_fetch_array($tes);
    if ($cpage != 0)
      $urikas = " - עמוד ";
    $list = "רשימת הצלצולים" . $urikas;
    echo "<h1>צלצולים לאייפון</h1>";
    ?>

  </div>

  <div class="artist-container">
    <div class="aboutArtist noMargin">
      <div class="text">
        לכל מי שרוצה להוריד צלצול ישירות למכשיר האייפון ללא צורך במחשב או תשלום מיותר
        <Br />
        <b>
          <a href="https://www.ringme.co.il/howto.html">למדריך להורדת צלצולים לאייפון</a>
        </b>
        <br /><br />
        בעבר אתר רינג מי התמקד בצלצולים להורדה למכשירי האנדרואיד בלבד, כעת ניתן להוריד אלפי צלצולים חדשים גם למכשירי האייפון שלכם.<br />
        כדי להוריד צלצול לאייפון, חפשו את הצלצול האהוב עליכם, לחצו על "הורד לאייפון" וכעבור מס' שניות הצלצול האהוב עליכם אצלכם במחשב בחינם!<br />
        <u>
          <font color="red">חשוב:</font>
        </u> פתחו את תוכנת ה-iTunes של האייפון, גררו את הצלצול שהורדתם אל התוכנה, לחצו על music כדי לפתוח את התפריט ולאחר מכן לחצו על Tones ותוודאו שמופיע שם הרינגטון שהורדתם.<br />
        כעת גשו לאייפון שלכם בתוכנה, כנסו ל-Tones ולאחר מכן וודאו שהצלצול שלכם מסומן ב-V ולאחר מכן סנכרנו את מכשיר האייפון שלכם!

      </div>
    </div>
  </div>


  <h2>
    <?php echo $list; ?>
  </h2>

  <div class="ringtones-list">

    <?php
    $limit = "30";
    $cpage =     (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '1';
    if (!$cpage || $cpage < 1)
      $cpage = 1;
    $t = mysqli_num_rows(mysqli_query($link, "SELECT `id` FROM `songs`"));
    $p = $t / $limit;
    $pages = ceil($p);
    $npage = $cpage + 1;
    $ppage = $cpage - 1;
    $i = ($cpage * $limit) - $limit;


    $res = mysqli_query($link, "SELECT * FROM `songs` WHERE `urliphone` != '' ORDER BY `id` DESC LIMIT $i,$limit ");

    if ($cpage > $pages) {
      header('Location: https://www.ringme.co.il');
    } else {

      while ($r = mysqli_fetch_array($res)) {
        $artist = $r['artist'];
        echo <<<END

      <div class="ringtone">
	<a href="./song-{$r['id']}.html" class="link-to-ringtone"></a>
        <div class="text">
          <div class="song">{$r['name']}</div>
          <div class="artist">{$artist}</div>
        </div>

        <div class="icons">
          <div class="play">
            <audio>
              <source src="./{$r['url']}" type="audio/mpeg">
            </audio>
            <img src="./img/svg/play.svg" alt="נגן">
          </div>
          <div class="download">
            <a href="./song-{$r['id']}.html"{$popup}>
              <img src="./img/svg/download.svg" alt="הורד">
            </a>
          </div>
        </div>
      </div>

END;
      }
    }
    ?>
  </div>
  </div>

  <br /><br />
  <font color="#9112ff"><u>עמודים</u>:</font>
  <div class="center">
    <div class="pagination">
      <?php
      if ($pages > 0) {
        $count = 1;
        while ($count <= $pages) {

          if ($count == $cpage) {
            $echo = "<a href=\"iphone-$count.html\" class=\"active\">$count</a>";
          } else {
            $echo = "<a href=\"iphone-$count.html\">$count</a>";
          }

          echo $echo;
          $count++;
        }
      }
      ?>
    </div>
  </div>
  </center>