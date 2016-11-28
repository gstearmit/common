<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_employee_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $employeeId
 * @property integer $departmentTypeId
 *
 * @property OrganizationEmployee $employee
 * @property OrganizationDepartmentType $departmentType
 */
class OrganizationEmployeeType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_employee_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'departmentTypeId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['departmentTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationDepartmentType::className(), 'targetAttribute' => ['departmentTypeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'employeeId' => 'Employee ID',
            'departmentTypeId' => 'Department Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'employeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentType()
    {
        return $this->hasOne(OrganizationDepartmentType::className(), ['id' => 'departmentTypeId']);
    }
}
