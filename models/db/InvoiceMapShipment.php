<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_shipment".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $shipment_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property Shipment $shipment
 * @property SystemAccountTransaction $systemAccountTransaction
 */
class InvoiceMapShipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'shipment_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['shipment_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
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
            'shipment_id' => 'Shipment ID',
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
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'shipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'system_account_transaction_id']);
    }
}
