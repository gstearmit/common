<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment".
 *
 * @property integer $id
 * @property integer $bulkId
 * @property string $createTime
 * @property integer $quantity
 * @property integer $productTypeQuantity
 * @property double $totalWeightItem
 * @property double $totalWeightAfterPackaging
 * @property integer $customerId
 * @property integer $orderId
 * @property integer $employeeId
 * @property string $shippingCodeToCustomerDoor
 * @property string $shippingCodeCreateTime
 * @property integer $sendStatus
 * @property integer $shippingAddressId
 * @property string $shippingFee
 * @property integer $printTicketStatus
 * @property integer $scanStatus
 * @property string $barcode
 * @property string $totalPrice
 * @property integer $shippingId
 * @property integer $totalquantity
 * @property integer $shipmentoption
 * @property integer $location
 * @property integer $StoreId
 * @property integer $WarehouseId
 * @property string $ShipedTime
 * @property string $DeliveriedTime
 * @property integer $RequestShipmentId
 * @property integer $ShippingStatus
 * @property integer $SystemAccountTransactionVoucherId
 * @property integer $billingAddressId
 *
 * @property InvoiceMapShipment[] $invoiceMapShipments
 * @property Address $shippingAddress
 * @property ShipmentBulk $bulk
 * @property Order $order
 * @property Customer $customer
 * @property OrganizationEmployee $employee
 * @property RequestShipment $requestShipment
 * @property SystemAccountTransactionVoucher $systemAccountTransactionVoucher
 * @property Address $billingAddress
 * @property ShipmentItem[] $shipmentItems
 * @property ShipmentLog[] $shipmentLogs
 * @property ShipmentTracking[] $shipmentTrackings
 * @property ShippingPackageLocal[] $shippingPackageLocals
 */
class Shipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bulkId', 'quantity', 'productTypeQuantity', 'customerId', 'orderId', 'employeeId', 'sendStatus', 'shippingAddressId', 'printTicketStatus', 'scanStatus', 'shippingId', 'totalquantity', 'shipmentoption', 'location', 'StoreId', 'WarehouseId', 'RequestShipmentId', 'ShippingStatus', 'SystemAccountTransactionVoucherId', 'billingAddressId'], 'integer'],
            [['createTime', 'shippingCodeCreateTime', 'ShipedTime', 'DeliveriedTime'], 'safe'],
            [['totalWeightItem', 'totalWeightAfterPackaging', 'shippingFee', 'totalPrice'], 'number'],
            [['shippingCodeToCustomerDoor'], 'string', 'max' => 100],
            [['barcode'], 'string', 'max' => 255],
            [['shippingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['shippingAddressId' => 'id']],
            [['bulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['bulkId' => 'id']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['RequestShipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => RequestShipment::className(), 'targetAttribute' => ['RequestShipmentId' => 'id']],
            [['SystemAccountTransactionVoucherId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransactionVoucher::className(), 'targetAttribute' => ['SystemAccountTransactionVoucherId' => 'id']],
            [['billingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['billingAddressId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bulkId' => 'Bulk ID',
            'createTime' => 'Create Time',
            'quantity' => 'Quantity',
            'productTypeQuantity' => 'Product Type Quantity',
            'totalWeightItem' => 'Total Weight Item',
            'totalWeightAfterPackaging' => 'Total Weight After Packaging',
            'customerId' => 'Customer ID',
            'orderId' => 'Order ID',
            'employeeId' => 'Employee ID',
            'shippingCodeToCustomerDoor' => 'Shipping Code To Customer Door',
            'shippingCodeCreateTime' => 'Shipping Code Create Time',
            'sendStatus' => 'Send Status',
            'shippingAddressId' => 'Shipping Address ID',
            'shippingFee' => 'Shipping Fee',
            'printTicketStatus' => 'Print Ticket Status',
            'scanStatus' => 'Scan Status',
            'barcode' => 'Barcode',
            'totalPrice' => 'Total Price',
            'shippingId' => 'Shipping ID',
            'totalquantity' => 'Totalquantity',
            'shipmentoption' => 'Shipmentoption',
            'location' => 'Location',
            'StoreId' => 'Store ID',
            'WarehouseId' => 'Warehouse ID',
            'ShipedTime' => 'Shiped Time',
            'DeliveriedTime' => 'Deliveried Time',
            'RequestShipmentId' => 'Request Shipment ID',
            'ShippingStatus' => 'Shipping Status',
            'SystemAccountTransactionVoucherId' => 'System Account Transaction Voucher ID',
            'billingAddressId' => 'Billing Address ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipments()
    {
        return $this->hasMany(InvoiceMapShipment::className(), ['shipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'shippingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'bulkId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'employeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipment()
    {
        return $this->hasOne(RequestShipment::className(), ['id' => 'RequestShipmentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVoucher()
    {
        return $this->hasOne(SystemAccountTransactionVoucher::className(), ['id' => 'SystemAccountTransactionVoucherId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'billingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentItems()
    {
        return $this->hasMany(ShipmentItem::className(), ['shipmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentLogs()
    {
        return $this->hasMany(ShipmentLog::className(), ['ShipmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentTrackings()
    {
        return $this->hasMany(ShipmentTracking::className(), ['ShipmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['shipmentId' => 'id']);
    }
}
