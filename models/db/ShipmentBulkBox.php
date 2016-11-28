<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_box".
 *
 * @property integer $id
 * @property string $Name
 * @property string $TrackingCode
 * @property string $Description
 * @property string $CreateTime
 * @property integer $MaxItems
 * @property string $MaxWeight
 * @property integer $TotalItemQuantitySent
 * @property string $TotalWeightSent
 * @property string $TotalFeeShip
 * @property string $TotalFeeCustom
 * @property string $TotalFeeInsurance
 * @property integer $CurrencyId
 * @property string $ExchangeRate
 * @property string $TotalItemsAmount
 * @property string $TotalItemInLocalCurrency
 * @property integer $TotalItemQuantityActualReceived
 * @property double $TotalWeightActualReceived
 * @property integer $ProcessStatus
 * @property integer $ShipmentBulkAirBillId
 * @property integer $UomId
 * @property string $ActualWeight
 * @property string $UpdateTime
 * @property string $SubmitTime
 * @property string $ReceiveTime
 * @property double $DimensionX
 * @property double $DimensionY
 * @property double $DimnesionZ
 * @property integer $SystemWeightUnitId
 * @property integer $SystemDimensionUnitId
 *
 * @property SystemCurrency $currency
 * @property ShipmentBulkAirbill $shipmentBulkAirBill
 * @property SystemUnitOfMessure $uom
 * @property SystemWeightUnit $systemWeightUnit
 * @property SystemDimensionUnit $systemDimensionUnit
 * @property ShipmentBulkImages[] $shipmentBulkImages
 * @property WarehousePackage[] $warehousePackages
 */
class ShipmentBulkBox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime', 'UpdateTime', 'SubmitTime', 'ReceiveTime'], 'safe'],
            [['MaxItems', 'TotalItemQuantitySent', 'CurrencyId', 'TotalItemQuantityActualReceived', 'ProcessStatus', 'ShipmentBulkAirBillId', 'UomId', 'SystemWeightUnitId', 'SystemDimensionUnitId'], 'integer'],
            [['MaxWeight', 'TotalWeightSent', 'TotalFeeShip', 'TotalFeeCustom', 'TotalFeeInsurance', 'ExchangeRate', 'TotalItemsAmount', 'TotalItemInLocalCurrency', 'TotalWeightActualReceived', 'ActualWeight', 'DimensionX', 'DimensionY', 'DimnesionZ'], 'number'],
            [['Name'], 'string', 'max' => 255],
            [['TrackingCode', 'Description'], 'string', 'max' => 50],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['ShipmentBulkAirBillId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkAirbill::className(), 'targetAttribute' => ['ShipmentBulkAirBillId' => 'id']],
            [['UomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UomId' => 'id']],
            [['SystemWeightUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightUnitId' => 'id']],
            [['SystemDimensionUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDimensionUnit::className(), 'targetAttribute' => ['SystemDimensionUnitId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'TrackingCode' => 'Tracking Code',
            'Description' => 'Description',
            'CreateTime' => 'Create Time',
            'MaxItems' => 'Max Items',
            'MaxWeight' => 'Max Weight',
            'TotalItemQuantitySent' => 'Total Item Quantity Sent',
            'TotalWeightSent' => 'Total Weight Sent',
            'TotalFeeShip' => 'Total Fee Ship',
            'TotalFeeCustom' => 'Total Fee Custom',
            'TotalFeeInsurance' => 'Total Fee Insurance',
            'CurrencyId' => 'Currency ID',
            'ExchangeRate' => 'Exchange Rate',
            'TotalItemsAmount' => 'Total Items Amount',
            'TotalItemInLocalCurrency' => 'Total Item In Local Currency',
            'TotalItemQuantityActualReceived' => 'Total Item Quantity Actual Received',
            'TotalWeightActualReceived' => 'Total Weight Actual Received',
            'ProcessStatus' => 'Process Status',
            'ShipmentBulkAirBillId' => 'Shipment Bulk Air Bill ID',
            'UomId' => 'Uom ID',
            'ActualWeight' => 'Actual Weight',
            'UpdateTime' => 'Update Time',
            'SubmitTime' => 'Submit Time',
            'ReceiveTime' => 'Receive Time',
            'DimensionX' => 'Dimension X',
            'DimensionY' => 'Dimension Y',
            'DimnesionZ' => 'Dimnesion Z',
            'SystemWeightUnitId' => 'System Weight Unit ID',
            'SystemDimensionUnitId' => 'System Dimension Unit ID',
        ];
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
    public function getShipmentBulkAirBill()
    {
        return $this->hasOne(ShipmentBulkAirbill::className(), ['id' => 'ShipmentBulkAirBillId']);
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
    public function getSystemWeightUnit()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'SystemWeightUnitId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemDimensionUnit()
    {
        return $this->hasOne(SystemDimensionUnit::className(), ['id' => 'SystemDimensionUnitId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkImages()
    {
        return $this->hasMany(ShipmentBulkImages::className(), ['shipmentBulkBoxId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['ShipmentBulkBoxId' => 'id']);
    }
}
