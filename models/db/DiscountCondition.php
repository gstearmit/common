<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_condition".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property integer $SystemConditionId
 * @property string $OperatorCondition
 * @property string $ParameterCondition
 *
 * @property Discount $discount
 * @property SystemObjectCondition $systemCondition
 */
class DiscountCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId', 'SystemConditionId'], 'integer'],
            [['OperatorCondition', 'ParameterCondition'], 'string', 'max' => 255],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['SystemConditionId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemObjectCondition::className(), 'targetAttribute' => ['SystemConditionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'DiscountId' => 'Discount ID',
            'SystemConditionId' => 'System Condition ID',
            'OperatorCondition' => 'Operator Condition',
            'ParameterCondition' => 'Parameter Condition',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCondition()
    {
        return $this->hasOne(SystemObjectCondition::className(), ['id' => 'SystemConditionId']);
    }
}
