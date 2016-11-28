<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "api_access_token".
 *
 * @property integer $id
 * @property string $username
 * @property string $accessToken
 * @property string $createdTime
 * @property string $expiredTime
 */
class ApiAccessToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_access_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'accessToken', 'createdTime', 'expiredTime'], 'required'],
            [['createdTime', 'expiredTime'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['accessToken'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'accessToken' => 'Access Token',
            'createdTime' => 'Created Time',
            'expiredTime' => 'Expired Time',
        ];
    }
}
