<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "call_detail".
 *
 * @property integer $id
 * @property string $CreatedDateTime
 * @property string $RemoteNo
 * @property string $DNID
 * @property string $Direction
 * @property string $CallType
 * @property string $DurationInSeconds
 * @property string $EnteredQueueDateTime
 * @property string $QueueName
 * @property string $AgentAnsweredDateTime
 * @property string $SIP_Extension
 * @property string $UserId
 * @property string $TalkTimeInSeconds
 * @property string $RecordingFileName
 * @property string $LastChannelToUniqueId
 * @property string $LastBridgedToUniqueId
 * @property string $DisconnectedDateTime
 * @property string $DisconnectMode
 * @property string $Note
 * @property string $IPCC_SMART_Field1
 * @property string $IPCC_SMART_Channel
 * @property integer $CustomerId
 *
 * @property Customer $customer
 */
class CallDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId'], 'integer'],
            [['CreatedDateTime', 'RemoteNo', 'DNID', 'Direction', 'CallType', 'DurationInSeconds', 'EnteredQueueDateTime', 'QueueName', 'AgentAnsweredDateTime', 'SIP_Extension', 'UserId', 'TalkTimeInSeconds', 'RecordingFileName', 'LastChannelToUniqueId', 'LastBridgedToUniqueId', 'DisconnectedDateTime', 'DisconnectMode', 'IPCC_SMART_Field1', 'IPCC_SMART_Channel'], 'string', 'max' => 100],
            [['Note'], 'string', 'max' => 200],
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
            'CreatedDateTime' => 'Created Date Time',
            'RemoteNo' => 'Remote No',
            'DNID' => 'Dnid',
            'Direction' => 'Direction',
            'CallType' => 'Call Type',
            'DurationInSeconds' => 'Duration In Seconds',
            'EnteredQueueDateTime' => 'Entered Queue Date Time',
            'QueueName' => 'Queue Name',
            'AgentAnsweredDateTime' => 'Agent Answered Date Time',
            'SIP_Extension' => 'Sip  Extension',
            'UserId' => 'User ID',
            'TalkTimeInSeconds' => 'Talk Time In Seconds',
            'RecordingFileName' => 'Recording File Name',
            'LastChannelToUniqueId' => 'Last Channel To Unique ID',
            'LastBridgedToUniqueId' => 'Last Bridged To Unique ID',
            'DisconnectedDateTime' => 'Disconnected Date Time',
            'DisconnectMode' => 'Disconnect Mode',
            'Note' => 'Note',
            'IPCC_SMART_Field1' => 'Ipcc  Smart  Field1',
            'IPCC_SMART_Channel' => 'Ipcc  Smart  Channel',
            'CustomerId' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }
}
