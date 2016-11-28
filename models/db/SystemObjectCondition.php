<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_object_condition".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $TableName
 * @property string $Field
 *
 * @property DiscountCondition[] $discountConditions
 */
class SystemObjectCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_object_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Description', 'TableName', 'Field'], 'string', 'max' => 255],
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
            'TableName' => 'Table Name',
            'Field' => 'Field',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountConditions()
    {
        return $this->hasMany(DiscountCondition::className(), ['SystemConditionId' => 'id']);
    }
}
