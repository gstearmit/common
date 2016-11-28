<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "payment_method_provider".
 *
 * @property integer $id
 * @property integer $paymentMethodId
 * @property integer $paymentProviderId
 * @property string $feePerTransaction
 * @property integer $isCustomerPayFee
 *
 * @property DiscountPayment[] $discountPayments
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property Order[] $orders
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 * @property PaymentProvider $paymentProvider
 * @property PaymentMethod $paymentMethod
 * @property RequestShipment[] $requestShipments
 * @property SystemAccountTransaction[] $systemAccountTransactions
 * @property Transaction[] $transactions
 * @property TransactionExternal[] $transactionExternals
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionRefundDelegate[] $transactionRefundDelegates
 * @property TransactionRequest[] $transactionRequests
 */
class PaymentMethodProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentMethodId', 'paymentProviderId'], 'required'],
            [['paymentMethodId', 'paymentProviderId', 'isCustomerPayFee'], 'integer'],
            [['feePerTransaction'], 'number'],
            [['paymentProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentProvider::className(), 'targetAttribute' => ['paymentProviderId' => 'id']],
            [['paymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['paymentMethodId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paymentMethodId' => 'Payment Method ID',
            'paymentProviderId' => 'Payment Provider ID',
            'feePerTransaction' => 'Fee Per Transaction',
            'isCustomerPayFee' => 'Is Customer Pay Fee',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountPayments()
    {
        return $this->hasMany(DiscountPayment::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['paymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentProvider()
    {
        return $this->hasOne(PaymentProvider::className(), ['id' => 'paymentProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'paymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternals()
    {
        return $this->hasMany(TransactionExternal::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['PaymentMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRefundDelegates()
    {
        return $this->hasMany(TransactionRefundDelegate::className(), ['RequestMethodProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['PaymentMethodProviderId' => 'id']);
    }
}
