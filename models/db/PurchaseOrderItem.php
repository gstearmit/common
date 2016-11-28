<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item".
 *
 * @property integer $id
 * @property integer $PurchaseOrderId
 * @property integer $ProductId
 * @property string $ProductOriginalCode
 * @property string $ProductName
 * @property string $Description
 * @property string $Price
 * @property double $TaxRate
 * @property string $TaxAmount
 * @property string $ShipFeeAmount
 * @property string $CustomFeeAmount
 * @property string $InspectionFee
 * @property double $Weight
 * @property integer $Quantity
 * @property integer $QuantityReceived
 * @property integer $QuantityCancel
 * @property integer $QuantityBill
 * @property string $SubTotalAmount
 * @property string $TotalAmountInLocalCurreny
 * @property double $ExRate
 * @property string $TotalAmountInForeignCurrency
 * @property integer $ShippingStatus
 * @property integer $ReturnStatus
 * @property integer $PackageId
 * @property integer $MerchantId
 * @property integer $IsRequestInspection
 * @property integer $ItemLine
 * @property integer $UnitOfMessureId
 * @property integer $ItemRevision
 * @property string $PromiseComingTime
 * @property string $ActualComingTime
 * @property string $NoteForInspection
 * @property integer $IsCancel
 * @property string $CancelReason
 * @property string $CancelDate
 * @property integer $Rev
 * @property string $TrackingCodeItems
 * @property string $transactionCode
 * @property string $PaypalAmount
 * @property string $MerchantEmail
 * @property integer $isNoTrackingCode
 * @property integer $viaChannelId
 * @property integer $isInPackage
 * @property integer $CategoryCustomPolicyId
 * @property string $TotalOrderConvertedToLocalCurrencyByPaypal
 *
 * @property InvoiceMapPurchaseItem[] $invoiceMapPurchaseItems
 * @property OrderItem[] $orderItems
 * @property PurchaseOrder $purchaseOrder
 * @property Product $product
 * @property ShipmentBulk $package
 * @property SystemUnitOfMessure $unitOfMessure
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property PurchaseOrderItemRefund[] $purchaseOrderItemRefunds
 * @property PurchaseOrderItemReturn[] $purchaseOrderItemReturns
 * @property PurchaseOrderItemRevision[] $purchaseOrderItemRevisions
 * @property PurchaseOrderItemTrackingcode[] $purchaseOrderItemTrackingcodes
 * @property ShipmentBulkTrackingcode[] $shipmentBulkTrackingcodes
 * @property WarehousePackageItem[] $warehousePackageItems
 */
class PurchaseOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PurchaseOrderId', 'ProductId', 'Quantity', 'QuantityReceived', 'QuantityCancel', 'QuantityBill', 'ShippingStatus', 'ReturnStatus', 'PackageId', 'MerchantId', 'IsRequestInspection', 'ItemLine', 'UnitOfMessureId', 'ItemRevision', 'IsCancel', 'Rev', 'isNoTrackingCode', 'viaChannelId', 'isInPackage', 'CategoryCustomPolicyId'], 'integer'],
            [['Price', 'TaxRate', 'TaxAmount', 'ShipFeeAmount', 'CustomFeeAmount', 'InspectionFee', 'Weight', 'SubTotalAmount', 'TotalAmountInLocalCurreny', 'ExRate', 'TotalAmountInForeignCurrency', 'PaypalAmount', 'TotalOrderConvertedToLocalCurrencyByPaypal'], 'number'],
            [['PromiseComingTime', 'ActualComingTime', 'CancelDate'], 'safe'],
            [['ProductOriginalCode', 'transactionCode'], 'string', 'max' => 100],
            [['ProductName', 'Description', 'NoteForInspection', 'CancelReason', 'TrackingCodeItems', 'MerchantEmail'], 'string', 'max' => 255],
            [['PurchaseOrderId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['PurchaseOrderId' => 'id']],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['PackageId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['PackageId' => 'id']],
            [['UnitOfMessureId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UnitOfMessureId' => 'id']],
            [['CategoryCustomPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['CategoryCustomPolicyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PurchaseOrderId' => 'Purchase Order ID',
            'ProductId' => 'Product ID',
            'ProductOriginalCode' => 'Product Original Code',
            'ProductName' => 'Product Name',
            'Description' => 'Description',
            'Price' => 'Price',
            'TaxRate' => 'Tax Rate',
            'TaxAmount' => 'Tax Amount',
            'ShipFeeAmount' => 'Ship Fee Amount',
            'CustomFeeAmount' => 'Custom Fee Amount',
            'InspectionFee' => 'Inspection Fee',
            'Weight' => 'Weight',
            'Quantity' => 'Quantity',
            'QuantityReceived' => 'Quantity Received',
            'QuantityCancel' => 'Quantity Cancel',
            'QuantityBill' => 'Quantity Bill',
            'SubTotalAmount' => 'Sub Total Amount',
            'TotalAmountInLocalCurreny' => 'Total Amount In Local Curreny',
            'ExRate' => 'Ex Rate',
            'TotalAmountInForeignCurrency' => 'Total Amount In Foreign Currency',
            'ShippingStatus' => 'Shipping Status',
            'ReturnStatus' => 'Return Status',
            'PackageId' => 'Package ID',
            'MerchantId' => 'Merchant ID',
            'IsRequestInspection' => 'Is Request Inspection',
            'ItemLine' => 'Item Line',
            'UnitOfMessureId' => 'Unit Of Messure ID',
            'ItemRevision' => 'Item Revision',
            'PromiseComingTime' => 'Promise Coming Time',
            'ActualComingTime' => 'Actual Coming Time',
            'NoteForInspection' => 'Note For Inspection',
            'IsCancel' => 'Is Cancel',
            'CancelReason' => 'Cancel Reason',
            'CancelDate' => 'Cancel Date',
            'Rev' => 'Rev',
            'TrackingCodeItems' => 'Tracking Code Items',
            'transactionCode' => 'Transaction Code',
            'PaypalAmount' => 'Paypal Amount',
            'MerchantEmail' => 'Merchant Email',
            'isNoTrackingCode' => 'Is No Tracking Code',
            'viaChannelId' => 'Via Channel ID',
            'isInPackage' => 'Is In Package',
            'CategoryCustomPolicyId' => 'Category Custom Policy ID',
            'TotalOrderConvertedToLocalCurrencyByPaypal' => 'Total Order Converted To Local Currency By Paypal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItems()
    {
        return $this->hasMany(InvoiceMapPurchaseItem::className(), ['purchase_order_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['PurchaseOrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'PurchaseOrderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'ProductId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'PackageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMessure()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'UnitOfMessureId']);
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
    public function getPurchaseOrderItemRefunds()
    {
        return $this->hasMany(PurchaseOrderItemRefund::className(), ['PurchaseOrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemReturns()
    {
        return $this->hasMany(PurchaseOrderItemReturn::className(), ['PurchaseOrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRevisions()
    {
        return $this->hasMany(PurchaseOrderItemRevision::className(), ['PurchaseOrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemTrackingcodes()
    {
        return $this->hasMany(PurchaseOrderItemTrackingcode::className(), ['purchaseOrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingcodes()
    {
        return $this->hasMany(ShipmentBulkTrackingcode::className(), ['purchaseItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['purchaseOrderItemId' => 'id']);
    }
}
