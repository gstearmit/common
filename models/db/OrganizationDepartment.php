<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_department".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Address
 * @property string $Phone
 * @property string $Description
 * @property integer $IsActive
 * @property integer $Deleted
 * @property integer $OrganizationId
 *
 * @property Customer[] $customers
 * @property Order[] $orders
 * @property Organization $organization
 * @property OrganizationEmployee[] $organizationEmployees
 */
class OrganizationDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsActive', 'Deleted', 'OrganizationId'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['Address'], 'string', 'max' => 500],
            [['Phone'], 'string', 'max' => 20],
            [['Description'], 'string', 'max' => 200],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Address' => 'Address',
            'Phone' => 'Phone',
            'Description' => 'Description',
            'IsActive' => 'Is Active',
            'Deleted' => 'Deleted',
            'OrganizationId' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['ManageDepartmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['ManageDepartmentId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'OrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationEmployees()
    {
        return $this->hasMany(OrganizationEmployee::className(), ['DepartmentId' => 'id']);
    }
}
