<?php
require_once '../core.php';


require_once '../elasticsearch/vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();


function button($text, $q){
    ?>
    <form method="GET" style="display:inline">
        <input name=<?=$q?> type="submit" value="<?=$text?>"/>
    </form>
    <?php
}

button("view day", "q0");
button("delete all posts", "q1");
button("delete index conan", "q2");
button("load new posts", "q3");
button("get conan posts", "q4");
button("update unprocessed images posts", "q5");
button("fetch unprocessed images posts", "q6");
button("Update Images Manually", "q7");
button("Fetch All images", "q8");
/*************************
**************************
**************************
**************************
**************************
**************************
**************************
**************************
*************************/

//delete all posts
if(isset($_GET['q0'])){
    echo '<br/>';
    $day = 'Not set yet';
    try{
        $result = $client->get([
            'index' => 'conan',
            'type' => 'general',
            'id' => 'date' . '1908251199401277'
        ]);
        $day = $result['_source']['day'];
    }
    catch(Exception $ex){
    }
    echo "Day " . $day;
}

//delete all posts
if(isset($_GET['q1'])){
    $params = [
        'index' => 'conan',
        'type' => 'post',
        'body' => [
            'query' => [
                'match_all' => (object)[]
            ]
        ]
    ];
    $client->deleteByQuery($params);
}

//delete index conan
if(isset($_GET['q2'])){
    $result = $client->indices()->delete([
    	'index' => 'conan',
    //	'type' => 'general',
    //	'size' => 10000
    ]);

    echo '<pre>';
    print_r($result);
    echo '</pre>';
}

//load new posts
if(isset($_GET['q3'])){
    $x = new loadMore();
    $x->startProcess();
}

//get conan posts
if(isset($_GET['q4'])){
    $params = [
        'size' => 5000,
        'index' => 'conan',
        'type' => 'post',/*
        'body' => [
            'query' => [
                'bool' => [
                    'should' => ['match' => ['isVideo' => true]]

                ]
            ]
        ]*/
    ];
    $query = $client->search($params); echo '<pre>';
    print_r($query);
    echo '</pre>';
}

//get unprocessed images posts
if(isset($_GET['q5'])){
    updateImagesTags();
}

//fetch unprocessed images posts
if(isset($_GET['q6'])){
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

    echo '<pre>',print_r($query),'</pre>';
}

if(isset($_GET['q7'])){

    $params = [
        'size' => 4000,
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
    $query = $query['hits']['hits'];
    $row = $query[0]['_source'];


    $params = [
        'size' => 4000,
        'index' => 'conan',
        'type' => 'tag',
    ];
    $query = $client->search($params);
    $query = $query['hits']['hits'];
    $tags = [];
    foreach ($query as $key) {
    	$tags[] = $key['_id'];
    }
echo '<pre>',print_r($row),'</pre>';
?>
<h3><?=sizeof($query)?> photo remains</h3>
<form method="post" action="ajax.php">
	<input id="tags" name="tags" style="width:100%;margin:15px;padding:5px;" /><br/>
	<input type="hidden" name="setTags" value="<?=$row['_id']?>"/>
<img src="" style="width:200px;height:200px"/><br/>

<script>

function ppp(e){
	document.getElementById('tags').text = ' ' + document.getElementById('tags').text + e.innerText;
	e.style.display = 'none'
}

</script>

<?php

foreach ($tags as $key) {
	?>
	<span style="line-height: 3;border-radius: 4px;padding: 4px;margin: 4px;background: #ccc" onclick="ppp(this)"><?=$key?></span>
	<?php
}


}

if(isset($_GET['q8'])){
    $client = Elasticsearch\ClientBuilder::create()->build();
    $params = [
        'size' => 4000,
        'index' => 'conan',
        'type' => 'post',/*
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
        ]*/
    ];
    $query = $client->search($params);
	$img=[];$str = "";
	$query = $query['hits']['hits'];
	foreach($query as $key){
		foreach($key['_source']['images'] as $key2){
			$img[] = $key2['src'];
			$str.=$key2['src']."\n";
		}
	}
	echo '<pre>',print_r($str),'</pre>';
	$file = '/home/abozanona/imagesLinks.txt';
	file_put_contents($file, $str);
}
