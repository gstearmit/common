<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_email".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $SendByEmployeeId
 * @property string $Subject
 * @property string $Body
 * @property string $CreatedDate
 * @property string $SentDate
 * @property integer $Status
 *
 * @property Customer $customer
 * @property OrganizationEmployee $sendByEmployee
 */
class CustomerEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'SendByEmployeeId', 'Status'], 'integer'],
            [['CreatedDate', 'SentDate'], 'safe'],
            [['Subject'], 'string', 'max' => 500],
            [['Body'], 'string', 'max' => 4000],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['SendByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['SendByEmployeeId' => 'id']],
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
            'SendByEmployeeId' => 'Send By Employee ID',
            'Subject' => 'Subject',
            'Body' => 'Body',
            'CreatedDate' => 'Created Date',
            'SentDate' => 'Sent Date',
            'Status' => 'Status',
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
    public function getSendByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'SendByEmployeeId']);
    }
}
