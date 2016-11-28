<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_shipment_items".
 *
 * @property integer $id
 * @property integer $warehousePackageId
 * @property integer $requestShipmentId
 * @property string $description
 * @property string $scanTime
 * @property integer $isScan
 *
 * @property WarehousePackage $warehousePackage
 * @property RequestShipment $requestShipment
 */
class RequestShipmentItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_shipment_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehousePackageId', 'requestShipmentId', 'isScan'], 'integer'],
            [['scanTime'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['warehousePackageId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['warehousePackageId' => 'id']],
            [['requestShipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => RequestShipment::className(), 'targetAttribute' => ['requestShipmentId' => 'id']],
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
            'requestShipmentId' => 'Request Shipment ID',
            'description' => 'Description',
            'scanTime' => 'Scan Time',
            'isScan' => 'Is Scan',
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
    public function getRequestShipment()
    {
        return $this->hasOne(RequestShipment::className(), ['id' => 'requestShipmentId']);
    }
}
