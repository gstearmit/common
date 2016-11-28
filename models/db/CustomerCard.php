<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_card".
 *
 * @property integer $id
 * @property string $CardId
 * @property integer $CustomerId
 * @property integer $CategoryId
 * @property integer $IsDefault
 * @property integer $IsAssigned
 * @property integer $IsDiscount
 * @property integer $IsUsePercentageDiscount
 * @property string $PercentageDiscount
 * @property string $AbsoluteDiscount
 * @property string $ActiveFromDate
 * @property string $ActiveToDate
 * @property string $IssuedDate
 * @property integer $CustomerTotalPointId
 * @property string $PlusBenefit
 * @property integer $IsUseWithCouponCode
 *
 * @property Customer $customer
 * @property Category $category
 * @property CustomerPointTotal $customerTotalPoint
 */
class CustomerCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CategoryId', 'IsDefault', 'IsAssigned', 'IsDiscount', 'IsUsePercentageDiscount', 'CustomerTotalPointId', 'IsUseWithCouponCode'], 'integer'],
            [['PercentageDiscount', 'AbsoluteDiscount'], 'number'],
            [['ActiveFromDate', 'ActiveToDate', 'IssuedDate'], 'safe'],
            [['CardId'], 'string', 'max' => 50],
            [['PlusBenefit'], 'string', 'max' => 400],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['CustomerTotalPointId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerPointTotal::className(), 'targetAttribute' => ['CustomerTotalPointId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CardId' => 'Card ID',
            'CustomerId' => 'Customer ID',
            'CategoryId' => 'Category ID',
            'IsDefault' => 'Is Default',
            'IsAssigned' => 'Is Assigned',
            'IsDiscount' => 'Is Discount',
            'IsUsePercentageDiscount' => 'Is Use Percentage Discount',
            'PercentageDiscount' => 'Percentage Discount',
            'AbsoluteDiscount' => 'Absolute Discount',
            'ActiveFromDate' => 'Active From Date',
            'ActiveToDate' => 'Active To Date',
            'IssuedDate' => 'Issued Date',
            'CustomerTotalPointId' => 'Customer Total Point ID',
            'PlusBenefit' => 'Plus Benefit',
            'IsUseWithCouponCode' => 'Is Use With Coupon Code',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerTotalPoint()
    {
        return $this->hasOne(CustomerPointTotal::className(), ['id' => 'CustomerTotalPointId']);
    }
}
