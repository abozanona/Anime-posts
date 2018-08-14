<?php
require_once '../core.php';
require_once '../elasticsearch/vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'size' => 5000,
    'index' => 'conan',
    'type' => 'post',
    'body' => [
        'query' => [
            'bool' => [
                'must' => ['match' => ['isVideo' => true]]

            ]
        ]
    ]
];
$query = $client->search($params);
$query = $query['hits']['hits'];
//echo '<pre>', print_r($query), '</pre>';

//exit(0);
foreach ($query as $key) {
	$source = $key['_source'];
	$id = $key['_id'];

	$url = 'https://graph.facebook.com/'.$source['object_id'].'?access_token='.$access_token;
	$json_object = @file_get_contents($url);
	if(!$json_object)
		continue;
	$fbdata = json_decode($json_object);

	$newlink = $fbdata->source;
	$source['videos'][0] = $newlink;

	$indexed = $client->index([
		'index' => 'conan',
		'type' => 'post',
		'id' => $id,
		'body' => $source
	]);
}

