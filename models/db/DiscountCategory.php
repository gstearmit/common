<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_category".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property integer $CategoryId
 * @property string $CreatedTime
 *
 * @property Discount $discount
 * @property Category $category
 */
class DiscountCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId', 'CategoryId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
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
            'CategoryId' => 'Category ID',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }
}
