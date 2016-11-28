<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_payment".
 *
 * @property integer $id
 * @property integer $PaymentMethodProviderId
 * @property integer $DiscountId
 * @property string $CreatedTime
 *
 * @property Discount $discount
 * @property PaymentMethodProvider $paymentMethodProvider
 */
class DiscountPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PaymentMethodProviderId', 'DiscountId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'DiscountId' => 'Discount ID',
            'CreatedTime' => 'Created Time',
        ];
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
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'PaymentMethodProviderId']);
    }
}
