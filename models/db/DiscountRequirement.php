<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_requirement".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property string $DiscountRequirementRuleSystemName
 *
 * @property Discount $discount
 */
class DiscountRequirement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_requirement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId'], 'integer'],
            [['DiscountRequirementRuleSystemName'], 'string'],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
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
            'DiscountRequirementRuleSystemName' => 'Discount Requirement Rule System Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }
}
