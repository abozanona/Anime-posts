<?php
require_once 'elasticsearch/vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();


$img = [];
$img[] = 'https://scontent.xx.fbcdn.net/v/t1.0-9/s720x720/17903982_1420967774608950_8257484233451339653_n.jpg?oh=b32ed3b7c456f76a02863076785faf86&oe=5996D16C';
$img[] = 'https://scontent.xx.fbcdn.net/v/t1.0-9/17884573_113401439210984_8014694295722493448_n.jpg?oh=79a0707a6383094d9320c247d1a683e8&oe=59843B4A';
$img[] = 'https://scontent.xx.fbcdn.net/v/t1.0-9/s720x720/17862501_1155724081223383_5657383136555687945_n.jpg?oh=c2733977e257ab8994df16c6ba69370b&oe=5996E439';



/*
foreach($img as $i=>$j){
	$base64 = base64_encode(file_get_contents($j));
	$res = $client->index([
	        'index' => 'conan',
	        'type' => 'imagerec',
	        'body' => ['my_img' => $base64, 'title' => '123']
	]);
	echo '<pre>', print_r($res), '</pre>';
}

exit(0);
*/
$params = [
	'index' => 'conan',
	'type' => 'imagerec',
	'body' => [
		'query' => [
			"image" => [
		            "my_img" => [
		                "feature" => "CEDD",
	        	        "image" => base64_encode(file_get_contents($img[0]))/* 'QSkZJRgABAgAAAQABAA'*/,
	        	        "hash" => "BIT_SAMPLING",
	        	        "boost" => 2.1,
	                	"limit" => 100
	            	    ]
        		]
		]
	]
];
$query = $client->search($params);
echo '<pre>', print_r($query), '</pre>';
