<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_addition_fee".
 *
 * @property integer $id
 * @property string $Amount
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $AmountInLocalCurrency
 * @property string $CreatedTime
 * @property integer $EmployeeId
 * @property string $Reason
 * @property integer $CustomerId
 * @property integer $OrderItemId
 * @property integer $Status
 * @property integer $CustomerConfirm
 * @property string $ConfirmTime
 * @property string $ConfirmMethod
 * @property integer $Type
 * @property string $ApprovedTime
 * @property integer $ApprovedEmployeeId
 * @property string $PaidAmount
 * @property string $PaidTime
 * @property string $PaymentMethod
 * @property integer $PaymentMethodProviderId
 * @property string $BankName
 * @property string $Note
 * @property string $Vat
 * @property string $PaidWeight
 * @property string $ActualWeight
 * @property string $ExtraWeight
 * @property integer $UOM
 * @property string $RatePerExtraWeight
 * @property integer $InformCustomerByEmail
 * @property string $OrderItemAmount
 * @property string $PurchaseItemAmount
 * @property integer $approvedStatus
 * @property integer $OrderAdditionFeeRequestPaymentId
 * @property integer $RefundedStatus
 * @property string $RefundedAmount
 * @property integer $WarehouseOptionGroupId
 * @property integer $WarehouseOptionSettingId
 * @property integer $ShippingOptionGroupId
 * @property integer $ShippingOptionSettingId
 * @property integer $OrderId
 * @property integer $WarehouseOptionSettingPriceId
 * @property integer $ShippingOptionSettingPriceId
 * @property integer $ExtraChargeQuantity
 * @property string $ExtraChargePrice
 *
 * @property SystemWeightUnit $uOM
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property OrderAdditionFeeRequestPayment $orderAdditionFeeRequestPayment
 * @property Order $order
 * @property WarehousePackageSettingPrices $warehouseOptionSettingPrice
 * @property ShippingOptionSettingPrices $shippingOptionSettingPrice
 * @property WarehousePackageSettingGroup $warehouseOptionGroup
 * @property WarehousePackageSetting $warehouseOptionSetting
 * @property ShippingOptionGroup $shippingOptionGroup
 * @property OrganizationEmployee $employee
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property Customer $customer
 * @property OrderItem $orderItem
 * @property OrganizationEmployee $approvedEmployee
 * @property SystemCurrency $currency
 * @property OrderItemRefund[] $orderItemRefunds
 */
class OrderAdditionFee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_addition_fee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Amount', 'CurrencyRate', 'AmountInLocalCurrency', 'PaidAmount', 'PaidWeight', 'ActualWeight', 'ExtraWeight', 'RatePerExtraWeight', 'OrderItemAmount', 'PurchaseItemAmount', 'RefundedAmount', 'ExtraChargePrice'], 'number'],
            [['CurrencyId', 'EmployeeId', 'CustomerId', 'OrderItemId', 'Status', 'CustomerConfirm', 'Type', 'ApprovedEmployeeId', 'PaymentMethodProviderId', 'UOM', 'InformCustomerByEmail', 'approvedStatus', 'OrderAdditionFeeRequestPaymentId', 'RefundedStatus', 'WarehouseOptionGroupId', 'WarehouseOptionSettingId', 'ShippingOptionGroupId', 'ShippingOptionSettingId', 'OrderId', 'WarehouseOptionSettingPriceId', 'ShippingOptionSettingPriceId', 'ExtraChargeQuantity'], 'integer'],
            [['CreatedTime', 'ConfirmTime', 'ApprovedTime', 'PaidTime'], 'safe'],
            [['Reason', 'ConfirmMethod', 'Note', 'Vat'], 'string', 'max' => 255],
            [['PaymentMethod', 'BankName'], 'string', 'max' => 50],
            [['UOM'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['UOM' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['OrderAdditionFeeRequestPaymentId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderAdditionFeeRequestPayment::className(), 'targetAttribute' => ['OrderAdditionFeeRequestPaymentId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['WarehouseOptionSettingPriceId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingPrices::className(), 'targetAttribute' => ['WarehouseOptionSettingPriceId' => 'id']],
            [['ShippingOptionSettingPriceId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSettingPrices::className(), 'targetAttribute' => ['ShippingOptionSettingPriceId' => 'id']],
            [['WarehouseOptionGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingGroup::className(), 'targetAttribute' => ['WarehouseOptionGroupId' => 'id']],
            [['WarehouseOptionSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['WarehouseOptionSettingId' => 'id']],
            [['ShippingOptionGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['ShippingOptionGroupId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
            [['ShippingOptionSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['ShippingOptionSettingId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['OrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['OrderItemId' => 'id']],
            [['ApprovedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApprovedEmployeeId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Amount' => 'Amount',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'AmountInLocalCurrency' => 'Amount In Local Currency',
            'CreatedTime' => 'Created Time',
            'EmployeeId' => 'Employee ID',
            'Reason' => 'Reason',
            'CustomerId' => 'Customer ID',
            'OrderItemId' => 'Order Item ID',
            'Status' => 'Status',
            'CustomerConfirm' => 'Customer Confirm',
            'ConfirmTime' => 'Confirm Time',
            'ConfirmMethod' => 'Confirm Method',
            'Type' => 'Type',
            'ApprovedTime' => 'Approved Time',
            'ApprovedEmployeeId' => 'Approved Employee ID',
            'PaidAmount' => 'Paid Amount',
            'PaidTime' => 'Paid Time',
            'PaymentMethod' => 'Payment Method',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'BankName' => 'Bank Name',
            'Note' => 'Note',
            'Vat' => 'Vat',
            'PaidWeight' => 'Paid Weight',
            'ActualWeight' => 'Actual Weight',
            'ExtraWeight' => 'Extra Weight',
            'UOM' => 'Uom',
            'RatePerExtraWeight' => 'Rate Per Extra Weight',
            'InformCustomerByEmail' => 'Inform Customer By Email',
            'OrderItemAmount' => 'Order Item Amount',
            'PurchaseItemAmount' => 'Purchase Item Amount',
            'approvedStatus' => 'Approved Status',
            'OrderAdditionFeeRequestPaymentId' => 'Order Addition Fee Request Payment ID',
            'RefundedStatus' => 'Refunded Status',
            'RefundedAmount' => 'Refunded Amount',
            'WarehouseOptionGroupId' => 'Warehouse Option Group ID',
            'WarehouseOptionSettingId' => 'Warehouse Option Setting ID',
            'ShippingOptionGroupId' => 'Shipping Option Group ID',
            'ShippingOptionSettingId' => 'Shipping Option Setting ID',
            'OrderId' => 'Order ID',
            'WarehouseOptionSettingPriceId' => 'Warehouse Option Setting Price ID',
            'ShippingOptionSettingPriceId' => 'Shipping Option Setting Price ID',
            'ExtraChargeQuantity' => 'Extra Charge Quantity',
            'ExtraChargePrice' => 'Extra Charge Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUOM()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'UOM']);
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
    public function getOrderAdditionFeeRequestPayment()
    {
        return $this->hasOne(OrderAdditionFeeRequestPayment::className(), ['id' => 'OrderAdditionFeeRequestPaymentId']);
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
    public function getWarehouseOptionSettingPrice()
    {
        return $this->hasOne(WarehousePackageSettingPrices::className(), ['id' => 'WarehouseOptionSettingPriceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrice()
    {
        return $this->hasOne(ShippingOptionSettingPrices::className(), ['id' => 'ShippingOptionSettingPriceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionGroup()
    {
        return $this->hasOne(WarehousePackageSettingGroup::className(), ['id' => 'WarehouseOptionGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionSetting()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'WarehouseOptionSettingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionGroup()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'ShippingOptionGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSetting()
    {
        return $this->hasOne(ShippingOptionSetting::className(), ['id' => 'ShippingOptionSettingId']);
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
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'OrderItemId']);
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
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['OrderAdditionalFeeId' => 'id']);
    }
}
