<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_client_access".
 *
 * @property string $TokenAccessClient
 * @property string $RequestedTime
 * @property string $ServerTimeResponse
 * @property integer $ClientId
 *
 * @property TransactionClient $client
 */
class TransactionClientAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_client_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TokenAccessClient'], 'required'],
            [['RequestedTime', 'ServerTimeResponse'], 'safe'],
            [['ClientId'], 'integer'],
            [['TokenAccessClient'], 'string', 'max' => 255],
            [['ClientId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionClient::className(), 'targetAttribute' => ['ClientId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TokenAccessClient' => 'Token Access Client',
            'RequestedTime' => 'Requested Time',
            'ServerTimeResponse' => 'Server Time Response',
            'ClientId' => 'Client ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(TransactionClient::className(), ['id' => 'ClientId']);
    }
}
