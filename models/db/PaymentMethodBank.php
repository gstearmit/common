<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "payment_method_bank".
 *
 * @property integer $id
 * @property integer $PaymentMethodId
 * @property integer $BankId
 *
 * @property PaymentMethod $paymentMethod
 * @property SystemBank $bank
 */
class PaymentMethodBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PaymentMethodId', 'BankId'], 'integer'],
            [['PaymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['PaymentMethodId' => 'id']],
            [['BankId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemBank::className(), 'targetAttribute' => ['BankId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PaymentMethodId' => 'Payment Method ID',
            'BankId' => 'Bank ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'PaymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(SystemBank::className(), ['id' => 'BankId']);
    }
}
