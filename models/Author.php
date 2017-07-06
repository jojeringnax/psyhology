<?php

namespace app\models;

use Yii;
use app\models\Book;
/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $midname
 * @property string $birthday
 * @property string $death_date
 * @property string $biography
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surname', 'name'], 'required'],
            [['birthday', 'death_date'], 'safe'],
            [['biography'], 'string'],
            [['surname', 'name', 'midname'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'name' => 'Name',
            'midname' => 'Midname',
            'birthday' => 'Birthday',
            'death_date' => 'Death Date',
            'biography' => 'Biography',
        ];
    }

    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'author_id']);
    }
}
