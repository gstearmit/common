<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_custom_policy".
 *
 * @property integer $id
 * @property string $CategoryName
 * @property string $CategoryDescription
 * @property integer $IsSpecialCategory
 * @property string $MinPrice
 * @property string $MaxPrice
 * @property string $CustomRateFee
 * @property integer $UsePercentage
 * @property string $CustomFixFeePerUnit
 * @property integer $ItemsMaximumPerCategory
 * @property string $WeightMaximumPerCategory
 * @property integer $Active
 * @property string $ActiveFromTime
 * @property string $ActiveToTime
 * @property integer $CategoryRefId
 * @property integer $SystemUnitMeasureId
 * @property integer $SystemWeightUnitId
 * @property integer $StoreId
 * @property integer $CurrencyId
 * @property integer $TypePolicy
 * @property integer $IsWeightCalculate
 * @property string $PricePerUnitForExtraItem
 * @property integer $ApplyToOnlyExtraItem
 * @property integer $SortOrder
 *
 * @property Category $categoryRef
 * @property SystemUnitOfMessure $systemUnitMeasure
 * @property SystemWeightUnit $systemWeightUnit
 * @property Store $store
 * @property SystemCurrency $currency
 * @property CustomerCategoryCustomPolicy[] $customerCategoryCustomPolicies
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequestItems[] $posOrderRequestItems
 * @property PurchaseOrderItem[] $purchaseOrderItems
 * @property ShipmentBulkAirbillCategoryMapping[] $shipmentBulkAirbillCategoryMappings
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property WarehousePackageItem[] $warehousePackageItems
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class CategoryCustomPolicy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_custom_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsSpecialCategory', 'UsePercentage', 'ItemsMaximumPerCategory', 'Active', 'CategoryRefId', 'SystemUnitMeasureId', 'SystemWeightUnitId', 'StoreId', 'CurrencyId', 'TypePolicy', 'IsWeightCalculate', 'ApplyToOnlyExtraItem', 'SortOrder'], 'integer'],
            [['MinPrice', 'MaxPrice', 'CustomRateFee', 'CustomFixFeePerUnit', 'WeightMaximumPerCategory', 'PricePerUnitForExtraItem'], 'number'],
            [['ActiveFromTime', 'ActiveToTime'], 'safe'],
            [['CategoryName'], 'string', 'max' => 255],
            [['CategoryDescription'], 'string', 'max' => 1000],
            [['CategoryRefId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryRefId' => 'id']],
            [['SystemUnitMeasureId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['SystemUnitMeasureId' => 'id']],
            [['SystemWeightUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightUnitId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'CategoryName' => 'Category Name',
            'CategoryDescription' => 'Category Description',
            'IsSpecialCategory' => 'Is Special Category',
            'MinPrice' => 'Min Price',
            'MaxPrice' => 'Max Price',
            'CustomRateFee' => 'Custom Rate Fee',
            'UsePercentage' => 'Use Percentage',
            'CustomFixFeePerUnit' => 'Custom Fix Fee Per Unit',
            'ItemsMaximumPerCategory' => 'Items Maximum Per Category',
            'WeightMaximumPerCategory' => 'Weight Maximum Per Category',
            'Active' => 'Active',
            'ActiveFromTime' => 'Active From Time',
            'ActiveToTime' => 'Active To Time',
            'CategoryRefId' => 'Category Ref ID',
            'SystemUnitMeasureId' => 'System Unit Measure ID',
            'SystemWeightUnitId' => 'System Weight Unit ID',
            'StoreId' => 'Store ID',
            'CurrencyId' => 'Currency ID',
            'TypePolicy' => 'Type Policy',
            'IsWeightCalculate' => 'Is Weight Calculate',
            'PricePerUnitForExtraItem' => 'Price Per Unit For Extra Item',
            'ApplyToOnlyExtraItem' => 'Apply To Only Extra Item',
            'SortOrder' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRef()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryRefId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUnitMeasure()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'SystemUnitMeasureId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeightUnit()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'SystemWeightUnitId']);
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
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCategoryCustomPolicies()
    {
        return $this->hasMany(CustomerCategoryCustomPolicy::className(), ['CategoryCustomPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['ItemCategoryCustomerPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItems()
    {
        return $this->hasMany(PosOrderRequestItems::className(), ['CategoryCustomerPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::className(), ['CategoryCustomPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbillCategoryMappings()
    {
        return $this->hasMany(ShipmentBulkAirbillCategoryMapping::className(), ['CategoryCustomPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['category_custom_policy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['CategoryCustomPolicyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['category_custom_policy_id' => 'id']);
    }
}
