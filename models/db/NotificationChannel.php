<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "notification_channel".
 *
 * @property integer $id
 * @property string $system_name
 * @property string $name
 * @property integer $displayOrder
 * @property integer $active
 *
 * @property NotificationSettingCustomer[] $notificationSettingCustomers
 */
class NotificationChannel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_channel';
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
    public function getNotificationSettingCustomers()
    {
        return $this->hasMany(NotificationSettingCustomer::className(), ['notification_channel_id' => 'id']);
    }
}
