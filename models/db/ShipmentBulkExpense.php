<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_expense".
 *
 * @property integer $id
 * @property string $ExpenseDescription
 * @property string $Amount
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $TotalAmountInLocalCurrency
 * @property string $DueTime
 * @property integer $ExpenseTypeId
 * @property string $TotalChargedWeight
 * @property integer $PaymentStatus
 * @property string $PaidAmount
 * @property string $PaidTime
 * @property string $VoucherPaymentCode
 * @property string $CreatedTime
 * @property integer $DistributedType
 * @property integer $ShipmentBulkId
 * @property string $Note
 *
 * @property InvoiceMapShipmentBulk[] $invoiceMapShipmentBulks
 * @property SystemCurrency $currency
 * @property ShipmentBulkExpenseType $expenseType
 * @property ShipmentBulk $shipmentBulk
 * @property ShipmentBulkTrackingCodeExpense[] $shipmentBulkTrackingCodeExpenses
 */
class ShipmentBulkExpense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Amount', 'CurrencyRate', 'TotalAmountInLocalCurrency', 'TotalChargedWeight', 'PaidAmount'], 'number'],
            [['CurrencyId', 'ExpenseTypeId', 'PaymentStatus', 'DistributedType', 'ShipmentBulkId'], 'integer'],
            [['DueTime', 'PaidTime', 'CreatedTime'], 'safe'],
            [['ExpenseDescription', 'VoucherPaymentCode'], 'string', 'max' => 255],
            [['Note'], 'string', 'max' => 1000],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['ExpenseTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkExpenseType::className(), 'targetAttribute' => ['ExpenseTypeId' => 'id']],
            [['ShipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['ShipmentBulkId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ExpenseDescription' => 'Expense Description',
            'Amount' => 'Amount',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'TotalAmountInLocalCurrency' => 'Total Amount In Local Currency',
            'DueTime' => 'Due Time',
            'ExpenseTypeId' => 'Expense Type ID',
            'TotalChargedWeight' => 'Total Charged Weight',
            'PaymentStatus' => 'Payment Status',
            'PaidAmount' => 'Paid Amount',
            'PaidTime' => 'Paid Time',
            'VoucherPaymentCode' => 'Voucher Payment Code',
            'CreatedTime' => 'Created Time',
            'DistributedType' => 'Distributed Type',
            'ShipmentBulkId' => 'Shipment Bulk ID',
            'Note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipmentBulks()
    {
        return $this->hasMany(InvoiceMapShipmentBulk::className(), ['shipment_bulk_expense_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseType()
    {
        return $this->hasOne(ShipmentBulkExpenseType::className(), ['id' => 'ExpenseTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'ShipmentBulkId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingCodeExpenses()
    {
        return $this->hasMany(ShipmentBulkTrackingCodeExpense::className(), ['ShipmentBulkExpenseId' => 'id']);
    }
}
