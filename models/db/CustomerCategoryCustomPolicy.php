<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_category_custom_policy".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $CategoryCustomPolicyId
 * @property integer $MaxItem
 * @property integer $UomId
 * @property string $MaxWeight
 * @property integer $IsActive
 * @property integer $SystemWeightId
 * @property string $ContractName
 * @property string $Note
 * @property string $PricePerUnitForExtraItem
 * @property integer $ApplyToOnlyExtraItem
 *
 * @property Customer $customer
 * @property CategoryCustomPolicy $categoryCustomPolicy
 * @property SystemWeightUnit $systemWeight
 */
class CustomerCategoryCustomPolicy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_category_custom_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'CategoryCustomPolicyId', 'MaxItem', 'UomId', 'IsActive', 'SystemWeightId', 'ApplyToOnlyExtraItem'], 'integer'],
            [['MaxWeight', 'PricePerUnitForExtraItem'], 'number'],
            [['ContractName'], 'string', 'max' => 100],
            [['Note'], 'string', 'max' => 400],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['CategoryCustomPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['CategoryCustomPolicyId' => 'id']],
            [['SystemWeightId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CustomerId' => 'Customer ID',
            'CategoryCustomPolicyId' => 'Category Custom Policy ID',
            'MaxItem' => 'Max Item',
            'UomId' => 'Uom ID',
            'MaxWeight' => 'Max Weight',
            'IsActive' => 'Is Active',
            'SystemWeightId' => 'System Weight ID',
            'ContractName' => 'Contract Name',
            'Note' => 'Note',
            'PricePerUnitForExtraItem' => 'Price Per Unit For Extra Item',
            'ApplyToOnlyExtraItem' => 'Apply To Only Extra Item',
        ];
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
    public function getCategoryCustomPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'CategoryCustomPolicyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeight()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'SystemWeightId']);
    }
}
