<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "error_logs".
 *
 * @property integer $id
 * @property string $error_trace
 * @property string $client_ip
 * @property string $errorTime
 * @property string $requestUrl
 * @property string $postContent
 * @property string $requestMethod
 * @property integer $responseStatus
 * @property string $errorId
 */
class ErrorLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'error_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['error_trace', 'postContent'], 'string'],
            [['errorTime'], 'safe'],
            [['responseStatus'], 'integer'],
            [['client_ip'], 'string', 'max' => 15],
            [['requestUrl'], 'string', 'max' => 500],
            [['requestMethod'], 'string', 'max' => 5],
            [['errorId'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'error_trace' => 'Error Trace',
            'client_ip' => 'Client Ip',
            'errorTime' => 'Error Time',
            'requestUrl' => 'Request Url',
            'postContent' => 'Post Content',
            'requestMethod' => 'Request Method',
            'responseStatus' => 'Response Status',
            'errorId' => 'Error ID',
        ];
    }
}
