<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_coupon_code".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $CouponCodeId
 * @property string $IssuedDate
 * @property integer $MethodDistribution
 *
 * @property Customer $customer
 * @property CouponCode $couponCode
 */
class CustomerCouponCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_coupon_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CouponCodeId', 'MethodDistribution'], 'integer'],
            [['IssuedDate'], 'safe'],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
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
            'IssuedDate' => 'Issued Date',
            'MethodDistribution' => 'Method Distribution',
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
    public function getCouponCode()
    {
        return $this->hasOne(CouponCode::className(), ['id' => 'CouponCodeId']);
    }
}
