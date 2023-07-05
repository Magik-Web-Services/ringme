<?php
include "conf.php";
$links = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : '';


$id = intval($links);
$query = "SELECT * FROM `songs`";
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $query .= " WHERE id='$id'";
}
$res = mysqli_query($link, $query);
$r = mysqli_fetch_array($res);
$songname = $r['name'];
$art = $r['artist'];
$down = $r['downloads'];

$titles = "{$songname} - {$art}";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
<html dir="rtl" lang="he">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="https://fonts.googleapis.com/css?family=Arimo:400,700&display=swap" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="Stylefrom.css" />
  <link rel="stylesheet" href="stylemobile.css" />
  <title>שליחת צלצול <?php echo $titles; ?></title>
</head>

<body style="text-align:right; direction:rtl;">
  <?php include("pages/blocks/navigation.php") ?>
  <main style="height: auto !important;">
    <div class="search">
      <img src="./img/svg/search.svg" alt="חיפוש" height="30px">
      <input type="text" name="search" id="search" placeholder="חיפוש צלצול מהיר..." class="search-input">
    </div>
    <div class="google-auto-placed" style="width: 100%; height: auto; clear: both; text-align: center;"><ins data-ad-format="auto" class="adsbygoogle adsbygoogle-noablate" data-ad-client="ca-pub-8382417683683617" data-adsbygoogle-status="done" style="display: block; margin: 10px auto; background-color: transparent; height: 280px;" data-ad-status="filled">
        <div id="aswift_1_host" tabindex="0" title="Advertisement" aria-label="Advertisement" style="border: none; height: 280px; width: 1100px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block; overflow: visible;"><iframe id="aswift_1" name="aswift_1" style="left:0;position:absolute;top:0;border:0;width:1100px;height:280px;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" width="1100" height="280" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-8382417683683617&amp;output=html&amp;h=280&amp;adk=831349796&amp;adf=3247881204&amp;pi=t.aa~a.3741499782~rp.1&amp;w=1100&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1688547872&amp;rafmt=1&amp;to=qs&amp;pwprc=3487266656&amp;format=1100x280&amp;url=https%3A%2F%2Fwww.ringme.co.il%2Fsend.html&amp;fwr=0&amp;pra=3&amp;rpe=1&amp;resp_fmts=3&amp;wgl=1&amp;fa=40&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTE0LjAuNTczNS4xOTkiLFtdLDAsbnVsbCwiNjQiLFtbIk5vdC5BL0JyYW5kIiwiOC4wLjAuMCJdLFsiQ2hyb21pdW0iLCIxMTQuMC41NzM1LjE5OSJdLFsiR29vZ2xlIENocm9tZSIsIjExNC4wLjU3MzUuMTk5Il1dLDBd&amp;dt=1688547872190&amp;bpp=1&amp;bdt=100&amp;idt=126&amp;shv=r20230627&amp;mjsv=m202306260101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D980b890929b6c826-22c3cdd4b1b4005b%3AT%3D1688547837%3ART%3D1688547837%3AS%3DALNI_Mb-3cxj9Zg1Se5IIMfk5d0sKji_cQ&amp;gpic=UID%3D00000c969abd2fc8%3AT%3D1688547837%3ART%3D1688547837%3AS%3DALNI_MY2ZdHZzt5nw2uWchmNWK83WNSYQQ&amp;prev_fmts=0x0&amp;nras=2&amp;correlator=7490299335821&amp;frm=20&amp;pv=1&amp;ga_vid=1962251557.1688547832&amp;ga_sid=1688547872&amp;ga_hid=1877656225&amp;ga_fc=1&amp;u_tz=330&amp;u_his=4&amp;u_h=1080&amp;u_w=1920&amp;u_ah=1040&amp;u_aw=1920&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=410&amp;ady=214&amp;biw=1920&amp;bih=969&amp;scr_x=0&amp;scr_y=0&amp;eid=44759875%2C44759926%2C44759842%2C31075720%2C44788442%2C21065724&amp;oid=2&amp;pvsid=1976294975966826&amp;tmod=1779547493&amp;uas=0&amp;nvt=1&amp;ref=https%3A%2F%2Fwww.ringme.co.il%2F&amp;fc=1920&amp;brdim=0%2C0%2C0%2C0%2C1920%2C0%2C1920%2C1040%2C1920%2C969&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;xpc=z5VTcEsHV7&amp;p=https%3A//www.ringme.co.il&amp;dtd=129" data-google-container-id="a!2" data-google-query-id="CKfimoOb9_8CFffKfAodnasACg" data-load-complete="true"></iframe></div>
      </ins></div>
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
    <br>
    <h2>חפש/בקש צלצול אונליין</h2>
    <form method="post" action="">
      <input type="text" name="artist" placeholder="שם האמן..." class="askForRingtone">
      <input type="text" name="song" placeholder="שם השיר..." class="askForRingtone">

      <input type="submit" name="submit" placeholder="" class="askForRingtonesub" value="חפש/בקש צלצול">
    </form>





    <div class="footer">
      הזכויות שמורות לאתר 2011-2023 RingMe.co.il המאפשר <b><a href="https://www.ringme.co.il/">צלצולים</a></b> להורדה
      | <a href="./youtube.html">הורדת שירים מיוטיוב</a> | <a href="./bigbrother.html">האח הגדול שידור חי</a>
    </div>
  </main>
</body>

</html>