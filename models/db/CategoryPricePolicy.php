<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_price_policy".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $status_new
 * @property string $status_used
 * @property string $status_refactuner
 * @property string $min_price
 * @property string $max_price
 * @property integer $category_price_policy_setting_id
 *
 * @property Category $category
 * @property CategoryPricePolicyWeightSetting $categoryPricePolicySetting
 */
class CategoryPricePolicy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_price_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'category_price_policy_setting_id'], 'integer'],
            [['status_new', 'status_used', 'status_refactuner', 'min_price', 'max_price'], 'number'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
            [['category_price_policy_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryPricePolicyWeightSetting::className(), 'targetAttribute' => ['category_price_policy_setting_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
            'status_new' => 'Status New',
            'status_used' => 'Status Used',
            'status_refactuner' => 'Status Refactuner',
            'min_price' => 'Min Price',
            'max_price' => 'Max Price',
            'category_price_policy_setting_id' => 'Category Price Policy Setting ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicySetting()
    {
        return $this->hasOne(CategoryPricePolicyWeightSetting::className(), ['id' => 'category_price_policy_setting_id']);
    }
}
