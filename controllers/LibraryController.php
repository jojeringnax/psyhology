<?php

namespace app\controllers;

class LibraryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
