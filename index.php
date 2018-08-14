<?php
    include 'core.php';
$id = '';
$desc = '';
$name = '';
$img = '';
$clicks = '';
if(isset($_GET['char'])):
	try{
		$client = Elasticsearch\ClientBuilder::create()->build();
                $query = $client->get([
                      'index' => 'conan',
                      'type' => 'character',
                      'id' => $_GET['char']
                ]);
		$id = $query['_id'];
                $desc = $query['_source']['desc'];
                $name = $query['_source']['name'];
                $img = $query['_source']['img'];
                $clicks = $query['_source']['clicks'];
	}catch(Exception $ex){}
endif;
                $api = new api();
                if($name!=''){
                        $api->isSearch=true;
                        $api->isTag=true;
                        $api->tag=$name;
                }
                else if(isset($_GET['q'])){
                        $api->isSearch=true;
                        $api->isQuery=true;
                        $api->query=$_GET['q'];
                }
                if(isset($_GET['theory']) && $_GET['theory']=='true')
                        {$api->isTheory = true;$api->isSearch=true;}
                if(isset($_GET['harq']) && $_GET['harq']=='true')
                        {$api->isHarq = true;$api->isSearch=true;}
                if(isset($_GET['drawings']) && $_GET['drawings']=='true')
                        {$api->isDrawings = true;$api->isSearch=true;}
                if(isset($_GET['manga']) && $_GET['manga']=='true')
                        {$api->isManga = true;$api->isSearch=true;}
                if(isset($_GET['video']) && $_GET['video']=='true')
                        {$api->isVideo = true;$api->isSearch=true;}

                if(isset($_GET['postid'])){
                        $api = new api();
                        $api->postid = $_GET['postid'];
                }

                if(isset($_GET['dc_op_en'])){
                        $api = new api();
                        $api->dc_op_en = 'true';
                }
                $posts = $api->getPosts();
//		echo '<pre>', print_r($posts[0]), '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
    <head>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96996512-1', 'auto');
  ga('send', 'pageview');

</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="Detective Conan Anime" />
	<?php
		$ogimg = "http://images4.fanpop.com/image/photos/23100000/Conan-conan-edogawa-23141762-200-186.jpg";
		if(sizeof($posts>0) && sizeof($posts[0]->images)>0)
			$ogimg = $posts[0]->images[0]['src'];
//		echo '<pre>', print_r($posts), $ogimg , '</pre>';
	?>
	<meta property="og:image" content="<?=$ogimg?>" />
	<link rel="icon" type="image/png" href="http://images4.fanpop.com/image/photos/23100000/Conan-conan-edogawa-23141762-200-186.jpg">
        <title><?=trans('أنيمي المحقق كونان')?></title>

        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-material-design.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <?php if($lang == 'ar'){?><link href="css/bootstrap-rtl.min.css" rel="stylesheet"><?php }?>
        <link href="css/style.css" rel="stylesheet">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<?php if(!isMobile() && !isset($_GET['postid'])):?>
<!-- PopAds.net Popunder Code for animeposts.com | 2017-04-11,1919516,0,0 -->
<script type="text/javascript" data-cfasync="false">
/*<![CDATA[/* */
 (function(){ var b=window;b["\x5f\u0070\x6f\u0070"]=[["s\x69\x74e\x49d",1919516],["\x6din\u0042id",0],["p\u006f\x70\u0075nde\x72\u0073P\x65r\x49\u0050",0],["d\u0065l\x61\u0079\u0042\x65tw\x65\x65\u006e",0],["\x64e\u0066\u0061u\u006ct",false],["\x64ef\u0061u\u006ct\u0050\u0065\u0072\x44\u0061y",0],["\x74o\u0070\x6d\x6f\u0073\u0074\u004ca\u0079er",!0]];var d=["\u002f\x2f\x63\x31\x2e\u0070opad\x73.ne\x74\x2f\x70o\x70\u002e\x6a\x73","\u002f/c\u0032.\x70\x6f\x70\x61\x64\x73\x2ene\x74\x2fp\u006f\u0070\u002e\x6a\u0073","\x2f\x2f\x77\u0077\u0077.\x6cq\u0070\x6b\u006a\x61\x73g\x71\u006a\x76\x65\x2e\x63\x6f\x6d\u002f\x6eb\u0069j\u002e\u006a\u0073","\x2f\u002fw\x77w\x2e\u0067\u0071\x6e\x6da\u0075\u0074y\u0064\x77\u006b\x79\x2e\x63o\u006d\u002f\u0067\u002ej\x73",""],w=0,r,m=function(){if(""==d[w])return;r=b["do\u0063u\u006d\x65n\u0074"]["cr\u0065\x61\u0074eEl\x65\u006d\u0065\u006et"]("\u0073\x63\x72i\x70\u0074");r["t\x79\x70\x65"]="t\x65xt/\u006a\u0061\u0076a\u0073c\x72\u0069\u0070\x74";r["\u0061\u0073\x79\x6ec"]=!0;var c=b["\u0064\x6fc\u0075\x6de\u006e\u0074"]["\u0067\x65\u0074\x45\u006c\x65m\x65n\u0074s\u0042\u0079\u0054agN\u0061\x6d\x65"]("\u0073c\u0072i\x70\x74")[0];r["\x73\x72\x63"]=d[w];if(w<2){r["cr\x6f\u0073\x73\u004f\u0072\x69gi\u006e"]="\u0061n\u006f\u006ey\u006d\x6fu\u0073";};r["\u006f\u006ee\x72\u0072\u006fr"]=function(){w++;m()};c["p\x61\x72\u0065\u006etNod\u0065"]["\u0069\x6e\x73\x65\x72\x74\u0042\x65\u0066o\x72e"](r,c)};m()})();
/*]]>/* */
</script>
<?php endif;?>
<?php if(isMobile()):?>
<style>
.container-fluid, #postsholder{
	margin: 0px;
	padding: 0px;
}
</style>
<?php endif;?>
    </head>
    <body>
	<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'com.rond.conan.detectiveconan') == false):?>
		<div class="alert alert-dismissible alert-info" style="margin: auto; position: fixed;bottom: 0px;z-index: 5000;left: 0px;max-width:100%;">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <a href="https://drive.google.com/uc?export=download&id=0Bw34sk0WcmFnTUVQTV9LUlNqSHc" target="_balnk"><strong>لتجربة أفضل والكثير من الميزات الإضافية ينصح بتنزيل التطبيق مباشرة</strong></a>
		</div>
	<?php endif; ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v2.8&appId=244466436016880";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>

	<div id="img-full-screen" style="display:none;overflow: hidden;z-index:1000;position:fixed;left:0px;right:0px;top:0px;bottom:0px;background:rgba(0,0,0,0.5);text-align:center">
		<img style="/*padding-top:50px;*/max-width:100%;max-height:100%;margin:auto;">
	</div>
        <div class="row" style="background: #3B5998;padding: 10px;margin: 0px 0px 20px 0px;">
            <div class="col-md-offset-2 col-md-4" style="margin-top: 6px;">
                <a href="http://animeposts.com/"><img src="http://i.imgur.com/pu5SeQL.jpg" style="width:26px;height: 26px;border-radius: 5px;"/></a>
                <?php
                	$q="";
                	if(isset($_GET['q'])){
                		$q = $_GET['q'];
                	}
		//	$q = $_SERVER['HTTP_USER_AGENT'];
                ?>
                <form method="GET" class="form-group is-empty" style="display: inline">
                	<input name="q" style="width:70%;padding: 2px;display:inline;color:white;" placeholder="<?=trans('ابحث عن شخصيات أو منشورات أو غير ذلك')?>" class="form-control" value="<?=$q?>"/>
            	</form>
            </div>
            <div class="col-md-offset-1 col-md-5">
                <!--img style="width:26px;height: 26px;"/>
                <span></span>
                <span></span>
                <a href="https://www.facebook.com/" target="_blank">
                    <img src="http://i.imgur.com/e6A2rhF.png" style="width:26px;height: 26px;"/>
                    <img src="http://i.imgur.com/oAdLcQ0.png" style="width:26px;height: 26px;"/>
                    <img src="http://i.imgur.com/v2fWrS8.png" style="width:26px;height: 26px;"/>
                </a-->
		<button type="button" class="btn btn-default" style="color:white" onclick="window.open('http://animeposts.com/?dc_op_en','_self')">#DC_OP_EN</button>
		<button type="button" class="btn btn-default" style="color:white"><?=trans('البحث بالصور')?></button>
		<button type="button" class="btn btn-default" style="color:white" onclick="window.open('http://animeposts.com/about.php','_self')"><?=trans('عن الموقع')?></button>
		<!--button type="button" class="btn btn-default" style="color:white" onclick="window.open('http://animeposts.com/?dc_op_en','_self')"><?=trans('المفضلة')?></button-->
            </div>
            <div class="col-md-1">
                <!--logout-->
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-2 hidden-xs">
<!--script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3690368410616563"
     data-ad-slot="3098784337"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script-->
            </div>
            <div id="postsholder" class="col-md-6 col-xs-12">
                <div class="panel panel-default col-md-8 clearfix" style="padding:4px;<?php if(isset($_GET['postid']) || isset($_GET['dc_op_en']))echo'display:none;'; ?>">
		    <h4><?=trans('البحث عن')?></h4>
                    <div class="col-md-6">
                        <div class="togglebutton">
                            <label>
                                <input id="harq" name="harq" onclick="selectOf('harq')" type="checkbox"<?php if(isset($_GET['harq']) && $_GET['harq']=='true')echo ' checked';?>>
                                <span class="toggle"></span>
                                <?=trans('حرق')?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="togglebutton">
                            <label>
                                <input id="drawings" name="drawings" onclick="selectOf('drawings')" type="checkbox"<?php if(isset($_GET['drawings']) && $_GET['drawings']=='true')echo ' checked';?>>
                                <span class="toggle"></span>
                                <?=trans('رسومات')?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="togglebutton">
                            <label>
                                <input id="theory" name="theory" type="checkbox" onclick="selectOf('theory')"<?php if(isset($_GET['theory']) && $_GET['theory']=='true')echo ' checked';?>>
                                <span class="toggle"></span>
                                <?=trans('نظريات')?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="togglebutton">
                            <label>
                                <input id="manga" name="manga" type="checkbox" onclick="selectOf('manga')"<?php if(isset($_GET['manga']) && $_GET['manga']=='true')echo ' checked';?>>
                                <span class="toggle"></span>
                                <?=trans('مانجا')?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="togglebutton">
                            <label>
                                <input id="video" name="video" type="checkbox" onclick="selectOf('video')"<?php if(isset($_GET['video']) && $_GET['video']=='true')echo ' checked';?>>
                                <span class="toggle"></span>
                                <?=trans('فيديو')?>
                            </label>
                        </div>
                    </div>

                    <!--div class="col-md-12" style="position:relative;height:50px">

                        <span class="col-md-2">
                            <i class="emoj like"></i>
                        </span>
                        <span class="col-md-2">
                            <i class="emoj love"></i>
                        </span>
                        <span class="col-md-2">
                            <i class="emoj haha"></i>
                        </span>
                        <span class="col-md-2">
                            <i class="emoj wow"></i>
                        </span>
                        <span class="col-md-2">
                            <i class="emoj sad"></i>
                        </span>
                        <span class="col-md-2">
                            <i class="emoj angry"></i>
                        </span>
                    </div-->
                </div>
                <div class="clearfix"></div>
	        	<?php 

	        	if(!empty($name)):
				try{
				
					$clicks++;
					$indexed = $client->index([
						'id' => $id,
						'index' => 'conan',
						'type' => 'character',
						'body' => (object)[
							'clicks' => $clicks,
							'name' => $name,
							'img'  => $img,
							'desc' => $desc
						]
					]);

	        	?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?=trans('عن')?> <b><?=$name?></b></h3>
					</div>
					<div class="panel-body">
						<?=$desc?>
					</div>
				</div>
	    		<?php
				}
				catch (Exception $e) {

				}
    		 	endif;






















               











                if(sizeof($posts)==0){
                	$images=[
                		"https://i.ytimg.com/vi/b7p79mXk1zI/maxresdefault.jpg",
                		"https://s-media-cache-ak0.pinimg.com/736x/98/db/cf/98dbcf888b9c9f412ddcd1e99744387c.jpg",
                		"https://i.ytimg.com/vi/ThIzPIhEJv8/hqdefault.jpg",
                		"https://i.ytimg.com/vi/oRehVpHscvc/maxresdefault.jpg",
                		"https://i.ytimg.com/vi/QpBHSMul_go/maxresdefault.jpg",
                		"http://images5.fanpop.com/image/polls/883000/883564_1321765082934_full.png?v=1321765147",
                		"http://stuffpoint.com/detective-conan/image/239349-detective-conan-conan-edogawa-sad.jpg",
                		"https://myanimelist.cdn-dena.com/s/common/uploaded_files/1444213224-2df0c3edf5bc1718011f0a779cedd5ef.jpeg",
                		"http://images5.fanpop.com/image/polls/883000/883564_1321765032751_full.png?v=1321765147",
                		"https://i.ytimg.com/vi/b7p79mXk1zI/hqdefault.jpg",
                		"https://i.ytimg.com/vi/_Tx2-dW4wgo/hqdefault.jpg",
                		"http://images5.fanpop.com/image/polls/883000/883562_1321764597770_full.png?v=1321764712",
                		"http://pm1.narvii.com/5894/6f9e381d97b5061d4674d411d9dc697b3efb4a6f_hq.jpg",
                		"https://s-media-cache-ak0.pinimg.com/564x/34/de/18/34de181823669d411411cea908bb561a.jpg",
                		"http://vignette3.wikia.nocookie.net/detectivconan/images/f/fe/Shinichi-s-Confession-at-London-detective-conan-21860096-1366-768.jpg/revision/latest?cb=20130724000557",
                		"https://myanimelist.cdn-dena.com/s/common/uploaded_files/1444213224-2df0c3edf5bc1718011f0a779cedd5ef.jpeg",
                		"http://vignette4.wikia.nocookie.net/detectivconan/images/c/c7/Vlcsnap-2011-06-21-18h42m26s234.png/revision/latest?cb=20130917212949",
                		"http://images6.fanpop.com/image/answers/3178000/3178968_1363413261609.28res_500_279.jpg",
                		"http://68.media.tumblr.com/79504b6bad4e93f79fe396a488b861bc/tumblr_nnc6cuJMfM1qaygwqo1_500.jpg",
                		"http://vignette1.wikia.nocookie.net/detectivconan/images/9/92/Shinichi_and_Ran.jpg00.jpg/revision/latest?cb=20130728195126",
                		"https://myanimelist.cdn-dena.com/s/common/uploaded_files/1444213106-7521d5dd2cfc97ab0ec031bedbf5a50e.jpeg",
                		"http://img09.deviantart.net/8609/i/2012/012/7/6/vermouths_call_by_glezx-d4m4mcp.png",
                		"http://images6.fanpop.com/image/forum/200000/200213_1364314061693_full.png",
                		"http://www.meitanteiconan.it/site/images/photoalbum/album_69/818_2.jpg",
                		"http://www.mexat.com/vb/attachment.php?attachmentid=445253&stc=1&d=1209730957",
                		"https://s-media-cache-ak0.pinimg.com/736x/0c/2b/00/0c2b00ff090c414fd9f1f37937859895.jpg",
                		"http://img11.hostingpics.net/pics/663618vlcsnap242172.png",
                		"http://68.media.tumblr.com/175d5cf686654747b790a6c153b4657a/tumblr_nj71boumie1tn2r7yo1_1280.png",
                		"http://4.bp.blogspot.com/-9YqSnkya42w/UWy0p67c_dI/AAAAAAAAAvw/aYhJoOz57ug/s1600/Akemi_Miyano.jpg",
                		"https://s-media-cache-ak0.pinimg.com/originals/86/68/5e/86685e2bf04c186934afd3f26fdc7b0c.jpg"
                	];

                	$img = $images[mt_rand(0, count($images) - 1)];
                	$img = "<h3>لم نستطع العثور على نتائج مطابقة</h3><img class='img-responsive' style='max-width:100%' src='$img'/>";

                	echo $img;
                }

                foreach ($posts as $post) {
                    publishPost($post);
                }
                ?>
		<?php if(isset($_GET['postid'])) echo '<div class="fb-comments" data-href="http://animeposts.com/?postid=<?=$post->id?>" data-numposts="5"></div>';?>
            </div>
            <div class="col-md-2 hidden-xs">
            	<h3><?=trans('قائمة أفضل الشخصيات')?></h3>
            	<table class="chartable">
                <?php 
                $api = new api();
                $chars = $api->getTopChars();

                foreach ($chars as $char):
                ?>
            		<tr>
            			<td>
            				<img src="<?=$char->img ?>"/>
        				</td>
            			<td style="width: 125px;">
            				<a href="<?=curPageURL().'?char='.$char->id ?>"><?=$char->name ?></a>
        				</td>
            		</tr>
        		<?php
        		endforeach;
        		?>
            	</table>
		<a href="http://animeposts.com/characters.php"><h3><?=trans('مشاهدة المزيد')?></h3></a>
            </div>
        </div>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script-->
<script>
(function(a){a.fn.showMore=function(b){var c={speedDown:300,speedUp:300,height:"265px",showText:"Show",hideText:"Hide"};var b=a.extend(c,b);return this.each(function(){var e=a(this),d=e.height();if(d>parseInt(b.height)){e.wrapInner('<div class="showmore_content" />');e.find(".showmore_content").css("height",b.height);e.append('<div class="showmore_trigger"><span class="more">'+b.showText+'</span><span class="less" style="display:none;">'+b.hideText+"</span></div>");e.find(".showmore_trigger").on("click",".more",function(){a(this).hide();a(this).next().show();a(this).parent().prev().animate({height:d},b.speedDown)});e.find(".showmore_trigger").on("click",".less",function(){a(this).hide();a(this).prev().show();a(this).parent().prev().animate({height:b.height},b.speedUp)})}})}})(jQuery);


function showmore(){
     $('.showmore').showMore({
          speedDown: 300,
          speedUp: 300,
          height: '165px',
          showText: '<?=trans('عرض المزيد')?>',
          hideText: '<?=trans('عرض أقل')?>'
     });
}
$(document).ready(function() {
	showmore();
}); 
</script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        
        function selectOf(keyString) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            var replaced = false;
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == keyString) {
                    vars[i] = pair[0] + "="+ (($("#" + pair[0]).is(":checked"))?"true":"false");
                    replaced = true;
                }
                else if(pair[0] == "harq" || pair[0] == "video" || pair[0] == "drawings" || pair[0] == "theory" || pair[0] == "manga"){
                    vars[i] = pair[0] + "="+ (($("#" + pair[0]).is(":checked"))?"true":"false");
                }
            }
            if (!replaced) vars.push(keyString + "=" + (($("#" + keyString).is(":checked"))?"true":"false"));
            window.location.search = vars.join("&");
        }
        var page=0;
        var isLoading = false;

		var getUrlParameter = function getUrlParameter(sParam) {
		    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            return sParameterName[1] === undefined ? true : sParameterName[1];
		        }
		    }
		    return false;
		};

        $(window).scroll(function() {
		<?php if(isset($_GET['postid'])/* || isset($_GET['dc_op_en'])*/) echo 'return';?>

			if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
				if(!isLoading){
					isLoading=true;
					page++;
					var char = getUrlParameter("char");
					var q = getUrlParameter("q");
					var harq = getUrlParameter("harq"), drawing = getUrlParameter("drawing"), theory = getUrlParameter("theory"), video = getUrlParameter("video"), manga = getUrlParameter("manga");
					$.ajax({
						url: 'ajax.php',
						type: 'post',
						data: { 
							loadmore: "TRUE",
							page: page,
							char: char,
							q: q,
                                                        harq: harq,
                                                        drawing: drawing,
                                                        manga: manga,
                                                        theory: theory,
                                                        video: video<?php if(isset($_GET['dc_op_en'])) echo ', dc_op_en: true';?>
						},
						success: function(data){
							$("#postsholder").append(data);showmore();
							if(data.length>100){
								isLoading=false;
							}
							else {
								$("#postsholder").append("<h4 style='text-align:center'>نهاية النتائج</h4>");
							}
					  	},
						error: function(){
							page--;
							isLoading=false;
						}
					});

				}
			}
		});
		function displayImg(e){
			$("#img-full-screen img").attr("src",$(e).attr('src'));
			$('#img-full-screen').css('display', 'block');
			$(document).css('overflow', 'hidden');
		}
		$('#img-full-screen').click(
			function(){
				 $('#img-full-screen').css('display','none');
				$(document).css('overflow', 'auto');
			}
		).children().click(function(e) {
			return false;
		});;
        </script>
    </body>
</html>
