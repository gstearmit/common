<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_customer".
 *
 * @property integer $id
 * @property string $FirstName
 * @property string $LastName
 * @property string $FullName
 * @property string $Email
 * @property string $Mobile
 * @property string $IdentityNumber
 * @property string $PhoneHome
 * @property string $Address
 * @property string $PostalCode
 * @property integer $CountryId
 * @property integer $ProvinceId
 * @property integer $DistrictId
 * @property integer $Deleted
 * @property integer $IsPersonal
 * @property string $Job
 * @property string $CompanyName
 * @property string $CompanyTaxCode
 * @property string $Note
 * @property integer $CustomerGroupId
 * @property integer $CustomerId
 *
 * @property PosAddress[] $posAddresses
 * @property SystemCountry $country
 * @property SystemStateProvince $province
 * @property SystemDistrict $district
 * @property CustomerGroup $customerGroup
 * @property Customer $customer
 * @property PosCustomerImages[] $posCustomerImages
 * @property PosOrderRequest[] $posOrderRequests
 */
class PosCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CountryId', 'ProvinceId', 'DistrictId', 'Deleted', 'IsPersonal', 'CustomerGroupId', 'CustomerId'], 'integer'],
            [['FirstName', 'LastName', 'FullName', 'Email', 'PhoneHome', 'Address', 'PostalCode', 'Job', 'CompanyName', 'CompanyTaxCode', 'Note'], 'string', 'max' => 255],
            [['Mobile', 'IdentityNumber'], 'string', 'max' => 50],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['CountryId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
            [['CustomerGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['CustomerGroupId' => 'id']],
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
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'FullName' => 'Full Name',
            'Email' => 'Email',
            'Mobile' => 'Mobile',
            'IdentityNumber' => 'Identity Number',
            'PhoneHome' => 'Phone Home',
            'Address' => 'Address',
            'PostalCode' => 'Postal Code',
            'CountryId' => 'Country ID',
            'ProvinceId' => 'Province ID',
            'DistrictId' => 'District ID',
            'Deleted' => 'Deleted',
            'IsPersonal' => 'Is Personal',
            'Job' => 'Job',
            'CompanyName' => 'Company Name',
            'CompanyTaxCode' => 'Company Tax Code',
            'Note' => 'Note',
            'CustomerGroupId' => 'Customer Group ID',
            'CustomerId' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosAddresses()
    {
        return $this->hasMany(PosAddress::className(), ['PosCustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'CountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'ProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'DistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['id' => 'CustomerGroupId']);
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
    public function getPosCustomerImages()
    {
        return $this->hasMany(PosCustomerImages::className(), ['PosCustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['CustomerPosId' => 'id']);
    }
}
