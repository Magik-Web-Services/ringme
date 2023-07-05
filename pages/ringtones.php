<?php
include("../conf.php");
$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
  $popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
  $popup = "";
}

$sqlQuery = "SELECT * FROM songs";
$result = mysqli_query($link, $sqlQuery);
$total_count = mysqli_num_rows($result);
$sqlQuery = "SELECT * FROM songs ORDER BY id DESC LIMIT 20";
$result = mysqli_query($link, $sqlQuery);
?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">
<style>
  svg {
    width: 100px;
    height: 100px;
    display: inline-block;
  }

  ajax-loader {
    display: block;
    text-align: center;
  }

  .ajax-loader img {
    width: 50px;
    vertical-align: middle;
  }
</style>
<?php include("blocks/navigation.php") ?>

<main>

  <div class="artistName">

    <h1>
      כל הצלצולים באתר להורדה
    </h1>

  </div>

  <br /><br />
  <h2>
    רשימת כל הצלצולים באתר להורדה
  </h2>

  <div class="ringtones-list" id="post-listt">


    <input type="hidden" name="total_count" id="total_count" value="<?php echo $total_count; ?>" />
    <?php
    while ($r = mysqli_fetch_assoc($result)) {
      echo <<<END

        <div class="ringtone" id="{$r['id']}">
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
  </div>

  <div class="ajax-loader">
    <svg version="1.1" id="L5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 70 90" enable-background="new 0 0 0 0" xml:space="preserve">
      <circle fill="#A475D2" stroke="none" cx="6" cy="50" r="6">
        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 15 ; 0 -15; 0 15" repeatCount="indefinite" begin="0.1"></animateTransform>
      </circle>
      <circle fill="#533e67" stroke="none" cx="30" cy="50" r="6">
        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 10 ; 0 -10; 0 10" repeatCount="indefinite" begin="0.2"></animateTransform>
      </circle>
      <circle fill="#A475D2" stroke="none" cx="54" cy="50" r="6">
        <animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.3"></animateTransform>
      </circle>
    </svg><br><text style="color:#a977d6;font-size:2vw;size:2vw;">⬇</text> גלול למטה לטעינת שירים נוספים <text style="color:#a977d6;font-size:2vw;size:2vw;">⬇</text>
  </div>
  <div class="footer">
    הזכויות שמורות לאתר 2011-2023 RingMe.co.il המאפשר <b><a href="https://www.ringme.co.il/">צלצולים</a></b> להורדה
    | <a href="./youtube.html">הורדת שירים מיוטיוב</a> | <a href="./bigbrother.html">האח הגדול שידור חי</a>
  </div>
</main>