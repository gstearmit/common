<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_item".
 *
 * @property integer $id
 * @property integer $warehousePackageId
 * @property integer $shipmentId
 * @property double $weight
 * @property string $dimension
 * @property integer $quantity
 * @property string $description
 * @property integer $scanStatus
 * @property string $barcode
 * @property string $productdetail
 *
 * @property WarehousePackage $warehousePackage
 * @property Shipment $shipment
 */
class ShipmentItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehousePackageId', 'shipmentId', 'quantity', 'scanStatus'], 'integer'],
            [['weight'], 'number'],
            [['productdetail'], 'string'],
            [['dimension'], 'string', 'max' => 50],
            [['description', 'barcode'], 'string', 'max' => 255],
            [['warehousePackageId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['warehousePackageId' => 'id']],
            [['shipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['shipmentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehousePackageId' => 'Warehouse Package ID',
            'shipmentId' => 'Shipment ID',
            'weight' => 'Weight',
            'dimension' => 'Dimension',
            'quantity' => 'Quantity',
            'description' => 'Description',
            'scanStatus' => 'Scan Status',
            'barcode' => 'Barcode',
            'productdetail' => 'Productdetail',
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
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'shipmentId']);
    }
}
