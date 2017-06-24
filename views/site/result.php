<?php

/* @var $this yii\web\View */

$this->title = 'Результаты';


use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php Pjax::begin([]); ?>
<div class="container-fluid">
	<div class="row postFind">
		<?php $form = ActiveForm::begin([
				'validateOnType' => true,
				'action' => '/',
				'method' => 'get',
				'options' => ['data' => ['pjax' => true]],
			]); ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?= $form->field($searchForm, 'q')->textInput(array(
				        'placeholder' => 'Введите запрос',
                        'id' => 'orange'))->label('Поисковый запрос: '); ?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<?= Html::submitButton('search', ['class' => 'btn btn-primary coolButton']) ?>
			</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
<div class="container-fluid">
<?php echo '<div class="h3">Посты, найдено '.count($posts).':</div>'; ?>

	<?php
	$countPosts = count($posts);
	if ($countPosts > 12) {
		$resultRows = floor(count($posts)/12) + 1;
		$countPosts = count($posts) % 12;
		echo '<div class="row postRow">';
	} else {
		$resultRows = 0;
	}

	if ($countPosts) {
		$i = 0;
		$classes = bootstrapClassesSearch($countPosts);
		$j = 0;
		foreach($posts as $post): {
			if ($resultRows) {
				?>
				<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 post" style="height: 100%; margin-top:12px;" >
					<div class="newTypeWrapper">
						<div class="postNew">
						<?php
							$time = new \DateTime('now');
							$today = $time->format('Y-m-d');
							if ($post->timestamp >= $today) {echo 'new!';} ?>
						</div>
						<div class="postType" data-type=<?= Html::encode("{$post->type}") ?>></div>
					</div>
					<?php echo '<div class="postTitle">
                        <a style="color: black;" href="'.yii\helpers\Url::to(["post/view", "id" => $post->id]).'">
					        '.$post->title.'
					    </a></div>'; ?>
					<div class="postContent"><?= substr(
					        $post->content, 0, strpos($post->content, ' ', 150)); ?>
                    </div>
					<div class="postViews"><img src="/img/pic/views.png" /><?= $post->views; ?></div>
					<div class="postCommentsQuan"><img src="/img/pic/comment.png" /><?= $post->commentsQuan;?></div>
				</div>
				<?php
				$j++;
				if ($j == 6) {
					$resultRows--;
					$j = 0;
					echo '</div><div class="row postRow">';
				}
			} else {
				echo '<div class="col-lg-'.$classes[$i].' col-md-'.$classes[$i].' col-sm-6 col-xs-6 post" style="height: 188px; margin-top:12px;" >';
				?>
				<div class="newTypeWrapper">
						<div class="postNew">
						<?php
							$time = new \DateTime('now');
							$today = $time->format('Y-m-d');
							if ($post->timestamp >= $today) {echo 'new!';} ?>
						</div>
						<div class="postType" data-type=<?= Html::encode("{$post->type}") ?>></div>
					</div>
					<div class="postTitle"><a style="color: black;" href="<?= yii\helpers\Url::to(['post/view', 'id' => $post->id]) ?>" ><?= $post->title ?></a></div>
					<div class="postContent"><?= $post->content; ?></div>
					<div class="postViews"><img src="/img/pic/views.png" /><?= $post->views; ?></div>
					<div class="postCommentsQuan"><img src="/img/pic/comment.png" /><?= $post->commentsQuan; ?></div>
				</div>
				<?php
				$i++;
			}

		};
		endforeach;
	}
?>


</div>
</div>

<div class="container-fluid">
<?php echo '<div class="h3">Вопросы, найдено '.count($questions).':</div>'; ?>
	<div class="row postResult">

	<?php
	$countQuests = count($questions);
	if ($countQuests) {
		$i = 0;
        $classes = bootstrapClassesSearch($countQuests);

		foreach($questions as $question): {
			if ($countQuests < 12) {
					echo '<div class="col-lg-'.$classes[$i].' col-md-'.$classes[$i].' col-sm-6 col-xs-6 post" style="margin-left: 0; height: 150px;" >
						<div class="questionBody result">'.$question->questionBody.'</div>
						<div class="answerBody post">'.$question->answerBody.'</div>
					</div>
					';
			}
			$i++;

		};
		endforeach;
	}
?>
	</div>
</div>

<script type="text/javascript">
$(document).ready( function() {
	$.colorification();
	$('.post').each( function(){
		$(this).width($(this).width() - 12);
	});
});
</script>
<?php Pjax::end(); ?>
