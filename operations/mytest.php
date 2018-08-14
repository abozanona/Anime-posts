<?php
require_once '../core.php';
require_once '../elasticsearch/vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();
$x = new loadMore();
$x->startProcess();

