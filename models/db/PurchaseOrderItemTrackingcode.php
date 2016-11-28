<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_trackingcode".
 *
 * @property integer $id
 * @property string $trackingCode
 * @property integer $purchaseOrderItemId
 * @property integer $quantity
 * @property integer $isScanned
 * @property string $scannedTime
 * @property integer $shipmentBulkId
 * @property integer $type
 *
 * @property PurchaseOrderItem $purchaseOrderItem
 * @property ShipmentBulk $shipmentBulk
 */
class PurchaseOrderItemTrackingcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_trackingcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchaseOrderItemId', 'quantity', 'isScanned', 'shipmentBulkId', 'type'], 'integer'],
            [['scannedTime'], 'safe'],
            [['trackingCode'], 'string', 'max' => 100],
            [['purchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['purchaseOrderItemId' => 'id']],
            [['shipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['shipmentBulkId' => 'id']],
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
            'purchaseOrderItemId' => 'Purchase Order Item ID',
            'quantity' => 'Quantity',
            'isScanned' => 'Is Scanned',
            'scannedTime' => 'Scanned Time',
            'shipmentBulkId' => 'Shipment Bulk ID',
            'type' => 'Type',
        ];
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
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'shipmentBulkId']);
    }
}
