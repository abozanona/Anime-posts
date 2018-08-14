<?php 

header('content-type:text/html;charset=utf-8');

require_once 'elasticsearch/vendor/autoload.php';


class loadMore{
	private $isOneDayOnly;
	public  $pageid = '1908251199401277';
	private $startDate;
	private $client;

	public $days = 0;

	function __construct(){
		$this->isOneDayOnly = false;
		$this->startDate = "04/04/2016";

		$this->client = Elasticsearch\ClientBuilder::create()->build();

		$isExist = $this->client->exists([
			'index' => 'conan',
			'type' => 'general',
			'id' => 'date' . $this->pageid
		]);

		if(!$isExist)
			$indexed = $this->client->index([
				'index' => 'conan',
				'type' => 'general',
				'id' => 'date' . $this->pageid,
				'body' => [
					'day' => 2
				]
			]);
		

		$result = $this->client->get([
			'index' => 'conan',
			'type' => 'general',
			'id' => 'date' . $this->pageid
		]);

		$this->days = $result['_source']['day'];

		echo "Day#".$this->days."<br/>";

		$this->startProcess();
	}

	function startProcess(){ $this->days++;
		if($this->days == 600){
			echo ' done loading 600 days<br/>';
			return;
		}
		$since = '';
		$until = '';
		$limit = 100;

		$this->generateTimes($since, $until);
		$isDoneWithoutErrors = $this->loadPosts($since, $until, $limit);
		if($isDoneWithoutErrors){
			$this->increaseDays();
			$this->startProcess();
		}
		else{
			echo " (ERROR) ";
		}
	}

	function loadThisDay(){
		$this->isOneDayOnly = true;
		$since=date("Y-m-d", strtotime("-1 day"));
		$until=date("Y-m-d", strtotime("0 day"));
		$limit = 100;
		$this->loadPosts($since, $until, $limit);
	}

	function loadBeforeNDay($n){
		$since=date("Y-m-d", strtotime("-$n days"));
		$until=date("Y-m-d", strtotime("1 day"));
		$limit = 100;
		$this->loadPosts($since, $until, $limit);
	}

	function increaseDays(){
		$this->days++;
		
		$indexed = $this->client->index([
			'index' => 'conan',
			'type' => 'general',
			'id' => 'date' . $this->pageid,
			'body' => [
				'day' => $this->days
			]
		]);
	}

	function generateTimes(&$since, &$until){
		$since = date("Y-m-d", strtotime($this->startDate . "+" . ($this->days) . " day"));
		$until = date("Y-m-d", strtotime($this->startDate . "+" . ($this->days + 1) . " day"));
	}

	function loadPosts($since, $until, $limit){
		if($this->days >= 600 && !$this->isOneDayOnly){
			echo ":donnne";
			return false;
		}
		global $access_token;
		$url = 'https://graph.facebook.com/'.$this->pageid.
							'/feed?limit='.$limit.
								 '&since='.$since.
								 '&until='.$until.
						  '&access_token='.$access_token;
		$json_object = @file_get_contents($url);
echo $url;
		if(!$json_object){
			//if($limit == 50)
			//{
			echo '<br/><br/>' . $url . '<br/><br/>';
			return false;
			//}
			//return $this->loadPosts($since, $until, $limit - 10);
		}

		$fbdata = json_decode($json_object);
		$processor = new processPost();
		$fbdata = $fbdata->data;

//		echo '<pre>',print_r($fbdata),'</pre>';return 0;

		echo '<br/>' . 'day#' . $this->days . ' ' . $since . ' : ' . sizeof($fbdata) . '<br/>';
		

		foreach ($fbdata as $post ){
			$processor->startProcessing($post, $this->pageid);
		}

                if(sizeof($fbdata) == $limit){
			echo 'Linit Increased to'.($limit + 10);
                        return $this->loadPosts($since, $until, $limit + 10);
		}

		return true;
	}	
}
