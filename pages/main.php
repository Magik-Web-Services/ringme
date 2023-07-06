<?php
defined('_MATAN');

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$settings = mysqli_fetch_array($ress);
$send = $settings['send'];
$sendup = $settings['sendup'];

if ($sendup == "0") {
  $popup = " onclick=\"return window.open('https://".SITE_URL."ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} else if ($sendup == "1") {
  $popup = "";
}
?>

<?php
include('pages/blocks/navigation.php');
?>

<main>

  <style>
    .songsdown {
      font-size: 1.5rem;
      color: orange;
    }

    .bigbrother {
      color: #33ACFF;
    }
  </style>
  <div class="songsdown">חדש באתר-</div>
  <h4><a href="/youtube.html">הורדת שירים מיוטיוב</a></h4>
  <h3> <a href="/bigbrother.html">
      <div class="bigbrother"><img src="./images/biglogo.png" width="20px" height="20px">האח הגדול לייב<img src="./images/biglogo.png" width="20px" height="20px"></div>
    </a></h3>





  <div class="search">
    <img src="./img/svg/search.svg" alt="חיפוש" height="30px">
    <input type="text" name="search" id="search" placeholder="חיפוש צלצול מהיר..." class="search-input" />
  </div>
  <div id="output"></div>


  <div class="hot-and-new">
    <div class="hottest">
      <div class="headline">
        <img src="./img/svg/hottest.svg" alt="" height="40px">
        <div class="ringtone-headline">
          החמים של השבוע
        </div>
      </div>


      <div class="content">
        <?php
        $artist = "2";
        $ressongs = mysqli_query($link, "SELECT * FROM `songs` WHERE `hot` LIKE '%$artist%' ORDER BY `id` DESC");
        while ($hotsongs = mysqli_fetch_array($ressongs)) {
          echo <<<END

          <div class="ringtone">
	<a href="./song-{$hotsongs['id']}.html" class="link-to-ringtone"></a>

            <div class="text">
              <div class="song">{$hotsongs['name']}</div>
              <div class="artist">{$hotsongs['artist']}</div>
            </div>

            <div class="icons">
              <div class="play">
                <audio>
                  <source src="./{$hotsongs['url']}" type="audio/mpeg">
                </audio>
                <img src="./img/svg/play.svg" alt="נגן">
              </div>
              <div class="download">
                <a href="./song-{$hotsongs['id']}.html"{$popup}>
                  <img src="./img/svg/download.svg" alt="הורד">
                </a>
              </div>
            </div>
          </div>
END;
        }

        ?>

      </div>
    </div>


    <div class="newest">
      <div class="headline">
        <img src="./img/svg/newest.svg" alt="" height="40px">
        <div class="ringtone-headline">
          החדשים ביותר
        </div>
      </div>

      <div class="content">
        <?php
        $res = mysqli_query($link, "SELECT * FROM `songs` ORDER BY `id` DESC LIMIT 0,10");
        while ($r = mysqli_fetch_array($res)) {
          $artist = $r['artist'];
          $po = $r['hot'];
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
        ?>


      </div>
    </div>
  </div>

  <div class="welcome">
    <h1>צלצולים להורדה</h1>
    <p>
      ברוכים הבאים לרינג מי, <br>
      באתר תוכלו למצוא צלצולים להורדה
      בחינם ללא צורך בתשלום כלשהו,
      צלצולים להורדה בחינם באמצעות אתר רינג מי יאפשרו לכם להנות ממגוון רחב של סינגלים אהובים!
      תוכלו להוריד צלצולים למחשב האישי שלכם ולהעביר בקלות למכשיר הסלולרי שלכם,
      במידה וחיפשתם צלצולים להורדה הגעתם למקום הנכון.
      אתם מוזמנים לגלוש באתר ולהנות ממגוון צלצולים להורדה חופשית בחינם!

      <br><br>
      באתר תמצאו ז'אנרים מחולקים, <span class="bold">צלצולים</span> להורדה מובילים וחדשים לכל סוגי הסמארטפונים!
      <br><br />
      כל התחום של מוזיקה בכלל, ושל <span class="bold">צלצולים</span> להורדה בחינם בפרט, קשור מאד אל התפיסה שלנו של הזמן, כלומר הבנה שיש עבר ויש עתיד, והחיים זזים על איזה ציר לינארי (קווי) מופשט. בגלל, קשה מאד ליצור אומנות, או משהו בכלל, בטח צלצולים להורדה, ללא תודעה של זמן. הזמן הוא מוטיבציה מאד חזקה שהעולם הולך לאיפשהו, גם אם אין לנו מושג לאיפה, וזהו אוצר ענק שגורם לרגשות ומחשבות מסועפות, שבזכותם נוצרו צלצולים להורדה, וגם הטירוף, הרצון "לעשות משהו עם העולם הזה", ולא לקבל אותו כמו שהוא אלא ליצור, לעשות, להרוויח, להוסיף, ללכת לאנשהו.
    </p>
  </div>