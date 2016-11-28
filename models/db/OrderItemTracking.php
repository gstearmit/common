<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_item_tracking".
 *
 * @property integer $id
 * @property integer $orderItemId
 * @property string $description
 * @property integer $refObjectTypeId
 * @property string $refObjectId
 * @property string $createdTime
 * @property string $processBy
 * @property integer $status
 * @property integer $displayToCustomer
 *
 * @property OrderItem $orderItem
 */
class OrderItemTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderItemId', 'refObjectTypeId', 'status', 'displayToCustomer'], 'integer'],
            [['createdTime'], 'safe'],
            [['description', 'refObjectId', 'processBy'], 'string', 'max' => 255],
            [['orderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['orderItemId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderItemId' => 'Order Item ID',
            'description' => 'Description',
            'refObjectTypeId' => 'Ref Object Type ID',
            'refObjectId' => 'Ref Object ID',
            'createdTime' => 'Created Time',
            'processBy' => 'Process By',
            'status' => 'Status',
            'displayToCustomer' => 'Display To Customer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'orderItemId']);
    }
}
