<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_forgot_token".
 *
 * @property integer $id
 * @property string $token
 * @property integer $customerId
 * @property integer $requestTime
 * @property boolean $status
 */
class CustomerForgotToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_forgot_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'requestTime'], 'integer'],
            [['status'], 'boolean'],
            [['token'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'customerId' => 'Customer ID',
            'requestTime' => 'Request Time',
            'status' => 'Status',
        ];
    }
}
