<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_item_refund".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $RefundType
 * @property string $RequestedTime
 * @property string $RequestedAmount
 * @property string $Reason
 * @property integer $OrderItemId
 * @property integer $ProcessedEmployeeId
 * @property string $ProcessedTime
 * @property integer $Status
 * @property integer $CustomerConfirm
 * @property string $ConfirmTime
 * @property string $ConfirmMethod
 * @property integer $ChannelId
 * @property string $ApprovedTime
 * @property integer $ApprovedEmployeeId
 * @property string $ApprovedAmount
 * @property integer $TransactionId
 * @property string $RefundedToken
 * @property string $RefundedAmount
 * @property string $RefundedTime
 * @property integer $RefundedEmployeeId
 * @property string $Note
 * @property integer $ClaimId
 * @property string $RefundedAmountType
 * @property string $preApproveTime
 * @property integer $preApproveEmployeeId
 * @property integer $preApproveStatus
 * @property string $preApproveNote
 * @property string $refundedNote
 * @property integer $storeId
 * @property integer $OrderAdditionalFeeId
 * @property string $FromSystemAccount
 * @property string $ToSystemAccount
 * @property string $CustomerBenefitAccount
 * @property integer $OrderRefundRequestPaymentId
 *
 * @property InvoiceMapOrderItemRefund[] $invoiceMapOrderItemRefunds
 * @property Customer $customer
 * @property OrderAdditionFee $orderAdditionalFee
 * @property OrderRefundRequestPayment $orderRefundRequestPayment
 * @property OrderItem $orderItem
 * @property OrganizationEmployee $processedEmployee
 * @property OrganizationEmployee $approvedEmployee
 * @property OrganizationEmployee $refundedEmployee
 * @property CustomerClaim $claim
 * @property OrganizationEmployee $preApproveEmployee
 * @property Store $store
 */
class OrderItemRefund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item_refund';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'RefundType', 'OrderItemId', 'ProcessedEmployeeId', 'Status', 'CustomerConfirm', 'ChannelId', 'ApprovedEmployeeId', 'TransactionId', 'RefundedEmployeeId', 'ClaimId', 'preApproveEmployeeId', 'preApproveStatus', 'storeId', 'OrderAdditionalFeeId', 'OrderRefundRequestPaymentId'], 'integer'],
            [['RequestedTime', 'ProcessedTime', 'ConfirmTime', 'ApprovedTime', 'RefundedTime', 'preApproveTime'], 'safe'],
            [['RequestedAmount', 'ApprovedAmount', 'RefundedAmount', 'RefundedAmountType'], 'number'],
            [['FromSystemAccount', 'ToSystemAccount', 'OrderRefundRequestPaymentId'], 'required'],
            [['Reason', 'ConfirmMethod', 'RefundedToken', 'Note', 'preApproveNote', 'refundedNote', 'FromSystemAccount', 'ToSystemAccount', 'CustomerBenefitAccount'], 'string', 'max' => 255],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['OrderAdditionalFeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderAdditionFee::className(), 'targetAttribute' => ['OrderAdditionalFeeId' => 'id']],
            [['OrderRefundRequestPaymentId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderRefundRequestPayment::className(), 'targetAttribute' => ['OrderRefundRequestPaymentId' => 'id']],
            [['OrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['OrderItemId' => 'id']],
            [['ProcessedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcessedEmployeeId' => 'id']],
            [['ApprovedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApprovedEmployeeId' => 'id']],
            [['RefundedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['RefundedEmployeeId' => 'id']],
            [['ClaimId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerClaim::className(), 'targetAttribute' => ['ClaimId' => 'id']],
            [['preApproveEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['preApproveEmployeeId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CustomerId' => 'Customer ID',
            'RefundType' => 'Refund Type',
            'RequestedTime' => 'Requested Time',
            'RequestedAmount' => 'Requested Amount',
            'Reason' => 'Reason',
            'OrderItemId' => 'Order Item ID',
            'ProcessedEmployeeId' => 'Processed Employee ID',
            'ProcessedTime' => 'Processed Time',
            'Status' => 'Status',
            'CustomerConfirm' => 'Customer Confirm',
            'ConfirmTime' => 'Confirm Time',
            'ConfirmMethod' => 'Confirm Method',
            'ChannelId' => 'Channel ID',
            'ApprovedTime' => 'Approved Time',
            'ApprovedEmployeeId' => 'Approved Employee ID',
            'ApprovedAmount' => 'Approved Amount',
            'TransactionId' => 'Transaction ID',
            'RefundedToken' => 'Refunded Token',
            'RefundedAmount' => 'Refunded Amount',
            'RefundedTime' => 'Refunded Time',
            'RefundedEmployeeId' => 'Refunded Employee ID',
            'Note' => 'Note',
            'ClaimId' => 'Claim ID',
            'RefundedAmountType' => 'Refunded Amount Type',
            'preApproveTime' => 'Pre Approve Time',
            'preApproveEmployeeId' => 'Pre Approve Employee ID',
            'preApproveStatus' => 'Pre Approve Status',
            'preApproveNote' => 'Pre Approve Note',
            'refundedNote' => 'Refunded Note',
            'storeId' => 'Store ID',
            'OrderAdditionalFeeId' => 'Order Additional Fee ID',
            'FromSystemAccount' => 'From System Account',
            'ToSystemAccount' => 'To System Account',
            'CustomerBenefitAccount' => 'Customer Benefit Account',
            'OrderRefundRequestPaymentId' => 'Order Refund Request Payment ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItemRefunds()
    {
        return $this->hasMany(InvoiceMapOrderItemRefund::className(), ['order_item_refund_id' => 'id']);
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
    public function getOrderAdditionalFee()
    {
        return $this->hasOne(OrderAdditionFee::className(), ['id' => 'OrderAdditionalFeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayment()
    {
        return $this->hasOne(OrderRefundRequestPayment::className(), ['id' => 'OrderRefundRequestPaymentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'OrderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessedEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcessedEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ApprovedEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefundedEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'RefundedEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaim()
    {
        return $this->hasOne(CustomerClaim::className(), ['id' => 'ClaimId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreApproveEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'preApproveEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }
}
