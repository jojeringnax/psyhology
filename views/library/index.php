<?php

/* @var $this yii\web\View */

$this->title = 'Библиотека';

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php Modal::begin([
    'id' => 'modalQuest',
]); ?>

<?php Modal::end(); ?>
<div class="wrapper">


<?php 
if($authors) {
	foreach ($authors as $author) {
		if ($author->name) {
			$shortName = substr($author->name, 0, 2).'.';
		} else {
			$shortName = '';
		}
		if ($author->midname) {
			$shortMidName = substr($author->midname, 0, 2).'.';
		} else {
			$shortMidName = '';
		}
		echo '<div class="authorName" style="text-align: left;">'.$author->surname.' '.$shortName.$shortMidName.'</div>';
		foreach ($author->books as $book) {
			echo '<div class="bookName" style="text-align: left;"><i><a target="_blank" href="books/'.$book->link.'">'.$book->bookName.'</a></i></div>';
		}
	}
} else {
	echo 'Нет ни одного автора!';
}
?>
</div>
