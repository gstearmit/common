<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_note".
 *
 * @property integer $id
 * @property integer $EmployeeId
 * @property integer $OrderId
 * @property string $Note
 * @property integer $DisplayToCustomer
 * @property string $CreatedTime
 *
 * @property Order $order
 * @property OrganizationEmployee $employee
 */
class OrderNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeId', 'OrderId', 'DisplayToCustomer'], 'integer'],
            [['Note'], 'string'],
            [['CreatedTime'], 'safe'],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'EmployeeId' => 'Employee ID',
            'OrderId' => 'Order ID',
            'Note' => 'Note',
            'DisplayToCustomer' => 'Display To Customer',
            'CreatedTime' => 'Created Time',
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
}
