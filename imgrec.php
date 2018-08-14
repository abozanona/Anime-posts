<?php

$jsonfile='/var/www/html/googleapi/application_default_credentials.json';
putenv("GOOGLE_APPLICATION_CREDENTIALS=$jsonfile");

/*

//abozanona
curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
//abozanona

*/

require __DIR__ . '/googleapi/vendor/autoload.php';
require_once 'elasticsearch/vendor/autoload.php';

use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Translate\TranslateClient;

$projectId = 'palrestimagecloudvision';

$client = Elasticsearch\ClientBuilder::create()->build();

function vision($imgurlArray){
	global $projectId;

	for($i=0; $i<sizeof($imgurlArray);$i++)
		$imgurlArray[$i] = file_get_contents($imgurlArray[$i]);

	# Instantiates a client
	$vision = new VisionClient([
	    'projectId' => $projectId
	]);

	# Prepare the image to be annotated
	$image = $vision->images($imgurlArray, [
	    'LABEL_DETECTION',
	    'WEB_DETECTION',
	    //'TEXT_DETECTION'
	]/*, [
		'ImageContext' => [
			'languageHints' => [
				'ar'
			]
		]
	]*/);

	$arr=[];
	//https://googlecloudplatform.github.io/google-cloud-php/#/docs/google-cloud/v0.24.0/vision/image
	# Performs label detection on the image file
	$response = $vision->annotateBatch($image);
	foreach ($response as $key) {
		$labels = $key->labels();
		$webs = $key->web()->entities();
		foreach ($webs as $web) {
			if (isset($web->info()['description']))
				$arr[] = $web->description();
		}
		foreach ($labels as $label) {
			if (isset($label->info()['description']))
				$arr[] = $label->description();
		}
	}
	return $arr;
}

function translate($text, $artoen=0){
	global $projectId;
	$translate = new TranslateClient([
	    'projectId' => $projectId
	]);
	
	$key = [
            'target' => 'ar',
            'source' => 'en',
            'format' => 'text',
            'prettyprint' => false,
        ];
	if($artoen)
        $key = [
            'target' => 'en',
            'source' => 'ar',
            'format' => 'text',
            'prettyprint' => false,
        ];

	$translation = $translate->translate($text, /*[
    	'target' => 'ar',
	    'source' => 'en',
	    'format' => 'text',
	    'prettyprint' => false,
	]*/ $key);
	return $translation['text'];
}
function trans($key){
	global $client, $lang;
	if($lang=='ar') return $key;
	try{
		$isExist = $client->get([
			'index' => 'conan',
			'type' => 'translations',
			'id' => $key		
		]);
		return $isExist['_source']['en'];
	} catch (Exception $ex){
		$translation = translate($key,1);
                $isExist = $client->index([
                        'index' => 'conan',
                        'type' => 'translations',
                        'id' => $key,
			'body' => ['en' => $translation] 
                ]);
		return $translation;
	}

}
function updateImagesTags(){
	$client = Elasticsearch\ClientBuilder::create()->build();
    $params = [
        'size' => 100,
        'index' => 'conan',
        'type' => 'post',
        'body' => [
            'query' => [
                'bool' => [
                    'must' => [
                        'match' => [
                            'images.processed' => 0
                        ]
                    ]
                ]
            ]
        ]
    ];
    $query = $client->search($params);

    //echo '<pre>',print_r($query),'</pre>';
	//die("");

	$tobreak = 0;
	$counter = 0;
	$query = $query['hits']['hits'];
	foreach ($query as $key) {
		$id = $key['_id'];
		$obj = $key['_source'];
		for($i=0;$i<sizeof($obj['images']);$i++){
			if($obj['images'][$i]['processed']==0){
				try{
					//sleep(30);
					$imgArr = vision([$obj['images'][$i]['src']]);
					$obj['images'][$i]['tags'] = $imgArr;
					$obj['images'][$i]['processed'] = 1;
					$counter++;
				}
				catch(Exception $ex){
					echo '<div style="padding:6px;margin:6px;background:#e94c48">' . $ex . '</div>';
					$tobreak=1;
					break;
				}			
			}
		}
		if($tobreak)
			break;

		$params = [
		    'index' => 'conan',
		    'type' => 'post',
		    'id' => $id,
		    'body' => $obj/*[
	            $obj[0]
		    ]*/
		];

//		echo '<pre>',print_r($params),'</pre>';

		$client->index($params);

		echo "<br/>updated posts = $counter<br/>";
	}
}
