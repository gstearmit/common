<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "call_log".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $CallId
 * @property string $CallDate
 * @property integer $TypeCall
 * @property string $RequestDetail
 * @property string $DetailConversation
 * @property string $LastConversation
 * @property integer $CallBack
 * @property string $ScheduleDateToCallBack
 * @property integer $Status
 * @property integer $EmployeeId
 * @property string $RecordingFilePath
 * @property integer $OrderId
 *
 * @property Customer $customer
 * @property OrganizationEmployee $employee
 * @property Order $order
 * @property OrderSupportLog[] $orderSupportLogs
 */
class CallLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CallId', 'TypeCall', 'CallBack', 'Status', 'EmployeeId', 'OrderId'], 'integer'],
            [['CallDate', 'ScheduleDateToCallBack'], 'safe'],
            [['RequestDetail', 'DetailConversation', 'LastConversation'], 'string'],
            [['RecordingFilePath'], 'string', 'max' => 255],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
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
            'CustomerId' => 'Customer ID',
            'CallId' => 'Call ID',
            'CallDate' => 'Call Date',
            'TypeCall' => 'Type Call',
            'RequestDetail' => 'Request Detail',
            'DetailConversation' => 'Detail Conversation',
            'LastConversation' => 'Last Conversation',
            'CallBack' => 'Call Back',
            'ScheduleDateToCallBack' => 'Schedule Date To Call Back',
            'Status' => 'Status',
            'EmployeeId' => 'Employee ID',
            'RecordingFilePath' => 'Recording File Path',
            'OrderId' => 'Order ID',
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
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSupportLogs()
    {
        return $this->hasMany(OrderSupportLog::className(), ['CallLogId' => 'id']);
    }
}
