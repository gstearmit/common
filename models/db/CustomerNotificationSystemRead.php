<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_notification_system_read".
 *
 * @property integer $id
 * @property integer $customerId
 * @property integer $notifyId
 * @property string $readTime
 *
 * @property Customer $customer
 * @property Notification $notify
 */
class CustomerNotificationSystemRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_notification_system_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'notifyId'], 'integer'],
            [['readTime'], 'safe'],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['notifyId'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['notifyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerId' => 'Customer ID',
            'notifyId' => 'Notify ID',
            'readTime' => 'Read Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotify()
    {
        return $this->hasOne(Notification::className(), ['id' => 'notifyId']);
    }
}
