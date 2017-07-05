<?php

namespace app\models;

use yii\base\Model;
use app\models\Subscribers;

class SignupForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required', 'message' => 'Заполни чертовы поля'],
            ['email', 'email'],
        ];
    }

     /**
     * Appends post to DB
     * @return boolean whether the post is appended successfully
     */
    public function post()
    {
    	$subscriber = new Subscribers;
        if ($this->validate()) {
            $subscriber->name = htmlspecialchars($this->name, ENT_QUOTES, "UTF-8");
            $subscriber->email = htmlspecialchars($this->email, ENT_QUOTES, "UTF-8");
            $subscriber->save();
            return true;
        }
        return false;
    }
}