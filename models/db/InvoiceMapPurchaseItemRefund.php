<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_purchase_item_refund".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $purchase_order_item_refund_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property SystemAccountTransaction $systemAccountTransaction
 * @property PurchaseOrderItemRefund $purchaseOrderItemRefund
 */
class InvoiceMapPurchaseItemRefund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_purchase_item_refund';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'purchase_order_item_refund_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
            [['purchase_order_item_refund_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItemRefund::className(), 'targetAttribute' => ['purchase_order_item_refund_id' => 'id']],
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
            'purchase_order_item_refund_id' => 'Purchase Order Item Refund ID',
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
    public function getPurchaseOrderItemRefund()
    {
        return $this->hasOne(PurchaseOrderItemRefund::className(), ['id' => 'purchase_order_item_refund_id']);
    }
}
