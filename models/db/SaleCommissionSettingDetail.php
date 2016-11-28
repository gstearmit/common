<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_commission_setting_detail".
 *
 * @property integer $id
 * @property integer $EmployeeId
 * @property integer $CommissionId
 * @property integer $OrderId
 * @property string $TotalOrderAmount
 * @property string $TotalOrderAmountSucess
 * @property string $PercentageCommission
 * @property string $TotalCommissionSuccess
 * @property string $GetPaidAmount
 * @property string $RemainingAmount
 * @property integer $PaymentMethodId
 * @property string $PaidDate
 *
 * @property OrganizationEmployee $employee
 * @property PaymentMethod $paymentMethod
 * @property Order $order
 * @property SaleCommissionSetting $commission
 */
class SaleCommissionSettingDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_commission_setting_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeId', 'CommissionId', 'OrderId', 'PaymentMethodId'], 'integer'],
            [['TotalOrderAmount', 'TotalOrderAmountSucess', 'PercentageCommission', 'TotalCommissionSuccess', 'GetPaidAmount', 'RemainingAmount'], 'number'],
            [['PaidDate'], 'safe'],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
            [['PaymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['PaymentMethodId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
            [['CommissionId'], 'exist', 'skipOnError' => true, 'targetClass' => SaleCommissionSetting::className(), 'targetAttribute' => ['CommissionId' => 'id']],
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
            'CommissionId' => 'Commission ID',
            'OrderId' => 'Order ID',
            'TotalOrderAmount' => 'Total Order Amount',
            'TotalOrderAmountSucess' => 'Total Order Amount Sucess',
            'PercentageCommission' => 'Percentage Commission',
            'TotalCommissionSuccess' => 'Total Commission Success',
            'GetPaidAmount' => 'Get Paid Amount',
            'RemainingAmount' => 'Remaining Amount',
            'PaymentMethodId' => 'Payment Method ID',
            'PaidDate' => 'Paid Date',
        ];
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'PaymentMethodId']);
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
    public function getCommission()
    {
        return $this->hasOne(SaleCommissionSetting::className(), ['id' => 'CommissionId']);
    }
}
