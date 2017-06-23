<?php

/* @var $this yii\web\View */

$this->title = 'Блог Светланы Пейда';
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>


		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 postHeaderImg">
					<img src="img/postHeaderImg.png" width="100%" />
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 postHeaderText">
					
					<h1>ЧТО Я ПРЕДЛАГАЮ?</h1>

                    <p>Предлагаю выносить внутренний мусор</p>
					<p>Чиню заборы личностных границ</p>
					<p>Снимаю непомерную ношу</p>
					<p>Убираю грабли из-под ног</p>
					<p>Даю бой паническим атакам</p>
				</div>
				<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<h1>А ЕСЛИ СЕРЬЕЗНО...</h1>
					<p>У каждой нашей проблемы есть причина. Как говорят, "иногда это не наша вина, а наша беда". Если Вы больше не можете страдать, не получая желаемого результата, если Вы сказали себе: "Я так больше не могу!" - значит Ваша душа готова для изменений.<br />Я тоже прошла большой путь. Я сказала себе - Хватит! И у меня большой опыт. И далеко не сразу я нашла то, что искала. Решив свои проблемы, я научилась помогать другим.</p>
					<p>А теперь помогу Вам...</p>
				</div>
			</div>
		</div>
		<?php
		use yii\helpers\Html;
		use yii\widgets\ActiveForm;
		?>
		<div class="container-fluid">
			<div class="row" style="height: 111px; padding-bottom: 37px;padding-top: 37px; background-color: #e5e5e5;">
				<div class="hidden-xs hidden-sm col-md-3 col-lg-3">
					<img src="img/letter.png" style="height: 37px; float:left;" />
					
					<?php $form = ActiveForm::begin([
						'validateOnChange' => true,
						'validateOnSubmit' => true,
						'action' => 'site/subscribe.php',
				    	'fieldConfig' => [
				        'options' => [
				            'tag' => false,
				        ],
				    ],
				]); ?>
						<?= Html::submitButton('ПОДПИСАТЬСЯ', ['style' => 'border: none; background-color: transparent; height: 37px; font-size:26px; vertical-align: middle;']) ?>
				</div>
				<div class="hidden-xs hidden-sm col-md-4 col-lg-4" style="float: left; height: 37px;" >
						<?= $form->field($signupForm, 'name', ['template' => '<div class="wrapper" style="float: left; height: 37px;">{input}{error}</div>'])->textInput(array('placeholder' => 'Ваше имя', 'style'=>'height: 37px;', 'class' => ''))->label(''); ?>
						<?= $form->field($signupForm, 'email', ['template' => '<div class="wrapper" style="height: 37px; float:left; margin-left:20px;">{input}{error}</div>'])->textInput(array('placeholder' => 'Ваш e-mail', 'style'=>'height: 37px;', 'class' => ''))->label(''); ?>
						<?php ActiveForm::end(); ?>
				</div>
				
				<!-- Необходимо добавить мобильное отображение! -->
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
					<div class="calendar hidden-xs hidden-sm" style="width: 80%; height: 300px; margin: 0 auto;">
						<div class="monthName">Июнь</div>
						<div class="calendBody">
						<?php
							$arraySpecials = array();
							foreach ($posts as $post):
								if (date('d', strtotime($post->timestamp))[0] == '0') {
									$dayOfPost = str_replace('0', '', date('d', strtotime($post->timestamp)));
								} else {
									$dayOfPost = date('d', strtotime($post->timestamp));
								}
								if(in_array($dayOfPost, array_keys($arraySpecials))) {
									$arraySpecials[$dayOfPost][$post->id] = $post->title;
								} else {
									$arraySpecials[$dayOfPost] = array();
								}
							endforeach;
							echo draw_calendar(7, 2017, $fillSpaces = true, $specials = $arraySpecials); ?>
						</div>
					</div>
					<div class="tags hidden-xs hidden-sm" style="width: 40%; height: 300px; margin: 0 auto; background-color: #ccc;">Тэги</div>
				</div>
				<div class="hidden-xs hidden-sm col-md-9 col-lg-9" >
					<div class="posts" style="height: 570px;">
						<?php
							$array = array('large', 'small', 'large', 'small', 'large');
							$i = -1;
							$j = 0;
							shuffle($array);
							if (count($posts) >= 7) {
								array_splice($posts, 7, 0, '123');
							};
						?>
						<div class="postRow">
						<?php foreach ($posts as $post): 
								$i++;
								 if ($i == 5) {
									$i=0;
									$j++;
									echo('</div><div class="postRow">');
									shuffle($array);
									if ($j == 1) {
										$array = ['large', 'large', 'small', 'large', 'small'];
									}
								 }
								if ($i==2 and $j==1) {
									echo("<div class=\"postImg small\"><img src=\"img\\rabbit.png\" \\></div>");
									
								} elseif ($i < 5) {
									echo("<div class=\"post $array[$i]\" data-id=\"$post->id\" >");

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
									<div class="postTitle"><a href="<?= Url::to(['post/view', 'id' => $post->id]) ?>"><?= $post->title ?></a></div>
									<div class="postContent"><?= substr($post->content, 0, strpos($post->content, ' ', 150)); ?></div>
									<div class="postViews"><img src="/img/pic/views.png" /><?php echo($post->views); ?></div>
									<div class="postCommentsQuan"><img src="/img/pic/comment.png" /><?php echo($post->commentsQuan);?></div>
								</div>
								<?php
								} endforeach; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 hidden-md hidden-lg" style="height: 400px; background-color: #eee;">
					Слайдер с постами для мобильников
				</div>
			</div>
		</div></div>
		<div class="container-fluid">
			<div class="row" style="height: 250px; background-color: #201600;">
				<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
					<div class="questions" style="color: white;">
						<span style="margin-left: 20px; float: left; margin-bottom: 20px;"> ЗАДАЙТЕ ВОПРОС:</span>
						<div class="questForm" >
							<?php $form = ActiveForm::begin(); ?>
								
								<?= $form->field($questionForm, 'questionerName')->textInput(array('placeholder' => 'Ваше имя'))->label(''); ?>
								<?= $form->field($questionForm, 'questionerEmail')->textInput(array('placeholder' => 'Ваш e-mail*'))->label(''); ?>
								<?= $form->field($questionForm, 'questionBody')->textarea(['rows' => 2, 'cols' => 5])->label('Ваш вопрос:*'); ?>
								<?= Html::submitButton('Отправить', ['class' => 'questionSubmit']) ?>
								<?php ActiveForm::end(); ?>


						</div>
                        <?php Modal::begin(); ?>

                        <?php $this->renderAjax('question\view', [
                            'question' => $question,
                        ]); ?>

                        <?php Modal::end(); ?>
						<img src="img/questions.png" height="200" />
					</div>
				</div>
				<div class="hidden-xs hidden-sm col-md-2 col-lg-2">
					<div class="questions2" style="color: white; text-align: left;">
						<span style="font-size: 12px;" ><p><i>ПРАВИЛА</i></p><i>Если Вы хотите писать, то надо:<br />зачем терпеть проверка связи снова<br />и теперь никогда не проходит с<br />возрастом и приходится увергать<br />эей эейи гей и теперь и заново<br />верить...</i></span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="questionsSlider" style="color:white">
						<div class="row sliderQuest">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 leftQuest"><img class="questArrow left" src="/img/pic/left.png" /></div>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 overlay" style="overflow: hidden;" >
									<div class="questionsWrapper">
										<?php foreach ($quests as $quest):
											if ($quest->answerBody) {
												if (strlen($quest->questionBody) >= 120) {
													$questBody =  substr($quest->questionBody, 0, 120).'...';
												} else {
													$questBody = $quest->questionBody;
												}
												if (strlen($quest->answerBody) >= 120) {
													$answBody = substr($quest->answerBody, 0, 120).'...';
												} else {
													$answBody = $quest->answerBody;
												}
												echo '<div class="halfForQuest"><span style="display: block; text-align: left; font-weight: bold; height: 45px; margin-top: 20px;"><i>ВОПРОС-ОТВЕТ:</i></span><div class="questionBody">'.$questBody.'</div>
												<div class="answerBody">'.$answBody.'</div><div class="linkToQuest"><a class="moreAboutQuest" href='.Url::to(['question/view', 'id' => $quest->id]).'>Далее...</a></div></div>';
											}
										endforeach ?>
									</div>
                                </div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 rightQuest"><img class="questArrow right" src="/img/pic/right.png" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="container-fluid">
    <div class="row" style="background-color: #afaeae; height: 150px; padding: 5px 0 5px 0;">
        <form>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="libraryWord"><span class="libraryWord">БИБЛИОТЕКА</span></div>
                <input class="libraryInput" type="text" name="query" />
                <input type="submit" value="" style="display: none;" />
                <img class="libraryLoop" src="img/loop" />
            </div>
        </form>
        <div class="hidden-xs hidden-sm col-md-2 col-lg-2 library">
            <span id="name">КНИГИ</span>
            <span id="A-Z">А - Я</span>
        </div>
        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
        <div class="hidden-xs hidden-sm col-md-2 col-lg-2 library">
            <span id="name">СТАТЬИ</span>
            <span id="A-Z">А - Я</span>
        </div>
        <div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
        <div class="hidden-xs hidden-sm col-md-2 col-lg-2 library">
            <span id="name">ПРОЧЕЕ</span>
            <span id="A-Z">А - Я</span>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="calendar hidden-xs hidden-sm" style="width: 80%; height: 300px; margin: 0 auto; margin-top: 40px;">
                <div class="monthName">Июнь</div>
                <div class="calendBody">
							<?php echo draw_calendar(7, 2017, $fillSpaces = true, $specials = $arraySpecials); ?>
						</div>
            </div>
        </div>
        <div class="col-xs-12 col=sm-12 col-md-5 col-lg-5 anounce">
            <span><h1>АНОНСЫ МЕРОПРИЯТИЙ</h1></span>
            <div class="activities">
					<?php
						foreach ($activities as $activity):
							echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 activityTime">'.strftime("%V.%m.%Y",strtotime($activity->eventTime)).'</div><div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 activityContent">'.$activity->description.'</div></div>';
						endforeach;
					?>
					</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="row" style="background-color: #eee; margin-top: 10px;">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <img src="img/login.png" width="100%" />
                    <span style="color: #495275;">комната вебинара</span>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 archive" style="background-color: #e5e6e7;">
            <span><h2 style="text-decoration: none; font-style: normal;">АРХИВ ВЕБИНАРОВ<h2></span>
        </div>
    </div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="hidden-xs hidden-sm col-md-5 col-lg-5"></div>
				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 charity" style="line-height:1;">
					<span style="font-size: 8px;">Если Вы хотите выразить мне свою благодарность<br />вы запросто можете сделать это прямо здесь</span>
					<img src="img/charity.png" width="100%" style="margin-top: 25px;" />
				</div>
				<div class="hidden-xs hidden-sm col-md-5 col-lg-5"></div>
			</div>
		</div>
		

