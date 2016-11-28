<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_airbill_category_mapping".
 *
 * @property integer $id
 * @property integer $ShipmentBulkAirbillId
 * @property integer $CategoryCustomPolicyId
 * @property integer $MaximumNumberOfItems
 * @property integer $ActualNumberOfItems
 * @property integer $ShipmentBulkCustomGateId
 * @property string $Note
 * @property integer $UomId
 * @property string $TotalPrice
 *
 * @property ShipmentBulkAirbill $shipmentBulkAirbill
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property ShipmentBulkCustomGate $shipmentBulkCustomGate
 * @property SystemUnitOfMessure $uom
 */
class ShipmentBulkAirbillCategoryMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_airbill_category_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShipmentBulkAirbillId', 'CategoryCustomPolicyId', 'MaximumNumberOfItems', 'ActualNumberOfItems', 'ShipmentBulkCustomGateId', 'UomId'], 'integer'],
            [['TotalPrice'], 'number'],
            [['Note'], 'string', 'max' => 255],
            [['ShipmentBulkAirbillId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkAirbill::className(), 'targetAttribute' => ['ShipmentBulkAirbillId' => 'id']],
            [['CategoryCustomPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['CategoryCustomPolicyId' => 'id']],
            [['ShipmentBulkCustomGateId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkCustomGate::className(), 'targetAttribute' => ['ShipmentBulkCustomGateId' => 'id']],
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
            'ShipmentBulkAirbillId' => 'Shipment Bulk Airbill ID',
            'CategoryCustomPolicyId' => 'Category Custom Policy ID',
            'MaximumNumberOfItems' => 'Maximum Number Of Items',
            'ActualNumberOfItems' => 'Actual Number Of Items',
            'ShipmentBulkCustomGateId' => 'Shipment Bulk Custom Gate ID',
            'Note' => 'Note',
            'UomId' => 'Uom ID',
            'TotalPrice' => 'Total Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbill()
    {
        return $this->hasOne(ShipmentBulkAirbill::className(), ['id' => 'ShipmentBulkAirbillId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'CategoryCustomPolicyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustomGate()
    {
        return $this->hasOne(ShipmentBulkCustomGate::className(), ['id' => 'ShipmentBulkCustomGateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'UomId']);
    }
}
