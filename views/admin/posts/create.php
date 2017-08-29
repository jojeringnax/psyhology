<?php

use yii\helpers\Html;
use app\models\PostTags;
use yii\helpers\ArrayHelper;
use app\models\Tag;
/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tags' => $tags,
    ]) ?>
<?php /*
    $before_post_tags = Array();
    $postTags = PostTags::find()->joinWith('tags')->where(['post_tags.post_id' => 17])->asArray()->all();
    echo '<pre>';
    foreach (ArrayHelper::getColumn($postTags, 'tags') as $postTagsTag) {
        foreach($postTagsTag as $tag) {
            array_push($before_post_tags, $tag['content']);
        }
    } // тупое, невозможное по другому формирование массива из тех тэгов, что были до POST
    print_r($before_post_tags);

    echo '<br />Новая фигня<br />';
    $tags = Tag::find()->all();
    $all_tags = Array();
    foreach ($tags as $tag) {
        array_push($all_tags, $tag->content);
    }
    $post = Array ( 'полиграф','стенка','печень' );
    echo 'fafafafaf<br />';
    print_r($all_tags);
    foreach ($post as $new_tag) {
        print $new_tag.'<br />';
        if (in_array($new_tag, $all_tags)) { // Если есть в таблице tag
            if (in_array($new_tag, $before_post_tags)) { // Если уже был в тэгах этого поста
                echo 'Уже был в таблице';
                continue;
            } else { // Если до сохранения введенный тэг не был в этом посте
                echo 'писька';
            }
        }
    }

    echo '</pre>';
*/?>
</div>
