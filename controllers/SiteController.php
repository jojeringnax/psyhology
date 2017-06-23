<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Subscribers;
use app\models\Post;
use app\models\Question;
use app\models\QuestionForm;
use app\models\SearchForm;
use app\models\Activity;
use app\models\NemoGuideEtalon;
use app\models\Cbt;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	 
	 
	public function actionResult()
	{
		$searchForm = new SearchForm;
		
		if ($searchForm->load(Yii::$app->request->get())) {
			$posts = Post::find()->andFilterWhere([
				'or',
				['LIKE','title', $searchForm->q],
				['LIKE','content', $searchForm->q],
				])->all();
			$questions = Question::find()->andFilterWhere([
				'and',
				['LIKE','questionBody', $searchForm->q],
				'answerBody is not null',
				])->all();
			return $this->render('result', [
				'posts' => $posts,
				'questions' => $questions,
			]);
		}
		
	}
	
	
    public function actionIndex()
    {
        $signupForm = new SignupForm;
		$searchForm = new SearchForm;
		$questionForm = new QuestionForm;
		$question = new Question;
        $request = Yii::$app->request;
        
        if ($signupForm->load($request->post()) && $signupForm->post() || $questionForm->load($request->post()) && $questionForm->post()) {
            return $this->refresh();
        }
		
		if ($searchForm->load(Yii::$app->request->get())) {
			$posts = Post::find()->andFilterWhere([
				'or',
				['LIKE','title', $searchForm->q],
				['LIKE','content', $searchForm->q],
				])->all();
			$questions = Question::find()->andFilterWhere([
				'and',
				['LIKE','questionBody', $searchForm->q],
				'answerBody is not null',
				])->all();
			return $this->render('result', [
				'posts' => $posts,
				'questions' => $questions,
                'searchForm' => $searchForm,
			]);
			
		}		
		
		$posts = Post::find()->orderBy('id')->all();
		$quests = Question::find()->orderBy('id')->all();
        $activities = Activity::find()->orderBy('id')->all();
        return $this->render('index', [
					'signupForm' => $signupForm,
					'questionForm' => $questionForm,
					'posts' => $posts,
					'quests' => $quests,
                    'activities' => $activities,
                    'question' => $question,
			]);
	}

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
	 
	
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }

}
