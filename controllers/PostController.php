<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use app\models\CommentForm;

class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
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
            'id' => $id,
            'comment' => $comment,
            'post' => $post,
        ]);
    }
}
?>