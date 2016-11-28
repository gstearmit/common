<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_packinglist".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $shipment_bulk_id
 * @property string $filePath
 * @property string $createdTime
 *
 * @property ShipmentBulkCustom[] $shipmentBulkCustoms
 * @property ShipmentBulk $shipmentBulk
 */
class ShipmentBulkPackinglist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_packinglist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipment_bulk_id'], 'integer'],
            [['createdTime'], 'safe'],
            [['name', 'description', 'filePath'], 'string', 'max' => 255],
            [['shipment_bulk_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['shipment_bulk_id' => 'id']],
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
            'description' => 'Description',
            'shipment_bulk_id' => 'Shipment Bulk ID',
            'filePath' => 'File Path',
            'createdTime' => 'Created Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustoms()
    {
        return $this->hasMany(ShipmentBulkCustom::className(), ['packinglist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'shipment_bulk_id']);
    }
}
