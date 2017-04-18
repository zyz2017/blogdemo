<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '创建文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'id',
	     'contentOptions' => ['width'=>'30px'],
		],
            'title',
	    ['attribute' => 'authorName',
	     'label' => '作者',
	     'value' => 'author.username',
		],
            //'content:ntext',
            //'status',
	    ['attribute' => 'status',
	     'value' => 'status0.name',
	     'filter' =>Poststatus::find()
		->select(['name','id'])
		->orderBy('position')
		->indexBy('id')
		->column(),
		],
            ['attribute' => 'status',
	     'format' => ['date','php:Y-m-d H:i:s'],
		],
            // 'update_time:datetime',
            // 'author_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
