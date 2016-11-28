<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "affiliate".
 *
 * @property integer $id
 * @property integer $OrganizationId
 * @property integer $EmployeeInChargeId
 * @property string $Name
 * @property string $EnglishName
 * @property string $SecurityCode
 * @property string $Caption
 * @property string $Website
 * @property string $Email
 * @property string $Address
 * @property string $PersonalIncomeCode
 * @property string $VatCode
 * @property string $DirectorName
 * @property string $ChiefAccountant
 * @property string $AniversaryDate
 * @property integer $StatusId
 * @property integer $AffiliateTypeId
 * @property integer $GroupId
 * @property integer $active
 * @property integer $Deleted
 * @property integer $IsPersonal
 * @property integer $siteId
 * @property integer $StoreId
 *
 * @property AffiliateType $affiliateType
 * @property AffiliateGroup $group
 * @property Organization $organization
 * @property OrganizationEmployee $employeeInCharge
 * @property Site $site
 * @property Store $store
 * @property BannerLog[] $bannerLogs
 * @property CouponAffiliate[] $couponAffiliates
 * @property Customer[] $customers
 * @property Order[] $orders
 */
class Affiliate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'affiliate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrganizationId', 'EmployeeInChargeId', 'StatusId', 'AffiliateTypeId', 'GroupId', 'active', 'Deleted', 'IsPersonal', 'siteId', 'StoreId'], 'integer'],
            [['AniversaryDate'], 'safe'],
            [['Name', 'Website', 'Email'], 'string', 'max' => 100],
            [['EnglishName', 'DirectorName', 'ChiefAccountant'], 'string', 'max' => 50],
            [['SecurityCode', 'Caption', 'Address'], 'string', 'max' => 10],
            [['PersonalIncomeCode', 'VatCode'], 'string', 'max' => 20],
            [['AffiliateTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => AffiliateType::className(), 'targetAttribute' => ['AffiliateTypeId' => 'id']],
            [['GroupId'], 'exist', 'skipOnError' => true, 'targetClass' => AffiliateGroup::className(), 'targetAttribute' => ['GroupId' => 'id']],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
            [['EmployeeInChargeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeInChargeId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'OrganizationId' => 'Organization ID',
            'EmployeeInChargeId' => 'Employee In Charge ID',
            'Name' => 'Name',
            'EnglishName' => 'English Name',
            'SecurityCode' => 'Security Code',
            'Caption' => 'Caption',
            'Website' => 'Website',
            'Email' => 'Email',
            'Address' => 'Address',
            'PersonalIncomeCode' => 'Personal Income Code',
            'VatCode' => 'Vat Code',
            'DirectorName' => 'Director Name',
            'ChiefAccountant' => 'Chief Accountant',
            'AniversaryDate' => 'Aniversary Date',
            'StatusId' => 'Status ID',
            'AffiliateTypeId' => 'Affiliate Type ID',
            'GroupId' => 'Group ID',
            'active' => 'Active',
            'Deleted' => 'Deleted',
            'IsPersonal' => 'Is Personal',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliateType()
    {
        return $this->hasOne(AffiliateType::className(), ['id' => 'AffiliateTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AffiliateGroup::className(), ['id' => 'GroupId']);
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
    public function getEmployeeInCharge()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeInChargeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerLogs()
    {
        return $this->hasMany(BannerLog::className(), ['AffiliateId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponAffiliates()
    {
        return $this->hasMany(CouponAffiliate::className(), ['AffiliateId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['AffiliateId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['AffiliateId' => 'id']);
    }
}
