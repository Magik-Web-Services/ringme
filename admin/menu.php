<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">

<head>
  <title>תפריט</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://www.ringme.co.il/admin/pages/stylesheet.css" type="text/css" />
  <style>
    body {
      color: black;
      font-family: Arial;
      font-size: 11px;
      padding: 0px;
      margin: 10px;
      background-color: #00213f;
      background: url(bg.gif) repeat-x;
    }

    body {
      height: 100%;
      overflow-y: hidden;
    }
  </style>
</head>

<body style="background-image: url('images/background.png'); background-repeat:repeat-x; margin-left: 0; margin-top: 0;" onload="startTime()">

  <br><br><br><br>

  <br /><br />
  ברוכים הבאים מנהלים,
  <br>
  <u>תאריך:</u> <php echo date("d/m/Y"); ?>
  <br>
  <u>שעה:</u>
  <div id="txt"></div>
  <script>
    function startTime() {
      const today = new Date();
      let h = today.getHours();
      let m = today.getMinutes();
      let s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
      setTimeout(startTime, 1000);
    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i
      }; // add zero in front of numbers < 10
      return i;
    }
  </script>

  <br />

  <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #992a2a;background-color:#f2dddd">
    <tr>
      <td class="TableCat" align="center"><img src="images/logout.gif" style="vertical-align:middle"> <a href="../admin.php?act=logout">
          <font color='#ad1010'>התנתק מהמערכת</font>
        </a></td>
    </tr>
  </table>
  <br />
  <?php
  include "../conf.php";
  $admin = $_SESSION['ad_user'];
  $tes = mysqli_query($link, "SELECT * FROM `members` WHERE `user` = '{$admin}'");
  $r = mysqli_fetch_array($tes);

  if ($r["group"] <= "1") {



    $pages = mysqli_query($link, "SELECT * FROM orders");
    $num_rows = mysqli_num_rows($pages);
    $bakss = $num_rows;

    if ($bakss == "0") {
      $baksss = "<font color='green'>(<b>0</b>)</font>";
    } else {
      $baksss = "<font color='red'>(<b>" . $bakss . "</b>)</font>";
    }
  ?>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/icon-settings.gif" style="vertical-align:middle"> הגדרות CMS</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/settings.php' target='frame1'>הגדרות כלליות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/main.php' target='frame1'>סטטיסטיקות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/blocks.php' target='frame1'>ניהול דפי האתר</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/setoff.php' target='frame1'>כיבוי/הפעלת המערכת</td>
      </tr>
    </table>
    <br>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/package.png" style="vertical-align:middle"> ניהול צלצולים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/songs.php' target='frame1'>רשימת שירים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/cats.php' target='frame1'>רשימת קטגוריות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/orders.php' target='frame1'>בקשות שירים <php echo $baksss; ?></td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='pages/songs.php?act=songs&do=add' target='frame1'>הוספת שיר</td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='http://upload.ringme.co.il/index778454.php' target='frame1'>הוספה חדשה</td>
      </tr>
      <tr>
        <td class="SubTableCat">--- <a href='pages/songs.php?act=songs&do=hot' target='frame1'>הצלצולים החמים</td>
      </tr>
    </table>

    <br>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/basket.png" style="vertical-align:middle"> ניהול זמרים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/singers.php' target='frame1'>רשימת זמרים</td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='pages/singers.php?act=singers&do=add' target='frame1'>הוספת זמר</td>
      </tr>
    </table>

    <br>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="https://www.ringme.co.il/images/direction.png" style="vertical-align:middle"> ניהול דיווחים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/reports.php' target='frame1'>רשימת דיווחים</td>
      </tr>
    </table>

    <br>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/key.gif" style="vertical-align:middle"> אדמינים וצוות האתר</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/members.php' target='frame1'>ניהול צוות האתר</td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='pages/members.php?act=members&do=add' target='frame1'>הוספת איש צוות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/groups.php' target='frame1'>ניהול דרגות</td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='pages/groups.php?act=groups&do=add' target='frame1'>הוספת דרגה</td>
      </tr>
    </table>
  <?php
  } else {

    $pages = mysqli_query($link, "SELECT * FROM orders");
    $num_rows = mysqli_num_rows($pages);
    $bakss = $num_rows;

    if ($bakss == "0") {
      $baksss = "<font color='green'>(<b>0</b>)</font>";
    } else {
      $baksss = "<font color='red'>(<b>" . $bakss . "</b>)</font>";
    }
  ?>
    <br />
    ברוך הבא יובל!
    <br />
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/icon-settings.gif" style="vertical-align:middle"> הגדרות CMS</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/settings.php' target='frame1'>הגדרות כלליות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/main.php' target='frame1'>סטטיסטיקות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/stats.php' target='frame1'>מיני סטטיסטיקות</td>
      </tr>
    </table>
    <br>
    <table cellpadding='2' cellspacing='1' width='90%' border='0' style="padding:1px;border:1px solid #334d65;background-color:#00213f">
      <tr>
        <td class="TableCat" align="right"><img src="images/package.png" style="vertical-align:middle"> ניהול צלצולים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/songs.php' target='frame1'>רשימת שירים</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/cats.php' target='frame1'>רשימת קטגוריות</td>
      </tr>
      <tr>
        <td class="SubTableCat">&middot; <a href='pages/orders.php' target='frame1'>בקשות שירים <php echo $baksss; ?></td>
      </tr>
      <tr>
        <td class="SubTableCat">-- <a href='pages/songs.php?act=songs&do=add' target='frame1'>הוספת שיר</td>
      </tr>
    </table>
  <?php
  }
  ?>
</body>

</html>