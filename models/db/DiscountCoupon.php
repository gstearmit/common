<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_coupon".
 *
 * @property integer $id
 * @property integer $couponCodeId
 * @property integer $discountId
 *
 * @property CouponCode $couponCode
 * @property Discount $discount
 */
class DiscountCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['couponCodeId', 'discountId'], 'integer'],
            [['couponCodeId'], 'exist', 'skipOnError' => true, 'targetClass' => CouponCode::className(), 'targetAttribute' => ['couponCodeId' => 'id']],
            [['discountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['discountId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'couponCodeId' => 'Coupon Code ID',
            'discountId' => 'Discount ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponCode()
    {
        return $this->hasOne(CouponCode::className(), ['id' => 'couponCodeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discountId']);
    }
}
