<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_option_setting_prices".
 *
 * @property integer $id
 * @property integer $shipping_option_setting_id
 * @property integer $category_custom_policy_id
 * @property integer $membership_package_id
 * @property integer $from_warehouse_id
 * @property integer $to_warehouse_id
 * @property string $min_weight
 * @property string $max_weight
 * @property string $min_price
 * @property string $max_price
 * @property integer $base_on_type_uom_id
 * @property integer $customer_group_id
 * @property integer $base_on_type_channel_id
 * @property integer $uom_id
 * @property integer $system_weight_unit_id
 * @property string $unit_price
 * @property string $weight_per_unit_price
 * @property string $price_per_unit_price
 * @property integer $items_per_unit_price
 * @property integer $system_currency_id
 * @property integer $use_percentage
 * @property string $percentage
 * @property integer $active
 * @property integer $default
 * @property integer $store_id
 * @property string $created_time
 * @property integer $apply_to_all_categories
 * @property integer $apply_item_packages
 * @property integer $is_free
 * @property integer $is_calculated_service
 * @property integer $apply_default_to_customer
 * @property integer $delivery_district_id
 * @property integer $MaxItem
 * @property string $PricePerUnitForExtraItem
 * @property integer $ApplyToOnlyExtraItem
 *
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property RequestShipmentService[] $requestShipmentServices
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property SystemUnitOfMessure $uom
 * @property SystemWeightUnit $systemWeightUnit
 * @property CustomerGroup $customerGroup
 * @property SystemDistrict $deliveryDistrict
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property MembershipPackages $membershipPackage
 * @property Store $store
 * @property SystemCurrency $systemCurrency
 * @property Warehouse $fromWarehouse
 * @property Warehouse $toWarehouse
 */
class ShippingOptionSettingPrices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_option_setting_prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_option_setting_id', 'category_custom_policy_id', 'membership_package_id', 'from_warehouse_id', 'to_warehouse_id', 'base_on_type_uom_id', 'customer_group_id', 'base_on_type_channel_id', 'uom_id', 'system_weight_unit_id', 'items_per_unit_price', 'system_currency_id', 'use_percentage', 'active', 'default', 'store_id', 'apply_to_all_categories', 'apply_item_packages', 'is_free', 'is_calculated_service', 'apply_default_to_customer', 'delivery_district_id', 'MaxItem', 'ApplyToOnlyExtraItem'], 'integer'],
            [['min_weight', 'max_weight', 'min_price', 'max_price', 'unit_price', 'weight_per_unit_price', 'price_per_unit_price', 'percentage', 'PricePerUnitForExtraItem'], 'number'],
            [['created_time'], 'safe'],
            [['shipping_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['shipping_option_setting_id' => 'id']],
            [['uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['uom_id' => 'id']],
            [['system_weight_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['system_weight_unit_id' => 'id']],
            [['customer_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['customer_group_id' => 'id']],
            [['delivery_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['delivery_district_id' => 'id']],
            [['category_custom_policy_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['category_custom_policy_id' => 'id']],
            [['membership_package_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackages::className(), 'targetAttribute' => ['membership_package_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['system_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['system_currency_id' => 'id']],
            [['from_warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['from_warehouse_id' => 'id']],
            [['to_warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['to_warehouse_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shipping_option_setting_id' => 'Shipping Option Setting ID',
            'category_custom_policy_id' => 'Category Custom Policy ID',
            'membership_package_id' => 'Membership Package ID',
            'from_warehouse_id' => 'From Warehouse ID',
            'to_warehouse_id' => 'To Warehouse ID',
            'min_weight' => 'Min Weight',
            'max_weight' => 'Max Weight',
            'min_price' => 'Min Price',
            'max_price' => 'Max Price',
            'base_on_type_uom_id' => 'Base On Type Uom ID',
            'customer_group_id' => 'Customer Group ID',
            'base_on_type_channel_id' => 'Base On Type Channel ID',
            'uom_id' => 'Uom ID',
            'system_weight_unit_id' => 'System Weight Unit ID',
            'unit_price' => 'Unit Price',
            'weight_per_unit_price' => 'Weight Per Unit Price',
            'price_per_unit_price' => 'Price Per Unit Price',
            'items_per_unit_price' => 'Items Per Unit Price',
            'system_currency_id' => 'System Currency ID',
            'use_percentage' => 'Use Percentage',
            'percentage' => 'Percentage',
            'active' => 'Active',
            'default' => 'Default',
            'store_id' => 'Store ID',
            'created_time' => 'Created Time',
            'apply_to_all_categories' => 'Apply To All Categories',
            'apply_item_packages' => 'Apply Item Packages',
            'is_free' => 'Is Free',
            'is_calculated_service' => 'Is Calculated Service',
            'apply_default_to_customer' => 'Apply Default To Customer',
            'delivery_district_id' => 'Delivery District ID',
            'MaxItem' => 'Max Item',
            'PricePerUnitForExtraItem' => 'Price Per Unit For Extra Item',
            'ApplyToOnlyExtraItem' => 'Apply To Only Extra Item',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['ShippingOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['ShippingOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['ShippingOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['ShippingOptionSettingPriceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSetting()
    {
        return $this->hasOne(ShippingOptionSetting::className(), ['id' => 'shipping_option_setting_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'delivery_district_id']);
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
    public function getMembershipPackage()
    {
        return $this->hasOne(MembershipPackages::className(), ['id' => 'membership_package_id']);
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
    public function getFromWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'from_warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'to_warehouse_id']);
    }
}
