<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_shipping_preferences".
 *
 * @property integer $id
 * @property integer $shipping_option_group_id
 * @property integer $shipping_option_setting_id
 * @property integer $customer_id
 *
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property Customer $customer
 * @property ShippingOptionGroup $shippingOptionGroup
 */
class CustomerShippingPreferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_shipping_preferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_option_group_id', 'shipping_option_setting_id', 'customer_id'], 'integer'],
            [['shipping_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['shipping_option_setting_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['shipping_option_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['shipping_option_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shipping_option_group_id' => 'Shipping Option Group ID',
            'shipping_option_setting_id' => 'Shipping Option Setting ID',
            'customer_id' => 'Customer ID',
        ];
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionGroup()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'shipping_option_group_id']);
    }
}
