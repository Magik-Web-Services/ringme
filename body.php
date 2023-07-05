<?php
defined('_MATAN');

$act = (isset($_GET['act']) && !empty($_GET['act'])) ? $_GET['act'] : '';
	if(isset($act))
	{
		$check = preg_match("/send|cat|report|howto|ask|iphone|singer|tops|ringtones|youtube|bigbrother/",$act);
		if($check == true)
		{
			if($act == "send")
				$name = "send";
			else if($act == "cat")
				$name = "cat";
			else if($act == "tops")
				$name = "tops";
			else if($act == "ringtones")
				$name = "ringtones";
			else if($act == "youtube")
				$name = "youtube";
			else if($act == "bigbrother")
				$name = "bigbrother";
			else if($act == "report")
				$name = "report";
			else if($act == "howto")
				$name = "howto";
			else if($act == "ask")
				$name = "ask";
			else if($act == "iphone")
				$name = "iphone";
			else if($act == "searchs")
				$name = "searchs";
			else if($act == "singer")
				$name = "singer";
		} else $name = "main";
	} else {
		$name = "main";
	}
	$filename = "pages/".$name.".php";
	if (file_exists($filename)) {
	$name = $name;
	} else {
	$name = "main";
	}
	require_once "pages/".$name.".php";
?>