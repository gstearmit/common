<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_refund_delegate".
 *
 * @property integer $id
 * @property string $RequestRefundedAmount
 * @property string $RequestTime
 * @property string $RequestOrderInvoiceNumber
 * @property string $RequestTransactionCode
 * @property string $RequestTransactionThirdPartyCode
 * @property string $RequestTransactionThirPartyToken
 * @property string $RequestNote
 * @property integer $RequestMethodProviderId
 * @property string $RequestReturnUrl
 * @property string $RequestProtectToken
 * @property string $FromTransactionSystemAccount
 * @property string $ToTransactionSystemAccount
 * @property integer $ProcessStatus
 * @property integer $PaidStatus
 * @property string $RefundedAmount
 * @property string $RefundedTime
 * @property string $RefundedTransactionConfirmCode
 * @property string $RefundedTransactionCode
 * @property string $RefundedTransactionThirPartyToken
 * @property string $RefundedTransactionThirdPartyCode
 * @property string $PaymentMethodProviderName
 * @property integer $CustomerId
 * @property string $CustomerEmail
 * @property integer $CurrencyId
 * @property integer $StoreId
 *
 * @property SystemCurrency $currency
 * @property Customer $customer
 * @property PaymentMethodProvider $requestMethodProvider
 * @property Store $store
 */
class TransactionRefundDelegate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_refund_delegate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RequestRefundedAmount', 'RefundedAmount'], 'number'],
            [['RequestTime', 'RefundedTime'], 'safe'],
            [['RequestMethodProviderId', 'ProcessStatus', 'PaidStatus', 'CustomerId', 'CurrencyId', 'StoreId'], 'integer'],
            [['RequestOrderInvoiceNumber', 'RequestTransactionCode', 'RequestTransactionThirdPartyCode', 'FromTransactionSystemAccount', 'ToTransactionSystemAccount', 'RefundedTransactionCode', 'RefundedTransactionThirdPartyCode', 'PaymentMethodProviderName', 'CustomerEmail'], 'string', 'max' => 50],
            [['RequestTransactionThirPartyToken', 'RequestReturnUrl', 'RequestProtectToken', 'RefundedTransactionConfirmCode', 'RefundedTransactionThirPartyToken'], 'string', 'max' => 255],
            [['RequestNote'], 'string', 'max' => 300],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['RequestMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['RequestMethodProviderId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'RequestRefundedAmount' => 'Request Refunded Amount',
            'RequestTime' => 'Request Time',
            'RequestOrderInvoiceNumber' => 'Request Order Invoice Number',
            'RequestTransactionCode' => 'Request Transaction Code',
            'RequestTransactionThirdPartyCode' => 'Request Transaction Third Party Code',
            'RequestTransactionThirPartyToken' => 'Request Transaction Thir Party Token',
            'RequestNote' => 'Request Note',
            'RequestMethodProviderId' => 'Request Method Provider ID',
            'RequestReturnUrl' => 'Request Return Url',
            'RequestProtectToken' => 'Request Protect Token',
            'FromTransactionSystemAccount' => 'From Transaction System Account',
            'ToTransactionSystemAccount' => 'To Transaction System Account',
            'ProcessStatus' => 'Process Status',
            'PaidStatus' => 'Paid Status',
            'RefundedAmount' => 'Refunded Amount',
            'RefundedTime' => 'Refunded Time',
            'RefundedTransactionConfirmCode' => 'Refunded Transaction Confirm Code',
            'RefundedTransactionCode' => 'Refunded Transaction Code',
            'RefundedTransactionThirPartyToken' => 'Refunded Transaction Thir Party Token',
            'RefundedTransactionThirdPartyCode' => 'Refunded Transaction Third Party Code',
            'PaymentMethodProviderName' => 'Payment Method Provider Name',
            'CustomerId' => 'Customer ID',
            'CustomerEmail' => 'Customer Email',
            'CurrencyId' => 'Currency ID',
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
    public function getRequestMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'RequestMethodProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
