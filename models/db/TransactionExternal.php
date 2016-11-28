<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_external".
 *
 * @property integer $id
 * @property integer $BenefitTransactionAccountSystemId
 * @property integer $TypeTransaction
 * @property string $OriginalTransactionCode
 * @property string $OrginalTransactionThirdPartyCode
 * @property string $OrginalTransactionThirPartyToken
 * @property string $OrderInvoiceNumber
 * @property string $VoucherReceiptNumber
 * @property string $TransactionProtectToken
 * @property string $Note
 * @property string $CreatedDate
 * @property string $CreditAmountInLocalCurrency
 * @property string $DebitAmountInLocalCurrency
 * @property string $TotalAmountInLocalCurrency
 * @property string $PaidAmountInLocalCurrency
 * @property integer $PaidStatus
 * @property integer $PaymentMethodProviderId
 * @property string $PaymentMethodProviderName
 * @property string $IsRefundedTransaction
 * @property integer $ProcessStatus
 * @property string $ProcessTime
 * @property integer $CustomerId
 * @property string $CustomerEmail
 * @property integer $CurrencyId
 * @property integer $ProcessedByEmployeeId
 * @property string $ProcessedByEmployeeEmail
 * @property integer $StoreId
 *
 * @property SystemCurrency $currency
 * @property Customer $customer
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Store $store
 * @property TransactionAccountSystem $benefitTransactionAccountSystem
 * @property TransactionExternalVoucher[] $transactionExternalVouchers
 */
class TransactionExternal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_external';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BenefitTransactionAccountSystemId', 'TypeTransaction', 'PaidStatus', 'PaymentMethodProviderId', 'ProcessStatus', 'CustomerId', 'CurrencyId', 'ProcessedByEmployeeId', 'StoreId'], 'integer'],
            [['CreatedDate', 'ProcessTime'], 'safe'],
            [['CreditAmountInLocalCurrency', 'DebitAmountInLocalCurrency', 'TotalAmountInLocalCurrency', 'PaidAmountInLocalCurrency'], 'number'],
            [['OriginalTransactionCode', 'OrginalTransactionThirdPartyCode', 'OrderInvoiceNumber', 'VoucherReceiptNumber', 'PaymentMethodProviderName', 'CustomerEmail'], 'string', 'max' => 50],
            [['OrginalTransactionThirPartyToken', 'TransactionProtectToken', 'IsRefundedTransaction', 'ProcessedByEmployeeEmail'], 'string', 'max' => 255],
            [['Note'], 'string', 'max' => 300],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['BenefitTransactionAccountSystemId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionAccountSystem::className(), 'targetAttribute' => ['BenefitTransactionAccountSystemId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'BenefitTransactionAccountSystemId' => 'Benefit Transaction Account System ID',
            'TypeTransaction' => 'Type Transaction',
            'OriginalTransactionCode' => 'Original Transaction Code',
            'OrginalTransactionThirdPartyCode' => 'Orginal Transaction Third Party Code',
            'OrginalTransactionThirPartyToken' => 'Orginal Transaction Thir Party Token',
            'OrderInvoiceNumber' => 'Order Invoice Number',
            'VoucherReceiptNumber' => 'Voucher Receipt Number',
            'TransactionProtectToken' => 'Transaction Protect Token',
            'Note' => 'Note',
            'CreatedDate' => 'Created Date',
            'CreditAmountInLocalCurrency' => 'Credit Amount In Local Currency',
            'DebitAmountInLocalCurrency' => 'Debit Amount In Local Currency',
            'TotalAmountInLocalCurrency' => 'Total Amount In Local Currency',
            'PaidAmountInLocalCurrency' => 'Paid Amount In Local Currency',
            'PaidStatus' => 'Paid Status',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'PaymentMethodProviderName' => 'Payment Method Provider Name',
            'IsRefundedTransaction' => 'Is Refunded Transaction',
            'ProcessStatus' => 'Process Status',
            'ProcessTime' => 'Process Time',
            'CustomerId' => 'Customer ID',
            'CustomerEmail' => 'Customer Email',
            'CurrencyId' => 'Currency ID',
            'ProcessedByEmployeeId' => 'Processed By Employee ID',
            'ProcessedByEmployeeEmail' => 'Processed By Employee Email',
            'StoreId' => 'Store ID',
        ];
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefitTransactionAccountSystem()
    {
        return $this->hasOne(TransactionAccountSystem::className(), ['id' => 'BenefitTransactionAccountSystemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternalVouchers()
    {
        return $this->hasMany(TransactionExternalVoucher::className(), ['TransactionExternalId' => 'id']);
    }
}
