<?php
include('../conf.php');

$ids = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : '1';

$resq = mysqli_query($link, "SELECT * FROM singers WHERE id='$ids'");
$rq = mysqli_fetch_array($resq);
// if ($_GET["id"] != $rq["id"])
  // header('Location: https://www.ringme.co.il');

  $resss = mysqli_query($link, "SELECT `text` FROM `blocks` WHERE id = '6' ");
$rss = mysqli_fetch_array($resss);
$b = $rss['text'];

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
  $popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
  $popup = "";
}

$ress = mysqli_query($link, "SELECT * FROM `singers`");
$rs = mysqli_fetch_array($ress);
?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">

<?php include('blocks/navigation.php'); ?>

<main>

  <div class="artistName">

    <a href="https://www.ringme.co.il/singer-<?= $ids ?>.html">
      <h1>
        <?php echo $rs['name']; ?>
      </h1>
    </a>

  </div>

  <br />
  <?php echo $b; ?>

  <div class="artist-container">

    <div class="aboutArtist">
      <div class="artistImage" style="background-image: url(https://www.ringme.co.il/images/artists/<?php echo $rs['image']; ?>);">

      </div>

      <div class="text">
        <?php echo $rs['coment']; ?>
      </div>
    </div>

    <h2>
      רשימת הצלצולים
    </h2>
    <div class="ringtones-list">

      <?php
      if (!$_GET['id']) {
        header('Location: https://www.ringme.co.il');
      }


      $artist = $rs['name'];

      if ($_GET["id"] == "8") {
        $res = mysqli_query($link, "SELECT * FROM `songs` WHERE `artist` LIKE '$artist' ORDER BY `id` DESC");
      } else {
        $res = mysqli_query($link, "SELECT * FROM `songs` WHERE `artist` LIKE '%$artist%' ORDER BY `id` DESC");
      }
      while ($r = mysqli_fetch_array($res)) {

        echo <<<END

        <div class="ringtone">
	<a href="./song-{$r['id']}.html" class="link-to-ringtone"></a>
          <div class="text">
            <div class="song">{$r['name']}</div>
            <div class="artist">{$r['artist']}</div>
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