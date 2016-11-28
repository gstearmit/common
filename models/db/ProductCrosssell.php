<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_crosssell".
 *
 * @property integer $id
 * @property integer $ProductId1
 * @property integer $ProductId2
 * @property string $CreatedTime
 *
 * @property Product $productId1
 * @property Product $productId2
 */
class ProductCrosssell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_crosssell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductId1', 'ProductId2'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['ProductId1'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId1' => 'id']],
            [['ProductId2'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ProductId1' => 'Product Id1',
            'ProductId2' => 'Product Id2',
            'CreatedTime' => 'Created Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductId1()
    {
        return $this->hasOne(Product::className(), ['id' => 'ProductId1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductId2()
    {
        return $this->hasOne(Product::className(), ['id' => 'ProductId2']);
    }
}
