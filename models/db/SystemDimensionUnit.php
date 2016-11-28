<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_dimension_unit".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property string $Ratio
 * @property integer $DisplayOrder
 * @property integer $IsMainUnit
 *
 * @property ShipmentBulkBox[] $shipmentBulkBoxes
 * @property SystemDimension[] $systemDimensions
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackage[] $warehousePackages0
 */
class SystemDimensionUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_dimension_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ratio'], 'number'],
            [['DisplayOrder', 'IsMainUnit'], 'integer'],
            [['Name', 'SystemKeyword'], 'string', 'max' => 100],
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
            'SystemKeyword' => 'System Keyword',
            'Ratio' => 'Ratio',
            'DisplayOrder' => 'Display Order',
            'IsMainUnit' => 'Is Main Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBoxes()
    {
        return $this->hasMany(ShipmentBulkBox::className(), ['SystemDimensionUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemDimensions()
    {
        return $this->hasMany(SystemDimension::className(), ['SystemDimensionUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['systemDimensionUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages0()
    {
        return $this->hasMany(WarehousePackage::className(), ['ActualDimensionAfterPackagedId' => 'id']);
    }
}
