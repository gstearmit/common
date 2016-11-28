<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_dimension".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Type
 * @property string $Description
 * @property integer $DisplayOrder
 * @property integer $active
 * @property integer $Length
 * @property integer $Width
 * @property integer $Height
 * @property integer $SystemDimensionUnitId
 *
 * @property SystemDimensionUnit $systemDimensionUnit
 * @property WarehousePackage[] $warehousePackages
 */
class SystemDimension extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_dimension';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DisplayOrder', 'active', 'Length', 'Width', 'Height', 'SystemDimensionUnitId'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['Type'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 255],
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
            'Type' => 'Type',
            'Description' => 'Description',
            'DisplayOrder' => 'Display Order',
            'active' => 'Active',
            'Length' => 'Length',
            'Width' => 'Width',
            'Height' => 'Height',
            'SystemDimensionUnitId' => 'System Dimension Unit ID',
        ];
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
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['systemDimensionId' => 'id']);
    }
}
