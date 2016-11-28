<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "coupon_affiliate".
 *
 * @property integer $id
 * @property integer $CouponId
 * @property integer $AffiliateId
 * @property string $CreatedDate
 *
 * @property Affiliate $affiliate
 * @property CouponCode $coupon
 */
class CouponAffiliate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_affiliate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CouponId', 'AffiliateId'], 'integer'],
            [['CreatedDate'], 'safe'],
            [['AffiliateId'], 'exist', 'skipOnError' => true, 'targetClass' => Affiliate::className(), 'targetAttribute' => ['AffiliateId' => 'id']],
            [['CouponId'], 'exist', 'skipOnError' => true, 'targetClass' => CouponCode::className(), 'targetAttribute' => ['CouponId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CouponId' => 'Coupon ID',
            'AffiliateId' => 'Affiliate ID',
            'CreatedDate' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliate()
    {
        return $this->hasOne(Affiliate::className(), ['id' => 'AffiliateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(CouponCode::className(), ['id' => 'CouponId']);
    }
}
