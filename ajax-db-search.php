<?php
$servername = 'localhost';
$username = '';
$password = '';
$dbname = "";
$conn = mysqli_connect($servername, $username, $password, "$dbname");
mysqli_set_charset($conn, "utf8");
if (!$conn) {
    die('Could not Connect MySql Server:' . );
}

if (isset($_POST['query'])) {
    $strr = $_POST['query'];

    $words = explode(' ', $strr);
    $words = array_filter($words);
    $regex = implode('|', $words);

//    $query = "SELECT * FROM songs WHERE name REGEXP '{$regex}' OR artist REGEXP '{$regex}' order by (name LIKE '%$strr%')  DESC LIMIT 6";
    $query = "SELECT *, CONCAT(name, ' ', artist, ' ', text) as full_name FROM songs WHERE ";
    $flag = 1;
    foreach ($words as $word) {
        if ($flag === 1) {
            $query .= " CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($word) . "%'";
        } else {
            $query .= " AND CONCAT(name, ' ', artist, ' ', text) LIKE '%" . ($word) . "%'";
        }
        $flag++;
    }
    $query .= " order by (name LIKE '%$strr%') DESC LIMIT 6";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

            echo <<<END
<script type="text/javascript">
$(function() {
$('html, body').animate({ scrollTop: $('#grid').offset().top - 200}, 1300);
});
</script>
END;


        echo "<img src='./images/searchloading.gif'><h2>מצאנו עבורך צלצול באתר..</h2>";
echo ' <div id="grid"></div> <div class="ringtones-list">';
        while ($user = mysqli_fetch_array($result)) {


            $newstr = $user['name'];
            $newstra = $user['artist'];
            $strrra = $newstra;
            $strrr = $newstr;

            echo <<<END
<div class="ringtone">
<a href="./song-{$user['id']}.html" class="link-to-ringtone"></a>
            <div class="text">
              <div class="song">{$strrr}</div>
              <div class="artist">{$strrra}</div>
            </div>

            <div class="icons">
              <div class="play">
                <audio id="myAudio">
                  <source src="./{$user['url']}" type="audio/mpeg">
                </audio>
                <img src="./img/svg/play.svg" alt="נגן">
              </div>
              <div class="download">
                <a href="/song-{$user['id']}.html">
                  <img src="./img/svg/download.svg" alt="הורד">
                </a>
              </div>
            </div>
          </div>

END;
        }
echo '</div>';
    } else {

        $query = "SELECT * FROM songs WHERE name LIKE '%$strr%' OR artist LIKE '%$strr%' ORDER BY id DESC LIMIT 6";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $newstr = $user['name'];
            $newstra = $user['artist'];
            $strrra = $newstra;
            $strrr = $newstr;

            echo <<<END


נא להקליד טקסט בחיפוש


END;


        } else {
            echo "<h2>הצלצול לא נמצא באתר..</h2>בקש אותו <a href='https://www.ringme.co.il/send.html'>כאן</a>";
        }

    }
    echo "<br /><br /><br />";
}
?>