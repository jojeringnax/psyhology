<?php

/* @var $this yii\web\View */

$this->title = 'Библиотека';

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="wrapper">


<?php 
if($authors) {
	echo '<div class="letter"><h1 class="letter">'.$letter.'</h1></div>';
	foreach ($authors as $author) {
		if ($author->name) {
			$shortName = substr($author->name, 0, 1).'.';
		} else {
			$shortName = '';
		}
		if ($author->midname) {
			$shortMidName = substr($author->midname, 0, 1).'.';
		} else {
			$shortMidName = '';
		}
		echo '<div class="authorName" style="text-align: left;">'.$author->surname.' '.$shortName.$shortMidName.'</div>';
		foreach ($author->books as $book) {
			echo '<div class="bookName" style="text-align: left;"><i><a target="_blank" href="books/'.$book->link.'">'.$book->bookName.'</a></i></div>';
		}
	}
} else {
	echo 'К сожалению, на букву <h1 class="letter" style="text-align: center;">'.$letter.'</h1> ничего нет';
}
?>
</div>
