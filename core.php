<?php
//https://lookup-id.com/
//https://developers.facebook.com/tools/explorer/?pnref=story
ini_set('max_execution_time', 60 * 10000);

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

include 'imgrec.php';
include 'api.php';
include 'initDatabase.php';
include 'loadmore.php';
include 'processpost.php';
include 'webpagefunctions.php';

$lang = 'ar';
if(isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en')
	$lang = 'en';

$access_token = 'EAACEdEose0cBAI5CLNjpUg1tzFBLJTXsFxXYNQ1mZAby9khiD22mO6b3m1aOZB6mZAidiXB17iLj8AlcBEaptwmFimSWuEjNEti6dpZAXq1xGKSwqfhSsyMY3XaVWZAwZCLxr667JrXLZA9Tn9UOkjR96DIO9M2aBClYEHUtogBskJ4Wmkl5iqyuVsXI2EdvQYZD';

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function curPageURL() {
	$pageURL = 'http';
	//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = substr($pageURL, 0, strpos($pageURL, "?"));
	return $pageURL;
}
