<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_query".
 *
 * @property integer $id
 * @property integer $Type
 * @property integer $DiscountId
 * @property string $Tablename
 * @property string $Field
 * @property string $RefField
 * @property string $Query
 * @property string $Operator
 * @property string $ParameterCondition
 * @property integer $DiscountConditionId
 * @property integer $DiscountObjectId
 */
class DiscountQuery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_query';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Type', 'DiscountId', 'DiscountConditionId', 'DiscountObjectId'], 'integer'],
            [['Query', 'ParameterCondition'], 'string'],
            [['Tablename', 'Field', 'RefField', 'Operator'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Type' => 'Type',
            'DiscountId' => 'Discount ID',
            'Tablename' => 'Tablename',
            'Field' => 'Field',
            'RefField' => 'Ref Field',
            'Query' => 'Query',
            'Operator' => 'Operator',
            'ParameterCondition' => 'Parameter Condition',
            'DiscountConditionId' => 'Discount Condition ID',
            'DiscountObjectId' => 'Discount Object ID',
        ];
    }
}
