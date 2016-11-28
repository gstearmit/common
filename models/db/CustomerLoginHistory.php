<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_login_history".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property string $UserName
 * @property string $OldEmail
 * @property string $OldPassword
 * @property string $OldPasswordSalt
 * @property integer $IsCurrentActive
 * @property string $IpAddress
 * @property string $AdminComment
 * @property string $CreatedTime
 * @property string $LastActivityDate
 *
 * @property Customer $customer
 */
class CustomerLoginHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_login_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'IsCurrentActive'], 'integer'],
            [['CreatedTime', 'LastActivityDate'], 'safe'],
            [['UserName', 'OldEmail'], 'string', 'max' => 100],
            [['OldPassword', 'OldPasswordSalt'], 'string', 'max' => 50],
            [['IpAddress'], 'string', 'max' => 20],
            [['AdminComment'], 'string', 'max' => 500],
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
            'CustomerId' => 'Customer ID',
            'UserName' => 'User Name',
            'OldEmail' => 'Old Email',
            'OldPassword' => 'Old Password',
            'OldPasswordSalt' => 'Old Password Salt',
            'IsCurrentActive' => 'Is Current Active',
            'IpAddress' => 'Ip Address',
            'AdminComment' => 'Admin Comment',
            'CreatedTime' => 'Created Time',
            'LastActivityDate' => 'Last Activity Date',
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
