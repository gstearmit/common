<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_province".
 *
 * @property integer $id
 * @property integer $SystemSateProvinceId
 * @property integer $DiscountId
 *
 * @property Discount $discount
 * @property SystemStateProvince $systemSateProvince
 */
class DiscountProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SystemSateProvinceId', 'DiscountId'], 'integer'],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['SystemSateProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['SystemSateProvinceId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SystemSateProvinceId' => 'System Sate Province ID',
            'DiscountId' => 'Discount ID',
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
    public function getSystemSateProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'SystemSateProvinceId']);
    }
}
