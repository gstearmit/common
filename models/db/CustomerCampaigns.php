<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_campaigns".
 *
 * @property integer $id
 * @property integer $Customer_Id
 * @property integer $Campaign_Id
 *
 * @property Customer $customer
 * @property Campaign $campaign
 */
class CustomerCampaigns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_campaigns';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Customer_Id', 'Campaign_Id'], 'integer'],
            [['Customer_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['Customer_Id' => 'id']],
            [['Campaign_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['Campaign_Id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Customer_Id' => 'Customer  ID',
            'Campaign_Id' => 'Campaign  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'Customer_Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'Campaign_Id']);
    }
}
