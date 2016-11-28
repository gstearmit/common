<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_queue".
 *
 * @property integer $id
 * @property integer $TransactionId
 * @property string $RefTransactionThirdParty
 * @property string $RequestTokenCode
 * @property string $CreatedDate
 * @property string $CreditAmountInLocalCurrency
 * @property string $DebitAmountInLocalCurrency
 * @property string $TotalAmount
 * @property string $TotalPaidAmount
 * @property string $TotalRemainAmount
 * @property string $OrderInvoiceNumber
 * @property string $OrderDescription
 * @property integer $PaymentStatus
 * @property integer $CustomerId
 * @property string $AccountTranfersId
 * @property string $AccountTransfers
 * @property string $AccountName
 * @property string $AccountEmail
 * @property string $AccountPhone
 * @property string $AcountAdress
 * @property string $PaymentTransactionRequestCode
 * @property string $PaymentThirdpartyTransactionReturn
 * @property string $PaymentThirdpartyToken
 * @property string $PaymentThirdpartyTokenHistory
 * @property integer $PaymentMethodProviderId
 * @property string $PaymentMethodName
 * @property string $PaymentBankCode
 * @property integer $ProcessStatus
 * @property integer $TypeTransaction
 * @property integer $TypeActivity
 * @property integer $CurrencyId
 * @property string $CurrencyName
 * @property integer $CheckByEmployeeId
 * @property string $CheckDate
 * @property integer $ApproveByEmployeeId
 * @property string $ApproveDate
 * @property integer $StoreId
 * @property integer $Success
 * @property string $Note
 * @property integer $IsDelete
 * @property integer $MaxTries
 * @property integer $SentTries
 * @property string $SentTime
 * @property integer $SentStatus
 * @property string $SentUrl
 * @property integer $FromRefAccountSystemId
 * @property string $FromRefAccountSystemName
 * @property integer $ToRefAccountSystemId
 * @property string $ToRefAccountSystemName
 * @property integer $OriginalTransactionId
 *
 * @property TransactionAccountSystem $toRefAccountSystem
 * @property Transaction $originalTransaction
 * @property Transaction $transaction
 * @property Customer $customer
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property SystemCurrency $currency
 * @property OrganizationEmployee $checkByEmployee
 * @property OrganizationEmployee $approveByEmployee
 * @property Store $store
 * @property TransactionAccountSystem $fromRefAccountSystem
 * @property TransactionQueueLog[] $transactionQueueLogs
 */
class TransactionQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TransactionId', 'PaymentStatus', 'CustomerId', 'PaymentMethodProviderId', 'ProcessStatus', 'TypeTransaction', 'TypeActivity', 'CurrencyId', 'CheckByEmployeeId', 'ApproveByEmployeeId', 'StoreId', 'Success', 'IsDelete', 'MaxTries', 'SentTries', 'SentStatus', 'FromRefAccountSystemId', 'ToRefAccountSystemId', 'OriginalTransactionId'], 'integer'],
            [['RequestTokenCode', 'CreatedDate', 'CustomerId', 'AccountEmail', 'TypeTransaction', 'TypeActivity', 'CurrencyId', 'StoreId'], 'required'],
            [['CreatedDate', 'CheckDate', 'ApproveDate', 'SentTime'], 'safe'],
            [['CreditAmountInLocalCurrency', 'DebitAmountInLocalCurrency', 'TotalAmount', 'TotalPaidAmount', 'TotalRemainAmount'], 'number'],
            [['RefTransactionThirdParty', 'RequestTokenCode', 'OrderInvoiceNumber', 'AccountTranfersId', 'AccountName', 'AccountEmail', 'PaymentThirdpartyTransactionReturn', 'PaymentThirdpartyToken', 'PaymentBankCode'], 'string', 'max' => 50],
            [['OrderDescription'], 'string', 'max' => 500],
            [['AccountTransfers', 'AcountAdress', 'PaymentTransactionRequestCode', 'Note', 'SentUrl', 'FromRefAccountSystemName', 'ToRefAccountSystemName'], 'string', 'max' => 255],
            [['AccountPhone', 'CurrencyName'], 'string', 'max' => 20],
            [['PaymentThirdpartyTokenHistory'], 'string', 'max' => 1000],
            [['PaymentMethodName'], 'string', 'max' => 100],
            [['ToRefAccountSystemId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionAccountSystem::className(), 'targetAttribute' => ['ToRefAccountSystemId' => 'id']],
            [['OriginalTransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['OriginalTransactionId' => 'id']],
            [['TransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['TransactionId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['CheckByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CheckByEmployeeId' => 'id']],
            [['ApproveByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApproveByEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['FromRefAccountSystemId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionAccountSystem::className(), 'targetAttribute' => ['FromRefAccountSystemId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TransactionId' => 'Transaction ID',
            'RefTransactionThirdParty' => 'Ref Transaction Third Party',
            'RequestTokenCode' => 'Request Token Code',
            'CreatedDate' => 'Created Date',
            'CreditAmountInLocalCurrency' => 'Credit Amount In Local Currency',
            'DebitAmountInLocalCurrency' => 'Debit Amount In Local Currency',
            'TotalAmount' => 'Total Amount',
            'TotalPaidAmount' => 'Total Paid Amount',
            'TotalRemainAmount' => 'Total Remain Amount',
            'OrderInvoiceNumber' => 'Order Invoice Number',
            'OrderDescription' => 'Order Description',
            'PaymentStatus' => 'Payment Status',
            'CustomerId' => 'Customer ID',
            'AccountTranfersId' => 'Account Tranfers ID',
            'AccountTransfers' => 'Account Transfers',
            'AccountName' => 'Account Name',
            'AccountEmail' => 'Account Email',
            'AccountPhone' => 'Account Phone',
            'AcountAdress' => 'Acount Adress',
            'PaymentTransactionRequestCode' => 'Payment Transaction Request Code',
            'PaymentThirdpartyTransactionReturn' => 'Payment Thirdparty Transaction Return',
            'PaymentThirdpartyToken' => 'Payment Thirdparty Token',
            'PaymentThirdpartyTokenHistory' => 'Payment Thirdparty Token History',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'PaymentMethodName' => 'Payment Method Name',
            'PaymentBankCode' => 'Payment Bank Code',
            'ProcessStatus' => 'Process Status',
            'TypeTransaction' => 'Type Transaction',
            'TypeActivity' => 'Type Activity',
            'CurrencyId' => 'Currency ID',
            'CurrencyName' => 'Currency Name',
            'CheckByEmployeeId' => 'Check By Employee ID',
            'CheckDate' => 'Check Date',
            'ApproveByEmployeeId' => 'Approve By Employee ID',
            'ApproveDate' => 'Approve Date',
            'StoreId' => 'Store ID',
            'Success' => 'Success',
            'Note' => 'Note',
            'IsDelete' => 'Is Delete',
            'MaxTries' => 'Max Tries',
            'SentTries' => 'Sent Tries',
            'SentTime' => 'Sent Time',
            'SentStatus' => 'Sent Status',
            'SentUrl' => 'Sent Url',
            'FromRefAccountSystemId' => 'From Ref Account System ID',
            'FromRefAccountSystemName' => 'From Ref Account System Name',
            'ToRefAccountSystemId' => 'To Ref Account System ID',
            'ToRefAccountSystemName' => 'To Ref Account System Name',
            'OriginalTransactionId' => 'Original Transaction ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToRefAccountSystem()
    {
        return $this->hasOne(TransactionAccountSystem::className(), ['id' => 'ToRefAccountSystemId']);
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
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'TransactionId']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromRefAccountSystem()
    {
        return $this->hasOne(TransactionAccountSystem::className(), ['id' => 'FromRefAccountSystemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueLogs()
    {
        return $this->hasMany(TransactionQueueLog::className(), ['TransactionQueueId' => 'id']);
    }
}
