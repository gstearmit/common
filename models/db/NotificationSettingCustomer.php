<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "notification_setting_customer".
 *
 * @property integer $id
 * @property integer $notification_channel_id
 * @property integer $notification_type_id
 * @property integer $customer_id
 *
 * @property NotificationChannel $notificationChannel
 * @property NotificationType $notificationType
 * @property Customer $customer
 */
class NotificationSettingCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_setting_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_channel_id', 'notification_type_id', 'customer_id'], 'integer'],
            [['notification_channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationChannel::className(), 'targetAttribute' => ['notification_channel_id' => 'id']],
            [['notification_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationType::className(), 'targetAttribute' => ['notification_type_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_channel_id' => 'Notification Channel ID',
            'notification_type_id' => 'Notification Type ID',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationChannel()
    {
        return $this->hasOne(NotificationChannel::className(), ['id' => 'notification_channel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationType()
    {
        return $this->hasOne(NotificationType::className(), ['id' => 'notification_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
