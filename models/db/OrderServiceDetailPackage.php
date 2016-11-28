<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_service_detail_package".
 *
 * @property integer $id
 * @property integer $order_item_id
 * @property integer $order_service_id
 * @property integer $warehouse_option_group_id
 * @property integer $warehouse_option_setting_id
 * @property string $created_time
 * @property string $fee_charged
 *
 * @property WarehousePackageSettingGroup $warehouseOptionGroup
 * @property WarehousePackageSetting $warehouseOptionSetting
 * @property OrderService $orderService
 * @property OrderItem $orderItem
 */
class OrderServiceDetailPackage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_service_detail_package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_item_id', 'order_service_id', 'warehouse_option_group_id', 'warehouse_option_setting_id'], 'integer'],
            [['created_time'], 'safe'],
            [['fee_charged'], 'number'],
            [['warehouse_option_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingGroup::className(), 'targetAttribute' => ['warehouse_option_group_id' => 'id']],
            [['warehouse_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['warehouse_option_setting_id' => 'id']],
            [['order_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderService::className(), 'targetAttribute' => ['order_service_id' => 'id']],
            [['order_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['order_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_item_id' => 'Order Item ID',
            'order_service_id' => 'Order Service ID',
            'warehouse_option_group_id' => 'Warehouse Option Group ID',
            'warehouse_option_setting_id' => 'Warehouse Option Setting ID',
            'created_time' => 'Created Time',
            'fee_charged' => 'Fee Charged',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionGroup()
    {
        return $this->hasOne(WarehousePackageSettingGroup::className(), ['id' => 'warehouse_option_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionSetting()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'warehouse_option_setting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderService()
    {
        return $this->hasOne(OrderService::className(), ['id' => 'order_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'order_item_id']);
    }
}
