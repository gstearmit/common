<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "coupon_code".
 *
 * @property integer $id
 * @property string $Name
 * @property string $description
 * @property string $createTime
 * @property integer $quantity
 * @property integer $soldQuantity
 * @property integer $deleted
 * @property string $createEmail
 * @property string $Url
 * @property integer $DiscountId
 * @property string $CouponCodes
 *
 * @property CouponAffiliate[] $couponAffiliates
 * @property Discount $discount
 * @property CouponLog[] $couponLogs
 * @property CustomerCouponCode[] $customerCouponCodes
 * @property CustomerCouponCodeUsed[] $customerCouponCodeUseds
 * @property DiscountCoupon[] $discountCoupons
 */
class CouponCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime'], 'safe'],
            [['quantity', 'soldQuantity', 'deleted', 'DiscountId'], 'integer'],
            [['Name', 'description', 'createEmail', 'Url', 'CouponCodes'], 'string', 'max' => 255],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'description' => 'Description',
            'createTime' => 'Create Time',
            'quantity' => 'Quantity',
            'soldQuantity' => 'Sold Quantity',
            'deleted' => 'Deleted',
            'createEmail' => 'Create Email',
            'Url' => 'Url',
            'DiscountId' => 'Discount ID',
            'CouponCodes' => 'Coupon Codes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponAffiliates()
    {
        return $this->hasMany(CouponAffiliate::className(), ['CouponId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponLogs()
    {
        return $this->hasMany(CouponLog::className(), ['CouponCodeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCouponCodes()
    {
        return $this->hasMany(CustomerCouponCode::className(), ['CouponCodeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCouponCodeUseds()
    {
        return $this->hasMany(CustomerCouponCodeUsed::className(), ['CouponCodeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCoupons()
    {
        return $this->hasMany(DiscountCoupon::className(), ['couponCodeId' => 'id']);
    }
}
