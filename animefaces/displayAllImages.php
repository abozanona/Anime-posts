<?php

$images = glob("dataSet/*.*");

//print_r($images);

foreach($images as $image) {
	$str = $image;
	
	$image = str_replace("backward","/",$image);
	$image = str_replace("dot",".",$image);
	$image = str_replace("colon",":",$image);
	$image = str_replace("where","?",$image);
	$image = str_replace("equals","=",$image);
	$image = str_replace("dataSet/","",$image);
	$image = substr($image, 0, -4);
	echo '<img src="'.strstr($image, "https").'" />';

        echo '<img src="'.$str.'" /><br />';
}
