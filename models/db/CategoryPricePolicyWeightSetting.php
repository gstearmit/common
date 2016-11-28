<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_price_policy_weight_setting".
 *
 * @property integer $id
 * @property string $CategoryName
 * @property string $CategoryDescription
 * @property integer $IsSpecialCategory
 * @property string $UnitPricePerWeightUnit
 * @property integer $SystemWeightUnitId
 * @property string $MinWeigth
 * @property string $MaxWeight
 * @property integer $ItemsMaximumPerCategory
 * @property string $WeightMaximumPerCategory
 * @property integer $Active
 * @property string $ActiveFromTime
 * @property string $ActiveToTime
 * @property integer $StoreId
 * @property integer $CurrencyId
 * @property integer $ApplyCustomerGroupId
 *
 * @property CategoryPricePolicy[] $categoryPricePolicies
 * @property SystemWeightUnit $systemWeightUnit
 * @property Store $store
 * @property SystemCurrency $currency
 * @property CustomerGroup $applyCustomerGroup
 */
class CategoryPricePolicyWeightSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_price_policy_weight_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsSpecialCategory', 'SystemWeightUnitId', 'ItemsMaximumPerCategory', 'Active', 'StoreId', 'CurrencyId', 'ApplyCustomerGroupId'], 'integer'],
            [['UnitPricePerWeightUnit', 'MinWeigth', 'MaxWeight', 'WeightMaximumPerCategory'], 'number'],
            [['ActiveFromTime', 'ActiveToTime'], 'safe'],
            [['CategoryName'], 'string', 'max' => 255],
            [['CategoryDescription'], 'string', 'max' => 1000],
            [['SystemWeightUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightUnitId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['ApplyCustomerGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['ApplyCustomerGroupId' => 'id']],
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
            'UnitPricePerWeightUnit' => 'Unit Price Per Weight Unit',
            'SystemWeightUnitId' => 'System Weight Unit ID',
            'MinWeigth' => 'Min Weigth',
            'MaxWeight' => 'Max Weight',
            'ItemsMaximumPerCategory' => 'Items Maximum Per Category',
            'WeightMaximumPerCategory' => 'Weight Maximum Per Category',
            'Active' => 'Active',
            'ActiveFromTime' => 'Active From Time',
            'ActiveToTime' => 'Active To Time',
            'StoreId' => 'Store ID',
            'CurrencyId' => 'Currency ID',
            'ApplyCustomerGroupId' => 'Apply Customer Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicies()
    {
        return $this->hasMany(CategoryPricePolicy::className(), ['category_price_policy_setting_id' => 'id']);
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
    public function getApplyCustomerGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['id' => 'ApplyCustomerGroupId']);
    }
}
