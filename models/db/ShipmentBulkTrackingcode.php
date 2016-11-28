<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_trackingcode".
 *
 * @property integer $id
 * @property string $trackingCode
 * @property string $originalTrackingCode
 * @property integer $quantity
 * @property integer $quantityScanned
 * @property integer $isScanned
 * @property string $scannedTime
 * @property integer $shipmentBulkId
 * @property string $Note
 * @property integer $Box
 * @property integer $ShippingProviderId
 * @property string $ImportedTime
 * @property integer $IsMapped
 * @property integer $deleted
 * @property string $purchasedTrackingCode
 * @property integer $purchaseItemId
 * @property integer $purchasedQuantity
 * @property string $purchasedTotalAmount
 * @property string $productItemSku
 * @property string $productName
 * @property string $productNameLocalLanguage
 * @property string $productImagePath
 * @property string $weight
 * @property string $priceDeclaration
 * @property integer $typeOrderId
 * @property string $totalExpensePerPackage
 *
 * @property ShipmentBulkTrackingCodeExpense[] $shipmentBulkTrackingCodeExpenses
 * @property ShipmentBulk $shipmentBulk
 * @property ShippingProvider $shippingProvider
 * @property PurchaseOrderItem $purchaseItem
 * @property ShipmentBulkTrackingcodeImage[] $shipmentBulkTrackingcodeImages
 */
class ShipmentBulkTrackingcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_trackingcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'quantityScanned', 'isScanned', 'shipmentBulkId', 'Box', 'ShippingProviderId', 'IsMapped', 'deleted', 'purchaseItemId', 'purchasedQuantity', 'typeOrderId'], 'integer'],
            [['scannedTime', 'ImportedTime'], 'safe'],
            [['purchasedTotalAmount', 'weight', 'priceDeclaration', 'totalExpensePerPackage'], 'number'],
            [['productImagePath'], 'string'],
            [['trackingCode', 'originalTrackingCode', 'purchasedTrackingCode'], 'string', 'max' => 100],
            [['Note', 'productItemSku', 'productName'], 'string', 'max' => 255],
            [['productNameLocalLanguage'], 'string', 'max' => 1000],
            [['shipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['shipmentBulkId' => 'id']],
            [['ShippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['ShippingProviderId' => 'id']],
            [['purchaseItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['purchaseItemId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trackingCode' => 'Tracking Code',
            'originalTrackingCode' => 'Original Tracking Code',
            'quantity' => 'Quantity',
            'quantityScanned' => 'Quantity Scanned',
            'isScanned' => 'Is Scanned',
            'scannedTime' => 'Scanned Time',
            'shipmentBulkId' => 'Shipment Bulk ID',
            'Note' => 'Note',
            'Box' => 'Box',
            'ShippingProviderId' => 'Shipping Provider ID',
            'ImportedTime' => 'Imported Time',
            'IsMapped' => 'Is Mapped',
            'deleted' => 'Deleted',
            'purchasedTrackingCode' => 'Purchased Tracking Code',
            'purchaseItemId' => 'Purchase Item ID',
            'purchasedQuantity' => 'Purchased Quantity',
            'purchasedTotalAmount' => 'Purchased Total Amount',
            'productItemSku' => 'Product Item Sku',
            'productName' => 'Product Name',
            'productNameLocalLanguage' => 'Product Name Local Language',
            'productImagePath' => 'Product Image Path',
            'weight' => 'Weight',
            'priceDeclaration' => 'Price Declaration',
            'typeOrderId' => 'Type Order ID',
            'totalExpensePerPackage' => 'Total Expense Per Package',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingCodeExpenses()
    {
        return $this->hasMany(ShipmentBulkTrackingCodeExpense::className(), ['ShipmentBulkTrackingCodeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'shipmentBulkId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'ShippingProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseItem()
    {
        return $this->hasOne(PurchaseOrderItem::className(), ['id' => 'purchaseItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingcodeImages()
    {
        return $this->hasMany(ShipmentBulkTrackingcodeImage::className(), ['trackingCodeId' => 'id']);
    }
}
