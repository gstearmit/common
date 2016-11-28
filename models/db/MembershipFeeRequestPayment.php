<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "membership_fee_request_payment".
 *
 * @property integer $id
 * @property string $BinCodeMembership
 * @property integer $MembershipPackageId
 * @property string $CreatedTime
 * @property string $TotalMembershipFeeRequestInLocalCurrency
 * @property string $FinalMembershipFeeRequestInLocalCurrency
 * @property string $TotalMembershipFeeRequestPaid
 * @property string $TotalMembershipFeeRequestNotPaid
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property string $PaymentHistoryToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property integer $PaymentMethodProviderId
 * @property string $BankName
 * @property string $DefaultPaymentBenefitAccount
 * @property string $LastPaidTime
 * @property string $RequestedTime
 * @property string $ProcessedTime
 * @property integer $ProcesssedByEmployeeId
 * @property integer $ProcesssedStatus
 * @property string $RejectedReason
 * @property integer $CustomerId
 * @property integer $StoreId
 * @property integer $InvoiceId
 * @property integer $DiscountId
 * @property integer $BillingAddressId
 * @property string $VAT
 * @property string $UpdateTime
 * @property string $Note
 *
 * @property OrganizationEmployee $processsedByEmployee
 * @property Store $store
 * @property Invoice $invoice
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Discount $discount
 * @property Address $billingAddress
 * @property Customer $customer
 * @property MembershipPackages $membershipPackage
 */
class MembershipFeeRequestPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_fee_request_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MembershipPackageId', 'PaymentStatus', 'PaymentMethodProviderId', 'ProcesssedByEmployeeId', 'ProcesssedStatus', 'CustomerId', 'StoreId', 'InvoiceId', 'DiscountId', 'BillingAddressId'], 'integer'],
            [['CreatedTime', 'LastPaidTime', 'RequestedTime', 'ProcessedTime', 'UpdateTime'], 'safe'],
            [['TotalMembershipFeeRequestInLocalCurrency', 'FinalMembershipFeeRequestInLocalCurrency', 'TotalMembershipFeeRequestPaid', 'TotalMembershipFeeRequestNotPaid'], 'number'],
            [['VAT'], 'string'],
            [['BinCodeMembership'], 'string', 'max' => 100],
            [['PaymentMethod', 'BankName'], 'string', 'max' => 50],
            [['PaymentToken', 'PaymentTransaction', 'DefaultPaymentBenefitAccount', 'RejectedReason'], 'string', 'max' => 255],
            [['PaymentHistoryToken', 'Note'], 'string', 'max' => 1000],
            [['ProcesssedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcesssedByEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['InvoiceId'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['InvoiceId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['BillingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['BillingAddressId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['MembershipPackageId'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackages::className(), 'targetAttribute' => ['MembershipPackageId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'BinCodeMembership' => 'Bin Code Membership',
            'MembershipPackageId' => 'Membership Package ID',
            'CreatedTime' => 'Created Time',
            'TotalMembershipFeeRequestInLocalCurrency' => 'Total Membership Fee Request In Local Currency',
            'FinalMembershipFeeRequestInLocalCurrency' => 'Final Membership Fee Request In Local Currency',
            'TotalMembershipFeeRequestPaid' => 'Total Membership Fee Request Paid',
            'TotalMembershipFeeRequestNotPaid' => 'Total Membership Fee Request Not Paid',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentHistoryToken' => 'Payment History Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'BankName' => 'Bank Name',
            'DefaultPaymentBenefitAccount' => 'Default Payment Benefit Account',
            'LastPaidTime' => 'Last Paid Time',
            'RequestedTime' => 'Requested Time',
            'ProcessedTime' => 'Processed Time',
            'ProcesssedByEmployeeId' => 'Processsed By Employee ID',
            'ProcesssedStatus' => 'Processsed Status',
            'RejectedReason' => 'Rejected Reason',
            'CustomerId' => 'Customer ID',
            'StoreId' => 'Store ID',
            'InvoiceId' => 'Invoice ID',
            'DiscountId' => 'Discount ID',
            'BillingAddressId' => 'Billing Address ID',
            'VAT' => 'Vat',
            'UpdateTime' => 'Update Time',
            'Note' => 'Note',
        ];
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackage()
    {
        return $this->hasOne(MembershipPackages::className(), ['id' => 'MembershipPackageId']);
    }
}
