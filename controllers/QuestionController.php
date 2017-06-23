<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Question;

class QuestionController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        $questions = Question::find()->select('id, title')->all();
        return $this->render('index', compact('questions'));
    }

    public function actionView()
    {
        $question = Question::find(Yii::$app->request->get());
        return $this->render('view', [
            'question' => $question,
        ]);
    }
}