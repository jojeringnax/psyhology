<?php

namespace app\controllers;
use Yii;
use app\models\Author;
class LibraryController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	if ($request->isAjax) {
    		$letter = $request->get('letter');
    		$type = $request->get('type');
    		$authors = Author::find()->joinWith('books')->where('surname like \''.$letter.'%\'')->all();
    		return $this->renderPartial('index', [
    				'letter' => $letter,
    				'authors' => $authors,
    			]);
    	} else {
    		$authors = Author::find()->joinWith('books')->all();
    		return $this->render('index', [
    			'letter' => $request->get('letter'),
    			'authors' => $authors,
    		]);
    	}
 
    }

}
