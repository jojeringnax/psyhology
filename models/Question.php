<?php

namespace app\models;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $questionerName
 * @property string $questionerEmail
 * @property string $questionBody
 * @property string $questionTimeStamp
 * @property string $answerTimeStamp
 * @property string $answerBody
 */

class Question extends ActiveRecord
{

    public  static function tableName()
    {
        return 'question';
    }

    public function rules()
    {
        return [
           [['questionerEmail', 'questionBody'], 'required'],
            [['questionerEmail', 'questionBody', 'answerBody'], 'string'],
            [['questionTimeStamp', 'answerTimeStamp'], 'safe'],
            [['questionerName'],'string','max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
           'id' => 'ID',
            'questionerName' => 'Questioner Name',
            'questionerEmail' => 'Questioner Email',
            'questionBody' => 'Question Body',
            'questionTimeStamp' => 'Question Time Stamp',
            'answerTimeStamp' => 'Answer Time Stamp',
            'answerBody' => 'Answer Body',
        ];
    }
}
