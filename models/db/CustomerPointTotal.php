<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_point_total".
 *
 * @property integer $id
 * @property string $TotalAmount
 * @property integer $TotalPoint
 * @property string $LastAmount
 * @property integer $LastPoint
 * @property integer $CustomerId
 *
 * @property CustomerCard[] $customerCards
 * @property CustomerPointItems[] $customerPointItems
 * @property Customer $customer
 */
class CustomerPointTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_point_total';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TotalAmount', 'LastAmount'], 'number'],
            [['TotalPoint', 'LastPoint', 'CustomerId'], 'integer'],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TotalAmount' => 'Total Amount',
            'TotalPoint' => 'Total Point',
            'LastAmount' => 'Last Amount',
            'LastPoint' => 'Last Point',
            'CustomerId' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCards()
    {
        return $this->hasMany(CustomerCard::className(), ['CustomerTotalPointId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPointItems()
    {
        return $this->hasMany(CustomerPointItems::className(), ['CustomerTotalPointId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }
}
