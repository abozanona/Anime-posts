<?php

require_once 'elasticsearch/vendor/autoload.php';

class processPost{
	public static $tags = [];
	public static $tagsShort = [];

	private $client;
	function __construct(){
		$this->client = Elasticsearch\ClientBuilder::create()->build();
		
		if(sizeof(processPost::$tags)==0)
			processPost::$tags = processPost::getTags();
		foreach (processPost::$tags as $key) {
			processPost::$tagsShort[] = $this->getShort($key);
		}
	}
	public static function getTags(){
		$client = Elasticsearch\ClientBuilder::create()->build();
		$result = $client->search([
			'index' => 'conan',
			'type' => 'tag',
			'size' => 1000
		]);
		$result = $result['hits']['hits'];
		$arr = [];
		foreach ($result as $key) {
			$arr[] = $key['_id'];
		}
		sort($arr, SORT_STRING);
		return $arr;
	}

	public function getShort($tag){
		$tag = trim($tag, ' ');
		$vowelssympols = ['ّ', 'َ', 'ً', 'ُ', 'ٌ', 'ِ', 'ٍ', '~', 'ْ', 'ـ' ];
		
		$short = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $tag);
		$short = preg_replace('/([A-Z])\1+/u', '\1', $short);

		if(mb_substr($short, 0, 2)=='ل' || mb_substr($short, 0, 2)=='و'){
			$short = mb_substr($short, 1);
		}

		$short = str_replace($vowelssympols, '', $short);
		
		$short = str_replace('أ', 'ا', $short);
		$short = str_replace('إ', 'ا', $short);
		$short = str_replace('آ', 'ا', $short);
		$short = str_replace('ئ', 'ى', $short);
		$short = str_replace('ء', 'ى', $short);
		$short = str_replace('ؤ', 'و', $short);
		return $short;
	}

	public function startProcessing($post, $page_id){
		
		$object_id = '0';
		if(isset($post->object_id)){
			$object_id = $post->object_id;
		}
		
		//extract post main data
		$postid = $post->id;
		$postidonly = substr ($postid ,strpos($postid, '_')+1);
		$userid = $post->from->id;
		$username = $post->from->name;
		$created_time = strtotime($post->created_time);
		
		$message = '';
		
		$images = [];
		$videos = [];
		
		$tags = [];

		$likes = 0;
		$love = 0;
		$wow = 0;
		$haha = 0;
		$sad = 0;
		$angry = 0;
		$thankful = 0;

		$episodeNo = [];

		$isMangs = false;
		$isHarq = false;
		$isDrawing = false;
		$isTheory = false;
		$isVideo = false;
		$lettersCount = 0;

		$comments = [];
		$commentsImages = [];//todo later
		$commentsVideos = [];//todo later
		$usersid = [];

		//
		//
		//processing starts hare
		//
		//
		
		if(isset($post->likes))
			$likes=sizeof($post->likes->data);

		if(isset($post->message)){
			$message = $post->message;
			$lettersCount = mb_strlen($message);
			if($lettersCount>5000){
				$isTheory = true;
			}
			if (mb_strpos($message, "حرق") !== false){
				$isHarq = true;
			}
		}

		if(isset($post->comments)){
			$arr = $post->comments->data;
			foreach ($arr as $key) {
				if(isset($key->message)){
					$comments[] = $key->message;
					$usersid[] = $key->from->id;
				}
			}
		}


		$episoderegex = "/([0-9]+)/";
		if(preg_match_all($episoderegex, $message, $matches)){
			for($i=0;$i<sizeof($matches[0]);$i++)
				$episodeNo[] = $matches[0][$i];
		}

		foreach ($comments as $key) {
			if(preg_match_all($episoderegex, $key, $matches)){
				for($i=0;$i<sizeof($matches[0]);$i++)
					$episodeNo[] = $matches[0][$i];
			}
		}
		//$episodeNo = array_unique($episodeNo);

		$arr = $this->reactions($postid);
		if($arr){
			$love = $arr['love'];
			$wow = $arr['wow'];
			$haha = $arr['haha'];
			$sad = $arr['sad'];
			$angry = $arr['angry'];
			$thankful = $arr['thankful'];
		}

		$images = $this->getImages($postid);
		if($post->type=='video'){
			$videos = [$post->source];
			$isVideo = true;
		}

		if(!$isTheory && sizeof($images)==0 && !$isVideo)
			return false;

		$words = explode(' ', $message);
		foreach ($comments as $key) {
			array_merge($words, explode(' ', $key));
		}
		for($i=0;$i<sizeof($words);$i++)
			$words[$i] = $this->getShort($words[$i]);

		$maxCharsLen = 3;
		$tags = [];
		foreach ($words as $key){
			$minLev = 50;
			$tagsArr = [];
			for($i=0;$i<sizeof(processPost::$tags);$i++)
				if(mb_strlen($key)>$maxCharsLen){
					$lev = levenshtein(processPost::$tags[$i], $key);
					if($lev <= mb_strlen($key)-$maxCharsLen){
						if($lev>$minLev){

						}
						else if($lev==$minLev){
							$tagsArr[] = processPost::$tagsShort[$i];
						}
						else{
							$minLev = $lev;
							$tagsArr = [];
							$tagsArr[] = processPost::$tagsShort[$i];
						}
						//$tags[] = processPost::$tagsShort[$i];

					}
				}
				else
					if(processPost::$tags[$i] == $key){
						//$tags[] = processPost::$tagsShort[$i];
						$tagsArr = [processPost::$tagsShort[$i]];
						break;
					}
			$tags = array_merge($tags, $tagsArr);
		}


		$post = (object)array(
			'id'             => $postidonly,
			'pageid'         => $page_id,
			'object_id'      => $object_id,
			'postid'         => $postid,
			'userid'         => $userid,
			'username'       => $username,
			'created_time'   => $created_time,
			'message'        => $message,
			'images'         => $images,
			'videos'         => $videos,
			'tags'           => /*array_unique*/($tags),
			'likes'          => $likes,
			'love'           => $love,
			'wow'            => $wow,
			'haha'           => $haha,
			'sad'            => $sad,
			'angry'          => $angry,
			'thankful'       => $thankful,
			'episodeno'      => /*array_unique*/($episodeNo),
			'isMangs'        => $isMangs,
			'isHarq'         => $isHarq,
			'isDrawing'      => $isDrawing,
			'isTheory'       => $isTheory,
			'isVideo'        => $isVideo,
			'lettersCount'   => $lettersCount,
			'comments'       => $comments,
			//'commentsImages' => $commentsImages,
			//'commentsVideos' => $commentsVideos,
			'status'         => 0,
			'votes'          => 0,

		);

		echo $postidonly;		
		//print_r($episodeNo);

		$this->savePost($postidonly, $post);
		return $post;
	}

	private function reactions($postid){
		global $access_token;
		$json_object = @file_get_contents('https://graph.facebook.com/?id=' . $postid . '&fields=reactions.type(LOVE).limit(0).summary(total_count).as(reactions_love),reactions.type(WOW).limit(0).summary(total_count).as(reactions_wow),reactions.type(HAHA).limit(0).summary(total_count).as(reactions_haha),reactions.type(SAD).limit(0).summary(total_count).as(reactions_sad),reactions.type(ANGRY).limit(0).summary(total_count).as(reactions_angry),reactions.type(THANKFUL).limit(0).summary(total_count).as(reactions_thankful)' . $postid . '/reactions?access_token=' . $access_token );
		if(!$json_object){
			return false;
		}

		$reactions = json_decode($json_object);
		$reactions = $reactions->{$postid};
		
		$arr = [];
		$arr['love'] = $reactions->reactions_love->summary->total_count;
		$arr['wow'] = $reactions->reactions_wow->summary->total_count;
		$arr['haha'] = $reactions->reactions_haha->summary->total_count;
		$arr['sad'] = $reactions->reactions_sad->summary->total_count;
		$arr['angry'] = $reactions->reactions_angry->summary->total_count;
		$arr['thankful'] = $reactions->reactions_thankful->summary->total_count;

		return $arr;
	}

	function getImages($postid){
		global $access_token;
		$pictures = [];
		$json_object = file_get_contents("https://graph.facebook.com/$postid/attachments?access_token=$access_token" );
		$data = json_decode($json_object);
		if(isset($data->data) && sizeof($data->data)==0)
			return $pictures;
		$data = $data->data[0];
		if(isset($data->subattachments)){
			$data = $data->subattachments->data;
			for($i=0;$i<sizeof($data);$i++){
			if($data[$i]->type=="photo")
				$pictures[] = $this->getImageStructure($data[$i]->media->image->src);
			}
		}
		else{
			if($data->type=="photo")
				$pictures[] = $this->getImageStructure($data->media->image->src);
		}
		return $pictures;
	}
	function getImageStructure($img){
		$x = (object)[
			'src' => $img,
			'tags' => [],
			'processed' => 0
		];
		return $x;
	}
	function savePost($id, $post){
		echo '<pre>';
		//print_r($post);
		echo '</pre>';
		$indexed = $this->client->index([
			'index' => 'conan',
			'type' => 'post',
			'id' => $id,
			'body' => $post
		]);
	}
}
