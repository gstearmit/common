<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_attachments".
 *
 * @property integer $id
 * @property string $FileName
 * @property string $FIlePath
 * @property string $UploadedTime
 * @property resource $FileBlob
 * @property integer $ShipmentBulkId
 * @property integer $ShipmentBulkCustomId
 *
 * @property ShipmentBulk $shipmentBulk
 * @property ShipmentBulkCustom $shipmentBulkCustom
 */
class ShipmentBulkAttachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UploadedTime'], 'safe'],
            [['FileBlob'], 'string'],
            [['ShipmentBulkId', 'ShipmentBulkCustomId'], 'integer'],
            [['FileName', 'FIlePath'], 'string', 'max' => 255],
            [['ShipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['ShipmentBulkId' => 'id']],
            [['ShipmentBulkCustomId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkCustom::className(), 'targetAttribute' => ['ShipmentBulkCustomId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FileName' => 'File Name',
            'FIlePath' => 'File Path',
            'UploadedTime' => 'Uploaded Time',
            'FileBlob' => 'File Blob',
            'ShipmentBulkId' => 'Shipment Bulk ID',
            'ShipmentBulkCustomId' => 'Shipment Bulk Custom ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'ShipmentBulkId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustom()
    {
        return $this->hasOne(ShipmentBulkCustom::className(), ['id' => 'ShipmentBulkCustomId']);
    }
}
