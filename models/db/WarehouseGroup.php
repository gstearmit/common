<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_group".
 *
 * @property integer $id
 * @property string $GroupName
 * @property string $Description
 * @property integer $system_country_id
 *
 * @property Warehouse[] $warehouses
 * @property SystemCountry $systemCountry
 */
class WarehouseGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system_country_id'], 'integer'],
            [['GroupName', 'Description'], 'string', 'max' => 255],
            [['system_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['system_country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'GroupName' => 'Group Name',
            'Description' => 'Description',
            'system_country_id' => 'System Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['WarehouseGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'system_country_id']);
    }
}
