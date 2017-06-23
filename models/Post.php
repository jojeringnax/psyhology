<?php

namespace app\models;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $timestamp
 * @property integer $views
 * @property integer $commentsQuan
 */
class Post extends ActiveRecord
{

	public static function tableName() 
	{
		return 'post';
	}

	public function rules()
	{
		return [
			[['title', 'content'], 'required'],
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
}
