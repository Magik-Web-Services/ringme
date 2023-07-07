<?php
defined('_MATAN');
include("../conf.php");


$catid = (isset($_GET['catid']) && !empty($_GET['catid'])) ? $_GET['catid'] : '5';
if (!$catid)
  // header('Location: http://www.ringme.co.il');

  if ($_SERVER["REQUEST_URI"] == "/index.php?act=cat&catid={$catid}") {
    $to = "http://www.ringme.co.il/cat-{$catid}.html";
    header("Location: $to");
  }

$ress = mysqli_query($link, "SELECT * FROM `settings` WHERE id = '1' ");
$rs = mysqli_fetch_array($ress);
$sendup = $rs['sendup'];
if ($sendup == "0") {
  $popup = " onclick=\"return window.open('http://www.ringme.co.il/ads.php', 'myWindow', 'status = 1, height = 190, width = 730, resizable = 0')\"";
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
    $catid = (isset($_GET['catid']) && !empty($_GET['catid'])) ? $_GET['catid'] : '5';
    $tes = mysqli_query($link, "SELECT `name` FROM `category` WHERE `id`='$catid'");
    $t = mysqli_fetch_array($tes);
    // if ($_GET['page'] != 0)
      $urikas = " - עמוד ";
    $list = "רשימת הצלצולים" . $urikas;
    echo "<h1>" . $t['name'] . "</h1>";
    ?>

  </div>


  <h2>
    <?php echo $list; ?>
  </h2>

  <div class="ringtones-list">

    <?php
    $limit = "50";
    $cpage =     (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : '1';
    // if (!$_GET['page'] || $_GET['page'] < 1)
      $cpage = 1;
    $t = mysqli_num_rows(mysqli_query($link, "SELECT id FROM `songs` WHERE `catid`='$catid' "));
    $p = $t / $limit;
    $pages = ceil($p);
    $npage = $cpage + 1;
    $ppage = $cpage - 1;
    $i = ($cpage * $limit) - $limit;
    $res = mysqli_query($link, "SELECT * FROM `songs` WHERE `catid`='$catid' ORDER BY `id` DESC LIMIT $i,$limit ");

    if ($cpage > $pages) {
      // header('Location: https://www.ringme.co.il');
    } else {

      while ($r = mysqli_fetch_array($res)) {
        $artist = $r['artist'];
        $id = $r['id'];
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
    }
    ?>

  </div>
  </div>

  <br /><br />
  <font color="#9112ff"><u>עמודים</u>:</font>
  <div class="center">
    <div class="pagination">
      <center>
        <?php
        if ($pages > 0) {
          $count = 1;
          while ($count <= $pages) {

            if ($count == $cpage) {
              $echo = "<a href=\"index.php?act=cat&catid=$catid&page=$count\" class=\"active\"><font color=\"green\">$count</font></a>";
            } else {
              $echo = "<a href=\"index.php?act=cat&catid=$catid&page=$count\">$count</a>";
            }


            echo $echo;
            $count++;
          }
        }
        ?>
    </div>
  </div>
  </center>