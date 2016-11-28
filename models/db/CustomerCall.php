<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_call".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $CategoryId
 * @property string $CallNumber
 * @property string $CallDate
 * @property integer $RecievedByEmployeeId
 * @property string $AboutContent
 * @property string $Result
 * @property integer $ProcessStatus
 * @property integer $RefOrganizationId
 * @property integer $EmployeeInChargeId
 *
 * @property Customer $customer
 * @property OrganizationEmployee $recievedByEmployee
 * @property OrganizationEmployee $employeeInCharge
 * @property Organization $refOrganization
 * @property Category $category
 */
class CustomerCall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_call';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CategoryId', 'RecievedByEmployeeId', 'ProcessStatus', 'RefOrganizationId', 'EmployeeInChargeId'], 'integer'],
            [['CallDate'], 'safe'],
            [['AboutContent', 'Result'], 'string'],
            [['CallNumber'], 'string', 'max' => 20],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['RecievedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['RecievedByEmployeeId' => 'id']],
            [['EmployeeInChargeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeInChargeId' => 'id']],
            [['RefOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['RefOrganizationId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
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
            'CategoryId' => 'Category ID',
            'CallNumber' => 'Call Number',
            'CallDate' => 'Call Date',
            'RecievedByEmployeeId' => 'Recieved By Employee ID',
            'AboutContent' => 'About Content',
            'Result' => 'Result',
            'ProcessStatus' => 'Process Status',
            'RefOrganizationId' => 'Ref Organization ID',
            'EmployeeInChargeId' => 'Employee In Charge ID',
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
    public function getRecievedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'RecievedByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeInCharge()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeInChargeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'RefOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }
}
