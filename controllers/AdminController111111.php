<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Tag;
use app\models\PostTags;
use app\models\PostSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Post model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('posts/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $tags = Tag::find()->all();
        $arr = Array();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('posts/create', [
                'model' => $model,
                'tags' => $tags,
                'arr' => $arr,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tags = Tag::find()->all();
        $tags_content = Array();
        $arr = Array();
        $res = Array();
        foreach($tags as $tag) {
            $tags_content[$tag->id] = $tag->content;
        }
        $postTags = PostTags::find()->joinWith('tags')->where(['post_tags.post_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $array_tags = split(',', str_replace(' ', '', $model->tags));
            $tags = ArrayHelper::map($tags, 'id', 'content');
            $this_post_now_tags = ArrayHelper::getColumn($postTags, 'tags');
            foreach ($this_post_now_tags as $this_tag) {
                array_push($arr, $this_tag[0]);
            }
            $this_post_now_tags = ArrayHelper::map($arr, 'id', 'content');
            foreach($array_tags as $new_tag) {
                array_push($res, $new_tag);
                if (in_array($new_tag, $tags)) {
                    $array_tags[$new_tag] = array_search($new_tag, $tags);
                    if (in_array($new_tag, array_values($this_post_now_tags))) {
                        continue;
                    } else {
                        $this_tag_in_tags = Tag::findOne([
                            'content' => $new_tag,
                        ]);
                        $this_tag_in_tags->updateCounters(['count' => 1]);
                        $new_post_tag = new PostTags();
                        $new_post_tag->tag_id = $this_tag_in_tags->id;
                        $new_post_tag->post_id = $id;
                        $new_post_tag->save();
                        $this_tag_in_tags->save();
                    }
                } else {
                    $new_one_tag = new Tag();
                    $new_one_tag->content = $new_tag;
                    $new_one_tag->count = 1;
                    $new_one_tag->save();
                    $new_post_tag = new PostTags();
                    $new_tag_id = Yii::$app->db->getLastInsertId();
                    $new_post_tag->tag_id = $new_tag_id;
                    $new_post_tag->post_id = $id;
                    $new_post_tag->save();
                }
            }
            if ($model->save()) {
                return $this->render('posts/update', [
                    'model' => $model,
                    'arr' => $this_post_now_tags,
                    'postTags' => $this_post_now_tags,
                ]);
            }
        } else {

            return $this->render('posts/update', [
                'model' => $model,
                'tags' => $tags,
                'postTags' => $res,
                'arr' => $arr,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['posts/index']);
    }

    public function actionPosts() 
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('posts/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
