<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_country".
 *
 * @property integer $id
 * @property string $Name
 * @property integer $AllowsBilling
 * @property integer $AllowsShipping
 * @property string $TwoLetterIsoCode
 * @property string $ThreeLetterIsoCode
 * @property integer $NumericIsoCode
 * @property integer $SubjectToVat
 * @property integer $Published
 * @property integer $DisplayOrder
 * @property integer $SystemAreaId
 *
 * @property Address[] $addresses
 * @property Customer[] $customers
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property PosAddress[] $posAddresses
 * @property PosCustomer[] $posCustomers
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequest[] $posOrderRequests0
 * @property ShipmentBulkCustomGate[] $shipmentBulkCustomGates
 * @property Store[] $stores
 * @property SystemArea $systemArea
 * @property SystemStateProvince[] $systemStateProvinces
 * @property Warehouse[] $warehouses
 * @property WarehouseGroup[] $warehouseGroups
 */
class SystemCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AllowsBilling', 'AllowsShipping', 'NumericIsoCode', 'SubjectToVat', 'Published', 'DisplayOrder', 'SystemAreaId'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['TwoLetterIsoCode'], 'string', 'max' => 2],
            [['ThreeLetterIsoCode'], 'string', 'max' => 3],
            [['SystemAreaId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemArea::className(), 'targetAttribute' => ['SystemAreaId' => 'id']],
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
            'AllowsBilling' => 'Allows Billing',
            'AllowsShipping' => 'Allows Shipping',
            'TwoLetterIsoCode' => 'Two Letter Iso Code',
            'ThreeLetterIsoCode' => 'Three Letter Iso Code',
            'NumericIsoCode' => 'Numeric Iso Code',
            'SubjectToVat' => 'Subject To Vat',
            'Published' => 'Published',
            'DisplayOrder' => 'Display Order',
            'SystemAreaId' => 'System Area ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['SystemCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['countryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['buyerCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['receiverCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosAddresses()
    {
        return $this->hasMany(PosAddress::className(), ['CountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomers()
    {
        return $this->hasMany(PosCustomer::className(), ['CountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['SenderCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests0()
    {
        return $this->hasMany(PosOrderRequest::className(), ['ReceiverCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustomGates()
    {
        return $this->hasMany(ShipmentBulkCustomGate::className(), ['CountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['SystemCountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemArea()
    {
        return $this->hasOne(SystemArea::className(), ['id' => 'SystemAreaId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemStateProvinces()
    {
        return $this->hasMany(SystemStateProvince::className(), ['CountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['CountryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseGroups()
    {
        return $this->hasMany(WarehouseGroup::className(), ['system_country_id' => 'id']);
    }
}
