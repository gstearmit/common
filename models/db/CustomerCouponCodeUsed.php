<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_coupon_code_used".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $CouponCodeId
 * @property integer $OrderId
 * @property string $DateApplied
 *
 * @property Customer $customer
 * @property Order $order
 * @property CouponCode $couponCode
 */
class CustomerCouponCodeUsed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_coupon_code_used';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CouponCodeId', 'OrderId'], 'integer'],
            [['DateApplied'], 'safe'],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['CouponCodeId'], 'exist', 'skipOnError' => true, 'targetClass' => CouponCode::className(), 'targetAttribute' => ['CouponCodeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CustomerId' => 'Customer ID',
            'CouponCodeId' => 'Coupon Code ID',
            'OrderId' => 'Order ID',
            'DateApplied' => 'Date Applied',
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponCode()
    {
        return $this->hasOne(CouponCode::className(), ['id' => 'CouponCodeId']);
    }
}
