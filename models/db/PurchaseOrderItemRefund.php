<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_refund".
 *
 * @property integer $id
 * @property integer $PurchaseOrderItemId
 * @property string $Reason
 * @property integer $MerchantId
 * @property integer $TransactionId
 * @property integer $RefundType
 * @property string $RefundedAmount
 * @property string $RefundedTime
 * @property integer $ProcessedEmployeeId
 * @property integer $Status
 * @property string $Note
 *
 * @property InvoiceMapPurchaseItemRefund[] $invoiceMapPurchaseItemRefunds
 * @property Customer $merchant
 * @property PurchaseOrderItem $purchaseOrderItem
 * @property OrganizationEmployee $processedEmployee
 */
class PurchaseOrderItemRefund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_refund';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PurchaseOrderItemId', 'MerchantId', 'TransactionId', 'RefundType', 'ProcessedEmployeeId', 'Status'], 'integer'],
            [['RefundedAmount'], 'number'],
            [['RefundedTime'], 'safe'],
            [['Reason', 'Note'], 'string', 'max' => 255],
            [['MerchantId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['MerchantId' => 'id']],
            [['PurchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['PurchaseOrderItemId' => 'id']],
            [['ProcessedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcessedEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PurchaseOrderItemId' => 'Purchase Order Item ID',
            'Reason' => 'Reason',
            'MerchantId' => 'Merchant ID',
            'TransactionId' => 'Transaction ID',
            'RefundType' => 'Refund Type',
            'RefundedAmount' => 'Refunded Amount',
            'RefundedTime' => 'Refunded Time',
            'ProcessedEmployeeId' => 'Processed Employee ID',
            'Status' => 'Status',
            'Note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItemRefunds()
    {
        return $this->hasMany(InvoiceMapPurchaseItemRefund::className(), ['purchase_order_item_refund_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Customer::className(), ['id' => 'MerchantId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItem()
    {
        return $this->hasOne(PurchaseOrderItem::className(), ['id' => 'PurchaseOrderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessedEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcessedEmployeeId']);
    }
}
