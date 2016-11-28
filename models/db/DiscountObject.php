<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_object".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property integer $ObjectTypeId
 * @property integer $ObjectValue
 * @property string $RefField
 * @property string $Description
 * @property string $CreatedTime
 *
 * @property Discount $discount
 * @property SystemObjectType $objectType
 */
class DiscountObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId', 'ObjectTypeId', 'ObjectValue'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['RefField', 'Description'], 'string', 'max' => 255],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['ObjectTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemObjectType::className(), 'targetAttribute' => ['ObjectTypeId' => 'id']],
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
            'ObjectTypeId' => 'Object Type ID',
            'ObjectValue' => 'Object Value',
            'RefField' => 'Ref Field',
            'Description' => 'Description',
            'CreatedTime' => 'Created Time',
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
    public function getObjectType()
    {
        return $this->hasOne(SystemObjectType::className(), ['id' => 'ObjectTypeId']);
    }
}
