<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ilusha
 * Date: 23.06.17
 * Time: 14:30
 * To change this template use File | Settings | File Templates.
 */

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\Question;

class QuestionController extends Controller {

    public function ActionIndex()
    {
        $questions = Question::findAll('1');
        return $this->render('index', [
            'questions' => $questions,
        ]);
    }

    public function ActionView()
    {
        $question = Question::find(Yii::$app->request->get());
        return $this->render('view', [
            'question' => $question,
        ]);
    }
}