<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_images".
 *
 * @property integer $id
 * @property string $CreateTime
 * @property string $Description
 * @property resource $FileBlob
 * @property string $UrlPath
 * @property string $UploadByEmployee
 * @property integer $ShipmentBulkId
 * @property integer $shipmentBulkBoxId
 *
 * @property ShipmentBulk $shipmentBulk
 * @property ShipmentBulkBox $shipmentBulkBox
 */
class ShipmentBulkImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime'], 'safe'],
            [['FileBlob'], 'string'],
            [['ShipmentBulkId', 'shipmentBulkBoxId'], 'integer'],
            [['Description'], 'string', 'max' => 500],
            [['UrlPath'], 'string', 'max' => 250],
            [['UploadByEmployee'], 'string', 'max' => 50],
            [['ShipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['ShipmentBulkId' => 'id']],
            [['shipmentBulkBoxId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkBox::className(), 'targetAttribute' => ['shipmentBulkBoxId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CreateTime' => 'Create Time',
            'Description' => 'Description',
            'FileBlob' => 'File Blob',
            'UrlPath' => 'Url Path',
            'UploadByEmployee' => 'Upload By Employee',
            'ShipmentBulkId' => 'Shipment Bulk ID',
            'shipmentBulkBoxId' => 'Shipment Bulk Box ID',
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
    public function getShipmentBulkBox()
    {
        return $this->hasOne(ShipmentBulkBox::className(), ['id' => 'shipmentBulkBoxId']);
    }
}
