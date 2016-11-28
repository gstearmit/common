<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_location".
 *
 * @property integer $id
 * @property string $LocationCode
 * @property integer $WarehouseId
 * @property string $LocationX
 * @property string $LocationY
 * @property string $LocationZ
 * @property string $Description
 * @property integer $MaxX
 * @property integer $MaxY
 * @property integer $MaxZ
 * @property integer $ActualX
 * @property integer $ActualY
 * @property integer $ActualZ
 * @property string $MaxWeight
 * @property string $ActualWeight
 * @property integer $Status
 * @property integer $Active
 * @property integer $TypeId
 * @property integer $PurpurseId
 *
 * @property Warehouse $warehouse
 * @property WarehouseLocationBox[] $warehouseLocationBoxes
 */
class WarehouseLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'WarehouseId', 'MaxX', 'MaxY', 'MaxZ', 'ActualX', 'ActualY', 'ActualZ', 'Status', 'Active', 'TypeId', 'PurpurseId'], 'integer'],
            [['MaxWeight', 'ActualWeight'], 'number'],
            [['LocationCode', 'LocationX', 'LocationY', 'LocationZ', 'Description'], 'string', 'max' => 255],
            [['WarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'LocationCode' => 'Location Code',
            'WarehouseId' => 'Warehouse ID',
            'LocationX' => 'Location X',
            'LocationY' => 'Location Y',
            'LocationZ' => 'Location Z',
            'Description' => 'Description',
            'MaxX' => 'Max X',
            'MaxY' => 'Max Y',
            'MaxZ' => 'Max Z',
            'ActualX' => 'Actual X',
            'ActualY' => 'Actual Y',
            'ActualZ' => 'Actual Z',
            'MaxWeight' => 'Max Weight',
            'ActualWeight' => 'Actual Weight',
            'Status' => 'Status',
            'Active' => 'Active',
            'TypeId' => 'Type ID',
            'PurpurseId' => 'Purpurse ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocationBoxes()
    {
        return $this->hasMany(WarehouseLocationBox::className(), ['WarehouseLocationId' => 'id']);
    }
}
