<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_commission_summary".
 *
 * @property integer $id
 * @property integer $EmployeeId
 * @property string $TotalCommission
 * @property string $PaidCommission
 * @property string $RemainCommsission
 * @property string $LastUpdate
 * @property string $LastAmount
 * @property integer $Month
 * @property integer $Year
 *
 * @property OrganizationEmployee $employee
 */
class SaleCommissionSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_commission_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeId', 'Month', 'Year'], 'integer'],
            [['TotalCommission', 'PaidCommission', 'RemainCommsission'], 'number'],
            [['LastUpdate'], 'safe'],
            [['LastAmount'], 'string', 'max' => 10],
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
            'TotalCommission' => 'Total Commission',
            'PaidCommission' => 'Paid Commission',
            'RemainCommsission' => 'Remain Commsission',
            'LastUpdate' => 'Last Update',
            'LastAmount' => 'Last Amount',
            'Month' => 'Month',
            'Year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }
}
