<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи блога';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Нет',
        'caption' => 'Редактирование постов',
        'captionOptions' => [
        	'id' => 'captionPosts',
        	'class' => 'captionAdmin',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'type',
            'timestamp',
            'views',
            'commentsQuan',
            [
            	'class' => 'yii\grid\ActionColumn',
            	'buttons' => [
            		'template' => '{view} {update} {delete}',
            		'update' => function ($url, $model, $key) {
        				return Html::a('<span class="glyphicon glyphicon-pencil" />', $url);
        			},
        			'view' => function ($url, $model, $key) {
        				return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
        			},
            	],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
