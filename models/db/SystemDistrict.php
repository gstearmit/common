<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_district".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property integer $IsDefault
 * @property integer $DisplayOrder
 * @property integer $IsActive
 * @property integer $ProvinceId
 * @property string $Abbreviation
 *
 * @property Address[] $addresses
 * @property Customer[] $customers
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property PosAddress[] $posAddresses
 * @property PosCustomer[] $posCustomers
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequest[] $posOrderRequests0
 * @property PosSetting[] $posSettings
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property ShippingProviderDistrictMapping[] $shippingProviderDistrictMappings
 * @property SystemStateProvince $province
 * @property SystemDistrictWard[] $systemDistrictWards
 * @property Warehouse[] $warehouses
 */
class SystemDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsDefault', 'DisplayOrder', 'IsActive', 'ProvinceId'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['SystemKeyword'], 'string', 'max' => 150],
            [['Abbreviation'], 'string', 'max' => 100],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
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
            'SystemKeyword' => 'System Keyword',
            'IsDefault' => 'Is Default',
            'DisplayOrder' => 'Display Order',
            'IsActive' => 'Is Active',
            'ProvinceId' => 'Province ID',
            'Abbreviation' => 'Abbreviation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['SystemDistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['DistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['buyerDistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['receiverDistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosAddresses()
    {
        return $this->hasMany(PosAddress::className(), ['DistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomers()
    {
        return $this->hasMany(PosCustomer::className(), ['DistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['SenderDistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests0()
    {
        return $this->hasMany(PosOrderRequest::className(), ['ReceiverDistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSettings()
    {
        return $this->hasMany(PosSetting::className(), ['DistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['delivery_district_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProviderDistrictMappings()
    {
        return $this->hasMany(ShippingProviderDistrictMapping::className(), ['SystemDistrictId' => 'id']);
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
    public function getSystemDistrictWards()
    {
        return $this->hasMany(SystemDistrictWard::className(), ['DistrictId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['DistrictId' => 'id']);
    }
}
