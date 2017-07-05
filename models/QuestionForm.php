<?php

namespace app\models;

use yii\base\Model;

class QuestionForm extends Model
{
    public $questionerName;
    public $questionerEmail;
    public $questionBody;

    public function rules()
    {
        return [
            [['questionerEmail'], 'required', 'message' => 'Поле email, похоже, не заполнено.'],
            [['questionBody'], 'required', 'message' => 'Ввод вопроса поможет на него ответить.'],
            [['questionerName'],'string','max' => 64],
            ['questionerEmail', 'email'],
        ];
    }

    public function post()
    {
        $question = new Question;
        if ($this->validate()) {
            $question->questionerName = $this->questionerName;
            $question->questionerEmail = htmlspecialchars($this->questionerEmail, ENT_QUOTES, "UTF-8");
            $question->questionBody = htmlspecialchars($this->questionBody, ENT_QUOTES, "UTF-8");
            $question->save();
        }
    }
    
}