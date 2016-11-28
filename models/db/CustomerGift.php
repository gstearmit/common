<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_gift".
 *
 * @property integer $id
 * @property integer $GiftId
 * @property integer $CustomerId
 * @property integer $OrderIdRef
 * @property integer $TotalGiftIssued
 * @property integer $TotaGiftlRecieved
 * @property string $DateSent
 * @property integer $SentByEmployeeId
 * @property string $Note
 * @property integer $Deleted
 *
 * @property Customer $customer
 * @property Order $orderIdRef
 * @property OrganizationEmployee $sentByEmployee
 */
class CustomerGift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_gift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GiftId', 'CustomerId', 'OrderIdRef', 'TotalGiftIssued', 'TotaGiftlRecieved', 'SentByEmployeeId', 'Deleted'], 'integer'],
            [['DateSent'], 'safe'],
            [['Note'], 'string', 'max' => 500],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['OrderIdRef'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderIdRef' => 'id']],
            [['SentByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['SentByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'GiftId' => 'Gift ID',
            'CustomerId' => 'Customer ID',
            'OrderIdRef' => 'Order Id Ref',
            'TotalGiftIssued' => 'Total Gift Issued',
            'TotaGiftlRecieved' => 'Tota Giftl Recieved',
            'DateSent' => 'Date Sent',
            'SentByEmployeeId' => 'Sent By Employee ID',
            'Note' => 'Note',
            'Deleted' => 'Deleted',
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
    public function getOrderIdRef()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderIdRef']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'SentByEmployeeId']);
    }
}
