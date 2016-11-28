<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_item_fee_service".
 *
 * @property integer $id
 * @property integer $order_item_id
 * @property integer $type_of_service_id
 * @property string $fee_amount
 * @property string $applyTime
 * @property string $fee_amount_approved
 * @property string $approvedTime
 * @property integer $approvedByEmployeeId
 * @property integer $is_paid
 * @property string $paidTime
 *
 * @property OrderItem $orderItem
 * @property CategoryServiceProvide $typeOfService
 * @property OrganizationEmployee $approvedByEmployee
 */
class OrderItemFeeService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item_fee_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_item_id', 'type_of_service_id', 'approvedByEmployeeId', 'is_paid'], 'integer'],
            [['fee_amount', 'fee_amount_approved'], 'number'],
            [['applyTime', 'approvedTime', 'paidTime'], 'safe'],
            [['order_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['order_item_id' => 'id']],
            [['type_of_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryServiceProvide::className(), 'targetAttribute' => ['type_of_service_id' => 'id']],
            [['approvedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['approvedByEmployeeId' => 'id']],
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
            'type_of_service_id' => 'Type Of Service ID',
            'fee_amount' => 'Fee Amount',
            'applyTime' => 'Apply Time',
            'fee_amount_approved' => 'Fee Amount Approved',
            'approvedTime' => 'Approved Time',
            'approvedByEmployeeId' => 'Approved By Employee ID',
            'is_paid' => 'Is Paid',
            'paidTime' => 'Paid Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'order_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeOfService()
    {
        return $this->hasOne(CategoryServiceProvide::className(), ['id' => 'type_of_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'approvedByEmployeeId']);
    }
}
