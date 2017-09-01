<?php

namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{

    public function afterSave($insert, $changedAttributes)
    {
        Post::findOne($this->postId)->updateCounters(['commentsQuan' => 1]);
        return true;
    }

    public function afterDelete()
    {
        Post::findOne($this->postId)->updateCounters(['commentsQuan' => -1]);
    }

	public function getPost()
	{
		return $this->hasOne(Post::classname(), ['id' => 'postId']);
	}
}