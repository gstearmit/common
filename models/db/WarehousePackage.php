<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package".
 *
 * @property integer $id
 * @property string $warehouseItemCode
 * @property string $postTrackingCode
 * @property integer $quantityInPackage
 * @property string $locationX
 * @property string $locationY
 * @property string $locationZ
 * @property string $locationCode
 * @property double $totalWeight
 * @property integer $systemWeightId
 * @property integer $systemDimensionId
 * @property integer $systemDimensionUnitId
 * @property string $inTime
 * @property string $outTime
 * @property integer $status
 * @property integer $employeeId
 * @property integer $transactionType
 * @property integer $orderid
 * @property string $totalAmountByQuantity
 * @property integer $warehouseId
 * @property integer $isNodefined
 * @property integer $isMappedAllPurchasedOrderId
 * @property string $Desciption
 * @property integer $isReturned
 * @property integer $ReturnType
 * @property string $ReturnTime
 * @property string $ReturnReceiveBy
 * @property integer $ReturnQuantity
 * @property integer $ReturnProcessStatus
 * @property string $ReturnDescription
 * @property integer $Shipment_Bulk_id
 * @property integer $TypePackage
 * @property integer $CustomerId
 * @property integer $RequestPackagesId
 * @property string $ActualWeightAfterPackaged
 * @property integer $ActualDimensionAfterPackagedId
 * @property string $ChargedWeight
 * @property string $TotalCharged
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $TotalChargedInLocalCurrency
 * @property string $TotalChargedPaid
 * @property string $RemainChargedNotPaid
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property string $LastPaidTime
 * @property string $DeclarationValues
 * @property string $CustomDeclarationValues
 * @property string $EstimatedValues
 * @property string $InsurancedValues
 * @property integer $TotalQuantityItems
 * @property string $Note
 * @property integer $ManageEmployeeId
 * @property integer $ManageOrganizationId
 * @property integer $StoreId
 * @property integer $ShippingStatus
 * @property string $ServiceDescription
 * @property integer $Deleted
 * @property string $DeletedTime
 * @property string $DeletedReason
 * @property integer $Restored
 * @property string $RestoredTime
 * @property string $RestoredReason
 * @property string $SourceSiteName
 * @property integer $ShipmentBulkAirbillId
 * @property integer $ShipmentBulkBoxId
 * @property integer $IsMapRequestShipment
 * @property integer $IsHold
 * @property string $HoldReason
 * @property double $ActualDimensionX
 * @property double $ActualDimensionY
 * @property double $ActualDimensionZ
 * @property string $WarehouseLocation
 * @property integer $refObjectId
 * @property string $actualWeightReceived
 * @property string $totalAmountInLocalCurrency
 * @property integer $isSurcharge
 * @property integer $shippingProviderId
 * @property integer $isPrintShippingLable
 * @property string $ShippingProviderCallBack
 * @property integer $isExtra
 *
 * @property RequestShipmentItems[] $requestShipmentItems
 * @property ShipmentItem[] $shipmentItems
 * @property SystemWeightUnit $systemWeight
 * @property SystemCurrency $currency
 * @property Store $store
 * @property OrganizationEmployee $manageEmployee
 * @property Organization $manageOrganization
 * @property ShipmentBulkAirbill $shipmentBulkAirbill
 * @property ShipmentBulkBox $shipmentBulkBox
 * @property WarehousePackage $refObject
 * @property WarehousePackage[] $warehousePackages
 * @property ShippingProvider $shippingProvider
 * @property SystemDimensionUnit $systemDimensionUnit
 * @property OrganizationEmployee $employee
 * @property SystemDimension $systemDimension
 * @property Warehouse $warehouse
 * @property ShipmentBulk $shipmentBulk
 * @property Customer $customer
 * @property RequestPackages $requestPackages
 * @property SystemDimensionUnit $actualDimensionAfterPackaged
 * @property WarehousePackageImage[] $warehousePackageImages
 * @property WarehousePackageItem[] $warehousePackageItems
 * @property WarehousePackageLog[] $warehousePackageLogs
 * @property WarehousePackageService[] $warehousePackageServices
 */
class WarehousePackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantityInPackage', 'systemWeightId', 'systemDimensionId', 'systemDimensionUnitId', 'status', 'employeeId', 'transactionType', 'orderid', 'warehouseId', 'isNodefined', 'isMappedAllPurchasedOrderId', 'isReturned', 'ReturnType', 'ReturnQuantity', 'ReturnProcessStatus', 'Shipment_Bulk_id', 'TypePackage', 'CustomerId', 'RequestPackagesId', 'ActualDimensionAfterPackagedId', 'CurrencyId', 'PaymentStatus', 'TotalQuantityItems', 'ManageEmployeeId', 'ManageOrganizationId', 'StoreId', 'ShippingStatus', 'Deleted', 'Restored', 'ShipmentBulkAirbillId', 'ShipmentBulkBoxId', 'IsMapRequestShipment', 'IsHold', 'refObjectId', 'isSurcharge', 'shippingProviderId', 'isPrintShippingLable', 'isExtra'], 'integer'],
            [['totalWeight', 'totalAmountByQuantity', 'ActualWeightAfterPackaged', 'ChargedWeight', 'TotalCharged', 'CurrencyRate', 'TotalChargedInLocalCurrency', 'TotalChargedPaid', 'RemainChargedNotPaid', 'DeclarationValues', 'CustomDeclarationValues', 'EstimatedValues', 'InsurancedValues', 'ActualDimensionX', 'ActualDimensionY', 'ActualDimensionZ', 'actualWeightReceived', 'totalAmountInLocalCurrency'], 'number'],
            [['inTime', 'outTime', 'ReturnTime', 'LastPaidTime', 'DeletedTime', 'RestoredTime'], 'safe'],
            [['warehouseItemCode', 'locationCode', 'PaymentMethod'], 'string', 'max' => 50],
            [['postTrackingCode'], 'string', 'max' => 100],
            [['locationX', 'locationY', 'locationZ', 'ShippingProviderCallBack'], 'string', 'max' => 10],
            [['Desciption', 'ReturnDescription', 'Note', 'DeletedReason', 'RestoredReason', 'HoldReason'], 'string', 'max' => 1000],
            [['ReturnReceiveBy', 'PaymentToken', 'PaymentTransaction', 'SourceSiteName', 'WarehouseLocation'], 'string', 'max' => 255],
            [['ServiceDescription'], 'string', 'max' => 2000],
            [['systemWeightId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['systemWeightId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['ManageEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ManageEmployeeId' => 'id']],
            [['ManageOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['ManageOrganizationId' => 'id']],
            [['ShipmentBulkAirbillId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkAirbill::className(), 'targetAttribute' => ['ShipmentBulkAirbillId' => 'id']],
            [['ShipmentBulkBoxId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkBox::className(), 'targetAttribute' => ['ShipmentBulkBoxId' => 'id']],
            [['refObjectId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['refObjectId' => 'id']],
            [['shippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['shippingProviderId' => 'id']],
            [['systemDimensionUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDimensionUnit::className(), 'targetAttribute' => ['systemDimensionUnitId' => 'id']],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['systemDimensionId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDimension::className(), 'targetAttribute' => ['systemDimensionId' => 'id']],
            [['warehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouseId' => 'id']],
            [['Shipment_Bulk_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['Shipment_Bulk_id' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['RequestPackagesId'], 'exist', 'skipOnError' => true, 'targetClass' => RequestPackages::className(), 'targetAttribute' => ['RequestPackagesId' => 'id']],
            [['ActualDimensionAfterPackagedId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDimensionUnit::className(), 'targetAttribute' => ['ActualDimensionAfterPackagedId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouseItemCode' => 'Warehouse Item Code',
            'postTrackingCode' => 'Post Tracking Code',
            'quantityInPackage' => 'Quantity In Package',
            'locationX' => 'Location X',
            'locationY' => 'Location Y',
            'locationZ' => 'Location Z',
            'locationCode' => 'Location Code',
            'totalWeight' => 'Total Weight',
            'systemWeightId' => 'System Weight ID',
            'systemDimensionId' => 'System Dimension ID',
            'systemDimensionUnitId' => 'System Dimension Unit ID',
            'inTime' => 'In Time',
            'outTime' => 'Out Time',
            'status' => 'Status',
            'employeeId' => 'Employee ID',
            'transactionType' => 'Transaction Type',
            'orderid' => 'Orderid',
            'totalAmountByQuantity' => 'Total Amount By Quantity',
            'warehouseId' => 'Warehouse ID',
            'isNodefined' => 'Is Nodefined',
            'isMappedAllPurchasedOrderId' => 'Is Mapped All Purchased Order ID',
            'Desciption' => 'Desciption',
            'isReturned' => 'Is Returned',
            'ReturnType' => 'Return Type',
            'ReturnTime' => 'Return Time',
            'ReturnReceiveBy' => 'Return Receive By',
            'ReturnQuantity' => 'Return Quantity',
            'ReturnProcessStatus' => 'Return Process Status',
            'ReturnDescription' => 'Return Description',
            'Shipment_Bulk_id' => 'Shipment  Bulk ID',
            'TypePackage' => 'Type Package',
            'CustomerId' => 'Customer ID',
            'RequestPackagesId' => 'Request Packages ID',
            'ActualWeightAfterPackaged' => 'Actual Weight After Packaged',
            'ActualDimensionAfterPackagedId' => 'Actual Dimension After Packaged ID',
            'ChargedWeight' => 'Charged Weight',
            'TotalCharged' => 'Total Charged',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'TotalChargedInLocalCurrency' => 'Total Charged In Local Currency',
            'TotalChargedPaid' => 'Total Charged Paid',
            'RemainChargedNotPaid' => 'Remain Charged Not Paid',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'LastPaidTime' => 'Last Paid Time',
            'DeclarationValues' => 'Declaration Values',
            'CustomDeclarationValues' => 'Custom Declaration Values',
            'EstimatedValues' => 'Estimated Values',
            'InsurancedValues' => 'Insuranced Values',
            'TotalQuantityItems' => 'Total Quantity Items',
            'Note' => 'Note',
            'ManageEmployeeId' => 'Manage Employee ID',
            'ManageOrganizationId' => 'Manage Organization ID',
            'StoreId' => 'Store ID',
            'ShippingStatus' => 'Shipping Status',
            'ServiceDescription' => 'Service Description',
            'Deleted' => 'Deleted',
            'DeletedTime' => 'Deleted Time',
            'DeletedReason' => 'Deleted Reason',
            'Restored' => 'Restored',
            'RestoredTime' => 'Restored Time',
            'RestoredReason' => 'Restored Reason',
            'SourceSiteName' => 'Source Site Name',
            'ShipmentBulkAirbillId' => 'Shipment Bulk Airbill ID',
            'ShipmentBulkBoxId' => 'Shipment Bulk Box ID',
            'IsMapRequestShipment' => 'Is Map Request Shipment',
            'IsHold' => 'Is Hold',
            'HoldReason' => 'Hold Reason',
            'ActualDimensionX' => 'Actual Dimension X',
            'ActualDimensionY' => 'Actual Dimension Y',
            'ActualDimensionZ' => 'Actual Dimension Z',
            'WarehouseLocation' => 'Warehouse Location',
            'refObjectId' => 'Ref Object ID',
            'actualWeightReceived' => 'Actual Weight Received',
            'totalAmountInLocalCurrency' => 'Total Amount In Local Currency',
            'isSurcharge' => 'Is Surcharge',
            'shippingProviderId' => 'Shipping Provider ID',
            'isPrintShippingLable' => 'Is Print Shipping Lable',
            'ShippingProviderCallBack' => 'Shipping Provider Call Back',
            'isExtra' => 'Is Extra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentItems()
    {
        return $this->hasMany(RequestShipmentItems::className(), ['warehousePackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentItems()
    {
        return $this->hasMany(ShipmentItem::className(), ['warehousePackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeight()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'systemWeightId']);
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
    public function getManageEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ManageEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'ManageOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbill()
    {
        return $this->hasOne(ShipmentBulkAirbill::className(), ['id' => 'ShipmentBulkAirbillId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBox()
    {
        return $this->hasOne(ShipmentBulkBox::className(), ['id' => 'ShipmentBulkBoxId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefObject()
    {
        return $this->hasOne(WarehousePackage::className(), ['id' => 'refObjectId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['refObjectId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'shippingProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemDimensionUnit()
    {
        return $this->hasOne(SystemDimensionUnit::className(), ['id' => 'systemDimensionUnitId']);
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
    public function getSystemDimension()
    {
        return $this->hasOne(SystemDimension::className(), ['id' => 'systemDimensionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'Shipment_Bulk_id']);
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
    public function getRequestPackages()
    {
        return $this->hasOne(RequestPackages::className(), ['id' => 'RequestPackagesId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActualDimensionAfterPackaged()
    {
        return $this->hasOne(SystemDimensionUnit::className(), ['id' => 'ActualDimensionAfterPackagedId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageImages()
    {
        return $this->hasMany(WarehousePackageImage::className(), ['warehouse_package_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['warehousePackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageLogs()
    {
        return $this->hasMany(WarehousePackageLog::className(), ['warehouse_package_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServices()
    {
        return $this->hasMany(WarehousePackageService::className(), ['WarehousePackageId' => 'id']);
    }
}
