<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_client".
 *
 * @property integer $id
 * @property string $ClientUrl
 * @property string $ClientCertificate
 * @property string $ClientKey
 * @property string $CreatedTime
 * @property integer $Actived
 *
 * @property TransactionClientAccess[] $transactionClientAccesses
 */
class TransactionClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime'], 'safe'],
            [['Actived'], 'integer'],
            [['ClientUrl', 'ClientCertificate', 'ClientKey'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ClientUrl' => 'Client Url',
            'ClientCertificate' => 'Client Certificate',
            'ClientKey' => 'Client Key',
            'CreatedTime' => 'Created Time',
            'Actived' => 'Actived',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionClientAccesses()
    {
        return $this->hasMany(TransactionClientAccess::className(), ['ClientId' => 'id']);
    }
}
