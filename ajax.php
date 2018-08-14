<?php
require 'core.php';

if(isset($_POST['loadmore'], $_POST['page'], $_POST['char'], $_POST['q'])){
	$page = intval($_POST['page']);
	$api = new api();
	$api->page = $page;
	if($_POST['char']!='false' || $_POST['q']!='false'){
		$api->isSearch=true;
	}
	if(isset($_POST['char']) && $_POST['char']!='false'){
	    	$api->isTag = true;

		$client = Elasticsearch\ClientBuilder::create()->build();
		$query = $client->get([
			'index' => 'conan',
			'type' => 'character',
			'id' => $_POST['char']
		]);

		$name = $query['_source']['name'];
	    	$api->tag = $name;
	}

	if(isset($_POST['q']) && $_POST['q']!='false'){
    		$api->isQuery = true;
	    	$api->query = $_POST['q'];
	}


	if(isset($_POST['harq']) && $_POST['harq']=="true"){$api->isSearch=true;
		$api->isHarq = true;}

        if(isset($_POST['drawing']) && $_POST['drawing']=="true"){$api->isSearch=true;
                $api->isDrawing = true;}

        if(isset($_POST['manga']) && $_POST['manga']=="true"){$api->isSearch=true;
                $api->isManga = true;}

        if(isset($_POST['theory']) && $_POST['theory']=="true"){$api->isSearch=true;
                $api->isTheory = true;}

        if(isset($_POST['video']) && $_POST['video']=="true"){$api->isSearch=true;
                $api->isVideo = true;}



	if(isset($_POST['dc_op_en'])){
		//echo 'fffffffffffffffffffffffffffffffffffff';
		$api = new api();
		$api->dc_op_en = true;
		$api->page = $page;
		//echo '<pre>',print_r($api), '</pre>';
	}
		
	$posts = $api->getPosts();

	foreach ($posts as $post) {
        publishPost($post);
    }
}
