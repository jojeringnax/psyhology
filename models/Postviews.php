<?php

namespace app\models;

use yii\db\ActiveRecord;

class Postviews extends ActiveRecord
{

	public function getPost()
	{
		return $this->hasOne(Post::classname(), ['id' => 'postId']);
	}
}