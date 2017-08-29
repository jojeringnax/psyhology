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
        $all_tags = Tag::find()->all();
        $tags = Array();
        foreach ($all_tags as $tag) {
            array_push($tags, $tag->content);
        }
        $arr = Array();
        $res = Array();
        if ($model->load(Yii::$app->request->post())) {
            $before_post_tags = Array();
            $postTags = PostTags::find()->
                joinWith('tags')->
                where(['post_tags.post_id' => 17])->
                asArray()->
                all(); // Поиск тэгов, которые были у этого поста до POST
            foreach (ArrayHelper::getColumn($postTags, 'tags') as $postTagsTag) {
                foreach($postTagsTag as $tag) {
                    array_push($before_post_tags, $tag['content']);
                }
            } // тупое, невозможное по другому формирование массива из тех тэгов, что были до POST
            if (Yii::$app->request->post()['Post']['tags']) {
                $post_tags = split(',', str_replace(
                    ' ', '', Yii::$app->request->
                    post()['Post']['tags'])); //тэги в POST (не сработало post('tags'))
                if ($deleting = array_diff($before_post_tags, $post_tags)) {
                    $deleting = array_map('quoting', $deleting);
                    Tag::updateAllCounters(['count' => -1], '`content`='.implode($deleting,' or `content`='));
                    $deleting = PostTags::find()->
                        joinWith('tags')->
                        where('`tag`.`content`='.implode($deleting,' or `tag`.`content`=').' and `post_id` = '.$id)->
                        all();
                    foreach ($deleting as $delete_elem) {
                        $delete_elem->delete();
                    }
                }
                foreach($post_tags as $new_tag) {
                    if (in_array($new_tag, $tags)) { // Если есть в таблице tag
                        if (in_array($new_tag, $before_post_tags)) { // Если уже был в тэгах этого поста
                            continue;
                        } else { // Если до сохранения введенный тэг не был в этом посте
                            $this_tag_in_tags = Tag::findOne(['content' => $new_tag]); // Находим его в таблице tag
                            $this_tag_in_tags->updateCounters(['count' => 1]); // Увеличиваем счетчик
                            $new_post_tag = new PostTags(); // Создаем запись в связующей таблице
                            $new_post_tag->tag_id = $this_tag_in_tags->id;
                            $new_post_tag->post_id = $id;
                            $new_post_tag->save();
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
                } // foreach $array_tags (тэги в POST)
            } else if ($before_post_tags) { // Если нет тэгов в POST, но тэги раньше были у поста
                $before_post_tags = array_map('quoting', $before_post_tags);
                Tag::updateAllCounters(['count' => -1], '`tag`.`content`='.implode($before_post_tags,' or `tag`.`content`='));
                $deleting = PostTags::find()->joinWith('tags')->where('`tag`.`content`='.implode($before_post_tags,' or `tag`.`content`='))->all();
                foreach ($deleting as $delete_elem) {
                    $delete_elem->delete();
                }
            }
            if ($model->save()) {
                return $this->render('posts/update', [
                    'model' => $model,
                    'arr' => isset($before_post_tags) ? $before_post_tags : Array(),
                    'postTags' => isset($postTags) ? $postTags : '',
                ]);
            } // if $model->save()
        } else { // если есть POST else
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
