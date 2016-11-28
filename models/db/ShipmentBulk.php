<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk".
 *
 * @property integer $id
 * @property string $name
 * @property string $trackingCode
 * @property string $createTime
 * @property string $updateTime
 * @property string $submitTime
 * @property string $receiveTime
 * @property integer $fromWarehouseId
 * @property integer $toWarehouseId
 * @property integer $carrierProviderId
 * @property integer $totalItemQuantity
 * @property string $totalWeight
 * @property string $totalFeeShip
 * @property string $totalFeeCustom
 * @property string $totalFeeInsurance
 * @property string $exchangeRate
 * @property string $totalAmount
 * @property string $finalAmount
 * @property string $finalAmountInLocalCurrency
 * @property string $description
 * @property integer $CurrencyId
 * @property integer $status
 * @property integer $createByEmployeeId
 * @property integer $viaChannelTypeId
 * @property integer $IsCompletedDeliverytoCustomer
 * @property integer $ManageEmployeeId
 * @property integer $UomId
 * @property string $MaxWeight
 * @property string $MinWeight
 * @property integer $NumberOfBoxes
 * @property integer $NumberOfAirBills
 * @property integer $StoreId
 * @property string $actualWeight
 * @property string $manifestLocation
 *
 * @property PurchaseOrderItem[] $purchaseOrderItems
 * @property PurchaseOrderItemRevision[] $purchaseOrderItemRevisions
 * @property PurchaseOrderItemTrackingcode[] $purchaseOrderItemTrackingcodes
 * @property Shipment[] $shipments
 * @property SystemCurrency $currency
 * @property Warehouse $fromWarehouse
 * @property Warehouse $toWarehouse
 * @property ShippingProvider $carrierProvider
 * @property OrganizationEmployee $createByEmployee
 * @property OrganizationEmployee $manageEmployee
 * @property SystemWeightUnit $uom
 * @property Store $store
 * @property ShipmentBulkAirbill[] $shipmentBulkAirbills
 * @property ShipmentBulkAttachments[] $shipmentBulkAttachments
 * @property ShipmentBulkExpense[] $shipmentBulkExpenses
 * @property ShipmentBulkImages[] $shipmentBulkImages
 * @property ShipmentBulkLog[] $shipmentBulkLogs
 * @property ShipmentBulkNote[] $shipmentBulkNotes
 * @property ShipmentBulkPackinglist[] $shipmentBulkPackinglists
 * @property ShipmentBulkTrackingcode[] $shipmentBulkTrackingcodes
 * @property WarehousePackage[] $warehousePackages
 */
class ShipmentBulk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime', 'submitTime', 'receiveTime'], 'safe'],
            [['fromWarehouseId', 'toWarehouseId', 'carrierProviderId', 'totalItemQuantity', 'CurrencyId', 'status', 'createByEmployeeId', 'viaChannelTypeId', 'IsCompletedDeliverytoCustomer', 'ManageEmployeeId', 'UomId', 'NumberOfBoxes', 'NumberOfAirBills', 'StoreId'], 'integer'],
            [['totalWeight', 'totalFeeShip', 'totalFeeCustom', 'totalFeeInsurance', 'exchangeRate', 'totalAmount', 'finalAmount', 'finalAmountInLocalCurrency', 'MaxWeight', 'MinWeight', 'actualWeight'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['trackingCode'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 4000],
            [['manifestLocation'], 'string', 'max' => 500],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['fromWarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['fromWarehouseId' => 'id']],
            [['toWarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['toWarehouseId' => 'id']],
            [['carrierProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['carrierProviderId' => 'id']],
            [['createByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['createByEmployeeId' => 'id']],
            [['ManageEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ManageEmployeeId' => 'id']],
            [['UomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['UomId' => 'id']],
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
            'name' => 'Name',
            'trackingCode' => 'Tracking Code',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'submitTime' => 'Submit Time',
            'receiveTime' => 'Receive Time',
            'fromWarehouseId' => 'From Warehouse ID',
            'toWarehouseId' => 'To Warehouse ID',
            'carrierProviderId' => 'Carrier Provider ID',
            'totalItemQuantity' => 'Total Item Quantity',
            'totalWeight' => 'Total Weight',
            'totalFeeShip' => 'Total Fee Ship',
            'totalFeeCustom' => 'Total Fee Custom',
            'totalFeeInsurance' => 'Total Fee Insurance',
            'exchangeRate' => 'Exchange Rate',
            'totalAmount' => 'Total Amount',
            'finalAmount' => 'Final Amount',
            'finalAmountInLocalCurrency' => 'Final Amount In Local Currency',
            'description' => 'Description',
            'CurrencyId' => 'Currency ID',
            'status' => 'Status',
            'createByEmployeeId' => 'Create By Employee ID',
            'viaChannelTypeId' => 'Via Channel Type ID',
            'IsCompletedDeliverytoCustomer' => 'Is Completed Deliveryto Customer',
            'ManageEmployeeId' => 'Manage Employee ID',
            'UomId' => 'Uom ID',
            'MaxWeight' => 'Max Weight',
            'MinWeight' => 'Min Weight',
            'NumberOfBoxes' => 'Number Of Boxes',
            'NumberOfAirBills' => 'Number Of Air Bills',
            'StoreId' => 'Store ID',
            'actualWeight' => 'Actual Weight',
            'manifestLocation' => 'Manifest Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::className(), ['PackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRevisions()
    {
        return $this->hasMany(PurchaseOrderItemRevision::className(), ['PackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemTrackingcodes()
    {
        return $this->hasMany(PurchaseOrderItemTrackingcode::className(), ['shipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['bulkId' => 'id']);
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
    public function getFromWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'fromWarehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'toWarehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrierProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'carrierProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'createByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ManageEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'UomId']);
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
    public function getShipmentBulkAirbills()
    {
        return $this->hasMany(ShipmentBulkAirbill::className(), ['shipment_bulk_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAttachments()
    {
        return $this->hasMany(ShipmentBulkAttachments::className(), ['ShipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkExpenses()
    {
        return $this->hasMany(ShipmentBulkExpense::className(), ['ShipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkImages()
    {
        return $this->hasMany(ShipmentBulkImages::className(), ['ShipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkLogs()
    {
        return $this->hasMany(ShipmentBulkLog::className(), ['ShipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkNotes()
    {
        return $this->hasMany(ShipmentBulkNote::className(), ['shipment_bulk_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkPackinglists()
    {
        return $this->hasMany(ShipmentBulkPackinglist::className(), ['shipment_bulk_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingcodes()
    {
        return $this->hasMany(ShipmentBulkTrackingcode::className(), ['shipmentBulkId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['Shipment_Bulk_id' => 'id']);
    }
}
