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
        $questions = Question::find()->select('id, questionBody')->all();
        return $this->render('index', compact('questions'));
    }

    public function actionView()
    {

        if(Yii::$app->request->isAjax) {

            $id = Yii::$app->request->get('id');
            $question = Question::findOne($id);

            if(empty($question)) {throw new \yii\web\HttpException(404, 'Такой страницы, наверное, нет');}
                return $this->renderPartial('view', [
                    'question' => $question,
                ]);
        }
    }
}