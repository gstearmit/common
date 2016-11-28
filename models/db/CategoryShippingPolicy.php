<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_shipping_policy".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $shipping_fee_per_unit
 * @property integer $quatity_per_unit
 * @property integer $system_weight_id
 * @property integer $require_minimum_weight
 */
class CategoryShippingPolicy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_shipping_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'quatity_per_unit', 'system_weight_id', 'require_minimum_weight'], 'integer'],
            [['shipping_fee_per_unit'], 'number'],
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
            'shipping_fee_per_unit' => 'Shipping Fee Per Unit',
            'quatity_per_unit' => 'Quatity Per Unit',
            'system_weight_id' => 'System Weight ID',
            'require_minimum_weight' => 'Require Minimum Weight',
        ];
    }
}
