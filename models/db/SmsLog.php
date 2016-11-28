<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sms_log".
 *
 * @property integer $id
 * @property string $to
 * @property string $content
 * @property string $createdTime
 * @property string $apiResponse
 */
class SmsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdTime'], 'safe'],
            [['to'], 'string', 'max' => 15],
            [['content'], 'string', 'max' => 255],
            [['apiResponse'], 'string', 'max' => 4000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to' => 'To',
            'content' => 'Content',
            'createdTime' => 'Created Time',
            'apiResponse' => 'Api Response',
        ];
    }
}
