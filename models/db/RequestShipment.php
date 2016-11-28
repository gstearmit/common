<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_shipment".
 *
 * @property integer $id
 * @property string $RequestCode
 * @property string $TrackingCode
 * @property string $CreateTime
 * @property integer $QuantityPackages
 * @property integer $QuantityItemsPackages
 * @property string $TotalWeightPackages
 * @property string $ChargedWeightAfterPackaging
 * @property string $TotalPackageValues
 * @property string $TotalPackageInsuranceValues
 * @property integer $ShippingAddressId
 * @property string $CustomerNote
 * @property integer $CustomerId
 * @property integer $WarehouseId
 * @property integer $CurrencyId
 * @property string $TotalChargedInLocalCurrency
 * @property string $TotalChargedPaid
 * @property string $RemainChargedNotPaid
 * @property string $binCodeAddition
 * @property string $BankName
 * @property string $DefaultPaymentBenefitAccount
 * @property integer $PaymentMethodProviderId
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property string $PaymentHistoryToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property string $LastPaidTime
 * @property string $InvoiceNumber
 * @property string $RequestedTime
 * @property string $ProcessedTime
 * @property integer $ProcesssedByEmployeeId
 * @property integer $ProcessStatus
 * @property string $RejectedReason
 * @property integer $DeliveryStatus
 * @property integer $IsDeliveredToCustomer
 * @property string $DeliveredTime
 * @property integer $StoreId
 * @property string $Note
 * @property integer $QuantityScanned
 *
 * @property InvoiceMapRequestShipment[] $invoiceMapRequestShipments
 * @property Address $shippingAddress
 * @property Customer $customer
 * @property Warehouse $warehouse
 * @property SystemCurrency $currency
 * @property Store $store
 * @property OrganizationEmployee $processsedByEmployee
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property RequestShipmentItems[] $requestShipmentItems
 * @property RequestShipmentService[] $requestShipmentServices
 * @property Shipment[] $shipments
 */
class RequestShipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime', 'LastPaidTime', 'RequestedTime', 'ProcessedTime', 'DeliveredTime'], 'safe'],
            [['QuantityPackages', 'QuantityItemsPackages', 'ShippingAddressId', 'CustomerId', 'WarehouseId', 'CurrencyId', 'PaymentMethodProviderId', 'PaymentStatus', 'ProcesssedByEmployeeId', 'ProcessStatus', 'DeliveryStatus', 'IsDeliveredToCustomer', 'StoreId', 'QuantityScanned'], 'integer'],
            [['TotalWeightPackages', 'ChargedWeightAfterPackaging', 'TotalPackageValues', 'TotalPackageInsuranceValues', 'TotalChargedInLocalCurrency', 'TotalChargedPaid', 'RemainChargedNotPaid'], 'number'],
            [['RequestCode', 'TrackingCode', 'CustomerNote', 'DefaultPaymentBenefitAccount', 'PaymentToken', 'PaymentTransaction', 'RejectedReason'], 'string', 'max' => 255],
            [['binCodeAddition'], 'string', 'max' => 100],
            [['BankName', 'PaymentMethod'], 'string', 'max' => 50],
            [['PaymentHistoryToken'], 'string', 'max' => 1000],
            [['InvoiceNumber'], 'string', 'max' => 20],
            [['Note'], 'string', 'max' => 2000],
            [['ShippingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['ShippingAddressId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['WarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['ProcesssedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcesssedByEmployeeId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'RequestCode' => 'Request Code',
            'TrackingCode' => 'Tracking Code',
            'CreateTime' => 'Create Time',
            'QuantityPackages' => 'Quantity Packages',
            'QuantityItemsPackages' => 'Quantity Items Packages',
            'TotalWeightPackages' => 'Total Weight Packages',
            'ChargedWeightAfterPackaging' => 'Charged Weight After Packaging',
            'TotalPackageValues' => 'Total Package Values',
            'TotalPackageInsuranceValues' => 'Total Package Insurance Values',
            'ShippingAddressId' => 'Shipping Address ID',
            'CustomerNote' => 'Customer Note',
            'CustomerId' => 'Customer ID',
            'WarehouseId' => 'Warehouse ID',
            'CurrencyId' => 'Currency ID',
            'TotalChargedInLocalCurrency' => 'Total Charged In Local Currency',
            'TotalChargedPaid' => 'Total Charged Paid',
            'RemainChargedNotPaid' => 'Remain Charged Not Paid',
            'binCodeAddition' => 'Bin Code Addition',
            'BankName' => 'Bank Name',
            'DefaultPaymentBenefitAccount' => 'Default Payment Benefit Account',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentHistoryToken' => 'Payment History Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'LastPaidTime' => 'Last Paid Time',
            'InvoiceNumber' => 'Invoice Number',
            'RequestedTime' => 'Requested Time',
            'ProcessedTime' => 'Processed Time',
            'ProcesssedByEmployeeId' => 'Processsed By Employee ID',
            'ProcessStatus' => 'Process Status',
            'RejectedReason' => 'Rejected Reason',
            'DeliveryStatus' => 'Delivery Status',
            'IsDeliveredToCustomer' => 'Is Delivered To Customer',
            'DeliveredTime' => 'Delivered Time',
            'StoreId' => 'Store ID',
            'Note' => 'Note',
            'QuantityScanned' => 'Quantity Scanned',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapRequestShipments()
    {
        return $this->hasMany(InvoiceMapRequestShipment::className(), ['request_shipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'ShippingAddressId']);
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
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseId']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
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
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'PaymentMethodProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentItems()
    {
        return $this->hasMany(RequestShipmentItems::className(), ['requestShipmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['request_shipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['RequestShipmentId' => 'id']);
    }
}
