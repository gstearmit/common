<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_shipping_provider_other".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $shipping_provider_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property SystemAccountTransaction $systemAccountTransaction
 * @property ShippingProvider $shippingProvider
 */
class InvoiceMapShippingProviderOther extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_shipping_provider_other';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'shipping_provider_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
            [['shipping_provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['shipping_provider_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'shipping_provider_id' => 'Shipping Provider ID',
            'system_account_transaction_id' => 'System Account Transaction ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'system_account_transaction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'shipping_provider_id']);
    }
}
