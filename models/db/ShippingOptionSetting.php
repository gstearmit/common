<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_option_setting".
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
 * @property integer $type_addition_fee
 * @property integer $store_id
 * @property integer $display_to_customer
 * @property integer $is_charge_fee_service
 *
 * @property CustomerShippingPreferences[] $customerShippingPreferences
 * @property MembershipPackagesOffer[] $membershipPackagesOffers
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderServiceDetailShipment[] $orderServiceDetailShipments
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property RequestShipmentService[] $requestShipmentServices
 * @property ShippingOptionGroup $groupType
 * @property Store $store
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 */
class ShippingOptionSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_option_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display_order', 'active', 'group_type_id', 'default', 'type_addition_fee', 'store_id', 'display_to_customer', 'is_charge_fee_service'], 'integer'],
            [['system_name', 'name', 'detail', 'tooltip'], 'string', 'max' => 255],
            [['group_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['group_type_id' => 'id']],
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
            'type_addition_fee' => 'Type Addition Fee',
            'store_id' => 'Store ID',
            'display_to_customer' => 'Display To Customer',
            'is_charge_fee_service' => 'Is Charge Fee Service',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerShippingPreferences()
    {
        return $this->hasMany(CustomerShippingPreferences::className(), ['shipping_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackagesOffers()
    {
        return $this->hasMany(MembershipPackagesOffer::className(), ['shipping_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['ShippingOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceDetailShipments()
    {
        return $this->hasMany(OrderServiceDetailShipment::className(), ['shipping_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['ShippingOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['ShippingOptionSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['shipping_option_setting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupType()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'group_type_id']);
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
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['shipping_option_setting_id' => 'id']);
    }
}
