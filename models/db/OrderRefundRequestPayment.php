<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_refund_request_payment".
 *
 * @property integer $id
 * @property integer $OrderId
 * @property string $CreatedTime
 * @property string $UpdateTime
 * @property string $TotalRefundRequestInLocalCurrency
 * @property string $FinalRefundFeeRequestInLocalCurrency
 * @property string $TotalRefundFeeRequestPaid
 * @property string $TotalRefundFeeRequestNotPaid
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property string $PaymentHistoryToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property integer $PaymentMethodProviderId
 * @property string $LastPaidTime
 * @property string $RequestedTime
 * @property integer $ProcessStatus
 * @property string $ProcessedTime
 * @property integer $ProcesssedByEmployeeId
 * @property string $ApprovedTime
 * @property integer $ApprovedByEmployeeId
 * @property string $RejectedReason
 * @property integer $StoreId
 * @property string $Note
 * @property integer $InvoiceId
 * @property integer $BillingAddressId
 * @property string $binCodeRefund
 * @property integer $CustomerConfirm
 * @property string $RefundedTime
 *
 * @property OrderItemRefund[] $orderItemRefunds
 * @property Store $store
 * @property Order $order
 * @property Invoice $invoice
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Address $billingAddress
 * @property OrganizationEmployee $processsedByEmployee
 */
class OrderRefundRequestPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_refund_request_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderId', 'PaymentStatus', 'PaymentMethodProviderId', 'ProcessStatus', 'ProcesssedByEmployeeId', 'ApprovedByEmployeeId', 'StoreId', 'InvoiceId', 'BillingAddressId', 'CustomerConfirm'], 'integer'],
            [['CreatedTime', 'UpdateTime', 'LastPaidTime', 'RequestedTime', 'ProcessedTime', 'ApprovedTime', 'RefundedTime'], 'safe'],
            [['TotalRefundRequestInLocalCurrency', 'FinalRefundFeeRequestInLocalCurrency', 'TotalRefundFeeRequestPaid', 'TotalRefundFeeRequestNotPaid'], 'number'],
            [['PaymentMethod'], 'string', 'max' => 50],
            [['PaymentToken', 'PaymentTransaction', 'RejectedReason'], 'string', 'max' => 255],
            [['PaymentHistoryToken', 'Note'], 'string', 'max' => 1000],
            [['binCodeRefund'], 'string', 'max' => 100],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['InvoiceId'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['InvoiceId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['BillingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['BillingAddressId' => 'id']],
            [['ProcesssedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcesssedByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'OrderId' => 'Order ID',
            'CreatedTime' => 'Created Time',
            'UpdateTime' => 'Update Time',
            'TotalRefundRequestInLocalCurrency' => 'Total Refund Request In Local Currency',
            'FinalRefundFeeRequestInLocalCurrency' => 'Final Refund Fee Request In Local Currency',
            'TotalRefundFeeRequestPaid' => 'Total Refund Fee Request Paid',
            'TotalRefundFeeRequestNotPaid' => 'Total Refund Fee Request Not Paid',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentHistoryToken' => 'Payment History Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'LastPaidTime' => 'Last Paid Time',
            'RequestedTime' => 'Requested Time',
            'ProcessStatus' => 'Process Status',
            'ProcessedTime' => 'Processed Time',
            'ProcesssedByEmployeeId' => 'Processsed By Employee ID',
            'ApprovedTime' => 'Approved Time',
            'ApprovedByEmployeeId' => 'Approved By Employee ID',
            'RejectedReason' => 'Rejected Reason',
            'StoreId' => 'Store ID',
            'Note' => 'Note',
            'InvoiceId' => 'Invoice ID',
            'BillingAddressId' => 'Billing Address ID',
            'binCodeRefund' => 'Bin Code Refund',
            'CustomerConfirm' => 'Customer Confirm',
            'RefundedTime' => 'Refunded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['OrderRefundRequestPaymentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'InvoiceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'PaymentMethodProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'BillingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesssedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcesssedByEmployeeId']);
    }
}
