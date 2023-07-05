<?php
defined('_MATAN');
include('../conf.php');
?>

<?php include('blocks/navigation.php'); ?>
<link rel="stylesheet" href="../stylemobile.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../Stylefrom.css">
<main>

  <?php
  $ved = (isset($_GET['v']) && !empty($_GET['v'])) ? $_GET['v'] : '';
  if ($ved == "") {
  ?>
    <br />
    <div class="tgreen smallspace">
      <h2>הורדת שירים מיוטיוב</h2>
    </div><br />
    ברוכים הבאים לעמוד הורדת השירים מיוטיוב, בעמוד זה תוכלו להוריד <b>שירים מיוטיוב</b>.<br />
    כיום, יוטיוב מאפשרת לצפות בשירים חדשים וישנים כאחד באתר שלה, ברינג מי תוכלו להוריד <b>שירים מיוטיוב</b> בחינם ללא כל צורך בהרשמה במהירות וביעילות.
    מעבר לכך שרינג מי מאפשרת לכם <a href="https://www.ringme.co.il/">צלצולים להורדה</a> בחינם.

    <br />
    כל מה שתצטרכו לעשות זה פשוט מאוד - לקחת את כתובת הסרטון ולהדביק אותו בחלון כאן למטה.<br />
    לאחר מכן - לחצו Convert, מיד תתחיל הורדת השיר מיוטיוב, צפייה מהנה!
    <br />


    <iframe src="https://demo9.codehap.in/" style="border:none;width:100%;height: 320px;" class="iframe"></iframe>


  <?php
  } else {
  ?>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $ved; ?>" frameborder="0" allowfullscreen></iframe>
  <?php
  }
  ?>