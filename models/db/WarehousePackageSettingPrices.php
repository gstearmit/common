<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_setting_prices".
 *
 * @property integer $id
 * @property integer $warehouse_package_setting_id
 * @property integer $customer_group_id
 * @property integer $membership_packages_id
 * @property integer $warehouse_id
 * @property integer $category_custom_policy_id
 * @property integer $apply_to_all_categories
 * @property integer $uom_id
 * @property integer $base_on_type_uom_id
 * @property integer $base_on_type_channel_id
 * @property integer $system_weight_unit_id
 * @property string $unit_price
 * @property string $weight_per_unit_price
 * @property string $price_per_unit_price
 * @property integer $items_per_unit_price
 * @property integer $system_currency_id
 * @property integer $use_percentage
 * @property string $percentage
 * @property integer $min_day
 * @property integer $max_day
 * @property integer $apply_item_packages
 * @property string $min_weight
 * @property string $max_weight
 * @property string $created_time
 * @property integer $active
 * @property integer $store_id
 * @property integer $default
 * @property integer $is_free_
 * @property integer $is_calculated_service
 * @property integer $apply_default_to_customer
 *
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property WarehousePackageSetting $warehousePackageSetting
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property MembershipPackages $membershipPackages
 * @property Warehouse $warehouse
 * @property SystemUnitOfMessure $uom
 * @property Store $store
 * @property SystemCurrency $systemCurrency
 * @property SystemWeightUnit $systemWeightUnit
 * @property CustomerGroup $customerGroup
 */
class WarehousePackageSettingPrices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_setting_prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_package_setting_id', 'customer_group_id', 'membership_packages_id', 'warehouse_id', 'category_custom_policy_id', 'apply_to_all_categories', 'uom_id', 'base_on_type_uom_id', 'base_on_type_channel_id', 'system_weight_unit_id', 'items_per_unit_price', 'system_currency_id', 'use_percentage', 'min_day', 'max_day', 'apply_item_packages', 'active', 'store_id', 'default', 'is_free_', 'is_calculated_service', 'apply_default_to_customer'], 'integer'],
            [['unit_price', 'weight_per_unit_price', 'price_per_unit_price', 'percentage', 'min_weight', 'max_weight'], 'number'],
            [['created_time'], 'safe'],
            [['warehouse_package_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['warehouse_package_setting_id' => 'id']],
            [['category_custom_policy_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['category_custom_policy_id' => 'id']],
            [['membership_packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackages::className(), 'targetAttribute' => ['membership_packages_id' => 'id']],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_id' => 'id']],
            [['uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['uom_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['system_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['system_currency_id' => 'id']],
            [['system_weight_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['system_weight_unit_id' => 'id']],
            [['customer_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['customer_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_package_setting_id' => 'Warehouse Package Setting ID',
            'customer_group_id' => 'Customer Group ID',
            'membership_packages_id' => 'Membership Packages ID',
            'warehouse_id' => 'Warehouse ID',
            'category_custom_policy_id' => 'Category Custom Policy ID',
            'apply_to_all_categories' => 'Apply To All Categories',
            'uom_id' => 'Uom ID',
            'base_on_type_uom_id' => 'Base On Type Uom ID',
            'base_on_type_channel_id' => 'Base On Type Channel ID',
            'system_weight_unit_id' => 'System Weight Unit ID',
            'unit_price' => 'Unit Price',
            'weight_per_unit_price' => 'Weight Per Unit Price',
            'price_per_unit_price' => 'Price Per Unit Price',
            'items_per_unit_price' => 'Items Per Unit Price',
            'system_currency_id' => 'System Currency ID',
            'use_percentage' => 'Use Percentage',
            'percentage' => 'Percentage',
            'min_day' => 'Min Day',
            'max_day' => 'Max Day',
            'apply_item_packages' => 'Apply Item Packages',
            'min_weight' => 'Min Weight',
            'max_weight' => 'Max Weight',
            'created_time' => 'Created Time',
            'active' => 'Active',
            'store_id' => 'Store ID',
            'default' => 'Default',
            'is_free_' => 'Is Free',
            'is_calculated_service' => 'Is Calculated Service',
            'apply_default_to_customer' => 'Apply Default To Customer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['WarehouseOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['WarehouseOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['WarehouseOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSetting()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'warehouse_package_setting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'category_custom_policy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackages()
    {
        return $this->hasOne(MembershipPackages::className(), ['id' => 'membership_packages_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'uom_id']);
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
    public function getSystemCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'system_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeightUnit()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'system_weight_unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['id' => 'customer_group_id']);
    }
}
