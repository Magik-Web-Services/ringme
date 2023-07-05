<?php
define('_MATAN', 1);

include("../../conf.php");
include("../../getid3/getid3.php");

$song = intval($_GET['song']);

$res = mysqli_query($link, "SELECT * FROM songs WHERE id='$song'");
$r = mysqli_fetch_array($res);
if ($_GET["song"] != $r["id"])
  header('Location: https://www.ringme.co.il');
if (!$_GET["song"])
  header('Location: https://www.ringme.co.il');

if ($_SERVER["SCRIPT_NAME"] == "/pages/blocks/player.php") {
  if (isset($song)) {
    $r = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `songs` WHERE `id`='{$song}'"));
    $urikas = $r["artist"] . " - " . $r["name"] . " - צלצול להורדה";
    $urik = $r["artist"] . " - " . $r["name"];
    $url = $urikas;
    $titles = $r["artist"];

    $sendup = $rs['sendup'];
    if ($sendup == "0") {
      $popup = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
    } else if ($sendup == "1") {
      $popup = "";
    }

    $urikas = "" . $titles . " - " . $r["name"] . " - צלצול להורדה";
    $urikass = $titles . " - " . $r["name"];
  }
}
$song = intval($_GET['song']);
if (isset($song))
  $rw = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `songs` WHERE `id`='{$song}'"));

$namesong = $r["artist"] . " - " . $r["name"];
$songname = $r["name"];
$artistname = $r["artist"];
$idface = $r["id"];
$serach_artistname = $r["artist"];


$getd = $song;
if ($_SERVER["REQUEST_URI"]   == "/pages/blocks/player.php?song={$song}") {

  $yesorno = "0";
} else if ($_SERVER["REQUEST_URI"] == "/song-{$song}.html") {
  $yesorno = "1";
  $description = "חיפשת את הצלצול {$songname} של הזמר {$artistname}? רוצה להוריד את הצלצול {$namesong} בחינם? להורדת {$namesong} צלצול להורדה לאייפון ולאנדרואיד לחץ כאן!";
  $keywords = $r['artist'] . ", " . $r['name'] . ", צלצול להורדה, צלצולים לפלאפון, צלצולים להורדה בחינם, רינגטונים, סלולרי, פלאפון, אייפון, מזרחית, דיכאון, אנדרואיד";
  $descriptiond = "חיפשת את הצלצול {$songname} של הזמר {$artistname}? רוצה להוריד את הצלצול {$namesong} בחינם? <br /> להורדת {$namesong} צלצול להורדה לאייפון ולאנדרואיד בחר את ההורדה המתאימה למכשירך.";
}

$charset = "UTF-8";

include("../../security.php");

$rest = mysqli_query($link, "SELECT * FROM `settings` WHERE `id`='1'");
$rt = mysqli_fetch_array($rest);


if ($rt["sendup"] == "0") {
  $popupsd = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} elseif ($rt["sendup"] == "1") {
  $popupsd = "";
}


if ($yesorno == "1") {

  if ($r['text'] == "") {
  } else {
    $textds = "{$r['text']}";
  }

  $catidd = $r['catid'];
  $catttttt = mysqli_query($link, "SELECT name FROM `category` WHERE `id`='{$catidd}'");
  $cattttttt = mysqli_fetch_array($catttttt);

  if ($r['catid'] == "0") {
  } else if ($r['catid'] == "1") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  } else if ($r['catid'] == "2") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  } else if ($r['catid'] == "3") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  } else if ($r['catid'] == "4") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  } else if ($r['catid'] == "5") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  } else if ($r['catid'] == "6") {
    $ett = "<a href='https://www.ringme.co.il/cat-{$r[catid]}.html'>{$cattttttt['name']}</a>";
  }


  $linkold = $r["url"];
  $newnamelink = $namesong;
?>
  <!DOCTYPE html>
  <html dir="rtl" lang="he" xmlns="https://www.w3.org/1999/xhtml" xml:lang="he">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115519910-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-115519910-1');
    </script>
    <title><?php echo $urikas; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index,follow" />
    <base href="https://www.ringme.co.il/">
    </base>
    <meta name="keywords" content="<?= $keywords ?>" />
    <meta name="description" content="<?= $description ?>" />
    <meta name="google-site-verification" content="kDFfnAjTs1xZ8Drc_e6175KBA-yKU7iCZx8a_AoAkgY" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="canonical" "<?= $_SERVER["SCRIPT_URI"]; ?>" />
    <meta property="og:title" content="<?= $urikas ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="https://www.ringme.co.il/song-<?= $song ?>.html" />
    <meta property="og:site_name" content="<?php echo $urikas; ?>">
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://www.ringme.co.il/images/logoshare.png" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
    <meta property="og:image:type" content="image/png" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382417683683617" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../stylemobile.css">
    <style>
      #countdown {
        position: relative;
        margin: 55px auto;
        height: 40px;
        width: 40px;
      }

      #countdown-number {
        color: #6FD5EC;
        font-weight: bold;
        display: inline-block;
        line-height: 40px;
        font-size: 40px;
      }

      svg {
        border-radius: 100%;
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        height: 40px;
        transform: rotateZ(-90deg) scale(2);
      }

      svg circle.dash {
        stroke: #6FD5EC;
      }


      svg circle.base {
        /*#f0f0f5*/
        stroke: #EFEFF5;
      }

      svg circle {
        stroke-dasharray: 113px;
        stroke-dashoffset: 0px;
        stroke-linecap: round;
        stroke-width: 3px;
        fill: none;
      }


      @keyframes countdown {
        from {
          stroke-dashoffset: 113px;
        }

        to {
          stroke-dashoffset: 0px;
        }
      }

      .loadingsong {
        color: #6FD5EC;
        font-weight: bold;
        font-size: 2rem;
        padding-top: 10px;
      }
    </style>
    <?php
    if ($r['text'] == "") {
      echo <<<END
<style>
.sticky-player {
    margin-right: 0;
}
</style>
END;
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8382417683683617",
        enable_page_level_ads: true
      });
    </script>
  </head>

  <body>
    <?php
    $complete_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <a class="to-page-top" href="<?= $complete_url ?>#">
      <img src="../img/svg/arrow-up.svg">
    </a>

    <a class="whatsapp" href="https://wa.me/?text=<?= $complete_url ?>">
      <img src="../img/svg/whatsapp.svg">
    </a>

    <?php include('pages/blocks/navigation.php'); ?>

    <main>

      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382417683683617" crossorigin="anonymous"></script>
      <!-- downringtone -->
      <ins class="adsbygoogle" style="display:inline-block;width:100%;height:50px" data-full-width-responsive="true" data-ad-client="ca-pub-8382417683683617" data-ad-slot="9834876086"></ins>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>

      <!-- content goes here -->
      <ul class="breadcrumb">
        <li>קטגוריה</li>
        <li><?php echo $ett; ?></li>
      </ul>
      <br />

      <a href="<?= $_SERVER["SCRIPT_URI"]; ?>">
        <h1><?php echo $urikass; ?> צלצול להורדה</h1>
      </a>

      <?php
      $song = intval($_GET['song']);
      if (isset($song)) {
        $r = mysqli_fetch_array(mysqli_query($link, "SELECT `url` FROM `songs` WHERE `id`='{$song}'"));
        $url = $r['url'];
        $urlsec = "https://www.ringme.co.il/" . $r['url'];
      }


      $filename = "../../" . $url;
      $getID3 = new getID3;
      $file = $getID3->analyze($filename);
      $playtime_seconds = $file['playtime_seconds'];
      $secend = gmdate("s", $playtime_seconds);


      if ($textds == "") {
      ?>
        <div class="audio-and-chorusno"></div>
        <div class="sticky-player">
          <audio controls autoplay id="audioP">
            <source src="<?= $url; ?>" type="audio/mpeg">
        </div>

        <div class="secondss">(<?= $secend; ?> שניות)</div>
        </audio>



      <?php
      } else {



        echo <<<END
<div class="audio-and-chorus">
     <div class="chorus">
        <h2>פזמון</h2>
         <p>
        {$textds}
         </p>
    </div>
</div>
<div class="sticky-player">
    <audio controls autoplay id="audioP">
    <source src="{$url}" type="audio/mpeg">
</div> 
<div class="secondss">({$secend} שניות)</div>
    </audio>

END;
      }
      ?>




      <?php
      if ($_GET['song'] == "1795") {
        $artistname = 'להקת הנח"ל';
        $resw = mysqli_query($link, "SELECT * FROM `songs` WHERE `artist` = '{$artistname}' ORDER BY  `id` desc LIMIT 0,60");
      } else {
        $resw = mysqli_query($link, "SELECT * FROM `songs` WHERE `artist` = \"{$artistname}\" ORDER BY  `id` desc LIMIT 0,60");
      }



      $replaced = str_replace('"', '\"', $artistname);
      $reslink = mysqli_query($link, "SELECT * FROM singers WHERE name=\"{$replaced}\"");
      $rlink = mysqli_fetch_array($reslink);

      if ($rlink['name'] == "{$artistname}") {
        $linktoartist = "<a href='./singer-{$rlink['id']}.html'>";
        $linktoartistend = "</a>";
      }
      ?>
      </center>
      </div>



      <div class="more-ringtons-by-artist-container2" style="text-align:right;">
        <?php
        $multi_artist_array = explode("&", $serach_artistname);
        foreach ($multi_artist_array as $singleArtist) {
          $search_artist = trim($singleArtist);
          if ($search_artist && $search_artist !== "") {
            $search_artist2 = str_replace("'", "\'", $search_artist);


            $sql3 = "SELECT id FROM singers WHERE name = '$search_artist2'";
            $result3 = $conn->query($sql3);
            if ($result3->num_rows > 0) {
              $row3 = $result3->fetch_assoc();
              $artist_id = $row3["id"];
              $show = '<a href ="/singer-' . $artist_id . '.html">' . $search_artist . '</a>';
            } else {
              $show  = $search_artist;
            }


            $sql = "SELECT * FROM songs WHERE artist LIKE '%$search_artist2%' order by id desc LIMIT 0,60";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              echo '<h2 style="margin-top:50px">צלצולים נוספים להורדה של ' . $show . ' </h2>';
              while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $name = $row["name"];
                echo '<div class="more-ringtones" style="display:inline-block;"><a href="song-' . $id . '.html">' . $name . '</a></div>';
              }
            }
          }
        }

        ?>
      </div>


      <?php
      $haystack = $artistname;
      $needle = '&';

      if (strpos($haystack, $needle) !== false) {
      ?>

        <div class="more-ringtons-by-artist-container">
          <h2>צלצולים נוספים להורדה של <?= $linktoartist; ?><?phpecho $artistname; ?><?= $linktoartistend; ?></h2>
          <div class="more-ringtons-by-artist">
            <?php
            while ($rw = mysqli_fetch_array($resw)) {
              $namelist = $rw['name'];

              if ($namelist == $artistname) {
              }
              echo <<<END
        <div class="more-ringtones">
          <a href="song-{$rw['id']}.html">
            {$rw['name']}
          </a>
        </div>
END;
            }
            ?>
          </div>
        </div>
      <?php
      }
      ?>
      <div class="action-buttons">
        <?php
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
          if (strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS')) {
        ?>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- urikas -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>

          <?php
          } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
          ?>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- urikas -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        <?php
          }
        }
        ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- urikas -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <div class="loadingsong">
          להורדת הצלצול אנא המתן..
        </div>
        <div id="countdown">
          <svg>
            <circle class="base" r="18" cx="20" cy="20"></circle>
            <circle class="dash" r="18" cx="20" cy="20"></circle>
          </svg>
          <div id="countdown-number"></div>
        </div>

        <div class="inner">

          <a href="<?= $url ?>" download='<?= $namesong ?>.mp3' <?= $popupsd ?>>
            <div class="action-btn" onclick="voteNameReputation(this, '<?= $song ?>')">הורד לאנדרואיד</div>
          </a>

          <div class="ad ringtonePage">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382417683683617" crossorigin="anonymous"></script>
            <!-- downringtone -->
            <ins class="adsbygoogle" style="display:inline-block;width:100%;height:50px" data-full-width-responsive="true" data-ad-client="ca-pub-8382417683683617" data-ad-slot="9834876086"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </div>
          <?
          $res = mysqli_query($link, "SELECT * FROM songs WHERE id='$song'");
          $r = mysqli_fetch_array($res);
          if ($r['urliphone'] == "") {
          } else {
            $enddddd = str_replace(".mp3", ".m4r", $url);
          ?>
            <a href="<?= $enddddd ?>" download="<?= $namesong ?>.m4r" <?= $popupsd ?>>
              <div class="action-btn" onclick="voteNameReputation(this, '<?= $song ?>')">הורד לאייפון</div>
            </a>
          <?php
          }
          ?>



          <a onclick="return window.open('send-<?php echo $song; ?>.html', 'myWindow', 'status = 1, height = 210, width = 280, resizable = 0')">
            <div class="action-btn">שליחה לחבר</div>
          </a>

          <a href="/report.html">
            <div class="action-btn">דווח על בעיה</div>
          </a>

        </div>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382417683683617" crossorigin="anonymous"></script>
        <!-- urikas -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- urikas -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>


        <script>
          $(function() {
            window.voteNameReputation = function(b, t) {
              $(b).attr("onclick", false);

              return $.ajax("/pages/blocks/new_download.php", {
                method: "POST",
                data: {
                  type: t,
                  fp_val: window.pfpval
                },
                success: function(d) {
                  //$("#name_votes").html(d);

                },
                error: function(d, f, e) {

                }
              })
            };
          });
        </script>

      </div>

      <div class="footer">
        הזכויות שמורות לאתר 2011-2023 RingMe.co.il המאפשר <b><a href="https://www.ringme.co.il/">צלצולים</a></b> להורדה
        | <a href="./youtube.html">הורדת שירים מיוטיוב</a> | <a href="./bigbrother.html">האח הגדול שידור חי</a>
        <h2>צלצולים להורדה</h2>
      </div>
    </main>
  </body>

  </html>
  <script>
    const dropdownHeadlines = document.querySelectorAll('.dropdown-headline'),
      dropdowns = document.querySelectorAll('.dropdown');

    // on hover, add class open
    dropdowns.forEach(e => {
      e.addEventListener('click', function() {
        this.querySelector('.dropdown-content').classList.toggle('open');
      });

    });


    // add functionality when clicking play
    const player = document.querySelector('audio'),
      chorus = document.querySelector('.chorus p');

    player.addEventListener("play", function() {
      chorus.classList.add('highlight');
    });

    player.addEventListener("pause", function() {
      chorus.classList.remove('highlight');
    });

    const whatsapp = document.querySelector('.whatsapp');
    window.addEventListener('scroll', function() {
      console.log('scrolling')
      if (window.pageYOffset > 100 && !scrollToTop.classList.contains('show')) {
        whatsapp.classList.add('show');
      } else if (window.pageYOffset <= 100 && scrollToTop.classList.contains('show')) {
        whatsapp.classList.remove('show');
      }
    });

    const scrollToTop = document.querySelector('.to-page-top');
    window.addEventListener('scroll', function() {
      console.log('scrolling')
      if (window.pageYOffset > 100 && !scrollToTop.classList.contains('show')) {
        scrollToTop.classList.add('show');
      } else if (window.pageYOffset <= 100 && scrollToTop.classList.contains('show')) {
        scrollToTop.classList.remove('show');
      }
    });

    $(function() {
      $(".to-page-top").on('click', function() {
        $("HTML, BODY").animate({
          scrollTop: 0
        }, 120);
      });
    });


    var initialSize = 1.5;
    $("#countdown").css("transform", "scale(" + initialSize + ")");

    var countdownNumberEl = document.getElementById('countdown-number');
    var countdown = totalCountdown = 10;

    countdownNumberEl.textContent = countdown;
    var oldIntegerCount = -1;

    var countdownTimer = setInterval(function() {
      countdown -= 0.006;
      var integerCount = Math.floor(countdown);
      if (integerCount != oldIntegerCount) {
        $("#countdown").animate({
          border: 1
        }, {
          duration: 150,
          step: function(now) {
            $("#countdown").css("transform", "scale(" + (initialSize + 0.15 * now) + ")");
          },
          complete: function() {
            $("#countdown").animate({
              border: 1
            }, {
              duration: 150,
              step: function(now) {
                $("#countdown").css("transform", "scale(" + (initialSize + 0.15 - 0.15 * now) + ")");
              }
            });
          }
        });
        oldIntegerCount = integerCount;
      }
      if (countdown < 0) countdown = 0;
      if (countdown > 0) {
        countdownNumberEl.textContent = Math.floor(countdown);
        document.querySelector("circle.dash").style.strokeDashoffset = (113 * countdown / totalCountdown);
      } else {
        clearTimeout(countdownTimer);
        document.querySelector("#countdown").style.display = "none";
        document.querySelector(".loadingsong").style.display = "none";
        document.querySelector(".inner").style.display = "flex";
      }
    }, 10);
  </script>
  <script data-ad-client="ca-pub-8382417683683617" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php
} else {
  $to = "https://www.ringme.co.il/song-{$song}.html";
  header("Location: $to");
}
?>