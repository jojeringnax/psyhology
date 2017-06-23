<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use app\models\Post;
use app\models\CommentForm;

class PostController extends Controller
{
	public function actionIndex()
	{
		$posts = Post::find()->select('id, title')->all();
		return $this->render('index', compact('posts'));
	}
	
	public function actionView()
	{
	    $comment = new CommentForm();
	    
	    if ($comment->load(Yii::$app->request->post()) && $comment->post()) {
	        return $this->refresh();
	    }

		$id = \Yii::$app->request->get('id');

		$post = Post::findOne($id);

		if(empty($post)) throw new \yii\web\HttpException(404, 'Такой страницы, наверное, нет');

		return $this->render('view', [
			'comment' => $comment,
			'post' => $post,
		]);
	}
}
?>