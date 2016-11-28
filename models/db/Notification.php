<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $fromObjectId
 * @property integer $fromTypeObjectId
 * @property integer $toObjectId
 * @property integer $toTypeObjectId
 * @property string $subject
 * @property string $message
 * @property integer $templateId
 * @property string $imageUrls
 * @property string $sentAt
 * @property string $createdAt
 * @property integer $readAt
 * @property string $sendObjectTable
 * @property integer $sendObjectId
 * @property integer $siteId
 * @property integer $storeId
 * @property integer $deleted
 * @property integer $priority
 * @property string $targetLink
 *
 * @property CustomerNotificationSystemRead[] $customerNotificationSystemReads
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromObjectId', 'fromTypeObjectId', 'toObjectId', 'toTypeObjectId', 'templateId', 'readAt', 'sendObjectId', 'siteId', 'storeId', 'deleted', 'priority'], 'integer'],
            [['subject'], 'required'],
            [['sentAt', 'createdAt'], 'safe'],
            [['subject'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 4000],
            [['imageUrls'], 'string', 'max' => 500],
            [['sendObjectTable'], 'string', 'max' => 50],
            [['targetLink'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fromObjectId' => 'From Object ID',
            'fromTypeObjectId' => 'From Type Object ID',
            'toObjectId' => 'To Object ID',
            'toTypeObjectId' => 'To Type Object ID',
            'subject' => 'Subject',
            'message' => 'Message',
            'templateId' => 'Template ID',
            'imageUrls' => 'Image Urls',
            'sentAt' => 'Sent At',
            'createdAt' => 'Created At',
            'readAt' => 'Read At',
            'sendObjectTable' => 'Send Object Table',
            'sendObjectId' => 'Send Object ID',
            'siteId' => 'Site ID',
            'storeId' => 'Store ID',
            'deleted' => 'Deleted',
            'priority' => 'Priority',
            'targetLink' => 'Target Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNotificationSystemReads()
    {
        return $this->hasMany(CustomerNotificationSystemRead::className(), ['notifyId' => 'id']);
    }
}
