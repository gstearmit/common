<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "queued_email".
 *
 * @property integer $id
 * @property integer $Priority
 * @property string $From
 * @property string $FromName
 * @property string $To
 * @property string $ToName
 * @property string $CC
 * @property string $Bcc
 * @property string $Subject
 * @property string $Body
 * @property string $CreatedTime
 * @property integer $SentTries
 * @property string $SentOn
 * @property integer $EmailAccountId
 * @property integer $CampaignId
 * @property integer $TemplateId
 * @property string $RecipientId
 * @property integer $Opened
 * @property string $Openedon
 * @property string $Status
 * @property integer $OrderId
 * @property string $api_id
 * @property integer $Bounce
 * @property integer $Clicked
 * @property integer $Sent
 * @property integer $Using
 *
 * @property EmailAccount $emailAccount
 * @property EmailTemplate $template
 * @property Campaign $campaign
 * @property Order $order
 */
class QueuedEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'queued_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Priority', 'SentTries', 'EmailAccountId', 'CampaignId', 'TemplateId', 'Opened', 'OrderId', 'Bounce', 'Clicked', 'Sent', 'Using'], 'integer'],
            [['Body'], 'string'],
            [['CreatedTime', 'SentOn', 'Openedon'], 'safe'],
            [['From', 'FromName', 'To', 'ToName', 'CC', 'Bcc'], 'string', 'max' => 500],
            [['Subject'], 'string', 'max' => 1000],
            [['RecipientId'], 'string', 'max' => 50],
            [['Status'], 'string', 'max' => 30],
            [['api_id'], 'string', 'max' => 200],
            [['EmailAccountId'], 'exist', 'skipOnError' => true, 'targetClass' => EmailAccount::className(), 'targetAttribute' => ['EmailAccountId' => 'id']],
            [['TemplateId'], 'exist', 'skipOnError' => true, 'targetClass' => EmailTemplate::className(), 'targetAttribute' => ['TemplateId' => 'id']],
            [['CampaignId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['CampaignId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Priority' => 'Priority',
            'From' => 'From',
            'FromName' => 'From Name',
            'To' => 'To',
            'ToName' => 'To Name',
            'CC' => 'Cc',
            'Bcc' => 'Bcc',
            'Subject' => 'Subject',
            'Body' => 'Body',
            'CreatedTime' => 'Created Time',
            'SentTries' => 'Sent Tries',
            'SentOn' => 'Sent On',
            'EmailAccountId' => 'Email Account ID',
            'CampaignId' => 'Campaign ID',
            'TemplateId' => 'Template ID',
            'RecipientId' => 'Recipient ID',
            'Opened' => 'Opened',
            'Openedon' => 'Openedon',
            'Status' => 'Status',
            'OrderId' => 'Order ID',
            'api_id' => 'Api ID',
            'Bounce' => 'Bounce',
            'Clicked' => 'Clicked',
            'Sent' => 'Sent',
            'Using' => 'Using',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAccount()
    {
        return $this->hasOne(EmailAccount::className(), ['id' => 'EmailAccountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(EmailTemplate::className(), ['id' => 'TemplateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'CampaignId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }
}
