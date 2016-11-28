<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $Company
 * @property integer $SystemCountryId
 * @property integer $SystemStateProvinceId
 * @property integer $SystemDistrictId
 * @property string $City
 * @property string $Address1
 * @property string $Address2
 * @property string $ZipPostalCode
 * @property string $PhoneNumber
 * @property string $FaxNumber
 * @property string $CreatedTime
 * @property integer $StoreId
 * @property integer $Type
 * @property integer $IsDefault
 * @property integer $isDeleted
 * @property integer $CustomerId
 *
 * @property SystemStateProvince $systemStateProvince
 * @property Store $store
 * @property SystemDistrict $systemDistrict
 * @property SystemCountry $systemCountry
 * @property Customer $customer
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 * @property RequestShipment[] $requestShipments
 * @property Shipment[] $shipments
 * @property Shipment[] $shipments0
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SystemCountryId', 'SystemStateProvinceId', 'SystemDistrictId', 'StoreId', 'Type', 'IsDefault', 'isDeleted', 'CustomerId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['FirstName', 'Company'], 'string', 'max' => 200],
            [['LastName', 'ZipPostalCode'], 'string', 'max' => 50],
            [['Email', 'City'], 'string', 'max' => 100],
            [['Address1', 'Address2'], 'string', 'max' => 255],
            [['PhoneNumber', 'FaxNumber'], 'string', 'max' => 20],
            [['SystemStateProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['SystemStateProvinceId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['SystemDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['SystemDistrictId' => 'id']],
            [['SystemCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['SystemCountryId' => 'id']],
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
            'Email' => 'Email',
            'Company' => 'Company',
            'SystemCountryId' => 'System Country ID',
            'SystemStateProvinceId' => 'System State Province ID',
            'SystemDistrictId' => 'System District ID',
            'City' => 'City',
            'Address1' => 'Address1',
            'Address2' => 'Address2',
            'ZipPostalCode' => 'Zip Postal Code',
            'PhoneNumber' => 'Phone Number',
            'FaxNumber' => 'Fax Number',
            'CreatedTime' => 'Created Time',
            'StoreId' => 'Store ID',
            'Type' => 'Type',
            'IsDefault' => 'Is Default',
            'isDeleted' => 'Is Deleted',
            'CustomerId' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemStateProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'SystemStateProvinceId']);
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
    public function getSystemDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'SystemDistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'SystemCountryId']);
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
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['BillingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['BillingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['ShippingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['BillingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['BillingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['ShippingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['shippingAddressId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments0()
    {
        return $this->hasMany(Shipment::className(), ['billingAddressId' => 'id']);
    }
}
