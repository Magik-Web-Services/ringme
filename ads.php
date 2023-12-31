<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="he" lang="he" dir="rtl">
<html dir="rtl" lang="he">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <style>
    /* Center the loader */
    #loader {
      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 1;
      width: 150px;
      height: 150px;
      margin: -75px 0 0 -75px;
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
      }

      100% {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    /* Add animation to "page content" */
    .animate-bottom {
      position: relative;
      -webkit-animation-name: animatebottom;
      -webkit-animation-duration: 1s;
      animation-name: animatebottom;
      animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
      from {
        bottom: -100px;
        opacity: 0
      }

      to {
        bottom: 0px;
        opacity: 1
      }
    }

    @keyframes animatebottom {
      from {
        bottom: -100px;
        opacity: 0
      }

      to {
        bottom: 0;
        opacity: 1
      }
    }

    #myDiv {
      display: none;
      text-align: center;
    }
  </style>
</head>

<body onload="myFunction()" style="margin:0;">

  <div id="loader"></div>

  <div style="display:none;" id="myDiv" class="animate-bottom">
    <h2>מעולה!</h2>
    <p>עכשיו תחזרו לדף הקודם ותלחץ שוב הורדה. תהנו!</p>
  </div>

  <script>
    var myVar;

    function myFunction() {
      myVar = setTimeout(showPage, 10000);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
    }
  </script>
  <br /><Br />

  <h2>
    להורדת הצלצול לחץ על הפרסומות</h2>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- urikas -->
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8382417683683617" data-ad-slot="8495377285" data-ad-format="auto"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</body>

</html>