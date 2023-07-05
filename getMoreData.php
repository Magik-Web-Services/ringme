<?php
require_once('conf.php');

$lastId = $_GET['lastId'];
$sqlQuery = "SELECT * FROM songs WHERE id < '" .$lastId . "' ORDER BY id DESC LIMIT 10";

$result = mysqli_query($link, $sqlQuery);


while ($row = mysqli_fetch_assoc($result))
 {
    $content = substr($row['text'],0,100);

echo<<<END
        <div class="ringtone" id="{$row['id']}">
	<a href="./song-{$row[id]}.html" class="link-to-ringtone"></a>
          <div class="text">
            <div class="song">{$row['name']}</div>
            <div class="artist">{$row['artist']}</div>
          </div>

          <div class="icons">
            <div class="play">
              <audio>
                <source src="./{$row[url]}" type="audio/mpeg">
              </audio>
              <img src="./img/svg/play.svg" alt="נגן">
            </div>
            <div class="download">
              <a href="./song-{$row[id]}.html"{$popup}>
                <img src="./img/svg/download.svg" alt="הורד">
              </a>
            </div>
          </div>
        </div>

END;
}
?>