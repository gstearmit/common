<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $DistrictId
 * @property integer $ProvinceId
 * @property string $Address
 * @property integer $StoreId
 * @property integer $TypeId
 * @property integer $WarehouseGroupId
 * @property integer $CountryId
 * @property string $PostCode
 * @property string $Telephone
 * @property string $Email
 * @property string $ContactPerson
 * @property integer $Default
 * @property integer $CurrencyId
 *
 * @property CustomerWarehousePrefer[] $customerWarehousePrefers
 * @property OrderItem[] $orderItems
 * @property PosSetting[] $posSettings
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder[] $purchaseOrders0
 * @property RequestPackages[] $requestPackages
 * @property RequestShipment[] $requestShipments
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShipmentBulk[] $shipmentBulks0
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices0
 * @property SystemStateProvince[] $systemStateProvinces
 * @property Store $store
 * @property SystemStateProvince $province
 * @property SystemDistrict $district
 * @property WarehouseGroup $warehouseGroup
 * @property SystemCountry $country
 * @property SystemCurrency $currency
 * @property WarehouseLocation[] $warehouseLocations
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DistrictId', 'ProvinceId', 'StoreId', 'TypeId', 'WarehouseGroupId', 'CountryId', 'Default', 'CurrencyId'], 'integer'],
            [['Name', 'Description', 'Address', 'Telephone', 'Email', 'ContactPerson'], 'string', 'max' => 255],
            [['PostCode'], 'string', 'max' => 20],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
            [['WarehouseGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehouseGroup::className(), 'targetAttribute' => ['WarehouseGroupId' => 'id']],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['CountryId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
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
            'Description' => 'Description',
            'DistrictId' => 'District ID',
            'ProvinceId' => 'Province ID',
            'Address' => 'Address',
            'StoreId' => 'Store ID',
            'TypeId' => 'Type ID',
            'WarehouseGroupId' => 'Warehouse Group ID',
            'CountryId' => 'Country ID',
            'PostCode' => 'Post Code',
            'Telephone' => 'Telephone',
            'Email' => 'Email',
            'ContactPerson' => 'Contact Person',
            'Default' => 'Default',
            'CurrencyId' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerWarehousePrefers()
    {
        return $this->hasMany(CustomerWarehousePrefer::className(), ['WarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['WarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSettings()
    {
        return $this->hasMany(PosSetting::className(), ['WarehouseReceiveId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['WarehouseLocalId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders0()
    {
        return $this->hasMany(PurchaseOrder::className(), ['WarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasMany(RequestPackages::className(), ['warehouse_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['WarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['fromWarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks0()
    {
        return $this->hasMany(ShipmentBulk::className(), ['toWarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['from_warehouse_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices0()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['to_warehouse_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemStateProvinces()
    {
        return $this->hasMany(SystemStateProvince::className(), ['DefaultWarehouseId' => 'id']);
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
    public function getWarehouseGroup()
    {
        return $this->hasOne(WarehouseGroup::className(), ['id' => 'WarehouseGroupId']);
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
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocations()
    {
        return $this->hasMany(WarehouseLocation::className(), ['WarehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['warehouseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['warehouse_id' => 'id']);
    }
}
