<?php

namespace app\models;

use Yii;
use app\models\Tag;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $timestamp
 * @property integer $views
 * @property integer $commentsQuan
 * @property string $tags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content', 'type', 'tags'], 'string'],
            [['timestamp'], 'safe'],
            [['views', 'commentsQuan'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'type' => 'Type',
            'timestamp' => 'Timestamp',
            'views' => 'Views',
            'commentsQuan' => 'Comments Quan',
            'tags' => 'Tags',
        ];
    }

	public function getComments()
	{
        return Comment::find()->select('nick, body, email, timestamp')->where('postId = '.$this->id)->all();
	}

	public function getPostviews()
	{
		return $this->hasMany(Postviews::className(), ['postId' => 'id']);
	}

    public function afterSave($insert, $changedAttributes)
    {
        $allTags = ArrayHelper::map(Tag::find()->select(['tag.id','tag.content'])->asArray()->all(), 'id', 'content');
        $newTags = $this->tags ? explode(',', $this->tags) : array();

        if ($insert) {
            if($newTagsOnlyForThePost = array_intersect($allTags, $newTags)) { // Если есть в таблице тэгов в БД
                $tagsIds = array_keys($newTagsOnlyForThePost);
                foreach ($tagsIds as $tag_id) {
                    Tag::findOne($tag_id)->updateCounters(['count' => 1]);
                }
            } else {
                foreach($newTags as $tag) {
                    if($tag) {
                        $newTag = new Tag;
                        $newTag->content = $tag;
                        $newTag->count = 1;
                        $newTag->save();
                    }
                }
            }
        } else {
            if (isset($changedAttributes['tags'])) {
                $postTags = $changedAttributes['tags'] ? explode(',', $changedAttributes['tags']) : array();
                if ($diff = array_diff($newTags, $postTags)) {      // $diff - Новые теги для этого поста в виде Array('tag.content')
                    if ($newTagsOnlyForThePost = array_intersect($allTags, $diff)) { // Если ввденные Тэги уже есть в базе (возвращается в виде id => content), но новые для поста
                        $tagsIds = array_keys($newTagsOnlyForThePost); // нужны только айди тегов
                        foreach ($tagsIds as $tag_id) {
                            Tag::findOne($tag_id)->updateCounters(['count' => 1]);
                        }
                    } else { // Если это новые для поста теги и их еще нет в базе
                        foreach ($diff as $tag) {
                            $newTag = new Tag;
                            $newTag->content = $tag;
                            $newTag->count = 1;
                            $newTag->save();
                        }
                    }
                }
                if ($diff = array_diff($postTags, $newTags))  {// Если тэги были удалены из поста, тогда делаем всё наоборот
                    $deletedTagsIds = array_keys(array_intersect($allTags, $diff)); // Айди всех удаленных тегов
                    foreach ($deletedTagsIds as $tag_id) {
                        Tag::findOne($tag_id)->updateCounters(['count' => -1]);
                    }
                }
            }
        }
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        $postTags = $this->tags ? explode(',', $this->tags) : array();
        foreach ($postTags as $tag) {
            Tag::findOne(['content' => $tag])->updateCounters(['count' => -1]);
        }
        return true;
    }



}
