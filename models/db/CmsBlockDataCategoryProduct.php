<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_category_product".
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
 * @property string $linkTo
 * @property string $endTime
 * @property string $portal
 * @property string $usTax
 * @property string $usShipping
 * @property string $sellerId
 * @property string $group
 * @property integer $star
 *
 * @property CmsBlock $block
 * @property CmsBlockDataCategory $category
 */
class CmsBlockDataCategoryProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_category_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'categoryId', 'productPercent', 'active', 'order', 'star'], 'integer'],
            [['productSellPrice', 'productFinalPrice', 'usTax', 'usShipping'], 'number'],
            [['endTime'], 'safe'],
            [['productId'], 'string', 'max' => 20],
            [['productName', 'productImage'], 'string', 'max' => 300],
            [['linkTo'], 'string', 'max' => 255],
            [['portal', 'sellerId'], 'string', 'max' => 50],
            [['group'], 'string', 'max' => 145],
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
            'linkTo' => 'Link To',
            'endTime' => 'End Time',
            'portal' => 'Portal',
            'usTax' => 'Us Tax',
            'usShipping' => 'Us Shipping',
            'sellerId' => 'Seller ID',
            'group' => 'Group',
            'star' => 'Star',
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
