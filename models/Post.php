<?php

namespace app\models;

use Yii;

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
		return $this->hasMany(Comment::className(), ['postId' => 'id']);
	}

	public function getPostviews()
	{
		return $this->hasMany(Postviews::className(), ['postId' => 'id']);
	}

    public function getPostTags()
    {
        $this->hasMany(PostTags::className(), ['id' => 'post_id']);
    }
}
