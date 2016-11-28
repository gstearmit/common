<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_option_group".
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
 * @property CustomerShippingPreferences[] $customerShippingPreferences
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderServiceDetailShipment[] $orderServiceDetailShipments
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property RequestShipmentService[] $requestShipmentServices
 * @property Store $store
 * @property ShippingOptionSetting[] $shippingOptionSettings
 */
class ShippingOptionGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_option_group';
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
    public function getCustomerShippingPreferences()
    {
        return $this->hasMany(CustomerShippingPreferences::className(), ['shipping_option_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['ShippingOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceDetailShipments()
    {
        return $this->hasMany(OrderServiceDetailShipment::className(), ['shipping_option_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['ShippingOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['ShippingOptionGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['shipping_option_group_id' => 'id']);
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
    public function getShippingOptionSettings()
    {
        return $this->hasMany(ShippingOptionSetting::className(), ['group_type_id' => 'id']);
    }
}
