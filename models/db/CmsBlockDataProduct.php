<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_product".
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
 * @property string $productDescription
 * @property integer $inStock
 * @property string $portal
 * @property string $linkTo
 * @property string $usTax
 * @property string $usShipping
 * @property string $sellerId
 * @property string $group
 * @property string $endTime
 * @property integer $star
 *
 * @property CmsBlock $block
 */
class CmsBlockDataProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'productId', 'productName', 'productSellPrice', 'productFinalPrice', 'productImage', 'active', 'order'], 'required'],
            [['blockId', 'productPercent', 'active', 'order', 'inStock', 'star'], 'integer'],
            [['productName'], 'string'],
            [['productSellPrice', 'productFinalPrice', 'usTax', 'usShipping'], 'number'],
            [['endTime'], 'safe'],
            [['productId'], 'string', 'max' => 20],
            [['productImage'], 'string', 'max' => 500],
            [['productDescription'], 'string', 'max' => 300],
            [['portal', 'sellerId'], 'string', 'max' => 50],
            [['linkTo'], 'string', 'max' => 255],
            [['group'], 'string', 'max' => 145],
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
            'productDescription' => 'Product Description',
            'inStock' => 'In Stock',
            'portal' => 'Portal',
            'linkTo' => 'Link To',
            'usTax' => 'Us Tax',
            'usShipping' => 'Us Shipping',
            'sellerId' => 'Seller ID',
            'group' => 'Group',
            'endTime' => 'End Time',
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
}
