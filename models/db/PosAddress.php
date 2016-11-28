<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_address".
 *
 * @property integer $id
 * @property string $FirstName
 * @property string $LastName
 * @property string $FullName
 * @property string $Email
 * @property string $MobilePhone
 * @property string $AddressLine1
 * @property string $AddressLine2
 * @property string $ZipPostalCode
 * @property integer $DistrictId
 * @property integer $ProvinceId
 * @property integer $CountryId
 * @property integer $TypeAddress
 * @property integer $IsDefault
 * @property integer $Deleted
 * @property string $CreatedTime
 * @property integer $PosCustomerId
 *
 * @property PosCustomer $posCustomer
 * @property SystemDistrict $district
 * @property SystemStateProvince $province
 * @property SystemCountry $country
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequest[] $posOrderRequests0
 */
class PosAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DistrictId', 'ProvinceId', 'CountryId', 'TypeAddress', 'IsDefault', 'Deleted', 'PosCustomerId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['FirstName', 'LastName', 'FullName', 'Email', 'MobilePhone', 'AddressLine1', 'AddressLine2', 'ZipPostalCode'], 'string', 'max' => 255],
            [['PosCustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => PosCustomer::className(), 'targetAttribute' => ['PosCustomerId' => 'id']],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['CountryId' => 'id']],
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
            'MobilePhone' => 'Mobile Phone',
            'AddressLine1' => 'Address Line1',
            'AddressLine2' => 'Address Line2',
            'ZipPostalCode' => 'Zip Postal Code',
            'DistrictId' => 'District ID',
            'ProvinceId' => 'Province ID',
            'CountryId' => 'Country ID',
            'TypeAddress' => 'Type Address',
            'IsDefault' => 'Is Default',
            'Deleted' => 'Deleted',
            'CreatedTime' => 'Created Time',
            'PosCustomerId' => 'Pos Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomer()
    {
        return $this->hasOne(PosCustomer::className(), ['id' => 'PosCustomerId']);
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
    public function getProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'ProvinceId']);
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
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['ShippingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests0()
    {
        return $this->hasMany(PosOrderRequest::className(), ['BillingAddressId' => 'id']);
    }
}
