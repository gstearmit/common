<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_support_log".
 *
 * @property integer $id
 * @property integer $OrderId
 * @property integer $EmployeeId
 * @property string $SupportedDate
 * @property string $LevelSupport
 * @property integer $Priority
 * @property string $Note
 * @property integer $CallStatus
 * @property integer $CallLogId
 *
 * @property Order $order
 * @property OrganizationEmployee $employee
 * @property CallLog $callLog
 */
class OrderSupportLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_support_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderId', 'EmployeeId', 'Priority', 'CallStatus', 'CallLogId'], 'integer'],
            [['SupportedDate'], 'safe'],
            [['LevelSupport'], 'string', 'max' => 50],
            [['Note'], 'string', 'max' => 500],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
            [['CallLogId'], 'exist', 'skipOnError' => true, 'targetClass' => CallLog::className(), 'targetAttribute' => ['CallLogId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'OrderId' => 'Order ID',
            'EmployeeId' => 'Employee ID',
            'SupportedDate' => 'Supported Date',
            'LevelSupport' => 'Level Support',
            'Priority' => 'Priority',
            'Note' => 'Note',
            'CallStatus' => 'Call Status',
            'CallLogId' => 'Call Log ID',
        ];
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
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallLog()
    {
        return $this->hasOne(CallLog::className(), ['id' => 'CallLogId']);
    }
}
