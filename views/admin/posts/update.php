<?php

use yii\helpers\Html;
use app\models\PostTags;
use yii\helpers\ArrayHelper;
use app\models\Tag;
/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Редактирование поста: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$allTags = array(37 => 'стенка', 35 => 'колесо', 36 => 'клетка');

?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
