<?php

if(!isset($_GET['id']))
	exit(0);

$id = $_GET['id'];



$str = '/usr/bin/curl -Ls -b /tmp/cookies -w %{url_effective} -o /dev/null "https://drive.google.com$(/usr/bin/curl -c /tmp/cookies "https://drive.google.com/uc?export=download&id=0B43CDOqEUHyfQndoV0NFb0lpZUU" | /bin/grep -Po \'uc-download-link" [^>]* href="\K[^"]*\' | /bin/sed \'s/\&amp;/\&/g\')" 2>&1';


//$str = "sudo su root && whoami 2>&1";

$x = exec($str, $y, $z);

echo '<pre>', print_r($x), '</pre>';
echo '<pre>', print_r($y), '</pre>';
echo '<pre>', print_r($z), '</pre>';
