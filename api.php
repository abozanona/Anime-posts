<?php

class api{
	public $isSearch;
	public $isTag;
	public $isQuery;
	
	public $isHarq;//should prevent showing harq?
	public $isDrawing;
	public $isManga;
	public $isTheory;
	public $isVideo;
	public $page;

	public $tag;
	public $query;

	public $postid = false;
	public $dc_op_en = false;

	function __construct(){
		$this->page = 0;

	}
	public function getTopChars($size = 10){
		$client = Elasticsearch\ClientBuilder::create()->build();
		$params = [
			'size' => $size,
			'index' => 'conan',
			'type' => 'character',
			'body' => [
				'sort' => [
					[ "clicks" => ["order" => "desc"]]
				]
			]
		];





		
		$query = $client->search($params);
		$arr = [];

		foreach ($query['hits']['hits'] as $key) {
			$key['_source']['id'] = $key['_id'];
			$arr[] = (object)$key['_source'];
		}
		return $arr;
	}
	public function getPosts(){
		
		$client = Elasticsearch\ClientBuilder::create()->build();
		$x = [];

		if($this->isSearch){
			if($this->isTag){
				$words = explode(' ', $this->tag);
				$arr = [];
				foreach($words as $key)
					$x[] = [
						'match' => [
							'tags' => $key
						]
					];
			}
			if($this->isQuery){
				$x[] = [
					'match' => [
						'tags' => $this->query
					]
				];
				$x[] = [
					'match' => [
						'message' => $this->query
					]
				];
				$x[] = [
					'match' => [
						'comments' => $this->query
					]
				];
			}
			if($this->isHarq){
				$x[] = [
					'match' => [
						'isHarq' => true
					]
				];
			}
                        /*else{
                                $x[] = [
                                        'match' => [
                                                'isHarq' => true
                                        ]
                                ];
                        }*/
			if($this->isTheory){
				$x[] = [
					'match' => [
						'isTheory' => true
					]
				];
			}
                        /*else{
                                $x[] = [
                                        'match' => [
                                                'isTheory' => false
                                        ]
                                ];
                        }*/
			if($this->isVideo){
				$x[] = [
					'match' => [
						'isVideo' => true
					]
				];
			}
                        /*else{
                                $x[] = [
                                        'match' => [
                                                'isVideo' => false
                                        ]
                                ];
                        }*/
		}

		$params = [
			'size' => 10,
			'from' => $this->page * 10,
			'index' => 'conan',
			'type' => 'post',
			'body' => [
				'query' => [
					'bool' => [
						'should' => []
					]
				],
				"sort" => [ "likes" => [ "order" => "desc" ], "created_time" => [ "order" => "desc" ]]
			]
		];


		if(isset($_GET['dc_op_en']) || $this->dc_op_en)
                $params = [
                        'size' => 10,
			'from' => $this->page * 10,
                        'index' => 'conan',
                        'type' => 'post',
                        'body' => [
                                'query' => [
                                        'bool' => [
                                                'must' => [ "match" => [ "message" => "dc_op_en" ] ]
                                        ]
                                ],
                                "sort" => [/* "likes" => [ "order" => "desc" ],*/ "created_time" => [ "order" => "asc" ]]
                        ]
                ];		

                if($this->postid){
         	       $params = [
       		                'index' => 'conan',
       	        	        'type' => 'post',
				'id' => $this->postid
		        ]; 

                }
		else if(!isset($_GET['dc_op_en']) && !$this->dc_op_en)
			foreach ($x as $key => $value) {
				$params['body']['query']['bool']['should'][]=$value;
			}
		$query = '';
		if($this->postid)	
			$query = $client->get($params);
		else
			$query = $client->search($params);
		//echo '<pre style="direction:ltr">',print_r($x),'</pre>';
		$arr = [];

		if(!$this->postid)
		foreach ($query['hits']['hits'] as $key) {
			$key['_source']['userimg'] = 'http://baxtercoaching.com/wp-content/uploads/2013/12/facebook-default-no-profile-pic.jpg';
			$arr[] = (object)$key['_source'];
		}
		else{
			$query['_source']['userimg'] = 'http://baxtercoaching.com/wp-content/uploads/2013/12/facebook-default-no-profile-pic.jpg';
			$arr[] =(object) $query['_source'];
		}
		return $arr;
	}
}
