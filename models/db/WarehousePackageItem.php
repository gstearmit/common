<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_item".
 *
 * @property integer $id
 * @property string $warehousePackageBarcode
 * @property integer $warehousePackageId
 * @property integer $purchaseOrderItemId
 * @property integer $orderItemId
 * @property integer $productId
 * @property string $productName
 * @property string $productLink
 * @property integer $receiptedQuantity
 * @property integer $Status
 * @property string $amountByQuantity
 * @property integer $IsMapped
 * @property string $Note
 * @property integer $TypeId
 * @property integer $errorCustomerAcceptedReceive
 * @property integer $errorQuantity
 * @property string $errorDescription
 * @property integer $errorPercentage
 * @property integer $ReturnQuantityByCustomer
 * @property string $ReturnDescriptionByCustomer
 * @property string $ReturnTimeByCustomer
 * @property string $ReturnTrackingToSupplier
 * @property string $ReturnTimeToSupplier
 * @property integer $ReturnByEmployeeId
 * @property integer $TypeConfirmBySuppiler
 * @property string $RefundTransactionCode
 * @property string $TrackingCodeReturnBySupplier
 * @property integer $SendReturnToCustomer
 * @property string $SendReturnTimetoCustomer
 * @property string $SendReturnTrackingCode
 * @property integer $ReturnProcessStatus
 * @property string $ServiceDescription
 * @property string $ServiceChargedPerItem
 * @property string $amountDelareByCustomer
 * @property string $finalAmount
 * @property string $amountInsuranceByQuantity
 * @property string $amountInsuranceByCustomer
 * @property string $finalInsuranceAmount
 * @property integer $CategoryCustomPolicyId
 * @property integer $isLockAmount
 * @property integer $isLockInsuranceAmount
 * @property integer $ProductStatusTypeId
 * @property integer $CurrencyId
 *
 * @property WarehousePackage $warehousePackage
 * @property PurchaseOrderItem $purchaseOrderItem
 * @property Product $product
 * @property OrderItem $orderItem
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property SystemCurrency $currency
 * @property WarehousePackageItemImage[] $warehousePackageItemImages
 * @property WarehousePackageItemLog[] $warehousePackageItemLogs
 * @property WarehousePackageItemService[] $warehousePackageItemServices
 */
class WarehousePackageItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehousePackageId', 'purchaseOrderItemId', 'orderItemId', 'productId', 'receiptedQuantity', 'Status', 'IsMapped', 'TypeId', 'errorCustomerAcceptedReceive', 'errorQuantity', 'errorPercentage', 'ReturnQuantityByCustomer', 'ReturnByEmployeeId', 'TypeConfirmBySuppiler', 'SendReturnToCustomer', 'ReturnProcessStatus', 'CategoryCustomPolicyId', 'isLockAmount', 'isLockInsuranceAmount', 'ProductStatusTypeId', 'CurrencyId'], 'integer'],
            [['amountByQuantity', 'ServiceChargedPerItem', 'amountDelareByCustomer', 'finalAmount', 'amountInsuranceByQuantity', 'amountInsuranceByCustomer', 'finalInsuranceAmount'], 'number'],
            [['ReturnTimeByCustomer', 'ReturnTimeToSupplier', 'SendReturnTimetoCustomer'], 'safe'],
            [['warehousePackageBarcode', 'productName', 'ReturnDescriptionByCustomer', 'RefundTransactionCode', 'TrackingCodeReturnBySupplier', 'SendReturnTrackingCode'], 'string', 'max' => 255],
            [['productLink', 'errorDescription'], 'string', 'max' => 500],
            [['Note'], 'string', 'max' => 1000],
            [['ReturnTrackingToSupplier'], 'string', 'max' => 50],
            [['ServiceDescription'], 'string', 'max' => 2000],
            [['warehousePackageId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['warehousePackageId' => 'id']],
            [['purchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['purchaseOrderItemId' => 'id']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'id']],
            [['orderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['orderItemId' => 'id']],
            [['CategoryCustomPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['CategoryCustomPolicyId' => 'id']],
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
            'warehousePackageBarcode' => 'Warehouse Package Barcode',
            'warehousePackageId' => 'Warehouse Package ID',
            'purchaseOrderItemId' => 'Purchase Order Item ID',
            'orderItemId' => 'Order Item ID',
            'productId' => 'Product ID',
            'productName' => 'Product Name',
            'productLink' => 'Product Link',
            'receiptedQuantity' => 'Receipted Quantity',
            'Status' => 'Status',
            'amountByQuantity' => 'Amount By Quantity',
            'IsMapped' => 'Is Mapped',
            'Note' => 'Note',
            'TypeId' => 'Type ID',
            'errorCustomerAcceptedReceive' => 'Error Customer Accepted Receive',
            'errorQuantity' => 'Error Quantity',
            'errorDescription' => 'Error Description',
            'errorPercentage' => 'Error Percentage',
            'ReturnQuantityByCustomer' => 'Return Quantity By Customer',
            'ReturnDescriptionByCustomer' => 'Return Description By Customer',
            'ReturnTimeByCustomer' => 'Return Time By Customer',
            'ReturnTrackingToSupplier' => 'Return Tracking To Supplier',
            'ReturnTimeToSupplier' => 'Return Time To Supplier',
            'ReturnByEmployeeId' => 'Return By Employee ID',
            'TypeConfirmBySuppiler' => 'Type Confirm By Suppiler',
            'RefundTransactionCode' => 'Refund Transaction Code',
            'TrackingCodeReturnBySupplier' => 'Tracking Code Return By Supplier',
            'SendReturnToCustomer' => 'Send Return To Customer',
            'SendReturnTimetoCustomer' => 'Send Return Timeto Customer',
            'SendReturnTrackingCode' => 'Send Return Tracking Code',
            'ReturnProcessStatus' => 'Return Process Status',
            'ServiceDescription' => 'Service Description',
            'ServiceChargedPerItem' => 'Service Charged Per Item',
            'amountDelareByCustomer' => 'Amount Delare By Customer',
            'finalAmount' => 'Final Amount',
            'amountInsuranceByQuantity' => 'Amount Insurance By Quantity',
            'amountInsuranceByCustomer' => 'Amount Insurance By Customer',
            'finalInsuranceAmount' => 'Final Insurance Amount',
            'CategoryCustomPolicyId' => 'Category Custom Policy ID',
            'isLockAmount' => 'Is Lock Amount',
            'isLockInsuranceAmount' => 'Is Lock Insurance Amount',
            'ProductStatusTypeId' => 'Product Status Type ID',
            'CurrencyId' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackage()
    {
        return $this->hasOne(WarehousePackage::className(), ['id' => 'warehousePackageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItem()
    {
        return $this->hasOne(PurchaseOrderItem::className(), ['id' => 'purchaseOrderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'orderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'CategoryCustomPolicyId']);
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
    public function getWarehousePackageItemImages()
    {
        return $this->hasMany(WarehousePackageItemImage::className(), ['warehouse_package_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItemLogs()
    {
        return $this->hasMany(WarehousePackageItemLog::className(), ['warehouse_package_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItemServices()
    {
        return $this->hasMany(WarehousePackageItemService::className(), ['warehouse_package_item_id' => 'id']);
    }
}
