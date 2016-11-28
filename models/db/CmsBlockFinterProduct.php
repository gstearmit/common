<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_finter_product".
 *
 * @property integer $id
 * @property string $title
 * @property integer $startPrice
 * @property integer $sellPrice
 * @property string $image
 * @property string $location
 * @property string $expireDate
 * @property string $itemId
 * @property integer $sellerScore
 * @property double $sellerPercent
 * @property string $sellerId
 * @property integer $typeProduct
 * @property integer $quantity
 * @property string $status
 * @property string $propertyProduct
 * @property integer $bidCount
 */
class CmsBlockFinterProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_finter_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startPrice', 'sellPrice', 'sellerScore', 'typeProduct', 'quantity', 'bidCount'], 'integer'],
            [['expireDate'], 'safe'],
            [['sellerPercent'], 'number'],
            [['title', 'propertyProduct'], 'string', 'max' => 300],
            [['image'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 200],
            [['itemId'], 'string', 'max' => 15],
            [['sellerId'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'startPrice' => 'Start Price',
            'sellPrice' => 'Sell Price',
            'image' => 'Image',
            'location' => 'Location',
            'expireDate' => 'Expire Date',
            'itemId' => 'Item ID',
            'sellerScore' => 'Seller Score',
            'sellerPercent' => 'Seller Percent',
            'sellerId' => 'Seller ID',
            'typeProduct' => 'Type Product',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'propertyProduct' => 'Property Product',
            'bidCount' => 'Bid Count',
        ];
    }
}
