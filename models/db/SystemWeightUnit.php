<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_weight_unit".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property string $Ratio
 * @property integer $DisplayOrder
 * @property integer $IsMainUnit
 *
 * @property CategoryCustomPolicy[] $categoryCustomPolicies
 * @property CategoryPricePolicyWeightSetting[] $categoryPricePolicyWeightSettings
 * @property CategoryServicePolicy[] $categoryServicePolicies
 * @property CustomerCategoryCustomPolicy[] $customerCategoryCustomPolicies
 * @property InvoiceProforma[] $invoiceProformas
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property PosOrderRequest[] $posOrderRequests
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShipmentBulkBox[] $shipmentBulkBoxes
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property Store[] $stores
 * @property WarehouseLocationBox[] $warehouseLocationBoxes
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class SystemWeightUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_weight_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ratio'], 'number'],
            [['DisplayOrder', 'IsMainUnit'], 'integer'],
            [['Name', 'SystemKeyword'], 'string', 'max' => 100],
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
            'Ratio' => 'Ratio',
            'DisplayOrder' => 'Display Order',
            'IsMainUnit' => 'Is Main Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicies()
    {
        return $this->hasMany(CategoryCustomPolicy::className(), ['SystemWeightUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicyWeightSettings()
    {
        return $this->hasMany(CategoryPricePolicyWeightSetting::className(), ['SystemWeightUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryServicePolicies()
    {
        return $this->hasMany(CategoryServicePolicy::className(), ['system_weight_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCategoryCustomPolicies()
    {
        return $this->hasMany(CustomerCategoryCustomPolicy::className(), ['SystemWeightId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProformas()
    {
        return $this->hasMany(InvoiceProforma::className(), ['WeightUnit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['UOM' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['SystemWeightUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['UomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBoxes()
    {
        return $this->hasMany(ShipmentBulkBox::className(), ['SystemWeightUnitId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['system_weight_unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['SystemWeightId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocationBoxes()
    {
        return $this->hasMany(WarehouseLocationBox::className(), ['WeightUomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['systemWeightId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['system_weight_unit_id' => 'id']);
    }
}
