<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $Name
 * @property integer $UsePercentage
 * @property string $DiscountPercentage
 * @property string $DiscountAmount
 * @property string $StartTime
 * @property string $EndTime
 * @property integer $RequiresCouponCode
 * @property integer $QuantityCouponCode
 * @property integer $DiscountLimitationUse
 * @property integer $DiscountSoldUse
 * @property integer $LimitationTimesPerCustomer
 * @property integer $LimitationTimesPerCoupon
 * @property integer $ApplyToObj
 * @property integer $siteId
 * @property integer $StoreId
 * @property integer $Active
 *
 * @property CouponCode[] $couponCodes
 * @property CouponLog[] $couponLogs
 * @property Store $store
 * @property Site $site
 * @property DiscountCategory[] $discountCategories
 * @property DiscountCondition[] $discountConditions
 * @property DiscountCoupon[] $discountCoupons
 * @property DiscountCustomer[] $discountCustomers
 * @property DiscountObject[] $discountObjects
 * @property DiscountPayment[] $discountPayments
 * @property DiscountProvince[] $discountProvinces
 * @property DiscountRequirement[] $discountRequirements
 * @property DiscountUsageHistory[] $discountUsageHistories
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property Order[] $orders
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UsePercentage', 'RequiresCouponCode', 'QuantityCouponCode', 'DiscountLimitationUse', 'DiscountSoldUse', 'LimitationTimesPerCustomer', 'LimitationTimesPerCoupon', 'ApplyToObj', 'siteId', 'StoreId', 'Active'], 'integer'],
            [['DiscountPercentage', 'DiscountAmount'], 'number'],
            [['StartTime', 'EndTime'], 'safe'],
            [['Name'], 'string', 'max' => 200],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
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
            'UsePercentage' => 'Use Percentage',
            'DiscountPercentage' => 'Discount Percentage',
            'DiscountAmount' => 'Discount Amount',
            'StartTime' => 'Start Time',
            'EndTime' => 'End Time',
            'RequiresCouponCode' => 'Requires Coupon Code',
            'QuantityCouponCode' => 'Quantity Coupon Code',
            'DiscountLimitationUse' => 'Discount Limitation Use',
            'DiscountSoldUse' => 'Discount Sold Use',
            'LimitationTimesPerCustomer' => 'Limitation Times Per Customer',
            'LimitationTimesPerCoupon' => 'Limitation Times Per Coupon',
            'ApplyToObj' => 'Apply To Obj',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'Active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponCodes()
    {
        return $this->hasMany(CouponCode::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponLogs()
    {
        return $this->hasMany(CouponLog::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCategories()
    {
        return $this->hasMany(DiscountCategory::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountConditions()
    {
        return $this->hasMany(DiscountCondition::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCoupons()
    {
        return $this->hasMany(DiscountCoupon::className(), ['discountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCustomers()
    {
        return $this->hasMany(DiscountCustomer::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountObjects()
    {
        return $this->hasMany(DiscountObject::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountPayments()
    {
        return $this->hasMany(DiscountPayment::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountProvinces()
    {
        return $this->hasMany(DiscountProvince::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountRequirements()
    {
        return $this->hasMany(DiscountRequirement::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountUsageHistories()
    {
        return $this->hasMany(DiscountUsageHistory::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['DiscountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['discountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['DiscountId' => 'id']);
    }
}
