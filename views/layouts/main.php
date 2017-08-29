<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use app\models\SearchForm;
use Yii;
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<style>
			div {text-align: center;}
		</style>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?= Yii::$app->params['webRoot']; ?>css/latofonts.css" />
		<link rel="stylesheet" href="<?= Yii::$app->params['webRoot']; ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?= Yii::$app->params['webRoot']; ?>css/bootstrap-theme.min.css" />
		<link rel="stylesheet" href="<?= Yii::$app->params['webRoot']; ?>css/style.css" />
		<title><?= Html::encode($this->title) ?></title>
		<script type="text/javascript" src="<?= Yii::$app->params['webRoot']; ?>js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="<?= Yii::$app->params['webRoot']; ?>js/questions.js"></script>
		<script type="text/javascript" src="<?= Yii::$app->params['webRoot']; ?>js/library.js"></script>
		<script type="text/javascript" src="<?= Yii::$app->params['webRoot']; ?>js/main.js"></script>
		<script type="text/javascript" src="<?= Yii::$app->params['webRoot']; ?>js/posts.js"></script>
	</head>
	<body>
<?php $this->beginBody() ?>

<div class="container-fluid" style="background-color:#201600; height:auto;">
	<!--<div class="row" style="position: fixed; left:50%;">
		<div class="hidden-sm hidden-xs hidden-md col-lg-12" style="text-align: center; font-size: 32px; color: white;">LG</div>
		<div class="col-sm-12 hidden-xs hidden-md hidden-lg" style="text-align: center; font-size: 28px; color: white;">SM</div>
		<div class="hidden-sm hidden-xs col-md-12 hidden-lg" style="text-align: center; font-size: 24px; color: white;">MD</div>
		<div class="hidden-sm col-xs-12 hidden-md hidden-lg" style="text-align: center; font-size: 20px; color: white;">XS</div>
	</div> -->
	<div class="row" style="margin-top: 10px;"> <!-- Это строка с лупой и конвертом для мобильников -->
		<div class="col-xs-6 col-sm-6 col-md-8 col-lg-8"></div>
		<div class="col-xs-2 col-sm-2 hidden-md hidden-lg new mobile">new</div>
		<div class="col-xs-2 col-sm-2 hidden-md hidden-lg loop mobile">
			<img class="headerLoop" src="<?= Yii::$app->params['webRoot']; ?>img/loop.png" /><input type="text" style="width: 0;" />
		</div>
		<div class="col-xs-2 col-sm-2 hidden-md hidden-lg letter mobile">
			<img src="<?= Yii::$app->params['webRoot']; ?>img/letter.png" />
		</div>
		<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
			<div class="row"> <!-- Это строка с лупой и конвертом -->
				<div class="col-md-5 col-lg-5 new" style="text-align: right; color: red; text-decoration: italic;">
				<?php 
				if (Yii::$app->db->createCommand('SELECT COUNT(*) FROM post WHERE timestamp >= CURDATE()')->queryScalar()) {
					$new='new!';
				} else {
					$new = '';
				}
				echo $new; ?>
				</div>
				<div class="col-md-7 col-lg-7 loop">
					<?php 
						$searchForm = new SearchForm;
						$form = ActiveForm::begin([
							'validateOnChange' => true,
							'action' => '/basic/web/result',
							'validateOnSubmit' => true,
							'method' => 'get',
							'fieldConfig' => [
							'options' => [
								'tag' => false,
								'class' => 'headerInputSubmit',
								],
							],
						]);
						?>
					
					<?= $form->field($searchForm, 'q', ['template' => '{input}'])->textInput(array('placeholder' => 'Поиск', 'style'=>'width: 100%; margin-right: 5%;', 'class' => ''))->label(''); ?><?= Html::submitButton('', ['class' => 'headerInputSubmit']) ?>
					<?php ActiveForm::end(); ?>
					<img class="headerLoop" src="<?= Yii::$app->params['webRoot']; ?>img/loop.png" width="10%" style="margin-right: 20px; float: right;" />
				</div>
			</div>
		</div>
	</div>
	<div class="row"> <!-- Это строка с названием главным -->
		<div class="col-xs-1 col-sm-1 col-md-4 col-lg-4"></div>
		<div class="col-xs-10 col-sm-10 col-md-4 col-lg-4 headerText">
		<a href="<?= yii\helpers\Url::to(['/']); ?>" style="word-spacing: 0.4em; font-size: 20px;">
			<span style="font-family: LatoWebLight; font-weight:100;"">blog</span> <b>СВЕТЛАНЫ ПЕЙДА</b>
		</a></div>
		<div class="col-xs-1 col-sm-1 col-md-4 col-lg-4"></div>
	</div>
	<div class="row"> <!-- Это строка с картинкой главной -->
		<div class="col-xs-2 col-sm-2 col-md-5 col-lg-5"></div>
		<div class="col-xs-8 col-sm-8 col-md-2 col-lg-2 headerPic">
			<img src="<?= Yii::$app->params['webRoot']; ?>img/header/header_pic_1.png" class="header1" style="z-index: 34;" width="100%"/>
            <img src="<?= Yii::$app->params['webRoot']; ?>img/header/header_pic_2.png" class="header2" style="z-index: 33;" width="100%"/>
            <img src="<?= Yii::$app->params['webRoot']; ?>img/header/header_pic_3.png" class="header3" style="z-index: 32;" width="100%"/>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-5 col-lg-5"></div>
	</div>
	<div class="row">
		<nav style="border: none; background: transparent;" class="navbar navbar-default navigation" role="navigation">
			<div style="border: none; background: transparent;"  class="navbar-header">
				<button type="button" style="border: none;"  class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" style="border: none; background: transparent;" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-center">
					<li class="main_menu"><a href="#">БЛОГ</a></li>
					<li><a class="main_menu" href="#">ВОПРОС-ОТВЕТ</a></li>
					<li><a class="main_menu" href="#">БИБЛИОТЕКА</a></li>
					<li><a class="main_menu" href="#">АНОНСЫ</a></li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<?= $content ?>
<div class="container-fluid">
	<div class="row footer" style="background-color: #201600; height: 300px;">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 footerForm" style="margin-top: 15px;">
			<form class="footerForm">
				<div class="row">
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
						<img src="<?= Yii::$app->params['webRoot']; ?>img/letter.png" width="100%" />
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<input type="submit" value="ПОДПИСАТЬСЯ" style="width: 100%; background-color: transparent; border: none; color:white; text-decoration: none; font-style: normal; font-size: 17px;" />
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<input type="text" name="" placeholder="Ваше имя" style="width: 100%;" />
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<input type="email" placeholder="Ваш e-mail" style="width: 100%;" />
					</div>
				</div>
			</form>
		</div>
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-center">
					<li class="active"><a href="#">БЛОГ</a></li>
					<li><a href="#">ВОПРОС-ОТВЕТ</a></li>
					<li><a href="#">БИБЛИОТЕКА</a></li>
					<li><a href="#">АНОНСЫ</a></li>
				</ul>
			</div>
		</div>
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1"></div>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>