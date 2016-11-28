<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_customer".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property integer $CustomerId
 *
 * @property Customer $customer
 * @property Discount $discount
 */
class DiscountCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId', 'CustomerId'], 'integer'],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
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
            'DiscountId' => 'Discount ID',
            'CustomerId' => 'Customer ID',
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
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }
}
