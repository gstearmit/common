<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_addition_fee_request_payment".
 *
 * @property integer $id
 * @property integer $OrderId
 * @property string $CreatedTime
 * @property string $UpdateTime
 * @property string $TotalAdditionFeeRequestInLocalCurrency
 * @property string $FinalAdditionFeeRequestInLocalCurrency
 * @property string $TotalAdditionFeeRequestPaid
 * @property string $TotalAdditionFeeRequestNotPaid
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property string $PaymentHistoryToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property integer $PaymentMethodProviderId
 * @property string $LastPaidTime
 * @property string $RequestedTime
 * @property string $ProcessedTime
 * @property integer $ProcesssedByEmployeeId
 * @property integer $ProcessStatus
 * @property string $RejectedReason
 * @property integer $StoreId
 * @property string $Note
 * @property integer $InvoiceId
 * @property integer $DiscountId
 * @property integer $BillingAddressId
 * @property string $vat
 * @property string $binCodeAddition
 * @property string $BankName
 * @property integer $CustomerConfirm
 * @property integer $DefaultPaymentProviderId
 * @property string $DefaultPaymentBenefitAccount
 * @property integer $InformEmailStatus
 * @property string $LastEmailTime
 * @property integer $DeliveryConfirmMethod
 *
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrganizationEmployee $processsedByEmployee
 * @property Store $store
 * @property Order $order
 * @property Invoice $invoice
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Discount $discount
 * @property Address $billingAddress
 * @property PaymentProvider $defaultPaymentProvider
 */
class OrderAdditionFeeRequestPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_addition_fee_request_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderId', 'PaymentStatus', 'PaymentMethodProviderId', 'ProcesssedByEmployeeId', 'ProcessStatus', 'StoreId', 'InvoiceId', 'DiscountId', 'BillingAddressId', 'CustomerConfirm', 'DefaultPaymentProviderId', 'InformEmailStatus', 'DeliveryConfirmMethod'], 'integer'],
            [['CreatedTime', 'UpdateTime', 'LastPaidTime', 'RequestedTime', 'ProcessedTime', 'LastEmailTime'], 'safe'],
            [['TotalAdditionFeeRequestInLocalCurrency', 'FinalAdditionFeeRequestInLocalCurrency', 'TotalAdditionFeeRequestPaid', 'TotalAdditionFeeRequestNotPaid'], 'number'],
            [['vat'], 'string'],
            [['PaymentMethod', 'BankName'], 'string', 'max' => 50],
            [['PaymentToken', 'PaymentTransaction', 'RejectedReason', 'DefaultPaymentBenefitAccount'], 'string', 'max' => 255],
            [['PaymentHistoryToken', 'Note'], 'string', 'max' => 1000],
            [['binCodeAddition'], 'string', 'max' => 100],
            [['ProcesssedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcesssedByEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['InvoiceId'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['InvoiceId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['BillingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['BillingAddressId' => 'id']],
            [['DefaultPaymentProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentProvider::className(), 'targetAttribute' => ['DefaultPaymentProviderId' => 'id']],
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
            'TotalAdditionFeeRequestInLocalCurrency' => 'Total Addition Fee Request In Local Currency',
            'FinalAdditionFeeRequestInLocalCurrency' => 'Final Addition Fee Request In Local Currency',
            'TotalAdditionFeeRequestPaid' => 'Total Addition Fee Request Paid',
            'TotalAdditionFeeRequestNotPaid' => 'Total Addition Fee Request Not Paid',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentHistoryToken' => 'Payment History Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'LastPaidTime' => 'Last Paid Time',
            'RequestedTime' => 'Requested Time',
            'ProcessedTime' => 'Processed Time',
            'ProcesssedByEmployeeId' => 'Processsed By Employee ID',
            'ProcessStatus' => 'Process Status',
            'RejectedReason' => 'Rejected Reason',
            'StoreId' => 'Store ID',
            'Note' => 'Note',
            'InvoiceId' => 'Invoice ID',
            'DiscountId' => 'Discount ID',
            'BillingAddressId' => 'Billing Address ID',
            'vat' => 'Vat',
            'binCodeAddition' => 'Bin Code Addition',
            'BankName' => 'Bank Name',
            'CustomerConfirm' => 'Customer Confirm',
            'DefaultPaymentProviderId' => 'Default Payment Provider ID',
            'DefaultPaymentBenefitAccount' => 'Default Payment Benefit Account',
            'InformEmailStatus' => 'Inform Email Status',
            'LastEmailTime' => 'Last Email Time',
            'DeliveryConfirmMethod' => 'Delivery Confirm Method',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['OrderAdditionFeeRequestPaymentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesssedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcesssedByEmployeeId']);
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
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
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
    public function getDefaultPaymentProvider()
    {
        return $this->hasOne(PaymentProvider::className(), ['id' => 'DefaultPaymentProviderId']);
    }
}
