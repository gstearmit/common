<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "ebay_item".
 *
 * @property integer $id
 * @property integer $itemId
 * @property string $seller
 * @property string $category
 * @property string $title
 * @property boolean $isAution
 * @property string $url
 * @property string $primaryCategory
 * @property string $secondaryCategory
 * @property string $listingType
 * @property string $listingStatus
 * @property string $condition
 * @property string $startPrice
 * @property string $sellPrice
 * @property boolean $buyNowAdvailable
 * @property string $buyNowPrice
 * @property integer $bidCount
 * @property integer $quantity
 * @property integer $quantitySold
 * @property string $images
 * @property string $saleSpecific
 * @property string $specifics
 * @property string $subItems
 * @property string $location
 * @property integer $startTime
 * @property integer $endTime
 * @property double $usTax
 * @property double $usShipping
 * @property integer $updateTime
 * @property string $specific_Model
 * @property string $specific_Type
 * @property string $specific_Size
 * @property string $specific_Material
 * @property string $specific_Style
 * @property string $specific_Features
 * @property string $specific_SizeType
 * @property string $specific_CompatibleBrand
 * @property string $specific_Brand
 * @property string $specific_Color
 * @property string $specific_CompatibleModel
 * @property string $specific_Format
 * @property string $specific_SkinType
 * @property string $specific_Formulation
 * @property string $specific_Effect
 * @property string $specific_Gender
 * @property string $specific_Concerns
 * @property string $specific_Metal
 * @property string $specific_MainStone
 * @property string $specific_AgeLevel
 * @property string $specific_Year
 * @property string $specific_ShopFor
 * @property string $specific_Theme
 * @property string $specific_ProductLine
 * @property string $specific_RingSize
 * @property string $description
 */
class EbayItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ebay_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'bidCount', 'quantity', 'quantitySold', 'startTime', 'endTime', 'updateTime'], 'integer'],
            [['seller', 'primaryCategory', 'secondaryCategory', 'images', 'saleSpecific', 'specifics', 'subItems', 'description'], 'string'],
            [['isAution', 'buyNowAdvailable'], 'boolean'],
            [['startPrice', 'sellPrice', 'buyNowPrice', 'usTax', 'usShipping'], 'number'],
            [['category', 'title', 'url', 'location'], 'string', 'max' => 255],
            [['listingType', 'condition'], 'string', 'max' => 50],
            [['listingStatus'], 'string', 'max' => 20],
            [['specific_Model', 'specific_Type', 'specific_Size', 'specific_Material', 'specific_Style', 'specific_Features', 'specific_SizeType', 'specific_CompatibleBrand', 'specific_Brand', 'specific_Color', 'specific_CompatibleModel', 'specific_Format', 'specific_SkinType', 'specific_Formulation', 'specific_Effect', 'specific_Gender', 'specific_Concerns', 'specific_Metal', 'specific_MainStone', 'specific_AgeLevel', 'specific_Year', 'specific_ShopFor', 'specific_Theme', 'specific_ProductLine', 'specific_RingSize'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'seller' => 'Seller',
            'category' => 'Category',
            'title' => 'Title',
            'isAution' => 'Is Aution',
            'url' => 'Url',
            'primaryCategory' => 'Primary Category',
            'secondaryCategory' => 'Secondary Category',
            'listingType' => 'Listing Type',
            'listingStatus' => 'Listing Status',
            'condition' => 'Condition',
            'startPrice' => 'Start Price',
            'sellPrice' => 'Sell Price',
            'buyNowAdvailable' => 'Buy Now Advailable',
            'buyNowPrice' => 'Buy Now Price',
            'bidCount' => 'Bid Count',
            'quantity' => 'Quantity',
            'quantitySold' => 'Quantity Sold',
            'images' => 'Images',
            'saleSpecific' => 'Sale Specific',
            'specifics' => 'Specifics',
            'subItems' => 'Sub Items',
            'location' => 'Location',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'usTax' => 'Us Tax',
            'usShipping' => 'Us Shipping',
            'updateTime' => 'Update Time',
            'specific_Model' => 'Specific  Model',
            'specific_Type' => 'Specific  Type',
            'specific_Size' => 'Specific  Size',
            'specific_Material' => 'Specific  Material',
            'specific_Style' => 'Specific  Style',
            'specific_Features' => 'Specific  Features',
            'specific_SizeType' => 'Specific  Size Type',
            'specific_CompatibleBrand' => 'Specific  Compatible Brand',
            'specific_Brand' => 'Specific  Brand',
            'specific_Color' => 'Specific  Color',
            'specific_CompatibleModel' => 'Specific  Compatible Model',
            'specific_Format' => 'Specific  Format',
            'specific_SkinType' => 'Specific  Skin Type',
            'specific_Formulation' => 'Specific  Formulation',
            'specific_Effect' => 'Specific  Effect',
            'specific_Gender' => 'Specific  Gender',
            'specific_Concerns' => 'Specific  Concerns',
            'specific_Metal' => 'Specific  Metal',
            'specific_MainStone' => 'Specific  Main Stone',
            'specific_AgeLevel' => 'Specific  Age Level',
            'specific_Year' => 'Specific  Year',
            'specific_ShopFor' => 'Specific  Shop For',
            'specific_Theme' => 'Specific  Theme',
            'specific_ProductLine' => 'Specific  Product Line',
            'specific_RingSize' => 'Specific  Ring Size',
            'description' => 'Description',
        ];
    }
}
