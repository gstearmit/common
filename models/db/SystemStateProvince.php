<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_state_province".
 *
 * @property integer $id
 * @property integer $CountryId
 * @property string $Name
 * @property string $Abbreviation
 * @property integer $Published
 * @property integer $DisplayOrder
 * @property integer $ShowMenu
 * @property integer $DefaultWarehouseId
 *
 * @property Address[] $addresses
 * @property Customer[] $customers
 * @property DiscountProvince[] $discountProvinces
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property PosAddress[] $posAddresses
 * @property PosCustomer[] $posCustomers
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequest[] $posOrderRequests0
 * @property PosSetting[] $posSettings
 * @property ShipmentBulkCustomGate[] $shipmentBulkCustomGates
 * @property SystemDistrict[] $systemDistricts
 * @property SystemCountry $country
 * @property Warehouse $defaultWarehouse
 * @property Warehouse[] $warehouses
 */
class SystemStateProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_state_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CountryId', 'Published', 'DisplayOrder', 'ShowMenu', 'DefaultWarehouseId'], 'integer'],
            [['Name', 'Abbreviation'], 'string', 'max' => 100],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['CountryId' => 'id']],
            [['DefaultWarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['DefaultWarehouseId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CountryId' => 'Country ID',
            'Name' => 'Name',
            'Abbreviation' => 'Abbreviation',
            'Published' => 'Published',
            'DisplayOrder' => 'Display Order',
            'ShowMenu' => 'Show Menu',
            'DefaultWarehouseId' => 'Default Warehouse ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['SystemStateProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['ProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountProvinces()
    {
        return $this->hasMany(DiscountProvince::className(), ['SystemSateProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['buyerProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['receiverCityId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosAddresses()
    {
        return $this->hasMany(PosAddress::className(), ['ProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomers()
    {
        return $this->hasMany(PosCustomer::className(), ['ProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['SenderProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests0()
    {
        return $this->hasMany(PosOrderRequest::className(), ['ReceiverProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSettings()
    {
        return $this->hasMany(PosSetting::className(), ['ProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustomGates()
    {
        return $this->hasMany(ShipmentBulkCustomGate::className(), ['ProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemDistricts()
    {
        return $this->hasMany(SystemDistrict::className(), ['ProvinceId' => 'id']);
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
    public function getDefaultWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'DefaultWarehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['ProvinceId' => 'id']);
    }
}
