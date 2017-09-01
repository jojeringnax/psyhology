<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $link
 * @property string $image_files
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content', 'link'], 'required'],
            [['content', 'image_files'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if($insert) {
            $this->image_files = '1123';
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'content' => 'Описание',
            'link' => 'Ссылка',
            'image_files' => 'Картинки'
        ];
    }
}
