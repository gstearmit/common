<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_airbill".
 *
 * @property integer $id
 * @property string $Description
 * @property string $TrackingCode
 * @property string $Note
 * @property integer $NumberOfBoxes
 * @property integer $TotalItemsQuantitySent
 * @property integer $TotalItemsSpecialQuantitySent
 * @property string $TotalWeightSent
 * @property string $TotalFeeShip
 * @property string $TotalFeeCustom
 * @property string $TotalFeeInsurance
 * @property integer $CurrencyId
 * @property string $ExchangeRate
 * @property string $TotalItemsAmount
 * @property string $TotalItemsAmountInLocalCurrency
 * @property integer $TotalItemsQuantityActualReceived
 * @property double $TotalWeightActualReceived
 * @property integer $ProcessStatus
 * @property integer $UomId
 * @property string $MaxWeight
 * @property integer $MaxItems
 * @property string $fileNamePath
 * @property string $UploadTime
 * @property integer $shipment_bulk_id
 *
 * @property ShipmentBulk $shipmentBulk
 * @property SystemCurrency $currency
 * @property SystemUnitOfMessure $uom
 * @property ShipmentBulkAirbillCategoryMapping[] $shipmentBulkAirbillCategoryMappings
 * @property ShipmentBulkBox[] $shipmentBulkBoxes
 * @property ShipmentBulkCustom[] $shipmentBulkCustoms
 * @property WarehousePackage[] $warehousePackages
 */
class ShipmentBulkAirbill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_airbill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NumberOfBoxes', 'TotalItemsQuantitySent', 'TotalItemsSpecialQuantitySent', 'CurrencyId', 'TotalItemsQuantityActualReceived', 'ProcessStatus', 'UomId', 'MaxItems', 'shipment_bulk_id'], 'integer'],
            [['TotalWeightSent', 'TotalFeeShip', 'TotalFeeCustom', 'TotalFeeInsurance', 'ExchangeRate', 'TotalItemsAmount', 'TotalItemsAmountInLocalCurrency', 'TotalWeightActualReceived', 'MaxWeight'], 'number'],
            [['UploadTime'], 'safe'],
            [['Description', 'fileNamePath'], 'string', 'max' => 255],
            [['TrackingCode', 'Note'], 'string', 'max' => 500],
            [['shipment_bulk_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['shipment_bulk_id' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['UomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UomId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Description' => 'Description',
            'TrackingCode' => 'Tracking Code',
            'Note' => 'Note',
            'NumberOfBoxes' => 'Number Of Boxes',
            'TotalItemsQuantitySent' => 'Total Items Quantity Sent',
            'TotalItemsSpecialQuantitySent' => 'Total Items Special Quantity Sent',
            'TotalWeightSent' => 'Total Weight Sent',
            'TotalFeeShip' => 'Total Fee Ship',
            'TotalFeeCustom' => 'Total Fee Custom',
            'TotalFeeInsurance' => 'Total Fee Insurance',
            'CurrencyId' => 'Currency ID',
            'ExchangeRate' => 'Exchange Rate',
            'TotalItemsAmount' => 'Total Items Amount',
            'TotalItemsAmountInLocalCurrency' => 'Total Items Amount In Local Currency',
            'TotalItemsQuantityActualReceived' => 'Total Items Quantity Actual Received',
            'TotalWeightActualReceived' => 'Total Weight Actual Received',
            'ProcessStatus' => 'Process Status',
            'UomId' => 'Uom ID',
            'MaxWeight' => 'Max Weight',
            'MaxItems' => 'Max Items',
            'fileNamePath' => 'File Name Path',
            'UploadTime' => 'Upload Time',
            'shipment_bulk_id' => 'Shipment Bulk ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'shipment_bulk_id']);
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
    public function getUom()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'UomId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbillCategoryMappings()
    {
        return $this->hasMany(ShipmentBulkAirbillCategoryMapping::className(), ['ShipmentBulkAirbillId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBoxes()
    {
        return $this->hasMany(ShipmentBulkBox::className(), ['ShipmentBulkAirBillId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustoms()
    {
        return $this->hasMany(ShipmentBulkCustom::className(), ['aribill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['ShipmentBulkAirbillId' => 'id']);
    }
}
