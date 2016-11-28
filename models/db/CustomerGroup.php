<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_group".
 *
 * @property integer $id
 * @property string $SystemKeyword
 * @property string $Name
 * @property string $Description
 * @property string $CreatedTime
 * @property string $UpdatedTime
 * @property integer $DisplayOrder
 * @property integer $active
 * @property integer $Deleted
 *
 * @property CategoryPricePolicyWeightSetting[] $categoryPricePolicyWeightSettings
 * @property Customer[] $customers
 * @property PosCustomer[] $posCustomers
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class CustomerGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime', 'UpdatedTime'], 'safe'],
            [['DisplayOrder', 'active', 'Deleted'], 'integer'],
            [['SystemKeyword'], 'string', 'max' => 150],
            [['Name', 'Description'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SystemKeyword' => 'System Keyword',
            'Name' => 'Name',
            'Description' => 'Description',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
            'DisplayOrder' => 'Display Order',
            'active' => 'Active',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicyWeightSettings()
    {
        return $this->hasMany(CategoryPricePolicyWeightSetting::className(), ['ApplyCustomerGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['customerGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomers()
    {
        return $this->hasMany(PosCustomer::className(), ['CustomerGroupId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['customer_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['customer_group_id' => 'id']);
    }
}
