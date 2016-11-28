<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_service_detail_shipment".
 *
 * @property integer $id
 * @property integer $shipping_option_group_id
 * @property integer $shipping_option_setting_id
 * @property integer $order_service_id
 * @property string $created_time
 * @property string $fee_charged
 *
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property ShippingOptionGroup $shippingOptionGroup
 * @property OrderService $orderService
 */
class OrderServiceDetailShipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_detail_shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_option_group_id', 'shipping_option_setting_id', 'order_service_id'], 'integer'],
            [['created_time'], 'safe'],
            [['fee_charged'], 'number'],
            [['shipping_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['shipping_option_setting_id' => 'id']],
            [['shipping_option_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['shipping_option_group_id' => 'id']],
            [['order_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderService::className(), 'targetAttribute' => ['order_service_id' => 'id']],
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
            'order_service_id' => 'Order Service ID',
            'created_time' => 'Created Time',
            'fee_charged' => 'Fee Charged',
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
    public function getShippingOptionGroup()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'shipping_option_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderService::className(), ['id' => 'order_service_id']);
    }
}
