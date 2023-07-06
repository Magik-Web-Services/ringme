<?php
defined('_MATAN');

$rest = mysqli_query($link, "SELECT * FROM `settings` WHERE `id`='1'");
$rt = mysqli_fetch_array($rest);
if ($rt["sendup"] == "0") {
  $popupsd = " onclick=\"return window.open('https://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
} elseif ($rt["sendup"] == "1") {
  $popupsd = "";
}
?>

<?php include MAIN_DIR . 'pages/blocks/navigation.php'; ?>

<main>
  <div class="search">
    <img src="./img/svg/search.svg" alt="חיפוש" height="30px">
    <input type="text" name="search" id="search" placeholder="חיפוש צלצול מהיר..." class="search-input" />
  </div>
  <div id="output"></div>

  <style>
    .askForRingtone {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      margin: 10px auto;
      padding: 15px 10px;
      border: 2px solid #A475D2;
      border-radius: 20px;
      transition: all .2s ease;
      font-size: 1.5rem;
    }

    .askForRingtonesub {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      font-size: 1.5rem;
    }

    .askForRingtonesub:hover {
      background-color: #45a049;
    }

    @media only screen and (max-width: 850px) {
      .askForRingtonesub {
        padding: 4vw 20px;
      }
    }
  </style>
  <br />
  <h2>חפש/בקש צלצול אונליין</h2>
  <form method="post" action="">
    <input type="text" name="artist" placeholder="שם האמן..." class="askForRingtone" />
    <input type="text" name="song" placeholder="שם השיר..." class="askForRingtone" />

    <input type="submit" name="submit" placeholder="" class="askForRingtonesub" value="חפש/בקש צלצול" />
  </form>
  </div>



  <?php
  if (isset($_POST['submit'])) {
    if ($_POST['artist'] == "" || $_POST['song'] == "") {
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

        echo "<b>{$eror}</b>";
        die();
      }


      $urls = strtolower($song);
      if (str_replace(array("kill", "setcookie", "javascript", "insert", "select", "union", "update", "drop", "alert", "hack", "banzona", "h1", "alret", "red", "green", "<h1>"), '', strip_tags($urls)) != $urls) {
        $artist = "";
        $song = "";
        $eror = "<font color='red'>לא ניתן להשתמש בערך החיפוש הזה</font>";

        echo "<b>{$eror}</b>";
        die();
      }




      $strr = $_POST['song'] . " " . $_POST['artist'];
      $words = explode(' ', $strr);
      $words = array_filter($words);
      $regex = implode('|', $words);
      $query = "SELECT *, CONCAT(name, ' ', artist) as full_name FROM songs WHERE ";
      $flag = 1;
      foreach ($words as $word) {
        if ($flag === 1) {
          $query .= " CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($word) . "%'";
        } else {
          $query .= " AND CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($word) . "%'";
        }
        $flag++;
      }
      $result = mysqli_query($conn, $query);

      $limit = "13";
      $cpage = 1;
      //$t = mysqli_num_rows(mysqli_query($link,"SELECT `id` FROM `songs` WHERE `name` LIKE '%$song%' AND `artist` LIKE '%$artist%'"));  

      $t = mysqli_num_rows($result);
      if ($t == 0) {

        $res = mysqli_query($link, "SELECT `date` FROM `orders` WHERE `ip`='$ip' ORDER BY id DESC");
        if (mysqli_num_rows($res) > 0)
          $r = mysqli_fetch_array($res);
        else
          $r['date'] = 0;
        if (time() > ($r['date'] + (60 * 60 * 24))) {
          mysqli_query($link, "INSERT INTO `orders` (`song`, `artist`, `ip`, `date`) VALUES ('$song', '$artist', '$ip', '$date')");
          echo "<font color='green'><b>בקשתך נשלחה בהצלחה</b></font>, בקרוב צוות האתר ייקבל את הבקשה שלכם ולאחר מכן יוסיף את הצלצול בקטגוריה הבקשות שלכם!";
          die();
        } else {
          echo "<b>לא ניתן לבקש פעמיים ביום, תודה.</b>";
          die();
        }
      }
      $p = $t / $limit;
      $pages = ceil($p);
      $npage = $cpage + 1;
      $ppage = $cpage - 1;
      $i = ($cpage * $limit) - $limit;

      echo '<font color="green"><b>לא צריך לבקש את הצלצול, הוא כבר נמצא באתר!</b></font>';
      echo '<div class="ringtones-list">';


      $servername = 'localhost';
      $username = '';
      $password = '';
      $dbname = "";
      $conn = mysqli_connect($servername, $username, $password, "$dbname");

      $strr = "{$_POST['song']} {$_POST['artist']}";

      $wordss = explode(' ', $strr);
      $wordss = array_filter($wordss);
      $regex = implode('|', $wordss);

      $query = "SELECT *, CONCAT(name, ' ', artist, ' ', text) as full_name FROM songs WHERE ";
      $flag = 1;
      foreach ($wordss as $words) {
        if ($flag === 1) {
          $query .= " CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($words) . "%'";
        } else {
          $query .= " AND CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($words) . "%'";
        }
        $flag++;
      }

      $ress = mysqli_query($conn, $query);

      $res = mysqli_query($link, "$query");
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
      echo "</div>";
    }
  }

  ?>