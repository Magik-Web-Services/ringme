<?php
if(isset($_GET['path']))
{
    $path = $_GET['path'];
     $name = $_GET['name'];
$ch = curl_init($path);
        $fp = fopen("ring/$name", 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
}
?>