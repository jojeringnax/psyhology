<?php

namespace app\models;

use Yii;
use app\models\Author;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $bookName
 * @property string $link
 * @property string $timestamp
 * @property string $type
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'bookName', 'link', 'type'], 'required'],
            [['author_id'], 'integer'],
            [['bookName', 'type'], 'string'],
            [['timestamp'], 'safe'],
            [['link'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'bookName' => 'Book Name',
            'link' => 'Link',
            'timestamp' => 'Timestamp',
            'type' => 'Type',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['author_id' => 'id']);
    }
}
