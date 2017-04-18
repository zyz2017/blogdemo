<?php
namespace console\controllers;
use yii\console\Controller;
use common\models\Post;

class HelloController extends Controller{
	public function actionIndex(){
		echo "hello word!\n";
	}

	public function actionList(){
		$posts=Post::find()->all();

		foreach($posts as $aPost){
			echo ($aPost['id']."-".$aPost['title']."\n");
		}
	}
}
?>
