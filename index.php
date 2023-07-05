<?php

define('_MATAN', 1);

include("conf.php");
require 'meta.php';
$meta = new meta;



$act = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';
switch ($act) {
    default:
        $title = $meta->getPageTitle($act);
        $descadd = $meta->getPageDesc($act);
        break;
}

if ($act == "singer") {
    $ids = $_GET['id'];
    $resq = mysqli_query($link, "SELECT * FROM singers WHERE id='$ids'");
    $rq = mysqli_fetch_array($resq);
    $description = "{$rq['keywords']} - צלצולים חדשים להורדה בחינם באתר תוכלו להוריד צלצולים הכי חדשים הכי חמים והכי לוהטים של הזמר " . $rq['keywords'];
    $keywords = "{$rq['keywords']}, צלצולים להורדה, צלצולים, רינגטונים, רינגטון, להורדה בחינם, צלצולים חדשים, שירים להורדה";
} else {
    $description = "צלצולים להורדה בחינם במהירות וביעילות! באתר תוכלו להוריד צלצולים, רינגטונים הכי חדשים הכי חמים ממגוון הז'אנרים להורדה בחינם!";
    $keywords = "צלצולים, צלצולים לאייפון, אנדרואיד, פלאפון, סלולרי, מזרחית, דיכאון, דודו אהרון, אייל גולן, משה פרץ, פאר טסי, עומר אדם, עדן בן זקן, צלצול";
}
if ($act == "howto") {
    $description = "רינג מי - איך להוריד צלצולים להורדה לאייפון ולאנדרואיד בחינם לגמרי בחינם!";
    $keywords = "איך להוריד צלצולים, צלצולים להורדה, צלצולים לאייפון, צלצולים לאנדרואיד, צלצולים בחינם";
}
if ($act == "ask") {
    $description = "רינג מי - חיפשתם צלצולים להורדה באתר ולא מצאת? בקשו אותו עכשיו בחינם!";
    $keywords = "צלצולים, צלצולים להורדה, צלצולים לאייפון, צלצולים לאנדרואיד, צלצולים בחינם";
}

if ($act == "searchs") {
    $description = "רינג מי - חפשו צלצולים להורדה בחינם ללא צורך בהרשמה למכשירי האייפון והאנדרואיד!";
    $keywords = "צלצולים, צלצולים להורדה, צלצולים לאייפון, צלצולים לאנדרואיד, צלצולים בחינם";
}

if ($act == "iphone") {
    $description = "רינג מי - צלצולים להורדה בחינם מותאמים למכשירי האייפון, מגוון רחב של צלצולים חדשים ומורדים ברחבי האינטנרט!";
    $keywords = "צלצולים, צלצולים להורדה, צלצולים לאייפון, iphone צלצולים";
}

if ($act == "tops") {
    $description = "רינג מי - 30 הצלצולים הגדולים הכי חדשים הכי חמים והכי מורדים להורדה בחינם! צלצולים 2022 להורדה";
    $keywords = "צלצולים, צלצולים להורדה, צלצולים לאייפון, צלצולים לאנדרואיד, צלצולים בחינם, צלצולים חדשים";
}

$act = $act;
if ($act == "download") {
    $songid = $_GET['songid'];
    header("Location: https://www.ringme.co.il/song-{$songid}.html");
}

if ($act == "player")
    include("pages/blocks/player.php");

if ($act == "report") {
    $description = "";
    $keywords = "";
} else if ($act == "cat") {
    $catid = $_GET['catid'];
    $tes = mysqli_query($link, "SELECT `name` FROM `category` WHERE `id`='$catid'");
    $t = mysqli_fetch_array($tes);
    $description = "רינג מי - צלצולים להורדה לאייפון ולאנדרואיד בחינם - קטגוריית צלצולים " . $t['name'];
    $keywords  = "צלצולים להורדה, {$t['name']}, צלצולים לאייפון, צלצולים לאנדרואיד, פלאפון, סלולרי, אייל גולן, משה פרץ, פאר טסי, עדן בן זקן, עומר אדם, דודו אהרון, רינגטונים";
} else if ($act == "youtube") {
    $description = "ברוכים הבאים לעמוד הורדת השירים מיוטיוב, בעמוד זה תוכלו להוריד שירים מיוטיוב. ברינג מי תוכלו להוריד שירים מיוטיוב בחינם ללא כל צורך בהרשמה במהירות וביעילות!";
    $keywords = "הורדת שירים מיוטיוב, להורדה, לאייפון, יוטיוב, שירים ביוטיוב, הורדה מיוטיוב, הורדת שיר ביוטיוב, עומר אדם, משה פרץ, אייל גולן, צלצולים להורדה, YouTube";
} else if ($act == "bigbrother") {
    $description = "האח הגדול 2023 לצפייה ישירה שידור חי ישיר ערוץ 13 וגם ערוץ 26 במיוחד בשבילכם לצפייה ישירה ללא פרסומות בכלל בחינם!";
    $keywords = "האח הגדול, 2023, לייב, שידור חי, שידור ישיר, האח הגדול לייב, האח הגדול לצפייה, שניר, ספיר, סתיו, אברהם, לצפייה ישירה, צפייה ישירה, האח הגדול לצפייה ישירה, YouTube";
}


if (!isset($_GET['page'])) {
    $titles = $title;
} else {
    $idpage = (isset($_GET['page']) && !empty($_GET['page']));
    $titles = $title . " - עמוד " . $idpage;
}

include("security.php");


if ($_SERVER["QUERY_STRING"] == "" or $_SERVER["QUERY_STRING"] == "act=ask") {
    $qcode = '<script src="https://code.jquery.com/jquery-3.4.1.js"></script>';
}

$stylese = "";
if ($_SERVER["QUERY_STRING"] == "act=ringtones") {
    $qcode = '<script src="https://code.jquery.com/jquery-3.4.1.js"></script>';
    $stylese = "
<style>
svg{
  width: 100px;
  height: 100px;
  display:inline-block;
}
ajax-loader {
    display: block;
    text-align: center;
}
.ajax-loader img {
    width: 50px;
    vertical-align: middle;
}
</style>
";

    $javas = '    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
';
} else {
    $javas = '    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
';
}

?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
<html dir="rtl" lang="he">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115519910-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-115519910-1');
    </script>
    <title><?php echo $titles; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <!-- <base href="https://www.ringme.co.il/"> -->
    </base>
    <meta name='robots' content='index, follow' />
    <meta name="keywords" content="<?php echo $keywords ?>" />
    <meta name="description" content="<?php echo $description ?>" />
    <meta name="google-site-verification" content="kDFfnAjTs1xZ8Drc_e6175KBA-yKU7iCZx8a_AoAkgY" />
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- <link rel="canonical" href="<?php echo $_SERVER["SCRIPT_URI"]; ?>" /> -->
    <meta property="og:title" content="<?php echo $titles ?>" />
    <meta property="og:description" content="<?php echo $description ?>" />
    <!-- <meta property="og:url" content="<?php echo $_SERVER["SCRIPT_URI"]; ?>" /> -->
    <meta property="og:site_name" content="צלצולים" />
    <meta property="og:type" content="website" />
    <link rel="stylesheet" href="stylemobile.css" type="text/css" />
    <?php echo $javas; ?>
    <?php
    if ($_SERVER["QUERY_STRING"] != "act=ringtones") {
    ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-8382417683683617",
                enable_page_level_ads: true
            });
        </script>
    <?php
    }
    ?>
    <?php echo $stylese; ?>
</head>

<body>
    <?php
    $complete_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <a class="to-page-top" href="<?php echo $complete_url ?>#">
        <img src="img/svg/arrow-up.svg">
    </a>

    <?php
    require_once "body.php";
    include("copyright.php");
    ?>

</body>

</html>

<?php
if ($_SERVER["QUERY_STRING"] == "act=ringtones") {
?>
    <script type="text/javascript">
        $(document).ready(function() {
            windowOnScroll();
        });

        function windowOnScroll() {
            $(window).on("scroll", function(e) {
                const offset = 100;
                if ($(window).scrollTop() >= $(document).height() - $(window).height() - offset) {
                    if ($(".ringtone").length < $("#total_count").val()) {
                        var lastId = $(".ringtone:last").attr("id");
                        getMoreData(lastId);
                    }
                }
            });
        }

        function getMoreData(lastId) {
            $(window).off("scroll");
            $.ajax({
                url: 'getMoreData.php?lastId=' + lastId,
                type: "get",
                beforeSend: function() {
                    $('.ajax-loader').show();
                },
                success: function(data) {
                    setTimeout(function() {
                        $('.ajax-loader').hide();
                        $("#post-listt").append(data);
                        windowOnScroll();
                    }, 1000);
                }
            });
        }
    </script>
<?php
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        function attachPlayEventToPlayButtons(playButtons) {
            playButtons.forEach(el => el.addEventListener('click', function() {
                const isThisPlaying = el.querySelector('img').getAttribute('src').includes('pause') ? true : false;
                pauseMusic();
                // set pause
                const thisImage = this.querySelector('img');
                if (isThisPlaying) {
                    thisImage.setAttribute('src', './img/svg/play.svg');
                } else {
                    // remove pause icon from all
                    document.querySelectorAll('.play img').forEach(pl => pl.setAttribute('src', './img/svg/play.svg'));
                    thisImage.setAttribute('src', './img/svg/pause.svg');
                    setTimeout(() => {
                        playMusic(this);
                    }, 100);
                }
            }));
        }

        function pauseMusic() {
            document.querySelectorAll('audio').forEach(au => {
                au.pause()
                au.currentTime = 0;
            });
        }

        function playMusic(el) {
            el.querySelector('audio').play();
        }

        // whatsapp
        const whatsapp = document.querySelector('.whatsapp');
        window.addEventListener('scroll', function() {
            console.log('scrolling')
            if (window.pageYOffset > 100 && !scrollToTop.classList.contains('show')) {
                whatsapp.classList.add('show');
            } else if (window.pageYOffset <= 100 && scrollToTop.classList.contains('show')) {
                whatsapp.classList.remove('show');
            }
        });


        // handle scroll to top
        const scrollToTop = document.querySelector('.to-page-top');
        window.addEventListener('scroll', function() {
            console.log('scrolling')
            if (window.pageYOffset > 100 && !scrollToTop.classList.contains('show'))
                scrollToTop.classList.add('show');

            else if (window.pageYOffset <= 100 && scrollToTop.classList.contains('show'))
                scrollToTop.classList.remove('show');
        });
        $(function() {
            $(".to-page-top").on('click', function() {
                $("HTML, BODY").animate({
                    scrollTop: 0
                }, 120);
            });
        });

        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };

        $("#search").on('keyup', debounce(function(e) {
            const query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: 'ajax-db-search.php',
                    method: 'POST',
                    data: {
                        query
                    },
                    success: function(data) {
                        $('#output').html(data);
                        $('#output').css('display', 'block');
                        const playButtons = document.querySelectorAll('#output .play');
                        attachPlayEventToPlayButtons(playButtons);
                    }
                });
            } else {
                $('#output').css('display', 'none');
            }
        }, 300));

        $("#search").focusin(function() {
            $('#output').css('display', 'block');
        });

        const dropdownHeadlines = document.querySelectorAll('.dropdown-headline'),
            dropdowns = document.querySelectorAll('.dropdown');


        // on hover, add class open
        dropdowns.forEach(el => {
            el.addEventListener('click', function() {
                this.querySelector('.dropdown-content').classList.toggle('open');
            });


            document.addEventListener('click', function(event) {
                var isClickInside = el.contains(event.target);
                if (!isClickInside) {
                    el.querySelector('.dropdown-content').classList.remove('open');
                }
            });
        });
        const playButtons = document.querySelectorAll('.play');
        attachPlayEventToPlayButtons(playButtons);
    });
    <?php
    if ($_SERVER["SCRIPT_URL"] == "/send.html" or $_SERVER["SCRIPT_URL"] == "/") {
    ?>
        const searchInput = document.querySelector('.search-input'),
            searchContainer = document.querySelector('.search'),
            dropdownHeadlines = document.querySelectorAll('.dropdown-headline'),
            dropdowns = document.querySelectorAll('.dropdown');

        searchInput.addEventListener('focus', function() {
            searchContainer.classList.add('focused');
        })

        searchInput.addEventListener('focusout', function() {
            searchContainer.classList.remove('focused');
        })

        searchContainer.addEventListener('click', function() {
            searchInput.focus();
        })
    <?php } ?>
</script>
</html>