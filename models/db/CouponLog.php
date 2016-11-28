<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "coupon_log".
 *
 * @property integer $id
 * @property string $FromIP
 * @property string $FromDevice
 * @property string $FromBrowser
 * @property integer $IsView
 * @property integer $IsClicked
 * @property string $CouponCode
 * @property integer $CouponCodeId
 * @property integer $CustomerId
 * @property integer $DiscountId
 * @property string $CreatedTime
 * @property integer $OrderId
 * @property string $OrderBinCode
 * @property string $DiscountAmount
 * @property integer $StoreId
 *
 * @property Customer $customer
 * @property CouponCode $couponCode
 * @property Order $order
 * @property Discount $discount
 * @property Store $store
 */
class CouponLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsView', 'IsClicked', 'CouponCodeId', 'CustomerId', 'DiscountId', 'OrderId', 'StoreId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['DiscountAmount'], 'number'],
            [['FromIP', 'FromDevice', 'FromBrowser'], 'string', 'max' => 100],
            [['CouponCode'], 'string', 'max' => 255],
            [['OrderBinCode'], 'string', 'max' => 50],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['CouponCodeId'], 'exist', 'skipOnError' => true, 'targetClass' => CouponCode::className(), 'targetAttribute' => ['CouponCodeId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FromIP' => 'From Ip',
            'FromDevice' => 'From Device',
            'FromBrowser' => 'From Browser',
            'IsView' => 'Is View',
            'IsClicked' => 'Is Clicked',
            'CouponCode' => 'Coupon Code',
            'CouponCodeId' => 'Coupon Code ID',
            'CustomerId' => 'Customer ID',
            'DiscountId' => 'Discount ID',
            'CreatedTime' => 'Created Time',
            'OrderId' => 'Order ID',
            'OrderBinCode' => 'Order Bin Code',
            'DiscountAmount' => 'Discount Amount',
            'StoreId' => 'Store ID',
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
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
