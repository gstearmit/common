<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_location_box".
 *
 * @property integer $id
 * @property string $Name
 * @property string $TrackingCode
 * @property string $Description
 * @property string $CreateTime
 * @property integer $ItemsQuantity
 * @property string $ItemsWeight
 * @property integer $CurrencyId
 * @property string $ExchangeRate
 * @property string $TotalItemsAmount
 * @property string $TotalItemInLocalCurrency
 * @property integer $TotalItemQuantityActualReceived
 * @property double $TotalWeightActualReceived
 * @property integer $ProcessStatus
 * @property integer $MarkBroken
 * @property integer $WarehouseLocationId
 * @property integer $UomId
 * @property integer $WeightUomId
 *
 * @property SystemCurrency $currency
 * @property SystemUnitOfMessure $uom
 * @property SystemWeightUnit $weightUom
 * @property WarehouseLocation $warehouseLocation
 */
class WarehouseLocationBox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_location_box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime'], 'safe'],
            [['ItemsQuantity', 'CurrencyId', 'TotalItemQuantityActualReceived', 'ProcessStatus', 'MarkBroken', 'WarehouseLocationId', 'UomId', 'WeightUomId'], 'integer'],
            [['ItemsWeight', 'ExchangeRate', 'TotalItemsAmount', 'TotalItemInLocalCurrency', 'TotalWeightActualReceived'], 'number'],
            [['Name'], 'string', 'max' => 255],
            [['TrackingCode', 'Description'], 'string', 'max' => 50],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['UomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UomId' => 'id']],
            [['WeightUomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['WeightUomId' => 'id']],
            [['WarehouseLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehouseLocation::className(), 'targetAttribute' => ['WarehouseLocationId' => 'id']],
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
            'ItemsQuantity' => 'Items Quantity',
            'ItemsWeight' => 'Items Weight',
            'CurrencyId' => 'Currency ID',
            'ExchangeRate' => 'Exchange Rate',
            'TotalItemsAmount' => 'Total Items Amount',
            'TotalItemInLocalCurrency' => 'Total Item In Local Currency',
            'TotalItemQuantityActualReceived' => 'Total Item Quantity Actual Received',
            'TotalWeightActualReceived' => 'Total Weight Actual Received',
            'ProcessStatus' => 'Process Status',
            'MarkBroken' => 'Mark Broken',
            'WarehouseLocationId' => 'Warehouse Location ID',
            'UomId' => 'Uom ID',
            'WeightUomId' => 'Weight Uom ID',
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
    public function getUom()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'UomId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeightUom()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'WeightUomId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocation()
    {
        return $this->hasOne(WarehouseLocation::className(), ['id' => 'WarehouseLocationId']);
    }
}
