<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_payment_card".
 *
 * @property integer $id
 * @property string $CardCode
 * @property string $CreatedTime
 * @property string $Balance
 * @property string $CurrentBalance
 * @property string $LastTransactionTime
 * @property string $LastAmount
 *
 * @property PurchaseOrder[] $purchaseOrders
 */
class PurchasePaymentCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_payment_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime', 'LastTransactionTime'], 'safe'],
            [['Balance', 'CurrentBalance', 'LastAmount'], 'number'],
            [['CardCode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CardCode' => 'Card Code',
            'CreatedTime' => 'Created Time',
            'Balance' => 'Balance',
            'CurrentBalance' => 'Current Balance',
            'LastTransactionTime' => 'Last Transaction Time',
            'LastAmount' => 'Last Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['PaymentCardId' => 'id']);
    }
}
