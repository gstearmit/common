<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_category".
 *
 * @property integer $id
 * @property integer $blockId
 * @property string $categoryName
 * @property integer $exitsChild
 * @property string $childContent
 * @property integer $active
 * @property integer $order
 * @property string $linkTo
 * @property string $alias
 * @property string $image
 * @property integer $group
 * @property string $description
 * @property integer $quantity
 * @property string $rangePrice
 * @property string $type
 * @property string $headrest
 * @property integer $parendId
 * @property string $className
 * @property integer $IsCatImage
 * @property integer $pageId
 * @property integer $isDelete
 *
 * @property CmsBlockDataCategoryProduct[] $cmsBlockDataCategoryProducts
 * @property CmsBlockDataCategoryProductAuction[] $cmsBlockDataCategoryProductAuctions
 * @property CmsBlockDataImageBanner[] $cmsBlockDataImageBanners
 * @property CmsBlockDataImageBrand[] $cmsBlockDataImageBrands
 * @property CmsBlockDataNavMenu[] $cmsBlockDataNavMenus
 * @property CmsBlockDataSeller[] $cmsBlockDataSellers
 */
class CmsBlockDataCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'categoryName', 'order'], 'required'],
            [['blockId', 'exitsChild', 'active', 'order', 'group', 'quantity', 'parendId', 'IsCatImage', 'pageId', 'isDelete'], 'integer'],
            [['childContent'], 'string'],
            [['categoryName', 'rangePrice', 'className'], 'string', 'max' => 50],
            [['linkTo'], 'string', 'max' => 300],
            [['alias', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['type'], 'string', 'max' => 100],
            [['headrest'], 'string', 'max' => 150],
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
            'categoryName' => 'Category Name',
            'exitsChild' => 'Exits Child',
            'childContent' => 'Child Content',
            'active' => 'Active',
            'order' => 'Order',
            'linkTo' => 'Link To',
            'alias' => 'Alias',
            'image' => 'Image',
            'group' => 'Group',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'rangePrice' => 'Range Price',
            'type' => 'Type',
            'headrest' => 'Headrest',
            'parendId' => 'Parend ID',
            'className' => 'Class Name',
            'IsCatImage' => 'Is Cat Image',
            'pageId' => 'Page ID',
            'isDelete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataCategoryProducts()
    {
        return $this->hasMany(CmsBlockDataCategoryProduct::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataCategoryProductAuctions()
    {
        return $this->hasMany(CmsBlockDataCategoryProductAuction::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataImageBanners()
    {
        return $this->hasMany(CmsBlockDataImageBanner::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataImageBrands()
    {
        return $this->hasMany(CmsBlockDataImageBrand::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataNavMenus()
    {
        return $this->hasMany(CmsBlockDataNavMenu::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataSellers()
    {
        return $this->hasMany(CmsBlockDataSeller::className(), ['categoryId' => 'id']);
    }
}
