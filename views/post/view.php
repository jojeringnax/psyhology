<?php
$this->title = $post->title;

use app\models\Postviews;
echo '<pre>';
print_r($post);
echo '</pre>';
?>


<style>
p.help-block {
    height: 0;
}

.form-group {
    margin:0;
    width: 70%;
}
</style>
<div class="panel panel-default">
	<div class="panel-title postTitleSolo">
		<h3 class="panel-title"><?= $post->title ?></h3>
	</div>
	<div class="panel-body postBody">
		<?= $post->content ?>
	</div>
	<div 
</div>
<hr>

<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;
use app\models\Comment;
?>
<div class="site-comments">

    <?php
    
    $comments = Comment::find()->select('nick, body, email, timestamp')->where('postId = '.$post->id)->all();
    
    ?>

    <?php 
    $provider = new ArrayDataProvider([
        'allModels' => $comments,
        'pagination' => [
            'pageSize' => 10,
        ]
    ]);

        echo ListView::widget([
            'dataProvider' => $provider,
            'itemView' => function ($comment, $key, $index, $widget) {
                if ($comment['email']) {
                    $versale = '<div class="commentEmail"><a href="mailto:'.$comment['email'].'">&nbsp('.$comment['email'].')</a></div>';
                } else {
                    $versale = '';
                }
                return $this->renderDynamic('echo \'<div class="commentWrapper"><div class="commentNick"><b>'.$comment['nick'].'</b></div>'.$versale.' <div class="commentTimestamp">&nbsp'.$comment['timestamp'].'&nbsp</div>написал:<br /><div class="commentBody"> '.$comment['body'].'</div></div>\';');
            },
            'emptyText' => 'Увы, пока комментариев не было. Станьте первым!'
        ])
    ?>
    
    
    <p>
        <span>Отправить комментарий:</span>
        <?php $form = ActiveForm::begin([
        'id' => 'post-comment-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"commentInput\">{input}{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php
    
    $field = $form->field($comment, 'nick', [
        'inputOptions' => [
            'placeholder' => $comment->getAttributeLabel('nick'),
        ],
    ])->label(false);
    echo $field;
    
    $field = $form->field($comment, 'email', [
        'inputOptions' => [
            'placeholder' => $comment->getAttributeLabel('email'),
        ],
    ])->label(false);
    echo $field;
    
    $field = $form->field($comment, 'body', [
        'inputOptions' => [
            'placeholder' => $comment->getAttributeLabel('body'),
        ],
    ])->label(false);
    $field->textArea([
        'rows' => '6'
    ]);
    echo $field;

    echo '<div class="form-group">';
    echo '<div class="col-lg-11">';
    echo Html::submitButton('Отправить', ['class' => 'btn btn-primary']);
    echo '</div>';
    echo '</div>';
    
    ?>

    <?php ActiveForm::end(); ?>
    </p>
</div>

<?php 
		$lines = file('access.log');
		$line = $lines[count($lines)-1];
		$start = 0;
    	$finish = strpos($line, ' - - ');
    	$IP = substr($line, $start, $finish);
		
				    	
	   
		if(!(Postviews::find()->where('IP = "'.$IP.'"')->all()) || !(Postviews::find()->where('postId = '.$post->id)->all())) {
			$postView = new Postviews;
			$postView->postId = $post->id;
			$postView->IP = $IP;
			$postView->save();
            $post->views = $post->views + 1;
            $post->save();
		}


?>


