<?php

namespace app\models;

use Yii;
use app\models\Tag;
use app\models\Post;
/**
 * This is the model class for table "post_tags".
 *
 * @property integer $post_id
 * @property integer $tag_id
 */
class PostTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id']);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id']);
    }
}