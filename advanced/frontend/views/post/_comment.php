<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php foreach($comments as $comment): ?>

<div class="comment">

	<div class="row">
		<div class="col-md-12">
			<div class="comment_detail">
			<p class="bg-info">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			 <em><?= Html::encode($comment->user->username);?>;</em>
			 <br>
			 <?= nl2br($comment->user->username);?>
			 <br>
			 <?= nl2br($comment->content);?>		 
		</div>
	</div>
</div>
</div>

<?php endforeach;?>
