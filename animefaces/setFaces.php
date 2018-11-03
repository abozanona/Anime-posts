<?php

if(isset($_GET['file'], $_GET['name'])){
	$rand = md5(microtime());
	$path = '/var/www/html/animefaces';
	$command = "sudo su www-data 2>&1;mv '$path/{$_GET['file']}' '$path/dataSet2/{$_GET['name']}-$rand-img.jpg' 2>&1; rm '$path/{$_GET['file']}' 2>&1;";
	exec($command, $result);
	echo '<pre>',print_r($result),'</pre><br/>';
	echo $command.'<br/><br/><br/><br/>';
}

require_once '../elasticsearch/vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();;

$images = glob("dataSet/*.*");

$query = $client->search([
	'size' => 1000,
	'index' => 'conan',
	'type' => 'tag',
]);
$query = $query['hits']['hits'];
$names = [];
foreach ($query as $key) {
	$names[] = $key['_id'];
}
//echo '<pre>', print_r($names), '</pre>';

$image = $images[0];

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

echo '<br/><br/><br/>';

foreach($names as $key)
	echo "<a style='display:inline-block;padding:6px; margin:6px; background:#ccc;border-radius: 2px;' href='http://animeposts.com/animefaces/setFaces.php?name=$key&file=$str'>$key</a>";


$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'];
echo $url;
