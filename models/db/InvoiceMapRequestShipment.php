<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_request_shipment".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $request_shipment_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property RequestShipment $requestShipment
 * @property SystemAccountTransaction $systemAccountTransaction
 */
class InvoiceMapRequestShipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_request_shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'request_shipment_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['request_shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestShipment::className(), 'targetAttribute' => ['request_shipment_id' => 'id']],
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
            'request_shipment_id' => 'Request Shipment ID',
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
    public function getRequestShipment()
    {
        return $this->hasOne(RequestShipment::className(), ['id' => 'request_shipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'system_account_transaction_id']);
    }
}
