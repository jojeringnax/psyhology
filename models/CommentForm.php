<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Comment;
use app\models\Post;


/**
 * CommentsForm is the model behind the comments form.
 */
class CommentForm extends Model
{
    public $nick = "Anonymous";
    public $email;
    public $body;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            /* nick and comment body are both required */
            [['nick', 'body'], 'required', 'message' => 'Введите, пожалуйста!'],
            [['email'], 'email'],
        ];
    }

    /**
     * Appends post to DB
     * @return boolean whether the post is appended successfully
     */
    public function post()
    {
        if ($this->validate()) {
            $comment = new Comment;
            $postId = \Yii::$app->request->get('id');
            $post = Post::findOne($postId);

            $nickSafe = htmlspecialchars($this->nick, ENT_QUOTES, "UTF-8");
            $emailSafe = htmlspecialchars($this->email, ENT_QUOTES, "UTF-8");
            $bodySafe = htmlspecialchars($this->body, ENT_QUOTES, "UTF-8");
            
            $comment->nick = $nickSafe;
            $comment->email = $emailSafe;
            $comment->body = $bodySafe;
            $comment->postId = $postId;
            $comment->save();
            $post->commentsQuan = $post->commentsQuan + 1;
            $post->save();
            return true;
        }
        return false;
    }
}