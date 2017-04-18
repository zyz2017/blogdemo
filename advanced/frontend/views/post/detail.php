<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;
use common\models\Post;
use yii\caching\yii\caching;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use common\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="container">

	<div class="row">
	
		<div class="col-md-9">
			<ol class="breadcrumb">
			<li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
			<li><a href="<?= Url::to(['post/index']);?>">文章列表</a></li>
			<li class="active"><?= $model->title?></li>
			</ol>
			
			<div class="post">
				<div class="title">
					<h2><a href="<?= $model->url;?>"><?= Html::encode($model->title);?></a></h2>
				</div>
			</div>
			
			<div class="author">
			<span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>
			</div>

			<br>
			<div class="content">
			<?= HTMLPurifier::process($model->content)?>
			</div>

			<br>
		
			<div class="nav">
				<span class="glyphicon glyphicon-tag" aria-didden="true"></span>
				<?= implode("，",$model->taglinks);?>
				<br>
				<?= Html::a("评论({$model->commentCount})",$model->url.'#comments');?>
				最后修改于<?= date('Y-m-s H:i:s',$model->update_time);?>
			</div>

			<div id="comments">
				<?php if($added) {?>
				<br>
				<div class="alert alert-warning alert-dismissible" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h4>谢谢您的回复，我们会尽快审核后发布出来！</h4>
			  
			  <p><?= nl2br($commentModel->content);?></p>
			  	<span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($model->author->nickname);?></em>
				</div>
				<?php }?>

				<?php if($model->commentCount>=1) :?>

				<h5><?= $model->commentCount.'条评论';?></h5>
				<?= $this->render('_comment',array(
					'comments'=>$model->Comments,
				));?>
				<?php endif;?>

				 <h5>发表评论</h5>
                                <?php
                                        $commentModel = new Comment();
                                        echo $this->render('_guestform',array(
                                                'id'=>$model->id,
                                                'commentModel'=>$commentModel,
                                        ));
                                ?>

			</div>
		</div>

		
		<div class="col-md-3">
			<div class="searchbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章（
				  <?php 
				  //数据缓存示例代码
				  /*
				  $data = Yii::$app->cache->get('postCount');
				  $dependency = new DbDependency(['sql'=>'select count(id) from post']);
				  
				  if ($data === false)
				  {
				  	$data = Post::find()->count();  sleep(5);
				  	Yii::$app->cache->set('postCount',$data,600,$dependency); //设置缓存60秒后过期
				  }
				  
				  echo $data;
				  */
				  ?>
				  <?= Post::find()->count();?>
				  ）
				  </li>
				  <li class="list-group-item">				  
					  <form class="form-inline" action="<?= Yii::$app->urlManager->createUrl(['post/index']);?>" id="w0" method="get">
						  <div class="form-group">
						    <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">
						  </div>
						  <button type="submit" class="btn btn-default">搜索</button>
					</form>
				  
				  </li>
				</ul>			
			</div>
			
			<div class="tagcloudbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签云
				  </li>
				  <li class="list-group-item">
				  <?php 
				  //片段缓存示例代码
				  /*
				  $dependency = new DbDependency(['sql'=>'select count(id) from post']);
				  
				  if ($this->beginCache('cache',['duration'=>600],['dependency'=>$dependency]))
				  {
				  	echo TagsCloudWidget::widget(['tags'=>$tags]);
				  	$this->endCache();
				  }
				  */
				  ?>
				  <?= TagsCloudWidget::widget(['tags'=>$tags]);?>
				   </li>
				</ul>			
			</div>
			
			
			<div class="commentbox">
				<ul class="list-group">
				  <li class="list-group-item">
				  <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
				  </li>
				  <li class="list-group-item">
				  <?= RctReplyWidget::widget(['recentComments'=>$recentComments])?>
				  </li>
				</ul>			
			</div>
			
		
		</div>
		
		
	</div>

</div>

