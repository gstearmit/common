<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_service_provide".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 *
 * @property CategoryServicePolicy[] $categoryServicePolicies
 * @property OrderItemFeeService[] $orderItemFeeServices
 */
class CategoryServiceProvide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_service_provide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryServicePolicies()
    {
        return $this->hasMany(CategoryServicePolicy::className(), ['type_of_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemFeeServices()
    {
        return $this->hasMany(OrderItemFeeService::className(), ['type_of_service_id' => 'id']);
    }
}
