<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $addTime
 * @property string $eventTime
 * @property string $description
 */
class Activity extends \yii\db\ActiveRecord
{
        /**
     * @inheritdoc
     */
    public static function tableName()
    {
            return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
            return [
                    [['addTime', 'eventTime'], 'safe'],
            [['eventTime', 'description'], 'required'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
            return [
                    'id' => 'ID',
            'addTime' => 'Add Time',
            'eventTime' => 'Event Time',
            'description' => 'Description',
        ];
    }
}
