<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_setting_group".
 *
 * @property integer $id
 * @property string $system_name
 * @property string $name
 * @property integer $display_order
 * @property integer $active
 * @property string $tooltip
 * @property integer $type_display
 * @property integer $store_id
 *
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderServiceDetailPackage[] $orderServiceDetailPackages
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property WarehousePackageItemService[] $warehousePackageItemServices
 * @property WarehousePackageServiceDetail[] $warehousePackageServiceDetails
 * @property WarehousePackageSetting[] $warehousePackageSettings
 * @property Store $store
 */
class WarehousePackageSettingGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_setting_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display_order', 'active', 'type_display', 'store_id'], 'integer'],
            [['system_name', 'name', 'tooltip'], 'string', 'max' => 255],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system_name' => 'System Name',
            'name' => 'Name',
            'display_order' => 'Display Order',
            'active' => 'Active',
            'tooltip' => 'Tooltip',
            'type_display' => 'Type Display',
            'store_id' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['WarehouseOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceDetailPackages()
    {
        return $this->hasMany(OrderServiceDetailPackage::className(), ['warehouse_option_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['WarehouseOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['WarehouseOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItemServices()
    {
        return $this->hasMany(WarehousePackageItemService::className(), ['warehouse_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServiceDetails()
    {
        return $this->hasMany(WarehousePackageServiceDetail::className(), ['warehouse_option_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettings()
    {
        return $this->hasMany(WarehousePackageSetting::className(), ['group_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }
}
