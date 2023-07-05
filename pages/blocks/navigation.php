<div class="header">
    <div class="logo">
        <a href="<?php echo MAIN_DIR; ?>">
            <img src="<?php echo MAIN_DIR ?>img/logo.png" alt="צלצולים">
        </a>
    </div>

    <div class="header-menu">
        <!-- Singer dropdown -->
        <div class="dropdown">
            <div class="text dropdown-headline">
                <span class="header-menu-item">אמנים</span>
                <img src="<?php echo MAIN_DIR ?>img/svg/caret-down.svg" alt="">
            </div>

            <div class="dropdown-content artists">
                <?php $res = mysqli_query($link, "SELECT * FROM `singers`"); ?>
                <?php while ($r = mysqli_fetch_array($res)) {
                echo $r['id']
                    ?>
                    <p class="dropdown-item">
                        <a href="<?php echo MAIN_DIR; ?>pages/singer.php?id='<?php $r['id'] ?>'">
                            <?= $r['name'] ?>
                        </a>
                    </p>
                <?php } ?>
            </div>
        </div>


        <div class="dropdown">
            <div class="text dropdown-headline">
                <span class="header-menu-item">קטגוריות</span>
                <img src="<?php echo MAIN_DIR ?>img/svg/caret-down.svg" alt="">
            </div>
            <div class="dropdown-content">
                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        מזרחית
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        מזרחית רמיקס
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        דיכאון
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        לועזי
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        טראנס
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/cat.php">
                        הבקשות שלכם
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/iphone.php">
                        צלצולים לאייפון
                    </a>
                </p>
                <p class="dropdown-item">
                <a href="<?php echo MAIN_DIR; ?>pages/tops.php">
                        30 הצלצולים הגדולים
                    </a>
                </p>
            </div>
        </div>



        <div class="dropdown">
            <div class="text dropdown-headline">
                <span class="header-menu-item">תפריט</span>
                <img src="<?php echo MAIN_DIR; ?>img/svg/caret-down.svg" alt="">
            </div>

            <div class="dropdown-content menu">
                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>">
                        צלצולים
                    </a>
                </p>

                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>send.php" class="ask-for-ringtone">
                        חיפוש/בקשת צלצול
                    </a>
                </p>
                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/report.php" style="color: rgb(167, 7, 7);">
                        מצאתם בעיה באתר? דווחו עליה עכשיו!
                    </a>
                </p>
                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/howto.php">
                        לא מצליחים להוריד? המדריך המלא להורדת צלצולים מהאתר!
                    </a>
                </p>

                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/ringtones.php">
                        כל הצלצולים
                    </a>
                </p>

                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/youtube.php" style="color: orange">
                        הורדת שירים מיוטיוב
                    </a>
                </p>

                <p class="dropdown-item">
                    <a href="<?php echo MAIN_DIR; ?>pages/bigbrother.php" style="color: #33ACFF">
                        האח הגדול
                    </a>
                </p>
            </div>
        </div>

    </div>
</div>