<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $Name
 * @property string $EnglishName
 * @property string $Code
 * @property string $Caption
 * @property string $Status
 * @property string $Type
 * @property string $Group
 * @property string $Address
 * @property string $VatCode
 * @property string $DirectorName
 * @property string $ChiefAccountant
 * @property string $AniversaryDate
 * @property integer $IsActive
 * @property integer $Deleted
 *
 * @property Affiliate[] $affiliates
 * @property Customer[] $customers
 * @property CustomerCall[] $customerCalls
 * @property EmailAccount[] $emailAccounts
 * @property Invoice[] $invoices
 * @property Order[] $orders
 * @property OrganizationBankAccount[] $organizationBankAccounts
 * @property OrganizationContact[] $organizationContacts
 * @property OrganizationDepartment[] $organizationDepartments
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder[] $purchaseOrders0
 * @property SaleCommissionSetting[] $saleCommissionSettings
 * @property SaleTeam[] $saleTeams
 * @property Store[] $stores
 * @property SystemAccount[] $systemAccounts
 * @property TransactionAccount[] $transactionAccounts
 * @property TransactionAccountSystem[] $transactionAccountSystems
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageReturn[] $warehousePackageReturns
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AniversaryDate'], 'safe'],
            [['IsActive', 'Deleted'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['EnglishName', 'Code', 'Caption', 'Status', 'Type', 'Group', 'VatCode', 'DirectorName', 'ChiefAccountant'], 'string', 'max' => 50],
            [['Address'], 'string', 'max' => 200],
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
            'EnglishName' => 'English Name',
            'Code' => 'Code',
            'Caption' => 'Caption',
            'Status' => 'Status',
            'Type' => 'Type',
            'Group' => 'Group',
            'Address' => 'Address',
            'VatCode' => 'Vat Code',
            'DirectorName' => 'Director Name',
            'ChiefAccountant' => 'Chief Accountant',
            'AniversaryDate' => 'Aniversary Date',
            'IsActive' => 'Is Active',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliates()
    {
        return $this->hasMany(Affiliate::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['ManageOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCalls()
    {
        return $this->hasMany(CustomerCall::className(), ['RefOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAccounts()
    {
        return $this->hasMany(EmailAccount::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['ManageOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['ManageOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationBankAccounts()
    {
        return $this->hasMany(OrganizationBankAccount::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationContacts()
    {
        return $this->hasMany(OrganizationContact::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationDepartments()
    {
        return $this->hasMany(OrganizationDepartment::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['BillToOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders0()
    {
        return $this->hasMany(PurchaseOrder::className(), ['BillByOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettings()
    {
        return $this->hasMany(SaleCommissionSetting::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeams()
    {
        return $this->hasMany(SaleTeam::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['ManageByOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccounts()
    {
        return $this->hasMany(SystemAccount::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccounts()
    {
        return $this->hasMany(TransactionAccount::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccountSystems()
    {
        return $this->hasMany(TransactionAccountSystem::className(), ['OrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['ManageOrganizationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageReturns()
    {
        return $this->hasMany(WarehousePackageReturn::className(), ['FeeBillToOrganizationId' => 'id']);
    }
}
