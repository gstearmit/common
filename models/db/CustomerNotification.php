<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_notification".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $toCustomerId
 * @property string $subject
 * @property string $message
 * @property string $sendAt
 * @property integer $typeId
 * @property string $createdAt
 * @property integer $readAt
 * @property integer $objectType
 * @property string $objectId
 * @property string $objectName
 * @property string $image
 * @property integer $siteId
 * @property integer $StoreId
 * @property integer $deleted
 *
 * @property NotificationType $type
 * @property Customer $toCustomer
 */
class CustomerNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'toCustomerId', 'typeId', 'readAt', 'objectType', 'siteId', 'StoreId', 'deleted'], 'integer'],
            [['subject'], 'required'],
            [['sendAt', 'createdAt'], 'safe'],
            [['subject', 'objectName'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 4000],
            [['objectId'], 'string', 'max' => 15],
            [['image'], 'string', 'max' => 500],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationType::className(), 'targetAttribute' => ['typeId' => 'id']],
            [['toCustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['toCustomerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'toCustomerId' => 'To Customer ID',
            'subject' => 'Subject',
            'message' => 'Message',
            'sendAt' => 'Send At',
            'typeId' => 'Type ID',
            'createdAt' => 'Created At',
            'readAt' => 'Read At',
            'objectType' => 'Object Type',
            'objectId' => 'Object ID',
            'objectName' => 'Object Name',
            'image' => 'Image',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(NotificationType::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'toCustomerId']);
    }
}
