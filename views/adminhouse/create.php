<?php

use yii\helpers\Html;
use app\models\PostTags;

/* @var $this yii\web\View */
/* @var $model app\models\House */

$this->title = 'Create House';
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$postTags = PostTags::find(['tags.id', 'tags.content'])->
    joinWith('tags')->
    where(['post_tags.post_id' => $model->id])->
    asArray()->
    all();
?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
