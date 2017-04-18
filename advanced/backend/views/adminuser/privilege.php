<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHellper;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '权限设置: ' . $id;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $id, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="adminuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="adminuser-privilege-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= Html::checkboxList('newPri',$AuthAssignmentArray,$allPrivilegesArray);?>

    <div class="form-group">
        <?= Html::submitButton('设置', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>

