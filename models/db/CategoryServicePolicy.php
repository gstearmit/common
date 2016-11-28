<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_service_policy".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $service_fee_per_unit
 * @property integer $quantity_per_unit
 * @property integer $system_weight_id
 * @property integer $require_minimum_weight
 * @property integer $type_of_service_id
 * @property integer $system_unit_messure_id
 *
 * @property Category $category
 * @property SystemWeightUnit $systemWeight
 * @property SystemUnitOfMessure $systemUnitMessure
 * @property CategoryServiceProvide $typeOfService
 */
class CategoryServicePolicy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_service_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'quantity_per_unit', 'system_weight_id', 'require_minimum_weight', 'type_of_service_id', 'system_unit_messure_id'], 'integer'],
            [['service_fee_per_unit'], 'number'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
            [['system_weight_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['system_weight_id' => 'id']],
            [['system_unit_messure_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['system_unit_messure_id' => 'id']],
            [['type_of_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryServiceProvide::className(), 'targetAttribute' => ['type_of_service_id' => 'id']],
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
            'service_fee_per_unit' => 'Service Fee Per Unit',
            'quantity_per_unit' => 'Quantity Per Unit',
            'system_weight_id' => 'System Weight ID',
            'require_minimum_weight' => 'Require Minimum Weight',
            'type_of_service_id' => 'Type Of Service ID',
            'system_unit_messure_id' => 'System Unit Messure ID',
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
    public function getSystemWeight()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'system_weight_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUnitMessure()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'system_unit_messure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeOfService()
    {
        return $this->hasOne(CategoryServiceProvide::className(), ['id' => 'type_of_service_id']);
    }
}
