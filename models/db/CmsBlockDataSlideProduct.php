<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_slide_product".
 *
 * @property integer $id
 * @property integer $blockId
 * @property string $productId
 * @property string $productName
 * @property string $productSellPrice
 * @property string $productFinalPrice
 * @property string $productImage
 * @property integer $productPercent
 * @property integer $active
 * @property integer $order
 *
 * @property CmsBlock $block
 */
class CmsBlockDataSlideProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_slide_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'productId', 'productName', 'productSellPrice', 'productFinalPrice', 'productImage', 'productPercent'], 'required'],
            [['blockId', 'productPercent', 'active', 'order'], 'integer'],
            [['productSellPrice', 'productFinalPrice'], 'number'],
            [['productId'], 'string', 'max' => 20],
            [['productName', 'productImage'], 'string', 'max' => 300],
            [['blockId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlock::className(), 'targetAttribute' => ['blockId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blockId' => 'Block ID',
            'productId' => 'Product ID',
            'productName' => 'Product Name',
            'productSellPrice' => 'Product Sell Price',
            'productFinalPrice' => 'Product Final Price',
            'productImage' => 'Product Image',
            'productPercent' => 'Product Percent',
            'active' => 'Active',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(CmsBlock::className(), ['id' => 'blockId']);
    }
}
