<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_request".
 *
 * @property integer $id
 * @property string $RequestTokenCode
 * @property string $CreatedDate
 * @property integer $TransactionAccountId
 * @property string $CreditAmountInLocalCurrency
 * @property string $DebitAmountInLocalCurrency
 * @property string $OrderInvoiceNumber
 * @property string $OrderDescription
 * @property integer $TypeTransaction
 * @property integer $PaymentStatus
 * @property integer $CustomerId
 * @property string $AccountName
 * @property string $AccountEmail
 * @property string $AccountPhone
 * @property string $AcountAdress
 * @property string $ClientAccessKey
 * @property string $ClientId
 * @property string $ClientNotifyEmail
 * @property integer $RefTransactionId
 * @property string $PaymentThirdpartyToken
 * @property string $PaymentThirdpartyTokenHistory
 * @property integer $PaymentMethodProviderId
 * @property string $PaymentMethodName
 * @property string $PaymentBankCode
 * @property string $TotalAmount
 * @property string $BeforeAccumulatedBalances
 * @property string $AfterAccumulatedBalances
 * @property integer $TypeActivity
 * @property integer $CurrencyId
 * @property string $CurrencyName
 * @property integer $CheckByEmployeeId
 * @property string $CheckDate
 * @property string $CheckByEmployeeName
 * @property integer $ApproveByEmployeeId
 * @property string $ApproveDate
 * @property string $ApproveByEmployeeName
 * @property integer $SiteId
 * @property integer $StoreId
 * @property integer $IsDelete
 * @property integer $Success
 * @property string $Otp
 * @property integer $OtpCount
 * @property integer $OtpReceviceType
 * @property string $AccountTranfersId
 * @property string $AccountTransfers
 * @property string $SubmitUrl
 * @property string $ReturnUrl
 * @property string $CancelUrl
 * @property string $PendingUrl
 * @property integer $Version
 * @property integer $ProcessStatus
 * @property string $Note
 * @property string $RefTransactionThirdParty
 * @property string $BenefitAccountSystem
 * @property string $PromotionAmount
 * @property string $MainAmount
 * @property integer $IsRefunded
 * @property integer $RefundedTransactionId
 * @property string $RefundedAmount
 * @property integer $OriginalTransactionId
 * @property string $withdrawnDestination
 *
 * @property Transaction $originalTransaction
 * @property Site $site
 * @property TransactionAccount $transactionAccount
 * @property Customer $customer
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property SystemCurrency $currency
 * @property OrganizationEmployee $checkByEmployee
 * @property OrganizationEmployee $approveByEmployee
 * @property Transaction $refTransaction
 * @property TransactionVoucher[] $transactionVouchers
 */
class TransactionRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RequestTokenCode', 'CreatedDate', 'TransactionAccountId', 'TypeTransaction', 'CustomerId', 'AccountEmail', 'ClientAccessKey', 'ClientId', 'TypeActivity', 'CurrencyId', 'StoreId', 'ReturnUrl', 'CancelUrl'], 'required'],
            [['CreatedDate', 'CheckDate', 'ApproveDate'], 'safe'],
            [['TransactionAccountId', 'TypeTransaction', 'PaymentStatus', 'CustomerId', 'RefTransactionId', 'PaymentMethodProviderId', 'TypeActivity', 'CurrencyId', 'CheckByEmployeeId', 'ApproveByEmployeeId', 'SiteId', 'StoreId', 'IsDelete', 'Success', 'OtpCount', 'OtpReceviceType', 'Version', 'ProcessStatus', 'IsRefunded', 'RefundedTransactionId', 'OriginalTransactionId'], 'integer'],
            [['CreditAmountInLocalCurrency', 'DebitAmountInLocalCurrency', 'TotalAmount', 'BeforeAccumulatedBalances', 'AfterAccumulatedBalances', 'PromotionAmount', 'MainAmount', 'RefundedAmount'], 'number'],
            [['RequestTokenCode', 'OrderInvoiceNumber', 'AccountName', 'AccountEmail', 'AccountPhone', 'ClientAccessKey', 'ClientNotifyEmail', 'PaymentThirdpartyToken', 'PaymentBankCode', 'CheckByEmployeeName', 'ApproveByEmployeeName', 'AccountTranfersId', 'RefTransactionThirdParty'], 'string', 'max' => 50],
            [['OrderDescription'], 'string', 'max' => 500],
            [['AcountAdress', 'AccountTransfers', 'SubmitUrl', 'ReturnUrl', 'CancelUrl', 'PendingUrl', 'Note', 'BenefitAccountSystem', 'withdrawnDestination'], 'string', 'max' => 255],
            [['ClientId', 'CurrencyName'], 'string', 'max' => 20],
            [['PaymentThirdpartyTokenHistory'], 'string', 'max' => 1000],
            [['PaymentMethodName'], 'string', 'max' => 100],
            [['Otp'], 'string', 'max' => 10],
            [['OriginalTransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['OriginalTransactionId' => 'id']],
            [['SiteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['SiteId' => 'id']],
            [['TransactionAccountId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionAccount::className(), 'targetAttribute' => ['TransactionAccountId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['CheckByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CheckByEmployeeId' => 'id']],
            [['ApproveByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApproveByEmployeeId' => 'id']],
            [['RefTransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['RefTransactionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'RequestTokenCode' => 'Request Token Code',
            'CreatedDate' => 'Created Date',
            'TransactionAccountId' => 'Transaction Account ID',
            'CreditAmountInLocalCurrency' => 'Credit Amount In Local Currency',
            'DebitAmountInLocalCurrency' => 'Debit Amount In Local Currency',
            'OrderInvoiceNumber' => 'Order Invoice Number',
            'OrderDescription' => 'Order Description',
            'TypeTransaction' => 'Type Transaction',
            'PaymentStatus' => 'Payment Status',
            'CustomerId' => 'Customer ID',
            'AccountName' => 'Account Name',
            'AccountEmail' => 'Account Email',
            'AccountPhone' => 'Account Phone',
            'AcountAdress' => 'Acount Adress',
            'ClientAccessKey' => 'Client Access Key',
            'ClientId' => 'Client ID',
            'ClientNotifyEmail' => 'Client Notify Email',
            'RefTransactionId' => 'Ref Transaction ID',
            'PaymentThirdpartyToken' => 'Payment Thirdparty Token',
            'PaymentThirdpartyTokenHistory' => 'Payment Thirdparty Token History',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'PaymentMethodName' => 'Payment Method Name',
            'PaymentBankCode' => 'Payment Bank Code',
            'TotalAmount' => 'Total Amount',
            'BeforeAccumulatedBalances' => 'Before Accumulated Balances',
            'AfterAccumulatedBalances' => 'After Accumulated Balances',
            'TypeActivity' => 'Type Activity',
            'CurrencyId' => 'Currency ID',
            'CurrencyName' => 'Currency Name',
            'CheckByEmployeeId' => 'Check By Employee ID',
            'CheckDate' => 'Check Date',
            'CheckByEmployeeName' => 'Check By Employee Name',
            'ApproveByEmployeeId' => 'Approve By Employee ID',
            'ApproveDate' => 'Approve Date',
            'ApproveByEmployeeName' => 'Approve By Employee Name',
            'SiteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'IsDelete' => 'Is Delete',
            'Success' => 'Success',
            'Otp' => 'Otp',
            'OtpCount' => 'Otp Count',
            'OtpReceviceType' => 'Otp Recevice Type',
            'AccountTranfersId' => 'Account Tranfers ID',
            'AccountTransfers' => 'Account Transfers',
            'SubmitUrl' => 'Submit Url',
            'ReturnUrl' => 'Return Url',
            'CancelUrl' => 'Cancel Url',
            'PendingUrl' => 'Pending Url',
            'Version' => 'Version',
            'ProcessStatus' => 'Process Status',
            'Note' => 'Note',
            'RefTransactionThirdParty' => 'Ref Transaction Third Party',
            'BenefitAccountSystem' => 'Benefit Account System',
            'PromotionAmount' => 'Promotion Amount',
            'MainAmount' => 'Main Amount',
            'IsRefunded' => 'Is Refunded',
            'RefundedTransactionId' => 'Refunded Transaction ID',
            'RefundedAmount' => 'Refunded Amount',
            'OriginalTransactionId' => 'Original Transaction ID',
            'withdrawnDestination' => 'Withdrawn Destination',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOriginalTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'OriginalTransactionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'SiteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccount()
    {
        return $this->hasOne(TransactionAccount::className(), ['id' => 'TransactionAccountId']);
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
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'PaymentMethodProviderId']);
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
    public function getCheckByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CheckByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ApproveByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'RefTransactionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionVouchers()
    {
        return $this->hasMany(TransactionVoucher::className(), ['TransactionRequestId' => 'id']);
    }
}
