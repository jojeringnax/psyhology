<?php

namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{

	public function getPost()
	{
		return $this->hasOne(Post::classname(), ['id' => 'postId']);
	}
}