<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_category_product_auction".
 *
 * @property integer $id
 * @property integer $blockId
 * @property integer $categoryId
 * @property string $productId
 * @property string $productName
 * @property string $productSellPrice
 * @property string $productFinalPrice
 * @property string $productImage
 * @property integer $productPercent
 * @property integer $active
 * @property integer $order
 * @property integer $endTime
 * @property integer $bidCount
 * @property string $endTimeDate
 *
 * @property CmsBlock $block
 * @property CmsBlockDataCategory $category
 */
class CmsBlockDataCategoryProductAuction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_category_product_auction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'categoryId', 'productId', 'productName', 'productSellPrice', 'productFinalPrice', 'productImage', 'active', 'order'], 'required'],
            [['blockId', 'categoryId', 'productPercent', 'active', 'order', 'endTime', 'bidCount'], 'integer'],
            [['productSellPrice', 'productFinalPrice'], 'number'],
            [['endTimeDate'], 'safe'],
            [['productId'], 'string', 'max' => 20],
            [['productName', 'productImage'], 'string', 'max' => 300],
            [['blockId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlock::className(), 'targetAttribute' => ['blockId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlockDataCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
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
            'categoryId' => 'Category ID',
            'productId' => 'Product ID',
            'productName' => 'Product Name',
            'productSellPrice' => 'Product Sell Price',
            'productFinalPrice' => 'Product Final Price',
            'productImage' => 'Product Image',
            'productPercent' => 'Product Percent',
            'active' => 'Active',
            'order' => 'Order',
            'endTime' => 'End Time',
            'bidCount' => 'Bid Count',
            'endTimeDate' => 'End Time Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(CmsBlock::className(), ['id' => 'blockId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CmsBlockDataCategory::className(), ['id' => 'categoryId']);
    }
}
