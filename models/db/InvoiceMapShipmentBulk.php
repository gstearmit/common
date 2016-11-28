<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_shipment_bulk".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $shipment_bulk_expense_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property SystemAccountTransaction $systemAccountTransaction
 * @property ShipmentBulkExpense $shipmentBulkExpense
 */
class InvoiceMapShipmentBulk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_shipment_bulk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'shipment_bulk_expense_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
            [['shipment_bulk_expense_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkExpense::className(), 'targetAttribute' => ['shipment_bulk_expense_id' => 'id']],
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
            'shipment_bulk_expense_id' => 'Shipment Bulk Expense ID',
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
    public function getShipmentBulkExpense()
    {
        return $this->hasOne(ShipmentBulkExpense::className(), ['id' => 'shipment_bulk_expense_id']);
    }
}
