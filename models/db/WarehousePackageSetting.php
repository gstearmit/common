<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_setting".
 *
 * @property integer $id
 * @property string $system_name
 * @property string $name
 * @property string $detail
 * @property integer $display_order
 * @property integer $active
 * @property integer $group_type_id
 * @property string $tooltip
 * @property integer $default
 * @property integer $urgent
 * @property integer $type_addition_fee
 * @property integer $store_id
 * @property integer $display_to_customer
 * @property integer $is_charge_fee_service
 *
 * @property MembershipPackagesOffer[] $membershipPackagesOffers
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderServiceDetailPackage[] $orderServiceDetailPackages
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property WarehousePackageItemService[] $warehousePackageItemServices
 * @property WarehousePackageServiceDetail[] $warehousePackageServiceDetails
 * @property WarehousePackageSettingGroup $groupType
 * @property Store $store
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class WarehousePackageSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display_order', 'active', 'group_type_id', 'default', 'urgent', 'type_addition_fee', 'store_id', 'display_to_customer', 'is_charge_fee_service'], 'integer'],
            [['system_name', 'name'], 'string', 'max' => 255],
            [['detail', 'tooltip'], 'string', 'max' => 4000],
            [['group_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingGroup::className(), 'targetAttribute' => ['group_type_id' => 'id']],
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
            'detail' => 'Detail',
            'display_order' => 'Display Order',
            'active' => 'Active',
            'group_type_id' => 'Group Type ID',
            'tooltip' => 'Tooltip',
            'default' => 'Default',
            'urgent' => 'Urgent',
            'type_addition_fee' => 'Type Addition Fee',
            'store_id' => 'Store ID',
            'display_to_customer' => 'Display To Customer',
            'is_charge_fee_service' => 'Is Charge Fee Service',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackagesOffers()
    {
        return $this->hasMany(MembershipPackagesOffer::className(), ['warehouse_package_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['WarehouseOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceDetailPackages()
    {
        return $this->hasMany(OrderServiceDetailPackage::className(), ['warehouse_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['WarehouseOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['WarehouseOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItemServices()
    {
        return $this->hasMany(WarehousePackageItemService::className(), ['warehouse_option_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServiceDetails()
    {
        return $this->hasMany(WarehousePackageServiceDetail::className(), ['warehouse_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupType()
    {
        return $this->hasOne(WarehousePackageSettingGroup::className(), ['id' => 'group_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['warehouse_package_setting_id' => 'id']);
    }
}
