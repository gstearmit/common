<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_provider".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $DisplayOrder
 * @property integer $StoreId
 * @property string $TrackingUrl
 * @property string $ApiUrl
 * @property string $ApiSetting
 * @property string $LogoUrl
 * @property integer $type
 * @property integer $isDefault
 *
 * @property InvoiceMapShippingProviderOther[] $invoiceMapShippingProviderOthers
 * @property PurchaseOrder[] $purchaseOrders
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShipmentBulkTrackingcode[] $shipmentBulkTrackingcodes
 * @property ShippingMethod[] $shippingMethods
 * @property ShippingPackageLocal[] $shippingPackageLocals
 * @property ShippingPackageLocalList[] $shippingPackageLocalLists
 * @property Store $store
 * @property ShippingProviderProvince[] $shippingProviderProvinces
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageReturn[] $warehousePackageReturns
 */
class ShippingProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Description'], 'string'],
            [['DisplayOrder', 'StoreId', 'type', 'isDefault'], 'integer'],
            [['Name'], 'string', 'max' => 400],
            [['TrackingUrl', 'ApiUrl', 'ApiSetting'], 'string', 'max' => 500],
            [['LogoUrl'], 'string', 'max' => 255],
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
            'Name' => 'Name',
            'Description' => 'Description',
            'DisplayOrder' => 'Display Order',
            'StoreId' => 'Store ID',
            'TrackingUrl' => 'Tracking Url',
            'ApiUrl' => 'Api Url',
            'ApiSetting' => 'Api Setting',
            'LogoUrl' => 'Logo Url',
            'type' => 'Type',
            'isDefault' => 'Is Default',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShippingProviderOthers()
    {
        return $this->hasMany(InvoiceMapShippingProviderOther::className(), ['shipping_provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['ShippingProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['carrierProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingcodes()
    {
        return $this->hasMany(ShipmentBulkTrackingcode::className(), ['ShippingProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingMethods()
    {
        return $this->hasMany(ShippingMethod::className(), ['ShippingProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['shippingProvider' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocalLists()
    {
        return $this->hasMany(ShippingPackageLocalList::className(), ['carrierProviderId' => 'id']);
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
    public function getShippingProviderProvinces()
    {
        return $this->hasMany(ShippingProviderProvince::className(), ['ShippingProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['shippingProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageReturns()
    {
        return $this->hasMany(WarehousePackageReturn::className(), ['shippingProviderId' => 'id']);
    }
}
