<?php
if(!isset($_POST['param']))exit(0);

$string = $_POST['param'];


require_once 'elasticsearch/vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$isExist = $client->index([
        'index' => 'grad',
        'type' => 'check',
	'body' => ['text' => $string]          
]);

print_r($isExist);
