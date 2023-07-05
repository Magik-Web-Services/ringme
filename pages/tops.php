<?php
defined('_MATAN');
include('../conf.php');

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
  $popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
  $popup = "";
}

if ($_SERVER["REQUEST_URI"] == "/index.php?act=tops") {
  $to = "https://www.ringme.co.il/tops.html";
  header("Location: $to");
}

if ($_SERVER["REQUEST_URI"] == "/?act=tops") {
  $to = "https://www.ringme.co.il/tops.html";
  header("Location: $to");
}
?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">

<?php include('blocks/navigation.php'); ?>

<main>

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- urikas -->
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

  <div class="categoryName">
    <h1>הצלצולים הכי מבוקשים באתר</h1>
  </div>

  <div class="artist-container">
    <div class="aboutArtist noMargin">
      <div class="text">
        כאן תוכלו למצוא את רוב הצלצולים שתחפשו בתקופה האחרונה, באתר רינג מי קיימים המון צלצולים ממגוון הז'אנרים.<br />
        יצרנו לכם עמוד שבו תוכלו לצפות ב-30 הצלצולים המורדים ביותר בתקופה האחרונה.<br />
        קל מאוד להתעדכן בצלצולים חדשים והמורדים בזכות אתר רינג מי.<br />
        גלישה מהנה.
      </div>
    </div>

    <h2>רשימת הצלצולים</h2>

    <div class="ringtones-list">
      <?php
      $num = 1;
      $res = mysqli_query($link, "SELECT * FROM `songs` ORDER BY  `downweek` desc LIMIT 0,30");
      while ($r = mysqli_fetch_array($res)) {
        $tt = $num++;
        $artist = $r['artist'];
        echo <<<END

      <div class="ringtone">
<a href="./song-{$r['id']}.html" class="link-to-ringtone"></a>
<div class="number-and-artist">
            <div class="number">
             {$tt}.
            </div>
        <div class="text">
          <div class="song">{$r['name']}</div>
          <div class="artist">{$artist}</div>
        </div>

</div>
        <div class="icons">
          <div class="play">
            <audio>
              <source src="./{$r['url']}" type="audio/mpeg">
            </audio>
            <img src="../img/svg/play.svg" alt="נגן">
          </div>
          <div class="download">
            <a href="./song-{$r['id']}.html"{$popup}>
              <img src="../img/svg/download.svg" alt="הורד">
            </a>
          </div>
        </div>
      </div>
END;
      }
      ?>
    </div>
  </div>


  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- urikas -->
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>