<?php

function publishPost($post){
?>
<div class="panel panel-default"<?php if($post->isHarq)echo 'style="background:#ccc"'; ?>>
    <div class="panel-body">
       	<section class="post-heading">
            <div class="row">
                <div class="col-md-11">
                    <div class="media">
                      <div class="media-left">
                        <a href="https://www.facebook.com/<?=$post->userid?>">
                          <img class="media-object photo-profile" src="<?=$post->userimg?>" width="40" height="40" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <a href="https://www.facebook.com/<?=$post->userid?>" class="anchor-username" target="_blank"><h4 class="media-heading"><?=$post->username?></h4></a>
			<?php
			 $link = '';
			 if(isset($_GET['postid'])) 
				$link = 'https://www.facebook.com/groups/1908251199401277/' . substr ($post->postid ,strpos($post->postid, '_')+1);
			 else
				$link = 'http://animeposts.com/?postid=' . $post->id;
			 ?> 
                        <a href="<?=$link?>" class="anchor-time"><?=date ("Y-m-d", /*strtotime*/($post->created_time)) ?></a>
                      </div>
                    </div>
                </div>
                 <div class="col-md-1">
                     <a href="#/"><i class="glyphicon glyphicon-chevron-down"></i></a>
                 </div>
            </div>             
       	</section>
       	<section class="post-body showmore">
           	<p><?= nl2br($post->message)?></p>
       	</section>

       	<?php if(count($post->images)>0):?>
       	<section>
     	<div id="myCarousel" class="imagesHolder">
            <div class="item">
                <img class="img-responsive postimg" src="<?=$post->images[0]['src']?>" alt="" onclick="displayImg(this)" />
            </div>
            <?php for($i=1;$i<sizeof($post->images);$i++):?>
            <div class="item">
                <img class="img-responsive postimg" src="<?=$post->images[$i]['src']?>" alt="" onclick="displayImg(this)" />
            </div>
      	    <?php endfor?>
        </div>
       	</section>
   		<?php endif?>


        <?php if(count($post->videos)>0):?>
        <section>

            <div class="item">
                <video style="width:100%" controls onclick="if(this.paused)this.play();else this.pause();"><source src="<?=$post->videos[0]?>" />
            </div>
            <?php for($i=1;$i<sizeof($post->videos);$i++):?>
            <div class="item">
                <video style="width:100%" controls onclick="if(this.paused)this.play();else this.pause();"><source src="<?=$post->videos[$i]?>" />
            </div>
            <?php endfor?>
        </section>
        <?php endif?>

     	<?php if(count($post->tags)>0):?>
       	<section>
           <hr style="padding:4px;margin:0px"/>
           <ul class="pager" style="overflow-x: scroll;overflow-y:hidden;">
           <?php foreach ($post->tags as $key) {
           	echo '<li><a class="withripple" href="http://animeposts.com/?q='.$key.'">'.$key.'</a></li>';
           	}
       		?>
       		</ul>
       	</section>
   		<?php endif?>


      <?php if(count($post->episodeno)>0):?>
        <section class="showmore">
           <hr style="padding:4px;margin:0px"/>
           <?php foreach ($post->episodeno as $key) {
            echo '<a class="btn btn-raised btn-primary"><i class="material-icons">grade</i> '.$key.'</a>';
            }
          ?>
        </section>
      <?php endif?>

       	<section class="post-footer">
          <hr style="padding:4px;margin:0px"/>
          <div class="post-footer-option post-container">
            <ul class="list-unstyled">
              <li>
                <a href="#/">
                	<i class="glyphicon glyphicon-thumbs-up"></i> <?=trans('أعجبني')?>
              	</a>
            	</li>
              <li>
              	<a href="http://animeposts.com/?postid=<?=$post->id?>">
              		<i class="glyphicon glyphicon-comment"></i> <?=trans('تعليق')?>
              	</a>
            	</li>
              <li>
              	<a href="<?php if(isMobile()){?>https://www.facebook.com/sharer/sharer.php?u=http%3A//animeposts.com/?postid=<?=$post->id?><?php }?>" onclick="MyWindow=window.open('https://www.facebook.com/sharer/sharer.php?u=http%3A//animeposts.com/?postid=<?=$post->id?>','مشاركة على فيسبوك',width=400,height=200)">
              		<i class="glyphicon glyphicon-share-alt"></i> <?=trans('مشاركة')?>
            		</a>
              </li>
            </ul>
          </div>
       	</section>
    </div>
</div>   
<?php
}
