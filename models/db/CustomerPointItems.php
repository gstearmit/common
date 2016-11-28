<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_point_items".
 *
 * @property integer $id
 * @property integer $OrderId
 * @property string $AmountMoney
 * @property integer $ConvertedPoint
 * @property integer $AdjustmentPoint
 * @property integer $FinalPoint
 * @property integer $CustomerTotalPointId
 * @property integer $CustomerId
 * @property integer $IsValid
 * @property integer $IsApproved
 * @property string $Note
 * @property integer $Deleted
 *
 * @property Customer $customer
 * @property CustomerPointTotal $customerTotalPoint
 * @property Order $order
 */
class CustomerPointItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_point_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderId', 'ConvertedPoint', 'AdjustmentPoint', 'FinalPoint', 'CustomerTotalPointId', 'CustomerId', 'IsValid', 'IsApproved', 'Deleted'], 'integer'],
            [['AmountMoney'], 'number'],
            [['Note'], 'string', 'max' => 500],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['CustomerTotalPointId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerPointTotal::className(), 'targetAttribute' => ['CustomerTotalPointId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'OrderId' => 'Order ID',
            'AmountMoney' => 'Amount Money',
            'ConvertedPoint' => 'Converted Point',
            'AdjustmentPoint' => 'Adjustment Point',
            'FinalPoint' => 'Final Point',
            'CustomerTotalPointId' => 'Customer Total Point ID',
            'CustomerId' => 'Customer ID',
            'IsValid' => 'Is Valid',
            'IsApproved' => 'Is Approved',
            'Note' => 'Note',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerTotalPoint()
    {
        return $this->hasOne(CustomerPointTotal::className(), ['id' => 'CustomerTotalPointId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }
}
