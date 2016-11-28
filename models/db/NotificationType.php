<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "notification_type".
 *
 * @property integer $id
 * @property string $system_name
 * @property string $name
 * @property integer $displayOrder
 * @property integer $active
 *
 * @property CustomerNotification[] $customerNotifications
 * @property NotificationSettingCustomer[] $notificationSettingCustomers
 */
class NotificationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['displayOrder', 'active'], 'integer'],
            [['system_name', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system_name' => 'System Name',
            'name' => 'Name',
            'displayOrder' => 'Display Order',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNotifications()
    {
        return $this->hasMany(CustomerNotification::className(), ['typeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationSettingCustomers()
    {
        return $this->hasMany(NotificationSettingCustomer::className(), ['notification_type_id' => 'id']);
    }
}
