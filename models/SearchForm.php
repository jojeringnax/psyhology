<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Post;
use app\models\Question;
use app\models\Activity;


/**
 * CommentsForm is the model behind the comments form.
 */
class SearchForm extends Model
{
    public $q;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            /* nick and comment body are both required */
            [['q'], 'string', 'min' => 3],
            [['q'], 'required', 'message' => 'Введите, пожалуйста!'],
        ];
    }

    /**
     * Appends post to DB
     * @return boolean whether the post is appended successfully
     */

}