<?php
$act = $_GET['act'];
  switch($act)
  {	
    case 'settings':
	    include ("pages/settings.php");
                  break;
    case 'members':
	    include ("pages/members.php");
                  break;
    case 'orders':
	    include ("pages/orders.php");
                  break;
    case 'group':
	    include ("pages/groups.php");
                  break;
    case 'songs':
	    include ("pages/songs.php");
                  break;
    case 'cats':
	    include ("pages/cats.php");
                  break;
    case 'articles':
	    include ("pages/articles.php");
                  break;
    case 'blocks':
	    include ("pages/blocks.php");
                  break;
    default:
                  include ("pages/main.php");
                  break;             
  }
